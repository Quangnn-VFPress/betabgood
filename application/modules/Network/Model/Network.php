<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Network.php 9872 2013-02-13 00:31:37Z shaun $
 * @author     Sami
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Network_Model_Network extends Core_Model_Item_Abstract 
{
  protected $_searchTriggers = false;
  
  public function getHref()
  {
    return null;
  }
  
  public function setFromArray(array $data)
  {
    if( !empty($values['assignment']) && $values['assignment'] == 1 && !empty($values['field_id']) ) {
      $table = $this->getTable();
      $cols = $table->info('cols');
      $params = array_intersect_key($values, array_combine($cols, $cols));

      // Pattern
      if( $params['assignment'] == 1 && !empty($params['field_id']) ) {
        $field_id = $params['field_id'];
        $pattern = $values['field_pattern_' . $params['field_id']];
        $types = Zend_Json::decode($values['types']);
        $type = $types[$field_id];
        $params['pattern'] = array(
          'type' => $type,
          'value' => $pattern,
        );
      }

      $values = $params;
    }
    
    return parent::setFromArray($values);
  }

  public function toFormArray()
  {
    $params = $this->toArray();
    if( $params['assignment'] == 1 && !empty($params['field_id']) ) {
      $field_id = $params['field_id'];
      $params['field_pattern_' . $field_id] = $params['pattern']['value'];
    }
    return $params;
  }

  public function membership()
  {
    return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('membership', 'network'));
  }
  
  public function recalculateAll()
  {
    if( $this->assignment != 1 || empty($this->pattern) || empty($this->field_id) ) {
      return $this;
    }

    // Remove all members
    $this->membership()->removeAllMembers();

    // Get pattern thingy
    $pattern = $this->pattern;
    if( empty($pattern['value']) ){
      return $this;
    }
    if( $pattern['type'] == 'text' ) {
      $pattern['value'] = '%' . trim($pattern['value'], '%') . '%';
    }
    
    // Get matching item ids
    $ids = Engine_Api::_()->fields()->getMatchingItemIds("user", $this->field_id, $pattern['value']);

    // Add each member
    foreach( $ids as $id ) {
      $user = Engine_Api::_()->getItem('user', $id);
      if( !$user || !$user->getIdentity() || $user->getIdentity() != $id ) continue;
      
      try {
        $this->membership()
          ->addMember($user)
          ->setUserApproved($user)
          ->setResourceApproved($user);
      } catch( Exception $e ) {
        // Silence
      }
      $this->membership()->clearRows();

      unset($user);
    }
    
    return $this;
  }

  public function recalculate(User_Model_User $user, $values = null)
  {
    if( $this->assignment != 1 || empty($this->pattern) || empty($this->field_id) ) {
      return $this;
    }
    
    if( null === $values ) {
      $values = Engine_Api::_()->fields()->getFieldsValues($user);
    }

    // Missing field or user didn't fill field in
    $value = $values->getRowsMatching('field_id', $this->field_id);

    if( !is_array($value) || empty($value) ) {
      return $this;
    }

    foreach( $value as $sVal ) {
      if( !is_object($sVal) || empty($sVal->value) ) {
        return $this;
      }
    }

    if( count($value) == 1 ) {
      $multi = false;
      $value = array_shift($value);
      $value = $value->value;
    } else {
      $multi = true;
      $tmp = array();
      foreach( $value as $sVal ) {
        $tmp[] = $sVal->value;
      }
      $value = $tmp;
    }

    // Try to match value
    $found = false;
    $pattern = $this->pattern['value'];
    switch( $this->pattern['type'] ) {
      case 'text':
        if( is_scalar($value) && stripos($pattern, $value) !== false ) {
          $found = true;
        }
        break;

      case 'exact':
      case 'select':
        if( is_scalar($value) && !is_array($pattern) && $value == $pattern ) {
          // if member choice is a value and the network criteria allows just a single value
          $found = true;
        } else if( is_array($value) && !is_array($pattern) && in_array($pattern, $value) ) {
          // if member choice is multiple options and the network criteria allows just a single value
          $found = true;
        } else if( is_scalar($value) && is_array($pattern)){
          // if member choice is a value and the network criteria allows multiple options
          foreach ($pattern as $option){
            if ($option == $value) {
              $found = true;
            }
          }
        } else if( is_array($value) && is_array($pattern)){
          // if member choice is multiple options and the network criteria allows multiple options
          foreach ($pattern as $option){
            if (in_array($pattern, $value)) {
              $found = true;
            }
          }
        }
        break;

      case 'list':
        if( is_scalar($value) && in_array($value, (array) $pattern) ) {
          $found = true;
        } else if( is_array($value) && $value === $pattern ) {
          $found = true;
        }
        break;

      case 'range':
        if( is_scalar($value) ) {
          $unfound = true;
          if( !empty($pattern['min']) ) {
            if( $value < $pattern['min'] ) {
              $unfound = false;
            }
          }
          if( !empty($pattern['max']) ) {
            if( $value > $pattern['max'] ) {
              $unfound = false;
            }
          }
          $found = !$unfound;
        }
        break;

      case 'date':
        if( is_scalar($value) ) {
          $unfound = true;
          if( !empty($pattern['min']) ) {
            if( strtotime($value) < strtotime($pattern['min']) ) {
              $unfound = false;
            }
          }
          if( !empty($pattern['max']) ) {
            if( strtotime($value) > strtotime($pattern['max']) ) {
              $unfound = false;
            }
          }
          $found = !$unfound;
        }
        break;
    }


    if( $found ) {
      if( !$this->membership()->isMember($user) ) {
        $this->membership()
          ->addMember($user)
          ->setUserApproved($user, true)
          ->setResourceApproved($user, true)
          ->clearRows();
      }
    } else {
      if( $this->membership()->isMember($user) ) {
        $this->membership()
          ->removeMember($user)
          ->clearRows();
      }
    }
    
    return $this;
  }

  public function isOwner(Core_Model_Item_Abstract $owner)
  {
    return false;
  }

  public function getMemberCount()
  {
    return $this->member_count;
  }

  protected function _readData($spec)
  {
    if (!is_numeric($spec))
    {
      $spec = $this->getTable()->fetchRow($this->getTable()->select()->where("name = ?", $spec));
    }
    return parent::_readData($spec);
  }

  protected function _delete(){
    
  }
  
  public static function getUserNetworks(User_Model_User $viewer, $search = null)
  {
    $table = Engine_Api::_()->getItemTable('network');
    $select = $table->select()
      ->where('assignment = ?', 0)
      ->order('title ASC');

    if( null !== $search )
    {
      $select->where('`'.$table->info('name').'`.`title` LIKE ?', '%'. $text .'%');
    }

    foreach( $table->fetchAll($select) as $network )
    {
      if( !$network->membership()->isMember($viewer) )
      {
        $data[] = array(
          'id' => $network->getIdentity(),
          'title' => Zend_Registry::get('Zend_Translate')->_($network->getTitle()),
          //'title' => $this->view->translate($network->getTitle()),
        );
      }
    }
    
    return $data;
  }

}
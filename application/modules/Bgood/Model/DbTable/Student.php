<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood.vn
 * @license    http://www.bgood.vn
 * @version    $Id: Core.php 9747 2012-07-26 02:08:08Z quangnn $
 * @author     QuangNN
 */

/**
 * @category   Application_Extensions
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood.vn
 * @license    http://www.bgood.vn
 */
class Bgood_Model_DbTable_Student extends Engine_Db_Table
{
  protected $_rowClass = "Bgood_Model_Student";
  
  /**
   * Lay ra danh sach toan bo user dang ky lam student
   * Tim trong bang engine4_user_fields_values ma co field_id = 1 va value = 4
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Db_Table_Select
   */
  public function getStudents($params = array())
  {
    $sql = 'select * from engine4_users where user_id in (
                SELECT item_id FROM `engine4_user_fields_values` where field_id=1 and value=4
            )';
            
    $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
    $select = $table->query($sql)->fetchAll();   

    return $select;
  }
  
  /**
   * Gets a paginator for blogs
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Paginator
   */
  public function getStudentsPaginator($params = array())
  {
    $paginator = Zend_Paginator::factory($this->getStudents($params));
    if( !empty($params['page']) )
    {
      $paginator->setCurrentPageNumber($params['page']);
    }
    if( !empty($params['limit']) )
    {
      $paginator->setItemCountPerPage($params['limit']);
    }

    if( empty($params['limit']) )
    {
      $page = (int) Engine_Api::_()->getApi('settings', 'core')->getSetting('bgood.page', 10);
      $paginator->setItemCountPerPage($page);
    }

    return $paginator;
  }  
}
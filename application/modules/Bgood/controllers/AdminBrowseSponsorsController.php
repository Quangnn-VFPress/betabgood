<?php

/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood
 * @license    http://www.socialengine.com/license/
 * @version    1.0
 * @author     Quang
 */

class Bgood_AdminBrowseSponsorsController extends Core_Controller_Action_Admin
{
    public function indexAction()
    {
        // Process form
        $values = $this->_getAllParams();
        foreach ($values as $key => $value)
        {
            if (null === $value)
            {
                unset($values[$key]);
            }
        }
        $values = array_merge(array(
          'order' => 'user_id',
          'order_direction' => 'DESC',
        ), $values);
        $order = (!empty($values['order']) ? $values['order'] : 'user_id' ) . ' ' . ( !empty($values['order_direction']) ? $values['order_direction'] : 'DESC' );
        
        $sql = 'select engine4_users.*,engine4_bgood_sponsor.sponsor_id from engine4_users
			LEFT JOIN engine4_bgood_sponsor ON engine4_bgood_sponsor.user_id = engine4_users.user_id
			where engine4_users.user_id in (SELECT item_id FROM `engine4_user_fields_values` where field_id=1 and value=5)';
        
        if (!empty($values['displayname']))
        {
            $sql .= ' AND displayname LIKE "%' . $values['displayname'] . '%"';
        }
        if (!empty($values['username']))
        {
            $sql .= ' AND username LIKE "%' . $values['username'] . '%"';
        }
        if (!empty($values['email']))
        {
            $sql .= ' AND email LIKE "%' . $values['email'] . '%"';
        }
        $sql .= ' ORDER BY '.$order;
        //echo $sql;
        $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        
        $select = $table->query($sql)->fetchAll();  
        foreach ($select as $i => $s)
        {
            $tmp = $table->query('SELECT storage_path FROM engine4_storage_files WHERE parent_id=' .
                $s['user_id'] . ' AND parent_type=\'user\' AND type=\'thumb.icon\'')->fetch();
            if ($tmp['storage_path'] != '')
            {
                $select[$i]['avatar'] = $tmp['storage_path'];
            }
            else
            {
                $select[$i]['avatar'] = 'application/modules/User/externals/images/nophoto_user_thumb_icon.png';
            }
        }      
        $this->view->students = $select;
        $this->view->values = $values;
    }
    public function blockAction()
    {
        $id = $this->_getParam('id', null);
        $this->view->id= $id;
        if ($this->getRequest()->isPost())
        {
            $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
            $db->beginTransaction();

            try
            {
                $db->query('UPDATE engine4_bgood_sponsor SET active = 0 WHERE sponsor_id='.$id.';');
                $db->commit();
            }
            catch (exception $e)
            {
                $db->rollBack();
                throw $e;
            }
            return $this->_forward('success', 'utility', 'core', array(
                'smoothboxClose' => true,
                'parentRefresh' => true,
                'format' => 'smoothbox',
                'messages' => array('This sponsor has been successfully blocked.')));
        }
    }
    public function activeAction()
    {
        $id = $this->_getParam('id', null);
        $this->view->id= $id;
        if ($this->getRequest()->isPost())
        {
            $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
            $db->beginTransaction();

            try
            {
                $db->query('UPDATE engine4_bgood_sponsor SET active = 1 WHERE sponsor_id='.$id.';');
                $db->commit();
            }
            catch (exception $e)
            {
                $db->rollBack();
                throw $e;
            }
            return $this->_forward('success', 'utility', 'core', array(
                'smoothboxClose' => true,
                'parentRefresh' => true,
                'format' => 'smoothbox',
                'messages' => array('This sponsor has been successfully actived.')));
        }
    }
    
    
    /*
        Chuyen user nay thanh sponsor
    */
    public function promoteAction()
    {
        $id = $this->_getParam('id', null);
        $arrValues = $this->getUser($id);
        if(isset($id) && $id > 0 && isset($arrValues))
        {            
            //Lay ra toan bo thong tin
            $this->view->id= $id;
            
            //Neu dong y thi chuyen user nay thanh sponsor 
            if ($this->getRequest()->isPost())
            {                
                $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
                $db->beginTransaction();
    
                try
                {
                    //Kiem tra xem bang sponsor da co user nay chua, neu co roi thi update lai, chua thi insert moi
                    
                    $countSql = 'select count(*) from engine4_bgood_sponsor where user_id = '.$id;
                    $count = $db->query($countSql)->fetch();
                    $sql = '';
                    $date = date('Y-m-d H:i:s', time());
                    $cols = '(user_id,active,promote_date,';
                    $colValues = ' VALUES(\''.$id.'\',1,\''.$date.'\',';
                    foreach($arrValues as $key => $value)
                    {
                        if($count[0] > 0)
                        {
                            //Neu co roi thi update lai bang sponsor
                            $sql .= $key.'=\''.$value.'\' AND ';
                        }
                        else
                        {
                            //Neu chua co thi insert moi vao
                            $cols .= $key.',';
                            $colValues .= '\''.$value.'\',';
                        }
                    }          
                               
                    if($count[0] > 0)
                    {
                        $sql .= ' 1=1';
                        $sql = 'UPDATE engine4_bgood_sponsor SET '.$sql.' WHERE user_id = '.$id;
                    }
                    else
                    {
                        $cols = substr($cols,0,strlen($cols) -1).')';
                        $colValues = substr($colValues,0,strlen($colValues) -1).')';
                        
                        $sql = 'INSERT INTO engine4_bgood_sponsor '.$cols.' '.$colValues;
                    }
                    
                    //echo $sql;
                    $db->query($sql);
                    $db->commit();
                }
                catch (exception $e)
                {
                    $db->rollBack();
                    throw $e;
                }
                
                return $this->_forward('success', 'utility', 'core', array(
                    'smoothboxClose' => true,
                    'parentRefresh' => true,
                    'format' => 'smoothbox',
                    'messages' => array('This sponsor has been successfully actived.')));
                
            } 
            else
            {
                //Neu chua co submit thi lay ra toan bo thong tin cua sponsor
                
            }
        }        
    }
    
    public function getUser($id)
    {
        //Lay ra gia tri
        $valueSql = 'SELECT item_id, engine4_user_fields_meta.field_id,type,label,value FROM `engine4_user_fields_values` 
INNER JOIN engine4_user_fields_meta ON engine4_user_fields_meta.field_id = engine4_user_fields_values.field_id
WHERE item_id = '.$id;
        $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $values = $db->query($valueSql)->fetchAll();
        return $this->fetchsponsor($values);
    } 
    
    function fetchsponsor($values) 
    {         
        $arrMaps = array (
            '78' => 'name',
            '79' => 'address',
            '80' => 'phone_no'
            //,'83' => 'gender'
        );
        
        $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        
        //Check user promote status
        $checksponsorSql = 'select count(*) from engine4_bgood_sponsor where user_id = '.
        $text = '';
        $arrValues = array();
        foreach($values as $key => $value)
        {
            $type = $value['type'];
            $field_id = $value['field_id'];
            $user_id = $value['item_id'];
            if($type == 'select') //Neu la dang select thi lay du lieu them tu bang options
            {
                $selectValueSql = 'SELECT label FROM engine4_user_fields_options WHERE field_id = '.$field_id.' and option_id = '.$value['value'];                
                $optionValue = $db->query($selectValueSql)->fetch();
                $values[$key]['value'] = $optionValue['label'];
                //echo $optionValue['label'];
            }
            
            //Map lai thong tin
            $item_id = $values[$key]['field_id'];
            
            //Kiem tra neu field nay trong mang map ko
            $check = array_key_exists($item_id, $arrMaps);
            //echo $arrMaps[$item_id].'-- ';            
            if($check)
            {                
                //$text .= $arrMaps[$item_id].'=\''.$values[$key]['value'].'\' AND ';
                $arrValues[$arrMaps[$item_id]] = $values[$key]['value'];
            }
        }
        
        /*
        echo '<pre>';
        print_r($arrValues);
        echo '</pre>';
        */
        
        //echo $text;
        return $arrValues;
    } 
}

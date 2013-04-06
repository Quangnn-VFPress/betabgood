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

class Bgood_AdminBrowseFinanceController extends Core_Controller_Action_Admin
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
          'order' => 'id',
          'order_direction' => 'DESC',
        ), $values);
        
        $order = (!empty($values['order']) ? $values['order'] : 'id' ) . ' ' . ( !empty($values['order_direction']) ? $values['order_direction'] : 'DESC' );
        
        $sql = 'select engine4_bgood_finance.*,
                engine4_users.displayname as student_name,  engine4_bgood_funds.expired_date, engine4_bgood_sponsor.user_id as sponsor_user_id 
            from engine4_bgood_finance 
            inner join engine4_bgood_students on engine4_bgood_students.student_id = engine4_bgood_finance.student_id
            inner join engine4_bgood_funds on engine4_bgood_funds.fund_id = engine4_bgood_finance.fund_id
            inner join engine4_bgood_sponsor on engine4_bgood_sponsor.sponsor_id = engine4_bgood_finance.sponsor_id
            inner join engine4_users on engine4_users.user_id = engine4_bgood_students.user_id          
            ';
        
        if (!empty($values['check_date']))
        {
            $sql .= ' AND check_date = "' . $values['check_date'] . '"';
        }
        if (!empty($values['amount']))
        {
            $sql .= ' AND amount = "' . $values['amount'] . '"';
        }
        if (!empty($values['student_id']))
        {
            $sql .= ' AND student_id = "' . $values['student_id'] . '"';
        }
        $sql .= ' ORDER BY '.$order;
        
        //echo $sql;
        $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        
        $select = $table->query($sql)->fetchAll();  
        foreach($select as $i=>$s)
        {
            $tmp = $table->query('SELECT displayname FROM engine4_users WHERE user_id='.$s['sponsor_user_id'].'')->fetch();
            $select[$i]['sponsor_name'] = $tmp['displayname'];
        }
        
        $this->view->finances = $select;
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
}

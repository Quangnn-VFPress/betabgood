<?php

/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: AdminManageController.php 9747 2012-07-26 02:08:08Z john $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Bgood_AdminBrowseStudentsController extends Core_Controller_Action_Admin
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
        
        $sql = 'select engine4_users.*,engine4_bgood_students.student_id from engine4_users
				LEFT JOIN engine4_bgood_students ON engine4_bgood_students.user_id = engine4_users.user_id
				where engine4_users.user_id in (SELECT item_id FROM `engine4_user_fields_values` where field_id=1 and value=4) ';
        
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
                $db->query('UPDATE engine4_bgood_students SET active = 0 WHERE student_id='.$id.';');
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
                'messages' => array('This student has been successfully blocked.')));
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
                $db->query('UPDATE engine4_bgood_students SET active = 1 WHERE student_id='.$id.';');
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
                'messages' => array('This student has been successfully actived.')));
        }
    }
    
    
    /*
        Chuyen user nay thanh student
    */
    public function promoteAction()
    {
        $id = $this->_getParam('id', null);
        $arrValues = $this->getUser($id);
        if(isset($id) && $id > 0 && isset($arrValues))
        {            
            //Lay ra toan bo thong tin
            $this->view->id= $id;
            
            //Neu dong y thi chuyen user nay thanh student 
            if ($this->getRequest()->isPost())
            {                
                $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
                $db->beginTransaction();
    
                try
                {
                    //Kiem tra xem bang student da co user nay chua, neu co roi thi update lai, chua thi insert moi
                    
                    $countSql = 'select count(*) from engine4_bgood_students where user_id = '.$id;
                    $count = $db->query($countSql)->fetch();
                    $sql = '';
                    $date = date('Y-m-d H:i:s', time());
                    $cols = '(user_id,active,promote_date,';
                    $colValues = ' VALUES(\''.$id.'\',1,\''.$date.'\',';
                    foreach($arrValues as $key => $value)
                    {
                        if($count[0] > 0)
                        {
                            //Neu co roi thi update lai bang student
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
                        $sql = 'UPDATE engine4_bgood_students SET '.$sql.' WHERE user_id = '.$id;
                    }
                    else
                    {
                        $cols = substr($cols,0,strlen($cols) -1).')';
                        $colValues = substr($colValues,0,strlen($colValues) -1).')';
                        
                        $sql = 'INSERT INTO engine4_bgood_students '.$cols.' '.$colValues;
                    }
                    
                    //echo $sql;
                    $db->query($sql);
                    $db->commit();
                    
                    //Insert vao bang Mark
                    $countSql = 'select count(*) from engine4_bgood_mark where user_id = '.$id;
                    $count = $db->query($countSql)->fetch();
                    if($count[0] == 0)
                    {
                        //Chua co thi insert vao
                        $studentSql = 'select student_id from engine4_bgood_students where user_id = '.$id;
                        $student = $db->query($studentSql)->fetch();
                        $student_id = $student['student_id'];
                        
                        $markSql = 'INSERT INTO engine4_bgood_mark (student_id, user_id, xacnhan, thanhtichkhac, mark, rate)
                            VALUES('.$student_id.','.$id.',0,0,0,0)
                        ';
                        
                        $db->query($markSql);
                        $db->commit();
                    }
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
                    'messages' => array('This student has been successfully actived.')));
                
            } 
            else
            {
                //Neu chua co submit thi lay ra toan bo thong tin cua student
                
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
        return $this->fetchStudent($values);
    } 
    
    function fetchStudent($values) 
    {         
        $arrMaps = array (
            '16' => 'gender',
            '17' => 'dob',
            '36' => 'location_id',
            '18' => 'personal_id',
            '19' => 'address',
            '20' => 'contact_address',
            '21' => 'ethnic',
            '22' => 'tel1_no',
            '23' => 'tel1_name',
            '24' => 'tel2_no',
            '25' => 'tel2_name',
            '29' => 'university_name',
            '42' => 'university_mark',
            '31' => 'division_id',
            '32' => 'class_name',
            '33' => 'student_code',
            '35' => 'highschool_name', 
            '39' => 'highschool_result_10', 
            '40' => 'highschool_result_11', 
            '41' => 'highschool_result_12', 
            '43' => 'other_result', 
            '44' => 'subsidies', 
            //'48' => 'time_jobs', 
            //'49' => 'income', 
            //'50' => 'other_school_hour_name', 
            //'52' => 'scholarship', 
            '57' => 'father_name', 
            '58' => 'father_dob', 
            '59' => 'father_education', 
            '60' => 'father_job', 
            '61' => 'father_job_location', 
            '62' => 'father_income', 
            '63' => 'father_health', 
            '64' => 'father_health_details', 
            '66' => 'mother_name', 
            '67' => 'mother_education', 
            '68' => 'mother_job', 
            '69' => 'mother_job_location', 
            '70' => 'mother_income', 
            '71' => 'mother_health', 
            '72' => 'mother_health_details', 
            '73' => 'parent_status', 
            '74' => 'parent_subsidies', 
            '75' => 'blogs',
            '99' => 'income_family',
            '100' => 'income_job',
            '101' => 'income_scholar',
            '102' => 'income_other',
            '103' => 'income_other_details',
            '104' => 'spend_school_fee',
            '105' => 'spend_house_rent',
            '106' => 'spend_living',
            '107' => 'spend_other',
            '108' => 'spend_other_details'
        );
        
        $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        
        //Check user promote status
        $checkStudentSql = 'select count(*) from engine4_bgood_students where user_id = '.
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
                //echo $selectValueSql;
                $optionValue = $db->query($selectValueSql)->fetch();
                $values[$key]['value'] = $optionValue['label'];
                //echo $optionValue['label'];
            }
            else if($type == 'bgood_location')
            {                 
                $selectValueSql = 'SELECT location_id as label FROM engine4_bgood_location WHERE location_name = \''.$value['value'].'\'';
                $optionValue = $db->query($selectValueSql)->fetch();
                $values[$key]['value'] = $optionValue['label'];
                //echo $optionValue['label'];
            }
            else if($type == 'bgood_division')
            {
                $selectValueSql = 'SELECT division_id as label FROM engine4_bgood_division WHERE division_name = \''.$value['value'].'\'';                
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
                if($arrMaps[$item_id] == 'gender')
                {
                    if($values[$key]['value'] == 'Nam')
                        $arrValues[$arrMaps[$item_id]] = '1';
                    else
                        $arrValues[$arrMaps[$item_id]] = '0';
                }
                else
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

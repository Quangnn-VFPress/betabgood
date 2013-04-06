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

class Bgood_RaiseFundController extends Core_Controller_Action_Standard
{
    public function indexAction()
    {
        //
                
    }
    
    public function raiseAction()
    {
        $id = $this->_getParam('id', null);
        if($id)
        {
            $db = Engine_Api::_()->getDbtable('users','user')->getAdapter();
            
            $countSql = 'select count(*) as student_count from engine4_bgood_students where user_id = '.$id;
            $count = $db->query($countSql)->fetch();        
            
            if($count['student_count'] > 0) //Neu ton tai sinh vien nay
            {
                $student_query = 'select * from engine4_bgood_students 
                    inner join engine4_users on engine4_users.user_id = engine4_bgood_students.user_id
                    inner join engine4_bgood_student_fund on engine4_bgood_student_fund.student_id = engine4_bgood_students.student_id
                    inner join engine4_bgood_funds on engine4_bgood_funds.fund_id = engine4_bgood_student_fund.fund_id
                    where engine4_bgood_students.user_id = '.$id;
                //echo $student_query;
                $student = $db->query($student_query)->fetch();
                
                $this->view->student = $student;
                
                //Tinh ra so tien da duoc tai tro
                if($student)
                {
                    $student_id = $student['student_id'];
                    $fund_id = $student['fund_id'];        
                    $fund_total_amount = $student['fund_amount'];         
                    
                    $fund_query = 'select engine4_bgood_finance.* from engine4_bgood_finance
                        inner join engine4_bgood_students on engine4_bgood_students.student_id = engine4_bgood_finance.student_id
                        inner join engine4_bgood_funds on engine4_bgood_funds.fund_id = engine4_bgood_finance.fund_id
                        inner join engine4_bgood_sponsor on engine4_bgood_sponsor.sponsor_id = engine4_bgood_finance.sponsor_id
                        where engine4_bgood_finance.type = 0 
                            and engine4_bgood_finance.student_id = '.$student_id.' 
                            and engine4_bgood_finance.fund_id ='.$fund_id.'
                    ';
                    //echo $fund_query;
                    $arrFunds = $db->query($fund_query)->fetchAll();
                    //echo count($arrFunds);
                    $funds = array();
                    $total_amount = 0;
                    $success_amount = 0;
                    $pending_amount = 0;
                    for($i=0;$i<count($arrFunds);$i++)
                    {
                        $funds[] = $arrFunds[$i];
                        $total_amount += $arrFunds[$i]['amount'];
                        if($arrFunds[$i]['status'] == 0)
                        {
                            //Neu chua chuyen thanh cong
                            $pending_amount += $arrFunds[$i]['amount'];
                        }
                        else if($arrFunds[$i]['status'] == 1)
                        {
                            //Neu da chuyen thanh cong
                            $success_amount += $arrFunds[$i]['amount'];
                        } 
                    }
                    //Dem xem so tien da cam ket tai tro
                    $funds['fund_total_amount'] = $fund_total_amount;
                    $funds['total_amount'] = $total_amount;
                    $funds['pending_amount'] = $pending_amount;
                    $funds['success_amount'] = $success_amount;
                    $funds['remain_amount'] = $fund_total_amount - $total_amount;
                    
                    $this->view->funds = $funds;                
                    /*            
                    echo '<pre>';
                    print_r($funds);
                    echo '</pre>';
                    */                
                }
                if ($this->getRequest()->isPost())
                {   
                    //Neu an vao nut tai tro
                    
                    $sponsor_amount = $this->_getParam('sponsor_amount',0);
                    $sponsor_date = $this->_getParam('sponsor_date',date());
                    $sponsor_type = $this->_getParam('sponsor_type',0);
                    $sponsor_content = $this->_getParam('sponsor_content','');
                    
                    //Kiem tra du lieu nhap vao truoc
                    if($sponsor_amount > $funds['remain_amount'])
                    {
                        //Neu so tien nhap vao lon hon la so tien SV can
                        echo '<script>alert("Số tiền bạn tài trợ lớn hơn số tiền sinh viên cần !");</script>';
                        return;
                    }
                    
                    //Chuyen ngay sang dang nhan dang duoc
                    $stamp = date("Y-m-d h:i:s", strtotime(str_replace('/','-',$sponsor_date)));
                    //Kiem tra xem ngay tai tro neu > ngay het han cua dot tai tro thi thong bao
                    $expired_date = strtotime($student['expired_date']);
                    
                    if(strtotime(str_replace('/','-',$sponsor_date)) > $expired_date)
                    {
                        echo '<script>alert("Ngày tài trợ muộn quá so với hạn nộp tiền học của sinh viên !");</script>';
                        return;
                    }
                    
                    //Chen vao co so du lieu
                    $viewer = Engine_Api::_()->user()->getViewer();
                    $sponsor_id = $viewer->getIdentity();
                    $insert_sql = 'insert into engine4_bgood_finance(type,check_date,amount,student_id,fund_id,sponsor_id,content,status,sponsor_type)
                            VALUES(0,\''.$stamp.'\',\''.$sponsor_amount.'\','.$student_id.','.$fund_id.','.$sponsor_id.',\''.$sponsor_content.'\',0,'.$sponsor_type.')
                        ';
                    
                    $db->query($insert_sql);
                    $db->commit();
                                                      
                    return $this->_forward('success', 'utility', 'core', array(
                        'messages' => $this->view->translate('Thanks for your kindness'),                        
                        'smoothboxClose' => true,
                        'parentRefresh' => false,
                      ));
                }
            }
            else
                return;
        }
        else
            return;
    }
}
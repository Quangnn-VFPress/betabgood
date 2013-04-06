<?php

/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 8536 2011-03-01 04:43:10Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Custom_Widget_ListStudentEnoughController extends Engine_Content_Widget_Abstract
{
    public function indexAction()
    {
        // Should we consider views or comments popular?
        $popularType = $this->_getParam('popularType', 'member');
        if (!in_array($popularType, array('view', 'member')))
        {
            $popularType = 'member';
        }
        $this->view->popularType = $popularType;
        $this->view->popularCol = $popularCol = $popularType . '_count';
        // Get paginator
        $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $select = $table->select()->from(array('u' => 'engine4_users'))->join(array('s' =>
                'engine4_bgood_students'), 'u.user_id=s.user_id');
        $select = $table->fetchAll($select);
        foreach ($select as $i => $s)
        {
            $tmp = $table->query('SELECT storage_path FROM engine4_storage_files WHERE parent_id=' .
                $s['user_id'] . ' AND parent_type="user" AND type="thumb.icon" ORDER BY creation_date DESC')->
                fetch();
            if ($tmp['storage_path'] != '')
            {
                $select[$i]['avatar'] = $tmp['storage_path'];
            }
            else
            {
                $select[$i]['avatar'] =
                    'application/modules/User/externals/images/nophoto_user_thumb_icon.png';
            }
            $amount = $table->query('SELECT SUM(A.amount),A.student_id,B.user_id,C.rate
                    FROM engine4_bgood_finance AS A, engine4_bgood_students AS B,engine4_bgood_mark AS C
                    WHERE A.student_id = B.student_id
                    	AND A.student_id = C.student_id
                    	AND B.user_id ='.$s['user_id'])->fetchAll();
            $budget = $table->query('SELECT fund_amount
                    FROM engine4_bgood_funds')->fetchAll();
            if($budget[0]['fund_amount']==0)
            {
                $select[$i]['percentage'] = 0;
            }else{
                $select[$i]['percentage'] = ($amount[0]['SUM(A.amount)']*100)/$budget[0]['fund_amount']; 
            }                                                               
            $select[$i]['rate'] = $amount[0]['rate'];
        }
        $this->view->paginator = $paginator = Zend_Paginator::factory($select);
        // Set item count per page and current page number
        $paginator->setItemCountPerPage($this->_getParam('itemCountPerPage', 4));
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));

        // Do not render if nothing to show
        if ($paginator->getTotalItemCount() <= 0)
        {
            return $this->setNoRender();
        }
    }
}

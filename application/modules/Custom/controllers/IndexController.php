<?php
class Custom_IndexController extends Core_Controller_Action_Standard
{
	public function indexAction()
	{
	}
	public function browseAction()
	{
		// Should we consider views or comments popular?
		$popularType = $this->_getParam('popularType', 'member');
		if(!in_array($popularType, array('view', 'member')))
		{
			$popularType = 'member';
		}
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
        $order = (!empty($values['order']) ? 'A.'.$values['order'] : 'B.user_id' ) . ' ' . ( !empty($values['order_direction']) ? $values['order_direction'] : 'DESC');
		$order_direction  = ( !empty($values['order_direction']) ? $values['order_direction'] : 'DESC');
		// Get paginator
		$location = $this->_getParam('location');
        $division = $this->_getParam('division');
        $gender = $this->_getParam('gender');
        $from = $this->_getParam('fromAge');
        $to = $this->_getParam('toAge');
		$table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        
		$sql = 'SELECT *,(YEAR(CURDATE())-YEAR(dob)) - (RIGHT(CURDATE(),5)<RIGHT(dob,5)) AS age FROM engine4_users AS A, engine4_bgood_students AS B WHERE A.user_id = B.user_id';
        if (!empty($location))
        {
            $sql .= ' AND B.location_id = ' .$location;
        }
        if (!empty($division))
        {
            $sql .= ' AND B.division_id = ' .$division;
        }
        if(in_array($gender,array(0,1)))
        {
            $sql .= ' AND B.gender = ' .$gender;
        }
        if (!empty($from))
        {
            $sql .= ' AND (YEAR(CURDATE())-YEAR(dob)) - (RIGHT(CURDATE(),5)<RIGHT(dob,5)) >= ' .$from;
        }
        if (!empty($from))
        {
            $sql .= ' AND (YEAR(CURDATE())-YEAR(dob)) - (RIGHT(CURDATE(),5)<RIGHT(dob,5)) <= ' .$to;
        }
        $sql .= ' ORDER BY '.$order;
        $select = $table->query($sql)->fetchAll();
		
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
        
        $this->view->fromAge = $from;
        $this->view->toAge = $to;
        $this->view->gender = $gender;
        $this->view->location = $location;
        $this->view->division = $division;
        $this->view->order = $values['order'];
        $this->view->order_direction = $order_direction;
		$this->view->paginator = $paginator = Zend_Paginator::factory($select);
		// Set item count per page and current page number
		$paginator->setItemCountPerPage($this->_getParam('itemCountPerPage', 10));
		$paginator->setCurrentPageNumber($this->_getParam('page', 1));
		// Do not render if nothing to show
		$this->renderScript('test.tpl');
	}
	function countAction()
	{
		$curtime = $this->_getParam('curtime');
		$table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $paginator = $table->query('SELECT B.username, B.displayname, C.user_id 
			FROM (SELECT * FROM engine4_activity_actions ORDER BY action_id DESC) AS A,engine4_users AS B,engine4_bgood_students AS C
			WHERE B.user_id=A.subject_id AND B.user_id= C.user_id AND A.date > \''.$curtime.'\'
			GROUP BY A.subject_id ORDER BY A.date DESC')->fetchAll();
		echo count($paginator);
	}
}

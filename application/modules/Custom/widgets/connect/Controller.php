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
class Custom_Widget_ConnectController extends Engine_Content_Widget_Abstract
{
    public function indexAction()
    {
        $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $paginator = $table->query('SELECT B.username, B.displayname, B.member_count, C.user_id, C.student_id FROM (SELECT * FROM engine4_activity_actions ORDER BY action_id DESC) AS A,engine4_users AS B,engine4_bgood_students AS C
WHERE B.user_id=A.subject_id AND B.user_id= C.user_id
GROUP BY A.subject_id ORDER BY A.date DESC')->fetchAll();
        $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
        foreach ($paginator as $i => $pg)
        {
            $imgLink = $table->query('SELECT storage_path
                        FROM engine4_storage_files
                        WHERE parent_type = \'user\' AND type = \'thumb.icon\' AND parent_id = '.$pg['user_id'].'
                        ORDER BY creation_date DESC')->fetchAll();
            $paginator[$i]['img'] = $imgLink[0]['storage_path'];
            
            $amount = $table->query('SELECT SUM(A.amount),A.student_id,B.user_id, C.rate
                    FROM engine4_bgood_finance AS A, engine4_bgood_students AS B,engine4_bgood_mark AS C
                    WHERE A.student_id = B.student_id
                	AND A.student_id = C.student_id
                	AND B.user_id = '.$pg['user_id'])->fetchAll();
             $budget = $table->query('SELECT fund_amount
                    FROM engine4_bgood_funds')->fetchAll();
            if($budget[0]['fund_amount']==0)
            {
                $select[$i]['percentage'] = 0;
            }else{
                $select[$i]['percentage'] = ($amount[0]['SUM(A.amount)']*100)/$budget[0]['fund_amount']; 
            }
            $paginator[$i]['rate'] = $amount[0]['rate'];
            $sponsor = $table->query('SELECT B.user_id
                        FROM engine4_bgood_finance AS A, engine4_bgood_sponsor AS B
                        WHERE A.sponsor_id = B.sponsor_id AND A.student_id ='.$pg['student_id'].' GROUP BY A.sponsor_id LIMIT 4')->fetchAll();
            foreach($sponsor as $s)
            {
                $imgSponsor = $table->query('SELECT storage_path
                        FROM engine4_storage_files
                        WHERE parent_type = \'user\' AND type = \'thumb.icon\' AND parent_id = '.$s['user_id'].'
                        ORDER BY creation_date DESC LIMIT 1')->fetchAll();
                $paginator[$i]['sponsor'][] = $imgSponsor[0]['storage_path'];
                
                $profileSponsor = $table->query('SELECT username 
                        FROM engine4_users
                        WHERE user_id = '.$s['user_id'])->fetchAll();
                $paginator[$i]['sponsor_profile'][] = $profileSponsor[0]['username'];
            }
            // Don't render this if not authorized
            $viewer = $subject = Engine_Api::_()->user()->getUser($pg['username']);
            // Pre-process feed items
            $activity = array();
            //Get current batch
            $actions = null;
            $actions = $actionTable->getActivityAbout($subject, $viewer);
            //Pre-process
            if (count($actions) > 0)
            {
                foreach ($actions as $action)
                {
                    //add to list
                    if (count($activity) < 1)
                    {
                        $activity[] = $action;
                    }
                }
            }
            $tmp[$i] = $activity;
            if ($activity)
            {
                $tmp[$i]['activity'] = $this->test($activity, array(
              'action_id' => $this->action_id,
              'viewAllComments' => $this->viewAllComments,
              'viewAllLikes' => $this->viewAllLikes,
              'getUpdate' => $this->getUpdate,
            ));
            }
        }
        $this->view->paginator = $paginator ;
        $this->view->activity = $tmp;
    }
    public function test($actions = null, array $data = array())
    {
        if (null == $actions || (!is_array($actions) && !($actions instanceof
            Zend_Db_Table_Rowset_Abstract)))
        {
            return '';
        }

        $form = new Activity_Form_Comment();
        $viewer = Engine_Api::_()->user()->getViewer();
        $activity_moderate = "";
        $group_owner = "";
        $group = "";
        try
        {
            $group = Engine_Api::_()->core()->getSubject('group');
        }
        catch (exception $e)
        {
        }
        if ($group)
        {
            $table = Engine_Api::_()->getDbtable('groups', 'group');
            $select = $table->select()->where('group_id = ?', $group->getIdentity())->limit(1);

            $row = $table->fetchRow($select);
            $group_owner = $row['user_id'];
        }
        if ($viewer->getIdentity())
        {
            $activity_moderate = Engine_Api::_()->getDbtable('permissions', 'authorization')->
                getAllowed('user', $viewer->level_id, 'activity');
        }
        $data = array_merge($data, array(
            'actions' => $actions,
            'commentForm' => $form,
            'user_limit' => Engine_Api::_()->getApi('settings', 'core')->getSetting('activity_userlength'),
            'allow_delete' => Engine_Api::_()->getApi('settings', 'core')->getSetting('activity_userdelete'),
            'activity_group' => $group_owner,
            'activity_moderate' => $activity_moderate,
            ));
        return $this->view->partial('_activityText.tpl','custom',$data);
    }
}
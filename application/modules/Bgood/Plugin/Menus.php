<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Menus.php 9770 2012-08-30 02:36:05Z richard $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Bgood_Plugin_Menus
{
    public function onMenuInitialize_UserProfileRaiseFund($row)
    {
        $viewer = Engine_Api::_()->user()->getViewer();
        //viewer la nguoi dang xem
        $subject = Engine_Api::_()->core()->getSubject();
        //subject la nguoi dang duoc xem
        
        
        //Kiem tra xem neu nguoi dung hien tai la sponsor thi cho hien len nut tai tro
        $subject_id = $subject->getIdentity();
        $db = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $subject_sql = 'select count(*) as student_count from engine4_bgood_students where user_id = \''.$subject_id.'\'';
        $subject_canView = $db->query($subject_sql)->fetch();
        
        /*
        echo '<pre>';
        print_r($subject_canView);
        echo '</pre>';
        */
        
        $viewer_id = $viewer->getIdentity();
        $viewer_sql = 'select count(*) as sponsor_count from engine4_bgood_sponsor where user_id = \''.$viewer_id.'\'';
        $viewer_canView = $db->query($viewer_sql)->fetch();
        
        if($subject_canView['student_count'] > 0 && $viewer_canView['sponsor_count'] > 0)
        {
            return array(
            'label' => 'Raise fund',
            'icon' => 'application/modules/Bgood/externals/images/white-donation.png',
            'class' => 'smoothbox',
            'route' => 'default',
            'params' => array(
                  'module' => 'bgood',
                  'controller' => 'raise-fund',
                  'action' => 'raise',
                  'id' => $subject->getIdentity(),
                  //'open' => 1,
                  'format' => 'smoothbox',
                ),
            );
        }
        else    
            return;       	
    }
}
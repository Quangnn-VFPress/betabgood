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

class Bgood_CountFundController extends Core_Controller_Action_Standard
{
    public function indexAction()
    {
        $db = Engine_Api::_()->getDbtable('users','user')->getAdapter();
		
		$countSql = 'select sum(amount) as count_fund from engine4_bgood_finance';
        $count = $db->query($countSql)->fetch();                        
		echo $count['count_fund'];
		exit;
		$this->view->count_fund = $count;
    }
}
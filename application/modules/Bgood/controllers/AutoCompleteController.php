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

class Bgood_AutoCompleteController extends Core_Controller_Action_Standard
{
    public function indexAction()
    {
        $type = $this->_getParam('type', null);
        
        $text = $this->_getParam('text', null);
        
        $db = Engine_Api::_()->getDbtable('users','user')->getAdapter();
        
		$sql = '';
        
        if($type == 'location')
        {
            $sql = 'select location_id as `id`, location_name as `label` from engine4_bgood_location where location_name like \'%'.$text.'%\' LIMIT 0,10';    
        }
        else if($type == 'division')
        {
            $sql = 'select division_id as `id`, division_name as `label` from engine4_bgood_division where division_name like \'%'.$text.'%\' LIMIT 0,10';
        }        
        else
            return;
		
        $results = $db->query($sql)->fetchAll();
        
		echo json_encode($results);
		exit;
    }
}
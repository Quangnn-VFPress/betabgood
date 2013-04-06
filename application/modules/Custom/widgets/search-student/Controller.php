<?php

/**
 * SocialEngine
 *
 * @category   Application_Widget
 * @package    Weather
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 7562 2010-10-05 22:17:24Z john $
 * @author     John
 */

/**
 * @category   Application_Widget
 * @package    Weather
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Custom_Widget_SearchStudentController extends Engine_Content_Widget_Abstract
{
    public function indexAction()
    {
        $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $select = $table->query('SELECT * FROM engine4_bgood_location')->fetchAll();
        $this->view->location = $select;
        
        $select = $table->query('SELECT * FROM engine4_bgood_division')->fetchAll();
        $this->view->division = $select;
    }
}

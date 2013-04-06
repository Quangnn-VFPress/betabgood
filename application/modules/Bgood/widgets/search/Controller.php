<?php
/**
 * SocialEngine - Search Widget Controller
 *
 * @category   Application_Bgood
 * @package    Bgood
 * @copyright  Copyright 2006-2012 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Controller.php 9747 2012-07-26 02:08:08Z john $
 * @author     Matthew
 */

class Bgood_Widget_SearchController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
      $searchApi = Engine_Api::_()->getApi('search', 'core');      
      
      // check public settings
      $require_check = Engine_Api::_()->getApi('settings', 'core')->core_general_search;
      if( !$require_check ) {
        if( !$this->_helper->requireUser()->isValid() ) return;
        }
        
      // Prepare form
      $this->view->form = $form = new Bgood_Form_Search();
      // Set Correct Action for the Search Form
      $this->view->form->setAction( "http://" . $_SERVER['HTTP_HOST'] . _ENGINE_R_BASE . 'search' );
      
      $this->view->viewer = $viewer = Engine_Api::_()->user()->getViewer();

    $require_check = Engine_Api::_()->getApi('settings', 'core')->core_general_search;
    if(!$require_check){
      if( $viewer->getIdentity()){
        $this->view->search_check = true;
      }
      else{
        $this->view->search_check = false;
      }
    }
    else $this->view->search_check = true;        
      }   
}
?>
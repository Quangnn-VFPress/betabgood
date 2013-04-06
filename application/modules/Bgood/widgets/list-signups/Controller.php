<?php
/**
 * SocialEngine
 *
 * @category   Application_Bgood
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood.vn
 * @license    
 * @version    
 * @author     QuangNN
 */

class Bgood_Widget_ListSignupsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $table = Engine_Api::_()->getDbtable('users', 'user');
    $select = $table->select()
      ->where('search = ?', 1)
      ->where('enabled = ?', 1)
      ->order('creation_date DESC')
      ;

    $this->view->paginator = $paginator = Zend_Paginator::factory($select);

    // Set item count per page and current page number
    $paginator->setItemCountPerPage($this->_getParam('itemCountPerPage', 10));
    $paginator->setCurrentPageNumber($this->_getParam('page', 1));

    // Do not render if nothing to show
    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }
  }

  public function getCacheKey()
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    $translate = Zend_Registry::get('Zend_Translate');
	$locale = Zend_Registry::get('Locale');
    return $viewer->getIdentity() . $translate->getLocale() . $locale->toString();
  }

  public function getCacheSpecificLifetime()
  {
    return 120;
  }
}
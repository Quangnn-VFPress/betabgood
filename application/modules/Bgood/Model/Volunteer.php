<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood.vn
 * @license    http://www.bgood.vn
 * @version    $Id: Core.php 9747 2012-07-26 02:08:08Z quangnn $
 * @author     QuangNN
 */

/**
 * @category   Application_Extensions
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood.vn
 * @license    http://www.bgood.vn
 */
class Bgood_Model_Volunteer extends Core_Model_Item_Abstract
{
  // Properties

  // General
  
  // Interfaces

  /**
   * Gets a proxy object for the comment handler
   *
   * @return Engine_ProxyObject
   **/
  public function comments()
  {
    return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('comments', 'core'));
  }


  /**
   * Gets a proxy object for the like handler
   *
   * @return Engine_ProxyObject
   **/
  public function likes()
  {
    return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('likes', 'core'));
  }

  /**
   * Gets a proxy object for the tags handler
   *
   * @return Engine_ProxyObject
   **/
  public function tags()
  {
    return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('tags', 'core'));
  }
}
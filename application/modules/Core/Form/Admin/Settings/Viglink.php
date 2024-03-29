<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Viglink.php 9747 2012-07-26 02:08:08Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
 
 // 01.03.2013 - TrioxX
 
class Core_Form_Admin_Settings_Viglink extends Engine_Form
{
  public function init()
  {
    $defaultId = md5(Engine_Api::_()->getDbtable('settings', 'core')->getSetting('core.license.key'));
    $subid = Engine_Api::_()->getDbtable('settings', 'core')->getSetting('core.viglink.subid', $defaultId);
    
    // Set form attributes
    $this->setTitle('VigLink');

    $description = $this->getTranslator()->translate(
        'Simply click enable below to start using ' . 
        '<a href="%1$s" target="_blank">VigLink</a>. You can claim or visit ' . 
        'your account <a href="%3$s" target="_blank">here</a> on our ' . 
        'site. If you already have a VigLink account, you can enter in your ' .
        'API key as found <a href="%2$s" target="_blank">here</a>. ' . 
        'If you already have an account, please empty the Sub ID field below.' .
        '<a class="admin help" href="%4$s" target="_blank"> </a> <br>');
    $description = vsprintf($description, array(
      'http://www.viglink.com/',
      'http://www.viglink.com/account',
      'http://anonym.to/http://www.socialengine.com/client/viglink',
      'http://anonym.to/http://support.socialengine.com/questions/206/Viglink-Setup',
    ));
	$settings = Engine_Api::_()->getApi('settings', 'core');
	if( $settings->getSetting('user.support.links', 0) == 1 ) {
	  $moreinfo = $this->getTranslator()->translate( 
        'More Info: <a href="http://anonym.to/http://support.socialengine.com/questions/206/Viglink-Setup" target="_blank"> KB Article</a>');
	} else {
	  $moreinfo = $this->getTranslator()->translate( 
        '');
	}
    $this->setDescription($description.$moreinfo);
    
    // Decorators
    $this->loadDefaultDecorators();
    $this->getDecorator('Description')->setOption('escape', false);
    
    // element: enabled
    $this->addElement('Radio', 'enabled', array(
      'label' => 'Enable?',
      'multiOptions' => array(
        '1' => 'Yes, enable VigLink on my site.',
        '0' => 'No, VigLink is disabled.',
      ),
      'value' => 0,
    ));
    
    // Element: code
    $this->addElement('Text', 'code', array(
      'label' => 'API Key',
      'filters' => array(
        'StringTrim',
      ),
      'value' => '',
    ));
    
    // element: subid
    $this->addElement('Text', 'subid', array(
      'label' => 'Sub ID',
      'value' => $subid,
    ));
    
    $description = $this->getTranslator()->translate(
        'This is your VigLink sub ID, which is based on your SE license ' . 
        'key. Please make sure your license key is valid on the admin ' . 
        'dashboard in order to be able to claim your account. Your sub ID ' . 
        'based on your current license key is: %1$s');
    $description = vsprintf($description, array(
      $defaultId
    ));
    $this->getElement('subid')->setDescription($description);
    
    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}
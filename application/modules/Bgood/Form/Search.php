<?php
/**
 * SocialEngine
 *
 * @category   Application_Bgood
 * @package    Bgood
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Search.php 9747 2012-07-26 02:08:08Z john $
 * @author     John
 */

/**
 * @category   Application_Bgood
 * @package    Bgood
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Bgood_Form_Search extends Engine_Form
{
  public function init()
  {
    $this
      ->setMethod('get')
      ->setDecorators(array('FormElements', 'Form'))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ;
    
    $this->addElement('Text', 'query', array(
      'decorators' => array(
        'ViewHelper',
      ),
    ));
    $this->addElement('Button', 'search', array(
      'label' => ' ',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array(
        'ViewHelper',      ),
    ));
  }
}
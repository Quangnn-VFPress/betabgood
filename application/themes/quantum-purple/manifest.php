<?php
/**
 * SocialEngine
 *
 * @category   Application_Theme
 * @package    Quantum Theme
 * @copyright  Copyright 2006-2012 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: manifest.php 9714 2012-05-07 23:17:50
 * @author     
 */
 
 // 01.03.2013 - TrioxX

return array (
  'package' => array (
    'type' => 'theme',
    'name' => 'quantum-purple',
    'version' => '4.3.0',
    'revision' => '$Revision: 9729 $',
    'path' => 'application/themes/quantum-purple',
    'repository' => '',
    'title' => 'Quantum Purple',
    'thumb' => 'quantum_theme.png',
    'author' => 'Webligo Developments',
    'changelog' => array(    
    ),
    'actions' => array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'remove',
    ),
    'callback' => array (
      'class' => 'Engine_Package_Installer_Theme',
    ),
    'directories' => array (
      0 => 'application/themes/quantum-purple',
    ),
  ),
  'files' => array(
    'theme.css',
    'constants.css',
  )
); ?>
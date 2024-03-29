<?php
/**
 * SocialEngine
 *
 * @category   Application_Theme
 * @package    Default
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: manifest.php 9378 2011-10-13 22:50:30Z john $
 * @author     Alex
 */
 
 // 01.03.2013 - TrioxX
 
return array(
  'package' => array(
    'type' => 'theme',
    'name' => 'clean',
    'version' => '4.3.0',
    'revision' => '$Revision: 9378 $',
    'path' => 'application/themes/clean',
    'repository' => '',
    'title' => 'Clean',
    'thumb' => 'theme.jpg',
    'author' => 'Webligo Developments',
    'changeLog' => array(
      '4.2.9p1' => array(
        'manifest.php' => 'Incremented version',
        'theme.css' => 'Fixed issue with missing image',
      ),
    ),
    'actions' => array(
      'install',
      'upgrade',
      'refresh',
      'remove',
    ),
    'callback' => array(
      'class' => 'Engine_Package_Installer_Theme',
    ),
    'directories' => array(
      'application/themes/clean',
    ),
  ),
  'files' => array(
    'theme.css',
    'constants.css',
  ),
) ?>
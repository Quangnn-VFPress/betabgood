<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Mobi
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: manifest.php 9747 2012-07-26 02:08:08Z john $
 * @author     Charlotte
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'mobi',
    'version' => '4.2.2',
    'revision' => '$Revision: 9747 $',
    'path' => 'application/modules/Mobi',
    'repository' => 'socialengine.com',
    'title' => 'Mobi',
    'description' => 'Mobile',
    'author' => 'Webligo Developments',
    'changeLog' => 'settings/changelog.php',
    'dependencies' => array(
      array(
        'type' => 'module',
        'name' => 'core',
        'minVersion' => '4.2.0',
      ),
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       'enable',
       'disable',
     ),
    'callback' => array(
      'path' => 'application/modules/Mobi/settings/install.php',
      'class' => 'Mobi_Installer',
    ),
    'directories' => array(
      'application/modules/Mobi',
    ),
    'files' => array(
      'application/languages/en/mobi.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  // Items ---------------------------------------------------------------------
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'mobi_general' => array(
      'route' => 'mobi/:action/*',
      'defaults' => array(
        'module' => 'mobi',
        'controller' => 'browse',
        'action' => '(browse)',
      ),
      'reqs' => array(
        'action' => '\D+',
      )
    ),
  )
) ?>
<?php return array (
  'package' => 
  array (
    'type' => 'theme',
    'name' => 'bgoodmodern',
    'version' => NULL,
    'revision' => '$Revision: 9378 $',
    'path' => 'application/themes/bgoodmodern',
    'repository' => 'socialengine.com',
    'title' => 'Bgood modern',
    'thumb' => 'theme.jpg',
    'author' => 'BGood Viet Nam',
    'changeLog' => 
    array (
    ),
    'actions' => 
    array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'remove',
    ),
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Theme',
    ),
    'directories' => 
    array (
      0 => 'application/themes/modern',
    ),
    'description' => 'Modern template by SonNN',
  ),
  'files' => 
  array (
    0 => 'theme.css',
    1 => 'constants.css',
  ),
); ?>
<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'custom',
    'version' => '4.0.0',
    'path' => 'application/modules/Custom',
    'title' => 'Custom Module',
    'description' => 'This is my custom',
    'author' => 'Trung Nguyen',
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Module',
    ),
    'actions' => 
    array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'enable',
      4 => 'disable',
    ),
    'directories' => 
    array (
      0 => 'application/modules/Custom',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/custom.csv',
    ),
  ),
); ?>
<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'bgood',
    'version' => '4.2.9',
    'path' => 'application/modules/Bgood',
    'title' => 'Bgood.vn',
    'description' => 'Bgood.vn',
    'author' => 'Bgood.vn',
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
      0 => 'application/modules/Bgood',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/bgood.csv',
    ),
  )
); ?>
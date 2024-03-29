<?php

 // 01.03.2013 - TrioxX

return array(
  'package' => array(
    'type' => 'library',
    'name' => 'zend',
    'version' => '4.3.0',
    'revision' => '$Revision: 9932 $',
    'path' => 'application/libraries/Zend',
    'repository' => '',
    'title' => 'Zend Framework',
    'author' => 'Webligo Developments',
    'changeLog' => array(
      '4.3.0' => array(
	'Navigation/Page/Mvc.php*' => 'Modified to have more accurate active page detection',
        'manifest.php' => 'Incremented version',
      ),
      '4.2.6' => array(
	'Translate*' => 'Upgraded',
        'manifest.php' => 'Incremented version',
      ),
      '4.2.0' => array(
        'manifest.php' => 'Incremented version',
        'zend_chanelog.txt' => 'Updated',
        'Service/ReCaptcha.php' => 'Fixed tabindex',
      ),
      '4.1.8' => array(
        'manifest.php' => 'Incremented version',
        'zend_chanelog.txt' => 'Updated',
        'Db/Table/Row/Abstract.php' => 'Removed translate column calls',
      ),
      '4.1.6' => array(
        'manifest.php' => 'Incremented version',
        'Services/Amazon/Abstract.php' => 'Removed region checking',
        'zend_chanelog.txt' => 'Updated',
      ),
      '4.1.2' => array(
        'Cache/Backend/Memcached.php' => 'Backport of ZF-8856 and ZF-9376, issues with deleting key',
        'Db/Table/Row/Abstract.php' => 'Moved postInsert hook to after data refresh to prevent issues with saving inside hook',
        'manifest.php' => 'Incremented version',
        'zend_chanelog.txt' => 'Updated',
      ),
      '4.1.0' => array(
        'Locale/Data.php' => 'Added method to access defaultnumberingsystem',
        'manifest.php' => 'Incremented version',
        'zend_chanelog.txt' => 'Updated',
      ),
      '4.0.4' => array(
        'manifest.php' => 'Incremented version',
        'zend_chanelog.txt' => 'Updated',
        'Mail/Transport/Abstract.php' => 'Backport of ZF-7874, fixes issues with garbled emails',
        'Translate/Adapter.php' => 'Fixes issue with plural variables in languages that have no plurals',
        'Validate/NotEmpty.php' => 'Reverting previous change',
        'View/Helper/HeadScript.php' => 'Removed extra line',
        'View/Helper/Placeholder/Container/Abstract.php' => 'Improved previous PHP 5.1 ksort fix',
      ),
      '4.0.3' => array(
        'Translate/Adapter.php' => 'Prevents language files that do not end in CSV from being read',
        'manifest.php' => 'Incremented version',
      ),
      '4.0.2' => array(
        'Ldap/Filter/*' => 'Fixed unmerged conflict',
        'Search/Lucene/Storage/File.php' => 'Fixed IonCube encoding errors',
        'Search/Lucene/Storage/File/Memory.php' => 'Fixed IonCube encoding errors',
        'manifest.php' => 'Incremented version',
      ),
      '4.0.1' => array(
        'manifest.php' => 'Incremented version',
        'Db/Select.php' => 'PHP 5.1 compatibility fix',
      ),
    ),
    'directories' => array(
      'application/libraries/Zend',
    )
  )
) ?>
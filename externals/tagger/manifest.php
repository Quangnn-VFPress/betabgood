<?php

 // 01.03.2013 - TrioxX

return array(
  'package' => array(
    'type' => 'external',
    'name' => 'tagger',
    'version' => '4.1.0',
    'revision' => '$Revision: 9747 $',
    'path' => 'externals/tagger',
    'repository' => '',
    'title' => 'Tagger',
    'author' => 'Webligo Developments',
    'changeLog' => array(
      '4.1.0' => array(
        'manifest.php' => 'Incremented version',
        'tagger.js' => 'Fixes issue where exception is thrown when tagging someone twice',
      ),
      '4.0.2' => array(
        'manifest.php' => 'Incremented version',
        'tagger.js' => 'Fixes issue with overflow hiding extra items',
      ),
      '4.0.1' => array(
        'manifest.php' => 'Incremented version',
        'tagger.js' => 'Added missing translation',
      ),
    ),
    'directories' => array(
      'externals/tagger',
    )
  )
) ?>
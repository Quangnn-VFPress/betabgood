<?php

 // 01.03.2013 - TrioxX

return array(
  'package' => array(
    'type' => 'external',
    'name' => 'tinymce',
    'version' => '4.3.0',
    'revision' => '$Revision: 9932 $',
    'path' => 'externals/tinymce',
    'repository' => '',
    'title' => 'TinyMCE',
    'author' => 'Webligo Developments',
    'changeLog' => array(
      '4.3.0' => array(
        'manifest.php' => 'Incremented version',
        'themes/advanced/skins/default/ui.css' => 'Adjusted styles',
      ),
      '4.2.2' => array(
        'manifest.php' => 'Incremented version',
        'themes/advanced/upload.htm' => 'Upgraded mootools',
      ),
      '4.1.8' => array(
        'manifest.php' => 'Incremented version',
        'plugins/media/langs/en_dlg.js' => 'Added to fix issues with copy/paste',
        'plugins/paste/editor_plugin.js' => 'Added to fix issues with copy/paste',
        'plugins/paste/editor_plugin_src.js' => 'Added to fix issues with copy/paste',
      ),
      '4.1.7' => array(
        '*' => 'Upgraded from version 3.4.2 to 3.4.3.2 to fix issues with copy and paste, see tinymce\'s site for details',
      ),
      '4.1.5' => array(
        '*' => 'Upgraded from version 3.3.8 to 3.4.2 to fix issues with IE9, see tinymce\'s site for details',
      ),
      '4.1.4' => array(
        'manifest.php' => 'Incremented version',
        'plugins/bbcode/editor_plugin.js' => 'Fixed linebreaks with BBCode',
        'plugins/bbcode/editor_plugin_src.js' => 'Fixed linebreaks with BBCode',
        'themes/advanced/image.htm' => 'Support for uploading image',
        'themes/advanced/upload.htm' => 'Support for uploading image',
        'themes/advanced/js/image.js' => 'Support for uploading image',
        'themes/advanced/skins/default/content.css' => 'Fixed the way paragraphs are displayed'
      ),
      '4.0.2' => array(
        '*' => 'Added language packs',
      ),
      '4.0.1' => array(
        '*' => 'Upgraded from version 3.2.4.1 to 3.3.8; See tinymce\'s site for details',
      ),
    ),
    'directories' => array(
      'externals/tinymce',
    )
  )
) ?>
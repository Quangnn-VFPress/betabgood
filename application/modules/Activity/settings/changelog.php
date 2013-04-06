<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: changelog.php 9934 2013-02-18 21:38:52Z john $
 * @author     John
 */
return array(
  '4.3.0' => array(
    'Api/Core.php' => 'Fixed issue with shared activity feed items',
    'controllers/IndexController.php' => 'Fixed XSS',
    'externals/styles/mobile.css' => 'Allow mobile photo upload',
    'Model/Helper/ItemChild.php' => 'Added',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/index/delete.tpl' => 'Fixed XSS',
    'widgets/feed/index.tpl' => 'Allow mobile photo upload',
  ),
  '4.2.9p1' => array(
    '/application/languages/en/activity.csv' => 'Added missing phrases',
    'externals/scripts/core.js' => 'Fixed error in feed with IE8',
    'Model/Action.php' => 'Fixed incorrect comment order',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
  ),
  '4.2.8' => array(
    'controllers/AjaxController.php' => 'Fixes Bug in Activity Feed when Video is playing and the Like or Comment link is clicked stops and minimizes the video',
    'controllers/IndexController.php' => 'Fixes Bug in Activity Feed when Video is playing and the Like or Comment link is clicked stops and minimizes the video',
    'externals/scripts/core.js' => 'Fixes Bug in Activity Feed when Video is playing and the Like or Comment link is clicked stops and minimizes the video',
    'externals/styles/main.css' => 'Fixes Bug in Activity Feed when Video is playing and the Like or Comment link is clicked stops and minimizes the video. ',
    'Form/Comment.php' => 'Fixes Bug in Activity Feed when Video is playing and Fixes Captcha enabled commenting leaves Captcha after submission',
    'Model/Action.php' => 'Added Share Action to Activity Feed',
    'Model/DbTable/Actions.php' => 'Added Share Action to Activity Feed',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my-upgrade-4.2.7-4.2.8.sql' => 'Added',
    'settings/my.sql' => 'Incremented version',
    'View/Helper/Activity.php' => 'Fixes Bug in Activity Feed when Video is playing',
    'View/Helper/ActivityLoop.php' => 'Allow Group owners to delete posts',
    'views/scripts/_activityComments.tpl' => 'Fixes Bug in Activity Feed when Video is playing',
    'views/scripts/_activityText.tpl' => 'Fixes Bug in Activity Feed when Video is playing and Allow Group owners to delete posts',
    'widgets/feed/Controller.php' => 'Added Share Action to Activity Feed',
    'widgets/feed/index.tpl' => 'Added Share Action to Activity Feed',
  ),
  '4.2.5' => array(
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
  ),
  '4.2.4' => array(
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Removes translation to activity titles in activity feeds',
  ),
  '4.2.3p1' => array(
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Adds translation to activity titles in activity feeds',
  ),
  '4.2.3' => array(
    'controllers/IndexController.php' => 'Fixes making a post when the privacy settings are not enabled',
    'Model/Action.php' => 'Fixes activity action error',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
  ),
  '4.2.2' => array(
    'Model/Action.php' => 'Fixed declaration compatibility error',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
  ),
  '4.2.1' => array(
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Fixed nl2br issue',
    'views/scripts/index/share.tpl' => 'Fixed javascript issue with Safari',
  ),
  '4.2.0' => array(
    'controllers/IndexController.php' => 'Adding a token to the activity feed post to reduce spam; implementing Janrain',
    'controllers/NotificationsController.php' => 'Fixed superfluous message in the error log',
    'externals/scripts/core.js' => 'Added namespace for Wibiya compatibility',
    'Form/Comment.php' => 'Fixed link enabling issue; added recaptcha support',
    'Model/DbTable/Actions.php' => 'Fixed error when action is missing object',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Fixed link enabling issue; fixed CSS issue with comment option list',
    'widgets/feed/Controller.php' => 'Adding a token to the activity feed post to reduce spam',
    'widgets/feed/index.tpl' => 'Adding a token to the activity feed post to reduce spam',
  ),
  '4.1.8p1' => array(
    'controllers/IndexController.php' => 'Adding documentation',
    'externals/scripts/core.js' => 'Fixed issue with auto-update',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Fixed issue with auto-update',
    'widgets/feed/index.tpl' => 'Fixed issue with auto-update',
  ),
  '4.1.8' => array(
    'Api/Core.php' => 'Refactored deprecated method calls',
    'Bootstrap.php' => 'Added static base URL for CDN support',
    'controllers/IndexController.php' => 'Removing deprecated routes; added like stat tracking',
    'controllers/NotificationsController.php' => 'Prevents exception',
    'externals/.htaccess' => 'Updated with far-future expires headers for static resources',
    'Model/Action.php' => 'Code formatting',
    'Model/DbTable/Actions.php' => 'Added detachFromActivity() method for removing attachments',
    'Plugin/Job/Maintenance/RebuildPrivacy.php' => 'Fixed issue when porting from task to job',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Added static base URL for CDN support',
    'views/scripts/notifications/index.tpl' => 'Added static base URL for CDN support',
    'widgets/feed/Controller.php' => 'Fixed issue where composer wouldn\'t show in some cases',
    'widgets/feed/index.tpl' => 'Added static base URL for CDN support; compatibility for AJAX page loader',
    'widgets/list-requests/index.tpl' => 'Removing deprecated routes',
  ),
  '4.1.7' => array(
    'controllers/AdminSettingsController.php' => 'Fixes issue with saving default email notifications when the plugin name contains a /',
    'controllers/AjaxController.php' => 'Code formatting',
    'controllers/IndexController.php' => 'Removing deprecated usage of $this->_helper->api()',
    'Model/DbTable/Notifications.php' => 'No photo icons in email notifications now pull icon from themes',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
  ),
  '4.1.6' => array(
    'controllers/IndexController.php' => 'Added twitter integration; fixed issues with facebook integration',
    'externals/images/twitter.png' => 'Added',
    'externals/images/twitter_inactive.png' => 'Added',
    'externals/styles/main.css' => 'Added styles',
    'Form/Share.php' => 'Added twitter integration',
    'Model/DbTable/Notifications.php' => 'Fixed broken image links in email notifications',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/index/share.tpl' => 'Added twitter integration',
  ),
  '4.1.5' => array(
    'controllers/IndexController.php' => 'Fixed issue of feed not rendering when plugins get disabled',
    'Model/Action.php' => 'Fixed issue of feed not rendering when plugins get disabled',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Fixed rare issue of who liked a comment not rendering',
    'widget/feed/index.tpl' => 'Fixed issue of feed not rendering when plugins get disabled',
    'widgets/feed/Controller.php' => 'Fixed issue of feed not rendering when plugins get disabled',
  ),
  '4.1.4' => array(
    'externals/styles/main.css' => 'Added styles',
    'externals/styles/mobile.css' => 'Added',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Moved ul from _activityText.tpl; Added li\'s around action link to help with developing themes; Delete link removed from comments in mobile',
    'widgets/feed/index.tpl' => 'Moved ul to _activityText.tpl',
  ),
  '4.1.3' => array(
    '/application/languages/en/activity.csv' => 'Added phrases',
    'controllers/AdminSettingsController.php' => 'Added controller for configuring default enabled notifications',
    'controllers/IndexController.php' => 'Fixed issue of undefined post_fail variable being logged; Activity post now sends member profile photo to Facebook if there is no attached image',
    'Model/DbTable/Actions.php' => 'Modifications to fix issues with activity privacy on profile pages',
    'Model/DbTable/NotificationTypes.php' => 'Added ability to configure default enabled notification types',
    'Plugin/Core.php' => 'Modifications to fix issues with activity privacy on profile pages',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my-upgrade-4.1.2-4.1.3.sql' => 'Added',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Fixed issue with moderators not being able to delete comments',
    'views/scripts/admin-settings/notifications.tpl' => 'Added',
    'views/scripts/notifications/index.tpl' => 'Added try/catch around requests',
  ),
  '4.1.2' => array(
    'controllers/IndexController.php' => 'Added the ability to like comments',
    'externals/scripts/core.js' => 'Added the ability to like comments',
    'externals/styles/main.css' => 'Added styles',
    'Model/Comment.php' => 'Added',
    'Model/DbTable/Comments.php' => 'Added the ability to like comments',
    'Model/DbTable/Likes.php' => 'Added the ability to like comments',
    'Model/Like.php' => 'Added',
    'settings/changelog.php' => 'Incremented version',
    'settings/content.php' => 'Added preliminary layout enhancements',
    'settings/manifest.php' => 'Incremented version',
    'settings/my-upgrade-4.1.1-4.1.2.sql' => 'Added',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Added the ability to like comments',
    'widget/feed/index.tpl' => 'Added the ability to like comments; Escaping translation for the phrase "Post Something..."',
  ),
  '4.1.1' => array(
    '/application/languages/en/activity.csv' => 'Fixed minor admin panel description typos',
    'controllers/AdminSettingsController.php' => 'Removed unnecessary route',
    'externals/.htaccess' => 'Added keywords; removed deprecated code',
    'externals/styles/main.css' => 'RTL improvements',
    'Model/DbTable/Actions.php' => 'Added code to facilitate feed filtering',
    'Model/DbTable/ActionTypes.php' => 'Added code to facilitate feed filtering',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my-upgrade-4.0.5p1-4.1.0.sql' => 'Fixed typo',
    'settings/my-upgrade-4.1.0-4.1.1.sql' => 'Added',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/admin-settings/general.tpl' => 'Removed unnecessary route',
    'views/scripts/admin-settings/index.tpl' => 'Added',
  ),
  '4.1.0' => array(
    '/application/languages/en/activity.csv' => 'Repairing double-quotes in language file',
    'controllers/AdminSettingsController.php' => 'Added notice when saving forms',
    'controllers/IndexController.php' => 'Facebook status are now run though html_entity_decode',
    'Form/Admin/Settings/ActionType.php' => 'Improved descriptions',
    'Form/Admin/Settings/General.php' => 'Moved type settings to another page',
    'Model/Action.php' => 'getHref() now returns proper link',
    'Model/DbTable/Actions.php' => 'Added back-end support for filtering the feed by item type',
    'Plugin/Core.php' => 'Allowed User_Model_User actions to be included into network stream',
    'Plugin/Job/Maintenance/RebuildPrivacy.php' => 'Added',
    'Plugin/Task/Maintenance/RebuildPrivacy.php' => 'Removed',
    'settings/changelog.php' => 'Incremented version',
    'settings/manifest.php' => 'Incremented version',
    'settings/my-upgrade-4.0.3-4.0.4.sql' => 'Backwards compatibility fix for tasks modifications',
    'settings/my-upgrade-4.0.5p1-4.1.0.sql' => 'Added',
    'settings/my.sql' => 'Incremented version',
    'View/Helper/Activity.php' => 'Fixed feed item moderation',
    'views/scripts/_activityText.tpl' => 'Fixed feed item moderation',
    'views/scripts/admin-settings/general.tpl' => 'Improved descriptions',
    'views/scripts/admin-settings/types.tpl' => 'Improved descriptions',
    'widgets/feed/Controller.php' => 'Fixed issue with selecting incorrect number of items',
    'widgets/feed/index.tpl' => 'Fixed issue with posting a status on mobile devices, such as the iPad and iPhone',
  ),
  '4.0.5p1' => array(
    'Model/Action.php' => 'Fixed issue where actions get indexed in global search',
    'Model/Notification.php' => 'Fixed issue where actions get indexed in global search',
    'settings/manifest.php' => 'Incremented version',
    'settings/my-upgrade-4.0.5-4.0.5p1.sql' => 'Added',
    'views/scripts/index/delete.tpl' => 'Fixed issue with incorrect layout after post',
    'widgets/feed/Controller.php' => 'Fixed issue with too many action items being displayed; fixed issue with duplicate items being display when viewing a specific feed item',
  ),
  '4.0.5' => array(
    'Form/Admin/Settings/ActionType.php' => 'Added',
    'Form/Admin/Settings/General.php' => 'Added more feed length options',
    'Model/DbTable/ActionSettings.php' => 'Fixes issues where disabled action types still show in the user settings page',
    'Model/DbTable/ActionTypes.php' => 'Fixes issues where disabled action types still show in the user settings page',
    'Model/DbTable/Notifications.php' => 'Added more variables for mail templates',
    'Model/Helper/Item.php' => 'Added handling for missing href',
    'Model/Helper/Translate.php' => 'Added no translate bit',
    'Model/Notification.php' => 'Typo in error message',
    'Plugin/Task/Maintenance/RebuildPrivacy.php' => 'Added idle support',
    'View/Helper/ActivityLoop.php' => 'Can now accept an array in addition to a rowset',
    'controllers/AdminSettingsController.php' => 'Added action for configuring action types',
    'controllers/IndexController.php' => 'Added auth for composer plugins; fixed context switch issues',
    'externals/images/nophoto_action_thumb_icon.png' => 'Added',
    'settings/changelog.php' => 'Added',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Moved some processing of actions to controller; fixed some errors when items are missing',
    'views/scripts/admin-settings/types.tpl' => 'Added',
    'views/scripts/notifications/index.tpl' => 'Fixed incorrect url that would prevent view more from working',
    'widgets/feed/Controller.php' => 'Improved user limit handling, should display the full feed length in most cases now',
    'widgets/feed/index.tpl' => 'Fixes composer javascript when feed is empty',
  ),
  '4.0.4' => array(
    'controllers/AdminSettingsController.php' => 'Fixed problem with disabling or enabling activity feed item types',
    'controllers/NotificationsController.php' => 'Moved pulldown update here',
    'externals/styles/main.css' => 'Improved RTL support',
    'Form/Admin/Settings/General.php' => 'Fixed problem with disabling or enabling activity feed item types',
    'Model/Helper/Body.php' => 'Added container around post body for future improved RTL support',
    'Plugin/Core.php' => 'Fixed issues with privacy in the feed when content is hidden from the public by admin settings',
    'Plugin/Task/Maintenance/RebuildPrivacy.php' => 'Added to fix privacy issues in the feed',
    'settings/manifest.php' => 'Incremented version',
    'settings/my-upgrade-4.0.3-4.0.4.sql' => 'Added',
    'settings/my.sql' => 'Incremented version',
    'views/scripts/_formActivityButton.tpl' => 'Removed deprecated code',
    'views/scripts/notifications/pulldown.tpl' => 'Moved pulldown update here',
    'views/scripts/widget/*' => 'Removing deprecated code',
    'widgets/feed/index.tpl' => 'Added missing translation; fixed smoothbox binding on view more; fixed incorrect inclusion of javascript files',
    '/application/languages/en/activity.csv' => 'Added phrases',
  ),
  '4.0.3' => array(
    'Model/DbTable/NotificationTypes.php' => 'Fixed bug with missing notification emails',
    'settings/manifest.php' => 'Incremented version',
    'settings/my.sql' => 'Incremented version',
    '/application/languages/en/activity.csv' => 'Added phrases',
  ),
  '4.0.2p1' => array(
    'Model/Helper/Item.php' => 'Fixed pluralization of updates text',
    'settings/manifest.php' => 'Incremented version',
  ),
  '4.0.2' => array(
    'controllers/IndexController.php' => 'Added missing authorization checks',
    'Model/DbTable/Actions.php' => 'Fixed bad IN clauses in query',
    'Model/Helper/Item.php' => 'Adds translation of item text in update notifications',
    'Plugin/Core.php' => 'Fixed several privacy issues',
    'settings/manifest.php' => 'Incremented version',
    'views/scripts/_activityText.tpl' => 'Added missing authorization checks',
    '/application/languages/en/activity.csv' => 'Adds translation of item text in update notifications',
  ),
  '4.0.1' => array(
    'Model/DbTable/Notifications.php' => 'Fixes problem with notifications from disabled modules',
    'Plugin/Core.php' => 'Fixes problem with properly detecting the page subject and handles items without parents properly',
    'settings/manifest.php' => 'Incremented version',
    'views/scripts/notifications/index.tpl' => 'Fixes problem with notifications from disabled modules',
    'widgets/list-requests/index.tpl' => 'Fixes problem with notifications from disabled modules',
  ),
) ?>
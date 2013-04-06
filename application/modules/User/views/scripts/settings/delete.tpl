<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: delete.tpl 9868 2013-02-12 21:50:45Z shaun $
 * @author     Steve
 */
?>

<?php if( $this->isLastSuperAdmin ):?>
  <div class="tip">
    <span>
      <?php echo $this->translate('This is the last super admin account. Please reconsider before deleting this account.'); ?>
    </span>
  </div>
<?php endif;?>

<?php echo $this->form->setAttrib('id', 'user_form_settings_delete')->render($this) ?>

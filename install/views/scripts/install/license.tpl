<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: license.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
 
 // 01.03.2013 - TrioxX
?>

<?php $this->headTitle($this->translate('Step %1$s', 1))->headTitle($this->translate('License')) ?>

<h1>
  <?php echo $this->translate('Step 1: Enter License Key') ?>
</h1>

<p>
  <?php echo $this->translate('Thank you for choosing SocialEngine to build your
    community! We know you\'re excited to get started, so we\'ll help you get
    through the install process as quickly as possible. Thank god, TrioxX
	has already generated a license key for you :)') ?>
</p>

<br />

<?php echo $this->form->render($this) ?>

<br />
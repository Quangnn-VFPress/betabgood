<?php
/**
 * SocialEngine - Signup Widget
 *
 * @category   Application_Bgood
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood.vn
 * @license    http://www.bgood.vn
 * @version    
 * @author     QuangNN
 */
?>

<?php if( !$this->noForm ): ?>

  <h3>
    <?php echo $this->translate('Do not have an account ? &nbsp;&nbsp;&nbsp; %1$sSign up%2$s', '<a href="'.$this->url(array(), "user_signup").'" rel="nofollow" title="Signup" id="Signup">', '</a>'); ?>
  </h3>

  <?php if( !empty($this->fbUrl) ): ?>
    <script type="text/javascript">
      var openFbLogin = function() {
        Smoothbox.open('<?php echo $this->fbUrl ?>');
      }
      var redirectPostFbLogin = function() {
        window.location.href = window.location;
        Smoothbox.close();
      }
    </script>
    <?php // <button class="user_facebook_connect" onclick="openFbLogin();"></button> ?>
  <?php endif; ?>
<?php endif; ?>

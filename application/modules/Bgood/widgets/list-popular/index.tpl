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

<ul>
  <?php foreach( $this->paginator as $user ): ?>
    <li>
      <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'popularmembers_thumb')) ?>
    </li>
  <?php endforeach; ?>
</ul>

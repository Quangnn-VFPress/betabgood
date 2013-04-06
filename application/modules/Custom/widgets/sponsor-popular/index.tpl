<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7481 2010-09-27 08:41:01Z john $
 * @author     John
 */
?>
<ul>
    <?php foreach($this->sponsor as $user)
    {
    ?>
	<li>
		<a class="newestmembers_thumb" href="/bgood/index.php/profile/<?php echo $user['username'];?>"><img class="thumb_icon item_photo_user  thumb_icon" alt="" src="<?php echo $user['avatar'];?>"/></a>
		<div class="newestmembers_info">
			<div class="newestmembers_name">
				<a href="/bgood/index.php/profile/<?php echo $user['username'];?>"><?php echo $user['displayname'];?></a>
			</div>
			<div class="newestmembers_date">
				*****
			</div>
            <div class="newestmembers_date">
				Đã tài trợ <?php echo $user['scholar']?> lần
			</div>
		</div>
	</li>
    <?php
    }
    ?>
</ul>
<table cellpadding="0" cellspacing="0" border="1" width="100%">
	<tr>
		<td>
            <h3 style="font-size: 12px;">Sinh viên</h3>
		</td>
        <td>
            <h3 style="font-size: 12px;">Hoạt động</h3>
		</td>
        <td>
            <h3 style="font-size: 12px;">Nhà tài trợ</h3>
		</td>
	</tr>
    <?php foreach ($this->paginator as $i=>$user){ ?>
    <tr style="background-color:#FFFFFF;">
        <td style="padding: 10px;">
            <p style="margin: 5px;">
                <a href="index.php/profile/<?php echo $user['username'];?>">
                    <img src="<?php echo $user['img']!='' ? $user['img']:'/bgood/application/modules/User/externals/images/nophoto_user_thumb_icon.png';?>"/>
                </a>
        	</p>
        	<div>
                <p>
        			<a href="index.php/profile/<?php echo $user['username'];?>"><?php echo $user['displayname'];?></a>
                </p>
        		<p>
                    <?php if($user['member_count']>0){?>
 			            Có <?php echo $user['member_count']?> bạn
                    <?php }else{?>
                        Chưa có bạn nào
                    <?php }?>
                </p>
                <div>
                    <p>
                        <?php if($user['rate']%2==0)
                        {
                            for($star=0;$star<($user['rate']/2);$star++)
                            { ?>
                                <img src="images/icon_star.png"/>
                            <?php 
                            }
                            for($star=0;$star<(5-($user['rate']/2));$star++)
                            {?>
                                <img src="images/icon_star_blur.png"/>
                            <?php
                            }
                        }else{
                            for($star=0;$star<($user['rate']/2)-1;$star++)
                            { ?>
                                <img src="images/icon_star.png"/>
                            <?php 
                            }?>
                                <img src="images/icon_star_half.png"/>
                            <?php for($star=0;$star<5-(($user['rate']/2)+1);$star++)
                            {
                            ?>
                                <img src="images/icon_star_blur.png"/>
                            <?php }
                        }
                        ?>
                    </p>
                    <?php if($user['amount']>0){ ?>
                    <p>
            			Đã nhận tài trợ <?php echo number_format($user['amount']);?> VND
                    </p>
                    <?php }?>
                </div>
            </div>
        </td>
        <td>
            <?php if(!$this->activity[$i] )
            { 
            ?>
                <div class="tip">
                  <span>
                    <?php echo $this->translate("Nothing has been posted here yet - be the first!") ?>
                  </span>
                </div>
            <?php 
            }else 
                echo $this->activity[$i]['activity'];
            ?>
		</td>
        <td>
            <?php if(count($user['sponsor'])==0){?>
                Chưa có nhà hảo tâm nào tài trợ
            <?php }else{
                foreach($user['sponsor'] as $i=>$sponsor)
                {
            ?>
                <a href="index.php/profile/<?php echo $user['sponsor_profile'][$i];?>" style="text-decoration: none;">
                    <img src="<?php echo $sponsor!='' ? $sponsor:'/bgood/application/modules/User/externals/images/nophoto_user_thumb_icon.png';?>"/>
                </a>
            <?php }
            }?>
		</td>
    </tr>
    <?php }
	?>
</table>
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
<style type="text/css">
.table
{
    background: url("/application/themes/bgood/images/top_bg.gif?c=11") repeat scroll 0 0 transparent;
    color: white;
    font-size: 15px;
    line-height: 20px;
    margin-bottom: 6px;
    padding: 5px;
}
tr{
    background-color:#FFFFFF;
}
div.progress {
width: 40px;
margin: 2px 5px 2px 0;
border: 1px solid #ccc; 
padding: 1px;
float: left;
background-color: white;
position:relative;
height:100px;
}

div.progress > div {
background-color: #5da2f5;
max-height: 100px;
width: 40px;
position:absolute;
bottom:1px;
color: black;
font-weight: bold;
} 
</style>
<script type="text/javascript">
var currentOrder = 'user_id';
var currentOrderDirection = 'DESC';
var changeOrder = function(order, default_direction)
{
	// Just change direction
	var req = new Request(
	{
		method: 'get',
		url: 'index.php/custom/index/browse',
		data: 
		{
			'fromAge':$('fromAge').value,
			'toAge':$('toAge').value,
			'gender':$('gender').value,
			'location':$('location').value,
			'division':$('division').value,
			'order' : order ,
			'order_direction':default_direction,
			'format':'html'
		},
		onComplete: function(response) { $('test').set('html', response);}
	}).send();
}
</script>
<div id="test">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	    <tr>
	        <td width="117px"><a onclick="javascript:changeOrder('displayname', '<?php echo ($this->values['order']=='displayname' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);"><h3 style="font-size: 12px;padding: 5px;">Sinh viên</h3></a></td>
	        <td width="80px"><a href="javascript:void(0);"><h3 style="font-size: 12px;padding: 5px;">Đã tài trợ</h3></a></td>
	        <td><a onclick="javascript:changeOrder('displayname', '<?php echo ($this->values['order']=='displayname' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);"><h3 style="font-size: 12px;padding: 5px;">Hồ sơ mới</h3></a></td>
	    </tr>
	    <?php foreach($this->paginator as $user ){
	       if($user['percentage']!=100)
           {
        ?>
	    <tr>
	        <td>
	            <div style="padding: 13px;">
	                <a href="index.php/profile/<?php echo $user['username'];?>">
	                    <img src="<?php echo $user['avatar'];?>" alt=""/>
	                </a>
	            </div>
	            <div style="float: left;padding: 5px;">
	                <p style="font-weight: bold;">
	                   <a href="index.php/profile/<?php echo $user['username'];?>"><?php echo $user['displayname'];?></a>
	                </p>
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
	                <p>
	    				Sinh năm <?php echo substr($user['dob'],0,-6);?>
	                </p>
	            </div>
	        </td>
	        <td style="padding: 10px; vertical-align: middle;">
	        	<div class="progress">          
					<div style="height: <?php echo $user['percentage'];?>%;text-align:center"><?php echo $user['percentage'];?>%</div>
				</div>
            </td>
	        <td>
	            <p><b>Học trường</b> : <?php echo $user['university_name']!='' ? $user['university_name']:$user['highschool_name'];?></p>
	            <p><b>Giới tính</b> : <?php echo $user['gender']==1 ? 'Nam':'Nữ';?></p>
                <p><b>Hoàn cảnh</b> : <?php if($user['parent_status']==0)
                                                echo 'Bố mẹ bình thường';
                                            elseif($user['parent_status']==1)
                                                echo 'Bố mẹ ly thân';
                                            elseif($user['parent_status']==2)
                                                echo 'Bố mẹ đã ly dị';
                ;?>
                </p>
	        </td>
	    </tr>
	    <?php }
        } ?>
	</table>
	<input id="fromAge" type="hidden" value="<?php echo $this->fromAge;?>"/>
	<input id="toAge" type="hidden" value="<?php echo $this->toAge;?>"/>
	<input id="division" type="hidden" value="<?php echo $this->division;?>"/>
	<input id="location" type="hidden" value="<?php echo $this->location;?>"/>
	<input id="gender" type="hidden" value="<?php echo $this->gender;?>"/>
</div>
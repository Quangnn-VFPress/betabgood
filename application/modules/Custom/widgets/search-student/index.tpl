<?php
/**
 * SocialEngine
 *
 * @category   Application_Widget
 * @package    Weather
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7562 2010-10-05 22:17:24Z john $
 * @author     John
 */
?>
<div class="browsemembers_criteria">
    <ul>
        <li>
            <span class="description">Tuổi</span>
            Từ
            <select id="fromAge">
                <option label=" " value=""> </option>
                <?php for($i=16;$i<30;$i++){ ?>
                <option label="<?php echo $i;?>" value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
            </select>
            Đến
            <select id="toAge">
                <option label=" " value=""> </option>
				<?php for($i=16;$i<30;$i++){ ?>
                <option label="<?php echo $i;?>" value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
            </select>
        </li>
        <li style="">
            <span><label>Giới tính</label></span>
            <select id="gender">
                <option value="-1">Tất cả</option>
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
            </select>
        </li>
        <li>
            <span>
                <label>Vùng</label>
            </span>
            <select id="location">
                <option value="0" selected="selected">Tất cả</option>
                <?php foreach($this->location as $l){?>
                <option value="<?php echo $l['location_id'];?>"><?php echo $l['location_name'];?></option>
                <?php }?>
            </select>
        </li>
        <li>
            <span>
                <label>Ngành học</label>
            </span>
            <select style="max-width: 138px;" id="division">
                <option value="0" selected="selected">Tất cả</option>
                <?php foreach($this->division as $d){?>
                <option value="<?php echo $d['division_id'];?>"><?php echo $d['division_name'];?></option>
                <?php }?>
            </select>
        </li>
        <div class="form-wrapper" id="done-wrapper">
            <div class="form-label" id="done-label">&nbsp;</div>
            <div class="form-element" id="done-element">
                <button type="button" id="submit">Tìm kiếm</button>
            </div>
        </div>
    </ul>
</div>
<img alt="" src="../bgood/externals/jquery/ajax-loader.gif" id="imgLoadingPopup" style="display: none;" />
<div class="ajaxLoadingPopupBackground" id="ajaxLoadingPopupBackground"></div>
<style type="text/css">
.ajaxLoadingPopupBackground
{
	display:none; 
	position:fixed; 
	position:absolute; 
	height:100%;
	width:100%;
	top:0;
	left:0;
	background:#000;
	z-index:100000000000000000000000;
}
</style>
<script type="text/javascript">
$('submit').addEvent('click', function()
{
	var location = $('location').value;
    var division = $('division').value;
    var gender = $('gender').value;
    var fromAge = $('fromAge').value;
    var toAge = $('toAge').value;
    if((fromAge!="")&&(toAge!="")&&(fromAge>=toAge))
    {
        alert("Tuổi bắt đầu phải nhỏ hơn tuổi kết thúc");
    }else{
    	var req = new Request(
		{
			method: 'get',
			url: 'index.php/custom/index/browse',
			data: {
                'location' : location,
                'division' : division,
                'gender' : gender,
                'fromAge' : fromAge,
                'toAge' : toAge,
                'format':'html'},
			onComplete: function(response) { $('test').set('html', response);}
    	}).send();
    }
});
</script>
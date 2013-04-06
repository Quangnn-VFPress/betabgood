<?php
/**
 * SocialEngine - Counter Widget
 *
 * @category   Application_Bgood
 * @package    Bgood
 * @copyright  Copyright 2012 Bgood.vn
 * @license    http://www.bgood.vn
 * @version    
 * @author     QuangNN
 */
?>

<div id='bgood_counter_widget'>
	<div id="counter_label_left">Ch&#250;ng t&#244;i &#273;&#227; huy &#273;&#7897;ng &#273;&#432;&#7907;c</div>
<div id="counter" style="float:left;"><input type="hidden" name="counter-value" value="0" /></div>
<script>
    var $j=jQuery.noConflict();function setUpdateTimer(){setInterval(checkMoreDownloads,10000);}
	function checkMoreDownloads()
	{$j.ajax({url:'/index.php/bgood/count-fund',success:function(data){if(typeof data!=='undefined')
	{if($j('#counter').flipCounter('getNumber').toString()!=data)
	{$j('#counter').flipCounter('startAnimation',{end_number:parseInt(data),duration:1000});}}}});}
	
    $j("#counter").flipCounter({number:900});
	$j("#counter").flipCounter({imagePath:"images/flipCounter-medium.png"});
	$j("#counter").flipCounter("startAnimation", {end_number:1000, easing:jQuery.easing.easeInOutCubic, duration:10000, onAnimationStopped:setUpdateTimer});	
</script>
</div>


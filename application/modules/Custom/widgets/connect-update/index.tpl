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
<div id="container" style="text-align: center;display: none;">
	<h3 style="padding:20px">
		<a href="javascript:void(0);" onclick="window.location.reload()">
			<span id="count"></span> new update
		</a>
	</h3>
</div>
<input type="hidden" value="<?php echo date('Y-m-d H:i:s');?>" id="curtime"/>
<script type="text/javascript">
var int=self.setInterval("clock()",5000);
var curtime = $('curtime').value;
function clock()
{
	var req = new Request(
	{
		method: 'get',
		url: 'index.php/custom/index/count',
		data: { 'curtime' : curtime ,'format':'html'},
		onComplete: function(response) 
		{
			if(response>0)
			{
				$('container').setStyle('display', 'block');
				$('count').set('html', response);
			}else{
				$('container').setStyle('display', 'none');
			}
		}
	}).send();
}
</script>
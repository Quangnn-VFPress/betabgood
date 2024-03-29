<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Music
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: create.tpl 9877 2013-02-13 03:10:05Z shaun $
 * @author     Steve
 */
?>

<div class='global_form'>
  <?php echo $this->form->render($this) ?>
</div>

<script type="text/javascript">
var playlist_id = <?php echo $this->playlist_id ?>;
function updateTextFields() {
  if ($('playlist_id').selectedIndex > 0) {
    $('title-wrapper').hide();
    $('description-wrapper').hide();
    $('search-wrapper').hide();
  } else {
    $('title-wrapper').show();
    $('description-wrapper').show();
    $('search-wrapper').show();
  }
}
// populate field if playlist_id is specified
if (playlist_id > 0) {
  $$('#playlist_id option').each(function(el, index) {
    if (el.value == playlist_id)
      $('playlist_id').selectedIndex = index;
  });
  updateTextFields();
}
</script>
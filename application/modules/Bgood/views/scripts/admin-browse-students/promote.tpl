<form method="post" action="index.php/admin/bgood/browse-students/promote/id/<?php echo $this->id;?>" class="global_form_popup" enctype="application/x-www-form-urlencoded">
	<div>
		<div>
			<h3>
				Promote user to student form
			</h3>
			<p class="form-description">
				Do you want to promote <?php echo $this->name;?> into Student ?  
			</p>
			<div class="form-elements">
				<div id="buttons-wrapper" class="form-wrapper">
					<fieldset id="fieldset-buttons">
						<button type="submit" id="submit" name="submit">
							Promote Student
						</button>
						or
						<a onclick="parent.Smoothbox.close();" href="javascript:void(0);" type="button" id="cancel" name="cancel">Cancel</a>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</form>
<div id="global_content">
	<h2>
		Quản lý tình nguyện viên
	</h2>
	<br/>
	<script type="text/javascript">
		var currentOrder = 'user_id';
		var currentOrderDirection = 'DESC';
		var changeOrder = function(order, default_direction) {
			// Just change direction
			if (order == currentOrder) {
				$('order_direction').value = (currentOrderDirection == 'ASC' ? 'DESC' : 'ASC');
			} else {
				$('order').value = order;
				$('order_direction').value = default_direction;
			}
			$('filter_form').submit();
		}

		function multiModify() {
			var multimodify_form = $('multimodify_form');
			if (multimodify_form.submit_button.value == 'delete') {
				return confirm('Are you sure you want to delete the selected user accounts?');
			}
		}

		function selectAll() {
			var i;
			var multimodify_form = $('multimodify_form');
			var inputs = multimodify_form.elements;
			for (i = 1; i < inputs.length - 1; i++) {
				if (!inputs[i].disabled) {
					inputs[i].checked = inputs[0].checked;
				}
			}
		}
	</script>    
	<div class="admin_search">
		<div class="clear">
			<div class="search">
				<form action="index.php/admin/bgood/browse-volunteers" method="get" class="global_form_box" id="filter_form">
					<div>
						<label for="displayname">
							Displayname
						</label>
						<input type="text" value="<?php echo $this->values['displayname'];?>" id="displayname" name="displayname"/>
					</div>
					<div>
						<label class="optional" for="username">
							Username
						</label>
						<input type="text" value="<?php echo $this->values['username'];?>" id="username" name="username"/>
					</div>
					<div>
						<label class="optional" for="email">
							Email
						</label>
						<input type="text" value="<?php echo $this->values['email'];?>" id="email" name="email"/>
					</div>
					<div>
						<div class="buttons">
							<button type="submit">
								Search
							</button>
						</div>
					</div>
                    <input id="order" type="hidden" value="<?php echo $this->values['order'];?>" name="order"/>
                    <input id="order_direction" type="hidden" value="<?php echo $this->values['order_direction'];?>" name="order_direction"/>
				</form>
			</div>
		</div>
	</div>
	<br/>
	<div class="admin_table_form">
		<form onsubmit="multiModify()" action="index.php/admin/user/manage/multi-modify" method="post" id="multimodify_form">
			<table class="admin_table">
				<thead>
					<tr>
						<th style="width: 1%;">
							<input type="checkbox" class="checkbox" onclick="selectAll()"/>
						</th>
                        <th style="width: 1%;">
							<a href="javascript:void(0);">Avatar</a>
						</th>
						<th>
							<a onclick="javascript:changeOrder('displayname', '<?php echo ($this->values['order']=='displayname' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Display Name</a>
						</th>
						<th>
							<a onclick="javascript:changeOrder('username', '<?php echo ($this->values['order']=='username' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Username</a>
						</th>
						<th>
							<a onclick="javascript:changeOrder('email', '<?php echo ($this->values['order']=='email' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Email</a>
						</th>
                        <th style="width: 1%;">
							Trạng thái
						</th>
						<th style="width: 1%;">
							Thao tác
						</th>
					</tr>
				</thead>
				<tbody>
                    <?php foreach($this->students as $student){ ?>
					<tr>
						<td>
							<input type="checkbox" value="1"/>
						</td>
						<td>
                            <img src="<?php echo $student['avatar'];?>"/>
						</td>
						<td class="admin_table_bold">
							<a target="_blank" href="index.php/profile/<?php echo $student['username'];?>">
                                <?php echo $student['displayname'];?>
                            </a>
						</td>
						<td class="admin_table_user">
							<a target="_blank" href="index.php/profile/<?php echo $student['username'];?>">
                                <?php echo $student['username'];?>
                            </a>
						</td>
						<td class="admin_table_email">
							<a href="mailto:<?php echo $student['email'];?>"><?php echo $student['email'];?></a>
						</td>
                        <td class="admin_table_options">
                        	<?php echo $student['volunteer_id'] ? 'Đã kích hoạt' : 'Chưa kích hoạt'; ?>
                        </td>
						<td class="admin_table_options">
                        	<?php if(!$student['volunteer_id']) { ?>
                            <a href="index.php/admin/bgood/browse-sponsors/promote?id=<?php echo $student['user_id'];?>" class="smoothbox">
                                Promote
                            </a>
                            <?php } ?>
						</td>
					</tr>
                    <?php }?>
				</tbody>
			</table>
			<br/>
			<div class="buttons">
                <?php if($this->values['actived']!='0'){?>
                <button value="block" name="submit_button" type="submit">
					Block Selected
				</button>
                <?php }?>
                <?php if($this->values['actived']!='1'){?>
				<button value="active" name="submit_button" type="submit">
					Active Selected
				</button>
                <?php }?>
			</div>
		</form>
	</div>
</div>

<div id="global_content">
	<h2>
		Thống kê hệ thống
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

		function selectAll() {
			var i;
			var multimodify_form = $('multimodify_form');
			var inputs = multimodify_form.elements;
			for (i = 1; i < inputs.length; i++) {
				if (!inputs[i].disabled) {
					inputs[i].checked = inputs[0].checked;
				}
			}
		}
	</script>    
	<br/>
	<div class="admin_table_form">
		<form action="index.php/admin/bgood/browse-finance" method="post" id="multimodify_form">
			<table class="admin_table">
				<thead>
					<tr>
						<th style="width: 1%;">
							<input type="checkbox" class="checkbox" onclick="selectAll()"/>
						</th>
						<th>
							<a onclick="javascript:changeOrder('check_date', '<?php echo ($this->values['order']=='check_date' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Ngày chuyển</a>
						</th>
                        <th>
							<a onclick="javascript:changeOrder('expired_date', '<?php echo ($this->values['order']=='expired_date' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Ngày hết hạn</a>
						</th>
						<th>
							<a onclick="javascript:changeOrder('amount', '<?php echo ($this->values['order']=='amount' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Số lượng</a>
						</th>
						<th>
							<a onclick="javascript:changeOrder('student_id', '<?php echo ($this->values['order']=='student_id' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Tên SV</a>
						</th>
                        <th>
							<a onclick="javascript:changeOrder('sponsor_id', '<?php echo ($this->values['order']=='sponsor_id' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Nhà tài trợ</a>
						</th>
                        <th>
							<a onclick="javascript:changeOrder('status', '<?php echo ($this->values['order']=='status' && $this->values['order_direction']=='ASC')?'DESC':'ASC';?>');" href="javascript:void(0);">Trạng thái</a>
						</th>
                        <th style="width: 1%;">
							Thao tác
						</th>
					</tr>
				</thead>
				<tbody>
                    <?php foreach($this->finances as $finance){ ?>
					<tr>
						<td>
							<input type="checkbox" value="1"/>
						</td>
						<td class="admin_table_bold">
                            <?php echo date('d/m/Y' , strtotime($finance['check_date']));?>
						</td>
                        <td class="admin_table_bold">
                            <?php echo date('d/m/Y' , strtotime($finance['expired_date']));?>
						</td>
						<td class="admin_table_user">
                            <?php echo number_format($finance['amount']);?>
						</td>
						<td class="admin_table_email">
							<?php echo $finance['student_name'];?>
						</td>
                        <td class="nowrap">
							<?php echo $finance['sponsor_name'];?>
						</td>
                        <td class="nowrap">
							<?php echo $finance['status'] == '0' ? 'Hoàn tất' : 'Treo';?>
						</td>
						<td class="admin_table_options">
							<a href="index.php/admin/bgood/browse-finance/active?id=<?php echo $finance['id'];?>" class="smoothbox">
                                Xác nhận
                            </a>
                            &nbsp;|&nbsp;
                            <a href="index.php/admin/bgood/browse-finance/delete?id=<?php echo $finance['id'];?>" class="smoothbox">
                                Xóa
                            </a>
						</td>
					</tr>
                    <?php }?>
				</tbody>
			</table>			
		</form>
	</div>
</div>

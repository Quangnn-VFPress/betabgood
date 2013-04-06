<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td class="td-label bold text-center ver-middle"><a onclick="alert('sdfd');">#</a></td>
        <td class="td-label bold text-center ver-middle"><a onclick="alert('sdfd');">Tên sinh viên</a></td>
        <td class="td-label bold text-center ver-middle" width="230"><a onclick="alert('sdfd');">Đánh giá</a></td>
        <td class="td-label bold text-center ver-middle"><a onclick="alert('sdfd');">% đã nhận tài trợ</a></td>
        <td class="td-label bold text-center ver-middle"><a onclick="alert('sdfd');">Hồ sơ mới</a></td>
        <td class="td-label bold text-center ver-middle"><a onclick="alert('sdfd');">Deadline</a></td>
    </tr>
    <?php $index=0;
    foreach($this->paginator as $user ): ?>
    <tr <?php echo $index==0 ? 'style="background-color:grey;"':'style="background-color:pink;"'?>>
        <td class="ver-middle text-center"><?php echo $index+1;?></td>
        <td class="ver-middle text-center"><?php echo $this->htmlLink($this->viewer()->getHref(), $this->itemPhoto($user, 'thumb.icon','',array('align'=>'left','class'=>'mar20'))) ?></td>
        <td class="pad5">
            <div>
                <p>
                    Họ tên : <?php echo $user->displayname;?>
                </p>
                <p>
					Giới tính : Nam
                </p>
				<p>
					Sinh năm : 1980
                </p>
                <p>
					Rating : *****
                </p>
				Hoàn cảnh : Brief
			</div>
        </td>
        <td class="ver-middle text-center">80%</td>
        <td class="ver-middle text-center">Hồ sơ mới</td>
        <td class="ver-middle text-center">vô hạn</td>
    </tr>
    <?php $index++;
    endforeach; ?>
</table>

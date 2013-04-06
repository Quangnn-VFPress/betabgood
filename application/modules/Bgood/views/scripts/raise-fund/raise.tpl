<!--<script src="/externals/jquery/jquery-1.7.min.js"></script>-->
<form enctype="application/x-www-form-urlencoded" class="global_form_popup" action="/index.php/bgood/raise-fund/raise/id/<?php echo $this->student['user_id']; ?>/format/smoothbox?format=smoothbox" method="post">
<div id="global_content">
	<h2>
		Nhập thông tin tài trợ
	</h2>    
	<br/>
    <div class="thong-tin-sinh-vien">
        <h4>Thông tin sinh viên</h4>
        <div class="text-left-left">
            <div>Họ và tên</div>
            <div>Số hiệu sinh viên</div>
        </div>
        <div class="text-right-left">
            <div><?php echo $this->student['displayname']; ?></div>
            <div><?php echo $this->student['student_id']; ?></div>
        </div><br /><br />
        <h4>Thông tin vắn tắt</h4>
        <h5>Thu nhập trung bình hàng tháng cho sinh viên</h5>
        <div class="text-left-left">
            <div>Gia đình tài trợ (VND/tháng):</div>
            <div>Làm thêm (VND/tháng)</div>
            <div>Học bổng (VND/tháng)</div>
            <div>Từ nguồn khác (VND/tháng):</div>
        </div>
        <div class="text-right-left">
            <div><?php echo number_format($this->student['income_family']); ?></div>
            <div><?php echo number_format($this->student['income_job']); ?></div>
            <div><?php echo number_format($this->student['income_scholar']); ?></div>
            <div><?php echo number_format($this->student['income_other']); ?></div>
        </div><br /><br />
        <h5>Chi phí trung bình hàng tháng của sinh viên</h5>
        <div class="text-left-left">
            <div>Học phí (VND/tháng):</div>
            <div>Chi phí thuê nhà (VND/tháng):</div>
            <div>Chi phí sinh hoạt (VND/tháng):</div>
            <div>Chi phí khác (VND/tháng):</div>
        </div>
        <div class="text-right-left">
            <div><?php echo number_format($this->student['spend_school_fee']); ?></div>
            <div><?php echo number_format($this->student['spend_house_rent']); ?></div>
            <div><?php echo number_format($this->student['spend_living']); ?></div>
            <div><?php echo number_format($this->student['spend_other']); ?></div>
        </div>
    </div>
    
    <div class="thong-tin-tai-tro">
        <h4>Thông tin tài trợ</h4>
        <h5>(Kỳ thanh toán của Bgood.vn là vào ngày 10 hàng tháng)</h5>
        <div class="text-left-right">
            <div>Tên đợt tài trợ</div>
            <div>Tổng số tiền cần tài trợ</div>
            <div>Tổng số tiền đã có cam kết tài trợ</div>
            <!-- 
            <h5>Trong đó:</h5><br />
            <div>Tổng số tiền đã chuyển thành công</div>
            <div>Tổng số tiền đang chờ</div>
            -->            
            <!--<h5>Tài trợ:</h5><br />-->
            <div>Thời hạn tài trợ</div>
            <div>Số tiền còn thiếu</div>
            <div>Số tiền nhận tài trợ</div>
            <div>Ngày thanh toán dự kiến</div>
            <div>(Kiểu : ngày / tháng / năm)</div>
            <div>Lời nhắn:</div>
            <h5>Lựa chọn phương thức tài trợ</h5>
            <br />
            <div>
                <input type="radio" name="sponsor_type" value="1" style="margin-top:5px;" />Phương án 1: Tài trợ trực tiếp <br />
            
                <div class="sponsor-way" id="sponsor-way-1-1">
                    <!-- Truong hop SV da co ma TK NH -->
                    <div class="sponsor-title">Thông tin chuyển khoản</div>
                    <div>Người hưởng : </div>
                    <div>Số tài khoản : </div>
                    <div>Tại Ngân hàng: </div>
                    <div>Chi nhánh: </div>
                    <div>Nội dung chuyển khoản: </div>
                </div>
                
                <div class="sponsor-way" id="sponsor-way-1-2" style="display:none;">
                    <!-- Truong hop SV chua co ma TK NH -->
                    <div>Hiện tại sinh viên này chưa có số tài khoản, chúng tôi sẽ liên hệ và báo lại cho bạn trong vòng 1 ngày.
                    <br />Hoặc bạn có thể tài trợ qua Bgood thì vui lòng chọn phương án 2. </div>
                </div>
            </div>    
            <h5><button type="submit" id="submit" name="submit">Tài trợ</button></h5>     
        </div>
        <div class="text-right-right">
            <div><?php echo $this->student['fund_name']; ?></div>
            <div><?php echo number_format($this->student['fund_amount']); ?></div>
            <div><?php echo number_format($this->funds['total_amount']); ?></div>
            <!--
            <h5></h5><br />
            <div><?php echo number_format($this->funds['success_amount']); ?></div>
            <div><?php echo number_format($this->funds['pending_amount']); ?></div>
            
            <h5></h5><br />-->
            <div><?php echo date_format(date_create($this->student['expired_date']),'d/m/Y'); ?></div>
            <div><?php echo number_format($this->funds['remain_amount']); ?></div>
            <div><input type="text" name="sponsor_amount" id="sponsor_amount" size="20" class="sponsor_input" /></div>
            <!--<div><input name="date1" id="date1" class="date-pick dp-applied"><a href="#" class="dp-choose-date" title="Choose date">Choose date</a></div>-->
            <div><input type="text" name="sponsor_date" id="sponsor_date" size="20" class="sponsor_input" /></div>
            <div>&nbsp;</div>
            <div><input type="text" size="20" name="sponsor_content" /></div>
            <div>&nbsp;</div>
            <div>
                <input type="radio" name="sponsor_type" value="2" style="margin-top:5px;" />Phương án 2: Tài trợ qua Bgood <br />
                
                <div class="sponsor-way" id="sponsor-way-2-1" style="display:none;">
                    <!-- Tai tro qua Bgood -->
                    <div>Tài trợ trực tiếp qua thẻ ATM, Visa, Master hoặc các Ví điện tử</div>
                </div>
                <div class="sponsor-way" id="sponsor-way-2-2" style="display:none;">
                    <!-- Tai tro qua Bgood -->
                    <div class="sponsor-title">Chuyển khoản Ngân hàng</div>
                    <div>Thông tin chuyển khoản:</div> 
                    <div>Người hưởng: Quỹ Bgood</div>
                    <div>Số tài khoản:  yyy</div>
                    <div>Tại ngân hàng: xxx</div>
                    <div>Nội dung chuyển khoản: Tên Sponsor tài trợ cho Tên SV/Số ID với số tiền:</div> 
                </div>
                <div class="sponsor-way" id="sponsor-way-2-3">
                    <!-- Tai tro qua Bgood -->
                    <div class="sponsor-title">Chuyển tiền mặt</div>
                    <div>Địa chỉ tài trợ tiền mặt:</div>
                    <div>Chuyển đến ông Nguyễn Minh Đức</div>
                    <div>Số điện thoại liên hệ: </div>
                    <div>Địa chỉ: 18 Núi Trúc, Ba Đình, Hà Nội</div>
                </div>     
              </div>
        </div>
    </div>
 </div>
</form>
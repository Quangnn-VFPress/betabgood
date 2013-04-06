		<style>
			.tabs li {
				list-style:none;
				display:inline;
			}

			.tabs a {
				padding:5px 10px;
				display:inline-block;
				background:#666;
				color:#fff;
				text-decoration:none;
			}

			.tabs a.active {
				background:#fff;
				color:#000;
			}

		</style>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>
			// Wait until the DOM has loaded before querying the document
			$(document).ready(function(){
				$('ul.tabs').each(function(){
					// For each set of tabs, we want to keep track of
					// which tab is active and it's associated content
					var $active, $content, $links = $(this).find('a');

					// If the location.hash matches one of the links, use that as the active tab.
					// If no match is found, use the first link as the initial active tab.
					$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					$active.addClass('active');
					$content = $($active.attr('href'));

					// Hide the remaining content
					$links.not($active).each(function () {
						$($(this).attr('href')).hide();
					});

					// Bind the click event handler
					$(this).on('click', 'a', function(e){
						// Make the old tab inactive.
						$active.removeClass('active');
						$content.hide();

						// Update the variables with the new link and content
						$active = $(this);
						$content = $($(this).attr('href'));

						// Make the tab active.
						$active.addClass('active');
						$content.show();

						// Prevent the anchor's default click action
						e.preventDefault();
					});
				});
			});
		</script>
        	<ul class='tabs'>
			<li><a href='#tab1'>Ph&#7847;n 1: Th&#244;ng tin v&#7873; sinh vi&#234;n</a></li>
			<li><a href='#tab2'>Ph&#7847;n 2: Tr&#236;nh &#273;&#7897; h&#7885;c v&#7845;n</a></li>
			<li><a href='#tab3'>Ph&#7847;n 3: Th&#244;ng tin gia &#273;&#236;nh</a></li>
            <li><a href='#tab4'>Ph&#7847;n 4: Vi&#7879;c l&#224;m th&#234;m</a></li>
		</ul>              
		<div id='tab1'>
			<table width="100%" cellpadding="5" cellspacing="5" class="promote-user">
              <tr>
                <td width="295">H&#236;nh 3x4</td>
                <td width="361">
                  <label for="btnUploadFile">Upload</label>
                  <input type="file" name="btnUploadFile" id="btnUploadFile" />
              </td>
              </tr>
              <tr>
                <td width="295">H&#7885; t&#234;n:</td>
                <td width="361">
                  <input type="text" name="txtName" id="txtName" width="250" />
                </td>
              </tr>
              <tr>
                <td>Gi&#7899;i t&#237;nh: </td>
                <td><select name="lstGender" id="lstGender">
                  <option value="0">Nam</option>
                  <option value="1">N&amp;#7919;</option>
                </select></td>
              </tr>
              <tr>
                <td width="295">Ng&#224;y th&#225;ng n&#259;m sinh:  </td>
                <td width="361">
                <input type="text" name="txtDay" id="txtDay" style="width:50px;" />
                  <select name="lstMonth" id="lstMonth">
                    <option value="Th&#225;ng 1" selected>Th&#225;ng 1</option>
                    <option value="Th&#225;ng 2"  >Th&#225;ng 2</option>
                    <option value="Th&#225;ng 3" >Th&#225;ng 3</option>
                    <option value="Th&#225;ng 4" >Th&#225;ng 4</option>
                    <option value="Th&#225;ng 5" >Th&#225;ng 5</option>
                    <option value="Th&#225;ng 6" >Th&#225;ng 6</option>
                    <option value="Th&#225;ng 7" >Th&#225;ng 7</option>
                    <option value="Th&#225;ng 8" >Th&#225;ng 8</option>
                    <option value="Th&#225;ng 9" >Th&#225;ng 9</option>
                    <option value="Th&#225;ng 10" >Th&#225;ng 10</option>
                    <option value="Th&#225;ng 11" >Th&#225;ng 11</option>
                    <option value="Th&#225;ng 12" >Th&#225;ng 12</option>
                  </select>
                <input type="text" name="txtYear" id="txtYear" style="width:50px;" /></td>
              </tr>
              <tr>
                <td>N&#417;i sinh:</td>
                <td>
                  <select name="lstHomeTown" id="lstHomeTown" style="width:100px">
                  </select>
                </td>
              </tr>
              <tr>
                <td>S&#7889; CMND:</td>
                <td><input type="text" name="txtIDNo" id="txtIDNo" width="250" /></td>
              </tr>
              <tr>
                <td width="295">&#272;&#7883;a ch&#7881; th&#432;&#7901;ng tr&#250;:</td>
                <td width="361"><input type="text" name="txtAddress" id="txtAddress" width="250" /></td>
              </tr>
              <tr>
                <td width="295">&#272;&#7883;a ch&#7881; li&#234;n l&#7841;c (c&#243; th&#7875; nh&#7853;n th&#432; t&#7915; b&#432;u &#273;i&#7879;n): </td>
                <td width="361"><input type="text" name="txtAddress2" id="txtAddress2" width="250" /></td>
              </tr>
              <tr>
                <td width="295">D&#226;n t&#7897;c:</td>
                <td width="361"><input type="text" name="txtEthenic" id="txtEthenic" width="250" /></td>
              </tr>
              <tr>
                <td>&#272;i&#7879;n tho&#7841;i (&#273;&#7875; li&#234;n l&#7841;c v&#7899;i sinh vi&#234;n nhanh nh&#7845;t):      </td>
                <td><input type="text" name="txtTel1" id="txtTel1" width="250" /></td>
              </tr>
              <tr>
                <td>C&#7911;a</td>
                <td><input type="text" name="txtTel1Name" id="txtTel1Name" width="250" /></td>
              </tr>
              <tr>
                <td>&#272;i&#7879;n tho&#7841;i: </td>
                <td><input type="text" name="txtTel2" id="txtTel2" width="250" /></td>
              </tr>
              <tr>
                <td>C&#7911;a
                (ghi r&#245; s&#7889; &#273;i&#7879;n tho&#7841;i l&#224; c&#7911;a sinh vi&#234;n hay ng&#432;&#7901;i th&#226;n hay b&#7841;n b&#232; hay nh&#224; tr&#7885;)</td>
                <td><input type="text" name="txtTel2Name" id="txtTel2Name" width="250" /></td>
              </tr>
              <tr>
                <td>E-mail (b&#7855;t bu&#7897;c):    </td>
                <td><input type="text" name="txtEmail" id="txtEmail" width="250" /></td>
              </tr>
              </table>
		</div>
		<div id='tab2'>
			<table width="100%" cellpadding="5" cellspacing="5" class="promote-user">
            <tr>
                <td>T&#234;n tr&#432;&#7901;ng &#273;&#7841;i h&#7885;c/cao &#273;&#7859;ng :</td>
                <td><input type="text" name="txtSchool" id="txtSchool" width="250" /></td>
              </tr>
              <tr>
                <td>Ni&#234;n kh&#243;a</td>
                <td><input type="text" name="txtSchoolYear" id="txtSchoolYear" width="250" /></td>
              </tr>
              <tr>
                <td>Ng&#224;nh h&#7885;c :</td>
                <td><input type="text" name="txtSector" id="txtSector" width="250" /></td>
              </tr>
              <tr>
                <td>L&#7899;p h&#7885;c:</td>
                <td><input type="text" name="txtClass" id="txtClass" width="250" /></td>
              </tr>
              <tr>
                <td>M&#227; s&#7889; SV:</td>
                <td><input type="text" name="txtStudentId" id="txtStudentId" width="250" /></td>
              </tr>
              <tr>
                <td>K&#7871;t qu&#7843; h&#7885;c t&#7853;p khi l&#224; sinh vi&#234;n:    </td>
                <td><input type="text" name="txtStudenResult" id="txtStudenResult" width="250" /></td>
              </tr>
              <tr>
                <td>T&#234;n tr&#432;&#7901;ng c&#7845;p 3</td>
                <td><input type="text" name="txtHighSchoolName" id="txtHighSchoolName" width="250" /></td>
              </tr>
              <tr>
                <td>T&#7881;nh/Th&#224;nh ph&#7889;</td>
                <td><input type="text" name="txtHighSchoolCity" id="txtHighSchoolCity" width="250" /></td>
              </tr>
              <tr>
                <td>Qu&#7853;n/Huy&#7879;n:</td>
                <td><input type="text" name="txtHighSchoolDistrict" id="txtHighSchoolDistrict" width="250" /></td>
              </tr>
              <tr>
                <td colspan="2"><h4>K&#7871;t qu&#7843; h&#7885;c t&#7853;p (&#273;i&#7875;m trung b&#236;nh t&#7915;ng n&#259;m c&#7911;a l&#7899;p    10, 11, 12) :</h4></td>
              </tr>
              <tr>
                <td>L&#7899;p 10 :</td>
                <td><input type="text" name="txtHighSchoolResult10" id="txtHighSchoolResult10" width="250" /></td>
              </tr>
              <tr>
                <td>L&#7899;p 11 :</td>
                <td><input type="text" name="txtHighSchoolResult" id="txtHighSchoolResult11" width="250" /></td>
              </tr>
              <tr>
                <td>L&#7899;p 12 :</td>
                <td><input type="text" name="txtHighSchoolResult2" id="txtHighSchoolResult12" width="250" /></td>
              </tr>
              <tr>
                <td>&#272;i&#7875;m thi &#273;&#7841;i h&#7885;c:</td>
                <td><input type="text" name="txtUniversityResult" id="txtHighSchoolResult" width="250" /></td>
              </tr>
              <tr>
                <td>Th&#224;nh t&#237;ch h&#7885;c t&#7853;p kh&#225;c (c&#225;c gi&#7843;i th&#432;&#7903;ng c&#225;c ho&#7841;t &#273;&#7897;ng) :</td>
                <td><input type="text" name="txtOtherResult" id="txtHighSchoolResult2" width="250" /></td>
              </tr>
              <tr>
                <td>Gi&#7845;y ch&#7913;ng nh&#7853;n &#273;&#237;nh k&#232;m:</td>
                <td>
                      <p>
                        <select name="lstMonth2" id="lstMonth2">
                          <option value="0" selected>B&#7843;ng th&#224;nh t&#237;ch h&#7885;c t&#7853;p</option>
                          <option value="1"  >T&#7921; thu&#7853;t v&#7873; b&#7843;n th&#226;n</option>
                          <option value="2" >Th&#432; gi&#7899;i thi&#7879;u</option>
            </select>
                  </p>
                      </td>
              </tr>
              </table>
		</div>
		<div id='tab3'>
            <table width="100%" cellpadding="5" cellspacing="5" class="promote-user">
              <tr>
                <td>H&#7885; v&#224; t&#234;n b&#7889;</td>
                <td><input type="text" name="txtFatherName" id="txtFatherName" width="250" /></td>
              </tr>
              <tr>
                <td>N&#259;m sinh: </td>
                <td><input type="text" name="txtFatherDOB" id="txtFatherDOB" width="100" /></td>
              </tr>
              <tr>
                <td>H&#7885;c v&#7845;n:</td>
                <td>
                    <select name="lstFatherEducation" id="lstFatherEducation">
                  <option value="Kh&#244;ng &#273;i h&#7885;c">Kh&#244;ng &#273;i h&#7885;c</option>
                  <option value="Ti&#7875;u h&#7885;c">Ti&#7875;u h&#7885;c</option>
                  <option value="THCS">THCS</option>
                  <option value="THPT">THPT</option>
                  <option value="&#272;&#7841;i h&#7885;c">&#272;&#7841;i h&#7885;c</option>
                  <option value="Kh&#244;ng bi&#7871;t">Kh&#244;ng bi&#7871;t</option>
                </select></td>
              </tr>
              <tr>
                <td>Ngh&#7873; nghi&#7879;p c&#7911;a cha</td>
                <td>
                    <input type="text" name="txtFatherJob" id="txtFatherJob" width="250" />
                </td>
              </tr>	
              <tr>
                <td>N&#417;i l&#224;m vi&#7879;c c&#7911;a cha</td>
                <td>
                    <input type="text" name="txtFatherJobLocation" id="txtFatherJobLocation" width="250" />
                </td>
              </tr>	
              <tr>
                <td>Thu nh&#7853;p</td>
                <td>
                    <input type="text" name="txtFatherIncome" id="txtFatherIncome" width="250" />
                </td>
              </tr>	
              <tr>
                <td>S&#7913;c kh&#7887;e</td>
                <td>
                     <select name="txtFatherHealth" id="txtFatherHealth">
                  <option value="B&#236;nh th&#432;&#7901;ng">B&#236;nh th&#432;&#7901;ng</option>
                  <option value="&#272;&#227; m&#7845;t">&#272;&#227; m&#7845;t</option>
                  <option value="Kh&#244;ng c&#243; cha / Cha b&#7887; &#273;i t&#7915; l&#226;u">Kh&#244;ng c&#243; cha / Cha b&#7887; &#273;i t&#7915; l&#226;u</option>
                  <option value="B&#7879;nh hi&#7875; ngh&#232;o">B&#7879;nh hi&#7875; ngh&#232;o</option>
                  <option value="M&#7845;t s&#7913;c lao &#273;&#7897;ng">M&#7845;t s&#7913;c lao &#273;&#7897;ng</option>
                  <option value="B&#7879;nh m&#227;n t&#237;nh">B&#7879;nh m&#227;n t&#237;nh</option>
                </select>
                </td>
              </tr>	
              <tr>
                <td>H&#7885; v&#224; t&#234;n m&#7865;</td>
                <td><input type="text" name="txtMotherName" id="txtMotherName" width="250" /></td>
              </tr>
              <tr>
                <td>N&#259;m sinh: </td>
                <td><input type="text" name="txtMotherDOB" id="txtMotherDOB" width="100" /></td>
              </tr>
              <tr>
                <td>H&#7885;c v&#7845;n:</td>
                <td>
                    <select name="lstMotherEducation" id="lstMotherEducation">
                  <option value="Kh&#244;ng &#273;i h&#7885;c">Kh&#244;ng &#273;i h&#7885;c</option>
                  <option value="Ti&#7875;u h&#7885;c">Ti&#7875;u h&#7885;c</option>
                  <option value="THCS">THCS</option>
                  <option value="THPT">THPT</option>
                  <option value="&#272;&#7841;i h&#7885;c">&#272;&#7841;i h&#7885;c</option>
                  <option value="Kh&#244;ng bi&#7871;t">Kh&#244;ng bi&#7871;t</option>
                </select></td>
              </tr>
              <tr>
                <td>Ngh&#7873; nghi&#7879;p c&#7911;a m&#7865;</td>
                <td>
                    <input type="text" name="txtMotherJob" id="txtMotherJob" width="250" />
                </td>
              </tr>	
              <tr>
                <td>N&#417;i l&#224;m vi&#7879;c c&#7911;a m&#7865;</td>
                <td>
                    <input type="text" name="txtMotherJobLocation" id="txtMotherJobLocation" width="250" />
                </td>
              </tr>	
              <tr>
                <td>Thu nh&#7853;p</td>
                <td>
                    <input type="text" name="txtMotherIncome" id="txtMotherIncome" width="250" />
                </td>
              </tr>	
              <tr>
                <td>S&#7913;c kh&#7887;e</td>
                <td>
                     <select name="txtMotherHealth" id="txtMotherHealth">
                  <option value="B&#236;nh th&#432;&#7901;ng">B&#236;nh th&#432;&#7901;ng</option>
                  <option value="&#272;&#227; m&#7845;t">&#272;&#227; m&#7845;t</option>
                  <option value="Kh&#244;ng c&#243; cha / Cha b&#7887; &#273;i t&#7915; l&#226;u">Kh&#244;ng c&#243; cha / Cha b&#7887; &#273;i t&#7915; l&#226;u</option>
                  <option value="B&#7879;nh hi&#7875; ngh&#232;o">B&#7879;nh hi&#7875; ngh&#232;o</option>
                  <option value="M&#7845;t s&#7913;c lao &#273;&#7897;ng">M&#7845;t s&#7913;c lao &#273;&#7897;ng</option>
                  <option value="B&#7879;nh m&#227;n t&#237;nh">B&#7879;nh m&#227;n t&#237;nh</option>
                </select>
                </td>
              </tr>	
            </table>
		</div>
        <div id='tab4'>
			<table width="100%" cellpadding="5" cellspacing="5" class="promote-user">
            <tr>
                <td>Ngu&#7891;n tr&#7907; c&#7845;p &#259;n h&#7885;c:</td>
                <td>
                    <p>
                        <select name="lstMonth2" id="lstMonth2">
                          <option value="0" selected>Gia &#273;&#236;nh</option>
                          <option value="1"  >L&#224;m th&#234;m</option>
                          <option value="2" >Kh&#225;c</option>
            </select>
                  </p>
            </td>
              </tr>
              <tr>
                <td>N&#7871;u c&#243; l&#224;m th&#234;m th&#236; em l&#224;m c&#244;ng vi&#7879;c g&#236;?</td>
                <td><input type="text" name="txtTimeJobs" id="txtHighSchoolResult3" width="250" /></td>
              </tr>
              <tr>
                <td>Thu nh&#7853;p: </td>
                <td><input type="text" name="txtIncome" id="txtHighSchoolResult4" width="100" />
                VND/th&#225;ng</td>
              </tr>
              <tr>
                <td>H&#7885;c ngo&#224;i gi&#7901;:</td>
                <td>
                    <select name="lsExtraTime" id="lsExtraTime">
                  <option value="0">C&#243;</option>
                  <option value="1">Kh&#244;ng</option>
                </select></td>
              </tr>
              <tr>
                <td>Em &#273;&#227; nh&#7853;n h&#7885;c b&#7893;ng c&#7911;a ch&#432;&#417;ng tr&#236;nh n&#224;o ch&#432;a ?</td>
                <td>
                    <select name="lsScholarship" id="lsScholarship">
                  <option value="0">Ch&#432;a</option>
                  <option value="1">R&#7891;i</option>
                </select>
                      </td>
              </tr>
            </table>
		</div>
<div class="form-wrapper" id="done-wrapper">
            <div class="form-label" id="done-label">&nbsp;</div>
            <div class="form-element" id="done-element">
                <button type="button" id="submit">C&#7853;p nh&#7853;t</button>
            </div>
        </div>   
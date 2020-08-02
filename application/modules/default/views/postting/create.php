<div id="trangcanhan">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="row profile">
					<div class="col-md-3">
						<div class="profile-sidebar" style="margin-bottom:5px;">
							<div class="profile-usertitle-name">
								<h3 class="text-center">Trang cá nhân</h3>
							</div>
							<div class="profile-usertitle">
								<?php $this->load->view('default/sidebar_user'); ?>
							</div>
						</div>
					</div>
					<!-- End Sidebar -->
					<div class="col-md-9 nopadding-lft">
						<div class="profile-content module-user">
							<h1 class="title bar"><span>Đăng tin rao vặt</span></h1>
							<div class="module-search postting">
								<!-- FORM -->
								<form action="" method="POST" class="form-horizontal" id="frmReal" role="form" enctype="multipart/form-data">
									<div class="form-block clearfix">
										<div class="title-block"><span>Lịch đăng tin</span></div>
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Loại tin:</label>
											</div>
											<div class="col-sm-4">
												<select name="sltVipType" class="form-control" id="sltVipType">
													<option value="4" <?= ($this->input->post('sltVipType') == 4) ? 'selected' : ''; ?>>Tin thường</option>
												</select>
											</div>
                                            <small><strong>(Tin thường : Tin sẽ kiểm duyệt trước khi đưa lên website)</strong></small>
										</div>
										<div class="col-sm-6 nopadding-lft">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Ngày bắt đầu <span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtStartDate" id="txtStartDate" value="<?= date('d/m/Y'); ?>" class="form-control required"/>
													<div class="errorMessage"></div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 no-padding">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Ngày kết thúc <span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtEndDate" value="<?= date('d/m/Y',strtotime('+ 1month')); ?>" id="txtEndDate" class="form-control required" />
													<div class="errorMessage"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-block clearfix">
										<div class="title-block"><span>Thông tin cơ bản</span></div>
										<div class="col-sm-6 nopadding-lft">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Hình thức <span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<select name="sltProductType" class="form-control required" id="sltProductType">
														<option value="-1">Hình thức</option>
														<option value="1">Nhà đất bán</option>
														<option value="2">Nhà đất cho thuê</option>
													</select>
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- item -->
											<!-- End Title -->
										</div>
										<div class="col-sm-6 no-padding">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Danh mục<span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<select name="sltProductCate" class="form-control required" id="sltProductCate">
														<option value="-1">Danh mục</option>
													</select>
													<div class="errorMessage"></div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6 nopadding-lft">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Tỉnh/TP<span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<select name="sltCity" class="form-control required" id="sltCity">
														<option value="-1">Tỉnh/Thành phố -- </option>
														<?php
														if (!empty($provinces)) {
															foreach ($provinces as $province) {
																?>
																<option value="<?= $province->province_id; ?>" <?= ($this->input->post('sltCity') == $province->province_id) ? 'selected' : ''; ?>><?= $province->name; ?></option>
																<?php
															}
														}
														?>
													</select>
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- item -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Phường/Xã :</label>
												</div>
												<div class="col-sm-8">
													<select name="sltWard" class="form-control" id="sltWard">
														<option value="-1" rel="">Phường/Xã</option>
													</select>
												</div>
											</div>
											<!-- item -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Dự án :</label>
												</div>
												<div class="col-sm-8">
													<select name="sltProject" class="form-control" id="sltProject">
														<option value="-1" rel="">Dự án</option>
													</select>
												</div>
											</div>
											<!-- End Title -->
										</div>
										<div class="col-sm-6 no-padding">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Quận/huyện <span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<select name="sltDistrict" class="form-control required" id="sltDistrict">
														<option value="-1" rel="">Quận/huyện</option>
													</select>
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- item -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Đường/phố :</label>
												</div>
												<div class="col-sm-8">
													<select name="sltStreet" class="form-control" id="sltStreet">
														<option value="-1" rel="">Đường/phố</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Diện tích :</label>
												</div>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtArea" name="txtArea" value="<?= $this->input->post('txtArea'); ?>" maxlength="6" numberonly="2" onkeypress="return numbersonly(this, event, true);"/>
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- item -->
											<!-- End Title -->
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6 nopadding-lft">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Giá :</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtPrice" id="txtPrice" class="form-control" numberonly='2' maxlength="6" onkeypress="return numbersonly(this, event, true);" />
													<div class="errorMessage"></div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 no-padding">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Đơn vị :</label>
												</div>
												<div class="col-sm-8">
													<select name="sltPriceType" class="form-control required" id="sltPriceType">
														<option value="-1">-- Đơn vị giá -- </option>
													</select>
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- End Title -->
										</div>
										<div class="form-group clear">
											<div class="col-sm-2">
												<label for="title">Địa chỉ <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="txtAddress" id="txtAddress" class="form-control" value="Việt Nam" />
											</div>
										</div>
									</div>
									<!-- Thông tin cơ bản -->
									<div class="form-block clearfix">
										<div class="title-block"><span>Thông tin khác</span></div>
										<div class="col-sm-6 nopadding-lft">
											<!-- item -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Ngang:</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtWidth" id="txtWidth" maxlength="6" numberonly="2" onkeypress="return numbersonly(this, event, true);" class="form-control" placeholder="m"/>
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- item -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Hướng nhà:</label>
												</div>
												<div class="col-sm-8">
													<select name="sltHomeDirection" class="form-control" id="sltHomeDirection">
														<option value="0">Không xác định</option>
														<?php
														if (!empty($directions)) {
															foreach ($directions as $direction) {
																?>
																<option value="<?= $direction->id; ?>" <?= ($this->input->post('sltDirection') == $direction->id) ? 'selected' : ''; ?>><?= $direction->direction_name; ?></option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Số tầng</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtFloorNumbers" id="txtFloorNumbers" class="form-control" maxlength="3" onkeypress="return numbersonly(this, event);" numberonly="1"/>
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- End Title -->
										</div>
										<div class="col-sm-6 no-padding">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Dài:</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtLandWidth" id="txtLandWidth" class="form-control" placeholder="m" maxlength="6" numberonly="2" onkeypress="return numbersonly(this, event, true);" />
													<div class="errorMessage"></div>
												</div>
											</div>
											<!-- item -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Hướng ban công:</label>
												</div> 
												<div class="col-sm-8">
													<select name="sltBaconDirection" class="form-control" id="sltBaconDirection">
														<option value="0">Không xác định</option>
														<?php
														if (!empty($directions)) {
															foreach ($directions as $direction) {
																?>
																<option value="<?= $direction->id; ?>" <?= ($this->input->post('sltDirection') == $direction->id) ? 'selected' : ''; ?>><?= $direction->direction_name; ?></option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>
										<!--  -->
										<div class="row">
											<div class="col-xs-12">
												<div class="col-sm-6 nopadding-lft">
													<div class="form-group">
														<div class="col-sm-4">
															<label for="title">Số phòng ngủ :</label>
														</div>
														<div class="col-sm-8">
															<input type="text" name="txtRoomNumber" id="txtRoomNumber" maxlength="3" onkeypress="return numbersonly(this, event);" numberonly="1" class="form-control"/>
															<div class="errorMessage"></div>
														</div>
													</div>
													<!-- item -->
												</div>
												<div class="col-sm-6 no-padding">
													<div class="form-group">
														<div class="col-sm-4">
															<label for="title">Số toilet</label>
														</div>
														<div class="col-sm-8">
															<input type="text" name="txtToiletNumber" id="txtToiletNumber" maxlength="3" onkeypress="return numbersonly(this, event);" numberonly="1" class="form-control"/>
															<div class="errorMessage"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /.row -->
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Nội thất :</label>
											</div>
											<div class="col-sm-10">
												<textarea name="txtInterior" rows="5" cols="50" id="txtInterior" maxlength="200" class="form-control"><?= $this->input->post('content'); ?></textarea>
											</div>
										</div>
									</div>
									<!-- Thông tin khác -->
									<div class="form-block clearfix">
										<div class="title-block"><span>Mô tả chi tiết</span></div>
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Tiêu đề <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<input type="text" value="<?= $this->input->post('txtProductTitle'); ?>" name="txtProductTitle" id="txtProductTitle" class="form-control required" placeholder="Vui lòng gõ Tiếng Việt có dấu để tin đăng kiểm duyệt nhanh hơn" />
												<div class="errorMessage"></div>
											</div>
										</div>
										<!-- End Title -->
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Nội dung <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<textarea name="txtProductContent" id="txtProductContent" rows="5" cols="50" class="form-control required" minlength="30" maxlength="3000"><?= $this->input->post('txtProductContent'); ?></textarea>
												<div class="errorMessage"></div>
											</div>
										</div>
										<!-- End nội dung -->
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Cập nhật ảnh <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<span id="spanLuuY">(Mỗi ảnh dung lượng không quá 1MB và mặc định hình đầu tiên là ảnh đại diện !)</span>
												<div class='upload-image-box'>            
													<div class='item'>
														<div class='filename'></div>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>
														<a href='javascript:void(0)' class='remove_pict'>X</a>       
														<input name="img1" type="file" id="img1" class="multi inputimage" accept="image/*" />          
													</div>
													<div class='item'>
														<div class='filename'></div>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img2" type="file" id="img2" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
													<div class='item'>
														<div class='filename'></div>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img3" type="file" id="img3" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
													<div class='item'>
														<div class='filename'></div>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img4" type="file" id="img4" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
													<div class='item'>
														<div class='filename'></div>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img5" type="file" id="img5" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<!-- End Thông tin chi tiết -->
									<script type="text/javascript">
										$(function() {
											var noImage  = DIR_ROOT + "public/default/images/upload-image.png";
											var icon_upload_change = DIR_ROOT + "public/default/images/icon_upload_change.png";
											var icon_upload = DIR_ROOT + "public/default/images/icon_upload.png";
											$("body").on('change', '.inputimage', function(){
												var filename = $(this).val().split('/').pop().split('\\').pop(); ;
												var input = this;
												if (input.files && input.files[0]) {
													var reader = new FileReader();
													reader.onload = function(event) {
														var picFile = event.target;
														var div = document.createElement("div");
														div.innerHTML = "<img src='" + picFile.result + "'" +"title='" + filename+ "'/>";    
														$(input).parents('.item').find('#upload-image').html(div);
													}
													reader.readAsDataURL(input.files[0]);
												}
												$(input).parents('.item').find('.filename').html(filename);
												$(input).parents('.item').find('input').css('background', 'url('+icon_upload_change+')');
											});
											$("body").on('click', 'a.remove_pict', function(event)
											{
												parents = $(this).parent('.item');
												input  = parents.find('input');
        										input.replaceWith(input.val('').clone(true));
												parents.find("#upload-image").html('<img src="'+noImage+'" />');
												parents.find('.filename').text('');
												$(this).parent('.item').find('input').css('background', 'url('+icon_upload+')')
											});
										});
									</script>
									<div class="form-block">
										<div class="title-block"><span>Thông tin liên hệ</span></div>
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Tên hiển thị<span class="mandatory"> (*)</span></label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="txtByName" id="txtByName" class="form-control" value="<?= $this->input->post('txtByName'); ?>" />
											</div>
										</div>
										<!-- End Title -->
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Địa chỉ</label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="txtByAddress" id="txtByAddress" class="form-control" value="<?= $this->input->post('txtByAddress') ?>" />
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Điện thoại<span class="mandatory"> (*)</span></label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="txtByMobile" id="txtByMobile" class="form-control" value="<?= $this->input->post('txtByMobile'); ?>" />
											</div>
										</div>
										<!-- End Title -->
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">E-mail <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<input type="email" name="txtByEmail" id="txtByEmail" class="form-control required" value="<?= $this->input->post('txtByEmail'); ?>"  />
											</div>
										</div>
                                        
                                        <script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
                                        <div class="form-group">
											<div class="col-sm-2">
												<label for="title">Mã an toàn <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<div class="g-recaptcha" data-sitekey="6Lfn5RATAAAAADLoOi-j8Hns_tYeoW28R9F_zJLD"></div>
                                                <div id="recaptcha-error" class="errorMessage" style="display: none;">Chọn mã an toàn !</div>
											</div>
										</div>
                                        
										<!-- End Title -->
									</div>
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
									<!-- Thông tin liên hệ -->
									<div class="form-group">
										<div class="col-sm-2">
											<label for="title"></label>
										</div>
										<div class="col-sm-10">
											<button type="submit" onclick="return SubmitForm();" class="btn btn-primary btn-blue" id="btn-posting">Đăng tin</button>
										</div>
									</div>
								</form>
								<!-- END FORM -->
							</div>
						</div>
					</div>
					<!-- Content Modules -->
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/postting.js"></script>
<script type="text/javascript" src="<?= $domain.'public/'.$modules.'/js/members.js';?>"></script>
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
							<h1 class="title star"><span>Cập nhật tin rao bán / cho thuê</span></h1>
							<div class="module-search postting">
								<!-- FORM POST -->
								<form action="<?= $domain.$this->uri->uri_string() ?>" method="POST" class="form-horizontal" id="frmReal" role="form" enctype="multipart/form-data">
									<div class="form-block clearfix">
										<div class="title-block"><span>Lịch đăng tin</span></div>
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Loại tin:</label>
											</div>
											<div class="col-sm-4">
												<select name="sltVipType" class="form-control" id="sltVipType">
													<option value="4" <?= ($real->vip_type == 4) ? 'selected' : ''; ?>>Tin thường</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6 nopadding-lft">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Ngày bắt đầu <span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtStartDate" id="txtStartDate" value="<?=date('d/y/Y',strtotime($real->start_date));?>" onkeypress="return false;" class="form-control" disabled="disabled" />
												</div>
											</div>
										</div>
										<div class="col-sm-6 no-padding">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Ngày kết thúc <span class="mandatory">(*)</span>:</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtEndDate" value="<?= date('d/y/Y',strtotime($real->end_date));?>" disabled="disabled" onkeypress="return false;" id="txtEndDate" class="form-control" />
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
													<select name="sltProductType" class="form-control" id="sltProductType">
														<option value="1" <?= $real->type_id == 1 ? 'selected' : ''; ?>>Nhà đất bán</option>
														<option value="2" <?= $real->type_id == 2 ? 'selected' : ''; ?>>Nhà đất cho thuê</option>
													</select>
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
													<select name="sltProductCate" class="form-control" id="sltProductCate">
														<option value="-1">Danh mục</option>
													</select>
													<input type="hidden" id="hddProductCate" value="<?= $real->category_id; ?>" />
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6 nopadding-lft">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Tỉnh/Thành phố <span class="mandatory">(*)</span></label>
												</div>
												<div class="col-sm-8">
													<select name="sltCity" class="form-control" id="sltCity">
														<option value="-1">Tỉnh/Thành phố</option>
														<?php
														if (!empty($provinces)) {
															foreach ($provinces as $province) {
																?>
																<option value="<?= $province->province_id; ?>" <?=$real->province_id == $province->province_id ? 'selected' : ''; ?>><?= $province->name; ?></option>
																<?php
															}
														}
														?>
													</select>
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
													<input type="hidden" id="hddWard" value="<?= $real->ward_id > 0 ? $real->ward_id : '-1'; ?>" />
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
													<input type="hidden" id="hddProject" value="<?= $real->project_id > 0 ? $real->project_id : '-1'; ?>" />
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
													<select name="sltDistrict" class="form-control" id="sltDistrict">
														<option value="-1" rel="">Quận/huyện</option>
													</select>
													<input type="hidden" id="hddDistrict" value="<?= $real->district_id > 0 ? $real->district_id : '-1'; ?>" />
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
													<input type="hidden" id="hddStreet" value="<?= $real->street_id > 0 ? $real->street_id : '-1' ?>" />
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Diện tích :</label>
												</div>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtArea" name="txtArea" value="<?= ($real->area > 0) ? $real->area : ''; ?>" />
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
													<input type="text" name="txtPrice" id="txtPrice" class="form-control" numberonly='2' maxlength="6" onkeypress="return numbersonly(this, event, true);" value="<?= $real->price; ?>" />
													<div class="error" style="color: #f00; display:inline-block;"></div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 no-padding">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Đơn vị :</label>
												</div>
												<div class="col-sm-8">
													<select name="sltPriceType" class="form-control" id="sltPriceType">
														<option value="-1">-- Đơn vị giá -- </option>
													</select>
													<div class="error" style="color: #f00; display:inline-block;"></div>
													<input type="hidden" id="hddPriceType" value="<?= $real->price_type; ?>" />
												</div>
											</div>
											<!-- End Title -->
										</div>
										<div class="form-group clear">
											<div class="col-sm-2">
												<label for="title">Địa chỉ <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<input type="text" name="txtAddress" id="txtAddress" class="form-control" value="<?= $real->address; ?>" />
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
													<label for="title">Ngang :</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="txtWidth" id="txtWidth" maxlength="6" numberonly="2" onkeypress="return numbersonly(this, event, true);" class="form-control" placeholder="m" value="<?= ($real->width > 0) ? $real->width : '';?>"/>
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
																<option value="<?= $direction->id; ?>" <?= ($real->home_direction == $direction->id) ? 'selected' : ''; ?>><?= $direction->direction_name; ?></option>
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
													<input type="text" name="txtFloorNumbers" id="txtFloorNumbers" class="form-control" value="<?= ($real->floor_number > 0 ) ? $real->floor_number : '';?>" />
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
													<input type="text" name="txtLandWidth" id="txtLandWidth" class="form-control" placeholder="m" maxlength="6" numberonly="2" onkeypress="return numbersonly(this, event, true);" value="<?= ($real->land_width > 0) ? $real->land_width : '';?>" />
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
																<option value="<?= $direction->id; ?>" <?= ($real->bacon_direction == $direction->id) ? 'selected' : ''; ?>><?= $direction->direction_name; ?></option>
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
															<input type="text" name="txtRoomNumber" id="txtRoomNumber" maxlength="3" onkeypress="return numbersonly(this, event);" numberonly="1" class="form-control" value="<?= ($real->room_number > 0 ) ? $real->room_number : '';?>"/>
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
															<input type="text" name="txtToiletNumber" id="txtToiletNumber" maxlength="3" onkeypress="return numbersonly(this, event);" numberonly="1" class="form-control" value="<?=($real->toilet_number > 0) ? $real->toilet_number : '';?>"/>
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
												<textarea name="txtInterior" rows="5" cols="50" id="txtInterior" maxlength="200" class="form-control"><?= $real->interior;?></textarea>
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
												<input type="text" value="<?=$real->title;?>" name="txtProductTitle" id="txtProductTitle" class="form-control" placeholder="Vui lòng gõ Tiếng Việt có dấu để tin đăng kiểm duyệt nhanh hơn" />
											</div>
										</div>
										<!-- End Title -->
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Nội dung <span class="mandatory">(*)</span></label>
											</div>
											<div class="col-sm-10">
												<textarea name="txtProductContent" id="txtProductContent" rows="10" cols="50" class="form-control" minlength="30" maxlength="3000"><?= $real->content; ?></textarea>
											</div>
										</div>
										<!-- Hinh anh -->
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Cập nhật hình ảnh <span class="mandatory">(*)</span></label>
											</div>
											<?php
											$cpt = count($gallerys);
											$pathImage = $domain.'uploads/properties/'.date('Y',strtotime($real->created_at)).'/'.date('m',strtotime($real->created_at)).'/'.date('d',strtotime($real->created_at));
											?>
											<div class="col-sm-10">
												<span id="spanLuuY">(Mỗi ảnh dung lượng không quá 1MB và mặc định hình đầu tiên là ảnh đại diện !)</span>
												<div class='upload-image-box'>
													<?php
													if (!empty($gallerys)){
														foreach ($gallerys as $key => $gallery) {
														?>
														<div class='item'>
															<div id="upload-image">
															<img class='upload-image' src="<?=$pathImage.'/'.$gallery->image;?>" />
															</div>
															<a href='javascript:void(0)' class='remove_pict_data' data="<?= toPublicId($gallery->id); ?>" data-date='<?= $real->created_at;?>'>X</a>
														</div>
														<?php
														}
														for ($i=1; $i<=(5-count($gallerys)); $i++) { 
															?>
															<div class='item'>
																<div id="upload-image">
																	<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
																</div>
																<a href='javascript:void(0)' class='remove_pict'>X</a>
																<input name="img<?= $i;?>" type="file" id="img<?= $i;?>" class="multi inputimage" accept="image/*" />
															</div>
															<?php
														}
													?>
													<?php
													}else{
													?>
													<div class='item'>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>
														<a href='javascript:void(0)' class='remove_pict'>X</a>       
														<input name="img1" type="file" id="img1" class="multi inputimage" accept="image/*" />          
													</div>
													<div class='item'>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img2" type="file" id="img2" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
													<div class='item'>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img3" type="file" id="img3" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
													<div class='item'>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img4" type="file" id="img4" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
													<div class='item'>
														<div id="upload-image">
															<img class='upload-image' src="<?=$domain;?>public/default/images/upload-image.png" />
														</div>            
														<input name="img5" type="file" id="img5" class="multi inputimage" accept="image/*" />
														<a href='javascript:void(0)' class='remove_pict'>X</a>               
													</div>
													<?php
													}
													?>        
													
												</div>
											</div>
										</div>
									</div>
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
													reader.onload = function(event)
													{
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
												parents.find("#upload-image").html('<img src="'+ noImage + '" />');
												parents.find('.filename').text('');
												$(this).parent('.item').find('input').css('background', 'url('+icon_upload+')')
											});
											$("body").on('click', 'a.remove_pict_data', function(event)
											{
												var dataDate  = $(this).attr('data-date');
												var galleryId = $(this).attr('data');
												$.post(DIR_ROOT + 'default/postting/deletegallery', {galleryId: galleryId,dataDate:dataDate}, function(data, textStatus, xhr) {
													location.reload();	
												});
											});
										});
									</script>
									<!-- Mô tả chi tiêt -->
									<div class="form-block">
										<div class="title-block"><span>Thông tin liên hệ</span></div>
										<div class="form-group">
											<div class="col-sm-2">
												<label for="title">Tên hiển thị<span class="mandatory">(*)</span></label>
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
												<label for="title">Điện thoại<span class="mandatory">(*)</span></label>
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
										<!-- End Title -->
									</div>
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
									<!-- Thông tin liên hệ -->
									<div class="form-group">
										<div class="col-sm-2">
											<label for=""></label>
										</div>
										<div class="col-sm-10">
											<button type="submit" class="btn btn-primary btn-blue" id="btn-posting">Lưu thay đổi</button>
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
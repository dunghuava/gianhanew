<div id="trangcanhan">
	<div class="container">
		<div class="top-cart-info" style="position: relative;right: 0;bottom: 0;"></div>
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
					<script type="text/javascript">
						$(document).ready(function() {
							<?= validation_errors("_toastr('","','jGrowl-alert-danger');"); ?>
							<?php
							if ($this->session->flashdata('success')){
								echo '_toastr("'.$this->session->flashdata('success').'","jGrowl-alert-success")';
							}
							?>
						});
					</script>
					<div class="col-md-9 nopadding-lft">
						<div class="profile-content module-user">
							<h1 class="title star"><span>THAY ĐỔI THÔNG TIN CÁ NHÂN</span></h1>
							<div class="module-search">
								<div class="module-search postting">
									<!-- FORM -->
									<form action="<?= $domain.$this->uri->uri_string(); ?>" method="POST" class="form-horizontal" id="frmReal" role="form">
										<div class="form-block clearfix">
											<div class="form-group">
												<div class="col-sm-3">
													<label for="title">Tên hiển thị <span class="mandatory">(*)</span></label>
												</div>
												<div class="col-sm-9">
													<input type="text" value="" name="display_name" id="txtByName" class="form-control"/>
													<div class="errorMessage"></div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-3">
													<label for="title">Tên đăng nhập :</label>
												</div>
												<div class="col-sm-9">
													<input type="text" disabled="disabled" value="" name="username" id="username" class="form-control" />
													<div class="errorMessage"></div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-3">
													<label for="title">E-mail <span class="mandatory">(*) :</span></label>
												</div>
												<div class="col-sm-9">
													<input type="text" disabled="disabled" value="" name="email" id="txtByEmail" class="form-control" />
													<div class="errorMessage"></div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-3">
													<label for="title">Điện thoại <span class="mandatory">(*) :</span></label>
												</div>
												<div class="col-sm-9">
													<input type="text" value="" name="mobile" id="txtByMobile" class="form-control" />
													<div class="errorMessage"></div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-3">
													<label for="title">Địa chỉ :</span></label>
												</div>
												<div class="col-sm-9">
													<input type="text" value="" name="address" id="txtByAddress" class="form-control" />
													<div class="errorMessage"></div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-3">
													<label for="title">Giới thiệu:</span></label>
												</div>
												<div class="col-sm-9">
													<textarea name="" id="" class="form-control" cols="30" rows="4"></textarea>
												</div>
											</div>
										</div>
										<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
										<!-- Thông tin liên hệ -->
										<div class="form-group">
											<div class="col-sm-3">
												<label for="title"></span></label>
											</div>
											<div class="col-sm-9">
												<button type="submit" class="btn btn-primary btn-blue" id="btn-posting">Lưu thay đổi</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= $domain.'public/'.$modules.'/js/members.js';?>"></script>
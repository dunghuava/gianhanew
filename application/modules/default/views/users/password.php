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
						});
					</script>
					<div class="col-md-9 nopadding-lft">
						<div class="profile-content module-user">
							<h1 class="title star"><span>THAY ĐỔI MẬT KHẨU</span></h1>
							<div class="module-search">
								<div class="module-search postting">
									<!-- FORM -->
									<form action="<?= $domain.$this->uri->uri_string(); ?>" method="POST" class="form-horizontal" id="frmReal" role="form">
										<div class="form-block clearfix">
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Mật khẩu cũ <span class="mandatory">(*)</span></label>
												</div>
												<div class="col-sm-8">
													<input type="password" value="<?= $this->input->post('old_password'); ?>" name="old_password" class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Mật khẩu mới <span class="mandatory">(*)</span></label>
												</div>
												<div class="col-sm-8">
													<input type="password" value="<?= $this->input->post('password'); ?>" name="password" class="form-control" />
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title">Xác nhận mật khẩu mới <span class="mandatory">(*)</span></label>
												</div>
												<div class="col-sm-8">
													<input type="password" value="<?= $this->input->post('confirm_password'); ?>" name="confirm_password" class="form-control" />
												</div>
											</div>
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
										</div>
										<div class="form-block noborder">
											<!-- Action Form -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="title"></label>
												</div>
												<div class="col-sm-8">
													<button type="submit" class="btn btn-primary btn-blue" id="btn-posting">Lưu thay đổi</button>
												</div>
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
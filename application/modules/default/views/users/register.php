<div id="homepage" class="section">
	<div class="container">
		<div class="top-cart-info" style="position: relative;right: 0;bottom: 0;z-index: 10;"></div>
		<!-- /#loginbox -->
		<script type="text/javascript">
			$(document).ready(function() {
				<?= validation_errors("_toastr('","','jGrowl-alert-danger');"); ?>
			});
		</script>
		<div id="signupbox" class="mainbox">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title"><i class="fa fa-key"></i>Đăng Ký tài khoản</div>
					</div>
					<script type="text/javascript"></script>
					<div class="panel-body">
						<form id="signupform" action="<?= $domain.$this->uri->uri_string(); ?>" class="form-inline" method="POST">
							<div class="form-group">
								<input type="text" class="form-control" name="display_name" value="<?= $this->input->post('display_name'); ?>" placeholder="Họ tên" />
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" value="<?= $this->input->post('email'); ?>" placeholder="Email*"/>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="username" value="<?= $this->input->post('username'); ?>" placeholder="Tài khoản đăng nhập*"/>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Mật khẩu*" />
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="confirm_password" placeholder="Xác nhận mật khẩu*" />
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="mobile" value="<?= $this->input->post('mobile'); ?>" placeholder="Điện thoại*" />
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address" value="<?= $this->input->post('address'); ?>" placeholder="Địa chỉ" />
							</div>
							<div class="form-group">
								<input type="text" class="col-md-5 form-control mr10" name="capcha" placeholder="Mã xác nhận*" style="width: 80%;" />
								<img src="<?=$captcha;?>" />
							</div>								
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
							<div class="form-group">
								<div class="col-md-12 no-padding">
									<button id="btn-signup" type="submit" class="btn btn-info my-btn-info"><i class="icon-hand-right"></i> &nbsp Đăng Ký</button>
								</div>
							</div>
						</form>
					</div>
					<div class="panel-footer">
						<div class="login-reg text-center">
							<p>Đã là thành viên? <a href="<?= $domain.'dang-nhap.htm' ?>">Đăng nhập</a></p>
							<p><a href="<?= $domain.'quen-mat-khau.htm' ?>">Quên mật khẩu ?</a></p>
						</div>
					</div> 
				</div>
			</div>
			<div id="login-content" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-content">
          <a href="
          <?= $domain.'ho-tro-dang-tin/dang-tin-rao-ban-cho-thue-nha-dat.html' ?>">	<img src="<?= $domain ?>public/default/pages/register.png"  class="img-responsive" alt="register"></a>
          </div>
			</div>
		</div>
	</div>
</div>
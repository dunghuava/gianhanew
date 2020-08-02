<!-- Register-->
<div class="modal fade" id="modal-register">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title-site text-center"><i class="fa fa-sign-in fa-fw"></i>Đăng ký thành viên</h3>
			</div>
			<div class="modal-body">
				<form action="<?= $domain.'dang-ky.htm';?>" method="POST" id="fUserRegister">
					<div class="form-group login-username">
						<div>
							<label for="fullname">Tên hiển thị <span class="mandatory">(*)</span>:</label>
							<input type="text" name="display_name" class="form-control input" />
						</div>
					</div>
                    <div class="form-group login-password2">
						<div>
							<label for="email">E-mail <span class="mandatory">(*)</span>:</label>
							<input type="email" name="email" class="form-control input" />
						</div>
					</div>
					<div class="form-group login-password2">
						<div>
							<label for="phone">Điện thoại <span class="mandatory">(*)</span>:</label>
							<input name="mobile" class="form-control input" type="text" />
						</div>
					</div>
                    <div class="form-group login-password2">
						<div>
							<label for="phone">Địa chỉ </label>
							<input name="address" class="form-control input" type="text" />
						</div>
					</div>
					<div class="form-group login-username">
						<div>
							<label for="username">Tên đăng nhập <span class="mandatory">(*)</span>:</label>
							<input type="text" name="username" class="form-control input" />
						</div>
					</div>
					<div class="form-group login-password">
						<div>
							<label for="password">Mật khẩu <span class="mandatory">(*)</span>:</label>
							<input type="password" name="password" class="form-control input" />
						</div>
					</div>
					<div class="form-group login-password2">
						<div>
							<label for="comfirm_password">Xác nhận mật khẩu <span class="mandatory">(*)</span>:</label>
							<input type="password" name="confirm_password" class="form-control input" />
						</div>
					</div>
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
					<div class="btn-action" style="max-width: 45%; margin: auto;">
						<div>
							<input name="submit" class="btn btn-block btn-lg btn-primary" value="Đăng ký" type="submit" />
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<p class="text-center"> Bạn đã có tài khoản s-nhadat.com ? <a data-toggle="modal" data-dismiss="modal" href="#modal-login">Đăng nhập</a></p>
			</div>
		</div>
	</div>
</div>
<!-- Register-->
<!-- Login-->
<div class="modal fade" id="modal-login">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title-site text-center"><i class="fa fa-sign-in fa-fw"></i>Đăng nhập</h3>
			</div>
			<div class="modal-body">
				<form action="<?= $domain.'dang-nhap.htm'; ?>" method="POST" id="fUserLogin" class="" role="form">
					<div class="form-group login-username">
						<div>
							<label for="">Tài khoản <span class="mandatory">(*)</span>:</label>
							<input name="username" id="login-user" class="form-control input" size="20" type="text" />
						</div>
					</div>
					<div class="form-group login-password">
						<div>
							<label for="">Mật khẩu <span class="mandatory">(*)</span>:</label>
							<input name="password" id="login-user" class="form-control input" size="20" type="password" />
						</div>
					</div>
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
					<div class="btn-action" style="max-width: 45%; margin: auto;">
						<div>
							<input name="submit" class="btn  btn-block btn-lg btn-primary" value="Đăng nhập" type="submit">
						</div>
					</div>
				</form>
				<!-- /.end action -->
			</div>
			<div class="modal-footer">
				<p class="text-center"> Đăng ký tài khoản? <a data-toggle="modal" data-dismiss="modal" href="#modal-register"> Tại đây. </a> <br>
<a data-toggle="modal" data-dismiss="modal" href="#modal-fotget"> Quên mật khẩu? </a></p>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-fotget">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title-site text-center"><i class="fa fa-sign-in fa-fw"></i>Quên mật khẩu</h3>
			</div>
			<div class="modal-body">
				<form action="<?= $domain.'quen-mat-khau.htm'; ?>" method="POST" id="fUserLogin" class="" role="form">
					<div class="form-group login-username">
						<div>
							<label for="">E-mail <span class="mandatory">(*)</span>:</label>
							<input name="username" id="login-user" class="form-control input" size="20" type="text" />
						</div>
					</div>
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
					<div class="btn-action" style="max-width: 45%; margin: auto;">
						<div>
							<input name="submit" class="btn  btn-block btn-lg btn-primary" value="Xác nhận" type="submit"/>
						</div>
					</div>
				</form>
				<!-- /.end action -->
			</div>
			<div class="modal-footer">
				<p class="text-center"> Đăng ký tài khoản? <a data-toggle="modal" data-dismiss="modal" href="#modal-register"> Tại đây. </a>
			</div>
		</div>
	</div>
</div>
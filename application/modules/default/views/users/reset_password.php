<div id="homepage" class="section">
	<div class="container">
		<div class="top-cart-info" style="position: relative;right: 0;bottom: 0;"></div>
		<div class="row">
			<div class="col-xs-12">
				<div id="loginbox" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
					<script type="text/javascript">
						$(document).ready(function() {
							<?= validation_errors("_toastr('","','jGrowl-alert-danger');"); ?>
							<?php
							if ($this->session->flashdata('success')){
								echo '_toastr("'.$this->session->flashdata('success').'","jGrowl-alert-success")';
							}
							if(isset($error)){
								echo '_toastr("'.$error.'","jGrowl-alert-danger")';
							}
							?>
						});
					</script>
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title"><i class="fa fa-sign-in"></i>Thay đổi mật khẩu</div>
						</div>     
						<div style="padding-top:30px" class="panel-body">
							<div class="col-md-12 no-padding">
								<form id="loginform" action="<?= $domain.$this->uri->uri_string(); ?>" class="form-horizontal" role="form" method="post">
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
									<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
										<input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu mới" />                                      
									</div>
									<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
										<input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu mới" />
									</div>
									<div style="margin-top:10px" class="form-group">
										<!-- Button -->
										<div class="col-sm-12 controls" style="text-align:center;">
											<button id="btn-login" type="submit" class="btn btn-success btn-blue">Cập nhật</button>
										</div>
									</div>   
								</form>
							</div>
							<!-- /#form loginform  -->
						</div>                     
					</div>  
				</div>
			</div>
		</div>
	</div>
</div>
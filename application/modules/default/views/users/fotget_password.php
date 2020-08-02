<div id="homepage" class="section">
	<div class="container">
		<div class="top-cart-info" style="position: relative;right: 0;bottom: 0;"></div>
		<div id="loginbox" class="mainbox col-md-4 col-sm-4 col-xs-12">
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
			<?php if ($this->session->flashdata('success')) { ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>
			<?php if ($this->session->flashdata('error')) { ?>
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title"><i class="fa fa-sign-in"></i>Quên mật khẩu</div>
				</div>     
				<div style="padding-top:30px" class="panel-body">
					<div class="col-md-12 no-padding">
						<form id="loginform" action="<?= $domain.$this->uri->uri_string(); ?>" class="form-horizontal" role="form" method="post">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
								<input id="fotget_password" type="text" class="form-control" name="email" placeholder="Nhập địa chỉ email*" />
							</div>
							<div style="margin-top:10px" class="form-group">
								<!-- Button -->
								<div class="col-sm-12 controls" style="text-align:center;">
									<button id="btn-login" type="submit" class="btn btn-success btn-blue">Xác nhận</button>
								</div>
							</div>   
						</form>
					</div>
					<!-- /#form loginform  -->
				</div>                     
			</div>  
		</div>
		<div id="login-content" class="col-md-8 col-sm-8 col-xs-12">
			<div class="login-content">
        <a href="<?= $domain.'ho-tro-dang-tin/dang-tin-rao-ban-cho-thue-nha-dat.html' ?>">	<img src="<?= $domain ?>public/default/pages/signin.png"  class="img-responsive" alt=""></a>
			</div>
		</div>
	</div>
</div>
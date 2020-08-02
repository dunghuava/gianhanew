<section id="content" class='section'>
	<div class="container">
		<div class="block-big contact">
			<ol class="breadcrumb">
				<li><a href="<?= $domain; ?>" title="<?= SITENAME; ?>"><i class="fa fa-home fa-fw"></i>Trang chủ</a></li>
				<li class="active"><?= $contact->title; ?></li>
			</ol>
			
			<div class="col-xs-12">
				<div id="map-canvas" style="height:310px;"></div>
				<?php echo validation_errors('<div class="alert alert-danger" style="margin-bottom: 5px;"><p>', '</p></div>'); ?>
				<?php if ($this->session->flashdata('success')) { ?>
			    <div class="alert alert-success fade in">
			        <button type="button" class="close" data-dismiss="alert">×</button>
			        <p><?= $this->session->flashdata('success'); ?></p>
			    </div>
			    <?php }?>
			</div>

			<div class="contact-bottom">
				<div class="col-xs-12 col-md-6 wow fadeInLeft">
					<h2 class="contact-title">LIÊN HỆ VỚI CHÚNG TÔI</h2>
					<form action="<?= $domain.$this->uri->uri_string() ?>" method="post" id="frmcontact">
						<div class="frm-input">
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12">
										<label>Họ Tên <span class="mandatory">*</span>:</label>
										<input class="form-control input-contact" type="text" name="name" id="name" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12">
										<label>Email <span class="mandatory">*</span>:</label>
										<input class="form-control input-contact" type="text" name="email" id="email" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12">
										<label>Phone <span class="mandatory">*</span>:</label>
										<input class="form-control input-contact" type="text" name="phone" id="phone" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12">
										<label>Nội dung :</label>
										<textarea class="form-control" id="contents" name="contents" rows="3"></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-primary pull-right btncontact" type="reset">Xóa</button>
								<button class="btn btn-primary pull-right btncontact" name="btnContact" type="submit">Gửi</button>
							</div>
						</div>
						<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
					</form>				
				</div>
				<div class="col-xs-12 col-md-6">
					<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDqAHaMV9ZVcSX992nMQOgZ_Vy80GUZ_8I"></script>
       		 		<script type="text/javascript" src="http://websitechuan.com/public/templates/frontend/default/plugins/gmaps/gmaps.min.js?v=1459692260"></script>
					<script type="text/javascript">
						<?php if (!empty(json_decode($contact->params)->gmlatitude) && !empty(json_decode($contact->params)->gmlongtitude)){?>
				            $(document).ready(function(){
				                var map = new GMaps({
				                    div: '#map-canvas',
				                    lat: <?=trim(json_decode($contact->params)->gmlatitude)?>,
				                    lng: <?=trim(json_decode($contact->params)->gmlongtitude)?>,
				                    scrollwheel: false,
				                    zoom: 17
				                });
				                var overlay = map.drawOverlay({
				                    lat: <?=trim(json_decode($contact->params)->gmlatitude)?>,
				                    lng: <?=trim(json_decode($contact->params)->gmlongtitude)?>,
				                    content: '<div class="gmap-overlay arrow-below"><?= $contact->title ?><div class="arrow"></div></div>',
				                });
				            });
			            <?php } ?>
			        </script>

					<!-- /#map -->
					<div class="company-info">
						<h2><?= $contact->title ?></h2>
						<ul class="fa-ul">
							<?php if (!empty(json_decode($contact->params)->address)) { ?>
							<li><i class="fa-li fa fa-building-o fa-fw"></i><?= json_decode($contact->params)->address ?></li>
							<?php } ?>
							<?php if (!empty(json_decode($contact->params)->phone)) { ?>
							<li><i class="fa-li fa fa-phone fa-fw"></i>Tel: <?=json_decode($contact->params)->phone ?></li>
							<?php } ?>
							<?php if (!empty(json_decode($contact->params)->mobile)) { ?>
							<li><i class="fa-li fa fa-phone-square fa-fw"></i>Phone: <?= json_decode($contact->params)->mobile;?></li>
							<?php } ?>
							<li><i class="fa-li fa fa-wifi fa-fw"></i>Website:thuthiemhouse.vn</li>
							<li><i class="fa-li fa fa-envelope-o fa-fw"></i>Email: <?= $contact->email ?> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
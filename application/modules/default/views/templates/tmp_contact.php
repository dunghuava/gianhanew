<section id="content" class='section'>
	<div class="container">
		<div class="block-big contact">
			<ol class="breadcrumb">
				<li><a href="<?= $domain; ?>" title="<?= SITENAME; ?>"><i class="fa fa-home fa-fw"></i>Trang chủ</a></li>
				<li class="active"><?= $post['title']; ?></li>
			</ol>
			<div class="col-xs-12">
				<h2 class="contact-title">LIÊN HỆ VỚI CHÚNG TÔI</h2>
			</div>
			<div class="contact-bottom">
				<div class="col-xs-12 col-md-6 wow fadeInLeft">
					<form action="" method="post" id="frmcontact" onSubmit="return validatecontact();">
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
								<button class="btn btn-primary pull-right btncontact" type="submit">Gửi</button>
							</div>
						</div>
						<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
					</form>				
				</div>
				<div class="col-xs-12 col-md-6 wow fadeInRight">
					<div id="map"></div>
					<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDqAHaMV9ZVcSX992nMQOgZ_Vy80GUZ_8I"></script>
					<script type="text/javascript"> 
						var gMapLatlng = new google.maps.LatLng(10.77829, 106.70175);
						var gMapOptions = {
							center: new google.maps.LatLng(10.77829, 106.70175),
							zoom: 12,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						var map = new google.maps.Map(document.getElementById("map"), gMapOptions);

						var marker = new google.maps.Marker({
							position: gMapLatlng,
							map: map
						});    
						var contentString = 'Địa chỉ công ty ABC';
						var infowindow = new google.maps.InfoWindow({
							content: contentString
						});
						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map,marker);
						});
						infowindow.open(map,marker);
					</script>
					<!-- /#map -->
					<div class="company-info">
						<h2>CÔNG TY TNHH ĐẦU TƯ VÀ PHÁT TRIỂN NHÀ THỦ THIÊM</h2>
						<ul class="fa-ul">
							<li><i class="fa-li fa fa-building-o fa-fw"></i>59C Nguyễn Hữu Cảnh - Phường 22 - Quận Bình Thạnh - TP HCM</li>
							<li><i class="fa-li fa fa-phone fa-fw"></i>Tel: 08 665 88 005</li>
							<li><i class="fa-li fa fa-phone-square fa-fw"></i>Phone: 0916 464 055</li>
							<li><i class="fa-li fa fa-wifi fa-fw"></i>Website:thuthiemhouse.vn</li>
							<li><i class="fa-li fa fa-envelope-o fa-fw"></i>Email: nhathuthiem.bds@gmail.com </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
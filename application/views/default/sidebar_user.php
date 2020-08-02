<div class="profile-usermenu" style="border-bottom: 1px solid rgb(221, 221, 221); padding-bottom: 15px;">
	<!-- <div class="avatar text-center"><img src="http://dothi.net/Styles/Images/avatar-default.png" title="" style="width:100%;"></div> -->
	<div class="thongtintaikhoan">
		<div class="display-name"><span class="label-info">Tài khoản</span> : <?= $this->session->userdata('username'); ?></div>
		<!-- <div class="display-name"><span class="label-info">Tổng số điểm</span> : <strong>30 điểm</strong></div>
		<div class="display-name"><span class="label-info">Điểm còn lại</span> : <span class='points'></span></div>
		<div class="display-name"><span class="label-info">Điểm đã dùng</span> : <span class='pointed'></span></div> -->
	</div>
</div>
<div class="profile-usermenu">
	<h4>Quản lý tin rao </h4>
	<ul class="nav nav-membership">
		<li>
			<a rel="nofollow" href="<?= $domain; ?>thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm"><i class="fa fa-caret-right"></i>Đăng tin rao bán/cho thuê</a>
		</li>
		<li><a rel="nofollow" href="<?= $domain; ?>thanh-vien/quan-ly-tin-rao.htm"><i class="fa fa-caret-right"></i>Quản lý tin rao bán/cho thuê</a></li>
	</ul>
</div>
<div class="profile-usermenu">
	<h4>Quản lý tài khoản</h4>
	<ul class="nav nav-membership">
		<li>
			<a rel="nofollow" href="<?= $domain; ?>thanh-vien/thay-doi-thong-tin.htm"><i class="fa fa-caret-right"></i>Thay đổi thông tin cá nhân</a>
		</li>
		<li>
			<a rel="nofollow" href="<?= $domain; ?>thanh-vien/doi-mat-khau.htm"><i class="fa fa-caret-right"></i>Thay đổi mật khẩu</a>
		</li>
	</ul>
</div>

<input type="hidden" id="handuser" value="<?= toPublicId($this->session->userdata('user_id')); ?>">
<script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/members.js"></script>
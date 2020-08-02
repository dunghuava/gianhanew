<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<!-- <link rel="icon" href="images/favicon.ico"> -->
	<meta name="google-site-verification" content="o_z9Tocik3ymhSWJYJp5QICz9qQsQcemXDCtuotT1GE" />
	<!--<meta name="google-site-verification" content="<?= GOOGLE_MASTER_TOOL; ?>" />-->
	<meta name="alexaVerifyID" content="gJLkfYIC4Odzy2N2HcBVYqIS1C4"/> 
    <meta name="msvalidate.01" content="896A778A3DF4741FB2DADB3244C7DCEB" />
	<title><?= $meta_title. ' | ' .DOMAIN_NAME; ?></title>
	<link rel="canonical" href="https://dangtinnhadat.net/" />
    <link rel="icon" type="image/png" sizes="96x96" href="<?= $domain.'public/'.$modules; ?>/images/favicon.png" />
	<meta name="description" content="<?= $meta_description; ?>" />
	<meta name="keywords" content="<?= $meta_keywords; ?>" />
	<meta itemprop="name" content="<?= $meta_title; ?>" />
	<meta itemprop="description" content="<?= $meta_description; ?>" />
	<meta itemprop="image" content="<?= $meta_image; ?>" />
	<meta property="og:title" content="<?= $meta_title; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= $domain.$this->uri->uri_string(); ?>" />
	<meta property="og:image" content="<?= $meta_image; ?>" />
	<meta property="og:description" content="<?= $meta_description; ?>" /> 
    <meta name="revisit-after" content="1 days" />
    <meta name="robots" content="follow" />
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/js/jquery-ui/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/font-awesome/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/normalize.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/js/select2/css/select2.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/slider.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/jquery.jgrowl.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/mobile.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/css/mobile-menu.css"/>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery.cookie-1.4.1.min.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/css/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery-ui/languages/jquery.ui.datepicker-vi-VN.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/common/common.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/common/common.validator.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/select2/js/select2.min.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/modernizr.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery.mobile-menu.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/jquery.lazyload.min.js"></script>
    <script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/application.js"></script>
    <style>
    .lazy {
        background: transparent url("<?= $domain.'public/'.$modules; ?>/images/loading.gif") no-repeat scroll center center;
    }
    </style>
    <meta property="fb:app_id" content="996227657067029"/>
    <meta property="fb:admins" content="100003952812529"/>
    <script type="text/javascript">var DIR_ROOT="<?= $domain; ?>";$(function(){$.ajaxSetup({data:{"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>"}})});var domainCookie = 'nhadat.vanphonghochiminh.com';var productId = '0';var userId = '';</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110158090-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110158090-1');
</script>


</head>
<body>
	<?php if ($controller != 'user' && $controller != 'postting' ) { ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=996227657067029';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php } ?>
	<!-- HEADER -->
	<noscript>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-danger" style="margin-top: 25px;">
					<div class="panel-heading">
						<h6 class="panel-title">Xin cẩn thận!</h6>
					</div>
					<div class="panel-body bg-warning">
						Ứng dụng quản lý này có sử dụng Javascript. Vui lòng cấu hình lại trình duyệt của bạn và cho phép sử dụng Javascript. Bạn có thể tham khảo cách kích hoạt chế độ chạy Javascript tại <a href="http://www.enable-javascript.com" target="_blank"><b>đây.</b></a>
					</div>
				</div>                
			</div>
		</div>
	</noscript>
	<div id="navover">
		<div class="mm-toggle-wrap">
			<div class="mm-toggle"> <i class="fa fa-bars fa-fw"></i></div>
			<span class="mm-label">
				<a href="<?= $domain; ?>" title="<?= SITENAME; ?>">
					<img src="<?= LOGOSITE ?>" class="logo" alt="<?= SITENAME; ?>" />
				</a>
			</span> 
			<span class="lang-mb">
				<a href="#" title="Contact Us"><i class="fa fa-envelope-o fa-fw fa-2x"></i></a>
			</span>
		</div>
		<div class="nav-search">
			<ul class="more-action">
				<?php if (!$this->session->userdata('user_level') || ($this->session->userdata('user_level') != 4)) { ?>
					<li><i class="fa fa-user top-icon fa-fw"></i><a href='<?=base_url();?>dang-ky.htm' title="Đăng ký thành viên">&nbsp;Đăng ký</a></li>
					<li><i class="fa fa-sign-in top-icon fa-fw"></i><a href='<?=base_url();?>dang-nhap.htm' title="Đăng nhập">&nbsp;Đăng nhập</a></li>
				<?php } ?>
				<li><i class="fa fa-envelope-o top-icon fa-fw"></i><a href="<?= $domain.'thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm';?>" title="Đăng tin miễn phí">Đăng tin </a></li>
			</ul>
		</div>
	</div>
	<!-- Moblie menu -->
	<div id="mobile-menu">
		<?php showMenuMobile($navigation,0); ?>
	</div>
	<header class="hidden-xs">
        <div id="navi-top">
    	   <div class="container">
                <div class="row">
                	<div class="col-md-8 col-sm-8">
                		<ul class="more-action">
                			<?php if (!$this->session->userdata('user_level') || ($this->session->userdata('user_level') != 4)) { ?>
                				<li><i class="fa fa-user fa-fw"></i><a rel="nofollow" href='<?=base_url();?>dang-ky.htm' title="Đăng ký">&nbsp;Đăng ký</a></li>
                				<li><i class="fa fa-sign-in fa-fw"></i><a rel="nofollow" href='<?=base_url();?>dang-nhap.htm' title="Đăng nhập">&nbsp;Đăng nhập</a></li>
                			<?php }else{ ?>
                				<li><i class="fa fa-user fa-fw"></i><a rel="nofollow" href='<?= $domain.'thanh-vien/quan-ly-tin-rao.htm'?>' title="Trang cá nhân">Trang cá nhân</a></li>
                				<li><i class="fa fa-sign-out fa-fw"></i><a rel="nofollow" href='<?= $domain.'dang-xuat.htm'?>' title="Thoát">Thoát</a></li>
                			<?php } ?>
                		</ul>
                	</div>
                	<div class="hidden-xs col-md-4 col-sm-4 social nopadding-lft">
    					<span class="hotline pull-right">
						<a href="https://dangtinnhadat.net/ho-tro-dang-tin/dang-tin-rao-ban-cho-thue-nha-dat.html">
						    <img src="/public/default/images/share.png" alt="share" />
						</a>
						</span>
                    </div>
               </div>
           </div>		
					<!-- /.Header Top -->
   		</div>
		<div id="header-logo" class="section" style="background:white;">
            <div class="container">
			     <div class="row">
					<div class="col-sm-4 col-md-2 pull-left">
						<a href="<?= base_url(); ?>" title="<?= SITENAME; ?>">
							<img src="<?= LOGOSITE ?>" class="logo" alt="<?= SITENAME; ?>" />
						</a>
                        <?php if($controller == 'home') { ?>
                        <h1 style="text-indent: -99999px; display: none;"><?= SITENAME; ?></h1>
                        <?php } ?>
					</div>
					<div class="col-md-10 col-sm-8 pull-left hidden-xs">
						<?php $this->load->view($modules.'/advertings/top'); ?>
					</div>
			     </div>
            </div>
		</div>
		<nav class="navbar navbar-inverse my-navbar">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed navbar-left" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">
							Toggle navigation
						</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                    <ul class="nav navbar-nav navbar-right" id="btnPush">
                        <li style="background:#fe8544;">
                            <a href="<?= $domain.'thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm';?>" title="Đăng tin miễn phí"><i class="fa fa-cloud-upload fa-fw"></i> Đăng tin miễn phí</a>
                        </li>
                    </ul>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<?= showMenu($navigation,0); ?>
					<ul class="nav navbar-nav navbar-right" id="main-post">
						<li style="background:#fe8544;">
							<a href="<?= $domain.'thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm';?>" title="Đăng tin miễn phí"><i class="fa fa-cloud-upload fa-fw"></i> Đăng tin miễn phí</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- END HEADER -->
	<!-- homepage -->
	<?php $this->load->view($temp); ?>
	<!-- End homepage -->
	<footer class="footer">
		<div class="container w-footer">
			<div class="row">
				<div id="widget" class="clearfix">
					<?php if($this->mcontent_blocks->countBlocks('pre-footer-1') != 0) { ?>
                        <?php foreach($this->mcontent_blocks->loadBlocks('pre-footer-1') as $block){
                            $viewBlock = explode('BlocksComposer@', $block->action);
                            $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']), compact('block',$block));
                        } ?>
                    <?php } ?>
					<?php if($this->mcontent_blocks->countBlocks('pre-footer-2') != 0) { ?>
                        <?php foreach($this->mcontent_blocks->loadBlocks('pre-footer-2') as $block){
                            $viewBlock = explode('BlocksComposer@', $block->action);
                            $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']), compact('block',$block));
                        } ?>
                    <?php } ?>
                    <?php if($this->mcontent_blocks->countBlocks('pre-footer-3') != 0) { ?>
                        <?php foreach($this->mcontent_blocks->loadBlocks('pre-footer-3') as $block){
                            $viewBlock = explode('BlocksComposer@', $block->action);
                            $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']), compact('block',$block));
                        } ?>
                    <?php } ?>
                    <?php if($this->mcontent_blocks->countBlocks('pre-footer-4') != 0) { ?>
                        <?php foreach($this->mcontent_blocks->loadBlocks('pre-footer-4') as $block){
                            $viewBlock = explode('BlocksComposer@', $block->action);
                            $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']), compact('block',$block));
                        } ?>
                    <?php } ?>
				</div>
			</div>
		</div>
		<!-- Tag Bottom
		<div id="tag-bottom">
			<div class="container w-footer">
				<div class="row">
					<div class="col-sm-12">
						<div class="key">
							<a href="">Nhà đất cho thuê</a>
							<a href="">Bán nhà</a>
							<a href="">Cho thuê biệt thự</a>
							<a href="">Căn hộ giá rẻ</a>
							<a href="">Văn phòng</a>
							<a href="">Nhà phố</a>
							<a href="">Văn phòng giá rẻ</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		 -->
		<!-- Info Bottom -->
		<div id="infomation">
			<div class="container w-footer">
				<div class="row">
					<div class="col-md-8 copyright nopadding-rgt">
						<p>SÀN GIAO DỊCH ĐĂNG TIN BẤT ĐỘNG SẢN MIỂN PHÍ  | WEBSITE ĐANG CHỜ GP BỘ TT & TT  </p>
						<p>© Copyright 2016 - 2017  | Tầng 9, 68 Nguyễn Huệ, P. Bến Nghé, Q.1, HCM - <a target="_blank" href="https://website24h.com.vn/" title="Website Bất động sản" style="font-size:7pt; color:#eeeeee"> Website Bất động sản </a>- <a target="_blank" href="https://website24h.com.vn/" title="Thiết kế web bất động sản" style="font-size:7pt; color:#eeeeee"> Thiết kế web bất động sản </a> - <a target="_blank" href="http://foody24h.vn/" title="Chanh dây" style="font-size:7pt; color:#eeeeee"> Chanh dây</a> - <a target="_blank" href="http://foody24h.com/" title="Chanh dây giá sỉ" style="font-size:7pt; color:#eeeeee"> Chanh dây giá sỉ</a> </p>
					</div>
					<div class="col-md-4 no-padding-left">
						<div class="social text-center">
							<a target="_blank" rel="nofollow" href="https://www.facebook.com/dangtinnhadatnhanh" title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a>
							<a target="_blank" rel="nofollow" href="#" title="Twiter"><i class="fa fa-twitter-square fa-2x"></i></a>
							<a target="_blank" rel="nofollow" href="#" title="Youtube"><i class="fa fa-youtube-square fa-2x"></i></a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</footer>
	<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: inline;">Top<span></span></a>
	<?php $this->load->view($modules.'/modal_form'); ?>
	<!--
    <div id="SiteLeft" class="hidden-xs">
		<div class="ban_scroll">
			<div class="item">
				<a id="ban_l1" href="#" rel="nofollow" target="_blank" style="width: 100px;">
					<img src="<?= $domain.'public/default/images/adv-logo/ad_banner-right.jpg';?>" alt="Quảng Cáo Nhà Đất" />
				</a>
			</div>
		</div>
	</div>
	<div id="SiteRight" class="hidden-xs">
		<div class="ban_scroll">
			<div class="item">
				<a id="ban_r1" href="#" rel="dofollow" style="width: 100px;">
					<img src="<?= $domain.'public/default/images/adv-logo/ad_banner-right.gif';?>" alt="Đăng ký thành viên" />
				</a>

			</div>
		</div>
	</div>
	-->

	<div id="boxProductSaved">
		<div class="titlebox">
			<span class="title">Tin đã lưu</span>
			<span id="btn_close" class="hideAll" title="Đóng"><i class="fa fa-angle-down fa-fw"></i></span>
			<span id="deleteAll" title="Xóa tất cả" onclick="deleteAllNews();"><i class="fa fa-times fa-fw"></i></span>
		</div>
		<div>
			<ul class="listbox" style="width: 100%;"></ul>
		</div>
	</div>
	<script src="https://apis.google.com/js/platform.js" type="text/javascript">
		{lang: 'vi'}
	</script>
	<script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/sticky/jquery.sticky.js"></script>
    <script type="text/javascript">
    	jQuery(document).ready(function($) {
    		if($(window).width() > 768){
    			jQuery(window).load(function(){
    				jQuery("#brights").sticky({bottomSpacing: 294});
    			});
    		}
    	});
    </script>
	<!-- Login-->
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Pham Quoc Hieu - 0949.133.224 - quochieuhcm@gmail.com" />
    <title>Admin Panel:: <?= $title; ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,vietnamese,latin-ext,cyrillic-ext" />
    <link rel="stylesheet" href="<?= $root_site ;?>public/admin/css/bootstrap.3.2.0.min.css"/>
    <link rel="stylesheet" href="<?= $root_site ;?>public/admin/admin/css/theme.css"/>
    <link rel="stylesheet" href="<?= $root_site ;?>public/admin/admin/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?= $root_site ;?>public/admin/admin/css/styles.css"/>
    <link rel="stylesheet" href="<?= $root_site ;?>public/admin/admin/css/icons.css"/>
     <!-- JS -->
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/sidebar-active.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/charts/sparkline.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/uniform.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/autoNumeric.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/select2.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/inputmask.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/autosize.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/inputlimit.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/listbox.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/multiselect.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/validate.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/validate.additional.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/tags.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/switch.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/uploader/plupload.full.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/uploader/plupload.queue.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/localization/select2_vi.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/forms/localization/validate_vi.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/daterangepicker.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/fancybox.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/moment.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/jgrowl.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/datatables.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/datatables.tabletools.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/datatables.default.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/colorpicker.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/fullcalendar.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/timepicker.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/interface/collapsible.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/bootstrap/bootstrap.3.2.0.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/toslug.js"></script>
    <script type="text/javascript">
    var base_url = "<?= $root_site; ?>";
    var modules  = "<?= $modules; ?>";
    var controller = "<?= $controller ?>"
    </script>
    <!-- /JS -->
</head>
<body class="navbar-fixed sidebar-wide">
    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= $root_site; ?>admin">Admin Panel</a>
            <a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
                <span class="sr-only">Toggle navbar</span><i class="icon-grid3"></i>
            </button>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar">
                <span class="sr-only">Toggle navigation</span><i class="icon-paragraph-justify2"></i>
            </button>
        </div>
        <ul class="nav navbar-nav collapse" id="navbar-menu">
            <li><a href="<?= $root_site; ?>" target='_blank'><i class="icon-home3"></i>Xem website</a></li>
            <?php
            if (check_show('admin_site',$level))
            {
            ?>
            <li><a href="<?= $root_site.$modules; ?>/usertrackers"><i class="icon-user"></i> Lịch sử đăng nhập</a></li>
            <?php
            }
            ?>
            <li><a href="<?= $root_site.$modules; ?>/profile"><i class="icon-user"></i><span>Thay đổi mật khẩu</span></a></li>
            <li><a href="<?= $root_site ;?>logout.html"><i class="icon-exit"></i> Thoát</a></li>
        </ul>
        <!-- Hello user -->
        <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
            <li class="user dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= $root_site.'public/'.$modules; ?>/images/no-avatar.png" alt="" /><span>Chào <b><?= $this->session->userdata('display_name');; ?></b></span>
                </a>
            </li>
        </ul>
    <!-- /Hello user -->
    </div>
    <!-- /Navbar -->
    <!-- Page container -->
    <div class="page-container <?= $controller == 'tools' || $controller == 'articles' || $controller == 'projects' || $controller == 'tool_project' || $controller == 'realestates' ||$controller == 'tool_raovat' ? 'sidebar-hidden' : '';?>">
        <!-- Sidebar -->
        <div class="sidebar collapse">
            <div class="sidebar-content">
                <!-- Main navigation -->
                <ul class="navigation">
                    <?php $this->load->view($modules.'/sidebar.php'); ?>
                </ul>
              <!-- /Main navigation -->
            </div>
        </div>
        <!-- /Sidebar -->
        <!-- Page content -->
        <div class="page-content">
            <div class="top-cart-info" style="position: relative;right: 0;bottom: 0;"></div>
            <!-- Notify if browser is disabled javascript -->
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
            <!-- /Notify if browser is disabled javascript -->
            <!-- Custom content -->
            <?php $this->load->view($temp); ?>
            <!-- /Custom content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/application.js"></script>
    <script type="text/javascript" src="<?= $root_site.'public/'.$modules;?>/js/application_blank.js"></script>
</body>
</html>
<!-- Page header -->
<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Admin Panel<small>Tất cả các chức năng thuộc quyền quản lý</small>
    </h3>
</div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Bảng điều khiển</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","growl-success")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","growl-error")';
            }
            ?>
        });
    </script>
</div>
<!-- Callout -->
<ul class="info-blocks">
    <?php
    if (check_show('admin_site',$level)) {
    ?>
    <li class="bg-info taikhoan">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/users">Tài khoản</a><small>người dùng</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/users"><i class="icon-user"></i></a>
        <span class="bottom-info bg-primary"><?= countRowTable('users'); ?> người dùng</span>
    </li>
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/menus_items">Menus</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/menus_items"><i class="icon-menu"></i></a>
        <span class="bottom-info bg-primary"><?= countRowTable('menus_items'); ?> menus</span>
    </li>
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/category/index/article">Nhóm bài viết</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/category/index/article"><i class="icon-folder-open"></i></a>
        <span class="bottom-info bg-primary"><?= countRowTable('categories',array('component'=>'article')); ?> nhóm bài viết</span>
    </li>
    
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/category/index/project">Nhóm Dự Án</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/category/index/project"><i class="icon-folder-open"></i></a>
        <span class="bottom-info bg-primary"><?= countRowTable('categories',array('component'=>'project')); ?> nhóm dự án</span>
    </li>
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/category/index/realestate">Nhóm bất động sản</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/category/index/realestate"><i class="icon-folder-open"></i></a>
        <span class="bottom-info bg-primary"><?= countRowTable('categories',array('component'=>'realestate')); ?> nhóm bđs</span>
    </li>
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/realestates/index/1">Bất động sản</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/realestates/index/1"><i class="icon-folder-open"></i></a>
        <span class="bottom-info bg-primary"><?= countRowTable('realestates'); ?> sản phẩm</span>
    </li>
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/external_links">Link Nổi Bật</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/external_links"><i class="icon-link"></i></a>
        <span class="bottom-info bg-primary"><?= countRowTable('external_links'); ?> links</span>
    </li>
    <?php
    }
    ?>
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/articles">Bài viết</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/articles/"><i class="icon-file-word"></i></a>
        <span class="bottom-info bg-primary">
            <?php
            if($this->session->userdata('user_level') == 3){
                echo countRowTable('articles',array('created_by'=>$this->session->userdata('user_id')));
            }else{
                echo countRowTable('articles');
            }
            ?> bài viết
        </span>
    </li>
    <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/projects">Bài viết Dự Án</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/projects"><i class="icon-file-word"></i></a>
        <span class="bottom-info bg-primary">
            <?php
            if($this->session->userdata('user_level') == 3){
                echo countRowTable('articles_projects',array('created_by'=>$this->session->userdata('user_id')));
            }else{
                echo countRowTable('articles_projects');
            }
            ?>
            dự án
        </span>
    </li>
    <!-- <li class="bg-info">
        <div class="top-info">
            <a href="<?= $root_site.$modules; ?>/tools">Công cụ</a><small>trên site</small>
        </div>
        <a href="<?= $root_site.$modules; ?>/tools"><i class="icon-tools"></i></a>
        <span class="bottom-info bg-primary">Lấy tin</span>
    </li> -->
</ul>
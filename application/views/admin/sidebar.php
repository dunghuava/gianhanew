<li><a href="<?= $root_site; ?>admin/dashboard"><span>Bảng điều khiển</span> <i class="icon-screen2"></i></a></li>
<?php
    if (check_show('admin_site',$level)) {
?>
<li><a href="#" class="expand" level="second-level"><span>Cấu hình Site</span> <i class="icon-cogs"></i></a>
    <ul>
        <li><a href="<?= $root_site.$modules; ?>/settings/edit/site">Tổng quan</a></li>
        <li><a href="<?= $root_site.$modules; ?>/settings/edit/article">Bài viết</a></li>
        <li><a href="<?= $root_site.$modules; ?>/settings/edit/project">Dự án</a></li>
        <li><a href="<?= $root_site.$modules; ?>/settings/edit/realestate">Bất động sản</a></li>
    </ul>
</li>
<li><a class="expand" level="second-level" href=""><span>Trình đơn</span><i class="icon-menu2"></i></a>
    <ul>
        <li><a href="<?= $root_site.$modules; ?>/menu_groups">Nhóm trình đơn</a></li>
        <li><a href="<?= $root_site.$modules; ?>/menus_items">Trình đơn</a></li>       
    </ul>
</li>
<li><a href="<?= $root_site.$modules; ?>/pages"><span>Trang web</span> <i class="icon-folder"></i></a></li>
<li><a href="<?= $root_site.$modules; ?>/advertings"><span>Quảng cáo</span> <i class="icon-folder"></i></a></li>
<li><a href="#" class="expand" level="second-level"><span>Quản lý nhóm</span> <i class="icon-folder-open"></i></a>
    <ul>
        <li><a href="<?= $root_site.$modules; ?>/category/index/article">1. Nhóm bài viết</a></li>
        <li><a href="<?= $root_site.$modules; ?>/category/index/project">2. Nhóm dự án</a></li>
        <li><a href="<?= $root_site.$modules; ?>/category/index/contact">3. Nhóm danh bạ</a></li>
        <li><a href="<?= $root_site.$modules; ?>/category/index/realestate">4. Nhóm bất động sản</a></li>       
    </ul>
</li>
<li><a href="<?= $root_site.$modules;?>/contacts"> Danh bạ<i class="icon-contact-add"></i></a></li>
<li><a href="<?= $root_site.$modules;?>/content_blocks"><span>Khối nội dung</span><i class="icon-delicious"></i></a></li>
<li><a href="<?= $root_site.$modules;?>/users"><span>Người dùng</span> <i class="icon-user"></i></a></li>
<?php
}
?>
<li><a href="#" class="expand" level="second-level"><span>Quản lý Bài Viết</span> <i class="icon-file-word"></i></a>
    <ul>
        <li><a href="<?= $root_site.$modules; ?>/articles/index/article">Bài Viết</a></li>       
    </ul>
</li>
<li><a href="<?= $root_site.$modules; ?>/projects"><span>Quản lý Dự Án</span> <i class="icon-file-word"></i></a></li>
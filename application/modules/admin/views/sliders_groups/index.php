<!-- Page header -->
<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Danh sách nhóm
        <small>Danh sách tất cả các nhóm slider</small>
    </h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules.'/slider_groups'; ?>">Nhóm Slider</a></li>
        <li class="active">Danh sách</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <?php 
    if ($this->session->flashdata('success')) {
        ?>
        <div class="callout callout-success fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Hoàn tất nghiệp vụ</h5>
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<div id="errors">
    <?php 
    if ($this->session->flashdata('error')) {
        ?>
        <div class="callout callout-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Đã có lỗi</h5>
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<!-- /Callout -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.sliders_groups.js"></script>
<!-- Custom content -->
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách nhóm slide đang có</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="sliders_groups">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tiêu để</th>
                    <th style="width: 120px;" class="text-center">Cập nhật bới</th>
                    <th style="width: 120px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 110px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($sliders_groups)) {
                    foreach ($sliders_groups as $key => $slider_group) {
                ?>
                <tr index="<?= $slider_group->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $slider_group->id; ?></td>
                    <td><?= $slider_group->title; ?></td>
                    <td class="text-center"><?= $slider_group->username; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($slider_group->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/sliders_groups/destroy/<?= $slider_group->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa nhóm slider có ID <?= $slider_group->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/sliders_groups/update/<?= $slider_group->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
        <!-- /Custom content -->
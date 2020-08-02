<!-- Page header -->
<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Danh sách ảnh
        <small>Danh sách tất cả các ảnh của slider</small>
    </h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules.'/sliders'; ?>">Slider ảnh</a></li>
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
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.sliders.js"></script>
<!-- Custom content -->
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách slide đang có</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="sliders">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tiêu để</th>
                    <th style="width: 110px;" class="text-center">Ảnh</th>
                    <th style="width: 110px;" class="text-center">Nhóm</th>
                    <th style="width: 110px;" class="text-center">Thứ tự slide</th>
                    <th style="width: 110px;" class="text-center">Công bố</th>
                    <th style="width: 110px;" class="text-center">Cập nhật bới</th>
                    <th style="width: 110px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 110px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($sliders)) {
                    foreach ($sliders as $key => $slider) {
                ?>
                <tr index="<?= $slider->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $slider->id; ?></td>
                    <td><?= json_decode($slider->params)->title; ?></td>
                    <td class="text-center"><a href="<?= $root_site.'uploads/sliders/'.$slider->image; ?>" class="lightbox">Xem ảnh</a></td>
                    <td style="width: 115px;" class="text-center"><?= $slider->group_title; ?></td>
                    <td class="text-center"><?= $slider->ordering; ?></td>
                    <td style="text-align:center;">
                        <?= ($slider->public == 1) ? '<span class="label label-info">Có</span>' : '<span class="label label-danger">Không</span>';?>
                    </td>
                    <td class="text-center"><?= $slider->username; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($slider->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/sliders/destroy/<?= $slider->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa slide có ID <?= $slider->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/sliders/update/<?= $slider->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
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
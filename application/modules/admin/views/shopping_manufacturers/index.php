<!-- Page header -->
<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Danh sách nhà sản xuất
        <small>Danh sách tất cả các nhà sản xuất hiện có</small>
    </h3>
</div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li>Nhà sản xuất</li>
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
            <h5>Hoàn tất nghiệp vụ</h5>
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<!-- /Callout -->
<script type="text/javascript" src="<?= $root_site; ?>public/admin/js/admin.shopping_manufacturers.js"></script>
<!-- Custom content -->
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách nhà sản xuất</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="shopping_manufacturers" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="shopping_manufacturers">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tên nhà sản xuất</th>
                    <th style="width: 115px;" class="text-center">Công bố</th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($manufacturers as $manufacturer){
                ?>
                <tr index="<?= $manufacturer->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $manufacturer->id; ?></td>
                    <td><?= $manufacturer->title; ?></td>
                    <td class="text-center">
                        <?= ($manufacturer->public == 1) ? '<span class="label label-info">Có</span>' : '<span class="label label-danger">Không</span>';?>
                        
                    </td>                    
                    <td class="text-center"><?= $manufacturer->username; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($manufacturer->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/shopping_manufacturers/destroy/<?= $manufacturer->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa"><i class="icon-remove"></i></a>
                            <a href="<?= $root_site.$modules; ?>/shopping_manufacturers/update/<?= $manufacturer->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
<!-- /Custom content -->

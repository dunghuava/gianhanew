 <!-- Page header -->
 <div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Danh sách Size
        <small>Danh sách Size cho sản phẩm</small>
    </h3>
</div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li class="active">Size sản phẩm</li>
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
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.size.js"></script>
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách size sản phẩm</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="shopping_size" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="shopping_size">
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th>Size</th>
                    <th style="width: 115px;" class="text-center">Mô tả</th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($sizes as $size){
                ?>
                <tr index="<?= $size->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $size->id; ?></td>
                    <td><?= $size->title; ?></td>
                    <td style="width: 115px;" class="text-center"><?= $size->summary; ?></td>
                    <td class="text-center"><?= $size->username; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($size->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/shopping_size/destroy/<?= $size->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa size có ID <?= $size->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/shopping_size/update/<?= $size->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
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

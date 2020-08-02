<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách Sản phẩm <small>Danh sách tất cả sản phẩm hiện có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Sản phẩm</li>
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
        <div class="callout callout-success fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Đã có lỗi xảy ra</h5>
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.shopping_products.js"></script>
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách sản phẩm đang có</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="shopping_products" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="shopping_products">
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th style="width: 45px;" class="text-center"><input type="checkbox" id="checkall" /></th>
                    <th>Tiêu đề</th>
                    <th style="width: 115px;" class="text-center">Ảnh minh họa</th>
                    <th style="width: 115px;" class="text-center">Nhóm</th>
                    <th style="width: 100px;" class="text-center">Công bố</th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($products as $product){
                ?>
                <tr index="<?= $product->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td class="text-center"><?= $product->id; ?></td>
                    <td class="text-center"><input type="checkbox" class="checkthis" value="<?= $product->id; ?>" /></td>
                    <td><?= $product->title;?></td>
                    <td class="text-center"><a href="<?= $root_site.'uploads/shopping_products/'.$product->image;?>" class="lightbox">Xem ảnh</a></td>
                    <td style="width: 115px;" class="text-center"><?= $product->cate_title; ?></td>
                    <td style="text-align:center;">
                        <?= ($product->public == 1) ? '<span class="label label-info">Có</span>' : '<span class="label label-danger">Không</span>';?>
                    </td>
                    <td class="text-center"><?= $product->username; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($product->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/shopping_products/destroy/<?= $product->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa sản phẩm có ID <?= $product->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/shopping_products/update/<?= $product->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                }?>
            </tbody>
        </table>
    </div>
</div>
    <!-- /Table -->
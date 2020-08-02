 <!-- Page header -->
 <div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Thêm đơn vị
        <small>Tạo một size mới cho sản phẩm</small>
    </h3>
</div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li><a href="<?= $root_site.$modules.'/shopping_size'; ?>">Size sản phẩm</a></li>
    <li class="active">Thêm mới</li>
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
<?= validation_errors('<div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger">','</li></ul></div></div>'); ?>
<?php 
if (isset($error)) {
    ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
    <?php 
} 
?>
<!-- /Callout -->

<!-- Custom content -->
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" name="fSizes">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-cogs"></i> Thông tin cơ bản</h6>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="title">Size <span class="mandatory">*</span>:</label>
                        <input class="form-control" id="title" name="title" type="text" value="<?= $this->input->post('title'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="ordering">Thứ tự <span class="mandatory">*</span>:</label>
                        <input class="form-control" id="ordering" name="ordering" type="text" value="<?= $this->input->post('ordering'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="summary">Mô tả:</label>
                        <textarea class="form-control" id="summary" name="summary" cols="50" rows="10"><?= $this->input->post('summary'); ?></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Form actions -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-actions">
                        <a href="<?= $root_site.$modules.'/shopping_size'; ?>" class="btn btn-info">Hủy</a>
                        <input class="btn btn-danger" name="btnCreate" type="submit" value="Thêm mới">
                    </div>
                </div>
            </div>
            <!-- /Form actions -->
            
        </div>
    </div>
</form>
<!-- /Form -->
<!-- /Custom content -->
<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Thay đổi mật khẩu
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Thay đổi mật khẩu</li>
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
        <h5>Finished</h5>
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
<form action="" method="post">
    <div class="row">
        <div class="col-xs-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger"><a data-toggle="collapse" data-parent="#accordion" href="#required"><i class="icon-cogs"></i> Input information</a></h6>
                    </div>
                    <div id="required" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Mật khẩu cũ <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="password_old" type="password">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title_alias">Mật khẩu mới <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="password_new" type="password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title_alias">Nhập lại mật khẩu mới <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="password_confirm" type="password" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Panel group -->
        </div>
    </div>

    <!-- Form actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-actions">
                <a href="<?= $root_site; ?>admin" class="btn btn-info">Hủy</a>
                <input type="submit" name="btnCreate" value="Cập nhật" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
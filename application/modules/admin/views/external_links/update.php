<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Cập nhật <small>Cập nhật thông tin cơ bản liên kết nổi bật</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules;?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules;?>/external_links">Liên kết nổi bật</a></li>
        <li class="active">Cập nhật</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->

<!-- Callout -->
<div id="message">
</div>

<div id="errors">
</div>
<!-- /Callout -->
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
<!-- Custom content -->
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string() ?>" accept-charset="UTF-8" name="fSliderGroups">
    <div class="row">
        <div class="col-md-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger active"><a data-toggle="collapse" data-parent="#accordion" href="#required"><i class="icon-cogs"></i> Thông tin cơ bản</a></h6>
                    </div>
                    <div id="required" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Tiêu đề<span class="mandatory">*</span>:</label>
                                        <input class="form-control" id="title" name="title" type="text" value="<?= $external_link->title; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Liên kết <span class="mandatory">*</span>:</label>
                                        <input class="form-control" value="<?= $external_link->title_alias; ?>" type="text" name="title_alias" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Thứ tự <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="ordering" type="number" value="<?= $external_link->ordering; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="public">Công bố ?</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" <?= $external_link->public == 1 ? 'checked' : '';  ?> name="public" type="radio" value="1"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= $external_link->public == 0 ? 'checked' : '';  ?> name="public" type="radio" value="0"> Không
                                            </label>
                                        </div>
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
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <a href="<?= $root_site.$modules;?>/sliders_groups" class="btn btn-info">Hủy</a>
                <input class="btn btn-danger" name="btnCreate" type="submit" value="Thêm mới">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
        <!-- /Custom content -->
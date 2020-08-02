<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Cập nhật nhà sản xuất
            <small>Chỉnh sửa thông tin nhà sản xuất mới</small>
        </h3>
    </div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li><a href="<?= $root_site.$modules.'/shopping_manufacturers'; ?>">Nhà sản xuất</a></li>
    <li class="active">Cập nhật</li>
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
<script type="text/javascript" src="<?= $root_site; ?>public/admin/js/admin.shopping_manufacturers.js"></script>
<!-- Custom content -->
<!-- Form -->

<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" name="fManufacturers" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-cogs"></i> Thông tin nhà sản xuất</h6>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="title">Tên nhà sản xuất <span class="mandatory">*</span>:</label>
                                <input class="form-control" id="title" name="title" type="text" value="<?= $manufacturer->title; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="title_alias">Tên bí danh <span class="mandatory">*</span>:</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button name="createAlias" class="btn btn-default" type="button">Tạo</button>
                                    </span>
                                    <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?= $manufacturer->title_alias; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="logo">Logo:</label>
                                <input class="styled" id="image" name="image" type="file">
                                <div class="thumbnails">
                                    <?php
                                    if (isset($manufacturer->image) && !empty($manufacturer->image)) {
                                    ?>
                                    <a href="<?= $root_site; ?>uploads/shopping_manufacturers/<?= $manufacturer->image; ?>" class="lightbox">
                                        <img src="<?= $root_site; ?>uploads/shopping_manufacturers/<?= $manufacturer->image; ?>" class="img-thumbnail img-responsive" />
                                    </a>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="url">Website:</label>
                                <input class="form-control" id="url" name="url" type="text" value="<?= $manufacturer->url; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="public">C&ocirc;ng bố?:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" <?= $manufacturer->public == 1 ? 'checked' : ''; ?> name="public" type="radio" value="1" id="public"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" <?= $manufacturer->public == 0 ? 'checked' : ''; ?> name="public" type="radio" value="0" id="public"> Không
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="featured">Là nhà sản xuất nổi bật?:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" <?= $manufacturer->featured == 1 ? 'checked' : ''; ?> name="featured" type="radio" value="1" id="featured"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" <?= $manufacturer->featured == 0 ? 'checked' : ''; ?> name="featured" type="radio" value="0" id="featured"> Không
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $params = json_decode($manufacturer->params); ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta description:</label>
                                <textarea class="form-control" rows="7" name="params[meta_description]" cols="50" id="params[meta_description]"><?= $params->meta_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords:</label>
                                <textarea class="form-control" rows="7" name="params[meta_keywords]" cols="50" id="params[meta_keywords]"><?= $params->meta_keywords; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="summary">Giới thiệu về nhà sản xuất:</label>
                        <textarea class="form-control" id="summary" name="summary" cols="50" rows="10"><?= $manufacturer->summary; ?></textarea>
                        <script type="text/javascript">
                            CKEDITOR.env.isCompatible = true;
                            CKEDITOR.replace('summary');
                        </script>
                    </div>
                </div>
            </div>
            <!-- Form actions -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-actions">
                        <a href="<?= $root_site.$modules.'/shopping_manufacturers' ?>" class="btn btn-info">Hủy</a>
                        <input class="btn btn-danger" name="btnCreate" type="submit" value="Cập nhật">
                    </div>
                </div>
            </div>
            <!-- /Form actions -->
        </div>
    </div>
</form>
<!-- /Form -->
<!-- /Custom content -->

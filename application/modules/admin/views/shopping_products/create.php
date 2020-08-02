<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Thêm sản phẩm<small>Tạo mới sản phẩm trên site</small>
    </h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/shopping_products">Sản phẩm</a></li>
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
<div id="errors">
    <?php 
    if ($this->session->flashdata('error')) {
        ?>
        <div class="callout callout-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Đã xảy ra lỗi</h5>
            <p><?= $this->session->flashdata('error'); ?></p>
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
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.shopping_products.js"></script>
<!-- Custom content -->
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" id="fProducts" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <!-- Panel group -->
    <div class="panel-group block-inner" id="accordion">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title panel-trigger active"><a data-toggle="collapse" data-parent="#accordion" href="#basic-info"><i class="icon-cogs"></i> Thông tin cơ bản</a></h6>
            </div>
            <div id="basic-info" class="panel-collapse collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="image">Ảnh minh họa <span class="mandatory">*</span>:</label>
                                <input class="styled" id="image" name="image" type="file">
                            </div>
                            <div class="col-md-6">
                                <label>Nhóm sản phẩm <span class="mandatory">*</span>:</label>
                                <select class="select-search" name="category_id">
                                    <?php callMenu($category,0,'|--',$this->input->post('category')); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">Tiêu đề sản phẩm <span class="mandatory">*</span>:</label>
                                <input class="form-control" id="title" name="title" type="text" value="<?= $this->input->post('title'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="title_alias">Tên bí danh <span class="mandatory">*</span>:</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button name="createAlias" class="btn btn-default" type="button">Tạo</button>
                                    </span>
                                    <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?= $this->input->post('title_alias'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nhà sản xuất<span class="mandatory">*</span>:</label>
                                <select class="select-search" name="manufacturer_id">
                                    <option value="0">Chọn nhà sản xuất</option>
                                    <?php
                                    if (!empty($manufacturers)) {
                                        foreach ($manufacturers as $manufacturer) {
                                    ?>
                                    <option value="<?= $manufacturer->id;?>" <?= ($manufacturer->id == $this->input->post('manufacturer_id')) ? 'selected' : ''; ?>><?= $manufacturer->title;?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Xuất xứ<span class="mandatory">*</span>:</label>
                                <select class="select-search" name="made_in">
                                    <?php
                                    foreach (location_list() as $key => $location) {
                                    ?>
                                    <option value="<?= $key; ?>" <?= ($key == 'VN' || $key == $this->input->post('made_in')) ? 'selected' : ''; ?>><?= $location; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="price">Giá sản phẩm (cũ):</label>
                                <div class="input-group">
                                    <input class="form-control auto" id="price" data-a-sep="." data-a-dec="," data-v-max="99999999999999" data-v-min="0" name="price" type="text" value="<?= $this->input->post('price') ?>">
                                    <span class="input-group-addon">VNĐ</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="price">Giá sản phẩm (mới):</label>
                                <div class="input-group">
                                    <input class="form-control auto" id="old_price" data-a-sep="." data-a-dec="," data-v-max="99999999999999" data-v-min="0" name="old_price" type="text" value="<?= $this->input->post('old_price') ?>">
                                    <span class="input-group-addon">VNĐ</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="price">Tỉ lệ discount::</label>
                                <div class="input-group">
                                    <input class="form-control auto" id="discount_rate" data-a-sep="." data-a-dec="," data-v-max="99999999999999" data-v-min="0" name="discount_rate" type="text" value="<?= $this->input->post('discount_rate') ?>">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Size<span class="mandatory">*</span>:</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select multiple="multiple" class="multi-select" tabindex="2" name="size_id[]">
                                            <?php
                                            if (!empty($sizes)) {
                                                foreach ($sizes as $key => $size) {
                                            ?>
                                            <option selected value="<?= $size->id ?>"><?= $size->title; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="public">Công bố sản phẩm:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" checked name="public" type="radio" value="1" id="public"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" name="public" type="radio" value="0" id="public"> Không
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="status">Trạng thái bán hàng:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" checked name="status" type="radio" value="1" id="status"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" name="status" type="radio" value="0" id="status"> Không
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="params[allow_comment]">Cho phép bình luận:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" checked="checked" name="params[allow_comment]" type="radio" value="1" id="params[allow_comment]"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" name="params[allow_comment]" type="radio" value="0" id="params[allow_comment]"> Không
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="featured">Đây là sản phẩm nổi bật:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" name="featured" type="radio" value="1" id="featured"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" checked="checked" name="featured" type="radio" value="0" id="featured"> Không
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title panel-trigger"><a data-toggle="collapse" data-parent="#accordion" href="#detail-info"><i class="icon-file6"></i> Thông tin chi tiết</a></h6>
            </div>
            <div id="detail-info" class="panel-collapse collapse">
                <?= $detail = $this->input->post('detail'); ?>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="detail[features]">Tính năng:</label>
                                <textarea class="form-control" id="detail[featured]" name="detail[featured]" cols="50" rows="10"><?= $detail['featured']; ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.env.isCompatible = true;
                                    CKEDITOR.replace('detail[featured]');
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="detail[specifications]">Thông số kỹ thuật:</label>
                                <textarea class="form-control" id="detail[specifications]" name="detail[specifications]" cols="50" rows="10"><?= $detail['specifications']; ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.env.isCompatible = true;
                                    CKEDITOR.replace('detail[specifications]');
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title panel-trigger"><a data-toggle="collapse" data-parent="#accordion" href="#extended-info"><i class="icon-target"></i> Thông tin mở rộng</a></h6>
            </div>
            <div id="extended-info" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="tags">Đánh dấu thẻ:</label>
                                <input class="tags" name="tags" type="text" id="tags" value="<?= $this->input->post('tags') ?>">
                            </div>
                        </div>
                    </div>
                    <?php $params = $this->input->post('params'); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta description:</label>
                                <textarea class="form-control" rows="7" name="params[meta_description]" cols="50" id="params[meta_description]"><?= $params['meta_description']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords:</label>
                                <textarea class="form-control" rows="7" name="params[meta_keywords]" cols="50" id="params[meta_keywords]"><?= $params['meta_keywords']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Panel group -->

    <!-- Form actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-actions">
                <a href="<?= $root_site.$modules; ?>/shopping_products" class="btn btn-info">Hủy</a>
                <input class="btn btn-danger" name="btnCreate" type="submit" value="Thêm mới">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
 <!-- /Custom content -->
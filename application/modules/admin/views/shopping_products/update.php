<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Cập nhật sản phẩm<small>Cập nhật sản phẩm trên site</small>
    </h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/shopping_products">Sản phẩm</a></li>
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
                    <div class="col-xs-2">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <label for="current_image">Ảnh hiện tại:</label>
                                    <?php
                                    if (!empty($product->image)) {
                                        ?>
                                        <a href="<?= $root_site.'uploads/shopping_products/'.$product->image; ?>" class='lightbox'>
                                            <img src="<?= $root_site.'uploads/shopping_products/'.$product->image; ?>" class="img-thumbnail img-responsive" />
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="image">Ảnh minh họa <span class="mandatory">*</span>:</label>
                                        <input class="styled" id="image" name="image" type="file">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nhóm sản phẩm <span class="mandatory">*</span>:</label>
                                        <select class="select-search" name="category_id">
                                            <?php callMenu($category,0,'|--',$product->category_id) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title">Tiêu đề sản phẩm <span class="mandatory">*</span>:</label>
                                        <input class="form-control" id="title" name="title" type="text" value="<?= $product->title; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title_alias">Tên bí danh <span class="mandatory">*</span>:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button name="reCreateAlias" class="btn btn-default" type="button">Tạo</button>
                                            </span>
                                            <input class="form-control" id="title_alias" name="title_alias"  readonly="readonly" type="text" value="<?= $product->title_alias; ?>">
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
                                                    <option value="<?= $manufacturer->id;?>" <?= ($manufacturer->id == $product->manufacturer_id) ? 'selected' : ''; ?>><?= $manufacturer->title;?></option>
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
                                                <option value="<?= $key; ?>" <?= ($key == $product->made_in) ? 'selected' : ''; ?>><?= $location; ?></option>
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
                                            <input class="form-control auto" id="price" data-a-sep="." data-a-dec="," data-v-max="99999999999999" data-v-min="0" name="price" type="text" value="<?= $product->price;?>">
                                            <span class="input-group-addon">VNĐ</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="old_price">Giá sản phẩm (mới):</label>
                                        <div class="input-group">
                                            <input class="form-control auto" id="old_price" data-a-sep="." data-a-dec="," data-v-max="99999999999999" data-v-min="0" name="old_price" type="text" value="<?= $product->old_price;?>">
                                            <span class="input-group-addon">VNĐ</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price">Tỉ lệ discount::</label>
                                        <div class="input-group">
                                            <input class="form-control auto" id="discount_rate" data-a-sep="." data-a-dec="," data-v-max="99999999999999" data-v-min="0" name="discount_rate" type="text" value="<?= $product->discount_rate; ?>">
                                            <span class="input-group-addon">%</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <?php $size_id = explode(',', $product->size_id);?>
                                        <label>Size<span class="mandatory">*</span>:</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select multiple="multiple" class="multi-select" tabindex="2" name="size_id[]">
                                                    <?php
                                                    if (!empty($sizes)){
                                                        foreach ($sizes as $key => $size) {
                                                            echo '<option ';
                                                            if (!empty($size_id) && is_array($size_id)) {
                                                                foreach ($size_id as $val) {
                                                                    if ($size->id == $val) {
                                                                        echo "selected ";
                                                                    }
                                                                }
                                                            }
                                                            echo 'value="'.$size->id.'">'.$size->title.'</option>';
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
                                                <input class="styled" <?= ($product->public == 1) ? 'checked' : ''; ?> name="public" type="radio" value="1" id="public"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= ($product->public == 0) ? 'checked' : ''; ?> name="public" type="radio" value="0" id="public"> Không
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status">Trạng thái bán hàng:</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" <?= ($product->status == 1) ? 'checked' : ''; ?> name="status" type="radio" value="1" id="status"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= ($product->status == 0) ? 'checked' : ''; ?> name="status" type="radio" value="0" id="status"> Không
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="params[allow_comment]">Cho phép bình luận:</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" <?= (json_decode($product->params)->allow_comment == 1) ? 'checked' : ''; ?> name="params[allow_comment]" type="radio" value="1" id="params[allow_comment]"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= (json_decode($product->params)->allow_comment == 1) ? 'checked' : ''; ?> name="params[allow_comment]" type="radio" value="0" id="params[allow_comment]"> Không
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="featured">Đây là sản phẩm nổi bật:</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" <?= ($product->featured == 1) ? 'checked' : ''; ?> name="featured" type="radio" value="1" id="featured"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= ($product->featured == 0) ? 'checked' : ''; ?> name="featured" type="radio" value="0" id="featured"> Không
                                            </label>
                                        </div>
                                    </div>
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
                                <textarea class="form-control" id="detail[features]" name="detail[features]" cols="50" rows="10"><?= isset(json_decode($product->detail)->features) ? json_decode($product->detail)->features : ''; ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.env.isCompatible = true;
                                    CKEDITOR.replace('detail[features]');
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="detail[specifications]">Thông số kỹ thuật:</label>
                                <textarea class="form-control" id="detail[specifications]" name="detail[specifications]" cols="50" rows="10"><?= json_decode($product->detail)->specifications; ?></textarea>
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
                                <textarea class="form-control" rows="5" name="params[meta_description]" cols="50" id="params[meta_description]"><?= json_decode($product->params)->meta_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords:</label>
                                <textarea class="form-control" rows="3" name="params[meta_keywords]" cols="50" id="params[meta_keywords]"><?= json_decode($product->params)->meta_keywords; ?></textarea>
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
                <input class="btn btn-danger" name="btnCreate" type="submit" value="Cập nhật">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
 <!-- /Custom content -->
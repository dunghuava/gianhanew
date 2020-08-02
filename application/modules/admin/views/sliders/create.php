<!-- Page header -->
<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Thêm ảnh slider
        <small>Thêm một ảnh mới cho slider</small>
    </h3>
</div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li><a href="<?= $root_site.$modules; ?>/sliders">Slider ảnh</a></li>
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
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" name="fSlider" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-cogs"></i> Thông tin ảnh</h6>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Nhóm slider <span class="mandatory">*</span>:</label>
                                <select class="select-search" name="group_id">
                                    <?php
                                    if (!empty($sliders_groups)) {
                                        foreach ($sliders_groups as $sliders_group) {
                                    ?>
                                    <option value="<?= $sliders_group->id; ?>" <?= ($sliders_group->id == $this->input->post('group_id')) ? 'selected' : ''; ?>><?= $sliders_group->title; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="image">Ảnh slider <span class="mandatory">*</span>:</label>
                                <input class="styled" id="image" name="image" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="ordering">Thứ tự ảnh:</label>
                                <input class="form-control" id="ordering" name="ordering" type="text" value="<?= $this->input->post('ordering'); ?>">
                            </div>
                        </div>
                    </div>
                    <?php $params = $this->input->post('params'); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[title]">Tiêu đề ảnh:</label>
                                <input class="form-control" id="params[title]" name="params[title]" type="text" value="<?= $params['title']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[content]">Nội dung ảnh:</label>
                                <textarea class="form-control" id="params[content]" name="params[content]" cols="50" rows="10"><?= $params['content']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[readmore]">Liên kết chi tiết:</label>
                                <input class="form-control" id="params[readmore]" name="params[readmore]" type="text" value="<?= $params['readmore']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="public">Công bố ảnh:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" checked name="public" type="radio" value="1" id="public"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" name="public" type="radio" value="0" id="public"> Không
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form actions -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">
                                <a href="<?= $root_site.$modules; ?>/sliders" class="btn btn-info">Hủy</a>
                                <input class="btn btn-danger" name="btnCreate" type="submit" value="Thêm mới">
                            </div>
                        </div>
                    </div>
                    <!-- /Form actions -->

                </div>
            </div>
        </div>
    </div>
</form>
<!-- /Form -->
        <!-- /Custom content -->
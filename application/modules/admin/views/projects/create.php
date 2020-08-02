<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Dự án<small>Tạo mới một dự án trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/projects">Dự án</a></li>
        <li class="active">Thêm mới</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
            <?= validation_errors("_toastr('","','jGrowl-alert-danger')"); ?>
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","jGrowl-alert-success")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","jGrowl-alert-danger")';
            }
            ?>
        });
    </script>
</div>
<!-- Callout -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.projects.js"></script>
<!-- Custom content -->
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" id="fProjects" enctype="multipart/form-data">
    <!-- Panel group -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-cogs"></i> Thông tin cơ bản</h6>
        </div>
        <div class="panel-body">
            <div class="tabbable block">
                <ul class="nav toolbar-tabs nav-tabs">
                    <li class="active">
                        <a href="#basic-info" data-toggle="tab"><i class="fa fa-cogs fa-fw"></i>Thông tin cơ bản</a>
                    </li>
                    <li>
                        <a href="#detail-info" data-toggle="tab"><i class="fa fa-file-word-o fa-fw"></i>Nội dung</a>
                    </li>
                    <li><a href="#info-contact" data-toggle="tab"><i class="icon-contact-add"></i>Liên hệ</a></li>
                    <li>
                        <a href="#extended-info" data-toggle="tab"><i class="fa fa-globe fa-fw"></i>Cấu hình SEO</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content pill-content">
                <div class="tab-pane fade in active" id="basic-info">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="image">Ảnh minh họa:</label>
                                <div id="previewImage">
                                    <img src="<?= $root_site.'public/'.$modules;?>/images/no-image.jpg" class="img-resposnive center-block" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="styled" id="image" name="image" type="file" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Nhóm dự án <span class="mandatory">*</span>:</label>
                                        <select class="select-search" name="category_id">
                                            <?php callMenu($category,0,'|--',$this->input->post('category_id')); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php $params = $this->input->post('params'); ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title">Tỉnh / Thành Phố<span class="mandatory">*</span>:</label>
                                        <select class="select-search" name="province_id" id="province_id">
                                            <option value="0">Chọn tỉnh / thành phố</option>
                                            <?php
                                            if (!empty($provinces)) {
                                                foreach ($provinces as $key => $province) {
                                                    ?>
                                                    <option value="<?= $province->province_id ?>"><?= $province->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title_alias">Quận / Huyện<span class="mandatory">*</span>:</label>
                                        <select class="select-search" name="district_id" id="district_id">
                                            <option value="0">Chọn Quận / Huyện</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title">Tiêu đề <span class="mandatory">*</span>:</label>
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
                                        <label for="params[address]">Địa chỉ<span class="mandatory">*</span>:</label>
                                        <input class="form-control" id="params[address]" name="params[address]" type="text" value="<?= $params['address']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="params[phone]">Điện thoại:</label>
                                        <input class="form-control" id="params[phone]" name="params[phone]" type="text" value="<?= $params['phone']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="params[website]">Website :</label>
                                        <input class="form-control" id="params[website]" name="params[website]" type="text" value="<?= $params['website']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="params[email]">Email :</label>
                                        <input class="form-control" id="params[email]" name="params[email]" type="text" value="<?= $params['email']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="public">Công bố dự án:</label>
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
                                    <div class="col-md-6">
                                        <label for="featured">Đây là dự án nổi bật:</label>
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
                <div class="tab-pane fade" id="detail-info">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="summary">Nội dung tóm lược:</label>
                                <textarea class="form-control" rows="3" name="summary" cols="50" id="summary"><?= $this->input->post('summary'); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="content">Nội dung bài viết <span class="mandatory">*</span>:</label>
                                <textarea class="form-control" id="content" name="content" cols="50" rows="10"><?= $this->input->post('content') ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.env.isCompatible = true;
                                    CKEDITOR.replace('content');
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="info-contact">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Danh bạ liên hệ :</label>
                                <select class="select-search" name="contact_id">
                                    <option value="0">Nhóm danh bạ</option>
                                    <?php if ($this->mcontacts->get_all_pages()) { ?>
                                    <?php foreach ($this->mcontacts->get_all_pages() as $k => $contact) { ?>
                                    <option value="<?=$contact['id']?>" <?= $this->input->post('contact_id') ? 'selected' : '' ?>><?=$contact['title'] ?></option>
                                    <?php } ?>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="extended-info">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="tags">Đ&aacute;nh dấu thẻ:</label>
                                <input class="tags" name="tags" type="text" id="tags" value="<?= $this->input->post('tags'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta title:</label>
                                <input type="text" class="form-control" name="params[meta_title]" value="<?= $params['meta_title']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta description:</label>
                                <textarea class="form-control" rows="3" name="params[meta_description]" cols="50" id="params[meta_description]"><?= $params['meta_description']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords:</label>
                                <input type="text" class="form-control" name="params[meta_keywords]" value="<?= $params['meta_keywords']; ?>" />
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
            <div class="form-actions pull-right">
                <a href="<?= $root_site.$modules; ?>/projects" class="btn btn-cancel">Hủy</a>
                <input class="btn btn-success" name="btnCreate" type="submit" value="Thêm mới">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
</form>
<!-- /Form -->
 <!-- /Custom content -->
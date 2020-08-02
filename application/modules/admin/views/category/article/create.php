<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Nhóm bài viết<small>Thêm một nhóm bài viết mới</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/category/index/article">Nhóm bài viết</a></li>
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
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/categories.js"></script>
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-plus-square" aria-hidden="true"></i>Thêm mới nhóm</h6>
        </div>
        <div class="panel-body">
            <div class="tabbable block">
                <ul class="nav toolbar-tabs nav-tabs">
                    <li class="active">
                        <a href="#required" data-toggle="tab"><i class="fa fa-info fa-fw"></i>Thông tin cơ bản</a>
                    </li>
                    <li>
                        <a href="#detail" data-toggle="tab"><i class="fa fa-file-word-o fa-fw"></i>Thông tin mở rộng</a>
                    </li>
                    <li>
                        <a href="#extended-info" data-toggle="tab"><i class="fa fa-globe fa-fw"></i>Cấu hình SEO</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content pill-content">
                <div class="tab-pane fade in active" id="required">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="form-group previewImage">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="previewImage">
                                            <img src="<?= $root_site.'public/'.$modules;?>/images/no-image.jpg" class="img-resposnive center-block" />
                                        </div>
                                    </div>
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
                        <!-- /.col-xs-3 -->
                        <div class="col-xs-9">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="title">Danh mục nhóm<span class="mandatory">*</span>:</label>
                                        <select class="select-search" id="parent_id" name="parent_id">
                                            <option value="0">|-- Đây là nhóm cha</option>
                                            <?php callMenu($category,0,'|-- ',$this->input->post('parent_id')); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nhóm Advertings :</label>
                                        <select class="select-search" name="group_id">
                                            <option value="-1">Chọn nhóm advertings</option>
                                            <?php if (!empty($groups)) { ?>
                                                <?php foreach ($groups as $group) { ?>
                                                <option value="<?= $group->id;?>"><?= $group->title;?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="title">Tiêu đề <span class="mandatory">*</span>:</label>
                                        <input class="form-control" id="title" name="title" value="<?= $this->input->post('title'); ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="title_alias">URL <span class="mandatory">*</span>:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button name="createAlias" class="btn btn-default" type="button">Đề xuất</button>
                                            </span>
                                            <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?= $this->input->post('title_alias'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="public">Công bố ?</label>
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
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="detail">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Nội dung tóm lược:</label>
                                <textarea class="form-control" rows="5" name="summary" cols="50"><?= $this->input->post('summary'); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $params = $this->input->post('params'); ?>
                <div class="tab-pane fade" id="extended-info">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_title]">Meta title</label>
                                <input class="form-control" name="params[meta_title]" type="text" value="<?= $params['meta_title']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta description</label>
                                <textarea class="form-control" rows="3" name="params[meta_description]" cols="50"><?= $params['meta_description']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords</label>
                                <input class="form-control" type="text" name="params[meta_keywords]" value="<?= $params['meta_keywords']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form actions -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-actions pull-right">
                <a href="<?= $root_site.$modules; ?>/category/index/contact" class="btn btn-cancel">Hủy</a>
                <input type="submit" name="btnCreate" value="Thêm mới" class="btn btn-success" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
</form>
<!-- /Form -->
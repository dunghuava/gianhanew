<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Nhóm bất động sản<small>Cập nhật nhóm bất động sản mới</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/category/index/realestate">Nhóm BĐS</a></li>
        <li class="active">Cập nhật</li>
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
<!-- Form -->
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post" enctype="multipart/form-data" id="fCategories">
    <!-- Panel group -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-plus-square" aria-hidden="true"></i>Hiệu chỉnh nhóm</h6>
        </div>
        <div class="panel-body">
            <div class="tabbable block">
                <ul class="nav toolbar-tabs nav-tabs">
                    <li class="active">
                        <a href="#required" data-toggle="tab"><i class="fa fa-cogs fa-fw"></i>Thông tin cơ bản</a>
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
                        <div class="col-xs-4">
                            <div class="form-group previewImage">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="previewImage">
                                            <?php if (!empty($categories['image'])) { ?>
                                                <a href="<?= $root_site.'uploads/category/'.$categories['image']; ?>" class="lightbox">
                                                    <img src="<?= $root_site.'uploads/category/'.$categories['image'];?>" class="img-thumbnail img-responsive" />
                                                </a>
                                            <?php }else{ ?>
                                                <img src="<?= $root_site.'public/'.$modules;?>/images/no-image.jpg" class="img-resposnive center-block" />
                                            <?php } ?>
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
                        <div class="col-xs-8">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="title">Danh mục nhóm <span class="mandatory">(*)</span></label>
                                        <select class="select-search" id="parent_id" name="parent_id">
                                            <option value="0">|-- Đây là nhóm cha</option>
                                            <?php callMenu($category,0,'--&nbsp;',$categories['parent_id']); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nhóm Advertings :</label>
                                        <select class="select-search" name="group_id">
                                            <option value="-1">Chọn nhóm advertings</option>
                                            <?php if (!empty($groups)) { ?>
                                                <?php foreach ($groups as $group) { ?>
                                                <option value="<?= $group->id;?>" <?= $group->id == $categories['group_id'] ? 'selected' : '' ;?>><?= $group->title;?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="title">Tiêu đề <span class="mandatory">(*)</span>:</label>
                                        <input class="form-control" id="title" name="title" value="<?=$categories['title']; ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="title_alias">URL <span class="mandatory">(*)</span>:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button name="createAlias" class="btn btn-default" type="button">Đề xuất</button>
                                            </span>
                                            <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?=$categories['title_alias']; ?>">
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
                                                <input class="styled" <?=$categories['public'] == 1 ? 'checked' :'' ?> name="public" type="radio" value="1" id="public"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?=$categories['public'] == 0 ? 'checked' :'' ?> name="public" type="radio" value="0" id="public"> Không
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="type_id">Loại bất động sản:</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" <?= $categories['type_id'] == 1 ? 'checked' : ''; ?> name="type_id" type="radio" value="1">Bán
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= $categories['type_id'] == 2 ? 'checked' : ''; ?> name="type_id" type="radio" value="2"> Cho thuê
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
                                <label for="params[meta_description]">Nội dung tóm lược :</label>
                                <textarea class="form-control" rows="5" name="summary" cols="50"><?=$categories['summary']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="extended-info">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_title]">Meta title</label>
                                <input class="form-control" name="params[meta_title]" type="text" value="<?= json_decode($categories['params'])->meta_title; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta description</label>
                                <textarea class="form-control" rows="3" name="params[meta_description]" cols="50"><?= json_decode($categories['params'])->meta_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords</label>
                                <input class="form-control" type="text" name="params[meta_keywords]" value="<?= json_decode($categories['params'])->meta_keywords; ?>">
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
                <a href="<?= $root_site.$modules.'/category/index/realestate';?>" class="btn btn-info">Hủy</a>
                <input type="submit" name="btnCreate" value="Cập nhật" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
</form>
<!-- /Form -->
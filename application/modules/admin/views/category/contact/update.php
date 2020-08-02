<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> Nhóm liên hệ
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/category/index/contact">Nhóm liên hệ</a></li>
        <li class="active">Thêm mới</li>
    </ul>
    <ul class="breadcrumb-buttons collapse">
        <li class="dropdown">
            <a href="<?= $root_site.$modules.'/'.$controller; ?>/index/contact">
                <i class="icon-windows8"></i>
                <span>Danh sách</span>
            </a>
        </li>
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
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('Bạn có chắc muốn thêm mới ?')">
    <!-- Panel group -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-plus-square" aria-hidden="true"></i>Thêm mới nhóm</h6>
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
                        <!-- /.col-xs-3 -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="title">Danh mục nhóm <span class="mandatory">(*)</span></label>
                                        <select class="select-search" id="parent_id" name="parent_id">
                                            <option value="0">|-- Đây là nhóm cha</option>
                                            <?php callMenu($category,0,'--&nbsp;',$categories->parent_id); ?>
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
                                <textarea class="form-control" rows="5" name="summary" cols="50"><?=$categories->summary; ?></textarea>
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
        <div class="col-sm-12">
            <div class="form-actions pull-right">
                <a href="<?= $root_site.$modules; ?>/category/index/contact" class="btn btn-cancel"><i class="fa fa-hand-o-left fa-fw"></i>Quay lại</a>
                <button type="submit" name="btnCreate" class="btn btn-success"><i class="fa fa-floppy-o fa-fw"></i> Lưu</button>
            </div>
        </div>
    </div>
    <!-- /Form actions -->
    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
</form>
<!-- /Form -->
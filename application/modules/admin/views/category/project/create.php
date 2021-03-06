<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Nhóm dự án<small>Thêm một nhóm dự án mới</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/category/index/project">Nhóm dự án</a></li>
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
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="row">
        <div class="col-xs-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger active">
                            <a data-toggle="collapse" data-parent="#accordion" href="#required"><i class="icon-cogs"></i> Thông tin cơ bản</a>
                        </h6>
                    </div>
                    <div id="required" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
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
                                            <div class="col-xs-12">
                                                <input class="styled" id="image" name="image" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="parent_id">Nhóm cha:</label>
                                                <select class="select-search" id="parent_id" name="parent_id">
                                                    <option value="0">Không thuộc bất kỳ nhóm nào</option>
                                                    <?php callMenu($category); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="title">Tên nhóm <span class="mandatory">*</span>:</label>
                                                <input class="form-control" name="title" type="text" value="<?= $this->input->post('title'); ?>" />
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
                                                    <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?= $this->input->post('title_alias'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nhóm Advertings :</label>
                                                <select class="select-search" name="group_id">
                                                <option value="0">Chọn nhóm advertings</option>
                                                    <?php
                                                    if (!empty($groups)) {
                                                        foreach ($groups as $group) {
                                                            ?>
                                                            <option value="<?= $group->id;?>"><?= $group->title;?></option>
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
                                                <label for="public">Công bố:</label>
                                                <div class="group-inline-input">
                                                    <label class="radio-inline">
                                                        <input class="styled" checked name="public" type="radio" value="1"> Có
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input class="styled" name="public" type="radio" value="0"> Không
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
            </div>
            <!-- /Panel group -->
            <?php $params = $this->input->post('params'); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title panel-trigger"><a data-toggle="collapse" data-parent="#accordion" href="#additional"><i class="icon-file6"></i> Thông tin mở rộng</a></h6>
                </div>
                <div id="additional" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="params[intro]">Nội dung tóm lược:</label>
                                    <textarea class="form-control" name="params[intro]" cols="50" rows="5"><?= $params['intro']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title panel-trigger"><a data-toggle="collapse" data-parent="#accordion" href="#seo"><i class="icon-tags2"></i> Thông tin SEO</a></h6>
                </div>
                <div id="seo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                <label for="params[meta_description]">Meta title <span class="mandatory">*</span>:</label>
                                    <input class="form-control" name="params[meta_title]" type="text" value="<?= $params['meta_title']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="params[meta_description]">Meta description:</label>
                                    <textarea class="form-control" rows="5" name="params[meta_description]" cols="50" id="params[meta_description]"><?= $params['meta_description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="params[meta_keywords]">Meta keywords:</label>
                                    <textarea class="form-control" rows="5" name="params[meta_keywords]" cols="50" id="params[meta_keywords]"><?= $params['meta_keywords']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-actions">
                <a href="<?= $root_site.$modules.'/category/'; ?>index/article" class="btn btn-info">Hủy</a>
                <input type="submit" name="btnCreate" value="Thêm mới" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
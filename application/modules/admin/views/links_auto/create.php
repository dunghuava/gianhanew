<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3><span data-icon="&#xe312;"></span> BÀI VIẾT</h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules.'/'.$controller; ?>">Bài viết</a></li>
        <li class="active">Thêm mới</li>
    </ul>
    <ul class="breadcrumb-buttons collapse">
        <li class="dropdown">
            <a href="<?= $root_site.$modules.'/'.$controller; ?>">
                <i class="icon-windows8"></i>
                <span>Danh sách</span>
            </a>
        </li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
            <?= validation_errors("_toastr('","','growl-error')"); ?>
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","growl-success")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","growl-error")';
            }
            ?>
        });
    </script>
</div>
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" id="fArticles" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <!-- Panel group -->
    <div class="panel-group block-inner" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="fa fa-plus"></i> Thêm mới</h6>
            </div>
            <div class="panel-body">
                <div class="tabbable block">
                    <ul class="nav toolbar-tabs nav-tabs">
                        <li class="active">
                            <a href="#basic" data-toggle="tab"><i class="fa fa-info-circle fa-fw"></i> Thông tin cơ bản</a>
                        </li>
                        <li>
                            <a href="#multi" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> Cấu hình danh sách</a>
                        </li>
                        <li>
                            <a href="#single" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> Cấu hình chi tiết</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content pill-content">
                    <div class="tab-pane fade in active" id="basic">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title">Tiêu đề <span class="mandatory">*</span>:</label>
                                    <input class="form-control" id="title" name="title" type="text" value="<?= $this->input->post('title'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Nhóm bài viết <span class="mandatory">*</span>:</label>
                                    <select class="select-search" name="category_id">
                                        <?php callMenu($category,0,'|--',$this->input->post('category_id')); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title_alias">URL <span class="mandatory">*</span>:</label>
                                    <input class="form-control" name="title_alias" type="text" value="<?= $this->input->post('title_alias'); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $multi = $this->input->post('multi') ?>
                    <div class="tab-pane fade in" id="multi">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="params[meta_title">Title :</label>
                                    <input type="text" class="form-control" name="multi[title]" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="params[meta_description]">Description: </label>
                                    <textarea class="form-control" rows="3" name="multi[description]" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="params[meta_keywords]"> Link: </label>
                                    <input type="text" class="form-control" name="multi[link]" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="single">
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
                <a href="<?= $root_site . $modules. '/' .$controller; ?>" class="btn btn-cancel"><i class="fa fa-ban fa-fw"></i>Hủy</a>
                <button class="btn btn-success" name="btnCreate" type="submit"><i class="fa fa-save fa-fw"></i>Thêm</button> 
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
 <!-- /Custom content -->
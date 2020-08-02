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
<!-- Callout -->
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
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.articles.js"></script>
<!-- Custom content -->
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" id="fArticles" enctype="multipart/form-data">
    <!-- Panel group -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-info"></i> Thông tin cơ bản</a></h6>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
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
                                <label for="title">Tiêu đề <span class="mandatory">*</span>:</label>
                                <input class="form-control" id="title" name="title" type="text" value="<?= $this->input->post('title'); ?>">
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
                                    <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?= $this->input->post('title_alias'); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                            <label for="public">Công bố ?</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" name="public" type="radio" value="1" id="public"> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" checked name="public" type="radio" value="0" id="public"> Không
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="public">Cho phép bình luận ?</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" name="is_comment" type="radio" value="1" /> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" checked name="is_comment" type="radio" value="0" /> Không
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="public">Nổi bật ?</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" name="is_home" type="radio" value="1" /> Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" checked name="is_home" type="radio" value="0" /> Không
                                    </label>
                                </div>
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
                <a href="<?= $root_site.$modules; ?>/articles" class="btn btn-cancel">Hủy</a>
                <input class="btn btn-success" name="btnCreate" type="submit" value="Thêm mới">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
</form>
<!-- /Form -->
 <!-- /Custom content -->
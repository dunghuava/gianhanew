<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            TRANG<small>Tạo mới một trang mới trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/pages">Trang website</a></li>
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
            <?= validation_errors("_toastr('","','growl-danger');"); ?>
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","growl-success")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","growl-danger")';
            }
            ?>
        });
    </script>
</div>
<!-- Callout -->
<script type="text/javascript" src="<?= $root_site . 'public/'.$modules; ?>/js/admin.pages.js"></script>
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" name="fArticles" enctype="multipart/form-data" onsubmit="return confirm('Bạn chắc muốn thêm mới trang ?')">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-plus-square"></i> Thêm mới trang</h6>
        </div>
        <div class="panel-body">
            <div class="tabbable block">
                <ul class="nav toolbar-tabs nav-tabs">
                    <li class="active"><a href="#basic" data-toggle="tab"><i class="fa fa-info-circle"></i>Thông tin cơ bản</a></li>
                    <li><a href="#detail" data-toggle="tab"><i class="fa fa-file-word-o fa-fw"></i>Nội dung</a></li>
                    <li><a href="#seo" data-toggle="tab"><i class="fa fa-globe"></i> Thông tin SEO</a></li>
                </ul>
            </div>
            <!-- end tableable block -->
            <div class="tab-content pill-content">
                <div class="tab-pane fade in active" id="basic">
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
                        <div class="col-xs-9">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Tiêu đề<span class="mandatory">*</span>:</label>
                                        <input class="form-control" id="title" name="title" type="text" value="<?= $this->input->post('title');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
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
                                    <div class="col-md-12">
                                        <label for="title">Chọn giao diện<span class="mandatory">*</span>:</label>
                                        <select class="select-search" id="templates" name="templates">
                                            <option value="0">-- Chọn giao diện --</option>
                                            <?php
                                            $templates = get_template_page();
                                            if (!empty($templates) && is_array($templates)) {
                                                foreach ($templates as $key => $value) {
                                                    echo '<option value="'.$key.'" ';
                                                    if ($key == $this->input->post('templates')) {
                                                        echo "selected";
                                                    }
                                                    echo '>|-- '.$value.'</option>';
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
                                        <label for="public">Công bố :</label>
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
                <!--  -->
                <div class="tab-pane fade" id="detail">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="content">Nội dung <span class="mandatory">*</span>:</label>
                                <textarea class="form-control" id="content" name="content" cols="50" rows="10"><?= $this->input->post('content');?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.env.isCompatible = true;
                                    CKEDITOR.replace('content');
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="tab-pane fade" id="seo">
                    <?php $params = $this->input->post('params'); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_title]">Meta title:</label>
                                <input type="text" class="form-control" name="params[meta_title]" value="<?= $params['meta_title'];?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta description:</label>
                                <textarea class="form-control" rows="5" name="params[meta_description]" cols="50" ><?= $params['meta_description'];?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords:</label>
                                <input type="text" class="form-control" name="params[meta_keywords]" value="<?= $params['meta_keywords'];?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form actions -->
    <div class="row group-save">
        <div class="col-md-12">
            <div class="form-actions pull-right">
                <a href="<?= $root_site.$modules; ?>/pages" class="btn btn-sm btn-cancel">Hủy</a>
                <input class="btn btn-sm btn-success" name="btnCreate" type="submit" value="Lưu">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
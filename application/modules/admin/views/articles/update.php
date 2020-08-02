<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Bài viết<small>Cập nhật tin tức trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/articles">Bài viết</a></li>
        <li class="active">Cập nhật</li>
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
<!-- Callout -->
<script type="text/javascript" src="<?= $root_site; ?>public/admin/js/admin.articles.js"></script>
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" id="fArticles" enctype="multipart/form-data">
    <!-- Panel group -->
    <div class="panel-group block-inner" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="fa fa-info-circle"></i> Thông tin cơ bản</h6>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="previewImage">
                                        <?php if (!empty($article->image)) { ?>
                                            <img src="<?= $root_site.'uploads/articles/'.$article->image; ?>" class="img-thumbnail img-responsive">
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
                    <div class="col-xs-8">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Nhóm bài viết <span class="mandatory">*</span>:</label>
                                    <select class="select-search" name="category_id">
                                        <?php callMenu($category,0,'|--',$article->category_id); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title">Tiêu đề <span class="mandatory">*</span>:</label>
                                    <input class="form-control" id="title" name="title" type="text" value="<?= $article->title; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title_alias">Tên bí danh <span class="mandatory">*</span>:</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button name="reCreateAlias" class="btn btn-default" type="button">Tạo</button>
                                        </span>
                                        <input class="form-control" id="title_alias" readonly="readonly" name="title_alias" type="text" value="<?= $article->title_alias; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="public">Công bố ;</label>
                                    <div class="group-inline-input">
                                        <label class="radio-inline">
                                            <input class="styled" <?= $article->public == 1 ? 'checked' : ''; ?> name="public" type="radio" value="1" id="public"> Có
                                        </label>
                                        <label class="radio-inline">
                                            <input class="styled" <?= $article->public == 0 ? 'checked' : ''; ?> name="public" type="radio" value="0" id="public"> Không
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="public">Cho phép bình luận ?</label>
                                    <div class="group-inline-input">
                                        <label class="radio-inline">
                                            <input class="styled" <?= $article->is_comment == 1 ? 'checked' : ''; ?> name="is_comment" type="radio" value="1" /> Có
                                        </label>
                                        <label class="radio-inline">
                                            <input class="styled" <?= $article->is_comment == 0 ? 'checked' : ''; ?> name="is_comment" type="radio" value="0" /> Không
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="public">Nổi bật ?</label>
                                    <div class="group-inline-input">
                                        <label class="radio-inline">
                                            <input class="styled" <?= $article->is_home == 1 ? 'checked' : ''; ?> name="is_home" type="radio" value="1" /> Có
                                        </label>
                                        <label class="radio-inline">
                                            <input class="styled" <?= $article->is_home == 0 ? 'checked' : ''; ?> name="is_home" type="radio" value="0" /> Không
                                        </label>
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
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="summary">Nội dung tóm lược:</label>
                                <textarea class="form-control" rows="5" name="summary" cols="50" id="summary"><?= $article->summary; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="content">Nội dung bài viết <span class="mandatory">*</span>:</label>
                                <textarea class="form-control" id="content" name="content" cols="50" rows="10"><?= $article->content; ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.config.height = '450';
                                    CKEDITOR.env.isCompatible = true;
                                    CKEDITOR.replace('content');
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
                                <label for="tags">Đ&aacute;nh dấu thẻ:</label>
                                <input class="tags" name="tags" type="text" id="tags" value="<?= isset($tagged) ? $tagged : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_description]">Meta description:</label>
                                <textarea class="form-control" rows="7" name="params[meta_description]" cols="50"><?= json_decode($article->params)->meta_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[meta_keywords]">Meta keywords:</label>
                                <input type="text" class="form-control" name="params[meta_keywords]" value="<?= json_decode($article->params)->meta_keywords; ?>" />
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
                <input class="btn btn-success" name="btnUpdate" type="submit" value="Cập nhật">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
</form>
<!-- /Form -->
 <!-- /Custom content -->
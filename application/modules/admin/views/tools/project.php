<style type="text/css" media="screen">
    .well img{
        width: 100%;
    }
</style>
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Lấy thông tin dự án CafeLand
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/projects">Dự án</a></li>
        <li class="active">Lấy thông tin dự án</li>
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
<?php 
if (isset($error)) {
    ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
    <?php 
} 
?>
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.articles.js"></script>
<!-- Custom content -->
<!-- Form -->
<div class="row">
    <div class="col-xs-6">
        <form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" id="fTools" enctype="multipart/form-data" onsubmit="return confirm('Bạn chắc muốn lấy bài viết này ?')">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger active"><a data-toggle="collapse" data-parent="#accordion" href="#basic-info"><i class="icon-cogs"></i> Nhập link</a></h6>
                    </div>
                    <div id="basic-info" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Link dự án từ cafeland<span class="mandatory">*</span>:</label>
                                        <input class="form-control" id="link" name="link" type="text" value="<?= $this->input->post('title'); ?>">
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
                                    <div class="col-md-6">
                                    <label for="public">Công bố ?:</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" checked name="public" type="radio" value="1" id="public"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" name="public" type="radio" value="0" id="public"> Không
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="featured">Nổi bật:</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" name="featured" type="radio" value="1" id="featured"> Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" checked name="featured" type="radio" value="0" id="featured"> No
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
                    <div class="form-actions">
                        <a href="<?= $root_site.$modules; ?>/articles" class="btn btn-info">Hủy</a>
                        <input class="btn btn-danger" name="btnSubmit" type="submit" value="GET" />
                    </div>
                </div>
            </div>
            <!-- /Form actions -->
        </form>
        <!-- /Form -->
        <!-- /Custom content -->
    </div>
    <div class="col-xs-6">
        <div class="panel-group block-inner" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title panel-trigger active"><a data-toggle="collapse" data-parent="#accordion" href="#data"><i class="icon-cogs"></i> Dữ liệu lấy về</a></h6>
                </div>
                <div id="data" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="block">
                            <h5><?= isset($data['title']) ?  $data['title'] : '' ;; ?></h5>
                            <hr>
                            <h6>Mô tả ngắn:</h6>
                            <div class="row block-inner">
                                <div class="col-sm-12">
                                    <div class="well">
                                        <p><?= isset($data['summary']) ?  $data['summary'] : '' ;?></p>
                                    </div>
                                </div>
                            </div>
                            <h6>Nội dung:</h6>
                            <div class="row block-inner">
                                <div class="col-sm-12">
                                    <div class="well" style="max-height: 400px; overflow: auto;">
                                        <?= isset($data['description']) ?  $data['description'] : '' ;?>
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
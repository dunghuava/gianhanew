<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Chỉnh sửa đối tác <small></small>
    </h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/branchs">Đối tác</a></li>
        <li class="active">Chỉnh sửa</li>
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
<?= validation_errors('<div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger">','</li></ul></div></div>'); ?>
<?php 
if (isset($error)) {
    ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
    <?php 
} 
?>
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#required"><i class="icon-cogs"></i> Thông tin cơ bản</a></h6>
                    </div>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <div id="required" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Thứ tự <span class="mandatory">*</span>:</label>
                                        <input type="text" name="ordering" class="form-control" value="<?= $partner->ordering;?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Đối tác<span class="mandatory">*</span>:</label>
                                        <input type="text" name="title" class="form-control" value="<?= $partner->title; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[website]">Website <span class="mandatory"></span>:</label>
                                        <input type="text" name="params[website]" class="form-control" value="<?= json_decode($partner->params)->website;?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="image">Hình ảnh logo<span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="image" id="files" onclick="openKCFinder(this)" type="text" value="<?=$partner->image; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="thumnails">
                                            <a href="<?= $partner->image; ?>" class="lightbox">
                                                <img src="<?= $partner->image; ?>" class='img-thumbnail img-responsize'/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function openKCFinder(input) {
                                    window.KCFinder = {
                                        callBackMultiple: function(files) {
                                            window.KCFinder = null;
                                            input.value = "";
                                            for (var i = 0; i < files.length; i++)
                                                input.value += files[i] + "\n";
                                        }
                                    };
                                    window.open('<?= $root_site; ?>public/admin/js/plugins/kcfinder/browse.php?type=files&dir=files/public','kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
                                        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
                                        );
                                }
                            </script>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="public">Công bố ?</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" <?= $partner->public == 1 ? 'checked' : ''; ?> name="public" type="radio" value="1" > Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= $partner->public == 0 ? 'checked' : ''; ?>  name="public" type="radio" value="0"> Không
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
        </div>
    </div>
    <!-- Form actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-actions">
                <a href="<?= $root_site; ?>admin/partners" class="btn btn-info">Hủy</a>
                <input type="submit" name="btnCreate" value="Cập nhật" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
    <!-- /Form -->
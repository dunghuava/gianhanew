<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Cập nhật <small>Cập nhật adverting trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/advertings">Advertings</a></li>
        <li class="active">Cập nhật</li>
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
if (isset($error)){
    ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
    <?php 
} 
?>
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="row">
        <div class="col-md-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger active"><a data-toggle="collapse" data-parent="#accordion" href="#required"><i class="icon-cogs"></i> Thông tin cơ bản</a></h6>
                    </div>
                    <div id="required" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="default" style="<?= $adverting->adv_type == 'upload' ? 'display:block;' : ''?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="title">Ảnh hiện tại</label>
                                                    <div class="previewImage">
                                                        <?php if (!empty($adverting->adv_image)) { ?>
                                                        <a href="<?= $root_site.'uploads/advertings/'.$adverting->adv_image ?>" class="lightbox">
                                                            <img src="<?= $root_site.'uploads/advertings/'.$adverting->adv_image ?>" class="img-resposnive center-block" style="width:100%";/>
                                                        </a>
                                                        <?php }else{ ?>
                                                            <img src="<?= $root_site.'public/'.$modules;?>/images/no-image.jpg" class="img-resposnive center-block" />
                                                        <? } ?>
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
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="title">Liên kết đến<span class="mandatory">(Có hoặc không)</span>:</label>
                                                    <input type="text" name="adv_link" class="form-control" value="<?= $adverting->adv_link; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="code" style="<?= $adverting->adv_type == 'code' ? 'display:block;' : ''?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Code HTML <span class="mandatory">*</span>:</label>
                                                <textarea name="adv_code" class="form-control" cols="30" rows="10"><?= $adverting->adv_code; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="title">Tiêu đề : <span class="mandatory">*</span></label>
                                                <input type="text" class="form-control" name="title" value="<?= $adverting->adv_title;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nhóm Advertings <span class="mandatory">*</span>:</label>
                                                <select class="select-search" name="group_id">
                                                    <?php if (!empty($groups)) {?>
                                                    <?php foreach ($groups as $group) { ?>
                                                    <option value="<?= $group->id;?>" <?= $adverting->group_id == $group->id ? 'selected' : ''; ?>><?= $group->title;?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Kiểu Advertings <span class="mandatory">*</span>:</label>
                                                <select class="select-search" name="adv_type" id="adv_type">
                                                    <option value="upload" <?= $adverting->adv_type == 'upload' ? 'selected' : ''; ?>>Mặc định (Upload Adverting)</option>
                                                    <option value="code" <?= $adverting->adv_type == 'code' ? 'selected' : ''; ?>>Code (Chèn Code HTML)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Vị trí trên site <span class="mandatory">*</span>:</label>
                                                <select class="select-search" name="adv_position">
                                                    <option value="-1">Vị trí hiển thị</option>
                                                    <option value="top" <?= $adverting->adv_position == 'top' ? 'selected' : '' ?>>Top</option>
                                                    <option value="bar" <?= $adverting->adv_position == 'bar' ? 'selected' : '' ?>>Cột phải</option>
                                                    <option value="content" <?= $adverting->adv_position == 'content' ? 'selected' : '' ?>>Nội dung bài viết</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="public">Công bố ?</label>
                                                <div class="group-inline-input">
                                                    <label class="radio-inline">
                                                        <input class="styled" <?= $adverting->public == 1 ? 'checked' : '' ?> name="public" type="radio" value="1"> Có
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input class="styled" <?= $adverting->public == 0 ? 'checked' : '' ?> name="public" type="radio" value="0"> Không
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
        </div>
    </div>
    <!-- Form actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-actions pull-right">
                <a href="<?= $root_site.$modules; ?>/advertings" class="btn btn-info">Hủy</a>
                <input type="submit" name="btnCreate" value="Cập nhật" class="btn btn-danger"  onclick="return confirm('Bạn chắc muốn cập nhật ?')" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
<script type="text/javascript">
    $(document).ready(function(){
        var adv_type = $("#adv_type").val();
        if (adv_type == 'upload'){
            $("div.default").show();
            $("div.code").hide();
        }else if(adv_type == 'code'){
            $("div.default").hide();
            $("div.code").show();
        }else{
            $("div.default").show();
            $("div.code").hide();
        }
        $("#adv_type").change(function() {
            var adv_type = $(this).val();
            if (adv_type == 'upload'){
                $("div.default").show();
                $("div.code").hide();
            }else if(adv_type == 'code'){
                $("div.default").hide();
                $("div.code").show();
            }else{
                $("div.default").show();
                $("div.code").hide();
            }
        });
    });
</script>
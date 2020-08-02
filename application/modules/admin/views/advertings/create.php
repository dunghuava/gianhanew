<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Adverting
            <small>Thêm mới adverting trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/advertings">Advertings</a></li>
        <li class="active">Thêm mới</li>
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
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
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
                                    <div class="default">
                                        <div class="form-group">
                                            <label for="image">Hình ảnh<span class="mandatory">*</span>:</label>
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
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="title">Liên kết đến<span class="mandatory">(Có hoặc không)</span>:</label>
                                                <input type="text" name="adv_link" class="form-control" value="<?= $this->input->post('adv_link') ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="code" style="display:none;">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Code HTML <span class="mandatory">*</span>:</label>
                                                    <textarea name="adv_code" class="form-control" cols="30" rows="10"><?= $this->input->post('adv_code'); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="title">Tiêu đề : <span class="mandatory">*</span></label>
                                                <input type="text" class="form-control" name="title" value="<?= $this->input->post('title');?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nhóm Advertings <span class="mandatory">*</span>:</label>
                                                <select class="select-search" name="group_id">
                                                    <?php
                                                    if (!empty($groups)) {
                                                        foreach ($groups as $group) {
                                                        ?>
                                                        <option value="<?= $group->id;?>" <?= $this->input->post('group_id') == $group->id ? 'selected' : ''; ?>><?= $group->title;?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Kiểu Advertings <span class="mandatory">*</span>:</label>
                                                <select class="select-search" name="adv_type" id="adv_type">
                                                    <option value="upload" <?= $this->input->post('adv_type') == 'upload' ? 'selected' : ''; ?>>Mặc định (Upload Adverting)</option>
                                                    <option value="code" <?= $this->input->post('adv_type') == 'code' ? 'selected' : ''; ?>>Code (Chèn Code HTML)</option>
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
                                                    <option value="top" <?= $this->input->post('adv_position') == 'top' ? 'selected' : '' ?>>Top</option>
                                                    <option value="bar" <?= $this->input->post('adv_position') == 'bar' ? 'selected' : '' ?>>Cột phải</option>
                                                    <option value="content" <?= $this->input->post('adv_position') == 'content' ? 'selected' : '' ?>>Nội dung bài viết</option>
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
                                                        <input class="styled" checked="checked" name="public" type="radio" value="1" id="public"> Có
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
                <input type="submit" name="btnCreate" value="Thêm mới" class="btn btn-danger"  onclick="return confirm('Bạn chắc muốn thêm mới ?')" />
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
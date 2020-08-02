<!-- Page header -->
<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3><span data-icon="&#xe312;"></span> Thêm mới tài khoản</h3>
</div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= base_url().$modules;?>">Admin Panel</a></li>
        <li><a href="<?= base_url().$modules;?>/users"></a>Người dùng</li>
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
        <h5>Finished</h5>
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
<!-- /Callout -->

<!-- Custom content -->
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" name="fUser">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-cogs"></i> Thông tin cơ bản</h6>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="display_name">Tên hiển thị:</label>
                                <input class="form-control" name="display_name" type="text" value="<?= $this->input->post('display_name'); ?>">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Số điện thoại <span class="mandatory">*</span>:</label>
                                <input class="form-control" name="mobile" type="text" value="<?= $this->input->post('mobile'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Địa chỉ :</label>
                                <input class="form-control" name="address" type="text" value="<?= $this->input->post('address'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Email <span class="mandatory">*</span>:</label>
                                <input class="form-control" name="email" type="text" value="<?= $this->input->post('email'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="display_name">Tài khoản<span class="mandatory">*</span>:</label>
                                <input class="form-control" name="username" type="text" value="<?= $this->input->post('username'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password">Mật khẩu <span class="mandatory">*</span>:</label>
                                <input class="form-control" name="password" type="password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password_confirmation">Xác nhận mật khẩu:<span class="mandatory">*</span>:</label>
                                <input class="form-control" name="password_confirmation" type="password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="permissions">Nhóm quyền<span class="mandatory">*</span>:</label>
                                <div class="well">
                                    <div class="roles-group block-inner">
                                        <span class="subtitle text-danger">Nhóm thành viên</span>
                                        <div class="checkbox checkbox-success">
                                            <label>
                                                <input class="styled" name="permissions" type="radio" value="2">Quản trị website
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <label>
                                                <input class="styled" name="permissions" type="radio" value="3">Cộng tác viên
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <label>
                                                <input class="styled" name="permissions" checked="checked" type="radio" value="4">Thành viên
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password_confirmation">Kích hoạt</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" checked="checked" name="activated" type="radio" value="1">Có
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" name="activated" type="radio" value="0">Không
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password_confirmation">Khóa tài khoản:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" checked="checked" name="blocked" type="radio" value="0"> Không
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" name="blocked" type="radio" value="1" > Có
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form actions -->
                    <div class="form-actions text-right">
                        <a href="<?= $root_site.$modules; ?>/users" class="btn btn-info">Hủy</a>
                        <input class="btn btn-danger" name="btnCreate" type="submit" value="Thêm mới" />
                    </div>
                    <!-- /Form actions -->
                </div>
            </div>
        </div>
    </div>
</form>

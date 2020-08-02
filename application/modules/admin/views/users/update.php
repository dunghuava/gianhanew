<!-- Page header -->
<div class="page-header">
  <div class="page-title text-info text-semibold">
    <h3>
        <span data-icon="&#xe312;"></span> 
        Update user
    </h3>
</div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules ?>/users">Người dùng</a></li>
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
        <h5>Hoàn thành</h5>
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
<form method="POST" action="" accept-charset="UTF-8" name="fUser">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-cogs"></i> Thông tin cơ bản </h6>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="display_name">Tên hiển thị:</label>
                                <input class="form-control" name="display_name" type="text" value="<?= $user['display_name']; ?>">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Số điện thoại <span class="mandatory">*</span>:</label>
                                <input class="form-control" name="mobile" type="text" value="<?= $user['mobile']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Địa chỉ :</label>
                                <input class="form-control" name="address" type="text" value="<?= $user['address']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Email <span class="mandatory">*</span>:</label>
                                <input class="form-control" name="email" type="text" value="<?= $user['email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="display_name">Tài khoản <span class="mandatory">*</span>:</label>
                                <input class="form-control" name="username" type="text" value="<?= $user['username']; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password">Mẩu khẩu <span class="mandatory">*</span>:</label>
                                <input class="form-control" name="password" type="password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password_confirmation">Nhập lại mật khẩu:<span class="mandatory">*</span>:</label>
                                <input class="form-control" name="password_confirmation" type="password" value="">
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($user['level'] != 1) {
                    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="permissions">User Group <span class="mandatory">*</span>:</label>
                                <div class="well">
                                    <div class="roles-group block-inner">
                                        <span class="subtitle text-danger">Nhóm quản trị</span>
                                        <div class="checkbox checkbox-success">
                                            <label>
                                                <input class="styled" name="permissions" <?= ($user['level'] ==2) ? 'checked="checked"' : ''; ?> type="radio" value="2" />Quản Trị Website
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <label>
                                                <input class="styled" name="permissions" <?= ($user['level'] ==3) ? 'checked="checked"' : ''; ?> type="radio" value="3" />Cộng tác viên
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-success">
                                            <label>
                                                <input class="styled" name="permissions" <?= ($user['level'] ==4) ? 'checked="checked"' : ''; ?> type="radio" value="4" />Thành viên
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password_confirmation">Kích họat tài khoản:</label>
                                <div class="group-inline-input">
                                    <label class="radio-inline">
                                        <input class="styled" <?= ($user['activated'] == 1) ? 'checked' : ''; ?> name="activated" type="radio" value="1" > Kích hoạt
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" <?= ($user['activated'] == 0) ? 'checked' : ''; ?> name="activated" type="radio" value="0" > Chưa
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
                                        <input class="styled" <?= ($user['block'] == 0) ? 'checked="checked"' : ''; ?> name="blocked" type="radio" value="0" id="blocked"> Không
                                    </label>
                                    <label class="radio-inline">
                                        <input class="styled" <?= ($user['block'] == 1) ? 'checked="checked"' : ''; ?> name="blocked" type="radio" value="1" id="blocked"> Có
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form actions -->
                    <div class="form-actions text-right">
                        <a href="<?= $root_site.$modules; ?>/users" class="btn btn-info">Hủy</a>
                        <input class="btn btn-danger" name="btnCreate" type="submit" value="Cập nhật">
                    </div>
                    <!-- /Form actions -->
                </div>
            </div>
        </div>
    </div>
</form>

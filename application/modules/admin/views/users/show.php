<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3><span data-icon="&#xe312;"></span>Tài khoản</h3>
    </div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= base_url().$modules;?>">Admin Panel</a></li>
        <li><a href="<?= base_url().$modules;?>/users">Người dùng</a></li>
        <li class="active">Tài khoản</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->

<!-- Callout -->
<div id="message">
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="callout callout-success fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Finished</h5>
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
        <?php } ?>
</div>
<?php if (isset($error)) { ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
    <?php } ?>
<!-- /Callout -->

<!-- Custom content -->
<!-- Status history -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-coin"></i>Thông tin tài khoản</h6>
    </div>
    <div class="panel-body">
        <div class="row invoice-header">
            <div class="col-sm-6">
                <ul class="invoice-details pull-left" >
                    <li>Ngày đăng ký: <strong class="text-danger"><?= date('d-m-Y H:i:s',strtotime($user['created_at'])); ?></strong></li>
                    <li>Nhóm thành viên: <strong><?= $user['roles_name'] ?></strong></li>
                    <li>Tổng số điểm: <strong><?= '100' ?> điểm</strong></li>
                </ul>
            </div>
            <div class="col-sm-6 text-right">
                <h3><?= $user['username']; ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h6>Thông tin chi tiết:</h6>
                <ul>
                    <li>Tên hiển thị: <strong><?= $user['display_name']; ?></strong></li>
                    <li>Điện thoại: <strong><?= $user['mobile']; ?></strong></li>
                    <li>Địa chỉ: <strong><?= ($user['address'] != null) ? $user['address'] : 'Chưa cập nhật'; ?></strong></li>
                    <li>Email: <strong><?= $user['email']; ?></strong></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <h6>Thông tin:</h6>
                <ul>
                    <li>Tổng số tin đăng: <strong class="pull-right"><?= countRowTable('realestates',['created_by'=>$user['id']]) ?></strong></li>
                    <li>Số điểm đã dùng: <strong class="pull-right text-danger"><?= 100-$user['points']; ?></strong></li>
                    <li>Số điểm còn lại: <strong class="pull-right text-info"><?= $user['points'] ?></strong></li>
                    <li class="invoice-status">
                        <strong>Trạng thái tài khoản:</strong>
                        <?= ($user['block'] == 0) ? '<div class="label label-info pull-right">Không khóa</div>' : '<div class="label label-danger pull-right">Khóa</div>'; ?>
                        
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-history"></i> Danh sách tin rao vặt</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width:100px;">ID</th>
                    <th>Tin rao vặt</th>
                    <th class="text-center" style="width:150px;">Loại tin</th>
                    <th style="width:150px;">Đăng lúc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($realestates)) {
                    foreach ($realestates as $realestate) {
                ?>
                <tr>
                    <td class="text-center"><?= $realestate->id; ?></td>
                    <td><a target="_blank" href="<?= $root_site.$realestate->category_slug.'/'.$realestate->title_alias.'-'.$realestate->id; ?>"><?= $realestate->title;?></a></td>
                    <td class="text-center" style="width:150px;"><?= $realestate->type_name; ?></td>
                    <td><?= date('d-m-Y H:i:s',strtotime($realestate->created_at)); ?></td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-left">
            <a href="<?= $root_site.$modules.'/users' ?>" class="btn btn-danger"><i class="icon-checkbox-partial"></i> Quay lại</a>
        </div>
    </div>
</div>
<!-- /Status history -->
<!-- /Invoice -->
<!-- /Custom content -->
<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> Tài người dùng 
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active"> Người dùng</li>
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
            <h5>Hoàn thành tác vụ</h5>
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<div id="message">
    <?php 
    if ($this->session->flashdata('error')) {
        ?>
        <div class="callout callout-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Đã có lỗi xảy ra</h5>
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<script type="text/javascript" src="<?= $root_site; ?>public/admin/js/admin.users.js"></script>
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i>Danh sách tài khoản người dùng</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="users">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tên hiển thị</th>
                    <th style="width: 130px;">Tài khoản</th>
                    <th style="width: 120px;">Nhóm quyền</th>
                    <th style="width: 110px;text-align:center;">Chi tiết</th>
                    <th style="width: 115px;">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($users as $user){
                ?>
                <tr index="<?= $user['id']; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $user['id']; ?></td>
                    <td>
                        <?= $user['display_name'] ?>
                    </td>
                    <td>
                        <span class="label label-success"><?= $user['username'] ?></span>
                    </td>
                    <td>
                        <?php
                        if ($user['level'] == 1) {
                            echo '<span class="label label-danger">'.$user['roles_name'].'</span>';
                        }else if ($user['level'] == 2) {
                            echo '<span class="label label-success">'.$user['roles_name'].'</span>';
                        }else{
                            echo '<span class="label label-info">'.$user['roles_name'].'</span>';
                        }
                        ?>
                    </td>
                    <td style="text-align:center;">
                        <a href="<?= $root_site.$modules ?>/users/show/<?= $user['id']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Chi tiết"><i class="icon-file"></i></a>
                    </td>
                    <td>
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/users/destroy/<?= $user['id']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Delete"><i class="icon-remove"></i></a> 
                            <a href="<?= $root_site.$modules; ?>/users/update/<?= $user['id']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Edit"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                }?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
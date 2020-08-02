<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách bài viết <small>Danh sách tất cả các bài viết hiện có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Bài viết</li>
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
<script type="text/javascript" src="<?= $root_site; ?>public/admin/js/admin.usertrackers.js"></script>
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách bài viết đang có</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="usertrackers" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="articles">
            <thead>
                <tr>
                    <th style="width: 45px;"><input type="checkbox" id="checkall" /></th>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th style="width: 115px;" class="text-center">Ngày đăng nhập</th>
                    <th style="width: 115px;" class="text-center">Tài khoản</th>
                    <th>Trình duyệt</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($usertrackers as $usertracker){
                ?>
                <tr index="<?= $usertracker->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><input type="checkbox" class="checkthis" value="<?= $usertracker->id; ?>" /></td>
                    <td><?= $usertracker->id; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($usertracker->created_at)); ?></td>
                    <td class="text-center"><?= $usertracker->username; ?></td>
                    <td><?= $usertracker->browser; ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/usertrackers/destroy/<?= $usertracker->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa bài viết có ID <?= $usertracker->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
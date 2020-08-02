<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách
            <small>Danh sách tất cả các nhóm Adverting</small>
        </h3>
    </div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules;?>">Admin Panel</a></li>
    <li><a href="<?= $root_site.$modules;?>/group_advertings"></a>Nhóm Adverting</li>
    <li class="active">Danh sách</li>
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

<div id="errors">
    <?php 
    if ($this->session->flashdata('error')) {
    ?>
    <div class="callout callout-danger fade in">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5>Đã có lỗi</h5>
        <p><?= $this->session->flashdata('error'); ?></p>
    </div>
    <?php   
    }
    ?>
</div>
<!-- /Callout -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/group_advertings.js"></script>
<!-- Custom content -->
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i>Danh sách nhóm slider đang có</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="group_advertings">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tên nhóm</th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($groups as $group){
                ?>
                <tr index="<?= $group->id; ?>">
                    <td class="text-center"><?= $group->id; ?></td>
                    <td><i class="icon-arrow-right11 block-disabled"></i><?= $group->title; ?></td>
                    <td class="text-center"><?= $group->username; ?></td>
                    <td class="text-center"><?= date($group->updated_at); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/group_advertings/destroy/<?= $group->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa nhóm này ?');"><i class="icon-remove"></i></a> 
                            <a href="<?= $root_site.$modules; ?>/group_advertings/update/<?= $group->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
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
<!-- /Custom content -->
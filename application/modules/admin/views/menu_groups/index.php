<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3><span data-icon="&#xe312;"></span> Nhóm trình đơn</h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Nhóm trình đơn</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","jGrowl-alert-success")';
            }
            if ($this->session->flashdata('error')){
                echo '_toastr("'.$this->session->flashdata('error').'","jGrowl-alert-danger")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","jGrowl-alert-danger")';
            }
            ?>
        });
    </script>
</div>
<!-- Callout -->
<!-- Custom content -->
<!-- Form -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.menu_groups.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Danh sách nhóm trình đơn đang có</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="menu_groups">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tên nhóm</th>
                    <th>Mô tả</th>
                    <th class="text-center">Cập nhật bởi</th>
                    <th class="text-center">Cập nhật lúc</th>
                    <th style="width: 90px;">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($menu_groups)) {
                    foreach ($menu_groups as $menu_group) {
                ?>
                <tr index="<?= $menu_group->id ?>">
                    <td class="text-center"><?= $menu_group->id ?></td>
                    <td><?= $menu_group->title; ?></td>
                    <td><?= $menu_group->description; ?></td>
                    <td class="text-center"><?= $menu_group->display_name; ?></td>
                    <td class="text-center"><?= date('m-d-Y',strtotime($menu_group->updated_at)); ?><hr><?= date('H:i:s',strtotime($menu_group->updated_at)); ?></td>
                    <td>
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules.'/menu_groups/destroy/'.$menu_group->id; ?>" class="btn btn-link btn-icon btn-xs tip" onclick="return confirm('Bạn có chắc muốn xóa nhóm trình đơn có ID = <?= $menu_group->id; ?>')" title="Xóa"><i class="icon-remove"></i></a> 
                            <a title="Sửa" href="<?= $root_site.$modules.'/menu_groups/update/'.$menu_group->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
<!-- /Custom content -->
<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Trình đơn<small>Danh sách trình đơn đang có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Trình đơn</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
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
<!-- Custom content -->
<script type="text/javascript" src="<?= $root_site.'public/admin'; ?>/js/admin.menus_items.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Danh sách trình đơn</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover dataTable" id="menus">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Trình đơn</th>
                    <th>Nhóm trình đơn</th>
                    <th style="width: 85px;text-align:center;">Thứ tự</th>
                    <th style="width: 55px;text-align:center;"><i class="fa fa-check fa-fw text-success"></i></th>
                    <th style="width: 115px;text-align:center;">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($menus as $menu){ ?>
                <tr index="<?= $menu['id']; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $menu['id']; ?></td>
                    <td data-order="<?= $menu['path_alias']; ?>">
                        <?=
                        '<i class="icon-arrow-right3 block-disabled"></i>'.str_replace('/','<i class="icon-arrow-right3 block-disabled"></i>' , $menu['path']);
                        ?>
                    </td>
                    <td style="text-align:center;"><?= $menu['group_title']; ?></td>
                    <td style="text-align:center;"><?= $menu['ordering']; ?></td>
                    <td style="text-align:center;"><?= ($menu['public'] == 1) ? '<i class="fa fa-check fa-fw text-success"></i>' : '<i class="fa fa-ban fa-fw text-danger"></i>'; ?></td>
                    <td>
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/menus_items/destroy/<?= $menu['id']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa"><i class="icon-remove"></i></a> 
                            <a href="<?= $root_site.$modules; ?>/menus_items/update/<?= $menu['id']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
    <!-- /Table -->
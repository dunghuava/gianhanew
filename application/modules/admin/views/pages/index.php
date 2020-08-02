<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách trang <small>Danh sách tất cả các trang có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Trang Web</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","growl-success")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","growl-danger")';
            }
            ?>
        });
    </script>
</div>
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.pages.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách trang web</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="pages">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tiêu đề</th>
                    <th style="width: 120px;" class="text-center">Công bố</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pages as $page){ ?>
                <tr index="<?= $page['id']; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $page['id']; ?></td>
                    <td><i class="icon-arrow-right11 block-disabled"></i><?= $page['title'] ?></td>
                    <td class="text-center">
                        <?= ($page['public'] == 1) ? '<span class="label label-info">Có</span>' : '<span class="label label-danger">Không</span>'; ?>
                    </td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="#" class="btn btn-link btn-icon btn-xs tip data-delete" title="Xóa"><i class="icon-remove"></i></a> 
                            <a href="<?= $root_site.$modules; ?>/pages/update/<?= $page['id']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
    <!-- /Table -->
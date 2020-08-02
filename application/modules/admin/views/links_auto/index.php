<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3><span data-icon="&#xe312;"></span> Links Auto</h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Links Auto</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.links_auto.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Danh sách đang có</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="links_auto" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="links_auto">
            <thead>
                <tr>
                    <th style="width: 45px;"><input type="checkbox" id="checkall" /></th>
                    <th class="image-column text-center">Image</th>
                    <th>Tiêu đề</th>
                    <th style="width: 115px;" class="text-center">Nhóm</th>
                    <th style="width: 115px;" class="text-center">Công bố</th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
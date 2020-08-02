<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Liên kết nổi bật <small>Danh sách tất cả các Liên kết nổi bật hiện có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Liên kết nổi bật</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="callout callout-success fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Hoàn tất nghiệp vụ</h5>
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
    <?php } ?>
</div>
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/external_links.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách liên kết đang có</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="external_links" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="external_links">
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th>Tiêu đề</th>
                    <th class="text-center">Link</th>
                    <th style="width: 10%;" class="text-center">Công bố</th>
                    <th style="width: 10%;" class="text-center">Thứ tự</th>
                    <th style="width: 10%;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 10%;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($external_links as $external_link){ ?>
                <tr index="<?= $external_link->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $external_link->id; ?></td>
                    <td><?= $external_link->title; ?></td>
                    <td><?= $external_link->title_alias; ?></td>
                    <td style="text-align:center;">
                        <?= ($external_link->public == 1) ? '<span class="label label-info">Xong</span>' : '<span class="label label-danger">Chưa</span>';?>
                    </td>
                    <td class="text-center"><?= $external_link->ordering; ?></td>
                    <td class="text-center"><?= $external_link->display_name; ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/external_links/destroy/<?= $external_link->id; ?>" class="btn btn-link btn-icon btn-xs tip data-delete" onclick="return confirm('Bạn có chắc muốn xóa liên kết có ID = '+<?= $external_link->id; ?>)" title="Xóa">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/external_links/update/<?= $external_link->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
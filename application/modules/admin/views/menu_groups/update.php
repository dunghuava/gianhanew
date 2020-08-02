<div class="page-header">
    <div class="page-title text-info text-semibold">
    <h3><span data-icon="&#xe312;"></span> Cập nhật</h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules.'/'.$controller; ?>">Nhóm menu</a></li>
        <li class="active">Cập nhật</li>
    </ul>
    <ul class="breadcrumb-buttons collapse">
        <li class="dropdown">
            <a href="<?= $root_site.$modules.'/'.$controller; ?>">
                <i class="icon-windows8"></i>
                <span>Danh sách</span>
            </a>
        </li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
            <?= validation_errors("_toastr('","','growl-danger')"); ?>
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
<!-- Custom content -->
<!-- Form -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.menu_groups.js"></script>
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" name="fMenuGroups">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <!-- Panel group -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-pencil-square"></i> Hiệu chỉnh nhóm menu</h6>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="title">Tên nhóm <span class="mandatory">*</span>:</label>
                        <input class="form-control" id="title" name="title" type="text" value="<?= $menu_group->title; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="title_alias">URL<span class="mandatory">*</span>:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button name="reCreateAlias" class="btn btn-default" type="button">Đề xuất</button>
                            </span>
                            <input class="form-control" id="title_alias" readonly name="title_alias" type="text" value="<?= $menu_group->title_alias; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="description">M&ocirc; tả:</label>
                        <textarea class="form-control" rows="5" name="description" cols="50" id="description"><?= $menu_group->description; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Panel group -->
    <!-- Form actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-actions pull-right">
                <a href="<?= $root_site.$modules.'/menu_groups' ?>" class="btn btn-cancel">Hủy</a>
                <input name="btnUpdate" type="submit" value="Cập nhật" class="btn btn-success" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
<!-- /Custom content -->
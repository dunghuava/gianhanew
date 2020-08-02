<div class="page-header">
    <div class="page-title text-info text-semibold">
    <h3><span data-icon="&#xe312;"></span> 
        KHỐI NỘI DUNG<small>Tạo mới khối nội dung trên site</small>
    </h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules.'/'.$controller; ?>">Khối nội dung</a></li>
        <li class="active">Thêm mới</li>
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
<!-- Callout -->
<script type="text/javascript" src="<?= $root_site . 'public/'.$modules; ?>/js/admin.content_blocks.js"></script>
<!-- Custom content -->
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string(); ?>" accept-charset="UTF-8" class="form-horizontal" id="fContentBlocks" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-plus-square"></i> Thêm mới khối nội dung</h6>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label text-right">Tên khối nội dung <span class="mandatory">*</span>:</label>
                <div class="col-sm-10">
                    <input class="form-control" id="title" name="title" type="text" value="<?= $this->input->post('title'); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="title_alias" class="col-sm-2 control-label text-right">Tên bí danh <span class="mandatory">*</span>:</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button name="createAlias" class="btn btn-default" type="button">Tạo</button>
                        </span>
                        <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?= $this->input->post('title_alias'); ?>" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="public" class="col-sm-2 control-label text-right">Công bố:</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input class="styled" checked="checked" name="public" type="radio" value="1" id="public"> Có
                    </label>
                    <label class="radio-inline">
                        <input class="styled" name="public" type="radio" value="0" id="public"> Không
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="params[show_title]" class="col-sm-2 control-label text-right">Hiển thị tên khối nội dung:</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input class="styled" checked="checked" name="params[show_title]" type="radio" value="1" id="params[show_title]"> Có
                    </label>
                    <label class="radio-inline">
                        <input class="styled" name="params[show_title]" type="radio" value="0" id="params[show_title]"> Không
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="action" class="col-sm-2 control-label text-right">Loại nội dung <span class="mandatory">*</span>:</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <select class="select-search" name="type_id">
                            <?php foreach ($this->mcontent_block_types->getList() as $type) { ?>
                            <option <?= $this->input->post('type_id') == 1 ? 'selected' : ''; ?> value="<?= $type->id ?>"><?= $type->title; ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-btn">
                            <button name="getDetailForm" data-url="<?= $root_site.$modules;?>/viewcomposer/getFormData" class="btn btn-default" type="button">Chọn</button>
                        </span>
                    </div>
                </div>
            </div>
            <div id="detailForm"></div>
            <!-- Form actions -->
            <div class="form-actions text-right">
                <a href="<?= $root_site.$modules; ?>/content_blocks" class="btn btn-info">Hủy</a>
                <input class="btn btn-danger" name="btnCreate" disabled="disabled" type="submit" value="Thêm mới">
            </div>
            <!-- /Form actions -->
            
        </div>
    </div>
</form>
<!-- /Form -->
<!-- /Custom content -->

<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Trình đơn
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/menus_items">Menus</a></li>
        <li class="active">Cập nhật</li>
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
<?= validation_errors('<div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger">','</li></ul></div></div>'); ?>
<?php if (isset($error)) { ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
<?php } ?>
<form action="<?= $root_site.$this->uri->uri_string(); ?>" id="fMenu_items" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="row">
        <div class="col-md-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#required"><i class="icon-cogs"></i> Thông tin cơ bản</a></h6>
                    </div>
                    <div id="required" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Nhóm menu :<span class="mandatory">*</span>:</label>
                                        <select class="select-search" name="group_id">
                                            <?php
                                            if(!empty($menu_groups))
                                            {
                                                foreach ($menu_groups as $menu_group) {
                                            ?>
                                            <option value="<?= $menu_group->id; ?>" <?= $menu_group->id == $menu->group_id ? 'selected' : ''; ?>><?= $menu_group->title; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Vị trí liên kết : <span class="mandatory">*</span>:</label>
                                        <select class="select-search" name="parent_id">
                                            <option value="0">Đây là cấp cha</option>
                                            <?php callMenu($menus,0,'--&nbsp;',$menu->parent_id); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Tên menu : <span class="mandatory">*</span>:</label>
                                        <input class="form-control" id="title" name="title" type="text" value='<?= $menu->title;?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="title">Loại liên kết :</label>
                                        <select class="select-search" id="type_id" name="type_id">
                                            <option value="">|-- Không có liên kết</option>
                                            <?php
                                            if (!empty($menu_types)) {
                                                foreach ($menu_types as $menu_type) {
                                            ?>
                                            <option value="<?= $menu_type->id; ?>" <?= ($menu_type->id == $menu->type_id) ? 'selected' :''; ?>>|-- <?= $menu_type->title; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="title">Dữ liệu:</label>
                                        <select class="select-search" id="component_id" name="component_id">
                                        <?php
                                        if (isset($component_id) || !empty($component_id)) {
                                            foreach ($component_id as $data_id) {
                                        ?>
                                        <option value="<?= $data_id['id']; ?>" <?= ($data_id['id'] == $menu->type_id) ? 'selected' :''; ?>>|-- <?= $data_id['title']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="link_menu">Thứ tự :<span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="ordering" type="text" value="<?= $menu->ordering; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="public">Công bố ?</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" <?= ($menu->public == 1) ? 'checked' : '';?> name="public" type="radio" value="1" id="public"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= ($menu->public == 0) ? 'checked' : '';?> name="public" type="radio" value="0" id="public"> Không
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Panel group -->
        </div>
    </div>

    <!-- Form actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-actions">
                <a href="<?= $root_site.$modules; ?>/menus" class="btn btn-info">Hủy</a>
                <input type="submit" name="btnCreate" value="Cập nhật" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#type_id").change(function()
        {
            $("span#select2-chosen-3").html('')
            var type_id = $("#type_id").val();
            if (type_id == ""){
                $("#component_id").html('');
                $("span#select2-chosen-3").html('');
            }
            var csrf_test_name = $("form#fMenu_items input[type=hidden]").val();
            $.ajax({
                url: '<?= $root_site; ?>admin/ajax/load_ajax',
                type: 'POST',
                dataType:'json',
                data: {type_id: type_id, csrf_test_name: csrf_test_name},
                success:function(result){
                    $("#component_id").html('');
                    $.each(result, function(index, val) {
                       $("#component_id").append('<option value="'+val.id+'">|-- '+val.title+'</option>');
                    });
                }
            });
            return false;
        });
    });
</script>
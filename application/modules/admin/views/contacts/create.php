<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3><span data-icon="&#xe312;"></span> Danh bạ</h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules.'/'.$controller; ?>">Danh bạ</a></li>
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
            <?= validation_errors("_toastr('","','jGrowl-alert-danger')"); ?>
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","jGrowl-alert-success")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","jGrowl-alert-danger")';
            }
            ?>
        });
    </script>
</div>
<!-- Callout -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.contacts.js"></script>
<!-- Form -->
<form method="POST" action="<?= $root_site.$this->uri->uri_string() ?>" accept-charset="UTF-8" enctype="multipart/form-data" name="fContacts">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-plus-square"></i> Thêm mới danh bạ</h6>
        </div>
        <div class="panel-body">
            <div class="tabbable block">
                <ul class="nav toolbar-tabs nav-tabs">
                    <li class="active">
                        <a href="#basic-info" data-toggle="tab">
                            <i class="fa fa-file fa-fw"></i> Thông tin bắt buộc
                        </a>
                    </li>
                    <li>
                        <a href="#detail" data-toggle="tab">
                            <i class="fa fa-file-word-o fa-fw"></i> Thông tin mở rộng
                        </a>
                    </li>
                    <li>
                        <a href="#extended-info" data-toggle="tab">
                            <i class="fa fa-globe fa-fw"></i> Mạng xã hội
                        </a>
                    </li>
                </ul>
            </div>
            <?php $params = $this->input->post('params'); ?>
            <div class="tab-content pill-content">
                <div class="tab-pane fade in active" id="basic-info">
                    <div class="col-xs-4">
                        <div class="form-group previewImage">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="previewImage">
                                        <img src="<?= $root_site.'public/'.$modules;?>/images/no-image.jpg" class="img-resposnive center-block" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="styled" id="image" name="image" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="public">C&ocirc;ng bố:</label>
                                    <div class="group-inline-input">
                                        <label class="radio-inline">
                                            <input class="styled" checked="checked" name="public" type="radio" value="1" id="public"> Có
                                        </label>
                                        <label class="radio-inline">
                                            <input class="styled" name="public" type="radio" value="0" id="public"> Không
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="category_id">Nhóm danh bạ <span class="mandatory">*</span>:</label>
                                    <select class="select-search" id="category_id" name="category_id">
                                        <?php callMenu($category,0,'|--',$this->input->post('category_id')); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title">Tên danh bạ <span class="mandatory">*</span>:</label>
                                    <input class="form-control" id="title" name="title" type="text" value="<?= $this->input->post('title') ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title_alias">URL <span class="mandatory">*</span>:</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button name="createAlias" class="btn btn-default" type="button">Đề xuất</button>
                                        </span>
                                        <input class="form-control" id="title_alias" name="title_alias" type="text" value="<?= $this->input->post('title_alias') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="email">Email <span class="mandatory">*</span>:</label>
                                    <input class="form-control" id="email" name="email" type="text" value="<?= $this->input->post('email') ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="detail">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="params[gmlatitude]">Google Map Latitude:</label>
                                        <input class="form-control" name="params[gmlatitude]" type="text" id="params[gmlatitude]" value="<?= $params['gmlatitude']; ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="params[gmlongtitude]">Google Map Longtitude:</label>
                                        <input class="form-control" name="params[gmlongtitude]" type="text" id="params[gmlongtitude]" value="<?= $params['gmlongtitude']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[gmtitle]">Google Map Maker Title:</label>
                                        <input class="form-control" name="params[gmtitle]" type="text" id="params[gmtitle]" value="<?= $params['gmtitle'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[gminfo]">Google Map Maker Info:</label>
                                        <textarea class="form-control" name="params[gminfo]" cols="50" rows="10" id="params[gminfo]"><?= $params['gminfo'];?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[address]">Địa chỉ:</label>
                                        <input value="<?= $params['address']; ?>" class="form-control" name="params[address]" type="text" id="params[address]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[phone]">Điện thoại b&agrave;n:</label>
                                        <input class="form-control" value="<?= $params['phone'];?>" name="params[phone]" type="text" id="params[phone]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[mobile]">Điện thoại cầm tay:</label>
                                        <input class="form-control" value="<?= $params['mobile'];?>" name="params[mobile]" type="text" id="params[mobile]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[fax]">Số fax:</label>
                                        <input class="form-control" value="<?= $params['fax'];?>" name="params[fax]" type="text" id="params[fax]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="params[taxcode]">M&atilde; số thuế:</label>
                                        <input class="form-control" value="<?= $params['taxcode'];?>" name="params[taxcode]" type="text" id="params[taxcode]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="extended-info">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[facebook]">Trang Facebook:</label>
                                <input class="form-control" value="<?= $params['facebook'];?>" name="params[facebook]" type="text" id="params[facebook]">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[gplus]">Trang Google plus:</label>
                                <input class="form-control" value="<?= $params['gplus'];?>" name="params[gplus]" type="text" id="params[gplus]">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[twitter]">Trang Twitter:</label>
                                <input class="form-control" value="<?= $params['twitter'];?>" name="params[twitter]" type="text" id="params[twitter]">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="params[youtube]">K&ecirc;nh Youtube:</label>
                                <input class="form-control" value="<?= $params['youtube'];?>"  name="params[youtube]" type="text" id="params[youtube]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /tab-content --> 
        </div>
    </div>
    <!-- Form actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-actions pull-right">
                <a href="<?= $root_site.$modules;?>/contacts" class="btn btn-cancel">Hủy</a>
                <input class="btn btn-success" name="btnCreate" type="submit" value="Th&ecirc;m mới">
            </div>
        </div>
    </div>
    <!-- /Form actions -->
    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
</form>
<!-- /Form -->
<!-- /Custom content -->

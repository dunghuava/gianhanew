<!-- Page header -->
<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Thông tin công ty<small>Thông tin liên hệ chung công ty</small>
        </h3>
    </div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li class="active">Cấu hình hệ thống</li>
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
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="row">
        <div class="col-xs-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger active"><a data-toggle="collapse" data-parent="#accordion" href="#company"><i class="icon-cogs"></i> Thông tin công ty</a></h6>
                    </div>
                    <div id="company" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Tên công ty <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[company]" value="<?= $setting->company;?>" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Địa chỉ <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[address]" value="<?= $setting->address; ?>" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">E-mail <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[email]" value="<?= $setting->email; ?>" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Số điện thoại <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[phone]" value="<?= $setting->phone; ?>" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Số Fax <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[fax]" value="<?= $setting->fax; ?>" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Website <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[website]" value="<?= $setting->website; ?>" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Info -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger"><a data-toggle="collapse" data-parent="#accordion" href="#google_map"><i class="icon-cogs"></i> Google Map</a></h6>
                    </div>
                    <div id="google_map" class="panel-collapse collapse" aria-expanded="false">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Vĩ độ (latitude) <span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[latitude]" value="<?= $setting->latitude; ?>" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Kinh độ (longitude)<span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[longitude]" value="<?= $setting->longitude; ?>" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Zoom map<span class="mandatory">*</span>:</label>
                                        <input class="form-control" name="value[zoom]" value="<?= $setting->zoom; ?>" type="text" />
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
                <a href="<?= $root_site; ?>admin/settings/reset/company" class="btn btn-info">Khôi phục mặc định</a>
                <input type="submit" name="btnSettingUpdate" value="Cập nhật cấu hình" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->

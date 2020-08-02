<!-- Page header -->
<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Cấu hình tính năng sản phẩm<small>Cấu hình modules sản phẩm</small>
        </h3>
    </div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li class="active"> Cấu hình sản phẩm</li>
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
        <div class="col-md-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger active">
                            <a data-toggle="collapse" data-parent="#accordion" href="#site-info">
                                <i class="icon-cogs"></i> Cấu hình ảnh minh họa
                            </a>
                        </h6>
                    </div>
                    <div id="site-info" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[thumbnail_max_width]">Chiều rộng tối đa của ảnh (px):</label>
                                        <input class="form-control" name="value[thumbnail_max_width]" type="text" value="<?= $setting->thumbnail_max_width; ?>" id="value[thumbnail_max_width]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[thumbnail_max_height]">Chiều cao tối đa của ảnh (px):</label>
                                        <input class="form-control" name="value[thumbnail_max_height]" type="text" value="<?= $setting->thumbnail_max_height; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger"><a data-toggle="collapse" data-parent="#accordion" href="#pagination-info"><i class="icon-file6"></i> Cấu hình phân trang</a></h6>
                    </div>
                    <div id="pagination-info" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[record_per_page]">Số nội dung mỗi trang:</label>
                                        <input class="form-control" name="value[record_per_page]" type="text" value="<?= $setting->record_per_page; ?>" id="value[record_per_page]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[page_per_segment]">Số trang mỗi ph&acirc;n đoạn:</label>
                                        <input class="form-control" name="value[page_per_segment]" type="text" value="<?= $setting->page_per_segment; ?>" id="value[page_per_segment]">
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
                <a href="<?= $root_site; ?>admin/settings/reset/product" class="btn btn-info">Khôi phục mặc định</a>
                <input type="submit" name="btnSettingUpdate" value="Cập nhật cấu hình" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->

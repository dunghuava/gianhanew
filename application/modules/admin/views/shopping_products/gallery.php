<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            <?= $title; ?>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Thêm hoặc cập nhật</li>
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
    if ($this->session->flashdata('errors')) {
    ?>
    <div class="callout callout-danger fade in">
        <button type="button" class="close" data-dismiss="errors">×</button>
        <h5>Đã có lỗi xảy ra</h5>
        <p><?= $this->session->flashdata('errors'); ?></p>
    </div>
    <?php   
    }
    ?>
</div>
<?php 
if (isset($error)) {
    ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
    <?php 
} 
?>
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post" enctype="multipart/form-data" id="doupload">
    <div class="row">
        <div class="col-md-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#required"><i class="icon-cogs"></i> Thông tin</a></h6>
                    </div>
                    <div id="required" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="image">Chọn hình <span class="mandatory">*</span>:</label>
                                        <input class="styled" name="userfile[]" multiple='multiple' type="file" id="userfile" />
                                        <span class="label label-block label-danger text-left">Cho phép chọn nhiều hình ảnh ( tối đa 1M , kích thước 780x486, định dạng: png,gif,jpg )</span>
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="image"><span class="mandatory">*</span> Hình ảnh ( Click vào 1 hình để xóa)</label>
                                        <div class="thumbnails">
                                            <?php
                                            if (!empty($gallerys)) {
                                                foreach ($gallerys as $gallery) {
                                            ?>
                                            <a href="<?= $root_site; ?>uploads/products/<?= $gallery->image;?>" class="lightbox">
                                                <img src="<?= $root_site; ?>uploads/products/<?= $gallery->image;?>" class="xoahinh img-thumbnail img-responsive" alt="<?= $gallery->id ?>" title="Bạn muốn xóa hình này ?" style="width:80px;" />
                                            </a>
                                            
                                            <?php
                                            }
                                            }else{
                                                echo '<p style="text-align:center;color:red;">Chưa có hình ảnh gallery</p>';
                                            }
                                            ?>
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
                <a href="<?= $root_site; ?>admin/shopping_products" class="btn btn-info">Hủy</a>
                <input type="submit" name="doupload" value="Thêm / Cập nhật" class="btn btn-danger" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
<script language="javascript">
    $(function() {
        $("img.xoahinh").click(function(event) {
            /* Act on the event */
            if (!window.confirm('Bạn muốn xóa hình này ?')) {
              return false;
            }else{
                event.preventDefault();
                var id = $(this).attr('alt');
                var csrf_test_name = '<?= $this->security->get_csrf_hash(); ?>';
                $.ajax({
                    url: '<?= $root_site; ?>admin/images/delImage',
                    type: 'POST',
                    data: {image_id: id,csrf_test_name:csrf_test_name},
                    success:function(result)
                    {
                        if (result == 1){
                            window.location = '<?= $root_site; ?>admin/images/create/<?= $room_id; ?>';
                        }else{
                            alert("Xử lý bị lỗi");
                        }
                    }
                });
            }
        });
    });
</script>
<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách
            <small>Danh sách adverting trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li><a href="<?= $root_site.$modules; ?>/advertings">Advertings</a></li>
        <li class="active">Danh sách</li>
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
<?php 
if (isset($error))
{
    ?>
    <div id="errors"><div class="callout callout-danger fade in" style="padding:5px 10px;margin-bottom: 10px;"><button type="button" class="close" data-dismiss="alert">×</button><ul><li class="text-danger"><?= $error; ?></li></ul></div></div>
    <?php 
} 
?>
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/advertings.js"></script>
<!-- Custom content -->
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách đang có</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="advertings">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tiêu để</th>
                    <th style="width: 110px;" class="text-center">Ảnh</th>
                    <th style="width: 110px;" class="text-center">Nhóm</th>
                    <th style="width: 110px;" class="text-center">Công bố</th>
                    <th style="width: 110px;" class="text-center">Cập nhật bới</th>
                    <th style="width: 110px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 110px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($advertings)) {
                    foreach ($advertings as $key => $adverting) {
                ?>
                <tr index="<?= $adverting->adv_id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $adverting->adv_id; ?></td>
                    <td><?= $adverting->adv_title; ?></td>
                    <td class="text-center">
						<?php
						if ($adverting->adv_type == 'upload'){
						?>
						<a href="<?= $root_site.'uploads/advertings/'.$adverting->adv_image; ?>" class="lightbox">
							<img src="<?= $root_site.'uploads/advertings/'.$adverting->adv_image; ?>" alt="" class="img-media" />
						</a>
						<?php
						}else{
						?>
						Sử dụng code
						<?php
						}
						?>
                    </td>
                    <td style="width: 115px;" class="text-center"><?= $adverting->title; ?></td>
                    <td style="text-align:center;">
                        <?= ($adverting->public == 1) ? '<span class="label label-info">Có</span>' : '<span class="label label-danger">Không</span>';?>
                    </td>
                    <td class="text-center"><?= $adverting->username; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($adverting->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/advertings/destroy/<?= $adverting->adv_id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa advertings có ID <?= $adverting->adv_id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/advertings/update/<?= $adverting->adv_id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
<!-- /Custom content -->

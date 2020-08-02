<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách đối tác
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Đối tác</li>
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
<script type="text/javascript" src="<?= $root_site; ?>public/admin/js/admin.partner.js"></script>
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách đang có</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="partners">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th style="text-align:center;">Hình ảnh logo</th>
                    <th style="text-align:center;">Đối tác</th>
                    <th>Website</th>
                    <th style="width: 150px;text-align:center;">Cập nhật bởi</th>
                    <th style="width: 115px;">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($branchs as $branch){
                ?>
                <tr index="<?= $branch['id']; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $branch['id']; ?></td>
                    <td style="text-align:center;">
                        <div class="thumbnails">
                            <a href="<?= $branch['image']; ?>" class="lightbox">
                                <img src="<?= $branch['image']; ?>" alt="" class="img-thumbnail img-responsize" style="width:50%;" />
                            </a>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <?php
                        echo $branch['title'];
                        ?> 
                    </td>
                    <td>
                       <?php $params = json_decode($branch['params']); echo $params->website ;?>
                    </td>
                    <td style="text-align:center;"><?= $branch['username']; ?></td>
                    <td>
                        <div class="table-controls">
                            <a href="#" class="btn btn-link btn-icon btn-xs tip data-delete" title="Xóa"><i class="icon-remove"></i></a> 
                            <a href="<?= $root_site.$modules; ?>/branchs/update/<?= $branch['id']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                }?>
            </tbody>
        </table>
    </div>
</div>
    <!-- /Table -->
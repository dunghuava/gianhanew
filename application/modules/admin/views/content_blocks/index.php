<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3><span data-icon="&#xe312;"></span> 
            KHỐI NỘI DUNG <small>Danh sách tất cả các khối nội dung hiện có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Khối nội dung</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
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
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.content_blocks.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-windows"></i> Danh sách khối nội dung đang có</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="content_blocks" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="articles">
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th>Khối nội dung</th>
                    <th class="text-left">Vị trí</th>
                    <th>Loại nội dung</th>
                    <th style="width: 50px;" class="text-center"><i class="fa fa-check"></i></th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($content_blocks as $content_block){ ?>
                <tr index="<?= $content_block->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $content_block->id; ?></td>
                    <td><?= $content_block->title; ?></td>
                    <td class="text-left"><?= $content_block->position; ?></td>
                    <td class="text-left"><?= $content_block->type_title; ?></td>
                    <td style="text-align:center;">
                        <?= ($content_block->public == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-ban"></i>';?>
                    </td>
                    <td class="text-center"><?= $content_block->display_name; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($content_block->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/content_blocks/destroy/<?= $content_block->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa khối nội dung có ID <?= $content_block->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/content_blocks/update/<?= $content_block->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
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
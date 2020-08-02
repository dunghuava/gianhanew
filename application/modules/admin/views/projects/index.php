<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Dự án<small>Danh sách tất cả các bài viết dự án hiện có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Bài viết</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
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
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.projects.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Danh sách dự án</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="projects" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="projects">
            <thead>
                <tr>
                    <th style="width: 45px;"><input type="checkbox" id="checkall" /></th>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th class="image-column text-center">Image</th>
                    <th>Dự án</th>
                    <th style="width: 145px;" class="text-center">Nhóm dự án</th>
                    <th style="width: 100px;" class="text-center">Duyệt</th>
                    <th style="width: 105px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 105px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 105px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($projects as $project){
                ?>
                <tr index="<?= $project->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><input type="checkbox" class="checkthis" value="<?= $project->id; ?>" /></td>
                    <td><?= $project->id; ?></td>
                    <td class="text-center">
                        <a href="<?= $root_site.'uploads/projects/'.$project->image;?>" class="lightbox">
                            <img src="<?= $root_site.'uploads/projects/'.$project->image;?>" class="img-media" />
                        </a>
                    </td>
                    <td><?= $project->title; ?></td>
                    <!-- 
                    <td><i class="icon-arrow-right11 block-disabled"></i><?= $project->province_name; ?><i class="icon-arrow-right11 block-disabled"></i><?= $project->district_name; ?></td>
                    -->
                    <td style="width: 115px;" class="text-center"><?= $project->title_cate; ?></td>
                    <td style="text-align:center;">
                        <?= ($project->public == 1) ? '<span class="label label-info">Xong</span>' : '<span class="label label-danger">Chưa</span>';?>
                    </td>
                    <td class="text-center"><?= $project->username; ?></td>
                    <td class="text-center"><?= date('m-d-Y H:i:s',strtotime($project->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/projects/destroy/<?= $project->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa dự án có ID <?= $project->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/projects/update/<?= $project->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
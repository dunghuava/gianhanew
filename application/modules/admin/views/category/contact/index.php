<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> NHÓM DANH BẠ
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Nhóm danh bạ </li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <script type="text/javascript">
        $(document).ready(function() {
            <?php
            if ($this->session->flashdata('success')){
                echo '_toastr("'.$this->session->flashdata('success').'","growl-success")';
            }
            if ($this->session->flashdata('error')){
                echo '_toastr("'.$this->session->flashdata('error').'","growl-danger")';
            }
            ?>
        });
    </script>
</div>
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/categories.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Nhóm danh bạ</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" component='contact' id="categories">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tiêu đề</th>
                    <th style="width:60px;" class="text-center"><i class="fa fa-check"></i></th>
                    <th style="width:115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width:130px;" class="text-center">Cập nhật lúc</th>
                    <th style="width:115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($category)) {
                    foreach($category as $k => $categories){
                    ?>
                    <tr index="<?= $categories['id']; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                        <td><?= $categories['id']; ?></td>
                        <td data-order="<?= $categories['path_alias']; ?>">
                            <?php
                            echo '<i class="icon-arrow-right3 block-disabled"></i>'.str_replace('/','<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-arrow-right3 block-disabled"></i>' , $categories['path']);
                            ?>
                        </td>
                        <td style="text-align:center;">
                           <?php 
                           if ($categories['public'] == 1) {
                               echo '<i class="fa fa-check text-success"></i>';
                           }else{
                               echo '<i class="fa fa-ban text-danger"></i>';
                           }
                           ?>
                        </td>
                        <td class="text-center"><?= $categories['username']; ?></td>
                        <td class="text-center">
                            <?= date('d-m-Y',strtotime($categories['updated_at']));?><hr><?= date('H:i:s',strtotime($categories['updated_at']));?>
                        </td>
                        <td class="text-center">
                            <div class="table-controls">
                                <a href="<?= $root_site.$modules; ?>/category/destroy/<?= $categories['id'].'/'.$categories['component']; ?>" onclick="return confirm('Bạn muốn xóa nhóm bài viết có ID=<?= $categories['id']; ?> ?');" class="btn btn-link btn-icon btn-xs tip" title="Xóa"><i class="icon-remove"></i></a> 
                                <a href="<?= $root_site.$modules; ?>/category/update/<?= $categories['id'].'/'.$categories['component']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
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
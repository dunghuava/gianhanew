<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Nhóm bất động sản <small>Danh sách tất cả các bất động sản</small>
    </h3>
</div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Nhóm BĐS</li>
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
            if ($this->session->flashdata('error')){
                echo '_toastr("'.$this->session->flashdata('error').'","jGrowl-alert-danger")';
            }
            if(isset($error)){
                echo '_toastr("'.$error.'","jGrowl-alert-danger")';
            }
            ?>
        });
    </script>
</div>
<!-- Callout -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/categories.js"></script>
<!-- Table -->
<div class="panel panel-default">

    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Nhóm bất động sản</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="categories" component='realestate'>
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Tiêu đề</th>
                    <th style="width:60px;" class="text-center"><i class="fa fa-check"></i></th>
                    <th style="width: 120px;" class="text-center">Cập nhật bới</th>
                    <th style="width: 120px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //var_dump($category);die;
                if (!empty($category)) {
                    foreach($category as $categories){
                        ?>
                        <tr index="<?= $categories['id']; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                            <td><?= $categories['id']; ?></td>
                            <td>
                                <?php
                                echo '<i class="icon-arrow-right3 block-disabled"></i>'.str_replace('/','<i class="icon-arrow-right3 block-disabled"></i>' , $categories['path']);
                                ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                if ($categories['public'] == 1) {
                                    echo '<i class="fa fa-check text-success"></i>';
                                }else{
                                   echo '<i class="fa fa-ban text-danger"></i>';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?= $categories['username']; ?>
                            </td>
                            <td class="text-center">
                                <?= date('d-m-Y H:i:s',strtotime($categories['updated_at']));?>
                            </td>
                            <td  class="text-center">
                                <div class="table-controls">
                                    <a href="<?= $root_site.$modules; ?>/category/destroy/<?= $categories['id']; ?>/<?= $categories['component']; ?>" class="btn btn-link btn-icon btn-xs tip" onclick="return confirm('Bạn muốn xóa chuyên mục có ID <?= $categories['id']; ?> ?');" title="Xóa"><i class="icon-remove"></i></a> 
                                    <a href="<?= $root_site.$modules; ?>/category/update/<?= $categories['id']; ?>/<?= $categories['component']; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
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
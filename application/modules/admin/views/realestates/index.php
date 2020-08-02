<?php $segment = $this->uri->segment(4);?>
<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách tin rao vặt<small>Danh sách tất cả các rao vặt mới nhất hiện có trên site</small>
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Tin rao vặt</li>
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
<div class="page-header">
    <div class="page-title text-info text-semibold" style="margin-bottom: 0px;background: none;">
        <div class="filters m-t-sm">
            <h3>
                <a href="<?= $root_site.$modules.'/realestates/index/1'; ?>">
                    <span class="btn btn-xs <?= ($segment == 1) ? 'btn-info' : 'btn-primary' ?> btn-rounded">Chờ duyệt</span>
                </a>
                <a href="<?= $root_site.$modules.'/realestates/index/2'; ?>">
                    <span class="btn btn-xs <?= ($segment == 2) ? 'btn-info' : 'btn-primary' ?> btn-rounded">Đã duyệt</span>
                </a>
                <a href="<?= $root_site.$modules.'/realestates/index/3'; ?>">
                    <span class="btn btn-xs <?= ($segment == 3) ? 'btn-info' : 'btn-primary' ?> btn-rounded">Vi phạm</span>
                </a>
                <a href="<?= $root_site.$modules.'/realestates/index/4'; ?>">
                    <span class="btn btn-xs <?= ($segment == 4) ? 'btn-info' : 'btn-primary' ?> btn-rounded">Xóa</span>
                </a>
            </h3>
        </div>
    </div>
</div>
<!-- Callout -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Rao vặt</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="articles" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="articles">
            <thead>
                <tr>
                    <th style="width: 45px;"><input type="checkbox" id="checkall" /></th>
                    <th style="width: 50px;" class="text-center">ID</th>
                    <th>Tiêu đề</th>
                    <th style="width: 115px;" class="text-right">Kiểm duyệt</th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Đăng tin lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($realestates as $realestate){ ?>
                <tr index="<?= $realestate->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><input type="checkbox" class="checkthis" value="<?= $realestate->id; ?>" /></td>
                    <td><?= $realestate->id; ?></td>
                    <td><a href="<?= $root_site.$realestate->alias.'/'.$realestate->title_alias.'-'.toPublicId($realestate->id); ?>" target="_blank"><?= $realestate->title; ?></a></td>
                    <td class="text-right"><?= approval($realestate->approval) ?></td>
                    <td class="text-center">
                        <a href="<?= $root_site.$modules.'/users/show/'.$realestate->created_by; ?>" target="_blank">
                            <?= $realestate->username; ?>
                        </a>
                    </td>
                    <td class="text-center">
                    <?php
                        if (strtotime(date('d-m-Y',strtotime($realestate->created_at))) == strtotime(date('m/d/Y'))){
                            echo 'Hôm nay';
                        }else{
                            echo date('d-m-Y',strtotime($realestate->created_at));
                        }
                    ?>
                    </td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules.'/realestates/show/'.$realestate->id ?>" class="btn btn-link btn-icon btn-xs tip" title="Xem">
                                <i class="icon-file"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?= $link; ?>
    </div>
</div>
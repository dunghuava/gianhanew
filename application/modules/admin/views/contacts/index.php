<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> DANH BẠ
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Danh bạ</li>
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
<!-- Custom content -->
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.contacts.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-list"></i> Danh sách danh bạ</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="contacts">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Danh bạ</th>
                    <th style="width: 135px;" class="text-center">Nhóm</th>
                    <th style="width: 60px;" class="text-center"><i class="fa fa-check text-success"></i></th>
                    <th style="width: 130px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 130px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 100px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $key => $contact) { ?>
                <tr index="<?= $contact->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td class="text-center"><?= $contact->id; ?></td>
                    <td><?= $contact->title; ?></td>
                    <td class="text-center"><?= $contact->cate_title; ?></td>
                    <td class="text-center">
                        <?php if ($contact->public == 1) {?>
                        <i class="fa fa-check text-success"></i>
                        <?php }else{ ?>
                        <i class="fa fa-ban text-danger"></i>
                        <?php } ?>
                    </td>
                    <td class="text-center"><?= $contact->display_name;?></td>
                    <td class="text-center"><?= date('d/m/Y',strtotime($contact->updated_at)).'<hr>'.date('H:i',strtotime($contact->updated_at));?></td>
                    <td>
                        <div class="table-controls">
                            <a href="#" class="btn btn-link btn-icon btn-xs tip data-delete" title="Xóa">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules.'/contacts/update/'.$contact->id;?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa">
                                <i class="icon-pencil"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
<!-- /Custom content -->

<!-- Page header -->
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
        <li class="active"><?= $title; ?></li>
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
    if ($this->session->flashdata('error')) {
        ?>
        <div class="callout callout-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Đã có lỗi xảy ra</h5>
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i> <?= $title; ?></h6>
    </div>
    <script type="text/javascript">
    var districtid = '<?= $this->uri->segment(5); ?>';
    var provinceid = '<?= $this->uri->segment(4); ?>'
    </script>
    <script type="text/javascript" src="<?= $root_site; ?>public/<?= $modules; ?>/js/streets.js"></script>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" component="" id="districts" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="districts">
            <thead>
                <tr>
                    <th style="width: 50px;">Mã</th>
                    <th>Tên đường</th>
                    <th style="width: 120px;text-align:center;">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($roads as $road){
                ?>
                <tr index="<?= $road->street_id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><?= $road->street_id; ?></td>
                    <td><i class="icon-arrow-right11 block-disabled"></i><?= $road->name; ?></td>
                    <td>
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/roads/destroy/<?= $this->uri->segment(4).'/'. $road->district_id .'/'.$road->street_id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn street_id tuyến đường có ID <?= $road->street_id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/roads/update/<?= $road->district_id .'/'. $road->street_id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
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
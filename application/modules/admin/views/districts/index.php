<!-- Page header -->
<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Danh sách tuyến đường của quận / huyện
        </h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Quận - Huyện</li>
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
        <h6 class="panel-title"><i class="icon-table"></i> Danh sách quận - huyện</h6>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="title">Tỉnh/thành phố <span class="mandatory">*</span>:</label>
                    <select class="select-search" id="select-province">
                        <?php
                        if (!empty($provinces)) {
                            foreach ($provinces as $province) {
                        ?>
                        <option value="<?= $province->province_id; ?>" <?= ($province->province_id == 1 ) ? 'selected' : ''; ?>><?= $province->name; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            var provinceID = $('#select-province').val();
            $('table#districts').attr('component',$('#select-province').val());
            var csrf_test_name = $("#districts").attr('csrf_test_name');
            if (provinceID != 0){
                $.post(base_url + '<?= $modules; ?>/districts/load_district', {province_id: provinceID, csrf_test_name: csrf_test_name}, function(data, textStatus, xhr) 
                {
                    $("table#districts tbody").html('');
                    $.each(data, function(index, val) {
                        var html  = '<tr index="'+val.district_id+'">';
                        html += '<td>'+val.district_id+'</td>';
                        html += '<td style="width:110px;" class="text-center">'+ val.pre +'</td>';
                        html += '<td>'+val.name+'</td>';
                        html += '<td>';
                        html += '<div class="table-controls">';
                        html += '<a href="'+ base_url +'<?= $modules; ?>/streets/index/'+val.province_id+'/'+val.district_id+'" class="btn btn-info">';
                        html += 'Tuyến đường';
                        html += '</a>';
                        html += '</div>';
                        html +='</td>';
                        html += '<td>';
                        html += '<div class="table-controls">';
                        html += '<a href="'+ base_url +'<?= $modules; ?>/streets/create/'+val.province_id+'/'+val.district_id+'" class="btn btn-info" title="Xóa" onclick="return confirm(\'Bạn thực sự muốn thêm mới tuyến đường cho quận này ?\');">';
                        html += 'Thêm mới';
                        html += '</a>';
                        html += '</div>';
                        html +='</td>';
                        html += '</tr>';
                        $("table#districts tbody").append(html);
                    });
                    $('#districts').attr('component',$('#select-province').val());
                },'json');
                return false;
            }

        });
        $(function() {
            $('#select-province').change(function(event) {
                var csrf_test_name = $("#districts").attr('csrf_test_name');
                if ($('#select-province').val() != 0){
                    $.post(base_url + '<?= $modules; ?>/districts/load_district', {province_id: $('#select-province').val(), csrf_test_name: csrf_test_name}, function(data, textStatus, xhr) 
                    {
                        $("table#districts tbody").html('');
                        $.each(data, function(index, val) {
                            var html  = '<tr index="'+val.district_id+'">';
                            html += '<td>'+val.district_id+'</td>';
                            html += '<td style="width:110px;" class="text-center">'+ val.pre +'</td>';
                            html += '<td>'+val.name+'</td>';
                            html += '<td>';
                            html += '<div class="table-controls">';
                            html += '<a href="'+ base_url +'<?= $modules; ?>/streets/index/'+val.province_id+'/'+val.district_id+'" class="btn btn-info">';
                            html += 'Tuyến đường';
                            html += '</a>';
                            html += '</div>';
                            html +='</td>';
                            html += '<td>';
                            html += '<div class="table-controls">';
                            html += '<a href="'+ base_url +'<?= $modules; ?>/streets/create/'+val.district_id+'" class="btn btn-info" title="Xóa" onclick="return confirm(\'Bạn thực sự muốn thêm mới tuyến đường cho quận này ?\');">';
                            html += 'Thêm mới';
                            html += '</a>';
                            html += '</div>';
                            html +='</td>';
                            html += '</tr>';
                            $("table#districts tbody").append(html);
                        });
                    },'json');
                    return false;
                }
            });
        });
    </script>
    <script type="text/javascript" src="<?= $root_site; ?>public/<?= $modules; ?>/js/district.js"></script>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" component="" id="districts" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="districts">
            <thead>
                <tr>
                    <th style="width: 50px;">Mã</th>
                    <th class="text-center">Kiểu</th>
                    <th>Quận Huyện</th>
                    <th style="width: 120px;text-align:center;">Tuyến đường</th>
                    <th style="width: 120px;text-align:center;">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->
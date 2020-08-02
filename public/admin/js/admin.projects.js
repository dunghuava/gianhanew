$(document).ready(function() {
    //=== Setting for articles list table ===//
    var component = $('#projects').attr('component');
    articlesTable = $('#projects.dataTable').DataTable({
        "order": [
            [ 1, "desc" ],
        ],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0,2,3,4,5,6,7,8 ] },
        ],
        "oTableTools": {
            "sRowSelect": "none", // Select single, multi, none
            "aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Thêm mới",
                    "sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = base_url+modules+'/projects/create';
                    }
                }
            ]
        }
    });
    //=== Deleting for one investor ===//
    $('#projects tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        var csrf_test_name = thisRow.attr('csrf_test_name');
        if (window.confirm('Bạn có chắc muốn xóa bài viết có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
            $.ajax({
                'url'       : base_url+'admin/articles/destroy/' +id,
                'type'      : 'post',
                'async'     : true,
                'data'      : '_method=DELETE'+'&csrf_test_name='+csrf_test_name,                
                'success'   : function(message) {
                    $('div#message').empty();
                    if (message == 'finish') {
                        thisRow.addClass('deleted');
                        articlesTable.row('.deleted').remove().draw(false);
                        $('div#message').empty();                        
                    } else {
                        $('div#message').html('<div class="callout callout-danger fade in"><h5>Có lỗi xảy ra</h5><p>' +message+ '</p></div>');
                                            
                    }
                }
            });
        }
        return false;
    });
    
    $(".dataTables_wrapper tfoot input").keyup( function () {
        articlesTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
    
    //=== CREATE PAGE ===//
    
    // Create alias
    $('button[name=createAlias]').click(function() {
        var title = $('input[name=title]').val();
        $('input[name=title_alias]').val(toSlug(title));
    });
    $('button[name=reCreateAlias]').click(function() {
        if (window.confirm("Bạn có chắc muốn tạo lại tên bí danh mới?\r\nViệc này sẽ làm hỏng các liên kết trước đây mà bạn đã sử dụng để truy xuất nội dung này")) {
            var title = $('input[name=title]').val();
            $('input[name=title_alias]').val(toSlug(title));
            $('input[name=title_alias]').removeAttr('readonly');
        }
    });
    $("#projects #checkall").click(function () {
        if ($("#projects #checkall").is(':checked')) {
            $("#projects input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        }else {
            $("#projects input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    //===== Province =====//
    $("#province_id").change(function(event) {
        /* Act on the event */
        $("select#district_id").html('');
        province_id    = $("#province_id").val();
        csrf_test_name = $("form#fProjects input[type=hidden]").val();
        $.post(base_url+modules+'/districts/load_district', {province_id: province_id,csrf_test_name:csrf_test_name}, function(data, textStatus, xhr) {
            html ='';
            $.each(data, function(index, val) {
                html += '<option value="'+val.district_id+'">'+val.pre+' '+val.name+'</option>';
            });
            $("#district_id").html(html);
        },'json');
    });
});
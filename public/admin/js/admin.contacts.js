$(document).ready(function() {
    //=== Setting for articles list table ===//
    articlesTable = $('#contacts.dataTable').DataTable({
        "order": [
            [ 0, "desc" ],
        ],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 1,3,6] },
        ],
        "oTableTools": {
            "sRowSelect": "none", // Select single, multi, none
            "aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Thêm mới",
                    "sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = base_url + 'admin/contacts/create';
                    }
                }
            ]
        }
    });
    
    //=== Deleting for one investor ===//
    $('#contacts tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        var csrf_test_name = thisRow.attr('csrf_test_name');
        if (window.confirm('Bạn có chắc muốn xóa bài viết có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
            $.ajax({
                'url'       : base_url+'admin/contacts/destroy/' +id,
                'type'      : 'post',
                'async'     : true,
                'data'      : '_method=DELETE'+'&csrf_test_name='+csrf_test_name,                
                'success'   : function(message){
                    console.log(message);
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
    
    $('button[name=reCreateAlias]').click(function() {
        if (window.confirm("Bạn có chắc muốn tạo lại tên bí danh mới?\r\nViệc này sẽ làm hỏng các liên kết trước đây mà bạn đã sử dụng để truy xuất nội dung này")) {
            var title = $('#title').val();
            $('input[name=title_alias]').val(toSlug(title));
            $('input[name=title_alias]').removeAttr('readonly');
        }
    });
    // Create alias
    $('button[name=createAlias]').click(function() {
        var title = $('#title').val();
        $('input[name=title_alias]').val(toSlug(title));
    });
});
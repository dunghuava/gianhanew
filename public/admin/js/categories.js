$(document).ready(function() {
    //=== INDEX PAGE ===//
    var component   = $('#categories').attr('component');
    categoriesTable = $('#categories.dataTable').DataTable({
        "order": [
            [ 0, "desc" ],
        ],
    	"aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 5 ] },
        ],
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
    				"sExtends":    "text",
    				"sButtonText": "Thêm mới",
    				"sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = base_url+modules+'/category/create/'+component;
                    }
    			},
            ]
    	}
    });
    
    // Deleting for one category
    $('#categories tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        if (window.confirm('Bạn có chắc muốn xóa danh mục có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
            $.ajax({
                'url'       : '..\\..\\categories/' +id,
                'type'      : 'post',
                'async'     : true,
                'data'      : '_method=DELETE',                
                'success'   : function(message) {
                    $('div#message').empty();
                    if (message == 'finish') {
                        thisRow.addClass('deleted');
                        categoriesTable.row('.deleted').remove().draw(false);
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
        categoriesTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
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
});
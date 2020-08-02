$(document).ready(function() {
    //=== Setting for articles list table ===//
    articlesTable = $('#setups.dataTable').DataTable({
        "order": [
            [ 0, "desc" ],
        ],
    	"aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 1 ] },
        ],
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Cài đặt mới",
                    "sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = base_url+'admin/promotion/create_setup';
                    }
                },
            ]
    	}
    });
    
    //=== Deleting for one investor ===//
    $('#setups tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        var csrf_test_name = thisRow.attr('csrf_test_name');
        if (window.confirm('Bạn có chắc muốn xóa cài đặt khuyến mãi có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
            $.ajax({
                'url'       : base_url+'admin/promotion/setup_destroy/' +id,
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
    $('input#title').keyup(function() {
        var title = $(this).val();
        $('input[name=title_alias]').val(toSlug(title));
    });
});
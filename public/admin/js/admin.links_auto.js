$(document).ready(function() {
    //=== Setting for articles list table ===//
    var component = $('#links_auto').attr('component');
    articlesTable = $('#links_auto').DataTable({
    	"aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6,7 ] },
        ],
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Thêm mới",
                    "sButtonClass": "btn btn-success",
                    "fnClick": function() {
                        window.location = base_url + modules + '/' + controller + '/create';
                    }
                },
            ]
    	}
    });
    //=== Deleting for one investor ===//
    $('#links_auto tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        var csrf_test_name = thisRow.attr('csrf_test_name');
        if (window.confirm('Bạn có chắc muốn xóa bài viết có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
            $.ajax({
                'url'       : base_url + modules + '/' + controller + '/destroy/' +id,
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
});
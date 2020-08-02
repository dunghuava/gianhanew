$(document).ready(function() {
    //=== Setting for articles list table ===//
    articlesTable = $('#menus.dataTable').DataTable({
        "order": [
            [ 0, "asc" ],
        ],
        "columnDefs": [
            { "orderable": false, "targets": [ 3,4,5 ] },
            { "visible": false, "targets": 2 }
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group text-info"><td colspan="5"><b>Nhóm: '+group+'</b></td></tr>'
                    );
                    last = group;
                }
            } );
        },
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
                    "sExtends"    : "text",
                    "sButtonText" : "Thêm mới",
                    "sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = base_url+modules+'/menus_items/create';
                    }
                },
            ]
    	}
    });
    
    //=== Deleting for one investor ===//
    $('#menus tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        var csrf_test_name = thisRow.attr('csrf_test_name');
        if (window.confirm('Bạn có chắc muốn xóa menus có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
            $.ajax({
                'url'       : base_url+modules+'/menus_items/destroy/' + id,
                'type'      : 'POST',
                'async'     : true,
                'data'      : 'csrf_test_name='+csrf_test_name,                
                success     : function(message) {
                    $('div#message').empty();
                    if (message == 'finish') {
                        thisRow.addClass('deleted');
                        articlesTable.row('.deleted').remove().draw(false);
                        $('div#message').empty();
                        $('div#message').html('<div class="callout callout-success fade in"><h5>Hoàn thành thao tác</h5><p>Thao tác thành công</p></div>');                        
                    } else {
                        $('div#message').html('<div class="callout callout-danger fade in"><h5>Có lỗi xảy ra</h5><p>Thao tác không thành công, vui lòng thử lại sau</p></div>');                   
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
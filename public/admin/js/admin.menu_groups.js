$(document).ready(function() {
    //=== Setting for menu_groups list table ===//
    menu_groupsTable = $('#menu_groups.dataTable').DataTable({
        "order": [
            [ 0, "desc" ],
        ],
    	"aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0,1,2,3,4,5 ] },
        ],
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
    				"sExtends":    "text",
    				"sButtonText": "Thêm mới",
    				"sButtonClass": "btn btn-success",
                    "fnClick": function() {
                        window.location = base_url + modules +'/menu_groups/create';
                    }
    			},
            ]
    	}
    });
    
    //=== Deleting for one menu_group ===//
    $('#menu_groups tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        if (window.confirm('Bạn có chắc muốn xóa nhóm nhóm menu có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Äang xÃ³a</div>');
            $.ajax({
                'url'       : 'menu_groups/' +id,
                'type'      : 'post',
                'async'     : true,
                'data'      : '_method=DELETE',                
                'success'   : function(message) {
                    $('div#message').empty();
                    if (message == 'finish') {
                        thisRow.addClass('deleted');
                        menu_groupsTable.row('.deleted').remove().draw(false);
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
        menu_groupsTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
    
    // Create alias
    $('button[name=createAlias]').click(function() {
        var title = $('input[name=title]').val();
        $('input[name=title_alias]').val(toSlug(title));
    });
    $('button[name=reCreateAlias]').click(function() {
        if (window.confirm("Bạn có chắc muốn tạo lại tên bí danh mới ?")) {
            var title = $('input[name=title]').val();
            $('input[name=title_alias]').val(toSlug(title));
            $('input[name=title_alias]').removeAttr('readonly');
        }
    });
});
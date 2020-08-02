$(document).ready(function() {
    //=== Setting for articles list table ===//
    articlesTable = $('#shopping_manufacturers.dataTable').DataTable({
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
    				"sButtonText": "Thêm mới",
    				"sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = 'shopping_manufacturers/create';
                    }
    			},
            ]
    	}
    });
    
    
    $(".dataTables_wrapper tfoot input").keyup( function () {
        articlesTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
    // Create alias
    $('button[name=createAlias]').click(function() {
        var title = $('input[name=title]').val();
        $('input[name=title_alias]').val(toSlug(title));
    });
});
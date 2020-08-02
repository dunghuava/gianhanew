$(document).ready(function() {
    //=== Setting for articles list table ===//
    var component = $('#shopping_size').attr('component');
    articlesTable = $('#shopping_size.dataTable').DataTable({
        "order": [
            [ 0, "desc" ],
        ],
    	"aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] },
        ],
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Thêm mới",
                    "sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = base_url+'admin/shopping_size/create';
                    }
                },
            ]
    	}
    });
    
    $(".dataTables_wrapper tfoot input").keyup( function () {
        articlesTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
     
});
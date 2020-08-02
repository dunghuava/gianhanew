$(document).ready(function() {
    //=== Setting for slider_groups list table ===//
    group_advertingsTable = $('#group_advertings.dataTable').DataTable({
        "order": [
            [ 0, "desc" ],
        ],
    	"aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 4 ] },
        ],
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
    				"sExtends": "text",
    				"sButtonText": "Thêm mới",
    				"sButtonClass": "btn btn-info",
                    "fnClick": function() {
                        window.location = base_url+'admin/group_advertings/create';
                    }
    			},
            ]
    	}
    });
    $(".dataTables_wrapper tfoot input").keyup( function () {
        slider_groupsTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
});
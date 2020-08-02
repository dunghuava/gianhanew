$(document).ready(function() {
    //=== Setting for articles list table ===//
    var component = $('#external_links').attr('component');
    articlesTable = $('#external_links.dataTable').DataTable({
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
                        window.location = base_url+'admin/external_links/create';
                    }
                },
            ]
    	}
    });

    $(".dataTables_wrapper tfoot input").keyup( function () {
        articlesTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
    //===== Bootstrap switches =====// 
});
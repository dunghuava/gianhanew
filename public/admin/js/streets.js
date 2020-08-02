$(document).ready(function() {
    //=== INDEX PAGE ===//
    
    // Setting for categories list table
    var currentPage = $(location).attr('href');
    if (currentPage.indexOf('?') != -1) {
        currentPage = currentPage.substring(0, currentPage.indexOf('?'));
    }
    if (currentPage.indexOf('#') != -1) {
        currentPage = currentPage.substring(0, currentPage.indexOf('#'));
    }
    var component = $('#provinces').attr('component');
    categoriesTable = $('#districts.dataTable').DataTable({
        "aaSorting": [],
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
                        window.location = base_url + modules+'/streets/create/'+provinceid+'/'+districtid;
                    }
                },
            ]
        }
    });
    
    $(".dataTables_wrapper tfoot input").keyup( function () {
        categoriesTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
    
    //=== CREATE PAGE ===//
    
    // Create alias
    $('input#title').keyup(function() {
        var title = $(this).val();
        $('input[name=title_alias]').val(toSlug(title));
    });
});
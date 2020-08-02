$(document).ready(function() {
    //=== Setting for users list table ===//
    usersTable = $('#users.dataTable').DataTable({
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
                        window.location = 'users/create';
                    }
                },
            ]
        }
    });
    
    //=== Deleting for one investor ===//
    $('#users tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        var csrf_test_name = thisRow.attr('csrf_test_name');
        if (window.confirm('Do you want to delete user ID : '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Deleting</div>');
            $.ajax({
                'url'       : 'users/' +id,
                'type'      : 'post',
                'async'     : true,
                'data'      : '_method=DELETE'+'&csrf_test_name='+csrf_test_name,                
                'success'   : function(message) {
                    $('div#message').empty();
                    if (message == 'finish') {
                        thisRow.addClass('deleted');
                        usersTable.row('.deleted').remove().draw(false);
                        $('div#message').empty();                        
                    } else {
                        $('div#message').html('<div class="callout callout-danger fade in"><h5>Have an error </h5><p>' +message+ '</p></div>');
                                            
                    }
                }
            });
        }
        return false;
    });
    
    $(".dataTables_wrapper tfoot input").keyup( function () {
        usersTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
    
    //=== CREATE & EDIT PAGE ===//
    $(document).on('click', 'div.roles-group input[type=checkbox]', function() {
        thisGroup = $(this).parents('div.roles-group');
        thisGroup.siblings().find('input[type=checkbox]').prop('checked', false);
        $('input[name="user_group[]"]').uniform.update();
    });
    
});
$(document).ready(function() {
    /*$('a#ordering').editable({
        type  : 'number',
        pk    : $(this).data('id'),
        url   : base_url + modules + '/' + controller +'/ordering',
        success: function(response, newValue) {
            console.log(response);
        }
    });*/
    //=== Setting for content_blocks list table ===//
    content_blocksTable = $('#content_blocks.dataTable').DataTable({
        "order": [
            [ 2, "desc" ],
        ],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6,7 ] },
        ],
        "columnDefs": [
            { "orderable": false, "targets": [ 2,3,4,5 ] },
            { "visible": false, "targets": 2 }
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="8"><span style="color:#449d44;font-weight:bold;font-size:13px;"><b><i class="fa fa-bars fa-fw"></i> Khu vực </b>: '+group+'</span></td></tr>'
                    );
                    last = group;
                }
            } );
        },
        "oTableTools": {
            "sRowSelect": "none", // Select single, multi, none
            "aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "<i class='fa fa-plus-square fa-fw'></i>Thêm mới",
                    "sButtonClass": "btn btn-success",
                    "fnClick": function() {
                        window.location = base_url + modules + '/content_blocks/create';
                    }
                },
            ]
        }
    });
    $(".dataTables_wrapper tfoot input").keyup( function () {
        content_blocksTable.fnFilter( this.value, $(".dataTables_wrapper tfoot input").index(this) );
    });
    // Delete block image
    $('form a.thumb-delete').click(function() {
        if (window.confirm('Bạn có chắc muốn xóa khối này ?')) {
            $(this).parents('div.form-group').remove();
        }
        return false;
    });
    // Get detail form
    $('button[name=getDetailForm]').click(function() {
        var typeId = $('select[name=type_id]').val();
        var actionUrl = $(this).attr('data-url');
        $.ajax({
            "url": actionUrl,
            "type": "GET",
            "data": 'type_id='+typeId,
            "async": true,
            "success": function(result) {
                $('div#detailForm').html(result);
                $('select.select-search, select.select-full').select2({
                    width: "100%",
                });
                $(".styled, .multiselect-container input").uniform({
                    radioClass: 'choice',
                    selectAutoWidth: false
                });
                $('form#fContentBlocks input[name=btnCreate]').prop('disabled', false);
            }
        });
    });
    // Create alias
    $('button[name=createAlias]').click(function() {
        var title = $('input[name=title]').val();
        $('input[name=title_alias]').val(toSlug(title));
    });
});
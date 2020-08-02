$(document).ready(function() {
    //=== Setting for articles list table ===//
    var component = $('#usertrackers').attr('component');
    articlesTable = $('#usertrackers.dataTable').DataTable({
    	"aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] },
        ],
    	"oTableTools": {
    		"sRowSelect": "none", // Select single, multi, none
    		"aButtons": [
                {
                    "sExtends":    "text",
                    "sButtonText": "Xóa chọn",
                    "sButtonClass": "btn btn-danger",
                    "fnClick": function() {
                        var chkValue = [];
                        $("#usertrackers .checkthis:checked").each(function() 
                        {
                            chkValue.push($(this).val());
                        });
                        var selected;
                        selected = chkValue.join(',');
                        if (selected == "") {
                            alert("Bạn chưa chọn tin nào để xóa");
                            return false;
                        }else{
                            if (window.confirm('Bạn có chắc muốn xóa các lịch sử đăng nhập có ID = '+ selected))
                            {
                                $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
                                var csrf_test_name = $('#usertrackers').attr('csrf_test_name');
                                var type           = $('#usertrackers').attr('data-table');
                                $.ajax({
                                    'url'       : base_url+'admin/usertrackers/ajax_destroy/',
                                    'type'      : 'post',
                                    'async'     : true,
                                    'dataType'  : 'json',
                                    'data'      : {value:selected,csrf_test_name:csrf_test_name,type:type},
                                    'success'   : function(result){
                                        if (result.status == 200){
                                            $('div#message').html('<div class="callout callout-info fade in"><h5>Hoàn thành</h5><p>Thao tác thành công. Vui lòng chờ 3s đồng bộ dữ liệu</p></div>');
                                            setInterval(function()
                                            {
                                                window.location = base_url+'admin/'+type;
                                            }, 3000);
                                            
                                        };
                                    }
                                })
                                return false;
                            }
                        }
                        //window.location = base_url+'admin/articles/create';
                    }
                },
            ]
    	}
    });
    
    //=== Deleting for one investor ===//
    $('#usertrackers tbody').on('click', '.table-controls a.data-delete', function() {
        thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        var csrf_test_name = thisRow.attr('csrf_test_name');
        if (window.confirm('Bạn có chắc muốn xóa bài viết có ID = '+id)) {
            $('div#message').html('<div class="text-center block-inner text-info text-semibold"><i class="icon-spinner7 spin"></i> Đang xóa</div>');
            $.ajax({
                'url'       : base_url+'admin/articles/destroy/' +id,
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
    
    $("#usertrackers #checkall").click(function () {
        if ($("#articles #checkall").is(':checked')) {
            $("#articles input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        }else {
            $("#articles input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    //===== Bootstrap switches =====// 
});
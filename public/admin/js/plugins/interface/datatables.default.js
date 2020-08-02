$.extend( $.fn.dataTable.defaults, {
    "bJQueryUI": false,
	"bAutoWidth": false,
    "pageLength": 50,
	"sPaginationType": "full_numbers",
    "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Tất cả"]],
	"sDom": '<"datatable-header"Tfl><"datatable-scroll"t><"datatable-footer"ip>',
    "language": {
		"sEmptyTable": "Chưa có dữ liệu",
        "sInfo": "Hiển thị từ _START_ đến _END_ / tổng số _TOTAL_ dữ liệu",
        "sInfoEmpty": "",
        "sSearch": "<span>Lọc:</span> _INPUT_",
		"sLengthMenu": "<span>Hiển thị:</span> _MENU_",
		"oPaginate": { "sFirst": "Đầu", "sLast": "Cuối", "sNext": ">", "sPrevious": "<" },
        "sZeroRecords": "Không có dữ liệu trùng khớp"
	}
} );
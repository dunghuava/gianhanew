$(function() {
	$.ajax({
		url: DIR_ROOT + 'getUserInfo.html',
		type: 'GET',
		data: 'handuser='+$('input#handuser').val(),
		dataType: 'json',
	})
	.done(function(data){
		if (data != null)
		{
			$("span.points").html('<strong>' + data.points + ' điểm </strong>');
			$("span.pointed").html('<strong>' + (30 - data.points) + ' điểm </strong>');
			$("#txtByName").val(data.display_name);
			$("#username").val(data.username);
			$("#txtByEmail").val(data.email);
			$("#txtByMobile").val(data.mobile);
			$("#txtByAddress").val(data.address);
		}
	})
	.fail(function() {
		console.log("Đã có lỗi xảy ra");
	});
});
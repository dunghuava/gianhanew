$(document).ready(function() {
	$('select').select2({
		matcher: function (params, data) {
			if ($.trim(params.term) === '') {
				return data;
			}
			var _keyword = UnicodeToKoDau(data.text.toLowerCase());
			var _text = UnicodeToKoDau(params.term.toLowerCase());
			if (_keyword.indexOf(_text) == 0) {
				var modifiedData = $.extend({}, data, true);
				modifiedData.text;
				return modifiedData;
			}
			return null;
		}
	});
	$("#txttungay").datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		yearRange: 'c-40:c+30'
	});
	$("#txtdenngay").datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		yearRange: 'c-40:c+30'
	});
	if ($('.realUp').length > 0)
		$('.realUp').bt(
		{
			trigger: 'hover',
			positions: 'left',
			width: '170px',
			fill: '#ffff99',
			showTip: function (box) {
				$(box).show();
			}
		});
	if ($('.rePost').length > 0)
		$('.rePost').bt(
		{
			trigger: 'hover',
			positions: 'left',
			width: '170px',
			fill: '#ffff99',
			showTip: function (box) {
				$(box).show();
			}
		});
     if ($('.notRealUp').length > 0)
		$('.notRealUp').bt({
			trigger: 'hover',
			positions: 'left',
			width: '170px',
			fill: '#ffff99',
			showTip: function (box) {
				$(box).show();
			}
		});
});
function DeleteNews() {
	if (confirm('Bạn có chắc chắn muốn xoá tin này ?')) {
		return true;
	}
	return false;
}

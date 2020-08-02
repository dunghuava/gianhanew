function _ResetEndDate() {
	try {
		if ($('#txtStartDate').val().length == 0) {
			$('#txtStartDate').val(UTCDateTimeToVNDateTime(new Date(), '/'));
		}
		if ($('#txtEndDate').val().length == 0) {
			var tmpdate = new Date();
			tmpdate.setMonth(tmpdate.getMonth() + 1);
			$('#txtEndDate').val(UTCDateTimeToVNDateTime(tmpdate, '/'));
		}
		var sDate = new Date(VNDateTimeToUTCDateTime($('#txtStartDate').val(), '/'));
		var eDate = new Date(VNDateTimeToUTCDateTime($('#txtEndDate').val(), '/'));
		var newMaxDate = new Date(sDate);
		var newMinDate = new Date(sDate);
		newMaxDate.setMonth(newMaxDate.getMonth() + 6);
		var newMaxStartDate = new Date(eDate);
		if (newMaxStartDate < new Date()) {
			newMaxStartDate = new Date();
			eDate = newMinDate;
			$('#txtEndDate').val(UTCDateTimeToVNDateTime(eDate, '/'));
		}
		$("#txtEndDate").datepicker("option", "maxDate", newMaxDate);
		$("#txtEndDate").datepicker("option", "minDate", newMinDate);
		$("#txtStartDate").datepicker("option", "maxDate", newMaxStartDate);

	} catch (ex) {

	}
}
function _showDistricts(provinceID)
{
	var selected = $("#hddDistrict").val();
	if (provinceID != -1){
		actionUrl = 'default/ajax/ajaxShowDistricts';
		$.ajax({
			url: DIR_ROOT + actionUrl,
			data:'provinceID='+provinceID,
			type: 'POST',
			dataType: 'json',
			timeout:3000,
			async : true
		})
		.done(function(t){
			$("select#sltDistrict").html('');
			$("select#sltDistrict").append('<option value="-1">Quận/huyện</option>');
			$("select#sltWard").html('');
			$("select#sltStreet").html('');
			$("select#sltProject").html('');
			$.each(t, function(n, t)
			{
				$("select#sltDistrict").append('<option value="'+t.district_id+'" rel="'+t.pre+'">'+ t.name +'</option>');
			});
			$("#sltDistrict").select2('val',selected);
		})
		.fail(function(t) {
			console.log(data.responseText);
		});
	}
}
// Ward
function _showWard(districtId)
{
	var selected = $("#hddWard").val();
	if (districtId != 1) {
		actionUrl = 'default/ajax/ajaxShowWard';
		$.ajax({
			url: DIR_ROOT + actionUrl,
			type: 'POST',
			data: 'districtID=' + districtId,
			dataType: 'json',
			async: true,
		})
		.done(function(r){
			$("select#sltWard").html('');
			$("select#sltWard").append('<option value="-1">Phường/xã</option>');
			$.each(r, function(i, v)
			{
				$("select#sltWard").append('<option value="'+ v.war_id+'" rel='+v.pre+'>' + v.name + '</option>');
			});
			$("#sltWard").select2('val',selected);
		})
		.fail(function(r) {
			console.log(r.responseText);
		});
		return false;
	};
}
function _showStreet(districtId)
{
	var selected = $("#hddStreet").val();
	if (districtId != 1) {
		actionUrl = 'default/ajax/ajaxShowStreet';
		$.ajax({
			url: DIR_ROOT + actionUrl,
			type: 'POST',
			data: 'districtID=' + districtId,
			dataType: 'json',
			async: true,
			//timeout:3000
		})
		.done(function(r) {
			$("select#sltStreet").html('');
			$("select#sltStreet").append('<option value="-1">Đường/phố</option>');
			$.each(r, function(i, t)
			{
				$("select#sltStreet").append('<option value="'+t.street_id+'" rel="'+t.pre+'">'+ t.name + '</option>');
			});
			$("#sltStreet").select2('val',selected);
		})
		.fail(function(r) {
			console.log(r.responseText);
		});
		return false;
	};
}
//Show Projects
function _showProject(districtId)
{
    var selected = $('#hddProject').val();
	if (districtId != 1) {
		actionUrl = 'default/ajax/ajaxShowProject';
		$.ajax({
			url: DIR_ROOT + actionUrl,
			type: 'POST',
			data:'districtID=' + districtId,
			dataType: 'json',
			async: true,
		})
		.done(function(data)
		{
			var textContent = '<option value="-1">Dự án</option>';
			$("select#sltProject").html('');
			$.each(data, function(index, project)
			{
				textContent += '<option value="'+project.project_id+'">'+ project.project_name + '</option>';
			});
			$("select#sltProject").append(textContent);
            selected != 0 ? $("select#sltProject").val(selected).change() : '';
		})
		.fail(function(data) {
			console.log(data.responseText);
		});
		return false;
	};
}
function _showProductType(type_id)
{
	var selectedCate = $("#hddProductCate").val();
	var selectedPriceType = $("#hddPriceType").val();
	if (type_id != -1){
		actionUrl = 'default/ajax/ajaxshowcate',
		$.ajax({
			url : DIR_ROOT + actionUrl,
			type: 'POST',
			data: 'type_id=' + type_id,
			dataType: 'json',
			async: true,
		})
		.done(function(r)
		{
		    $("select#sltProductCate").html('');
            $("select#sltPriceType").html('')
			$("select#sltProductCate").select2({
				placeholder: 'Chọn danh mục'
			});
			$.each(r.cate, function(i, t) {
				$("select#sltProductCate").append('<option value="'+t.id+'">'+ t.title + '</option>');
			});
			(selectedCate != '-1' && selectedCate != 0) ? $("select#sltProductCate").select2('val',selectedCate) : '';
			$("select#sltPriceType").select2({
				placeholder: 'Chọn đơn vị giá'
			});
			$("select#sltPriceType").append('<option value="0">Thỏa thuận</option>');
			$.each(r.units, function(index, unit) {
				$("select#sltPriceType").append('<option value="'+ unit.id+'">'+ unit.unit_name + '</option>');
			});
			(selectedPriceType != '-1' && selectedPriceType != 0) ? $("select#sltPriceType").select2('val',selectedPriceType) : '';
			//$("select#sltPriceType").append(textUnit);
		})
		.fail(function(data) {
			console.log(data);
		});
	}
}
function LoadAutoAddress() {
	if ($('#sltCity').val() == '' || $('#sltDistrict').val() == '') {
		$('#txtAddress').val('Việt nam');
		return;
	}
	var arrAdd = [];
	arrAdd.unshift($('#sltCity option:selected').text());
	if ($('select#sltDistrict').val() != '' && $('select#sltDistrict').val() != '-1' )
	{
		var selectedOpt = $('#sltDistrict option:selected');
		var districtName = selectedOpt.attr('rel');
		if ((districtName != '') && (typeof districtName != 'undefined'))
			districtName = districtName + ' ' + selectedOpt.text()
		else
			districtName = selectedOpt.text();
		if (districtName != '') {arrAdd.unshift(districtName)};
	}
	if (($('#sltWard').val() != '') && ($('#sltWard').val() != '-1')){
		var selectedOpt = $('#sltWard option:selected');
		var wardName = selectedOpt.attr('rel');
		if ((wardName != '') && (typeof wardName != 'undefined')) wardName = wardName + ' ' + selectedOpt.text();
		else wardName = selectedOpt.text();
		if ((wardName != '')) {arrAdd.unshift(wardName);};
		
	}
	if ($('#sltStreet').val() != '' && $('#sltStreet').val() != '-1')
	{
		var selectedOpt = $('#sltStreet option:selected');
		var streetName = selectedOpt.attr('rel');
		if ((streetName != '') && (typeof streetName != 'undefined')) streetName = streetName + ' ' + selectedOpt.text();
		else streetName = selectedOpt.text();
		if (streetName != '') {arrAdd.unshift(streetName);};
	}
	$('#txtAddress').val(arrAdd.join(', ') + ', Việt Nam');
}

$(document).ready(function()
{
	if ($("#sltProductType") != '-1'){
		_showProductType($("#sltProductType").val());
	};
	_showDistricts($('select#sltCity').val());
	_showWard($('select#sltDistrict').val());
	_showStreet($('select#sltDistrict').val());
	_showProject($('select#sltDistrict').val());

	// sltCity
	$('select#sltCity').change(function(event)
	{
        $("select#sltDistrict").select2({
				placeholder: 'Quận/huyện'
	    });
        $('select#sltWard').select2({
            placeholder: 'Phường/xã'
        });
        $('select#sltStreet').select2({
            placeholder: 'Đường/phố'
        });
		event.preventDefault();
		_showDistricts($('select#sltCity').val());
		($("select#sltDistrict").val() != '-1') ? LoadAutoAddress() :'';
		$(this).parent().find('.errorMessage').text().length > 0 ? $(this).parent().find('.errorMessage').hide() : '';
	});
	// sltDistrict
	$('select#sltDistrict').change(function(event)
	{
		event.preventDefault();
		$("select#sltWard").select2('val', '');
		$("select#sltStreet").select2('val', '');
		_showWard($('select#sltDistrict').val());
		_showStreet($('select#sltDistrict').val());
		_showProject($('select#sltDistrict').val());
		($("select#sltDistrict").val() != '-1' && $("select#sltDistrict").val() != "") ? LoadAutoAddress() : '';
		$(this).parent().find('.errorMessage').text().length > 0 ? $(this).parent().find('.errorMessage').hide() : '';
	});
	//sltWard
	$('select#sltWard').change(function()
	{
		LoadAutoAddress();
	});
	$('select#sltStreet').change(function() {
		LoadAutoAddress();
	});
	// sltProductType
	$('select#sltProductType').change(function(){
		_showProductType($('select#sltProductType').val());

		$(this).parent().find('.errorMessage').text().length > 0 ? $(this).parent().find('.errorMessage').hide() : '';
	});
	$("#sltProductCate").change(function(event) {
		$(this).parent().find('.errorMessage').text().length > 0 ? $(this).parent().find('.errorMessage').hide() : '';
	});
	$("#txtStartDate").datepicker({
		dateFormat: 'dd/mm/yy',
		minDate: new Date()
	});
	$("#txtStartDate").change(function () {
		_ResetEndDate();
	});

	$("#txtStartDate").keydown(function (event) {
		event.preventDefault();
	});
	$("#txtEndDate").datepicker({
		dateFormat: 'dd/mm/yy'
	});
	$("#txtEndDate").change(function () {
		_ResetEndDate();
	});

	$("#txtEndDate").keydown(function (event) {
		event.preventDefault();
	});
	$("#txtEndDate").click(function (event) {
		if ($(this).attr('disabled') == 'true')
			event.preventDefault();
	});
	$('#sltPriceType').change(function () {
		$('#txtPrice').next().html('');
		console.log($('#txtPrice').next());
		if ($(this).val() == '0' || $(this).val() == -1) {
			$('#txtPrice').val('');
			$('#txtPrice').next().hide();
		} else if ($('#txtPrice').val().length == 0) {
			$('#txtPrice').next().html('Bạn cần nhập giá').show();
		}

	});
});
function showMessage(element, msg) {
	if ($(element).parent().find('.errorMessage').length > 0) {
		$(element).parent().find('.errorMessage').html(msg);
		$(element).parent().find('.errorMessage').show();
	}
}
function hideMessage(element) {
	if ($(element).parent().find('.errorMessage').length > 0) {
		$(element).parent().find('.errorMessage').hide();
	}
}

var focused = false;
function setFocus(element) {
	if (focused == false) {
		focused = true;
		$(element).focus();
	}
}
function SubmitForm()
{
	var error = false;
	focused = false;
	$('select').each(function () {
		hideMessage(this);
		if ($(this).hasClass('required') == true) {
			console.log($(this).val());
			if ($(this).val() == null || $(this).val() == '-1') {
				showMessage(this, 'Vui lòng chọn thông tin');
				error = true;
				setFocus(this);
				return;
			}
		}

	});
	$('input[type=text]').each(function () {
		hideMessage(this);
		if ($(this).hasClass('required') == true) {
			if ($(this).val().trim().length == 0) {
				showMessage(this, 'Vui lòng nhập thông tin !');
				error = true;
				setFocus(this);
				return;
			}
		}
		if ($(this).attr('maxlength') != undefined) {
			var maxlength = parseInt($(this).attr('maxlength'));
			if (maxlength < $(this).val().length) {
				showMessage(this, 'Số ký tự phải nhỏ hơn ' + maxlength);
				error = true;
				setFocus(this);
				return;
			}
		}
		if ($(this).attr('numberonly') != undefined && $(this).val() != "" && !($(this).is(':hidden'))) {
			var reg = /^\d+$/;
            // integer
            if ($(this).attr('numberonly') == '1' && !reg.test($(this).val())) {
            	showMessage(this, "Bạn cần nhập số.");
            	error = true;
            	setFocus(this);
            	return;
            }
            // double or float
            if ($(this).attr('numberonly') == '2' && (isNaN($(this).val()) || !parseFloat($(this).val()) > 0)) {
            	showMessage(this, "Bạn cần nhập số.");
            	error = true;
            	setFocus(this);
            	return;
            }
        }

	});
	// Input
	$('textarea').each(function () {
		hideMessage(this);
		if ($(this).val().indexOf('>') >= 0 || $(this).val().indexOf('<') >= 0) {
			showMessage(this, 'Bạn không thể nhập vào ký tự &gt; hoặc &lt;');
			error = true;
			setFocus(this);
			return;
		}

		if ($(this).hasClass('required') == true) {
			if ($(this).val().trim() == '') {
				showMessage(this, 'Vui lòng nhập thông tin !');
				error = true;
				setFocus(this);
				return;
			}
		}

		if ($(this).attr('maxlength') != undefined) {
			var maxlength = parseInt($(this).attr('maxlength'));
			if (maxlength < $(this).val().length) {
				showMessage(this, 'Số ký tự cần nhỏ hơn ' + maxlength);
				error = true;
				setFocus(this);
				return;
			}
		}

		if ($(this).attr('minlength') != undefined) {
			var minlength = parseInt($(this).attr('minlength'));
			if (minlength > $(this).val().length) {
				showMessage(this, 'Số ký tự cần lớn hơn ' + minlength);
				error = true;
				setFocus(this);
				return;
			}
		}

		if ($(this).attr('minword') != undefined) {
			var minword = parseInt($(this).attr('minword'));
			if (minword > wordCount($(this).val())) {
				showMessage(this, 'Số ký từ nhỏ hơn ' + minword);
				error = true;
				setFocus(this);
				return;
			}
		}

		if ($(this).attr('maxword') != undefined) {
			var maxword = parseInt($(this).attr('maxword'));
			if (maxword < wordCount($(this).val())) {
				showMessage(this, 'Số ký từ lớn hơn ' + maxword);
				error = true;
				setFocus(this);
				return;
			}
		}
	});
    var response = grecaptcha.getResponse();
    if(response.length == 0)
    {
        error = true;
        $('#recaptcha-error').show();
    }
	// SELECT
	return error == false;
}
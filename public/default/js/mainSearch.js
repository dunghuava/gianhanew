$(document).ready(function() {
	ChangeType('1');
	LoadCity();
	$('select#province').change(function(){
		LoadDistrict($(this).val());
	});
	$('select#district_id').change(function() {
		/* Act on the event */
		LoadStreet($(this).val());
		LoadWard($(this).val());
	});
	$("input#loaibds").change(function() {
		if( $(this).is(":checked") ){
            loadcate($(this).val());
        }
	});
});
function _Search(){
	var cate = $("#chuyenmuc").val();
	var slugtinh = $("#province option:selected").attr('rel');
	var province = $("#province option:selected").attr('slug');
	var district = $("#district_id option:selected").attr('rel');
	var ward = $("#ward_id").val();
	var street = $("#street_id").val();
	var url = "";
	var params = "";
	var direct = $('.small-item-s select[name=direct]').val();
    var area = $('.small-item-s select[name=area]').val();
    var price = $('.small-item-s select[name=price]').val();
    var unit = $('.small-item-s select[name=unit]').val();
    if (cate != 0){
		url += cate;
	}else{
		alert('Vui lòng chọn loại nhà đất !');
		return false;
	}
	if (slugtinh != 0){
		if (district == 0){
			url += '/' + slugtinh;
			params += "?";
		}
		else{
			url += '/'+province +'/'+ district + "?ward="+ ward +"&street=" + street;
		}
	}else{
		params += "?";
	}
    if (area == 0 && price == 0 && direct == 0 && unit == 0){
        params = "";
    }
    else{
    	if (district != 0)
        	params += "&direct=" + direct + "&price=" + price +"&area=" + area + "&unit="+ unit;
        else
        	params += "direct=" + direct + "&price=" + price +"&area=" + area + "&unit="+ unit;
    }
    window.parent.location = url+ params;
}
function ChangeType(type_id){
	$("select#chuyenmuc").html('').select2("val",'0');
    $("select[name=unit]").html('').select2("val",'0');
	$.ajax({
		url     : DIR_ROOT + 'default/ajax/ajaxshowcate',
		type    : 'POST',
		dataType: 'json',
		data    : {type_id: type_id},
	}).done(function(data) {
        $("select#chuyenmuc").html('<option value="0" rel="0">--Chọn loại nhà đất--</option>').select2("val",'0');
        $("select[name=unit]").html('<option value="0" rel="0">--Chọn đơn vị--</option>').select2("val",'0');
		$.each(data.cate, function(i, t){
			$("select#chuyenmuc").append('<option value="'+ toSlug(t.title) + '">+ '+ t.title + '</option>');
		});
        $.each(data.units, function(i, u){
			$("select[name=unit]").append('<option value="'+ toSlug(u.id) + '">'+ u.unit_name + '</option>');
		});
	});
}
function LoadCity(){
	actionUrl = 'default/ajax/ajaxShowProvinces';
	$.ajax({
		url : DIR_ROOT + actionUrl,
		type: 'GET',
		dataType: 'json',
		async: true,
	}).done(function(data){
		$("select#district_id").html('<option value="0" rel="0">-- Quận/huyện --</option>').select2("val","0");
		$.each(data, function(i, t){
			$("select#province").append('<option value="'+t.province_id+'" rel="'+toSlug(t.name)+'-tp'+toPublicId(t.province_id)+'.htm" slug="'+toSlug(t.name)+'">+ '+ t.name + '</option>');
		});
	}).fail(function(data) {
		alert('Lỗi');
	});
	return false;
}
function LoadDistrict(province_id){
	if (province_id != 0){
		actionUrl = 'default/ajax/ajaxShowDistricts';
		$.ajax({
			url: DIR_ROOT + actionUrl,
			data:'provinceID=' + province_id,
			type: 'POST',
			dataType: 'json',
			timeout:3000,
			async : true
		}).done(function(data)
		{
			$("select#district_id").html('');
			$("select#district_id").html('<option value="0" rel="0">-- Quận/huyện --</option>').select2("val","0");
			$.each(data, function(n, t)
			{
				$("select#district_id").append('<option value="'+t.district_id+'" rel="'+toSlug(t.name)+'.htm">+ '+ t.name +'</option>');
			});
		}).fail(function(data){
			console.log(data.responseText);
		});
		return false;
	}
}
function LoadStreet(district_id){
	if (district_id != 1){
		actionUrl = 'default/ajax/ajaxShowStreet';
		$.ajax({
			url: DIR_ROOT + actionUrl,
			type: 'POST',
			data: 'districtID=' + district_id,
			dataType: 'json',
			async: true
		}).done(function(data) {
			console.log(data);
			$("select#street_id").html('');
			$("select#street_id").append('<option value="0">Đường/phố</option>').select2("val","0");
			$.each(data, function(i, t)
			{
				$("select#street_id").append('<option value="'+t.street_id+'" rel="'+toSlug(t.name)+'">+ '+ t.name + '</option>');
			});
		}).fail(function(data) {
			console.log(data.responseText);
		});
		return false;
	};
}
function LoadWard(district_id){
	if (district_id != 1) {
		actionUrl = 'default/ajax/ajaxShowWard';
		$.ajax({
			url: DIR_ROOT + actionUrl,
			type: 'POST',
			data: 'districtID=' + district_id,
			dataType: 'json',
			async: true,
		}).done(function(r){
			$("select#ward_id").html('');
			$("select#ward_id").append('<option value="0">Phường/xã</option>').select2("val","0");
			$.each(r, function(i, v)
			{
				$("select#ward_id").append('<option value="'+ v.war_id+'" rel='+v.pre+'>+ ' + v.name + '</option>');
			});
		}).fail(function(r) {
			console.log(r.responseText);
		});
		return false;
	};
}
function toSlug(slug) {
    slug = slug.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

    slug = slug.replace(/ /gi, "-");

    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}
function toPublicId(id){return id * 19872005 + 20051987;}
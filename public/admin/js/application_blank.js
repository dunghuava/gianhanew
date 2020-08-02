$(document).ready(function() {
	previewImage = $('#previewImage');
    inputImage = $("input#image");
    inputImage.on('change',function(e){
    	var file = e.target.files[0];
    	var reader = new FileReader();
    	reader.addEventListener("load", function () {
    		previewImage.html('<img src="'+reader.result+'" class="img-resposnive center-block" />');
    		console.log(previewImage);
    	}, false);
    	if (file) {
    		reader.readAsDataURL(file);
    	}
    });
    productImagesContainer = $('.product-images');
    inputGallery = $("input#gallery");
    var fileCollection = new Array();
    inputGallery.on('change',function(e){
        var files = e.target.files;
        $.each(files, function(i, file){
            fileCollection.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e){
                var template =  '<div class="product-img">'+
                '<input type="hidden" name="image[]" value="'+file.name+'">'+
                '<img src="'+ e.target.result +'" />'+
                '<a href="#" class="btn btn-icon btn-xs btn-danger remove">'+
                '<i class="icon-remove"></i></a>'+
                '</div>';
                productImagesContainer.append(template);
            };
        });
    });
    productImagesContainer.on('click', '.remove', function(e) {
        e.preventDefault();
        var removed = $(this).parent('.product-img').find('input[name=image]').val();
        var index;
        fileCollection.some(function(entry, i) {
            if (entry.name == removed) {
                index = i;
                fileCollection.splice(i,1)
            }
        });
        $(this).parent('.product-img').fadeOut('100', function(){
            $(this).remove();
        });
    });
});

var formElements = function(){
     //Bootstrap select
    var feSelect = function(){
        if($(".select-multiple").length > 0){
            $(".select-multiple").select2();
        }
    }
    var feTag = function(){
        $('.attributes').tagsInput({
            width: '100%',
            defaultText: 'Thêm giá trị'
        });
    }
    //END Bootstrap select
    return {
        init: function(){
            feSelect();
            feTag();
        }
    }
}();
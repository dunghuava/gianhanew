function _showLocation(input){
	var in_latitude;
	var in_longitude;
	var map;
	var marker;
	var geocoder = new google.maps.Geocoder();
	var infowindow = new google.maps.InfoWindow();
	
	var input = document.getElementById('txtAddress');
	var options = {
		types: ['address']
	};
	new google.maps.places.Autocomplete(input, options);
	
	var address= $('input#txtAddress').val();
	geocoder.geocode({'address': address }, function(results,status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var latitude = results[0].geometry.location.lat();
			var longitude = results[0].geometry.location.lng();
			$('#lat').val(latitude);
			$('#lng').val(longitude);

			var myLatlng = new google.maps.LatLng(latitude,longitude);
			var mapOptions = {
				zoom: 17,
				center: myLatlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("map-info"),mapOptions);
			marker = new google.maps.Marker({
				map: map,
				position: myLatlng,
				draggable: true 
			});     

			geocoder.geocode({'latLng': myLatlng }, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						$('input#txtAddress').val(results[0].formatted_address);
						$('#latitude').val(marker.getPosition().lat());
						$('#longitude').val(marker.getPosition().lng());
						infowindow.setContent(results[0].formatted_address);
						infowindow.open(map, marker);
					}
				}
			});
			google.maps.event.addListener(marker, 'dragend', function() {
				geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						if (results[0]) {
							$('input#txtAddress').val(results[0].formatted_address);
							$('#latitude').val(marker.getPosition().lat());
							$('#longitude').val(marker.getPosition().lng());
							infowindow.setContent(results[0].formatted_address);
							infowindow.open(map, marker);
						}
					}
				});
			});

		}
	});
}
$(document).ready(function() {
	$("div#map-info").load(_showLocation());
});
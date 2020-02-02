function initMap() {
	var start = {lat: 64.142565, lng: -21.927809};
	var finish = {lat: 64.128852, lng: -21.917114};

	var map = new google.maps.Map(document.getElementById('map'), {
		center: start,
		scrollwheel: true,
		zoom: 10
	});

	var directionsDisplay = new google.maps.DirectionsRenderer({
		map: map
	});

	// Set destination, origin and travel mode.
	var request = {
		destination: finish,
		origin: start,
		travelMode: 'DRIVING'
	};

	// Pass the directions request to the directions service.
	var directionsService = new google.maps.DirectionsService();
	directionsService.route(request, function(response, status) {
		if (status == 'OK') {
			// Display the route on the map.
			directionsDisplay.setDirections(response);
		}
	});
}
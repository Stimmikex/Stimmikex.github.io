/*
	NOTE!
	This does not work in Chrome 50+ without HTTPS
*/

function geolocation() {
	if ("geolocation" in navigator) {
		/* geolocation is available */
		navigator.geolocation.getCurrentPosition(function(position) {
			geolocationTest(position.coords.latitude, position.coords.longitude);
		});
	} else {
		/* geolocation is NOT available */
		console.error("geolocation is not available");
	}
}

/* Convert degrees to radians */
function degToRad(deg) {
	return deg * (Math.PI / 180);
}

/* Calculates the distance between two points in km */
/* https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula */
function calculateDistanceKm(lat1, long1, lat2, long2) {
	var R = 6371;
	var dLat = degToRad(lat2 - lat1);
	var dLong = degToRad(long2 - long1);
	var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(degToRad(lat1)) * Math.cos(degToRad(lat2)) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	var d = R * c;

	return d;
}

function geolocationTest(lat, long) {
	var targetLat = 64.142556;
	var targetLong = -21.927823;
	var dist = calculateDistanceKm(targetLat, targetLong, lat, long);

	$('#geotest').html('Distance: ' + Math.round(dist * 1000) + 'm');
}
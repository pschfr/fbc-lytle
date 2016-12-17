// Initiate Google Maps
function initMap() {
	var church = {lat: 29.241, lng: -98.805};
	var map = new google.maps.Map(document.getElementById('google-map'), {
		zoom: 9,
		center: church,
		disableDefaultUI: true
	});
	var infowindow = new google.maps.InfoWindow({
		content: '18627 N Prairie St,<br/>PO Box 428<br/>Lytle, TX 78052<br/><a href="https://goo.gl/maps/NZE8DMKZq4K2" target="_blank" rel="noreferrer noopener">Get Directions &rsaquo;</a>'
	});
	var marker = new google.maps.Marker({
		position: church,
		map: map
	});
	infowindow.open(map, marker);
}
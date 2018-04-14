<style>

#map {max-width: 100%;height: 500px;width: 100%;}

</style>

<section class="map-section">

    <div>

        <div class="map">

            <div>

            	<form class="form-inline map-search mt-2 mt-md-0 ml-auto">

                	<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">

                	<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>

            	</form>

            </div>

            <div class="map" id="map"></div>

        </div>

    </div>

</section>

<script>

	 //var uluru = {lat: 22.2900453, lng: 70.76154559999999};

	var apiGeolocationSuccess = function(position) {
		
		//navigator.geolocation.getCurrentPosition(showPosition);
		//alert('latitude:'+position.coords.latitude+'longitude:'+position.coords.longitude);
		uluru = {lat:position.coords.latitude,lng: position.coords.longitude};
		initMap(uluru);
	};
	
	
	var tryAPIGeolocation = function() {
		
		$.ajax({

			type:"POST",
			data: '',
			url:"https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCFhf8FNMCoFr_qwGm4NbHXSAPpoKLMEbo",

			success: function(success){
				console.log(success.location);
				apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
			}

		});

	

	};

	

	var browserGeolocationSuccess = function(position) {
		alert("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);

	};

	

	var browserGeolocationFail = function(error) {
		switch (error.code) {
			case error.TIMEOUT:
				alert("Browser geolocation error !\n\nTimeout.");

				break;

			case error.PERMISSION_DENIED:
				if(error.message.indexOf("Only secure origins are allowed") == 0) {

				tryAPIGeolocation();

				}

				break;

			case error.POSITION_UNAVAILABLE:

				alert("Browser geolocation error !\n\nPosition unavailable.");

				break;

		}

	};

	

	var tryGeolocation = function() {
		if (navigator.geolocation) {
				
			navigator.geolocation.getCurrentPosition(
				
				browserGeolocationSuccess,

				browserGeolocationFail,

				{maximumAge: 50000, timeout: 20000, enableHighAccuracy: true}

			);

		}

	};

	

	tryGeolocation();

	

	function initMap(uluru) {

		

		var map = new google.maps.Map(document.getElementById('map'), {

			zoom: 18,

			center: uluru,

			disableDefaultUI: false

		});

		var marker = new google.maps.Marker({

			position: uluru,

			map: map

		});

	}

</script>

<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxPeZYRmWANqIRSxF5NrGDz7lzuAKEt1U&callback=initMap" type="text/javascript"></script>
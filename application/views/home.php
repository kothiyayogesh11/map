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

	
	/*function as() {
		$.ajax({
			type:"POST",
			url:"https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyAQhjZJdFsW3c5C5fpQF8sfUNh-V3_eULg",
			success: function(success){
				console.log(success);
				$('input[type="text"]').val(success.location.lat+' '+success.location.lng);
				
			}
		});
	
	}
	
	as();*/
	
		
		var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
		alert('The Geolocation service failed.');
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
	  
	
</script>
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeahMII3bDG7HujYeyfrQT8uEhI5cq_ZU&callback=initMap" type="text/javascript"></script>
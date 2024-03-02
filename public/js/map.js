

	 function initMapParams(location, location_latlong, mapdiv) {
			 var input = document.getElementById(location);
			 var field = document.getElementById(location_latlong);
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(28.6172, 77.2081);
			var map = new google.maps.Map(document.getElementById(mapdiv), {
			  center: latlng,
			  zoom: 13
			});
			 
			showMap(input, field, map);
	 }
	 
      function initMap() {
		 var input = document.getElementById("location");
		 var field = document.getElementById("location_latlong");
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(28.6172, 77.2081);
        var map = new google.maps.Map(document.getElementById("map_location"), {
          center: latlng,
          zoom: 13
        });
		 showMap(input, field, map);
	  }
	  
	  function showMap(input, field, map){
		
		var options = {
			types: ['geocode'],
			componentRestrictions: {country: 'IN'},
		};
		
		google.maps.event.addListener(map, 'click', function(event) {
			geocoder.geocode({'location': event.latLng}, function(results, status) {
				input.value = results[0].formatted_address;
				field.value = event.latLng;
				marker.setPosition(event.latLng);
				marker.setVisible(true);
			});
			
		});

		
        var autocomplete = new google.maps.places.Autocomplete(input, options);
		 autocomplete.bindTo('bounds', map);
		 var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
		
		google.maps.event.addListener(marker, 'click', function() {			
			marker.setVisible(false);
		});
		

		 autocomplete.addListener('place_changed', function() {
         // infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
		  field.value = place.geometry.location;
        });
		  // Call the codeAddress function (once) when the map is idle (ready)
		google.maps.event.addListenerOnce(map, 'idle', function() {
			// Define address to center map to
			var address = input.value;
			geocoder.geocode({
				'address': address
			}, function (results, status) {
        
				if (status == google.maps.GeocoderStatus.OK) {
            
					// Center map on location
					map.setCenter(results[0].geometry.location);
            
					// Add marker on location
					var marker = new google.maps.Marker({
						map: map,
					position: results[0].geometry.location
					});			
            
				} else {
				}
			});
		});
	  }	 
		
function updateLatlong() {
	var latlong = document.getElementById("location_latlong");
	latlong.value = "";
}	

function initMapMarker(obj, latLongArr) {
	var map = new google.maps.Map(obj, {
		zoom: 13,
		center: new google.maps.LatLng(latLongArr[0][0], latLongArr[0][1])
	});
	for (var i in latLongArr) { 
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(latLongArr[i][0], latLongArr[i][1]),
			map: map
		});
	}						  
}

function initSummaryMap() {
       var latlng = new google.maps.LatLng(21.146633, 79.088860);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: latlng
        });

        for (var i in latlngs) {
                var projectLatlng = new google.maps.LatLng(latlngs[i]['latLng'][0], latlngs[i]['latLng'][1]);
                var marker = new google.maps.Marker({
                  position: projectLatlng,
				  icon: icons[latlngs[i]['type']],
                  map: map,
                  title: latlngs[i]['title']
                });
          
        }
          
          
    }



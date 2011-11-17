	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo GOOGLE_KEY;?>&sensor=false"
	type="text/javascript"></script>
	<script type="text/javascript">
	<?php $stores_result = '';?>
	<?php if(isset($state['stores_result']->stores{4})):?>
		<?php $stores_result = array_chunk($state['stores_result']->stores, 5, TRUE);?>
		<?php $stores_result = $stores_result[0];?>
	<?php elseif(isset($state['stores_result']->stores)):?>
		<?php $stores_result =  $state['stores_result']->stores;?>
	<?php endif;?>
	var map = null;
	var geocoder = null;
	var wines = <?php echo json_encode($state['wines_result']);?>;
	var wine = <?php echo json_encode($state['wine_result']);?>;
	var stores = <?php echo json_encode($stores_result);?>;
	var fb_event = <?php echo json_encode($state['facebook_event']);?>;
	<?php $local_stores_for_wine = (!empty($state['local_stores_for_wine'])) ? $state['local_stores_for_wine'] : "";?>
	var local_store = <?php echo json_encode($local_stores_for_wine);?>;
	var directions;
	function initialize() {
		if (GBrowserIsCompatible()) {
			eventLatLng = new GLatLng(fb_event.venue.latitude, fb_event.venue.longitude);
			eventAddress = fb_event.venue.street.toString()+", "+fb_event.venue.city.toString()+", "+fb_event.venue.state.toString();
			map = new GMap2(document.getElementById("map_canvas"));
			map.setCenter(eventLatLng, 9);
			map.setUIToDefault();
			geocoder = new GClientGeocoder();
			showEvent(eventAddress, eventLatLng, fb_event.name.toString());
			if(local_store.length > 0) {
				showWine(local_store[0].address.toString()+", "+local_store[0].city.toString()+", "+local_store[0].state.toString(), local_store[0].name.toString());
			}
			else if(stores.length > 0) {
				for(i = 0; i<stores.length; i++){
					address = stores[i].address.toString()+", "+stores[i].city.toString()+", ";
					address += stores[i].state.toString();
					msg = stores[i].name.toString()+"<br/>"+stores[i].address.toString()+"<br/>";
					msg += stores[i].city.toString()+", "+stores[i].state.toString();
					showAddress(address, msg);
				}
			}
			else {
			}
		}
	}

	function showWine(address, msg) {
		if (geocoder) {
			geocoder.getLatLng(address,
				function(point) {
					if (!point) { /*alert(address + " not found");*/}
					else {
						var marker = new GMarker(point);
						map.addOverlay(marker);
						temp = address.split(',');
						for(i=0; i<temp.length; i++) {
							if(temp[i].length > 0)
								msg += '<br/>'+temp[i];
						}
						marker.bindInfoWindowHtml(msg);
					}
				}
			);
		}
	}

	function showEvent(address, latlng, msg) {
		// Create our "tiny" marker icon
       		var blueIcon = new GIcon(G_DEFAULT_ICON);
	        blueIcon.image = "http://gmaps-samples.googlecode.com/svn/trunk/markers/blue/blank.png";
		// Set up our GMarkerOptions object
		markerOptions = { icon:blueIcon };
		if (geocoder) {
			geocoder.getLatLng(address,
				function (point) {
					if(!point) {}
					else {latlng = point;
						var temp = new Array();
						temp = address.split(',');
						for(i=0; i<temp.length; i++) {
							if(temp[i].length > 0)
								msg += '<br/>'+temp[i];
						}
					}	

					var marker = new GMarker(latlng, markerOptions);
					map.addOverlay(marker);
					marker.bindInfoWindowHtml(msg);
				}
			);
		}
	}
	function createMarker(point, html) {
		var marker = new GMarker(point);
		GEvent.addListener(marker, "click", function() {
			marker.openInfoWindowHtml(html);
		});
	        return marker;

	}
	function showAddress(address, msg) {
		if (geocoder) {
			geocoder.getLatLng(address, 
				function(point) {
					if(!point) {/*alert(address.toString()+"Not found");*/}
					else {
						var marker = createMarker(point, msg);
						map.addOverlay(marker);
					}
				}
			);
		}
	}
    	</script>

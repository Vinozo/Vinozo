<?php
if(isset($_REQUEST['eid'])) {
	$eid = $_REQUEST['eid'];
	$facebook_event = $state['facebook']->api_client->events_get($state['facebook']->api_client->user,$eid,'','','');
	$fbe = $state['facebook_event'] = isset($facebook_event[0]) ? $facebook_event[0] : array();
		if(isset($_REQUEST['lat']) && isset($_REQUEST['lng'])) {
			$ip = empty($_SERVER['SERVER_ADDR']) ? '0.0.0.0' : $_SERVER['SERVER_ADDR'];
			$snooth = new SnoothAPI(SNOOTH_KEY, $ip, 'json');
			$lat = $_REQUEST['lat'];
			$lng = $_REQUEST['lng'];
			#WINES SEARCH START
			$q = 'wine';
			if(isset($_REQUEST['colorselect'])){
				if($_REQUEST['colorselect'] == 'red') {
					$q = 'red';
				}
				else if($_REQUEST['colorselect'] == 'white') {
					$q = 'white';
				}
			}
			$snooth->set_parameter('q', $q);
			$snooth->set_parameter('n', '5');
			$snooth->set_parameter('lat', $lat);
			$snooth->set_parameter('lng', $lng);
			$snooth->set_parameter('xp', 25);#eventually give this option to the user
			$wines_result = json_decode($snooth->execute('wines'));
			$i = 0; $index=-1;
			#returns false if curl_exec times-out or fails
			if($wines_result) {
				$wines_result = json_decode($snooth->execute('wines'));
			}
			#set current wine to one that has an image
			if(isset($wines_result->wines)){
				foreach($wines_result->wines as $wine) {
					if(isset($index)){}
					else if(!empty($wines->image)) {
						$index = $i;
					}
					$i++;
				}	
				$index = ($index != -1) ? $index : 0;
				$state['wines_result'] = $wines_result->wines{$index};			
			}
			else {
				$state['wines_result'] = 0;
			}
			if(isset($state['wines_result']->code)){
				$code = $state['wines_result']->code;
			}
			else{
				#this means curl_exec failed twice
				$code = 'victor-hugo-petite-sirah';	
			}
			#WINE DETAILS START
			$snooth->reset_parameters();
			$snooth->set_parameter('id', $code);
			$snooth->set_parameter('i', '1');
			$snooth->set_parameter('lat', $lat);
			$snooth->set_parameter('lng', $lng);
			$state['wine_result'] = json_decode($snooth->execute('wine'));
			$wine_stores = isset($state['wine_result']->wines{0}->stores) ? $state['wine_result']->wines{0}->stores : array();
			$state['local_stores_for_wine'] = array();
			foreach($wine_stores as $st) {
				if($st->local == 1) {
					$state['local_stores_for_wine'][] = $st;
				}
			}
			#STORES SEARCH START
			$snooth->reset_parameters();
			$snooth->set_parameter('lat', $lat);
			$snooth->set_parameter('lng', $lng);
			$state['stores_result'] = json_decode($snooth->execute('stores'));
		}
}
?>

<?php

$now = time();
if(isset($state['facebook'])) {
	$facebook=$state['facebook'];
	$state['events'] = $facebook->api_client->events_get($facebook->user,'',$now,'','');
}
?>

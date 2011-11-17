<?php
require_once('config/facebook.conf.php');
require_once('lib/SnoothAPI.lib.php');
require_once('lib/facebook-platform/php/facebook.php');
require_once('functions/facebook.func.php');

$facebook = new Facebook(FACEBOOK_KEY, FACEBOOK_SECRET);
$facebook->require_frame();
$user = $facebook->require_login();
$allowed = $facebook->api_client->fql_query("SELECT allowed_restrictions FROM user WHERE uid=$user");
$state = array('facebook'=>$facebook);
$page='events';
$javascript = null;

if(!empty($allowed[0]['allowed_restrictions'])) {
	if (isset($_REQUEST['page']) && in_array($_REQUEST['page'], $page_array)) {
		$page=$_REQUEST['page'] ;	
		if (in_array($page, $js_array)) {
			$javascript=$page;	
		}
	}
}
else {
	$page='restrict';
	#user must 21 to view the apps content
}
$state = load_data($page,$state);
display_template($page,$state, $javascript);

?>

<?php

function load_data($page, $state) {
	require_once('./loaders/'.$page.'-loader.php');
	return $state;
}

function load_java_scripts($page, $state) {
	require_once('./htdocs/js/'.$page.'.js.php');
}

function display_template($page, $state, $javascript=null) {
	require_once('./htdocs/templates/main-top.template.php');
	if (isset($javascript))load_java_scripts($page, $state);
	require_once('./htdocs/templates/'.$page.'.template.php');
	require_once('./htdocs/templates/main-bottom.template.php');
}
?>

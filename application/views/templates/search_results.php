<ul>
	<?php 
// Show results data if exists
$results = json_decode($data, true);
		
if(!$results){
	echo "Sorry, no wines match.";
	} elseif (array_key_exists('error', $results)){
		echo $results['error'];
	} elseif ($results['meta']['results'] == 'int(0)'){
		echo "Sorry, no wines match. Add to Vinozo links goes here";
	} else {
		//var_dump($results['meta']['results']);
		foreach($results['wines'] as $wine){
			echo "<li class=\"ui-li-has-thumb ui-btn ui-btn-up-c ui-btn-icon-right ui-li ui-li-has-alt\" data-theme=\"b\">";
			echo "<img class=\"ui-li-thumb\" src=".$wine['image'].">";
			echo "<div class='wineinfolist'>";
			echo "<h3 class=\"ui-li-heading\">".$wine['name']."</h3><p class=\"ui-li-desc\"> winery:".$wine['winery']." <a href=\"/wine/details/".$wine['code']."\">Check In</a></p>";
			echo "</div>";
			echo "</li>";
	}
}
?>
</ul>
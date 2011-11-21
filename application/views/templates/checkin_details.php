<ul>
	<?php 
// Show results data if exists
$results = json_decode($data, true);
		
if(!$results){
	echo "Sorry, checkin failed.";
	} else {
		echo "We've got you checked in!";
		//var_dump($results);
	}
?>
</ul>
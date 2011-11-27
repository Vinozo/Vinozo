<ul>
	<?php 
// Show results data if exists
$results = json_decode($data, true);
		
if(!$results){
	echo "Sorry, checkin failed.";
	} else {
		echo "We've got you checked in!";
		echo "<a href='/' rel='external'>Go Home</a>";
		//var_dump($results);
		
		// Now call /getcheckinbyuser, method=RequestMethod.GET) @RequestBody VinoUser 
		// return JSON of <“id”,VinoCheckin> (basically an array) LIMIT LATER BY RECENT
		// then call /getcheckinbycheckinid for each?
	}
?>
</ul>
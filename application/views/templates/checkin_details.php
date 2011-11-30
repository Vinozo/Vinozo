<ul>
	<?php 
// Show results data if exists
$results = json_decode($data, true);
		
if(!$results){
	echo "Sorry, checkin failed.";
	
		 echo $this->session->userdata('uid'); 
		 echo $this->session->userdata('ip');
		 var_dump($results);
	} else {
		echo "We've got you checked in!<br />";
		echo "<a href='/' rel='external'>Go Home</a><br />";
		 echo $this->session->userdata('uid'); 
		 echo $this->session->userdata('ip');
		var_dump($results);
		
		// Now call /getcheckinbyuser, method=RequestMethod.GET) @RequestBody VinoUser 
		// return JSON of <“id”,VinoCheckin> (basically an array) LIMIT LATER BY RECENT
		// then call /getcheckinbycheckinid for each?
	}
?>
</ul>
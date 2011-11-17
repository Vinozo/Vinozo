<?php  $this->load->view('templates/header'); ?>
<div data-role="page"> 
 
	<div data-role="header"> 
		<h1>Wine Detail</h1>
		
	</div><!-- /header --> 
	<div data-role="content" > 
		
	<h1></h1>
		
		<?php 
		// fix the return string which is incomplete
		//$winedata = ltrim($data, 's');
		//$winedata = "{".$winedata;
		// Show results data if exists
		
		$wine = json_decode($data);
		
		if(!$wine){
			echo "Sorry, no wines match.";
			} elseif (array_key_exists('error', $wine)){
				echo $wine['error'];
			} elseif ($wine->meta->results == 'int(0)'){
				echo "Sorry, no wines match. Add to Vinozo links goes here";
			} else {
	
			echo "<img class=\"largewinepic\" src=\"".$wine->wines[0]->image."\" border=\"0\" />";
			echo "<h2>".$wine->wines[0]->name."</h2>";
			echo "<i>".$wine->wines[0]->winery."</i><br />";
			echo "<i>".$wine->wines[0]->region."</i><br />";
			echo "<b>".$wine->wines[0]->vintage."</b><br />";
			echo "<i>".$wine->wines[0]->varietal."</i><br />";
			echo "<i>".$wine->wines[0]->type."</i><br />";
			
			echo "<p>".$wine->wines[0]->wm_notes."</p>";
			echo "<a href='/wine/checkin/$id'>Check In</a>";		
				
		}	
	?>
	

	<div id="body">
		<img src="<?php //echo $data['wines'][0]['image'] ?>"/>
		
	</div>
		
	</div>
</div>
<?php  $this->load->view('templates/footer'); ?>
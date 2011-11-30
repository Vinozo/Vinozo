<?php  $this->load->view('templates/header'); ?>

<!-- login page -->
<div data-role="page" id="detailsview"> 
<?php  $this->load->view('utility/checkin_ajax'); ?> 
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
			// echo "<a data-id='".$id."' class='wineCheckin' href='#'>Check In</a>";		
				
		}	
	?>
	<form action="#"  method="post" id="checkinform">
			<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
			rating:<input type="text" name="rating" id="rating">
			note:<input type="text" name="note" id="note">
			<input type="submit" name="checkin" value="checkin" id="checkin"/>
	</form>
	</div>
</div>
<!-- /login page -->

<!-- checkin page -->
<div data-role="page" id="checkinview"> 
	<div data-role="header"> 
		<h1>VINOZO: Checkin</h1>
	</div><!-- /header --> 
	<?php if(!$wine){
			echo "Sorry, no wines match.";
			} elseif (array_key_exists('error', $wine)){
				echo $wine['error'];
			} elseif ($wine->meta->results == 'int(0)'){
				echo "Sorry, no wines match. Add to Vinozo links goes here";
			} else {
				echo "<img class=\"largewinepic\" src=\"".$wine->wines[0]->image."\" border=\"0\" />";
				echo "<h2>Checking In: ".$wine->wines[0]->name."</h2>";
				echo "<i>".$wine->wines[0]->winery."</i><br />";
				echo "<i>".$wine->wines[0]->region."</i><br />";
				echo "<b>".$wine->wines[0]->vintage."</b><br />";
			}	?>
	<div data-role="content" id="content" > 
		
		
		
	</div>
	<div id="checkindetails"></div>
<!-- /checkin page -->

<?php  $this->load->view('templates/footer'); ?>  
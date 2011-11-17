<?php  $this->load->view('templates/header'); ?>

<!-- login page -->
<div data-role="page" id="loginview"> 
<?php  $this->load->view('utility/fb_js_sdk'); ?>
	<div data-role="header"> 
		<h1>VINOZO: Login</h1>
		
	</div><!-- /header --> 
	<div data-role="content" > 
		<div>
		  <h1>Vinozo - Login</h1>
		  
		  <form>
		  	email:<input type="text" /><br />
		  	password: <input type="password" />
		  	<input type="submit" />
		  </form>
		  <p><a href="#searchview" data-role="button">Bypass Login and go to Search</a></p>
		  <fb:login-button autologoutlink='true'></fb:login-button>
		</div>
	</div> 
</div> 
<!-- /login page -->

<!-- search page -->
<div data-role="page" id="searchview"> 
<?php  $this->load->view('utility/search_ajax'); ?>
	<div data-role="header"> 
		<h1>VINOZO: Search</h1>
	</div><!-- /header --> 
	
	<div data-role="content" > 
		<form action="#"  method="post" id="searchform">
			<input type="text" name="terms" id="searchterms">
			<input type="button" name="go" value="go" id="search"/>
		</form>
		<div id="wineresults">
			
		</div>
	</div>
<!-- /search page -->

<!-- details page -->
<div data-role="page" id="details"> 
 
	<div data-role="header"> 
		<h1>VINOZO: Wine Detail</h1>
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
<!-- /details page -->

<?php  $this->load->view('templates/footer'); ?>  
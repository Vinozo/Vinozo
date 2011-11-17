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

<?php  $this->load->view('templates/footer'); ?>  
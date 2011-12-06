<?php  $this->load->view('templates/header'); ?>

<!-- login page -->
<div data-role="page" id="loginview"> 
<?php  $this->load->view('utility/fb_js_sdk'); ?>
    <div id="introheader">
			
	</div> 
	<div data-role="content" >
		
		<div>
		  <form action="/user/login"  data-ajax="false" method="post" id="loginform">
		  	<input type="text" name="email" value="email"/><br />
		  	<input type="password" name="password" value="" />
		  	<input type="submit" value="login" data-role="button"/>
		  </form>
		  
		  <fb:login-button autologoutlink='true'></fb:login-button>
		  <?php 
		 
		 //var_dump($this->session->userdata); ?>
		 <?php 
		 	
		 ?>
		 
		
		</div>
	</div> 

</div> 
<!-- /login page -->

<!-- search page -->
<div data-role="page" id="searchview"> 
<?php  $this->load->view('utility/search_ajax'); ?>
	<div data-role="header" data-position="fixed"> 
		<h1>Search</h1>
	</div><!-- /header --> 
	
	<div data-role="content" > 
		<form action="#"  method="post" id="searchform">
			<input type="text" name="terms" id="searchterms">
			<input type="submit" name="go" value="go" id="search"/>
		</form>
		<div id="wineresults">
			
		</div>
		 
	</div>
<!-- /search page -->

<?php  $this->load->view('templates/footer'); ?>  
<?php  
$this->load->helper('form');
$this->load->view('templates/header'); ?>

<!-- login page -->
<div data-role="page" id="loginview"> 
<?php  $this->load->view('utility/fb_js_sdk'); ?>
    <div id="introheader">
			
	</div> 
	<div data-role="content" >
		
		<div>
		<?php 
		// Necessary for CSRF security
		$attributes = array('data-ajax' => 'false', 'method' => 'post', 'id' => 'loginform');
		echo form_open('user/login', $attributes); ?>
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
		<?php 
		// Necessary for CSRF security
		$attributes = array('method' => 'post', 'id' => 'searchform');
		echo form_open('#', $attributes); ?>
		<!-- <form action="#"  method="post" id="searchform"> -->
			<input type="text" name="terms" id="searchterms">
			<input type="submit" name="go" value="go" id="search"/>
		</form>
		<div id="wineresults">
			
		</div>
		 
	</div>
<!-- /search page -->

<?php  $this->load->view('templates/footer'); ?>  
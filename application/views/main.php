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
		  
		  <form action="/user/login"  data-ajax="false" method="get" id="loginform">
		  	email:<input type="text" name="email"/><br />
		  	password: <input type="password" name="password"/>
		  	<input type="submit" value="login" data-role="button"/>
		  </form>
		  <fb:login-button autologoutlink='true'></fb:login-button>
		  <?php //var_dump($this); ?>
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
			<input type="submit" name="go" value="go" id="search"/>
		</form>
		<div id="wineresults">
			
		</div>
		<p><a href="/user/logout" rel="external">logout</a></p>
	</div>
<!-- /search page -->

<?php  $this->load->view('templates/footer'); ?>  
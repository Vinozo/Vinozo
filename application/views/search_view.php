<?php  $this->load->view('templates/header'); ?>
<div data-role="page" id="profile"> 
 
	<div data-role="header"> 
		<h1>Search</h1>
		
	</div><!-- /header --> 
	<div data-role="content" > 
				
		<form action="/search/wine/"  method="post" id="searchform">
			<input type="text" name="terms" id="searchterms">
			<input type="submit" name="search" value="Search" />
		</form>
	</div>
</div>
<?php  $this->load->view('templates/footer'); ?>
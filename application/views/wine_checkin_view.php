<?php  $this->load->view('templates/header'); ?>
<!-- checkin page -->
<div data-role="page" id="checkin"> 
<?php  $this->load->view('utility/search_ajax'); ?>
	<div data-role="header"> 
		<h1>VINOZO: Checkin</h1>
	</div><!-- /header --> 
	
	<div data-role="content" > 
		<?php var_dump($data); ?>
	</div>
<!-- /checkin page -->
<?php  $this->load->view('templates/footer'); ?>  
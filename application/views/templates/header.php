<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Vinozo</title>

	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"> 	 
	<meta name="apple-mobile-web-app-capable" content="yes">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
	<link rel="stylesheet" href="/_assets/js/theme/vinozo_red.css">
	<link rel="stylesheet" href="/_assets/css/vinozo.css">
			
	<script type="text/javascript">	
		
			<?php 
			// Check if logged in and slide over to search view (from loginview) if so
			if($this->vinozo->logged_in()){ ?>
			$('#loginview').live( 'pageinit',function(event){
  			$.mobile.changePage('#searchview')
  			});
  			<?php } ?>
			
			// Put vars into local storage for ajax shifts
			$('.wineCheckin').live('click', function() {
			  var wineId = $(this).jqmData('id');
			  //alert(wineId)
			  $('#checkinview').jqmData('wineId', wineId);
			  
			  $.mobile.changePage('#checkinview');
			});
  			
			/*$('#checkinview').live('pagebeforeshow',function(event, ui){
			   $.mobile.pageLoading();    
			   var dynamicDataResp = $.ajax({
			    url: "/wine/checkin/"+$(this).jqmData('wineId'),
			    async: false,
			    cache: false
			  });
			  if(dynamicDataResp.status == 200){
			    $('#dynamicContentHolder').text(dynamicDataResp.responseText);
			  }
			  else{
			    $.mobile.changePage('#error', 'none', false, false);
			  }
			}); */ // 
	

		// all dialog buttons should close their parent dialog
		$(".ui-dialog button").live("click", function() {
		
			$("[data-role='dialog']").dialog("close");
		
		});
	
	</script>
	
</head>
<body>	

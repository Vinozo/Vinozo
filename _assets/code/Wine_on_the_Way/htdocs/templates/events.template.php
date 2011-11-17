</head>
<body>
	<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
	<?php include 'body-top.html' ?>
	<?php if(!empty($state['events'])):?>
		<?php $facebook=$state['facebook'];?>
		<div id="addProfileButton"></div>
		<?php $profileContent='<div class="btn"><a href="'.APP_URL.'"><img src="'.HOST_URL.'/htdocs/images/get_a_rec.png" alt="GET A RECOMMENDATION" /></a></div>';?>	
		<?php $facebook->api_client->profile_setFBML(FACEBOOK_KEY, $facebook->user, $profileContent, NULL, 'profile', $profileContent);?>
		<h1>Your Upcoming Events</h1>
		<?php foreach($state['events'] as $ev):?>	
		<div class="event">
			<h2><?php echo$ev['name'];?></h2>
			<div class="img-holder"><img src="<?php echo (!empty($ev['pic'])) ? $ev['pic']:'http://static.ak.fbcdn.net/pics/s_default.jpg';?>" alt="<?php echo $ev['name'];?>" /></div>
			<form class="box" name="what_to_bring_<?php echo $ev['eid'];?>" method="get" action="index.php">
				<div class="box-inner">
				<input type="hidden" name="page" value="details"/>
				<input type="hidden" name="eid" value="<?php echo $ev['eid'];?>"/>
				<input type="hidden" name="lat" value="<?php echo (!empty($ev['venue']['latitude']))?$ev['venue']['latitude']:'';?>"/>
				<input type="hidden" name="lng" value="<?php echo (!empty($ev['venue']['longitude']))?$ev['venue']['longitude']:'';?>"/>
				<select name="colorselect" class="dropdown">
					<option value="color">Choose Wine Color</option>
					<option value="red">Red</option>
					<option value="white">White</option>
				</select>
					<div class="btn">
						<a href="javascript:document.what_to_bring_<?php echo $ev['eid'];?>.submit();" class="btn-stretch"><span class="left"><!--ie--></span>Get a Recommendation!</a>
					</div>	
					<br class="clear" />
				</div>
				<div class="box-bottom"><!-- ie --></div>
			</form>
			<dl>
				<dt>Hosted by:</dt><dd><?php echo $ev['host'];?></dd>
				<dt>Type:</dt><dd><?php echo $ev['event_type'];?></dd>
				<dt>Start Time:</dt><dd><?php echo date('l, M j, Y @ g:ia', $ev['start_time']);?></dd>
				<dt>End Time:</dt><dd><?php echo date('l, M j, Y @ g:ia', $ev['end_time']);?></dd>
			</dl>		
			<br class="clear" />
			</div>
		<?php endforeach;?>
	<?php else: ?>
		<h1>You have no upcoming events, but we still love you. Why not meet some people at the <a href="http://www.snooth.com">Snooth Forums</a>?</h1>
	<?php endif;?>
	<?php include 'body-bottom.html' ?>
<script type="text/javascript">
        FB_RequireFeatures(["Api","XFBML"], function(){
        FB.Facebook.init("<?php echo FACEBOOK_KEY;?>", "xd_receiver.htm");
        FB.Connect.showAddSectionButton("profile", document.getElementById("addProfileButton"));
});
</script>
</body>

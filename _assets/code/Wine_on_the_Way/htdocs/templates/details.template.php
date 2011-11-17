</head>

<body onload="initialize()" onunload="GUnload()">
	<?php include 'body-top.html' ?>
	<h1><a href="<?php echo APP_URL;?>" target="_top">Back to your upcoming events</a></h1>
	<?php $fbe = $state['facebook_event']; ?>
	<?php $wine = (isset($state['wines_result']->name)) ? $state['wines_result'] : array();?>
	<?php $wine = (empty($wine) && isset($state['wine_result']->wines{0})) ? $state['wine_result']->wines{0} : $wine;?>
	<?php # echo"<pre>";print_r(!empty($state['wines_result']->name));echo"</pre>";?>
	<?php $local_stores = array(); $stores_result = array();?>	
	<?php if(isset($state['local_stores_for_wine'][4])):?>
		<?php $local_stores = array_chunk($state['local_stores_for_wine'], 5, TRUE);?>
		<?php $local_stores = $local_stores[0];?>
	<?php elseif(isset($state['local_stores_for_wine'])):?>
		<?php $local_stores = $state['local_stores_for_wine'];?>
	<?php endif;?>
	<?php if(isset($state['stores_result']->stores{4})):?>
		<?php $stores_result = array_chunk($state['stores_result']->stores, 5, TRUE);?>
		<?php $stores_result = $stores_result[0];?>
	<?php elseif(isset($state['stores_result']->stores)):?>
		<?php $stores_result =  $state['stores_result']->stores;?>
	<?php endif;?>
	<?php $local_stores_count = count($local_stores);?>
	<?php $stores_count = count($stores_result);?>
	<?php if(isset($fbe)):?>
		<?php if($local_stores_count > 0):?>
			<h2 class="details-title">Here's a wine that you can purchase near your event</h2>
		<?php elseif(empty($wine)):?>
			<h2 class="details-title">We were unable to find a wine, please try again shortly</h2>
		<?php elseif($stores_count > 0):?>
			<h2 class="details-title">Here's a great wine and some wine stores near your event</h2>
		<?php else:?>
			<h2 class="details-title">We couldn't find any wine stores near your event, but here's a great wine anyway!</h2>
		<?php endif;?>
	<?php endif;?>
	<div class="wine">
		<?php if(!empty($wine)):?>
			<?php if($local_stores_count > 0 || $stores_count > 0):?>
			<div class="box">
				<div class="box-inner">
					<?php $sum=0.00;?>
					<?php if($local_stores_count > 1):?>
						<?php foreach($local_stores as $local_store):?>
							<?php list($cur, $price) = split(' ', $local_store->price);?>
							<?php $sum += (float)$price;?>
						<?php endforeach;?>
						<p>In stock at <?php echo $local_stores_count;?> stores:</p>
						<p>Average price : $<?php echo round($sum/$local_stores_count, 2);?></p>
					<?php elseif($local_stores_count > 0):?>
						<p>In stock at:</p>
						<p class="merch"><?php echo $local_stores[0]->name;?></p>
						<p class="price"><?php echo $local_stores[0]->price;?></p>
					<?php elseif($stores_count > 0):?>
						<p class="merch"><?php echo $stores_count;?> Local Store<?php echo ($stores_count > 1) ? 's' : '';?></p>
					<?php endif;?>
				</div>
				<div class="box-bottom"><!-- ie --></div>
			</div>	
			<?php endif;?>
			<div class="img-holder"><img src="<?php echo $wine->image;?>"/></div>
			<h2><?php echo $wine->name;?></h2>
			<p class="snoothrank">Snoothrank: <?php echo $wine->snoothrank;?></p>
			<p class="desc"><?php echo (!empty($wine->varietal))?$wine->varietal.' ':'';?><?php echo (!empty($wine->type))?$wine->type.' ':'';?><?php echo (!empty($wine->region))?'from '.$wine->region.' ':'';?><?php echo (!empty($wine->winery))?'by '.$wine->winery:'';?></p>
			<p class="outgoing">See reviews and more details at <a href="http://www.snooth.com">Snooth.com</a></p>
		<?php endif;?>
		<br class="clear" />
	</div>
	<?php if(!empty($state['facebook_event']['venue']['latitude'])):?>
        <div id="map_canvas"></div>
	<?php else:?>
	<h3>No location given for this event.</h3>
	<?php endif;?>
	<div class="listings">
	<?php if($local_stores_count > 0):?>
		<div id="recommend_store">
		<h2>Available from</h2>	
		<?php foreach($local_stores as $local_store):?>
			<div class="store">
				<h4><?php echo $local_store->name;?></h4>
				<p><?php echo $local_store->address;?></p>
				<p><?php echo $local_store->city;?>, <?php echo $local_store->state;?></p>
				<p><?php echo $local_store->phone;?></p>
				<p><a href="<?php echo $local_store->url;?>" target="_blank"><?php echo $local_store->url;?></a></p>
				<p><?php echo $local_store->price;?></p>
			</div>
		<?php endforeach;?>
		</div>
	<?php elseif($stores_count > 0):?>
		<div id="recommend_stores">
		<h2>Local stores:</h2>
		<?php foreach($stores_result as $store):?>
		<div class="store">
			<h4><?php echo $store->name;?></h4>
			<p><?php echo $store->address;?></p>
			<p><?php echo $store->city;?>, <?php echo $store->state;?></p>
			<p><?php echo $store->phone;?></p>
			<p><a href="<?php echo $store->url;?>" target="_blank"><?php echo $store->url;?></a></p>
		</div>
		<?php endforeach;?>
		</div>
	<?php endif;?>
	<?php if(!empty($fbe)):?>
		<div id="your_event">
			<h2>Your event</h2>
            <h4><?php echo $fbe['name'];?></h4>
			<p>Address: <?php echo $fbe['venue']['street'];?></p>
			<p>Hosted by: <?php echo $fbe['host'];?></p>
			<p>Start Time:<br /><?php echo date('l, M j, Y @ g:ia', $fbe['start_time']);?></p>
			<p>End Time:<br /><?php echo date('l, M j, Y @ g:ia', $fbe['end_time']);?></p>
			<p class="outgoing"><a href='http://www.facebook.com/event.php?eid=<?php echo $fbe['eid'];?>' target="_top">View Event</a></p>
		</div>	
	<?php endif;?>
	</div>
	<br class="clear" />
	<?php include 'body-bottom.html' ?>
</body>

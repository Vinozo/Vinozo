<?php  $this->load->view('templates/header'); ?>
<div data-role="page"> 
 
	<div data-role="header"> 
		<h1>Wine Detail</h1>
		
	</div><!-- /header --> 
	<div data-role="content" > 
		
	<h1></h1>
		
		<?php 
	
		function IsJsonString($str){
		    try{
		        $jObject = json_decode($str);
		    }catch(Exception $e){
		        return false;
		    }
		    return (is_object($jObject)) ? true : false;
		}
	
		// fix the return string which is incomplete
		//$winedata = ltrim($data, 's');
		//$winedata = "{".$winedata; 
		$wine = json_decode($data);
		//var_dump($wine);
		
		
        /*if (IsJsonString($data)) {            
        	echo "Its Json";    
        } else{
        	echo "It isn't Json";    
        } */
		
		echo "<img class=\"largewinepic\" src=\"".$wine->wines[0]->image."\" border=\"0\" />";
		echo "<h2>".$wine->wines[0]->name."</h2>";
		echo "<i>".$wine->wines[0]->winery."</i><br />";
		echo "<i>".$wine->wines[0]->region."</i><br />";
		echo "<b>".$wine->wines[0]->vintage."</b><br />";
		echo "<i>".$wine->wines[0]->varietal."</i><br />";
		echo "<i>".$wine->wines[0]->type."</i><br />";
		
		echo "<p>".$wine->wines[0]->wm_notes."</p>";		
		echo "<pre>";	
		 
		
		
		/*echo "<img class=\"largewinepic\" src=\"".$wine->wines[0]->image."\" border=\"0\" />";
		echo "<h2>".$wine->wines[0]->name."</h2>";
		echo "<i>".$wine->wines[0]->winery."</i><br />";
		echo "<i>".$wine->wines[0]->region."</i><br />";
		echo "<b>".$wine->wines[0]->vintage."</b><br />";
		echo "<i>".$wine->wines[0]->varietal."</i><br />";
		echo "<i>".$wine->wines[0]->type."</i><br />";
		
		echo "<p>".$wine->wines[0]->wm_notes."</p>";		
		echo "<pre>";		
		//echo $wine;
		var_dump($wine);*/
		
		/**
		 * Ass. Array
		 echo "<img class=\"largewinepic\" src=\"".$wine['wines'][0]['image']."\" border=\"0\" />";
		echo "<h2>".$wine['wines'][0]['name']."</h2>";
		echo "<i>".$wine['wines'][0]['winery']."</i><br />";
		echo "<i>".$wine['wines'][0]['region']."</i><br />";
		echo "<b>".$wine['wines'][0]['vintage']."</b><br />";
		echo "<i>".$wine['wines'][0]['varietal']."</i><br />";
		echo "<i>".$wine['wines'][0]['type']."</i><br />";
		*/
		echo "<p>".$wine['wines'][0]['wm_notes']."</p>";		
		echo "<pre>";		
		//echo $wine;
		//var_dump($wine);
		echo "<pre>";		
					
	?>
	

	<div id="body">
		<img src="<?php //echo $data['wines'][0]['image'] ?>"/>
		<a href='/wine/checkin/'>Check In</a>
	</div>
		
	</div>
</div>
<?php  $this->load->view('templates/footer'); ?>
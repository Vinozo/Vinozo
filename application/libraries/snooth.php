<?php
/**
 *  Some namespace issue with search.php?!?!
 * 
 */
	class snooth {
		private $_api_url;
		private $_api_key;
		
		function __construct()
		{
			$this->_obj =& get_instance();
			
			$this->_obj->load->library('session');
			$this->_obj->load->config('snooth');
			$this->_obj->load->helper('url');
			
			$this->_api_url = $this->_obj->config->item('snooth_api_url');
			$this->_api_key = $this->_obj->config->item('snooth_api_key');
			//$this->_api_secret 	= $this->_obj->config->item('vinozo_api_secret');
		}
		
		
		
		public function search($params)
		{
			// create a new cURL resource
			$ch = curl_init();
			
			// set URL and other appropriate options
			
			//$url = "http://api.snooth.com/wines/?";
			
			$url = $this->_api_url.'/wines/?akey='.$this->_api_key.'&ip=192.0.43.10&q='.$params;
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			
			// grab URL and pass it to the browser
			$response = curl_exec($ch);
			
			// close cURL resource, and free up system resources
			curl_close($ch);
			
			return $response;
					
		}
		
		public function wineDetails($id)
		{
			// create a new cURL resource
			$ch = curl_init();
			
			// set URL and other appropriate options
			
			//http://api.snooth.com/wine/?id=kramer-vineyards-pinot-noir-estate&akey=rrwb6nqmqmiyhshx0rickn01sn3aoi89f78ym08rhuhbbsz7
			
			$url = $url = $this->_api_url.'/wine/?id='.$id.'&akey='.$this->_api_key;
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			
			// grab URL and pass it to the browser
			$response = curl_exec($ch);
			
			// close cURL resource, and free up system resources
			curl_close($ch);
			
			return $response;
					
		}
	}

	
<?php

class Search_model extends CI_Model {
		
	private $_api_url;
	private $_api_key;
		
	function __construct() {
		parent::__construct();
		$this->load->library('session');
			$this->load->config('snooth');
			$this->load->helper('url');
			
			$this->_api_url = $this->config->item('snooth_api_url');
			$this->_api_key = $this->config->item('snooth_api_key');
		//session_start();
	}
		
		public function search($params)
		{
			// create a new cURL resource
			$this->ch = curl_init();
			
			// set URL and other appropriate options
			
			//$url = "http://api.snooth.com/wines/?";
			
			$this->url = $this->_api_url.'/wines/?akey='.$this->_api_key.'&ip=192.0.43.10&q='.$params;
			
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->ch, CURLOPT_URL, $this->url);
			curl_setopt($this->ch, CURLOPT_HEADER, 0);
			
			// grab URL and pass it to the browser
			$this->response = curl_exec($this->ch);
			
			// close cURL resource, and free up system resources
			curl_close($this->ch);
			//var_dump($this->response);
			return $this->response;
					
		}
		
		public function wineDetails($id)
		{
			// create a new cURL resource
			$this->ch = curl_init();
			
			// set URL and other appropriate options
			
			//http://api.snooth.com/wine/?id=kramer-vineyards-pinot-noir-estate&akey=rrwb6nqmqmiyhshx0rickn01sn3aoi89f78ym08rhuhbbsz7
			
			$this->url = $this->url = $this->_api_url.'/wine/?id='.$id.'&akey='.$this->_api_key;
			
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->ch, CURLOPT_URL, $this->url);
			curl_setopt($this->ch, CURLOPT_HEADER, 0);
			
			// grab URL and pass it to the browser
			$this->response = curl_exec($this->ch);
			
			// close cURL resource, and free up system resources
			curl_close($this->ch);
			
			return $this->response;
					
		}
	}
?>
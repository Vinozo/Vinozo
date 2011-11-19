<?php

	class vinozo {
		
		private $_api_url;
		private $_api_key;
		private $_api_secret;
		private $_errors = array();
		private $_enable_debug = FALSE;
		
		function __construct()
		{
			$this->_obj =& get_instance();
			
			$this->_obj->load->library('session');
			$this->_obj->load->config('vinozo');
			$this->_obj->load->helper('url');
			//$this->_obj->load->helper('vinozo');
			
			$this->_api_url 	= $this->_obj->config->item('vinozo_api_url');
			//$this->_api_key 	= $this->_obj->config->item('vinozo_app_id');
			//$this->_api_secret 	= $this->_obj->config->item('vinozo_api_secret');
			
			$this->session = new vinozoSession();
			$this->connection = new vinozoConnection();
			
		}
		
		public function theurl(){
			return $this->_api_url;
		}
		
		public function logged_in()
		{
			return $this->session->logged_in();
		}
		
		public function isJson($postData = NULL)
		{
			if ($this->isJsonString($postData)) {            
	        	echo "Its Json";    
	        } else{
	        	echo "It isn't Json";    
	        }
		}
		
		/*public function isJson($str = NULL){
		    try{
		        $jObject = json_decode($str);
		    } catch(Exception $e){
		        return false;
		    }
		    	return (is_object($jObject)) ? true : false;
		}*/
		
		
		public function userFB($postData = NULL)
		{
			return $this->call('post', '/user/userFB', $postData, false);
		}
		
		public function createCheckin($postData = NULL)
		{
			return $this->call('post', '/checkin/createcheckin', $postData, TRUE);
		}
		
		public function login()
		{
			return $this->session->login();
		}
		
		public function login_url($scope = NULL)
		{
			return $this->session->login_url($scope);
		}
		
		public function logout()
		{
			return $this->session->logout();
		}
		
		public function user()
		{
			return $this->session->get();
		}
		
		public function call($method, $uri, $data = array(), $json = true)
		{
			
			$response = FALSE;
			
			try
			{
				switch ( $method )
				{
					case 'get':
						$response = $this->connection->get($this->append_token($this->_api_url.$uri));
					break;
					
					case 'post':
						$response = $this->connection->post($this->append_token($this->_api_url.$uri), $data, $json);
					break;
				}
			}
			catch (vinozoException $e)
			{
				$this->_errors[] = $e;
				
				if ( $this->_enable_debug )
				{
					echo $e;
				}
			}
			
			return $response;
		}
		
		public function errors()
		{
			return $this->_errors;
		}
		
		public function last_error()
		{
			if ( count($this->_errors) == 0 ) return NULL;
			
			return $this->_errors[count($this->_errors) - 1];
		}
		
		public function append_token($url)
		{
			return $this->session->append_token($url);
		}
		
		public function set_callback($url)
		{
			return $this->session->set_callback($url);
		}
		
		public function enable_debug($debug = TRUE)
		{
			$this->_enable_debug = (bool) $debug;
			
			
		}
	}
	
	class vinozoConnection {
		
		// Allow multi-threading.
		
		private $_mch = NULL;
		private $_properties = array();
		
		function __construct()
		{
			$this->_mch = curl_multi_init();
			
			$this->_properties = array(
				'code' 		=> CURLINFO_HTTP_CODE,
				'time' 		=> CURLINFO_TOTAL_TIME,
				'length'	=> CURLINFO_CONTENT_LENGTH_DOWNLOAD,
				'type' 		=> CURLINFO_CONTENT_TYPE
			);
		}
		
		private function _initConnection($url)
		{
			$this->_ch = curl_init($url);
			curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, TRUE);
		}
		
		public function get($url, $params = array())
		{
			if ( count($params) > 0 )
			{
				$url .= '?';
			
				foreach( $params as $k => $v )
				{
					$url .= "{$k}={$v}&";
				}
				
				$url = substr($url, 0, -1);
			}
			
			$this->_initConnection($url);
			$response = $this->_addCurl($url, $params);

		    return $response;
		}
		
		public function post($url, $params = array(), $json = TRUE)
		{
			// Todo
			$post = '';
			
			if($json){
				// $postData = json_encode(array('user_id'=>'5521459', 'wineId'=>'wine', 'favorite'=>0));
				$postData = $params;
				//open connection
				$ch = curl_init();
				
				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8","Accept:application/json, text/javascript, */*; q=0.01"));
				
				//execute post
				$response = curl_exec($ch);
				
				//close connection
				curl_close($ch);
				
				/*var_dump($url.$params);
				$this->_initConnection($url, $params);
				curl_setopt($this->_ch, CURLOPT_POST, 1);
				curl_setopt($this->_ch,CURLOPT_HTTPHEADER,array ("Accept: application/json")); 
				$response = curl_exec($this->_ch);*/
			}
			else 
			{
				// Not JSON so do traditional string post	
				$fields_string = "";
				//url-ify the data for the POST
				foreach($params as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
				rtrim($fields_string,'&');
				
				//open connection
				$ch = curl_init();
				
				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch,CURLOPT_POST,count($params));
				curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
				
				//execute post
				$response = curl_exec($ch);
				
				//close connection
				curl_close($ch);
			}
			
			return $response;
		}
		
		private function _addCurl($url, $params = array())
		{
			$ch = $this->_ch;
			
			$key = (string) $ch;
			$this->_requests[$key] = $ch;
			
			$response = curl_multi_add_handle($this->_mch, $ch);

			if ( $response === CURLM_OK || $response === CURLM_CALL_MULTI_PERFORM )
			{
				do {
					$mch = curl_multi_exec($this->_mch, $active);
				} while ( $mch === CURLM_CALL_MULTI_PERFORM );
				
				return $this->_getResponse($key);
			}
			else
			{
				return $response;
			}
		}
		
		private function _getResponse($key = NULL)
		{
			if ( $key == NULL ) return FALSE;
			
			if ( isset($this->_responses[$key]) )
			{
				return $this->_responses[$key];
			}
			
			$running = NULL;
			
			do
			{
				$response = curl_multi_exec($this->_mch, $running_curl);
				
				if ( $running !== NULL && $running_curl != $running )
				{
					$this->_setResponse($key);
					
					if ( isset($this->_responses[$key]) )
					{
						$response = new vinozoResponse( (object) $this->_responses[$key] );
						
						if ( $response->__resp->code !== 200 )
						{
							$error = $response->__resp->code.' | Request Failed';
							
							if ( isset($response->__resp->data->error->type) )
							{
								$error .= ' - '.$response->__resp->data->error->type.' - '.$response->__resp->data->error->message;
							}
							
							throw new vinozoException($error);
						}
						
						return $response;
					}
				}
				
				$running = $running_curl;
				
			} while ( $running_curl > 0);
			
		}
		
		private function _setResponse($key)
		{
			while( $done = curl_multi_info_read($this->_mch) )
			{
				$key = (string) $done['handle'];
				$this->_responses[$key]['data'] = curl_multi_getcontent($done['handle']);
				
				foreach ( $this->_properties as $curl_key => $value )
				{
					$this->_responses[$key][$curl_key] = curl_getinfo($done['handle'], $value);
					
					curl_multi_remove_handle($this->_mch, $done['handle']);
				}
		  }
		}
	}
	
	class vinozoResponse {
		
		private $__construct;

		public function __construct($resp)
		{
			$this->__resp = $resp;

			$data = json_decode($this->__resp->data);
			
			if ( $data !== NULL )
			{
				$this->__resp->data = $data;
			}
		}

		public function __get($name)
		{
			if ($this->__resp->code < 200 || $this->__resp->code > 299) return FALSE;

			$result = array();

			if ( is_string($this->__resp->data ) )
			{
				parse_str($this->__resp->data, $result);
				$this->__resp->data = (object) $result;
			}
			
			if ( $name === '_result')
			{
				return $this->__resp->data;
			}
			
			return $this->__resp->data->$name;
		}
	}
	
	class vinozoException extends Exception {
		
		function __construct($string)
		{
			parent::__construct($string);
		}
		
		public function __toString() {
			return "exception '".__CLASS__ ."' with message '".$this->getMessage()."' in ".$this->getFile().":".$this->getLine()."\nStack trace:\n".$this->getTraceAsString();
		}
		
	}
	
	class vinozoSession {
		
		private $_api_key;
		private $_api_secret;
		private $_token_url 	= 'oauth/access_token';
		private $_user_url		= 'me';
		private $_data			= array();
		
		function __construct()
		{
			$this->_obj =& get_instance();
			
			$this->_api_key 	= $this->_obj->config->item('vinozo_app_id');
			$this->_api_secret 	= $this->_obj->config->item('vinozo_api_secret');
			
			$this->_token_url 	= $this->_obj->config->item('vinozo_api_url').$this->_token_url;
			$this->_user_url 	= $this->_obj->config->item('vinozo_api_url').$this->_user_url;
			
			$this->_set('scope', $this->_obj->config->item('vinozo_default_scope'));
			
			$this->connection = new vinozoConnection();
			
			if ( !$this->logged_in() )
			{
				 // Initializes the callback to this page URL.
				$this->set_callback();
			}
			
		}
		
		public function logged_in()
		{
			// Simply check for uid session variable
			//var_dump($this->_obj->session->userdata);
			if(array_key_exists('uid', $this->_obj->session->userdata)){
				//echo "found key";
				return true;
			} else {
				//echo "didn't find key";
				return false;
			}
			/**
			 * Don't need to be this sophisticated yet
			 * return ( $this->get() === NULL ) ? FALSE : TRUE;
			 */
		}
		
		public function logout()
		{
			$this->_unset('uid');
			//$this->_unset('user');
		}
		
		public function login_url($scope = NULL)
		{
			//$url = "http://www.vinozo.com/dialog/oauth?client_id=".$this->_api_key.'&redirect_uri='.urlencode($this->_get('callback'));
			$url = $this->config->item('base_url');
			
			if ( empty($scope) )
			{
				$scope = $this->_get('scope');
			}
			else
			{
				$this->_set('scope', $scope);
			}
			
			if ( !empty($scope) )
			{
				$url .= '&scope='.$scope;
			}
			
			return $url;
		}
		
		public function login()
		{
			//$this->logout(); // You know, just in case
			$this->_obj->session->set_userdata('uid');
			/**
			 * return $this->call('post', '/user/login', $postData, TRUE);
			 */
			
			// Redirect to home, which will flip to search when it sees the sess var
			return redirect('/');
		}
		
		public function get()
		{
			$token = $this->_find_token();
			if ( empty($token) ) return NULL;
			
			// $user = $this->_get('user');
			// if ( !empty($user) ) return $user;
			
			try 
			{
				$user = $this->connection->get($this->_user_url.'?'.$this->_token_string());
			}
			catch ( vinozoException $e )
			{
				$this->logout();
				return NULL;
			}
			
			// $this->_set('user', $user);
			return $user;
		}
		
		private function _find_token()
		{
			$token = $this->_get('token');
			
			if ( !empty($token) )
			{
				if ( !empty($token->expires) && intval($token->expires) >= time() )
				{
					// Problem, token is expired!
					return $this->logout();
				}
				
				$this->_set('token', $token);
				return $this->_token_string();
			}
			
			if ( !isset($_GET['code']) )
			{
				return $this->logout();
			}
			
			if ( !$this->_get('callback') ) $this->_set('callback', current_url());
			$token_url = $this->_token_url.'?client_id='.$this->_api_key."&client_secret=".$this->_api_secret."&code=".$_GET['code'].'&redirect_uri='.urlencode($this->_get('callback'));
			
			try 
			{
				$token = $this->connection->get($token_url);
			}
			catch ( vinozoException $e )
			{
				$this->logout();
				redirect($this->_strip_query());
				return NULL;
			}
			
			$this->_unset('callback');
			
			if ( $token->access_token )
			{
				if ( !empty($token->expires) )
				{
					$token->expires = strval(time() + intval($token->expires));
				}
				
				$this->_set('token', $token);
				redirect($this->_strip_query());
			}
			
			return $this->_token_string();
		}
		
		private function _get($key)
		{
			$key = '_vinozo_'.$key;
			return $this->_obj->session->userdata($key);
		}
		
		private function _set($key, $data)
		{
			$key = '_vinozo_'.$key;
			$this->_obj->session->set_userdata($key, $data);
		}
		
		private function _unset($key)
		{
			$key = '_vinozo_'.$key;
			$this->_obj->session->unset_userdata($key);
		}
		
		public function set_callback($url = NULL)
		{
			$this->_set('callback', $this->_strip_query($url));
		}
		
		private function _token_string()
		{
			return 'access_token='.$this->_get('token')->access_token;
		}
		
		public function append_token($url)
		{
			if ( $this->_get('token') ) $url .= '?'.$this->_token_string();
			
			return $url;
		}
		
		private function _strip_query($url = NULL)
		{
			if ( $url === NULL )
			{
				$url = ( empty($_SERVER['HTTPS']) ) ? 'http' : 'https';
				$url .= '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			}
			
			$parts = explode('?', $url);
			return $parts[0];
		}
	}
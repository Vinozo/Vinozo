<?php
/*
 * SnoothAPI.lib.php
 *
 * Snooth's interface with Snooth API.
 * 
 * copyright (c) 2006-2008 Snooth Inc.
 */

define('SNOOTH_BASE_URL','http://api.snooth.com');

class SnoothAPI {
	private $_response;
	private $_akey;
	private $_ip;
	private $_format;
	private $_parameters;
	private $_username;
	private $_password;

	public function __construct($akey, $ip, $format) {
		$this->_akey = $akey;
		$this->_ip = $ip;
		$this->_format = $format;
		$this->_parameters = array();
		$this->_username = '';
		$this->_password = '';
	}

	public function response() {
		return $this->_response;
	}

	public function set_parameter($parameter, $value) {
		$this->_parameters[$parameter] = $value;
	}//end set_parameter

	public function set_authentication($username, $password) {
		$this->_username = $username;
		$this->_password = $password;
	}//end set_authentication

	public function reset_parameters() {
		$this->_parameters = array();
	}

	public function execute($method) {
		if(!empty($method)) {
			return $this->_send(SNOOTH_BASE_URL .'/'. $method .'/');
		}
		return 0;
	}//end execute

	private function _send($url) {
		$parameters = (array("akey"=> $this->_akey, 'ip'=>$this->_ip, 'format'=>$this->_format) + $this->_parameters);
		$ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		if(!empty($parameters)) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		}
		$result = curl_exec($ch);

		if (curl_errno($ch)) {
			return 0;
		} else {
			curl_close($ch);
			return $result;
		}
	}//end _send
}

?>

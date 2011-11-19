<?php

require_once "base_facebook.php";

class Facebook extends BaseFacebook
{	
    private $_api_id;
	private $_api_secret;
	
  /**
   * Identical to the parent constructor, except that
   * we start a PHP session to store the user ID and
   * access token if during the course of execution
   * we discover them.
   *
   * @param Array $config the application configuration.
   * @see BaseFacebook::__construct in facebook.php
   */
  public function __construct($config) {
  	//$this->load->config('facebook');
	
    if (!session_id()) {
      session_start();
    }
    parent::__construct($config);
	//$this->_api_id 	= $this->_obj->config->item('facebook_api_id');
	//$this->_api_secret 	= $this->_obj->config->item('facebook_api_secret');
  }

  protected static $kSupportedKeys =
    array('state', 'code', 'access_token', 'user_id');
	
	/**
	 * 	Over riding methods from base class - mpr
	 */
	/**
   * Set the Application ID.
   *
   * @param string $appId The Application ID
   * @return BaseFacebook
   */
  public function setAppId($appId) {
    $this->appId = $appId;
    return $this;
  }

  /**
   * Get the Application ID.
   *
   * @return string the Application ID
   */
  //public function getAppId() {
  	//var_dump($this->getAppId());
    //return $this->appId;
  //}

  /**
   * Set the API Secret.
   *
   * @param string $apiSecret The API Secret
   * @return BaseFacebook
   */
  public function setApiSecret($apiSecret) {
    $this->apiSecret = $apiSecret;
    return $this;
  }

  /**
   * Get the API Secret.
   *
   * @return string the API Secret
   */
  public function getApiSecret() {
    return $this->_api_secret;
  }
	
  /**
   * Provides the implementations of the inherited abstract
   * methods.  The implementation uses PHP sessions to maintain
   * a store for authorization codes, user ids, CSRF states, and
   * access tokens.
   */
  protected function setPersistentData($key, $value) {
    if (!in_array($key, self::$kSupportedKeys)) {
      self::errorLog('Unsupported key passed to setPersistentData.');
      return;
    }

    $session_var_name = $this->constructSessionVariableName($key);
    $_SESSION[$session_var_name] = $value;
  }

  protected function getPersistentData($key, $default = false) {
    if (!in_array($key, self::$kSupportedKeys)) {
      self::errorLog('Unsupported key passed to getPersistentData.');
      return $default;
    }

    $session_var_name = $this->constructSessionVariableName($key);
    return isset($_SESSION[$session_var_name]) ?
      $_SESSION[$session_var_name] : $default;
  }

  protected function clearPersistentData($key) {
    if (!in_array($key, self::$kSupportedKeys)) {
      self::errorLog('Unsupported key passed to clearPersistentData.');
      return;
    }

    $session_var_name = $this->constructSessionVariableName($key);
    unset($_SESSION[$session_var_name]);
  }

  protected function clearAllPersistentData() {
    foreach (self::$kSupportedKeys as $key) {
      $this->clearPersistentData($key);
    }
  }

  protected function constructSessionVariableName($key) {
    return implode('_', array('fb',
                              $this->getAppId(),
                              $key));
  }
}
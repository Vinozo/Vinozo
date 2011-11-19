<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
		{
			parent::__construct();
			
			//$this->load->library('user');
			$this->load->library('vinozo');
			$this->load->library('session');
			$this->load->library('facebook');
			$this->load->helper('url');
		}
		
	public function index()
		{
			$this->load->view('main');
			
		}
}


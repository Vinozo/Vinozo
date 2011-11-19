<?php
/**
 * User
 * ---
 * 
 * /login
 * 
 * 
 * /logout
 * 
 * 
 * /create
 *
 * 
 */
	class User extends CI_Controller {
		
		private $vinoUser = null;
		
		function __construct()
		{
			parent::__construct();
			
			//$this->load->library('user');
			$this->load->library('session');
			$this->load->library('vinozo');
			$this->load->library('facebook');
			$this->load->helper('url');
		}
		
		public function index()
		{	
			$this->load->view('vinozo_test_view');
		}
		
		function login()
		{
			// Call /user/login
			$this->vinozo->login();
			// No matching record, register?
			
			// Got results, so set sess var and redirect
			//$this->session->set_userdata(array('uid'=>'101'));
			//redirect('/search/', 'refresh');
		}
		
		function logout()
		{
			// Destroy session and redirect to home/login
			$this->session->unset_userdata('uid');
			redirect('/', 'refresh');
		}
	}
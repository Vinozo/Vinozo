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
			$this->load->helper('security');
		}
		
		public function index()
		{	
			$this->load->view('vinozo_test_view');
		}
		
		function login()
		{
			// Hash the passwd here because JS is less secure (but for now we're sending in the clear!)
			$password = do_hash($this->input->get('password'), 'md5'); // MD5
			$postData = array(
				'email' => $this->input->get('email'),
				'password' => $password
			);
			
			// Call /user/login
			$response = $this->vinozo->login($postData);
			//$response = json_decode($response->__resp->data, true);
			//var_dump($response->__resp->data->id);
			//return;
			// No matching record, register?
			
			// Got results, so set sess var and redirect
			$this->session->set_userdata('uid', $response->__resp->data->id);
			$this->session->set_userdata('ip', $this->input->ip_address());
			
			// Redirect to home, which will flip to search when it sees the sess var
			return redirect('/');
		}
		
		function logout()
		{
			// Destroy session and redirect to home/login
			$this->session->unset_userdata('uid');
			redirect('/', 'refresh');
		}
	}
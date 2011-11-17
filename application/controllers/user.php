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
			$this->load->library('vinozo');
			$this->load->library('session');
			$this->load->library('facebook');
			$this->load->helper('url');
		}
		
		public function index()
		{	
			$this->load->view('vinozo_test_view');
		}
		
		function login()
		{
			// If logged in, go right to search
			if ( !$this->vinozo->logged_in() )
			{
				redirect('/search/', 'refresh');
			}
			// Not logged in to Vinozoz, so get FB login info and pipe it to Vinozo
			//if(($_SESSION['fb_172530232841942_user_id'] || $_SESSION['fb_172530232841942_access_token'])){ // Need to abstract the appID
				// Put FB User ID into CI session
				$this->user = $this->facebook->getUser();
				$postData = array('uid'=>$this->user);
				//print_r($postData);
				$data = $this->vinozo->userFB($postData); 
				// Add logic to get FB login and logout urls and pass to view
				//var_dump($data);
				$this->load->view('login', array('data' => $data)); 
				$this->load->view('utility/debug_view');
			//} else { 
				//echo "Failed to get fb_id, killing session";
				//$this->load->view('login');
				
			//} 
		}
		
		function logout()
		{
			$this->facebook->logout();
			redirect('facebook_test');
		}
	}
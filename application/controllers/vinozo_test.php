<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vinozo_test extends CI_Controller {

	function __construct()
		{
			parent::__construct();
			
			// $this->load->add_package_path('/Users/elliot/github/codeigniter-facebook/application/');
			$this->load->library('vinozo');
			$this->load->library('session');
			$this->load->library('facebook');
			$this->vinozo->enable_debug(TRUE);
		}
		
	public function index()
		{
			
			// check if logged in, if not redirect to login
			print_r($_SESSION);	
			
			// if logged in, go to search	
			
			//$data = array('data' => $this->userFB());
			//$data = array('data' => $this->createCheckin());
			
			$this->load->view('vinozo_test_view');
		}
	
	public function userFB($uid=null)
		{
			// Try 5521459	
			$postData = array('uid'=>$uid);
			//print_r($postData);
			$data = $this->vinozo->userFB($postData); 
			//var_dump($data);
			$this->load->view('vinozo_test_view', array('data' => $data)); 	
		}
	
	public function createCheckin($wineId = null)
		{
			$postData = json_encode(array(
				'user_id'=>'5521459', // Will come from session
				'wineId'=>$wineId, // Try 'wine'
				'favorite'=>0 // From session?
			));	
				
			$data = $this->vinozo->createCheckin($postData); 
			$this->load->view('vinozo_test_view', array('data' => $data)); 			
		}
		
/**
 * 	Login - For now this is only through FB
 * 	
 */
	public function login()
		{
			if ( !$this->facebook->logged_in() )
			{
				// From now on, when we call login() or login_url(), the auth
				// will redirect back to this url.
				$this->facebook->set_callback(site_url('vinozo_test'));

				// Header redirection to auth.
				$this->facebook->login();

				// You can alternatively create links in your HTML using
				// $this->facebook->login_url(); as the href parameter.
			}
			else
			{
				redirect('vinozo_test');
			}
		}
		
		function logout()
		{
			$this->facebook->logout();
			redirect('vinozo_test');
		}
}


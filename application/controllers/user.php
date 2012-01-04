<?php
/**
 *  User
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
	
	public function index()  {	
		$this->load->view('main');
	}
	
	public function login()  {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email Address', 'required:valid_email');
		
		if ($this->form_validation->run() != false) {
			// Hash the passwd here because JS is less secure (but for now we're sending in the clear!)
			$password = do_hash($this->input->get('password'), 'md5'); // MD5
			$postData = array(
				'email' => $this->input->get('email'),
				'password' => $password
			);
			
			// Call /user/login
			$res = $this->vinozo->login($postData);
			//$response = json_decode($response->__resp->data, true);
			//var_dump($response->__resp->data->id);
			//return;
			// No matching record, register?
			
			//Check user vs. database
			$dbres = $this->user_model->verifyuser($this->input->post('email'),$this->input->post('password'));
			
			if ($dbres != false) {
				$this->session->set_userdata('email', $this->input->get('email'));					

				
				// Got results, so set sess var and redirect
				$this->session->set_userdata('uid', $response->__resp->data->id);
				$this->session->set_userdata('ip', $this->input->ip_address());
				
			
			echo "username:".$this->input->post('email')." -- ".$this->input->post('password');
			
			// Got results, so set sess var and redirect
			$this->session->set_userdata('uid', $response->__resp->data->id);
			$this->session->set_userdata('ip', $this->input->ip_address());
			
			// Redirect to home, which will flip to search when it sees the sess var
			//redirect('/');
			}
			
			
		} else {
			//redirect('/');
		}
		
		
	}

	public function signup() {
		$this->load->library('form_validation');
		
		$this->load->model('user_model');
		
		
	    $this->form_validation->set_rules('email', 'Email Address', 'required|callback_email_check|valid_email');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	    
		$this->load->view('main');
		if ($this->form_validation->run() == false) {
	        $data['content'] = $this->load->view('login_view', null, true);
	        //$this->load->view('template', $data);
	    } else {
	    	
	        $email    = $this->input->post('email');
	        $password = $this->input->post('password');
	        
	        $register = $this->user_model->register_user($email, $password);
	        
	        if ($register)
	        {
	            $this->session->set_flashdata('message', '<p class="success">You have now registered. Please login.</p>');
	            redirect('user/welcome');
	        }
	        else
	        {
	            $this->session->set_flashdata('message', '<p class="error">Something went wrong, please try again or contact the helpdesk.</p>');
	            redirect('user/welcome');
	        }
	    }
	}
	
	public function welcome() {
		$this->load->view('search_view');
	}
	
	public function logout() {
		// Destroy session and redirect to home/login
		$this->session->unset_userdata('uid');
		redirect('/', 'refresh');
	}
}

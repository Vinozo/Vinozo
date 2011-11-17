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
			// If logged in, go right to search
			if ($this->vinozo->logged_in())
			{
				redirect('/search/', 'refresh');
			} else {
				// Not logged in to Vinozo, so display login page on main jqm view
				$this->load->view('main');
			}
			
			
			// Logging in through FB, so get FB login info and pipe it to Vinozo
			
		}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
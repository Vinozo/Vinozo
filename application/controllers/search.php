<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct()
		{
			parent::__construct();
			$this->load->model('Search_model');
			//$this->load->library('snooth');
			//$this->search->enable_debug(TRUE);
		}
		
	public function index()
		{
			//$data = array('data' => $this->wine('baco'));
			$this->load->view('search_view');
		}
	
	public function wine()
		{
			if($postVars = $this->input->post('terms')){
				$data = array('data' => $this->Search_model->search($postVars));
				//$data = array('data' => $this->snooth->search($postVars));
				
			} else {
				$data = array('data' => json_encode(array('error' => 'Please enter at least one word to search for')));
				//var_dump($data);
			}
			$this->load->view('templates/search_results', $data);
		}
	
	
}


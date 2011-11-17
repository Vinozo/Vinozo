<?php

class Facebook extends CI_Controller {

	/**
	 *
	 */
	public function index()
	{
		$this->load->view('facebookview');
	}
	
	public function login()
	{
		
		$this->load->view('facebookview');
	}
}

?>
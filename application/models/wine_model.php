<?php 
class Wine_model extends CI_Model {

    private $id;
    private $rating;
    private $note;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->library('vinozo');
    }
	
	function checkin()
	{
		// Get id, rating and note from form
		// Really messy, yes.
		if($this->input->post('id')){
			$this->id = $this->input->post('id');
			//$data = array('data' => $this->snooth->search($postVars));
		} else {
			$this->id = null;
		}
		if($this->input->post('note')){
			$this->note = $this->input->post('note');
			//$data = array('data' => $this->snooth->search($postVars));
		} else {
			$this->note = null;
		}
		if($this->input->post('rating')){
			$this->rating = $this->input->post('rating');
			//$data = array('data' => $this->snooth->search($postVars));
		} else {
			$this->rating = null;
		}
			//package it up and send to library (should this be in model, too?)
			$postData = json_encode(array(
				'user_id'=> $this->session->userdata('uid'), // Will come from session
				'wineId'=>$this->id, // Try 'wine'
				'favorite'=>0, // From session?
				'note' => $this->note,
				'rating' => $this->rating,
				'ip' => $this->session->userdata('ip')
			));	
			//var_dump($postData);
		return $this->vinozo->call('post', '/checkin/createcheckin', $postData, TRUE);
	} 
} 
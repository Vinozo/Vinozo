<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wine extends CI_Controller {

	private $id;
	
	function __construct()
		{
			parent::__construct();
			
			//$this->load->library('snooth');
			$this->load->model('Search_model');
			$this->load->model('wine_model');
			$this->load->library('session');
			$this->load->library('vinozo');
			//$this->search->enable_debug(TRUE);
		}
		
	public function index()
		{
			$this->load->view('search_view');
		}
	
	/**
	 * 	Wine details page (checkin part 1)
	 */
	public function details($id)
		{
			//http://api.snooth.com/wine/?id=kramer-vineyards-pinot-noir-estate&akey=rrwb6nqmqmiyhshx0rickn01sn3aoi89f78ym08rhuhbbsz7
			$data = array('data' => $this->Search_model->wineDetails($id), 'id' => $id);
			
			//$data['data']['wineId'] = $id;
			$this->load->view('checkin', $data);
		}
		
	/**
	 * 	Wine checkin
	 */
	public function checkin()
		{
			// Get id, rating and note from form
			/* Really messy, yes.
			if($this->input->post('id')){
				$id = $this->input->post('id');
				//$data = array('data' => $this->snooth->search($postVars));
			} else {
				$id = null;
			}
			if($this->input->post('note')){
				$note = $this->input->post('note');
				//$data = array('data' => $this->snooth->search($postVars));
			} else {
				$note = null;
			}
			if($this->input->post('rating')){
				$rating = $this->input->post('rating');
				//$data = array('data' => $this->snooth->search($postVars));
			} else {
				$rating = null;
			}
			//var_dump($this->vinozo);
			$postData = json_encode(array(
				'user_id'=> $this->session->userdata('uid'), // Will come from session
				'wineId'=>$this->id, // Try 'wine'
				'favorite'=>0, // From session?
				'note' => $note,
				'rating' => $rating,
				'ip' => $this->session->userdata('ip')
			));	*/
			//var_dump($postData); 
			$data = array('data' => $this->wine_model->checkin());
			$this->load->view('templates/checkin_details', $data);
		}
	
	
}


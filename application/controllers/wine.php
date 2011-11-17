<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wine extends CI_Controller {

	private $id;
	
	function __construct()
		{
			parent::__construct();
			
			$this->load->library('snooth');
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
			$data = array('data' => $this->snooth->wineDetails($id), 'id' => $id);
			//$data['data']['wineId'] = $id;
			$this->load->view('wine_details_view', $data);
		}
		
	/**
	 * 	Wine checkin
	 */
	public function checkin($id)
		{
			$postData = json_encode(array(
				'user_id'=>'5521459', // Will come from session
				'wineId'=>$id, // Try 'wine'
				'favorite'=>0 // From session?
			));	
			$data = array('data' => $this->vinozo->createCheckin($postData));
			$this->load->view('wine_checkin_view', $data);
		}
	
	
}


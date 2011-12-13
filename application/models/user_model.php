<?php


class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		//parent::Model();
	}

	
	function verifyuser ($email, $password) {
		
		$q = $this->db->where('email_address',$email)->where('password', sha1($password))->limit(1)->get('users');
		
		if ($q->num_rows > 0 ) {
			echo '<pre>';
			print_r ($q->row());
			echo '</pre>';
			return $q->row();
		}
		
	}
	
	public function register_user($email, $password) {
		
		$curupdate = date('Y-m-d H:I:s', strtotime("now"));
		
		$new_member_insert_data = array(
			'emailaddress' => $this->input->post('email'),			
			'password' => md5($this->input->post('password')),
			'created_date' => $curupdate					
		);
		
		$insert = $this->db->insert('user', $new_member_insert_data);
		return $insert;
	
	}
	
}



?>
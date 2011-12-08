<?php


class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		//session_start();
	}
	
	
	public function verify_user ($email, $password) {
		
		$q = $this->db->where('emailaddress',$email)->where('password', sha1($password))->limit(1)->get('user');
		
		if ($q->num_rows > 0 ) {
			echo '<pre>';
			print_r ($q->row());
			echo '</pre>';
			return $q->row();
		}
		
	}
	
	public function register_user($email, $password) {
		
		$new_member_insert_data = array(
			'email' => $this->input->post('email'),			
			'password' => md5($this->input->post('password'))						
		);
		
		$insert = $this->db->insert('user', $new_member_insert_data);
		return $insert;
	
	}
	
}



?>
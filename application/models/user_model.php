<?php


class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		session_start();
	}
	
	
	public function verify_user ($email, $password) {
		
		$q = $this->db->where('email_address',$email)->where('password', sha1($password))->limit(1)->get('users');
		
		if ($q->num_rows > 0 ) {
			echo '<pre>';
			print_r ($q->row());
			echo '</pre>';
			return $q->row();
		}
		
	}
	
	
}



?>
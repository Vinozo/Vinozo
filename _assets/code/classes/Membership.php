<?php

include 'Mysql.php';

class Membership {
	
	function validate_user($un, $pwd) {
		$mysql = New Mysql();
		$ensure_credentials = $mysql->verify_Username_and_Pass($un, md5($pwd));
		
		if($ensure_credentials) {
			$_SESSION['status'] = 'authorized';
			header("location: index.php");
		} else {
			return "Please enter a correct username and password";
		}
	} 
	
	function log_User_Out() {
		if(isset($_SESSION['status'])) {
			unset($_SESSION['status']);
			
			if(isset($_COOKIE[session_name()])) 
				setcookie(session_name(), '', time() - 1000);
				session_destroy();
		}
	}
	
	function confirm_Member() {
		session_start();
		if($_SESSION['status'] !='authorized') header("location: login.php");
	}
	
	
	function signUpUser($un,$pwd) {
		$mysql = new Mysql();
		$signupval = $mysql->signup($un,md5($pwd));
		
		echo "(".$signupval.")";
		if ($signupval == "Success") {
			return "User Added";
		} else {
			return "Sorry";
		}
	}
}
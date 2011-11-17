<?php

$docRoot = getenv("DOCUMENT_ROOT");
include $docRoot."/_assets/code/includes/constants.php";

class Mysql {
	private $conn;
	
	function __construct() {
		$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or 
					  die('There was a problem connecting to the database.');
	}
	
	function verify_Username_and_Pass($un, $pwd) {
				
		$query = "SELECT *
				FROM user
				WHERE username = ? AND password = ?
				LIMIT 1";
				
		if($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('ss', $un, $pwd);
			$stmt->execute();
			
			if($stmt->fetch()) {
				$stmt->close();
				return true;
			}
		}
		
	}
	
	function signup ($un, $pwd) {
		
		$query = "
			INSERT INTO user (username,password) values(\"$un\",\"$pwd\")  
		";
		
		$stmt = $this->conn->query($query);
		if ($this->conn->error) {
			return "Error";
			printf("Errormessage: %s\n", $this->conn->error);
		} else {
			return "Success";
		}	
		
		
	}
}
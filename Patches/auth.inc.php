<?php
	require_once('lib/mysql.class.php');
	
	class Auth {
		private $db;
		
		public function Auth($database) {
			$this->db = $database;
		}
		
		public function login($user, $pass) {
			
			if(isset($_SESSION['userid'])) {
				return true;
			}
			
			$db = $this->db;
			
			$db->sql_prepare("SELECT * FROM users WHERE users.userName = ? AND users.userPassword = ? LIMIT 1");
			$db->sql_execute(array($user, $pass));
			if($db->sql_numrows() == 1) {
				$user = $db->sql_fetchrowset();
				print_r($user);
				$_SESSION['userID']        = $user[0]['userID'];
				$_SESSION['userName']      = $user[0]['userName'];
				$_SESSION['userEmail']     = $user[0]['userEmail'];
				$_SESSION['userIsAdmin']   = $user[0]['userIsAdmin'];
				$_SESSION['userIsStaff']   = $user[0]['userIsStaff'];
				$_SESSION['userIsStudent'] = $user[0]['userIsStudent'];
				
				return true;
			}
				
			return false;
				
		}
		
		public function isLoggedIn() {
			return isset($_SESSION['userID']);
		}
		
		public function isAdmin() {
			return ($_SESSION['userIsAdmin'] == true);
		}
		
		public function isStaff() {
			return ($_SESSION['userIsStaff'] == true);
		}
		
		public function isStudent() {
			return ($_SESSION['userIsStudent'] == true);
		}
	}
?>

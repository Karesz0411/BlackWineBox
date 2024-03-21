<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class SecurityBo {
		protected $dao;
		
	   /* ********************************************************
		* ********************************************************
		* ********************************************************/
		public function __construct() {
			$this->dao = new SecurityDao(new MysqlDatabaseBo());
		}
  
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function doUserAuthorization() {
			if (isset($_POST["logout"])) {
				setcookie("uid", "", time() - 3600);
				setcookie("uph", "", time() - 3600);
				$_COOKIE['uid'] = null;
				$_COOKIE['uph'] = null;
				header(
					"Location: " . 	
					RequestResponseHelper::$url_root . "/" . 
					RequestResponseHelper::$actor_name . "/" . 
					"login"
				);
				exit();
			}
			
			if (
				isset($_COOKIE['uid']) &&
				($this->dao->getUserPasswordHashByUserId([$_COOKIE['uid']]))
					->password_hash == $_COOKIE['uph']
			) {
				UserMessagesHelper::addToMessages(
					"User authorized.",
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);
				
				$GLOBALS['is_user_authorized'] = true;
			}
			else {
				UserMessagesHelper::addToMessages(
					"Issues found with user COOKIE.",
					UserMessagesHelper::MESSAGE_LEVEL_WARNING
				);
				
				setcookie('uid', "", time() - 3600);
				setcookie('uph', "", time() - 3600);
			}
		}
	}

?>
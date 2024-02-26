<?php
/* ********************************************************
 * ********************************************************
 * ********************************************************/
class UserBo {
	
	const SECRET_BLACK_MAGIC = "borvillakonnectorseprobobko";

	protected $dao;

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function __construct() {
		$this->dao = new UserDao(new MysqlDatabaseBo());
	}
  
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function getHashFromPassword(UserDo $do) {
		return md5($do->password . self::SECRET_BLACK_MAGIC);
	}

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function getUsers() {
		return ($this->dao)->getUsers();
	}

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function isRegistrationValid(UserDo $do) {	  //TODO: (maybe) make it boolean
		if ($do->nick_name == '') {
			UserMessagesHelper::addToMessages(
				"A \"Felhasználónév\" mező nem lehet üres!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['nick_name'] = true;
		}
	
		if (!($this->isUserNicknameUnique($_POST['nick_name']))) {
			UserMessagesHelper::addToMessages(
				"Az ön által megadott felhasználónévvel már regisztráltak!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['nick_name'] = true;
		}
		
		if ($do->email == '') {
			UserMessagesHelper::addToMessages(
				"Az \"Email-cím\" mező nem lehet üres!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['email'] = true;
		}
		
		if (!($this->isUserEmailUnique($_POST['email']))) {
			UserMessagesHelper::addToMessages(
				"Az ön által megadott Email címmel már regisztráltak!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['email'] = true;
		}
		
		if (!filter_var($do->email, FILTER_VALIDATE_EMAIL)){ //TODO: valóságban nem létező e-mail címek kiszűrése
			UserMessagesHelper::addToMessages(
				"Az \"Email-cím\" mező formailag nem felel meg!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['email'] = true;
		}
		
		$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"; //TODO: frontendes tájékoztassa a usert a jelszó formai követelményeiről (hossz: minimum 8, legalább egy nagy, kis betű és legalább egy szám)
		
		if ($do->password == '') {
			UserMessagesHelper::addToMessages(
				"A \"Jelszó\" mező nem lehet üres!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['password'] = true;
		}
		
		if (!preg_match_all($password_regex,$do->password)) {
			UserMessagesHelper::addToMessages(
				"A \"Jelszó\" mező nem felel meg a formai követelményeknek!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['password'] = true;
		}
		
		if ($do->password_again == '') {
			UserMessagesHelper::addToMessages(
				"A \"Jelszó újra begépelve\" mező nem lehet üres!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
			
			UserMessagesHelper::$invalid_form_fields['password_again'] = true;
		}
		
		if ($do->password !== $do->password_again) {
			UserMessagesHelper::addToMessages(
				"Az általad megadott jelszó és annak ismétlése nem egyezik!",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function create(UserDo $do) {
		return ($this->dao)->create(
			[
				$do->nick_name,
				$do->email,
				$this->getHashFromPassword($do), //TODO: Make hashing method more secure [trissz]
			]
		);
	}
  
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function isUserEmailUnique($email) {
		return ($this->dao)->isUserEmailUnique([$email]);
	}
  
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function isUserNicknameUnique($nick_name) {
		return ($this->dao)->isUserNicknameUnique([$nick_name]);
	}
  
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function doLogin(UserDo $input_do) {
		$retrived_do = $this->dao->getHash([$input_do->email]);
		$input_do->password_hash = $this->getHashFromPassword($input_do);
		
		if ($input_do->password_hash == $retrived_do->password_hash ) {
			UserMessagesHelper::addToMessages(
				"Sikeres bejelentkezés.",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
			$cookie_options = array (
                'expires' => time() + 60*60*24*30, 
                'path' => '/', 
                'domain' => 'blackwinebox.localhost',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict' // None || Lax  || Strict
            );
			
			setcookie('uph', $retrived_do->password_hash, $cookie_options);
			setcookie('uid', $retrived_do->id, $cookie_options);

			header("Location: " . RequestResponseHelper::$url_root . "/user/profile");
			exit;
		}
		else {
			UserMessagesHelper::addToMessages(
				"Az Email-cím vagy a megadott jelszó nem egyezik.",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function getById($id) {
		return $this->dao->getById([$id]);
	}

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public function getUserForgotPassword(array $parameters) {
		//TODO: Agree on message translations and factor out this string...
		//TODO: Agree on password retrieval/resetting method and finish this function...
		//TODO: This is a terrible hack until I debud the REQUEST/GET/POST mixmatch issue from .htaccess redirects
		return "Kérjük nézd meg az e-mail fiókod: {$parameters[1]}";
	}
	
}
?>

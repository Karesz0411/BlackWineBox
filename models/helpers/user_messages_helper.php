<?php
/* ********************************************************
 * ********************************************************
 * ********************************************************/
class UserMessagesHelper {
	
	const MESSAGE_LEVEL_MESSAGE = "message";
	const MESSAGE_LEVEL_WARNING = "warning";
	const MESSAGE_LEVEL_ERROR   = "error";
	
	public static $messages = [];
	public static $warnings = [];
	public static $errors   = [];
	
	public static $invalid_form_fields = [];

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public static function addToMessages(
		$message, 
		$message_level = "default_message"
	) {
	   switch ( $message_level )
	   {
			case "warning": self::$warnings[] = $message; break;
			case "error": self::$errors[] = $message; break;
			default: self::$messages[] = $message;
	   }
	}
   
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	public static function getAllMessages() {
	   return [
			"messages" => self::$messages,
			"errors"   => self::$errors,
			"warnings" => self::$warnings
	   ];
	}
}
?>

<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class DoFactory {
		const USER 	             = "User";
		const USER_PROFILE_IMAGE = "UserProfileImage";
		const VIEW 	             = "View";
		const IMAGE              = "Image";
		const ITEM               = "Item";
		const LOGO               = "Logo";
		const BOX_CONFIGURATION	 = "BoxConfiguration";
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function get(string $class_actor, $attributes = null) {
			$class_name = $class_actor . "Do";
			
			return new $class_name($attributes, strtolower($class_actor));
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getActorList() {
			return [
				self::USER,
				self::USER_PROFILE_IMAGE,
				self::VIEW,
				self::IMAGE,
				self::ITEM,
				self::LOGO,
				self::BOX_CONFIGURATION,
			];
		}
	}

?>
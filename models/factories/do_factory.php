<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class DoFactory {
		const USER 	             = "User";
		const USER_PROFILE_IMAGE = "UserProfileImage";
		const USER_COVER_IMAGE 	 = "UserCoverImage";
		const USER_RAID_MOMENT   = "UserRaidMoment";
		const TAVERN             = "Tavern";
		const TAVERN_ITEMS       = "TavernItems";
		const RAID 	             = "Raid";
		const RAID_TAVERN        = "RaidTavern";
		const VIEW 	             = "View";
		const ACHIEVEMENT        = "Achievement";
		const IMAGE              = "Image";
		const ITEM               = "Item";
		const WINE               = "Wine";
		const ORDER              = "Order";
		const LOGO               = "Logo";
		
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
				self::USER_COVER_IMAGE,
				self::USER_RAID_MOMENT,
				self::TAVERN,
				self::RAID,
				self::RAID_TAVERN,
				self::VIEW,
				self::ACHIEVEMENT,
				self::IMAGE,
				self::ITEM,
				self::WINE,
				self::LOGO,
			];
		}
	}

?>
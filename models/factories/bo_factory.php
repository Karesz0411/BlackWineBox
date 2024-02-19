<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class BoFactory {
		const USER 	       = "User";
		const TAVERN       = "Tavern";
		const TAVERN_ITEMS = "TavernItems";
		const RAID 	       = "Raid";
		const ACHIEVEMENT  = "Achievement";
		const ITEM         = "Item";
		const IMAGE        = "Image";
		const ORDER        = "Order";
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function get(string $class_name) {
			$class_name .= "Bo";
			
			return new $class_name();
		}
	}

?>
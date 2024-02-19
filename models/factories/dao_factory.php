<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class DaoFactory {
		const USER 	       = "User";
		const TAVERN       = "Tavern";
		const RAID 	       = "Raid";
		const ITEM	       = "Item";
		const ORDER	       = "Order";
		const ACHIEVEMENT  = "Achievement";
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function get(string $class_name, $attributes = null) {
			$class_name .= "Dao";
			
			return new $class_name($attributes);
		}
	}

?>
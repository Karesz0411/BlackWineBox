<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class TavernItemsDo extends TavernRaidImageAbstractDo {
		public $tavern_id;
		public $item_id;
		public $price;
		
		public $item_name;
		public $item_is_alcoholic;
		
		public $parent_id;
		public $parent_class_actor;
		
		function __construct($attributes = null, $class_actor = null) {
			$this->class_actor = $class_actor;
			$this->parent_class_actor = DoFactory::ITEM;
			
			if ($attributes != null) {
				foreach ($attributes as $key => $value) {
					$this->$key = $value;
				}
			}
			
			$this->parent_id = $this->item_id;
			
			foreach(
				[
					'icon',
					'small',
					'medium',
					'large',
					'original_png'
				] as $image_size
			) {
				$image_file_name =
					strtolower($this->parent_class_actor) .
					'_' .
					$this->parent_id .
					'_' .
					$image_size .
					'.png'
				;
				
				$attribute_name = 'image_' . $image_size;
				
				if (
					file_exists(
						TavernRaidRequestResponseHelper::$root . 
						'/cdn/' . 
						$image_file_name
					)
				) {
					$this->$attribute_name =
						TavernRaidRequestResponseHelper::$url_root . 
						'/cdn/' .
						$image_file_name
					;
				}
				else {
					$this->$attribute_name =
						TavernRaidRequestResponseHelper::$url_root .
						'/cdn/' .
						'logo_1_' .
						$image_size .
						'.png'
					;
				}
			}
		}
	}
?>
<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	abstract class ImageAbstractDo extends AbstractDo {
		
		public $image_icon;
		public $image_small;
		public $image_medium;
		public $image_large;
		public $image_original_png;
	
		function __construct($attributes = null, $class_actor = null) {
			$this->class_actor = $class_actor;
			
			if ($attributes != null) {
				foreach ($attributes as $key => $value) {
					$this->$key = $value;
				}
			}
			
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
					strtolower($this->class_actor) .
					'_' .
					$this->id .
					'_' .
					$image_size .
					'.png'
				;
				
				$attribute_name = 'image_' . $image_size;
				
				if (
					file_exists(
						RequestResponseHelper::$root . 
						'/cdn/' . 
						$image_file_name
					)
				) {
					$this->$attribute_name =
						RequestResponseHelper::$url_root . 
						'/cdn/' .
						$image_file_name
					;
				}
				else {
					$this->$attribute_name =
						RequestResponseHelper::$url_root .
						'/cdn/' .
						'logo_3_' .
						$image_size .
						'.png'
					;
				}
			}
		}
	}
?>
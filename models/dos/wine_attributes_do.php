<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	#[\AllowDynamicProperties]
	class WineAttributesDo extends MultipleImageAbstractDo {
		public $wine_name;
		public $aroma;
        public $flavor;
        public $appearance;
        public $alcohol_content;
        public $sweetness;
        public $making_techniques;
        public $ageability;
        public $intensity;
        public $place_of_production;

		
		function __construct($attributes = null, $class_actor = null) {
			$this->class_actor = $class_actor;
			$this->parent_class_actor = DoFactory::WINE_ATTRIBUTES;
			
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
					'boxconfigurationimage' .
					'_' .
					$this->id .
					'_' .
					$image_size .
					'.png'
				;
				
				$attribute_name = 'box_configuration_image_' . $image_size;
				
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
						'logo_1_' .
						$image_size .
						'.png'
					;
				}
			}
		}
		
		public function getAttributeArray() {
			return array(
				'id' => $this->id,
				'wine_name' => $this->wine_name,
                'aroma' => $this->aroma,
                'flavor' => $this->flavor,
                'apparance' => $this->appearance,
                'alcohol_content' => $this->alcohol_content,
                'sweetness' => $this->sweetness,
                'making_techniques' => $this->making_techniques,
                'ageability' => $this->ageability,
                'intensity' => $this->intensity,
                'place_of_production' => $this->place_of_production,
				'is_active' => $this->is_active,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			);
		}
	}
?>
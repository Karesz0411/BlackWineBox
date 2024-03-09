<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	#[\AllowDynamicProperties]
	class BoxConfigurationsDo extends MultipleImageAbstractDo {
		public $name;
		public $description;

		
		function __construct($attributes = null, $class_actor = null) {
			$this->class_actor = $class_actor;
			$this->parent_class_actor = DoFactory::BOX_CONFIGURATIONS;
			
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
			$return_array = array(
				'id' => $this->id,
				'name' => $this->name,
                'description' => $this->description,
				'is_active' => $this->is_active,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			);
			
			return $return_array;
		}
	}
?>
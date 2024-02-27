<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	#[\AllowDynamicProperties]
	class UserDo extends MultipleImageAbstractDo {
		public $nick_name;
		public $email;
		public $password;
		public $password_again;
		public $password_hash;
		public $is_admin;
		public $owned_products;

		public $profile_image_icon;
		public $profile_image_small;
		public $profile_image_medium;
		public $profile_image_large;
		public $profile_image_original_png;
		
		function __construct($attributes = null, $class_actor = null) {
			$this->class_actor = $class_actor;
			$this->parent_class_actor = DoFactory::ITEM;
			
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
					'userprofileimage' .
					'_' .
					$this->id .
					'_' .
					$image_size .
					'.png'
				;
				
				$attribute_name = 'profile_image_' . $image_size;
				
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
				'nick_name' => $this->nick_name,
				'email' => $this->email,
				'birthday_at' => $this->birthday_at,
				'is_above_legal_drinking_age' => $this->is_above_legal_drinking_age,
				'is_administrator' => $this->is_administrator,
				'is_active' => $this->is_active,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			);
			
			return $return_array;
		}
		
		public function getUserProfileArray() {
			$return_array = array(
				'Felhasználónév' => $this->nick_name,
				'E-mail' => $this->email,
				'Profil létrehozva' => $this->created_at,
			);
			
			return $return_array;
		}
	}
?>
<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class UserDo extends TavernRaidMultipleImageAbstractDo {
		public $nick_name;
		public $email;
		public $password;
		public $password_again;
		public $password_hash;
		public $birthday_at;
		public $is_above_legal_drinking_age;
		public $is_administrator;
		
		public $profile_image_icon;
		public $profile_image_small;
		public $profile_image_medium;
		public $profile_image_large;
		public $profile_image_original_png;
		
		public $cover_image_icon;
		public $cover_image_small;
		public $cover_image_medium;
		public $cover_image_large;
		public $cover_image_original_png;
		
		public $user_achievements_dos = [];
		public $user_raid_moment_dos = [];
		
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
					'usercoverimage' .
					'_' .
					$this->id .
					'_' .
					$image_size .
					'.png'
				;
				
				$attribute_name = 'cover_image_' . $image_size;
				
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
						'logo_3_' .
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
				'Szülétésnap' => $this->birthday_at,
				'Nagykorú' => $this->is_above_legal_drinking_age,
				'Profil létrehozva' => $this->created_at,
			);
			
			return $return_array;
		}
	}
?>
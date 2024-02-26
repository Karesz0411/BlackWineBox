<?php
	
	class UserProfileView extends AbstractView {
		
		public function displayWeb(UserDo $user_do) {
			$this->getWebHeader();
			
			foreach ($user_do->getUserProfileArray() as $key => $value) {
				echo("<p>" . $key . ": " . $value . "</p>");
			}?>
			
			<?php
				$user_profile_image_file_name = 'userprofileimage_' . $_COOKIE['uid'] . '_small.png';
				if (
					file_exists(
						RequestResponseHelper::$root . 
						'/cdn/' . 
						$user_profile_image_file_name
					)
				) {
					echo(
						'<img src="' . 
						RequestResponseHelper::$url_root . 
						'/cdn/' . 
						$user_profile_image_file_name . 
						'" />'
					);
				}
				
				$user_cover_image_file_name = 'usercoverimage_' . $_COOKIE['uid'] . '_small.png';
				if (
					file_exists(
						RequestResponseHelper::$root . 
						'/cdn/' . 
						$user_cover_image_file_name
					)
				) {
					echo(
						'<img src="' . 
						RequestResponseHelper::$url_root . 
						'/cdn/' . 
						$user_cover_image_file_name . 
						'" />'
					);
				}
			?>
			
			<p>
				<a href="/user/profile_image_upload">User Profile Image Upload</a>
			</p>
			<p>
				<a href="/user/cover_image_upload">User Cover Image Upload</a>
			</p>
			
			<form action="" method="post">
				<input name="logout" type="submit" value="Kijelentkezés"/>
			</form>
			
			<?php $this->getWebFooter();?>
			<?php
		}
	}
?>
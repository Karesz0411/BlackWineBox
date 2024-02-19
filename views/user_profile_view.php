<?php
	
	class UserProfileView extends AbstractView {
		public function displayMobile(UserDo $user_do) {
			header('Content-Type: application/json');
		
			echo json_encode(
				array_merge(
					['response' => UserMessagesHelper::getAllMessages()],
					['payload' => (array)$user_do]
				)
			);
		}
		
		public function displayWeb(UserDo $user_do) {
			$this->getWebHeader();
			
			foreach ($user_do->getUserProfileArray() as $key => $value) {
				echo("<p>" . $key . ": " . $value . "</p>");
			}?>
			
			<?php
				$user_profile_image_file_name = 'userprofileimage_' . $_COOKIE['uid'] . '_small.png';
				if (
					file_exists(
						TavernRaidRequestResponseHelper::$root . 
						'/cdn/' . 
						$user_profile_image_file_name
					)
				) {
					echo(
						'<img src="' . 
						TavernRaidRequestResponseHelper::$url_root . 
						'/cdn/' . 
						$user_profile_image_file_name . 
						'" />'
					);
				}
				
				$user_cover_image_file_name = 'usercoverimage_' . $_COOKIE['uid'] . '_small.png';
				if (
					file_exists(
						TavernRaidRequestResponseHelper::$root . 
						'/cdn/' . 
						$user_cover_image_file_name
					)
				) {
					echo(
						'<img src="' . 
						TavernRaidRequestResponseHelper::$url_root . 
						'/cdn/' . 
						$user_cover_image_file_name . 
						'" />'
					);
				}
			?>
			
			<p>
				<a href="/tavernraid/web/user/profile_image_upload">User Profile Image Upload</a>
			</p>
			<p>
				<a href="/tavernraid/web/user/cover_image_upload">User Cover Image Upload</a>
			</p>
			
			<form action="" method="post">
				<input name="logout" type="submit" value="Kijelentkezés"/>
			</form>
			
			<?php $this->getWebFooter();?>
			<?php
		}
	}
?>
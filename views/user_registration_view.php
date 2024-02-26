<?php
	
	class UserRegistrationView extends AbstractView {
		public function displayMobile() {
			header('Content-Type: application/json');
		
			if (!empty(RequestResponseHelper::$response['errors'])) {
				foreach (RequestResponseHelper::$response['errors'] as $error_message) {
					UserMessagesHelper::addToMessages(
						$error_message,
						UserMessagesHelper::MESSAGE_LEVEL_ERROR
					);
				}
			}
			
			echo json_encode( //TODO: Mit kellene küldeni a mobilosnak? [trisssz]
				UserMessagesHelper::getAllMessages()
			);
		}
		
		public function displayWeb(UserDo $user_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post">
					<label for="nick_name">Felhasználónév</label>
						<input
							name="nick_name"
							type="text"
							value="<?php echo($user_do->nick_name); ?>"
							<?php  ?>
						/>
					<br />
					<label for="email">Email-cím</label>
						<input name="email" type="text" value="<?php echo($user_do->email); ?>" />
					<br />
					<label for="password">Jelszó</label>
						<input name="password" type="password" value="<?php echo($user_do->password); ?>" />
					<br />
					<label for="password_again">Jelszó újra begépelve</label>
						<input name="password_again" type="password" value="<?php echo($user_do->password_again); ?>" />
					<br />
						<input name="registration" type="submit" value="Regisztrálás"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
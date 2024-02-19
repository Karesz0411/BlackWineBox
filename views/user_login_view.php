<?php
	
	class UserLoginView extends AbstractView {
		public function displayMobile() {
			header('Content-Type: application/json');
		
			echo json_encode( //TODO: Mit kellene küldeni a mobilosnak? [trisssz]
				UserMessagesHelper::getAllMessages()
			);
		}
		
		public function displayWeb(UserDo $user_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post">
					<label for="email">Email-cím</label>
					<input
						name="email"
						type="text"
						value="<?php echo($user_do->email); ?>"
					/>
					<br />
					<label for="password">Jelszó</label>
					<input
						name="password"
						type="password"
						value="<?php echo($user_do->password); ?>"
					/>
					<br />
					<input name="login" type="submit" value="Bejelentkezés"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
<?php
	
	class UserResetPasswordView extends AbstractView {
		public function displayWeb(UserDo $user_do) {
			?>
				<?php $this->getWebHeader(); ?>
				<section class="form_container">
					<form action="" method="post">
						<label for="new_password">Új jelszó</label>
							<input name="new_password" type="password" id="uresp" value="<?php echo($user_do->password); ?>" />
							<input type="checkbox" name="show_new_password" onclick="showPassword(document.getElementById('uresp'));"><label for="show_new_password">Show new password</label>
						<br />
						<label for="new_password_again">Új jelszó újra begépelve</label>
							<input name="new_password_again" type="password" id="urespa" value="<?php echo($user_do->password_again); ?>" />
							<input type="checkbox" name="show_new_password_again" onclick="showPassword(document.getElementById('urespa'));"><label for="show_new_password_again">Show new password again</label>
						<br /><hr class="form_horizontal_rule">
							<input name="reset_password" type="submit" value="Új jelszó beállítása"/>
					</form>
				</section>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
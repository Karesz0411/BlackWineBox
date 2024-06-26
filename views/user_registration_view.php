<?php
	
	class UserRegistrationView extends AbstractView {
		public function displayWeb(UserDo $user_do) {
			?>
				<?php $this->getWebHeader(); ?>
				<section class="form_container">
					<form action="" method="post">
						<label for="nick_name">Felhasználónév</label>
							<input
								name="nick_name"
								type="text"
								id="urnn"
								value="<?php echo($user_do->nick_name); ?>"
								<?php  ?>
							/>
						<br />
						<label for="email">Email-cím</label>
							<input name="email" type="text" id="urea" value="<?php echo($user_do->email); ?>" />
						<br />
						<label for="password">Jelszó</label>
							<input name="password" type="password" id="urp" value="<?php echo($user_do->password); ?>" />
							<input type="checkbox" name="show_password" onclick="showPassword(document.getElementById('urp'));"><label for="show_password">Show password</label>
						<br />
						<label for="password_again">Jelszó újra begépelve</label>
							<input name="password_again" type="password" id="urpa" value="<?php echo($user_do->password_again); ?>" />
							<input type="checkbox" name="show_password_again" onclick="showPassword(document.getElementById('urpa'));"><label for="show_password_again">Show password again</label>
						<br /><hr class="form_horizontal_rule">
							<input name="registration" type="submit" value="Regisztrálás"/>
							<button type="button" id="random_fill_btn" onclick="fillUserRegistrationInputFieldsWithRandomInputs();">Random kitöltés</button>
					</form>
				</section>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
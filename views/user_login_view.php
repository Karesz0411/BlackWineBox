<?php
	
	class UserLoginView extends AbstractView {
		
		public function displayWeb(UserDo $user_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<section class="form_container">
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
							id="ulp"
							value="<?php echo($user_do->password); ?>"
						/>
						<input type="checkbox" name="show_password" onclick="showPassword(document.getElementById('ulp'));"><label for="show_password">Show password</label>
						<br />
						<input name="login" type="submit" value="Bejelentkezés"/>
					</form>
					<a href="#" onclick="forgotPassword();">Elfelejtett jelszó</a>
			</section>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
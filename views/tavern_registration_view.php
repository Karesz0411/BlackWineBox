<?php
	
	class TavernRegistrationView extends AbstractView {
		public function displayMobile() {
			header('Content-Type: application/json');
		
			echo json_encode( //TODO: Mit kellene küldeni a mobilosnak? [trisssz]
				UserMessagesHelper::getAllMessages()
			);
		}
		
		public function displayWeb(TavernDo $tavern_do, UserBo $user_bo) {
			?>
				<?php $this->getWebHeader(); ?>
				
					<form action="" method="post">
						<label for="display_name">Vendéglátó egység neve</label>
							<input
								name="display_name"
								type="text"
								value="<?php echo($tavern_do->display_name); ?>"
							/>
						<br />
						<label for="company_name">Tulajdonos / Cég neve</label>
							<input
								name="company_name"
								type="text"
								value="<?php echo($tavern_do->company_name); ?>"
							/>
						<br />
						<label for="address_country">Ország</label>
							<input
								name="address_country"
								type="text"
								value="<?php echo($tavern_do->address_country); ?>"
							/>
						<br />
						<label for="address_city">Város</label>
							<input
								name="address_city"
								type="text"
								value="<?php echo($tavern_do->address_city); ?>"
							/>
						<br />
						<label for="address_postal_code">Irányítószám</label>
							<input
								name="address_postal_code"
								type="text"
								value="<?php echo($tavern_do->address_postal_code); ?>"
							/>
						<br />
						<label for="address_street_name">Utca név</label>
							<input
								name="address_street_name"
								type="text"
								value="<?php echo($tavern_do->address_street_name); ?>"
							/>
						<br />
						<label for="address_street_number">Házszám</label>
							<input
								name="address_street_number"
								type="text"
								value="<?php echo($tavern_do->address_street_number); ?>"
							/>
						<br />
						<label for="address_latitude">Szélességi kör (latitude)</label>
							<input
								name="address_latitude"
								type="text"
								value="<?php echo($tavern_do->address_latitude); ?>"
							/>
						<br />
						<label for="address_longitude">Hosszúsági kör (longitude)</label>
							<input
								name="address_longitude"
								type="text"
								value="<?php echo($tavern_do->address_longitude); ?>"
							/>
						<br />
						<label for="opened_at">Nyitási időpont</label>
							<input
								name="opened_at"
								type="text"
								value="<?php echo($tavern_do->opened_at); ?>"
							/>
						<br />
						<label for="closed_at">Zárási időpont</label>
							<input
								name="closed_at"
								type="text"
								value="<?php echo($tavern_do->closed_at); ?>"
							/>
						<br />
						<label for="phone_number">Telefonszám</label>
							<input
								name="phone_number"
								type="text"
								value="<?php echo($tavern_do->phone_number); ?>"
							/>
						<br />
						<label for="email">E-mail cím</label>
							<input
								name="email"
								type="text"
								value="<?php echo($tavern_do->email); ?>"
							/>
						<br />
						<label for="website_url">Weblap URL</label>
							<input
								name="website_url"
								type="text"
								value="<?php echo($tavern_do->website_url); ?>"
							/>
						<br />
						<label for="facebook_url">Facebook URL</label>
							<input
								name="facebook_url"
								type="text"
								value="<?php echo($tavern_do->facebook_url); ?>"
							/>
						<br />
						<label for="owner_user_id">Tulajdonos felhasználó azonosító</label>
						<select name="owner_user_id">
							<option value=""></option>
							<?php
								foreach($user_bo->getUserListForTavernRegistration() as $user_do) {
									?>
										<option
											value="<?php echo($user_do->id); ?>"
											<?php if ($tavern_do->owner_user_id == $user_do->id) {echo(" selected");} ?>
										>
											<?php echo($user_do->nick_name . " - " . $user_do->email); ?>
										</option>
									<?php
								}
							?>
						</select>
						<br />
							<input name="registration" type="submit" value="Regisztrálás"/>
					</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
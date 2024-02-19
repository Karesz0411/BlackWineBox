<?php
	
	class WineUploadView extends AbstractView {
		public function displayMobile() {
			header('Content-Type: application/json');
		
			if (!empty(TavernRaidRequestResponseHelper::$response['errors'])) {
				foreach (TavernRaidRequestResponseHelper::$response['errors'] as $error_message) {
					UserMessagesHelper::addToMessages(
						$error_message,
						UserMessagesHelper::MESSAGE_LEVEL_ERROR
					);
				}
			}
			
			echo json_encode(
				UserMessagesHelper::getAllMessages()
			);
		}
		
		public function displayWeb(WineDo $wine_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post" enctype="multipart/form-data">
					<label for="name">Név</label>
						<input
							name="name"
							type="text"
							value="<?php echo($wine_do->name); ?>"
						/>
					<br />
					<label for="winery">Borászat</label>
						<input
							name="winery"
							type="text"
							value="<?php echo($wine_do->winery); ?>"
						/>
					<br />
					<label for="production_year">Palackozási dátum</label>
						<input
							name="production_year"
							type="text"
							value="<?php echo($wine_do->production_year); ?>"
						/>
					<br />
					<label for="color">Szín</label>
						<input
							name="color"
							type="text"
							value="<?php echo($wine_do->color); ?>"
						/>
					<br />
					<label for="sweetness">Édességi faktor</label>
						<input
							name="sweetness"
							type="text"
							value="<?php echo($wine_do->sweetness); ?>"
						/>
					<br />
					<label for="origin_country">Származási ország</label>
						<input
							name="origin_country"
							type="text"
							value="<?php echo($wine_do->origin_country); ?>"
						/>
					<br />
					<label for="origin_region">Származási régió</label>
						<input
							name="origin_region"
							type="text"
							value="<?php echo($wine_do->origin_region); ?>"
						/>
					<br />
					<label for="origin_city">Származási város</label>
						<input
							name="origin_city"
							type="text"
							value="<?php echo($wine_do->origin_city); ?>"
						/>
					<br />
					<label for="type">Típus</label>
						<input
							name="type"
							type="text"
							value="<?php echo($wine_do->type); ?>"
						/>
					<br />
					<label for="consumption_temperature">Fogyasztási hőmérséklet</label>
						<input
							name="consumption_temperature"
							type="text"
							value="<?php echo($wine_do->consumption_temperature); ?>"
						/>
					<br />
					<label for="bottler">Palackozó</label>
						<input
							name="bottler"
							type="text"
							value="<?php echo($wine_do->bottler); ?>"
						/>
					<br />
					<label for="bottle_size">Palack űrtartalma (liter)</label>
						<input
							name="bottle_size"
							type="text"
							value="<?php echo($wine_do->bottle_size); ?>"
						/>
					<br />
					<label for="alcohol_percentage_level">Alkoholtartalom (%)</label>
						<input
							name="alcohol_percentage_level"
							type="text"
							value="<?php echo($wine_do->alcohol_percentage_level); ?>"
						/>
					<br />
					<label for="ean">EAN azonosító</label>
						<input
							name="ean"
							type="text"
							value="<?php echo($wine_do->ean); ?>"
						/>
					<br />
					<label for="cork_type">Kupakozás típusa</label>
						<input
							name="cork_type"
							type="text"
							value="<?php echo($wine_do->cork_type); ?>"
						/>
					<br />
					<label for="image_file">Kép feltöltése</label>
						<input
							name="image_file"
							type="file"
							value="<?php echo($wine_do->image_file_name); ?>"
						/>
					<br />
						<input name="create" type="submit" value="Létrehozás"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
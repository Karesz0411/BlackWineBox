<?php
	
	class WineAttributesCreateView extends AbstractView {
		
		public function displayWeb(WineAttributesDo $wine_attributes_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<section class="form_container">
					<form action="" method="post" enctype="multipart/form-data">
						<label for="wine_name">Bor név</label>
							<input
								name="wine_name"
								type="text"
								value="<?php echo($wine_attributes_do->wine_name); ?>"
								<?php  ?>
							/>
						<br />
						<label for="aroma">Aroma</label>
							<input
								name="aroma"
								type="text"
								value="<?php echo($wine_attributes_do->aroma); ?>"
								<?php  ?>
							/>
						<br />
						<label for="flavor">Íz</label>
							<input
								name="flavor"
								type="text"
								value="<?php echo($wine_attributes_do->flavor); ?>"
								<?php  ?>
							/>
						<br />
						<label for="appearance">Megjelenés</label>
							<input
								name="appearance"
								type="text"
								value="<?php echo($wine_attributes_do->appearance); ?>"
								<?php  ?>
							/>
						<br />
						<label for="alcohol_content">Alkoholtartalom</label>
							<input
								name="alcohol_content"
								type="float"
								value="<?php echo($wine_attributes_do->alcohol_content); ?>"
								<?php  ?>
							/>
						<br />
						<label for="sweetness">Édesség szint</label>
							<input
								name="sweetness"
								type="text"
								value="<?php echo($wine_attributes_do->sweetness); ?>"
								<?php  ?>
							/>
						<br />
						<label for="making_techniques">Gyártási technikák</label>
							<input
								name="making_techniques"
								type="text"
								value="<?php echo($wine_attributes_do->making_techniques); ?>"
								<?php  ?>
							/>
						<br />
						<label for="ageability">Öregedhetőség</label>
							<input
								name="ageability"
								type="number"
								value="<?php echo($wine_attributes_do->ageability); ?>"
								<?php  ?>
							/>
						<br />
						<label for="intensity">Intenzitás</label>
							<input
								name="intensity"
								type="text"
								value="<?php echo($wine_attributes_do->intensity); ?>"
								<?php  ?>
							/>
						<br />
						<label for="place_of_production">Gyártás helye</label>
							<input
								name="place_of_production"
								type="text"
								value="<?php echo($wine_attributes_do->place_of_production); ?>"
								<?php  ?>
							/>
						<br /><hr class="form_horizontal_rule">
							<input name="create" type="submit" value="Létrehozás"/>
					</form>
				</section>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
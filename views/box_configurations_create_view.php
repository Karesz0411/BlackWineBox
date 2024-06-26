<?php
	
	class BoxConfigurationsCreateView extends AbstractView {
		
		public function displayWeb(BoxConfigurationsDo $box_configurations_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<section class="form_container">
					<form action="" method="post" enctype="multipart/form-data">
						<label for="name">Doboz név</label>
							<input
								name="name"
								type="text"
								value="<?php echo($box_configurations_do->name); ?>"
								<?php  ?>
							/>
						<br />
						<label for="description">Leírás</label>
							<input
								name="description"
								type="textarea"
								value="<?php echo($box_configurations_do->description); ?>"
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
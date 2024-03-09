<?php
	
	class BoxConfigurationsCreateView extends AbstractView {
		
		public function displayWeb(BoxConfigurationsDo $box_configurations_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post" enctype="multipart/form-data">
					<label for="name">Bor név</label>
						<input
							name="name"
							type="text"
							value="<?php echo($box_configurations_do->name); ?>"
							<?php  ?>
						/>
					<br />
                    <label for="description">Aroma</label>
						<input
							name="description"
							type="text"
							value="<?php echo($box_configurations_do->description); ?>"
							<?php  ?>
						/>
					<br />
						<input name="create" type="submit" value="Létrehozás"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
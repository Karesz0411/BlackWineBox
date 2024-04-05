<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class UserProfileImageUploadView extends AbstractView {
		public function displayWeb() {
			?>
				<?php $this->getWebHeader(); ?>
				
				<section class="form_container">
					<form action="" method="post" enctype="multipart/form-data">
						<label for="image_file">Kép kiválasztása:</label>
							<input
								name="image_file"
								type="file"
								value="" />
						<br /><hr class="form_horizontal_rule">
							<input name="create" type="submit" value="Feltöltés"/>
					</form>
				</section>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
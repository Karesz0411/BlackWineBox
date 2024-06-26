<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class ImageUploadView extends AbstractView {
		public function displayWeb(
			AbstractDo $image_do,
			DoFactory $do_factory
		) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<section class="form_container">
					<form action="" method="post" enctype="multipart/form-data">
						<label for="actor">Aktor:</label>
							<select name="actor">
								<option>-- Choose --</option>
								<?php foreach($do_factory->getActorList() as $actor) { ?>
									<option 
										value="<?php echo($actor); ?>"
										<?php if ($actor == $image_do->$actor) {echo("selected");} ?>
									>
										<?php echo($actor); ?>
									</option>
								<?php } ?>
							</select>
						<br />
						<label for="id">ID:</label>
							<input
								name="id"
								type="text"
								value="<?php echo($image_do->id); ?>"
							/>
						<br />
						<label for="image_file">Kép kiválasztása:</label>
							<input
								name="image_file"
								type="file"
								value=""
								<?php  ?>
							/>
						<br /><hr class="form_horizontal_rule">
							<input name="create" type="submit" value="Feltöltés"/>
					</form>
				</section>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
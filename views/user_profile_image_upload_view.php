<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class UserProfileImageUploadView extends AbstractView {
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
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
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function displayWeb() {
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post" enctype="multipart/form-data">
					<label for="image_file">Kép kiválasztása:</label>
						<input
							name="image_file"
							type="file"
							value="" />
					<br />
						<input name="create" type="submit" value="Feltöltés"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
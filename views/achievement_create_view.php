<?php
	
	class AchievementCreateView extends AbstractView {
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
		
		public function displayWeb(AchievementDo $achievement_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post" enctype="multipart/form-data">
					<label for="title">Cím</label>
						<input
							name="title"
							type="text"
							value="<?php echo($achievement_do->title); ?>"
							<?php  ?>
						/>
					<br />
					<label for="description">Leírás</label>
						<textarea name="description"><?php echo($achievement_do->description); ?></textarea>
					<br />
					<label for="image_file">Kép feltöltése</label>
						<input
							name="image_file"
							type="file"
							value="<?php echo($achievement_do->image_file_name); ?>"
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
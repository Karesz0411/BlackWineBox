<?php
	
	class ItemCreateView extends AbstractView {
		public function displayMobile() {
			header('Content-Type: application/json');
		
			if (!empty(RequestResponseHelper::$response['errors'])) {
				foreach (RequestResponseHelper::$response['errors'] as $error_message) {
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
		
		public function displayWeb(ItemDo $item_do) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<section class="form_container">
					<form action="" method="post" enctype="multipart/form-data">
						<label for="name">Név</label>
							<input
								name="name"
								type="text"
								value="<?php echo($item_do->name); ?>"
								<?php  ?>
							/>
						<br />
						<label for="image_file">Kép feltöltése</label>
							<input
								name="image_file"
								type="file"
								value="<?php echo($item_do->image_file_name); ?>"
								<?php  ?>
							/>
						<br />
							<input name="create" type="submit" value="Létrehozás"/>
					</form>
				</section>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
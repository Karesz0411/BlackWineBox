<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class UserRaidMomentCreateView extends AbstractView {
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function displayMobile() {
			header('Content-Type: application/json');
		
			if (!empty(TavernRaidRequestResponseHelper::$response['errors'])) {
				foreach (TavernRaidRequestResponseHelper::$response['errors'] as $message) {
					UserMessagesHelper::addToMessages(
						$message,
						UserMessagesHelper::MESSAGE_LEVEL_ERROR
					);
				}
			}
			
			if (!empty(TavernRaidRequestResponseHelper::$response['warnings'])) {
				foreach (TavernRaidRequestResponseHelper::$response['warnings'] as $message) {
					UserMessagesHelper::addToMessages(
						$message,
						UserMessagesHelper::MESSAGE_LEVEL_WARNING
					);
				}
			}
			
			if (!empty(TavernRaidRequestResponseHelper::$response['messages'])) {
				foreach (TavernRaidRequestResponseHelper::$response['messages'] as $message) {
					UserMessagesHelper::addToMessages(
						$message,
						UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
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
		public function displayWeb(
			array $user_do_list,
			array $raid_tavern_do_list,
			UserRaidMomentDo $user_raid_moment_do
		) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post" enctype="multipart/form-data">
					<label for="user_id">User:</label>
						<select name="user_id">
							<option value="">-- Please select --</option>
							<?php foreach ($user_do_list as $user_do) { ?>
								<option
									value="<?php echo($user_do->id); ?>"
									<?php 
										if ($user_raid_moment_do->user_id === $user_do->id) {
											echo(' selected ');
										}
									?>
									>
									<?php 
										echo(
											'#' . 
											$user_do->id . ' - ' .
											$user_do->nick_name . ' (' . 
											$user_do->email . ')'
										);
									?>
								</option>
							<?php } ?>
						</select>
					<br />
					<label for="raid_id">Raid:</label>
						<select name="raid_id">
							<option value="">-- Please select --</option>
							<?php foreach ($raid_tavern_do_list as $raid_tavern_do) { ?>
								<option 
									value="<?php echo($raid_tavern_do->raid_id); ?>"
									<?php 
										if ($user_raid_moment_do->raid_id === $raid_tavern_do->raid_id) {
											echo(' selected ');
										}
									?>
									>
									<?php 
										echo(
											'#' . 
											$raid_tavern_do->raid_id . ' - ' .
											$raid_tavern_do->tavern_name . ' (' . 
											$raid_tavern_do->raid_description . ')'
										);
									?>
								</option>
							<?php } ?>
						</select>
					<br />
					<label for="description">Leírás</label>
						<textarea name="description"><?php echo($user_raid_moment_do->description); ?></textarea>
					<br />
					<label for="image_file">Image:</label>
						<input
							name="image_file"
							type="file"
							value="" />
					<br />
						<input name="create" type="submit" value="Create"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class UserAchievementCreateView extends AbstractView {
		
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
		public function displayWeb(
			array $user_do_list,
			array $achievement_do_list,
			UserDo $submitted_user_do = null,
			AchievementDo $submitted_achievement_do = null
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
										if ($user_do->id === $submitted_user_do->id) {
											echo(' selected ');
										}
									?>
									>
									<?php 
										echo(
											'#' . 
											$user_do->id . ' - ' .
											$user_do->nick_name . '(' . 
											$user_do->email . ')'
										);
									?>
									<?php echo($user_do->user_nick . '(' . $user_do->email . ')'); ?>
								</option>
							<?php } ?>
						</select>
					<br />
					<label for="achievement_id">Achievement:</label>
						<select name="achievement_id">
							<option value="">-- Please select --</option>
							<?php foreach ($achievement_do_list as $achievement_do) { ?>
								<option 
									value="<?php echo($achievement_do->id); ?>"
									<?php 
										if ($achievement_do->id === $submitted_achievement_do->id) {
											echo(' selected ');
										}
									?>
									>
									<?php echo($achievement_do->title); ?>
								</option>
							<?php } ?>
						</select>
					<br />
						<input name="register" type="submit" value="Register"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
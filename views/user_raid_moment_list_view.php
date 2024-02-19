<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class UserRaidMomentListView extends AbstractView {
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function displayMobile(array $user_raid_moment_do_list) {
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
				$user_raid_moment_do_list
			);
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function displayWeb(array $user_raid_moment_do_list) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<?php
					foreach($user_raid_moment_do_list as $user_raid_moment_do) {
						?>
							<pre>
								<?php print_r($user_raid_moment_do) ?>
							</pre>
						<?php
							echo(
								'<img src="' . 
								$user_raid_moment_do->image_medium . 
								'" />'
							);
					}
				?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
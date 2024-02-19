<?php
	
	class RaidStartView extends AbstractView {
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
			
			echo json_encode( //TODO: Mit kellene küldeni a mobilosnak? [trisssz]
				UserMessagesHelper::getAllMessages()
			);
		}
		
		public function displayWeb(RaidDo $raid_do) {
			$tavern_bo = (new BoFactory())->get(BoFactory::TAVERN);
		
			?>
				<?php $this->getWebHeader(); ?>
				
				<form action="" method="post">
					<label for="tavern_id">Tavern ID</label>
						<select name = "tavern_id">
							<option value=""></option>
							<?php
								foreach($tavern_bo->getListByUserId($_COOKIE['uid']) as $tavern_do) {
									?>
										<option
											value="<?php echo($tavern_do->id); ?>"
											<?php if ($raid_do->tavern_id == $tavern_do->id) {echo(" selected");} ?>
										>
											<?php echo($tavern_do->display_name . " - " . $tavern_do->id); ?>
										</option>
									<?php
								}
							?>
						</select>
					<br />
					<label for="from_datetime">From</label>
						<input
							name="from_datetime"
							type="text"
							value="<?php echo($raid_do->from_datetime); ?>" />
					<br />
					<label for="to_datetime">To</label>
						<input
							name="to_datetime"
							type="text"
							value="<?php echo($raid_do->to_datetime); ?>" />
					<br />
					<label for="number_of_user">Number of user</label>
						<input
							name="number_of_user"
							type="text"
							value="<?php echo($raid_do->number_of_user); ?>" />
					<br />
					<label for="description">Description</label>
					<textarea name="description"><?php echo($raid_do->description); ?></textarea>
					<br />
						<input name="start" type="submit" value="Start"/>
				</form>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
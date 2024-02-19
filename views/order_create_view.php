<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class OrderCreateView extends AbstractView {
		
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
			OrderDo $order_do,
			array $tavern_do_list,
			array $user_order_do_list = []
		) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<?php foreach ($tavern_do_list as $tavern_do) { ?>
					<div style="border:1px solid #000;">
						<h3>
							<?php echo($tavern_do->display_name); ?> 
							(#<?php echo($tavern_do->id); ?>)
						</h3>
						
						<?php foreach ($tavern_do->tavern_items_dos as $tavern_items_do) { ?>
							<span style="display:inline-block;width:20%;">
								<?php echo($tavern_items_do->item_name); ?> 
								(#<?php echo($tavern_items_do->id); ?>)
							</span>
							<span style="display:inline-block;width:10%;">
								<?php echo($tavern_items_do->price); ?> HUF
							</span>
							<form
								action="" 
								method="post" 
								style="display:inline-block;width:55%;margin-bottom:0px;">
								<label for="amount" style="margin-right:3px;">Amount:</label>
									<input
										name="tavern_items_id"
										type="hidden"
										value="<?php echo($tavern_items_do->id); ?>" />
									<input
										name="amount"
										type="number"
										min="0"
										max="20"
										style="width:10%"
										value="1" />
									<input
										name="create_order"
										type="submit"
										style="width:30%;"
										value="Order" />
							</form>
							<?php if (!empty($user_order_do_list)) { ?>
								<br />
								<?php foreach ($user_order_do_list as $user_order_do) { ?>
									<?php if ($tavern_items_do->id === $user_order_do->tavern_items_id) { ?>
										<span>
											<?php echo($user_order_do->created_at); ?>: 
											<?php echo($user_order_do->amount); ?>
										</span>
										<br />
									<?php } ?>
								<?php } ?>
							<?php } ?>
							<hr />
						<?php } ?>
					</div>
					<br clear="all" />
				<?php } ?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
<?php

	class RaidUserRegistrationView extends AbstractView {
		public function displayMobile(array $do_list) {
			header('Content-Type: application/json');
		
			echo json_encode($do_list);
		}
		
		public function displayWeb(array $do_list) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<?php
					foreach($do_list as $do) {
						?>
							<div style="border:1px solid #000;">
								<div style="float:right;padding-right:10px;">
									<form action="" method="post">
										<input
											name="raid_id"
											type="hidden"
											value="<?php echo($do->raid_id); ?>" />
										<input
											name="raid_user_registration"
											type="submit"
											value="Jelentkezés"
											style="width:100%;" />
									</form>
								</div>
								<div>
									<h3>
										<a href="<?php echo($do->tavern_website_url); ?>" target="_blank">
											<?php echo($do->tavern_name); ?>
										</a>
									</h3>
									<p>Raid azonosító: <?php echo($do->raid_id); ?></p>
									<p><?php echo($do->raid_description); ?></p>
									<p>
										<?php echo($do->tavern_city); ?>
										<?php echo($do->tavern_postal_code); ?>
										<?php echo($do->tavern_street_name); ?>
										<?php echo($do->tavern_street_number); ?>
										<?php echo($do->tavern_latitude); ?>
										<?php echo($do->tavern_longitude); ?>
									</p>
								</div>
							</div>
							<br clear="all"/>
						<?php
					}
				?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
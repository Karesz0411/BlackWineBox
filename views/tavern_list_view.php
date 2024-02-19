<?php

	class TavernListView extends AbstractView {
		public function displayMobile(array $tavern_do_list) {
			header('Content-Type: application/json');
			
			echo json_encode(
				/*array_merge(
					$tavern_do_list,
					UserMessagesHelper::getAllMessages()
				)*/
				$tavern_do_list
			);
		}
		
		public function displayWeb(array $tavern_do_list) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<?php
					foreach($tavern_do_list as $tavern_do) {
						?>
							<pre>
								<?php print_r($tavern_do) ?>
							</pre>
						<?php
						$tavern_image_file_name = 'tavern_' . $tavern_do->id . '_small.png';
						if (
							file_exists(
								TavernRaidRequestResponseHelper::$root . 
								'/cdn/' . 
								$tavern_image_file_name
							)
						) {
							echo(
								'<img src="' . 
								TavernRaidRequestResponseHelper::$url_root . 
								'/cdn/' . 
								$tavern_image_file_name . 
								'" />'
							);
						}
						?>
							<p><a href="/tavernraid/web/image/upload">Upload tavern image...</a></p>
						<?php
					}
				?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
<?php

	class WineListView extends AbstractView {
		public function displayMobile(array $wine_do_list) {
			header('Content-Type: application/json');
			
			echo json_encode(
				/*array_merge(
					$wine_do_list,
					UserMessagesHelper::getAllMessages()
				)*/
				$wine_do_list
			);
		}
		
		public function displayWeb(array $wine_do_list) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<?php
					foreach($wine_do_list as $wine_do) {
						?>
							<pre>
								<?php print_r($wine_do) ?>
							</pre>
						<?php
						$wine_image_file_name = 'wine_' . $wine_do->id . '_small.png';
						if (
							file_exists(
								TavernRaidRequestResponseHelper::$root . 
								'/cdn/' . 
								$wine_image_file_name
							)
						) {
							echo(
								'<img src="' . 
								TavernRaidRequestResponseHelper::$url_root . 
								'/cdn/' . 
								$wine_image_file_name . 
								'" />'
							);
						}
						?>
							<p><a href="/tavernraid/web/wine/upload">Upload wine...</a></p>
						<?php
					}
				?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
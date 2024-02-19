<?php

	class AchievementListView extends AbstractView {
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
							<pre>
								<?php print_r($do) ?>
							</pre>
						<?php
						$achievement_image_file_name = 'achievement_' . $do->id . '_small.png';
						if (
							file_exists(
								TavernRaidRequestResponseHelper::$root . 
								'/cdn/' . 
								$achievement_image_file_name
							)
						) {
							echo(
								'<img src="' . 
								TavernRaidRequestResponseHelper::$url_root . 
								'/cdn/' . 
								$achievement_image_file_name . 
								'" />'
							);
						}
						?>
							<p><a href="/tavernraid/web/image/upload">Upload achievement image...</a></p>
						<?php
					}
				?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
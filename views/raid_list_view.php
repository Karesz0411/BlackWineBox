<?php

	class RaidListView extends AbstractView {
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
					}
				?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>
<?php
	
	class BoxConfigurationsListView extends AbstractView {
		
		public function displayWeb($box_configuration_do_list) {
			$this->getWebHeader();

			foreach ($box_configuration_do_list as $do) {
				foreach ($do->getAttributeArray() as $key => $value) {
					if ( $value ) echo("<p>" . $key . ": " . $value . "</p>");
				}
				?><hr><?php
			}
			
			?>
			
			<?php
				$box_configuration_image_file_name = 'boxconfigurationimage_' . $_COOKIE['uid'] . '_small.png';
				if (
					file_exists(
						RequestResponseHelper::$root . 
						'/cdn/' . 
						$box_configuration_image_file_name
					)
				) {
					echo(
						'<img src="' . 
						RequestResponseHelper::$url_root . 
						'/cdn/' . 
						$box_configuration_image_file_name . 
						'" />'
					);
				}
			?>
			
			<?php $this->getWebFooter();?>
			<?php
		}
	}
?>
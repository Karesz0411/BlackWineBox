<?php
	
	class WineAttributesListView extends AbstractView {
		
		public function displayWeb($wine_attributes_do_list) {
			$this->getWebHeader();

			foreach ($wine_attributes_do_list as $do) {
				foreach ($do->getAttributeArray() as $key => $value) {
					if ( $value ) echo("<p>" . $key . ": " . $value . "</p>");
				}
				?><hr><?php
			}
			
			?>
			
			<?php $this->getWebFooter();?>
			<?php
		}
	}
?>
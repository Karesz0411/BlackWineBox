<?php
	
	class WineAttributesListView extends AbstractView {
		
		public function displayWeb($wine_attributes_do_list) {
			$this->getWebHeader();

			foreach ($wine_attributes_do_list as $do) {
				foreach ($do->getAttributeArray() as $key => $value) {
					echo("<p>" . $key . ": " . $value . "</p>");
				}
			}
			
			?>
			
			<?php $this->getWebFooter();?>
			<?php
		}
	}
?>
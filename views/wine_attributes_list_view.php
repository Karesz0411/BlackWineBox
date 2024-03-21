<?php
	
	class WineAttributesListView extends AbstractView {
		
		public function displayWeb($wine_attributes_do_list) {
			$this->getWebHeader();

			foreach ($wine_attributes_do_list as $do) {
				foreach ($do->getAttributeArray() as $key => $value) {
					if ( $value ) echo("<div class=\"key_value_container\"><div class=\"key\">" . $key . ":</div><div class=\"value\">" . $value . "</div></div>");
				}
				?><hr><?php
			}
			
			?>
			
			<?php $this->getWebFooter();?>
			<?php
		}
	}
?>
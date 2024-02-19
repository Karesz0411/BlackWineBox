<?php
	
	class ViewDo {
		public $root_title = 'BlackWineBox';
		public $root_link;
		public $titles;
		public $links;
		
		function __construct(array $titles, array $links) {
			$this->root_link = RequestResponseHelper::$url_root;
			$this->links = $links;
			$this->titles = $titles;
		}
		
		public function getPageTitle() {
			$page_full_html_title = '';
			$page_full_html_title .= "<a href=\"" . $this->root_link . "\">";
			$page_full_html_title .= $this->root_title . "</a>&nbsp;&gt;&nbsp;";
						
			foreach ($this->titles as $key => $value) {
				
				if (isset($this->links[$key])) {
					$page_full_html_title .= "<a href=\"" . $this->links[$key] . "\">";
					$page_full_html_title .= $value;
					$page_full_html_title .= "</a>&nbsp;&gt;&nbsp;";
				}
				else {
					$page_full_html_title .= $value . "&nbsp;&gt;&nbsp;";
				}
			}
			
			return substr($page_full_html_title, 0, strlen($page_full_html_title) - 16);
		}
		
		public function getWebTitle() {
			return $this->titles[sizeof($this->titles) - 1];
		}
	}
	
?>
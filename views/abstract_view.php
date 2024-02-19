<?php
	
	class AbstractView {
		public $do;
		
		function __construct(ViewDo $do) {
			$this->do = $do;
		}
		
		public function getWebHeader() {
			?>
				<!DOCTYPE html>
				<html>
				<head>
					<meta charset="UTF-8">
					
					<title><?php echo($this->do->getWebTitle())?></title>

					<meta http-equiv="Cache-Control" content="no-store" />
					<meta name="viewport" content="width=device-width, initial-scale=1">

					<link rel="stylesheet" href="/css/index.css" type="text/css" />

					<script language="JavaScript" type="text/javascript" src="/js/jquery.min.js"></script>
					<script language="JavaScript" type="text/javascript" src="/js/index.js"></script>
				</head>
				
				<body id="main">
				<div id="container">
				
				<div id="menu">
					<?php
						require(TavernRaidRequestResponseHelper::$root . '/views/abstract_menu_view.php');
					?>
					<h1>
						<?php
							echo($this->do->getPageTitle());
						?>
					</h1>
			<?php
		}
		
		public function getWebFooter() {
			?>
				<div id="messages">
					<pre>
						<?php 
							print_r(UserMessagesHelper::getAllMessages());
						?>
					</pre>
				</div>
					
				</body>
				</html>
			<?php
		}
	}
	
?>
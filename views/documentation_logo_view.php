<?php
	
	class DocumentationLogoView extends AbstractView {
		public function displayWeb() {
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
				
				<body
					id="main"
					style="width:95%;height:100%;text-align:center;vertical-align:middle;background-color:#7579a5;"
				>
				
						<img
							src="/images/logo/Logo_TransparentBackground.png" 
							style="height:1000px;"
						/>
					</div>
					
				</body>
				</html>
				
			<?php
		}
	}
?>
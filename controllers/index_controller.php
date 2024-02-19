<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo(RequestResponseHelper::$html_title);?></title>

	<meta http-equiv="Cache-Control" content="no-store" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="/css/index.css" type="text/css" />

	<script language="JavaScript" type="text/javascript" src="/js/jquery.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="/js/index.js"></script>
</head>

<body id="main">
<div id="container">
	
	<h1><?php echo(RequestResponseHelper::$html_title);?></h1>
	<?php
		require(RequestResponseHelper::$root . '/views/abstract_menu_view.php');
	?>
	<br style="clear:both;" />
	<hr/>
</body>
</html>

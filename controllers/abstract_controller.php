<?php
	$do = new AbstractDo();
	
	$do->abstract_attribute = empty($_POST['abstract_attribute']) ? $_GET['abstract_attribute'] : $_POST['abstract_attribute'];
	$do->abstract_attribute = empty($_POST['abstract_attribute']) ? $_GET['abstract_attribute'] : $_POST['abstract_attribute'];
	
	if ($_POST['form_submission'] === "Regisztrálás" || $_GET['hack_on']) {
		
	}

	/**
	 * Mobile version view
	 */
	if (RequestResponseHelper::$method == 'mobile') {
		header('Content-Type: application/json');
		
		echo json_encode( //TODO: Mit kellene küldeni a mobilosnak? [trisssz]
			AbstractMessagesHelper::getAllMessages()
		);
	}
	/**
	 * Web
	 */
	else {
			
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		
		<title><?php echo(RequestResponseHelper::$html_title);?> > AbstractTitle</title>

		<meta http-equiv="Cache-Control" content="no-store" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="/css/index.css" type="text/css" />

		<script language="JavaScript" type="text/javascript" src="/js/jquery.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="/js/index.js"></script>
	</head>

	<body id="main">
	<div id="container">
		
		<h1><?php echo(RequestResponseHelper::$html_title);?> > AbstractTitle</h1>
		
		<form action="" method="post">
			<label for="nick_name">Felhasználónév</label>
			<input
				name="nick_name"
				type="text"
				value="<?php echo($do->nick_name); ?>"
			/>
			<br />
			<label for="email">Email-cím</label>
			<input name="email" type="text" value="<?php echo($do->email); ?>" />
			<br />
			<input name="form_submission" type="submit" value="Regisztrálás"/>
		</form>
		
		<div id="messages">
			<?php 
				print_r(UserMessagesHelper::getAllMessages());
			?>
		</div>
		
	</body>
	</html>
<?php } ?>
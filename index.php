<?php
	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");

	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);
	
	require(dirname(__FILE__) . '/models/helpers/request_response_helper.php');
	
	RequestResponseHelper::$root         = dirname(__FILE__);
	// Get the requested URI
	// Remove leading and trailing slashes and explode the URI by slashes
	RequestResponseHelper::$path         = trim($_SERVER['REQUEST_URI'], '/');
	RequestResponseHelper::$url_root     = "https://blackwinebox.localhost";
	//RequestResponseHelper::$url_root     = "blackwinebox.localhost";
	RequestResponseHelper::$html_title   = "BlackWineBox";
	
	require(RequestResponseHelper::$root . '/models/helpers/log_helper.php');
	require(RequestResponseHelper::$root . '/models/helpers/user_messages_helper.php');
	require(RequestResponseHelper::$root . '/models/dos/abstract_do.php');
	
	require(RequestResponseHelper::$root . '/models/dos/image_abstract_do.php');
	require(RequestResponseHelper::$root . '/models/dos/parent_image_abstract_do.php');
	require(RequestResponseHelper::$root . '/models/dos/multiple_image_abstract_do.php');
	require(RequestResponseHelper::$root . '/models/dos/user_do.php');

	require (RequestResponseHelper::$root . '/PHPMailer/src/PHPMailer.php');
	require (RequestResponseHelper::$root . '/PHPMailer/src/Exception.php');
	require (RequestResponseHelper::$root . '/PHPMailer/src/SMTP.php');

	LogHelper::add('--------------------------------------------------------------------------------');
	LogHelper::add(date('Y-m-d H:i:s', time()));
	LogHelper::add('Starting up engines...');

	/* ********************************************************
	 * *** Here is the main controlling logic... **************
	 * ********************************************************/
	RequestResponseHelper::$request = empty(explode('/', RequestResponseHelper::$path)[0]) ?
		[0 => 'index', 1 => 'index'] :
		explode('/', RequestResponseHelper::$path)
	;

	RequestResponseHelper::$actor_name   = RequestResponseHelper::$request[0];
	RequestResponseHelper::$actor_action = RequestResponseHelper::$request[1];

	require(RequestResponseHelper::$root . '/require.php');

	LogHelper::add('Request: ' . RequestResponseHelper::$path);
	LogHelper::add(RequestResponseHelper::$root . '/controllers/' . RequestResponseHelper::$actor_name . '_controller.php');

	/* ********************************************************
	 * *** User autohorization ********************************
	 * ********************************************************/
	$GLOBALS['is_user_authorized'] = false;
	$security_bo = new SecurityBo();
	$security_bo->doUserAuthorization();

	/* ********************************************************
	 * *** Lets require files by request... *******************
	 * ********************************************************/
	$do_factory = new DoFactory();
	$bo_factory = new BoFactory();
	require(
		RequestResponseHelper::$root . '/controllers/' . 
		RequestResponseHelper::$actor_name . '_controller.php'
	);
?>

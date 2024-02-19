<?php
	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");

	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);
	
	require(dirname(__FILE__) . '/models/helpers/request_response_helper.php');
	
	RequestResponseHelper::$root     = dirname(__FILE__);
	RequestResponseHelper::$path     = $_GET['path'];
	RequestResponseHelper::$url_root = "https://localhost/BlackWineBox";
	
	require(RequestResponseHelper::$root . '/models/helpers/log_helper.php');
	require(RequestResponseHelper::$root . '/models/helpers/user_messages_helper.php');
	require(RequestResponseHelper::$root . '/models/dos/abstract_do.php');
	
	require(RequestResponseHelper::$root . '/models/dos/image_abstract_do.php');
	require(RequestResponseHelper::$root . '/models/dos/parent_image_abstract_do.php');
	require(RequestResponseHelper::$root . '/models/dos/multiple_image_abstract_do.php');
	require(RequestResponseHelper::$root . '/models/dos/user_do.php');
	
	LogHelper::add('--------------------------------------------------------------------------------');
	LogHelper::add(date('Y-m-d H:i:s', time()));
	LogHelper::add('Starting up engines...');

	/* ********************************************************
	 * *** Here is the main controlling logic... **************
	 * ********************************************************/
	RequestResponseHelper::$request = empty(explode('/', RequestResponseHelper::$path)[2]) ?
		[2 => 'index'] :
		explode('/', RequestResponseHelper::$path)
	;
	RequestResponseHelper::$project_name = RequestResponseHelper::$request[0];
	RequestResponseHelper::$method       = RequestResponseHelper::$request[1];
	RequestResponseHelper::$actor_name   = RequestResponseHelper::$request[2];
	RequestResponseHelper::$actor_action = RequestResponseHelper::$request[3];

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

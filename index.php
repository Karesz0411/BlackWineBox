<?php
	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");

	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);
	
	require(dirname(__FILE__) . '/models/helpers/black_wine_box_request_response_helper.php');
	
	BlackWineBoxRequestResponseHelper::$root     = dirname(__FILE__);
	BlackWineBoxRequestResponseHelper::$path     = $_GET['path'];
	BlackWineBoxRequestResponseHelper::$url_root = "https://theapp.artidas.hu/black_wine_box";
	
	require(BlackWineBoxRequestResponseHelper::$root . '/models/helpers/black_wine_box_log_helper.php');
	require(BlackWineBoxRequestResponseHelper::$root . '/models/helpers/user_messages_helper.php');
	require(BlackWineBoxRequestResponseHelper::$root . '/models/dos/black_wine_box_abstract_do.php');
	
	require(BlackWineBoxRequestResponseHelper::$root . '/models/dos/black_wine_box_image_abstract_do.php');
	require(BlackWineBoxRequestResponseHelper::$root . '/models/dos/black_wine_box_parent_image_abstract_do.php');
	require(BlackWineBoxRequestResponseHelper::$root . '/models/dos/black_wine_box_multiple_image_abstract_do.php');
	require(BlackWineBoxRequestResponseHelper::$root . '/models/dos/user_do.php');
	
	BlackWineBoxLogHelper::add('--------------------------------------------------------------------------------');
	BlackWineBoxLogHelper::add(date('Y-m-d H:i:s', time()));
	BlackWineBoxLogHelper::add('Starting up engines...');

	/* ********************************************************
	 * *** Here is the main controlling logic... **************
	 * ********************************************************/
	BlackWineBoxRequestResponseHelper::$request = empty(explode('/', BlackWineBoxRequestResponseHelper::$path)[2]) ?
		[2 => 'index'] :
		explode('/', BlackWineBoxRequestResponseHelper::$path)
	;
	BlackWineBoxRequestResponseHelper::$project_name = BlackWineBoxRequestResponseHelper::$request[0];
	BlackWineBoxRequestResponseHelper::$method       = BlackWineBoxRequestResponseHelper::$request[1];
	BlackWineBoxRequestResponseHelper::$actor_name   = BlackWineBoxRequestResponseHelper::$request[2];
	BlackWineBoxRequestResponseHelper::$actor_action = BlackWineBoxRequestResponseHelper::$request[3];

	require(BlackWineBoxRequestResponseHelper::$root . '/require.php');

	BlackWineBoxLogHelper::add('Request: ' . BlackWineBoxRequestResponseHelper::$path);
	BlackWineBoxLogHelper::add(BlackWineBoxRequestResponseHelper::$root . '/controllers/' . BlackWineBoxRequestResponseHelper::$actor_name . '_controller.php');

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
		BlackWineBoxRequestResponseHelper::$root . '/controllers/' . 
		BlackWineBoxRequestResponseHelper::$actor_name . '_controller.php'
	);
?>

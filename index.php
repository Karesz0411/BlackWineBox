<?php
	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");

	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);
	
	require(dirname(__FILE__) . '/models/helpers/tavernraid_request_response_helper.php');
	
	TavernRaidRequestResponseHelper::$root     = dirname(__FILE__);
	TavernRaidRequestResponseHelper::$path     = $_GET['path'];
	TavernRaidRequestResponseHelper::$url_root = "https://theapp.artidas.hu/tavernraid";
	
	require(TavernRaidRequestResponseHelper::$root . '/models/helpers/tavernraid_log_helper.php');
	require(TavernRaidRequestResponseHelper::$root . '/models/helpers/user_messages_helper.php');
	require(TavernRaidRequestResponseHelper::$root . '/models/dos/tavernraid_abstract_do.php');
	
	require(TavernRaidRequestResponseHelper::$root . '/models/dos/tavernraid_image_abstract_do.php');
	require(TavernRaidRequestResponseHelper::$root . '/models/dos/tavernraid_parent_image_abstract_do.php');
	require(TavernRaidRequestResponseHelper::$root . '/models/dos/tavernraid_multiple_image_abstract_do.php');
	require(TavernRaidRequestResponseHelper::$root . '/models/dos/user_do.php');
	
	TavernRaidLogHelper::add('--------------------------------------------------------------------------------');
	TavernRaidLogHelper::add(date('Y-m-d H:i:s', time()));
	TavernRaidLogHelper::add('Starting up engines...');

	/* ********************************************************
	 * *** Here is the main controlling logic... **************
	 * ********************************************************/
	TavernRaidRequestResponseHelper::$request = empty(explode('/', TavernRaidRequestResponseHelper::$path)[2]) ?
		[2 => 'index'] :
		explode('/', TavernRaidRequestResponseHelper::$path)
	;
	TavernRaidRequestResponseHelper::$project_name = TavernRaidRequestResponseHelper::$request[0];
	TavernRaidRequestResponseHelper::$method       = TavernRaidRequestResponseHelper::$request[1];
	TavernRaidRequestResponseHelper::$actor_name   = TavernRaidRequestResponseHelper::$request[2];
	TavernRaidRequestResponseHelper::$actor_action = TavernRaidRequestResponseHelper::$request[3];

	require(TavernRaidRequestResponseHelper::$root . '/require.php');

	TavernRaidLogHelper::add('Request: ' . TavernRaidRequestResponseHelper::$path);
	TavernRaidLogHelper::add(TavernRaidRequestResponseHelper::$root . '/controllers/' . TavernRaidRequestResponseHelper::$actor_name . '_controller.php');

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
		TavernRaidRequestResponseHelper::$root . '/controllers/' . 
		TavernRaidRequestResponseHelper::$actor_name . '_controller.php'
	);
?>

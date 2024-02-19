<?php
	/*******************************
	 *************VIEWS*************
	 ******************************/
	require(RequestResponseHelper::$root . '/views/abstract_view.php');
	require(RequestResponseHelper::$root . '/views/user_profile_view.php');	 
	require(RequestResponseHelper::$root . '/views/documentation_index_view.php');
	require(RequestResponseHelper::$root . '/views/documentation_logo_view.php');
	require(RequestResponseHelper::$root . '/views/user_registration_view.php');
	require(RequestResponseHelper::$root . '/views/user_login_view.php');
	require(RequestResponseHelper::$root . '/views/user_profile_image_upload_view.php');
	require(RequestResponseHelper::$root . '/views/image_upload_view.php');
	require(RequestResponseHelper::$root . '/views/item_create_view.php');
	
	 /*******************************
	 *************MODELS*************
	 *******************************/
	 
		/****************************
		*************BOS*************
		****************************/
		require(RequestResponseHelper::$root . '/models/bos/mysql_database_connection_bo.php');
		require(RequestResponseHelper::$root . '/models/bos/image_file_bo.php');
		require(RequestResponseHelper::$root . '/models/bos/image_bo.php');
		require(RequestResponseHelper::$root . '/models/bos/user_bo.php');
		require(RequestResponseHelper::$root . '/models/bos/security_bo.php');
		require(RequestResponseHelper::$root . '/models/bos/item_bo.php');
		
		/*****************************
		*************DAOS*************
		*****************************/
		require(RequestResponseHelper::$root . '/models/daos/user_dao.php');
		require(RequestResponseHelper::$root . '/models/daos/common_dao.php');
		require(RequestResponseHelper::$root . '/models/daos/security_dao.php');
		require(RequestResponseHelper::$root . '/models/daos/item_dao.php');
		
		/*****************************
		*************DOS**************
		*****************************/
		require(RequestResponseHelper::$root . '/models/dos/view_do.php');
		require(RequestResponseHelper::$root . '/models/dos/image_do.php');
		require(RequestResponseHelper::$root . '/models/dos/user_profile_image_do.php');
		require(RequestResponseHelper::$root . '/models/dos/item_do.php');	
		require(RequestResponseHelper::$root . '/models/dos/logo_do.php');

		
		/********************************
		*************HELPERS*************
		********************************/
		require(RequestResponseHelper::$root . '/models/helpers/string_helper.php');
		
		/**********************************
		*************FACTORIES*************
		**********************************/
		require(RequestResponseHelper::$root . '/models/factories/do_factory.php');
		require(RequestResponseHelper::$root . '/models/factories/bo_factory.php');
		require(RequestResponseHelper::$root . '/models/factories/dao_factory.php');
?>
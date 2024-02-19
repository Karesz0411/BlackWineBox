<?php
	/*******************************
	 *************VIEWS*************
	 ******************************/
	require(TavernRaidRequestResponseHelper::$root . '/views/abstract_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_profile_view.php');	 
	require(TavernRaidRequestResponseHelper::$root . '/views/documentation_index_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/documentation_logo_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/tavern_registration_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_registration_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_login_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_profile_image_upload_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_cover_image_upload_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_raid_moment_create_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_raid_moment_list_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/achievement_create_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/tavern_list_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/image_upload_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/raid_start_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/item_create_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/raid_list_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/raid_user_registration_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/tavern_items_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/order_create_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/achievement_list_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/wine_upload_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/user_achievement_create_view.php');
	require(TavernRaidRequestResponseHelper::$root . '/views/wine_list_view.php');
	
	 /*******************************
	 *************MODELS*************
	 *******************************/
	 
		/****************************
		*************BOS*************
		****************************/
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/mysql_database_connection_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/image_file_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/image_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/user_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/security_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/achievement_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/raid_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/tavern_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/tavern_items_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/item_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/order_bo.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/bos/wine_bo.php');
		
		/*****************************
		*************DAOS*************
		*****************************/
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/user_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/common_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/security_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/achievement_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/raid_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/tavern_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/tavern_items_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/item_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/order_dao.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/daos/wine_dao.php');
		
		/*****************************
		*************DOS**************
		*****************************/
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/view_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/achievement_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/raid_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/raid_reward_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/raid_user_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/tavern_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/tavern_items_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/tavern_item_reward_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/user_raid_achievement_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/user_raid_moment_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/user_raid_points_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/image_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/user_profile_image_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/user_cover_image_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/item_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/raid_tavern_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/order_do.php');		
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/logo_do.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/dos/wine_do.php');

		
		/********************************
		*************HELPERS*************
		********************************/
		require(TavernRaidRequestResponseHelper::$root . '/models/helpers/tavernraid_string_helper.php');
		
		/**********************************
		*************FACTORIES*************
		**********************************/
		require(TavernRaidRequestResponseHelper::$root . '/models/factories/do_factory.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/factories/bo_factory.php');
		require(TavernRaidRequestResponseHelper::$root . '/models/factories/dao_factory.php');
?>
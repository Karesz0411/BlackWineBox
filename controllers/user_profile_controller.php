<?php

	if (empty($_COOKIE['uid'])){
		header(
			"Location: " . 	
			TavernRaidRequestResponseHelper::$url_root . "/" . 
			TavernRaidRequestResponseHelper::$method . "/" . 
			TavernRaidRequestResponseHelper::$actor_name . "/" . 
			"login"
		);
		exit();		
	}
	
	$do = $bo->getById($_COOKIE['uid']);
	
	$view_do = new ViewDo(
		[
			ucfirst(TavernRaidRequestResponseHelper::$actor_name) . " " . 
			ucfirst(TavernRaidRequestResponseHelper::$actor_action)
		],
		[
			TavernRaidRequestResponseHelper::$url_root . "/" . 
			TavernRaidRequestResponseHelper::$method . "/" . 
			TavernRaidRequestResponseHelper::$actor_name . "/" . 
			TavernRaidRequestResponseHelper::$actor_action
		]
	);
	
	$user_profile_view = new UserProfileView($view_do);
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$user_profile_view->displayMobile($do);
	}
	else {
		$user_profile_view->displayWeb($do);
	}
 ?>
<?php
	$do = new UserDo();
	
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
	
	$view = new DocumentationLogoView($view_do);
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$view->displayMobile();
	}
	else {
		$view->displayWeb();
	}
 ?>
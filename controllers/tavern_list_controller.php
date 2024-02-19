<?php
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
	
	$tavern_list_view = new TavernListView($view_do);
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		header('Content-Type: application/json');
		
		$tavern_list_view->displayMobile($bo->getList());
	}
	else {
		$tavern_list_view->displayWeb($bo->getList());
	}
?>
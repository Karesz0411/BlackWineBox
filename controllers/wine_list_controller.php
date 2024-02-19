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
	
	$wine_list_view = new WineListView($view_do);
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		header('Content-Type: application/json');
		
		$wine_list_view->displayMobile($bo->getList());
	}
	else {
		$wine_list_view->displayWeb($bo->getList());
	}
?>
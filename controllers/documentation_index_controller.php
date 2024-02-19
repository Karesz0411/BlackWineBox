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
	
	$documentation_index_view = new DocumentationIndexView($view_do);
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$documentation_index_view->displayMobile();
	}
	else {
		$documentation_index_view->displayWeb($do);
	}
 ?>
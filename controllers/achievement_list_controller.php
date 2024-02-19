<?php
	$do = $do_factory->get(DoFactory::ACHIEVEMENT);
	
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
	
	$achievement_list_view = new AchievementListView($view_do);
	
	$do_list = $bo->getList();
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$achievement_list_view->displayMobile($do_list);
	}
	else {
		$achievement_list_view->displayWeb($do_list);
	}
 ?>
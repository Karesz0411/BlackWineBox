<?php
	$do = $do_factory->get(DoFactory::RAID);
	
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
	
	$raid_list_view = new RaidListView($view_do);
	
	$do_list = $bo->getActiveList();
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$raid_list_view->displayMobile($do_list);
	}
	else {
		$raid_list_view->displayWeb($do_list);
	}
 ?>
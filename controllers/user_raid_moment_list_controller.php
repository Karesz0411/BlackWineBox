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
	
	$view = new UserRaidMomentListView($view_do);
	
	$user_raid_moment_do_list = $bo_factory->
		get(BoFactory::RAID)->
		getUserRaidMomentListWithTavernData($_COOKIE['uid'])
	;
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$view->displayMobile($user_raid_moment_do_list);
	}
	else {
		$view->displayWeb($user_raid_moment_do_list);
	}
 ?>
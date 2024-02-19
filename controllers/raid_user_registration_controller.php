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
	
	$raid_user_registration_view = new RaidUserRegistrationView($view_do);
	
	if (isset($_POST["raid_user_registration"])) {
		if ($bo->registerUserForRaid($_POST["raid_id"], $_COOKIE["uid"])) {
			
			UserMessagesHelper::addToMessages(
				"Sikeresen jelentkeztél a raid-re " . $last_inserted_achievement_id,
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
		else {
			UserMessagesHelper::addToMessages(
				"Nem sikerült jelentkezned a raid-re",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	$do_list = $bo->getRaidListWithTavernData();
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$raid_user_registration_view->displayMobile($do_list);
	}
	else {
		$raid_user_registration_view->displayWeb($do_list);
	}
 ?>
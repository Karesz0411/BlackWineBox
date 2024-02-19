<?php
	$user_do        = $do_factory->get(DoFactory::USER);
	$achievement_do = $do_factory->get(DoFactory::ACHIEVEMENT);
	
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
	
	$view = new UserAchievementCreateView($view_do);
	
	if (isset($_POST['register'])) {
		$user_do->id        = $_POST['user_id'];
		$achievement_do->id = $_POST['achievement_id'];
		
		//TODO: implement checks for the action.
		if ($bo->registerAchievementForUser($user_do, $achievement_do)) {
			UserMessagesHelper::addToMessages(
				'Successfully registered achievement for the user...',
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
		else {
			UserMessagesHelper::addToMessages(
				'Error!!! Failed to register achievement for the user!',
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	$user_do_list        = $bo_factory->get(BoFactory::USER)->getUserListForTavernRegistration();
	$achievement_do_list = $bo_factory->get(BoFactory::ACHIEVEMENT)->getList();
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$view->displayMobile();
	}
	else {
		$view->displayWeb(
			$user_do_list,
			$achievement_do_list,
			$user_do,
			$achievement_do
		);
	}
 ?>
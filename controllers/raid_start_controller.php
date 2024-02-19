<?php
	if (
		empty(
			(new BoFactory())
				->get(BoFactory::TAVERN)
				->getListByUserId($_COOKIE['uid'])
		)
	) {
		header("Location: " . TavernRaidRequestResponseHelper::$url_root . "/web/tavern/registration");
	}

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
	
	$raid_start_view = new RaidStartView($view_do);
	
	$page_form_attributes = [
		'tavern_id',
		'from_datetime',
		'to_datetime',
		'number_of_user',
		'description'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	if (isset($_POST[$page_form_attributes[0]])) {
		$bo->validateRaidStart($do);
		
		if (empty(UserMessagesHelper::$errors)) {
				UserMessagesHelper::addToMessages(
				"The raid start was successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
			
			$bo->create($do);
		}
		else {
			UserMessagesHelper::addToMessages(
				"The raid start was not successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
	}
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$raid_start_view->displayMobile();
	}
	else {
		$raid_start_view->displayWeb($do);
	}
 ?>
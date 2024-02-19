<?php
	header('Content-Type: text/html; charset=utf-8');

	$bo = $bo_factory->get(BoFactory::RAID);

	/* ********************************************************
	* *** Lets control exectution by actor action... *********
	* ********************************************************/
	switch (TavernRaidRequestResponseHelper::$actor_action) {
		case '':
			TavernRaidRequestResponseHelper::addToResponse('available_actor_actions', [
			TavernRaidRequestResponseHelper::$url_root . '/' . TavernRaidRequestResponseHelper::$actor_name . '/registration'
			]);
			break;
		default:
			require(
				TavernRaidRequestResponseHelper::$root . '/controllers/' .
				TavernRaidRequestResponseHelper::$actor_name . '_' . 
				TavernRaidRequestResponseHelper::$actor_action . '_controller.php'
			);
	}

	foreach(LogHelper::get() as $log_message) {
		TavernRaidRequestResponseHelper::addToResponse('log', $log_message);
	}
?>

<?php
	header('Content-Type: text/html; charset=utf-8');

	$bo = $bo_factory->get(BoFactory::ITEM);

	/* ********************************************************
	* *** Lets control exectution by actor action... *********
	* ********************************************************/
	switch (RequestResponseHelper::$actor_action) {
		case '':
			RequestResponseHelper::addToResponse('available_actor_actions', [
				RequestResponseHelper::$url_root . '/' . RequestResponseHelper::$actor_name . '/create'
			]);
			break;
		default:
			require(
				RequestResponseHelper::$root . '/controllers/' .
				RequestResponseHelper::$actor_name . '_' . 
				RequestResponseHelper::$actor_action . '_controller.php'
			);
	}

	foreach(LogHelper::get() as $log_message) {
		RequestResponseHelper::addToResponse('log', $log_message);
	}
?>

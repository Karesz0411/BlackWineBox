<?php
	header('Content-Type: text/html; charset=utf-8');

	/* ********************************************************
	 * *** Lets control exectution by actor action... *********
	 * ********************************************************/
	switch (TavernRaidRequestResponseHelper::$actor_action) {
		case '':
			TavernRaidRequestResponseHelper::addToResponse('available_actor_actions', [
				TavernRaidRequestResponseHelper::$url_root . '/' . TavernRaidRequestResponseHelper::$actor_name . '/index'
			]);
			break;
		default:
			require(TavernRaidRequestResponseHelper::$root . '/controllers/' . TavernRaidRequestResponseHelper::$actor_name . '_' . TavernRaidRequestResponseHelper::$actor_action . '_controller.php');
	}
?>

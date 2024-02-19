<?php
	$user_do             = $do_factory->get(DoFactory::USER);
	$raid_do             = $do_factory->get(DoFactory::RAID);
	$user_raid_moment_do = $do_factory->get(DoFactory::USER_RAID_MOMENT);
	
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
	
	$view = new UserRaidMomentCreateView($view_do);
	
	if (isset($_POST['create'])) {
		$user_raid_moment_do->user_id     = $_POST['user_id'];
		$user_raid_moment_do->raid_id     = $_POST['raid_id'];
		$user_raid_moment_do->description = $_POST['description'];
		
		//TODO: implement checks for the action.
		$user_raid_moment_do->id = $bo->createRaidMomentForUser($user_raid_moment_do);
		if ($user_raid_moment_do->id) {
			$image_file_bo = new ImageFileBo($_FILES['image_file'], $user_raid_moment_do);
			
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
	else {
		UserMessagesHelper::addToMessages(
			'No form submission have happened...',
			UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
		);
	}
	
	$user_do_list        = $bo_factory->get(BoFactory::USER)->getUserListForTavernRegistration();
	$raid_tavern_do_list = $bo_factory->get(BoFactory::RAID)->getRaidListWithTavernData();
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$view->displayMobile();
	}
	else {
		$view->displayWeb(
			$user_do_list,
			$raid_tavern_do_list,
			$user_raid_moment_do
		);
	}
 ?>
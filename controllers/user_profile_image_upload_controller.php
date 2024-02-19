<?php
	$do = $do_factory->get(DoFactory::USER_PROFILE_IMAGE);
	$do->id = $_COOKIE['uid'];
	
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
	
	$view = new UserProfileImageUploadView($view_do);
	
	if (isset($_FILES['image_file'])) {
		$image_do = $do_factory->get(DoFactory::USER_PROFILE_IMAGE);
		$image_do->user_id = $do->id;
		
		if (true) { //TODO: implement checks for the image upload.
			$image_file_bo = new ImageFileBo($_FILES['image_file'], $do);
			
			UserMessagesHelper::addToMessages(
				"Sikeresen feltöltve a file...",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
		else {
			UserMessagesHelper::addToMessages(
				"Sikertelen filefeltöltés...",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	else {
		UserMessagesHelper::addToMessages(
			'Nem érkezett file a feltöltéshez...',
			UserMessagesHelper::MESSAGE_LEVEL_ERROR
		);
	}
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$view->displayMobile();
	}
	else {
		$view->displayWeb();
	}
 ?>
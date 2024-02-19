<?php
	$do = $do_factory->get(isset($_POST['actor']) ? $_POST['actor'] : DoFactory::IMAGE);
	
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
	
	$image_upload_view = new ImageUploadView($view_do);

	$page_form_attributes = [
		'actor',
		'id'
	];
	if (isset($_POST[$page_form_attributes[0]])) {
		foreach($page_form_attributes as $key => $value) {
			$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
		}
		
		if ($bo->isValid($do)) {
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
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {	
		$image_upload_view->displayMobile();
	}
	else {
		$image_upload_view->displayWeb($do, $do_factory);
	}
?>

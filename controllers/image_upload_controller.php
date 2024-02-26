<?php
	$do = $do_factory->get(isset($_POST['actor']) ? $_POST['actor'] : DoFactory::IMAGE);
	
	$view_do = new ViewDo(
		[
			ucfirst(RequestResponseHelper::$actor_name) . " " . 
			ucfirst(RequestResponseHelper::$actor_action)
		],
		[
			RequestResponseHelper::$url_root . "/" . 
			RequestResponseHelper::$actor_name . "/" . 
			RequestResponseHelper::$actor_action
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

	$image_upload_view->displayWeb($do, $do_factory);
?>

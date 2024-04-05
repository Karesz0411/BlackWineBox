<?php
	$do = $do_factory->get(DoFactory::USER);
	
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

	$user_reset_password_view = new UserResetPasswordView($view_do);
	
	$page_form_attributes = [
		'new_password',
		'new_password_again'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}

	if (isset($_POST[$page_form_attributes[0]])) {
		$bo->isPasswordRestorationValid($do);
		
		if (empty(UserMessagesHelper::$errors)) {
				UserMessagesHelper::addToMessages(
				"The password restoration was successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);

			$bo->setNewPassword($bo->getById($_COOKIE['uid'])); //IMPORTANT: Think it through: if the cookie expires, then what? So implement a temporary cookie!
			header("Location: " . 
				RequestResponseHelper::$url_root . "/" . 
				RequestResponseHelper::$actor_name . "/" . "login");
		}
		else {
			UserMessagesHelper::addToMessages(
				"The password restoration was not successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
	}
	
	$user_registration_view->displayWeb($do);
?>

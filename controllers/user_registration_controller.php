<?php
	$do = $do_factory->get(DoFactory::USER);
	
	$view_do = new ViewDo(
		[
			ucfirst(RequestResponseHelper::$actor_name) . " " . 
			ucfirst(RequestResponseHelper::$actor_action)
		],
		[
			RequestResponseHelper::$url_root . "/" . 
			RequestResponseHelper::$method . "/" . 
			RequestResponseHelper::$actor_name . "/" . 
			RequestResponseHelper::$actor_action
		]
	);
	
	$user_registration_view = new UserRegistrationView($view_do);
	
	$page_form_attributes = [
		'nick_name',
		'email',
		'password',
		'password_again',
		'birthday_at'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	if (isset($_POST[$page_form_attributes[0]])) {
		$bo->isRegistrationValid($do);
		
		if (empty(UserMessagesHelper::$errors)) {
				UserMessagesHelper::addToMessages(
				"The registration was successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
			
			$bo->create($do);
			header("Location: " . 
				RequestResponseHelper::$url_root . "/" . 
				RequestResponseHelper::$method . "/" . 
				RequestResponseHelper::$actor_name . "/" . "login");
		}
		else {
			UserMessagesHelper::addToMessages(
				"The registration was not successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
	}
	
	if (RequestResponseHelper::$method == 'mobile') {	
		$user_registration_view->displayMobile();
	}
	else {
		$user_registration_view->displayWeb($do);
	}
?>

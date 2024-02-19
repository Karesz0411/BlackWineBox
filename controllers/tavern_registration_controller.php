<?php
	$do = $do_factory->get(DoFactory::TAVERN);
	
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
	
	$tavern_registration_view = new TavernRegistrationView($view_do);
	
	$page_form_attributes = [
		'display_name',
		'company_name',
		'address_country',
		'address_city',
		'address_postal_code',
		'address_street_name',
		'address_street_number',
		'address_latitude',
		'address_longitude',
		'opened_at',
		'closed_at',
		'phone_number',
		'email',
		'website_url',
		'facebook_url',
		'owner_user_id',
		'administrator_user_id'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	$do->administrator_user_id = $_COOKIE['uid'];
	if (isset($_POST[$page_form_attributes[0]])) {
		$bo->isRegistrationValid($do);
		
		if (empty(UserMessagesHelper::$errors)) {
				UserMessagesHelper::addToMessages(
				"The registration was successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
			
			$bo->create($do);
		}
		else {
			UserMessagesHelper::addToMessages(
				"The registration was not successful!",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
	}
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$tavern_registration_view->displayMobile();
	}
	else {
		$tavern_registration_view->displayWeb($do, $user_bo);
	}
 ?>
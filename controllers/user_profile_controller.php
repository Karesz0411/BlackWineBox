<?php
	$do = $do_factory->get(DoFactory::USER);
	
	if (empty($_COOKIE['uid'])){
		header(
			"Location: " . 	
			RequestResponseHelper::$url_root . "/" . 
			RequestResponseHelper::$actor_name . "/" . 
			"login"
		);
		exit();		
	}
	
	$do = $bo->getById($_COOKIE['uid']);
	
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
	$user_profile_view = new UserProfileView($view_do);
	$user_profile_view->displayWeb($do);
	echo  "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
	print_r($user_profile_view);
 ?>
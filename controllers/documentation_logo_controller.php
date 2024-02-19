<?php
	$do = new UserDo();
	
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
	
	$view = new DocumentationLogoView($view_do);
	
	if (RequestResponseHelper::$method == 'mobile') {
		$view->displayMobile();
	}
	else {
		$view->displayWeb();
	}
 ?>
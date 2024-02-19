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
	
	$documentation_index_view = new DocumentationIndexView($view_do);
	
	if (RequestResponseHelper::$method == 'mobile') {
		$documentation_index_view->displayMobile();
	}
	else {
		$documentation_index_view->displayWeb($do);
	}
 ?>
<?php
	$do = $do_factory->get(DoFactory::BOX_CONFIGURATION);
    $do_list = $bo->getAll();
	
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

	$box_configuration_list_view = new BoxConfigurationListView($view_do);
	$box_configuration_list_view->displayWeb($do_list);
 ?>
<?php
	$do = $do_factory->get(DoFactory::WINE_ATTRIBUTES);
    $do_list = $bo->getList();
	
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

	$wine_attributes_list_view = new WineAttributesListView($view_do);
	$wine_attributes_list_view->displayWeb($do_list);
 ?>
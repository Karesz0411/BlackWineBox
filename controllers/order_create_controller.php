<?php
	$do = $do_factory->get(DoFactory::ORDER);
	
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
	
	$view = new OrderCreateView($view_do);
	
	$page_form_attributes = [
		'tavern_items_id',
		'amount'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	
	if (isset($_POST['create_order'])) {
		$do->user_id = $_COOKIE['uid'];
		
		if ($order_bo->create($do)) {
				UserMessagesHelper::addToMessages(
				'Order created successfully',
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
		else {
			UserMessagesHelper::addToMessages(
				'ERROR: Was not able to create order!',
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
	}
	
	$tavern_bo = $bo_factory->get(BoFactory::TAVERN);
	
	$tavern_do_list     = $tavern_bo->getList();
	$user_order_do_list = $user_bo->getUserOrders($_COOKIE['uid']);
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$view->displayMobile();
	}
	else {
		$view->displayWeb(
			$do,
			$tavern_do_list,
			$user_order_do_list
		);
	}
 ?>
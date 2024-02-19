<?php
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
	$tavern_items_view = new TavernItemsView($view_do);
	
	$do = $do_factory->get(DoFactory::TAVERN_ITEMS);
	$page_form_attributes = [
		'tavern_id',
		'item_id',
		'price'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	
	if (isset($_POST['tavern_item_price_set'])) {
		if ($bo->setTavernItemPrice($do)) {
			UserMessagesHelper::addToMessages(
				"Sikeresen beállítottuk a tavernhez a tárgy árát.",
				UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
			);
		}
		else {
			UserMessagesHelper::addToMessages(
				"Hiba történt: Nem sikerült beállítani a tavernhez a tárgy árát.",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	$do_list              = $bo->getList();
	$item_do_list         = $item_bo->getList();
	$tavern_items_do_list = $tavern_items_bo->getList();
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$tavern_items_view->displayMobile($do_list);
	}
	else {
		$tavern_items_view->displayWeb(
			$do_list,
			$item_do_list,
			$tavern_items_do_list
		);
	}
 ?>
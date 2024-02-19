<?php
	$do = $do_factory->get(DoFactory::WINE);
	
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
	
	$wine_upload_view = new WineUploadView($view_do);

	$page_form_attributes = [
		'name',
		'winery',
		'production_year',
		'color',
		'sweetness',
		'origin_country',
		'origin_region',
		'origin_city',
		'type',
		'consumption_temperature',
		'bottler',
		'bottle_size',
		'alcohol_percentage_level',
		'ean',
		'cork_type'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	if (isset($_POST[$page_form_attributes[0]])) {
		$do_list = $bo->getList();
		
		foreach($do_list as $list_element) {
			if (
				$list_element->name == $do->name AND
				$list_element->is_alcoholic == $do->is_alcoholic
			) {
				UserMessagesHelper::addToMessages(
					"A megadott adatokkal már létrehoztak egy bort!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
		}
		
		if (empty(UserMessagesHelper::$errors)) {
			$last_inserted_item_id = $bo->create($do);
			
			if ($last_inserted_item_id != null) {
				$do->id = $last_inserted_item_id;
			
				$image_file_bo = new ImageFileBo($_FILES['image_file'], $do);
				
				UserMessagesHelper::addToMessages(
					"Sikeresen létrehoztad a bort! ID: " . $last_inserted_item_id,
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);
			}
		}
		else {
			UserMessagesHelper::addToMessages(
				"A bor létrehozása nem lehetséges a megadott adatokkal.",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {	
		$wine_upload_view->displayMobile();
	}
	else {
		$wine_upload_view->displayWeb($do);
	}
?>
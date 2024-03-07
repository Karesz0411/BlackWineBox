<?php
	$do = $do_factory->get(DoFactory::WINE_ATTRIBUTES);
	
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
	
	$wine_attributes_create_view = new WineAttributesCreateView($view_do);

	$page_form_attributes = [
		'wine_name',
        'aroma',
        'flavor',
        'appearance',
        'alcohol_content',
        'sweetness',
        'making_techniques',
        'ageability',
        'intensity',
        'place_of_production'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	if (isset($_POST[$page_form_attributes[0]])) {
		$do_list = $bo->getList();
		
		foreach($do_list as $list_element) {
			if (
				$list_element->wine_name == $do->wine_name
			) {
				UserMessagesHelper::addToMessages(
					"A megadott adatokkal már létrehoztak egy bor attribútumokat!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
		}
		
		if ($bo->isWineAttributesCreateValid($do)) {
			$last_inserted_wine_attributes_id = $bo->create($do);
			
			if ($last_inserted_wine_attributes_id != null) {
				$do->id = $last_inserted_wine_attributes_id;
				
				UserMessagesHelper::addToMessages(
					"Sikeresen létrehoztad a bor attribútumokat! ID: " . $last_inserted_wine_attributes_id,
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);
			}
		}
		else {
			UserMessagesHelper::addToMessages(
				"A bor attribútumok létrehozása nem lehetséges a megadott adatokkal.",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	$wine_attributes_create_view->displayWeb($do);
?>
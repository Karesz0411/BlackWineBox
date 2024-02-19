<?php
	$do = $do_factory->get(DoFactory::ITEM);
	
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
	
	$item_create_view = new ItemCreateView($view_do);

	$page_form_attributes = [
		'name'
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
					"A megadott adatokkal már létrehoztak egy tárgyat!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
		}
		
		if ($bo->isItemCreateValid($do)) {
			$last_inserted_item_id = $bo->create($do);
			
			if ($last_inserted_item_id != null) {
				$do->id = $last_inserted_item_id;
			
				$image_file_bo = new ImageFileBo($_FILES['image_file'], $do);
				
				UserMessagesHelper::addToMessages(
					"Sikeresen létrehoztad a tárgyat! ID: " . $last_inserted_item_id,
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);
			}
		}
		else {
			UserMessagesHelper::addToMessages(
				"A tárgy létrehozása nem lehetséges a megadott adatokkal.",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	if (RequestResponseHelper::$method == 'mobile') {	
		$item_create_view->displayMobile();
	}
	else {
		$item_create_view->displayWeb($do);
	}
?>
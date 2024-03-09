<?php
	$do = $do_factory->get(DoFactory::BOX_CONFIGURATIONS);
	
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
	
	$box_configurations_create_view = new BoxConfigurationsCreateView($view_do);

	$page_form_attributes = [
		'name',
		'description'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	if (isset($_POST[$page_form_attributes[0]]) && $_POST['create'] == 'Létrehozás') {
		$do_list = $bo->getList();
		
		foreach($do_list as $list_element) {
			if (
				$list_element->wine_name == $do->wine_name
			) {
				UserMessagesHelper::addToMessages(
					"A megadott adatokkal már létrehoztak egy box konfigurációkat!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
		}
		
		if ($bo->isWineAttributesCreateValid($do)) {
			$last_inserted_box_configurations_id = $bo->create($do);
			
			if ($last_inserted_box_configurations_id != null) {
				$do->id = $last_inserted_box_configurations_id;
				
				UserMessagesHelper::addToMessages(
					"Sikeresen létrehoztad a box konfigurációkat! ID: " . $last_inserted_box_configurations_id,
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);
			}
		}
		else {
			UserMessagesHelper::addToMessages(
				"A box konfigurációk létrehozása nem lehetséges a megadott adatokkal.",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	$box_configurations_create_view->displayWeb($do);
?>
<?php
	$do = $do_factory->get(DoFactory::ACHIEVEMENT);
	
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
	
	$achievement_create_view = new AchievementCreateView($view_do);

	$page_form_attributes = [
		'title',
		'description'
	];
	foreach($page_form_attributes as $key => $value) {
		$do->$value = isset($_POST[$value]) ? $_POST[$value] : null;
	}
	if (isset($_POST[$page_form_attributes[0]])) {
		if ($bo->isAchievementCreateValid($do)) {
			$last_inserted_achievement_id = $bo->create($do);
			
			if ($last_inserted_achievement_id != null) {
				$do->id = $last_inserted_achievement_id;
			
				$image_file_bo = new ImageFileBo($_FILES['image_file'], $do);
				
				UserMessagesHelper::addToMessages(
					"Sikeresen létrehoztad a teljesítményt! ID: " . $last_inserted_achievement_id,
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);
			}
		}
		else {
			UserMessagesHelper::addToMessages(
				"A teljesítmény létrehozása nem lehetséges a megadott adatokkal.",
				UserMessagesHelper::MESSAGE_LEVEL_ERROR
			);
		}
	}
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {	
		$achievement_create_view->displayMobile();
	}
	else {
		$achievement_create_view->displayWeb($do);
	}
?>

<?php
	$do = $do_factory->get(DoFactory::USER);
	
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
	
	$user_login_view = new UserLoginView($view_do);
	
	if ($_POST['login'] == "Bejelentkezés" || $_GET['mo']) {
		$do->email = empty($_POST['email']) ? $_GET['email'] : $_POST['email'];
		$do->password = empty($_POST['password']) ? $_GET['password'] : $_POST['password'];
		
		$bo->doLogin($do);
	}
	
	if (TavernRaidRequestResponseHelper::$method == 'mobile') {
		$user_login_view->displayMobile();
	}
	else {
		$user_login_view->displayWeb($do);
	}
?>
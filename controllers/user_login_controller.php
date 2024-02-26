<?php
	$do = $do_factory->get(DoFactory::USER);
	
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

	print_r($_POST);
	
	$user_login_view = new UserLoginView($view_do);

	print_r($_POST);
	
	if (isset($_POST['login']) && ($_POST['login'] == "Bejelentkezés" || $_GET['mo'])) {
		$do->email = empty($_POST['email']) ? $_GET['email'] : $_POST['email'];
		$do->password = empty($_POST['password']) ? $_GET['password'] : $_POST['password'];
		
		$bo->doLogin($do);

		echo("fasz");
	}
	
	$user_login_view->displayWeb($do);
?>
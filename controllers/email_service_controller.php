<?php
	$email_service_types_do = new EmailServiceTypesDo();
    
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        print_r($_POST);

        switch ( $_POST['method'] ) { //Implement more mailing services (CEO)
            case 'userforgotpassword':
                $email_service_bo = new EmailServiceBo($email_service_types_do::USER_FORGOT_PASSWORD, $_POST['email']);
            break;
        }

        $email_service_bo->doMailing();
    }
?>
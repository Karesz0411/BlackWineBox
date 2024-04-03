<?php
    require (RequestResponseHelper::$root . '/PHPMailer/src/PHPMailer.php');
    require (RequestResponseHelper::$root . '/PHPMailer/src/Exception.php');
    require (RequestResponseHelper::$root . '/PHPMailer/src/SMTP.php');
    
	$email_service_types_do = new EmailServiceTypesDo();
    
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $json_data = file_get_contents('php://input');
        
        $request_body = json_decode($json_data);
        
        if (isset($request_body->method) && isset($request_body->emailto)) {
            $method = $request_body->method;
            $email_to = $request_body->emailto;
            
            switch ($method) {
                case 'userforgotpassword':
                    $email_service_bo = new EmailServiceBo($email_service_types_do::USER_FORGOT_PASSWORD, $email_to);
                break;
            }
            
            $email_service_bo->doMailing();
        }
    }
?>
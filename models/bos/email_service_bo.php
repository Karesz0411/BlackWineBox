<?php
    /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
    class EmailServiceBo {
        public $do;

        // Instantiate PHPMailer
        public $mail;

        /* ********************************************************
        * ********************************************************
        * ********************************************************/

        function __construct($email_service_type, $emailTo) {
            $do = new EmailServiceDo();
            $mail = new PHPMailer(true);
			
			if ($email_service_type != null && $email_service_type != '') {
				$this->do->email_service_type = $email_service_type;
                $this->initializeMailing($emailTo);
            }
		}

        /* ********************************************************
        * ********************************************************
        * ********************************************************/

        public function initializeMailing($emailTo) {
            $this->do->email_to = $emailTo;
            if (!filter_var($this->do->email_to, FILTER_VALIDATE_EMAIL)) {
                UserMessagesHelper::addToMessages(
                    "A megadott Email-cím formailag nem felel meg!",
                    UserMessagesHelper::MESSAGE_LEVEL_ERROR
                );
                
                http_response_code(500);
            }
            else {
                try {
                    //Server settings
                    $this->mail->isSMTP();
                    $this->mail->Host       = $this->do->host;
                    $this->mail->SMTPAuth   = $this->do->smtp_auth;
                    $this->mail->Username   = $this->do->smtp_username;
                    $this->mail->Password   = $this->do->smtp_password;
                    $this->mail->SMTPSecure = $this->do->smtp_secure;
                    $this->mail->Port       = $this->do->port;
                    $this->mail->SMTPDebug  = 2; //For more detailed debug informations

                    //Recipients
                    $this->mail->setFrom($this->do->sender_email, $this->do->sender_name);
                    $this->mail->addAddress($emailTo);
                }catch (Exception $e) {
                    UserMessagesHelper::addToMessages(
                        "Az email elküldése sikertelen! " . $this->mail->ErrorInfo,
                        UserMessagesHelper::MESSAGE_LEVEL_ERROR
                    );
                    
                    http_response_code(500);
                }
            }
        }

        /* ********************************************************
        * ********************************************************
        * ********************************************************/

        public function doMailing() {
            switch ( $this->do->email_service_type ) { //Implement more mailing services (CEO)
                case $this->do::USER_FORGOT_PASSWORD:
                    $this->userForgotPassword();
            }
        }

        /* ********************************************************
        * ********************************************************
        * ********************************************************/

        public function userForgotPassword() {
            try {
                // Content
                $this->mail->isHTML(true);
                $this->mail->Subject = 'Password Reset - BlackWineBox';
                $this->mail->Body    = 'Kattints <a href="http://example.com/reset_password.php?email=' . urlencode($this->do->email_to) . '">ide</a> a jelszavad módosításához.';
        
                $this->mail->send();

                UserMessagesHelper::addToMessages(
                    "Az email elküldése sikeres!",
                    UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
                );
                
                http_response_code(200);
                //return true;
            } catch (Exception $e) {
                UserMessagesHelper::addToMessages(
                    "Az email elküldése sikertelen! " . $this->mail->ErrorInfo,
                    UserMessagesHelper::MESSAGE_LEVEL_ERROR
                );
                
                http_response_code(500);
                //return false;
            }finally {
                $this->mail->smtpClose();
            }
        }
    }
?>
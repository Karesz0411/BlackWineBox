<?php
    use PHPMailer\PHPMailer\PHPMailer;

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class EmailServiceDo extends EmailServiceTypesDo {
		public $smtp_username      = 'triszten25@gmail.com';
        public $smtp_password      = 'bhmi kvue eafs llth'; //Generated with Google application passwords
        public $sender_email       = 'lakatosmario488@gmail.com'; //Sometimes it gets overwritten by the SMTP server, so to ensure that the sender has to be the given address, then it is recommended to check SMTP server settings
        public $sender_name        = 'BlackWineBox';
        public $host               = 'smtp.gmail.com';
        public $smtp_auth          = true;
        public $smtp_secure        = PHPMailer::ENCRYPTION_STARTTLS; //'tls' or PHPMailer::ENCRYPTION_SMTPS or PHPMailer::ENCRYPTION_STARTTLS with Port: 587
        public $port               = 587; //Port: 587 (with TLS) or 465 (with SSL)
        public $email_to           = '';
        public $subject            = '';
        public $body               = '';
        public $email_service_type = '';

        function __construct($attributes = null) {
			
			if ($attributes != null) {
				foreach ($attributes as $key => $value) {
					$this->$key = $value;
				}
            }
		}
	}
?>
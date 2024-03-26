<?php
    require (RequestResponseHelper::$root . '/PHPMailer/src/PHPMailer.php');
    require (RequestResponseHelper::$root . '/PHPMailer/src/Exception.php');
    require (RequestResponseHelper::$root . '/PHPMailer/src/SMTP.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Replace these values with your Gmail SMTP settings
    $smtpUsername = 'triszten25@gmail.com';
    $smtpPassword = 'Triszten3';
    $senderEmail = 'lakatosmario488@gmail.com';
    $senderName = 'Triszten';

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    print_r($_POST);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsername;
        $mail->Password   = $smtpPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //'tls' or PHPMailer::ENCRYPTION_SMTPS or PHPMailer::ENCRYPTION_STARTTLS with Port: 587
        $mail->Port       = 587; //Port: 587 (with TLS) or 465 (with SSL)

        //Recipients
        $mail->setFrom($senderEmail, $senderName);
        $mail->addAddress($_POST['email']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body    = 'Click <a href="http://example.com/reset_password.php?email=' . urlencode($_POST['email']) . '">here</a> to reset your password.';

        $mail->SMTPDebug = 2;

        print_r($mail);

        $mail->send();
        echo 'Email sent successfully';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    $mail->smtpClose();
?>
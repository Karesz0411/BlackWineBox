<?php
    require (RequestResponseHelper::$root . '\PHPMailer\src\PHPMailer.php');
    require (RequestResponseHelper::$root . '\PHPMailer\src\Exception.php');
    require (RequestResponseHelper::$root . '\PHPMailer\src\SMTP.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Replace these values with your Gmail SMTP settings
    $smtpUsername = 'triszten25@gmail.com';
    $smtpPassword = 'bhmi kvue eafs llth';
    $senderEmail = 'lakatosmario488@gmail.com'; //Sometimes it gets overwritten by the SMTP server, so to ensure that the sender has to be the given address, then it is recommended to check SMTP server settings
    $senderName = 'Triszten';

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email'])) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                UserMessagesHelper::addToMessages(
                    "A megadott Email-cím formailag nem felel meg!",
                    UserMessagesHelper::MESSAGE_LEVEL_ERROR
                );
                
                http_response_code(500);
            }else {
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
                    $mail->Subject = 'Password Reset - BlackWineBox';
                    $mail->Body    = 'Kattints <a href="http://example.com/reset_password.php?email=' . urlencode($_POST['email']) . '">ide</a> a jelszavad módosításához.';
            
                    $mail->SMTPDebug = 2; //For more detailed debug informations
            
                    $mail->send();

                    UserMessagesHelper::addToMessages(
                        "Az email elküldése sikeres!",
                        UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
                    );
                    
                    http_response_code(200);
                } catch (Exception $e) {
                    UserMessagesHelper::addToMessages(
                        "Az email elküldése sikertelen! " . $mail->ErrorInfo,
                        UserMessagesHelper::MESSAGE_LEVEL_ERROR
                    );
                    
                    http_response_code(500);
                }finally {
                    $mail->smtpClose();
                }
            }
        }
    }
?>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


//Required phpmailer files
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
// require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
// require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$name = $_POST['name'];
$emailAddress = $_POST['email'];
$subject = $_POST['msg_subject'];
$phoneNumber = $_POST['phone_number'];
$message = $_POST['message'];


try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'moleculardiagnostics.com.ng';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'noreply@moleculardiagnostics.com.ng';                     // SMTP username
    $mail->Password   = 'Hy6ga77@';                               // SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
     );

// //Gmail Server Settings for local host
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
// $mail->isSMTP();                                            // Send using SMTP
// $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
// $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
// $mail->Username   = 'vartechsolutionsltd@gmail.com';                     // SMTP username
// $mail->Password   = '';                               // SMTP password
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
// $mail->Port       = 587;       

// smtp_server=smtp.gmail.com
// smtp_port=587
// error_logfile=error.log
// debug_logfile=debug.log
// auth_username=YourGmailId@gmail.com
// auth_password=Your-Gmail-Password
// force_sender=YourGmailId@gmail.com(optional)


    //Recipients
    $mail->setFrom($emailAddress, $name );
    $mail->addAddress('info@moleculardiagnostics.com.ng', 'Enquiry');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
    echo 'success';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
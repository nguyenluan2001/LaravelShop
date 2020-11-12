<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
header('Content-Type: text/html; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
function sendMail($receipt,$fullname,$title,$content,$option=array())
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'luanpro2001@gmail.com';                     // SMTP username
        $mail->Password   = 'ntluan20032001';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;
        $mail->CharSet = 'UTF-8';                               // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('luanpro2001@gmail.com', 'Luân');
        $mail->addAddress($receipt, $fullname);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('luanpro2001@gmail.com', 'Luân');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        // Attachments
        // $mail->addAttachment('download.png');         // Add attachments
        // $mail->addAttachment('download.png', 'picture.jpg');    // Optional name
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        //  $mail->msgHTML(file_get_contents('http://localhost:8080/UNITOP.VN/BACK-END/LARAVELPRO/demo/resources/views/mail/sendmail.blade.php'), __DIR__);

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->send();
        echo 'Đã gửi thành công';
    } catch (Exception $e) {
        echo "Gửi không thành công. Thông báo lỗi: {$mail->ErrorInfo}";
    }
    print_r($_POST);
}

?>

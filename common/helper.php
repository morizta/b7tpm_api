<?php
// var_dump (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n"; die();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once '../../vendor/autoload.php';

function exportPDF ($string_html, $type, $location){

    $current_date = date("YmdHms");
    define('FILE_PATH' , $_SERVER['DOCUMENT_ROOT']."/B7TPMAPI/apis/".$type."/generatedfile/");
    $name = $type.'_generated_'.$current_date.'.pdf';
    // echo $name;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($string_html);
    $mpdf->Output(FILE_PATH.$name, 'F');
    return $name;
    // // echo FILE_PATH;
}

function base_url() {
    return "http://10.48.105.12/B7TPMAPI/apis/";
}

function SendMail()
{    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer();
    
    try {
        //Server settings
        $mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        // $mail->Host       = 'smtp.gmail.com';  
        
        $mail->Host = 'ssl://smtp.gmail.com:465';
        // $mail->Host = 'tls://smtp.gmail.com:587';                  // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        // $mail->Username   = 'ablrozak15@gmail.com';                     // SMTP username
        // $mail->Password   = 'unikom20';                                       // Enable SMTP authentication
        $mail->Username   = 'mrizky.taufiqh@gmail.com';                     // SMTP username
        $mail->Password   = 'neverknown021';                               // SMTP password
        // $mail->SMTPSecure = "tls";
        // $mail->Port = 587;   
        //Recipients
        $mail->setFrom('mrizky.taufiqh@gmail.com', 'Mailer');
        $mail->addAddress('mochammad.taufiq@xapiens.id', 'Rizky');     // Add a recipient
        // $mail->addAddress('ellen@example.com');  
    
        // // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        // // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
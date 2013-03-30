<?php

$absurl = ($_SERVER['HTTPS'] ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER[SCRIPT_NAME];
echo $absurl;

/*
mail(
  'danielmccarthy', // your email address
  'Test', // email subject
  'This is an email', // email body
  "From: Dan McCarthy <mccarthyemulsion@comcast.net>\nReturn-path: dmccarthy@e-dialog.com",
  '-f dmccarthy@e-dialog.com'
);
/*
echo "complete";


/*
require '/Users/danielmccarthy/Sites/classes/PHPMailer_5.2.4/class.phpmailer.php';

$mail = new PHPMailer;

$mail->IsSMTP(); 
$mail->Mailer = "smtp";                                     // Set mailer to use SMTP
$mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dan@mccarthyphoto.com';                            // SMTP username
$mail->Password = 'Lang5Horn';                           // SMTP password
$mail->SMTPSecure = 'ssl';  // Enable encryption, 'ssl' also accepted
$mail->Port = 465; 

                         

$mail->From = 'dan@mccarthyphoto.com';
$mail->FromName = 'Dan McCarthy';
$mail->AddAddress('dan@mccarthyphoto.com', 'Dan McCarthy');  // Add a recipient
//$mail->AddAddress('ellen@example.com');               // Name is optional
$mail->AddReplyTo('dan@mccarthyphoto.com', 'Dan McCarthy');
//$mail->AddCC('cc@example.com');
//$mail->AddBCC('bcc@example.com');

//$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
*/

?>
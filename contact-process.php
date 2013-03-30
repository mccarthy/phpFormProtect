<?php

$recipient="you@example.com";
$subject="Website Form Submission";
$redirect="contact.php";

include ('phpfp/class.FormProtect.php');
$fp = new FormProtect;
$fpResult = $fp->testSubmission($_POST);
$debugInfo = $fp->formatDebugInfo($_POST, $fpResult);
echo $debugInfo;

if($fpResult[pass]) {
	//echo "Passed.  Process as normal, send email, etc.";
	if ($email=="") $email=$recipient;
	if ($subject=="") $subject="Form Submission";
	$message  = "Email: ".$email."<br />";
	$message .= "Phone: ".$phone."<br />";
	$message .= "Comments: ".$comments."<br />";
	$message .= "Sender IP: ".$REMOTE_ADDR."<br /><br />";
	$message .= $debugInfo;
	$headers .= "Return-path: ".$recipient."\n";
	$headers  = "From: $email\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	mail($recipient,$subject,$message,$headers);
}
else {
	//echo "Failed.  Log, block IP, email, etc.";
	$message  = $debugInfo;
	$subject  = "[phpFromProtect Fail] " . $subject;
	$headers  = "From: $email\n";
	$headers .= "Return-path: ".$recipient."\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	mail($recipient,$subject,$message,$headers);
}

if ($redirect)
{
header("Location: $redirect");	
} 
else {
	echo "An unknown error has occurred.";
}
?>
<?php

$recipient="you@example.com";
$subject="Website Form Submission";
if ($email=="") $email=$recipient;

include ('phpfp/class.FormProtect.php');
$fp = new FormProtect;
$fpResult = $fp->testSubmission($_POST);

echo '<a href="contact.php">Submit Form Again</a>';
$debugInfo = $fp->formatDebugInfo($_POST, $fpResult);
echo $debugInfo;
	
if($fpResult[pass]) {
	//echo "Passed.  Process as normal, send email, etc.";
	if ($subject=="") $subject="[phpFromProtect: Pass] Form Submission";
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
	if ($subject=="") $subject="Form Submission";
	$message  = $debugInfo;
	$subject  = "[phpFromProtect: Fail] " . $subject;
	$headers  = "From: $email\n";
	$headers .= "Return-path: ".$recipient."\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	mail($recipient,$subject,$message,$headers);
}

?>
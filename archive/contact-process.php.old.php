<?php

/*
$url = strtolower($HTTP_HOST);
$url = ereg_replace("www.", "", $url);
if (!ereg($url,$HTTP_REFERER)) DIE ("<html><script language='JavaScript'>alert('Security Violation: Unauthorized referer!'),history.go(-1)</script></html>");
if (($recipient=="") || (!ereg("^([[:alnum:]\_\.\-]+)(\@[[:alnum:]\.\-]+\.+[[:alpha:]]+)$", $recipient)) || (strlen($recipient)>100)) DIE ("<html><script language='JavaScript'>alert('Sorry, this form cannot be submitted!\\\n\\\nReason: Invalid recipient field!\\\n\\\nPlease contact the webmaster for details.'),history.go(-1)</script></html>");
if ((ereg("\n|\r", $recipient_name)) || (strlen($recipient_name)>100)) DIE ("<html><script language='JavaScript'>alert('Sorry, this form cannot be submitted!\\\n\\\nReason: Invalid recipient name field!\\\n\\\nPlease contact the webmaster for details.'),history.go(-1)</script></html>");
if (($email!="") && (!ereg("^([[:alnum:]\_\.\-]+)(\@[[:alnum:]\.\-]+\.+[[:alpha:]]+)$", $email))) DIE ("<html><script language='JavaScript'>alert('Please enter your e-mail address! A valid e-mail address must be in you@yourname.com format.'),history.go(-1)</script></html>");
if ((ereg("\n|\r", $reply_subject)) || (strlen($reply_subject)>100)) DIE ("<html><script language='JavaScript'>alert('Sorry, this form cannot be submitted!\\\n\\\nReason: Invalid reply subject field!\\\n\\\nPlease contact the webmaster for details.'),history.go(-1)</script></html>");
*/
$redirect = $_POST[redirect];
include ('phpfp/class.FormProtect.php');
$fp = new FormProtect;
$fpResult = $fp->testSubmission($_POST);
$debugInfo = $fp->formatDebugInfo($_POST, $fpResult);

if($fpResult[pass]) {
	//echo "Passed.  Process as normal, send email, etc.";
	if ($email=="") $email=$recipient;
	if ($subject=="") $subject="Form Submission";
	$Message=$subject.":\n\n".$results."\n\nSender's IP: ".$REMOTE_ADDR;

	//$headers = '"From: Dan McCarthy <mccarthyemulsion@comcast.net>"';
	$headers .= 'From: Dan McCarthy <mccarthyemulsion@comcast.net>' . "\r\n";
	//$headers="From: ".$email."\nReturn-path: dan@mccarthyphoto.com";
	mail($recipient,$subject,$Message,$headers);
}
else {
	//echo "Failed.  Log, block IP, email, etc.";
	$Message = $Message . "<br /><br />" . $debugInfo;
	mail("dan@mccarthyphoto.com","[phpFromProtect Fail]" . $subject,$Message,"From: ".$email."\nReturn-path: dan@mccarthyphoto.com");
}

if ($redirect)
{
header("Location: $redirect");	
} 
else {
	echo "An unknown error has occurred.";
}
?>
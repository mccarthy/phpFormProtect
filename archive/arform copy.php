<?php

########################################################################
#                Auto Reply Form by WEBMASTERS.COM                     #
#        (C) Copright WEBMASTERS.COM. All right reserved.              #
# This script can only be used by hosting customers of WEBMASTERS.COM. #
#                    Please do not edit below!                         #
########################################################################

$url = strtolower($HTTP_HOST);
$url = ereg_replace("www.", "", $url);
if (!ereg($url,$HTTP_REFERER)) DIE ("<html><script language='JavaScript'>alert('Security Violation: Unauthorized referer!'),history.go(-1)</script></html>");
if (($recipient=="") || (!ereg("^([[:alnum:]\_\.\-]+)(\@[[:alnum:]\.\-]+\.+[[:alpha:]]+)$", $recipient)) || (strlen($recipient)>100)) DIE ("<html><script language='JavaScript'>alert('Sorry, this form cannot be submitted!\\\n\\\nReason: Invalid recipient field!\\\n\\\nPlease contact the webmaster for details.'),history.go(-1)</script></html>");
if ((ereg("\n|\r", $recipient_name)) || (strlen($recipient_name)>100)) DIE ("<html><script language='JavaScript'>alert('Sorry, this form cannot be submitted!\\\n\\\nReason: Invalid recipient name field!\\\n\\\nPlease contact the webmaster for details.'),history.go(-1)</script></html>");
if (($email!="") && (!ereg("^([[:alnum:]\_\.\-]+)(\@[[:alnum:]\.\-]+\.+[[:alpha:]]+)$", $email))) DIE ("<html><script language='JavaScript'>alert('Please enter your e-mail address! A valid e-mail address must be in you@yourname.com format.'),history.go(-1)</script></html>");
if ((ereg("\n|\r", $reply_subject)) || (strlen($reply_subject)>100)) DIE ("<html><script language='JavaScript'>alert('Sorry, this form cannot be submitted!\\\n\\\nReason: Invalid reply subject field!\\\n\\\nPlease contact the webmaster for details.'),history.go(-1)</script></html>");

if ($required) {
   $ra=explode(",", $required);
   $num=count($ra); }
$results="";
reset ($HTTP_POST_VARS);
while (list ($key, $val) = each ($HTTP_POST_VARS)) {
   if (($key!="recipient") && ($key!="recipient_name") && ($key!="reply_subject") && ($key!="reply_text") && ($key!="subject") && ($key!="required") && ($key!="redirect")) {
	for($i=0;$i<$num;$i++) {
	   if (($key==$ra[$i]) && ($val=="")) DIE ("<html><script language='JavaScript'>alert('Please fill in the $ra[$i] field!'),history.go(-1)</script></html>"); }
	$results.=$key.": ".stripslashes($val)."\n";  }}

# Send Auto Reply

if (($email!="") && ($reply_text!="")) {
   if ($reply_subject=="") $reply_subject="Re: ".$subject;
   if ($recipient_name=="") $recipient_name=$recipient;
   mail($email,$reply_subject,$reply_text,"From: ".$recipient_name." <".$recipient.">\n"); }

# Send Form Results

if ($email=="") $email=$recipient;
if ($subject=="") $subject="Form Submission";
$Message=$subject.":\n\n".$results."\n\nSender's IP: ".$REMOTE_ADDR;


#if ($secure!="Y") mail($recipient,$subject,$Message,"From: ".$email."\n");
if ($secure!="Y") mail($recipient,$subject,$Message,"From: ".$email."\nReturn-path: dan@mccarthyphoto.com");
#if ($secure!="Y") mail($recipient,$subject,$Message,"From: dan@mccarthyphoto.com\nReply-To: ".$email."\n");
else {
   $Idate = mktime(0,0,0,date("m"),date("d"),date("Y"));
   $Sdate = date("m-d-Y",$Idate);
   $Ctime = date("h:i:s A");
   $Body="--------------- ".$Sdate." at ".$Ctime." ---------------\n".$Message."\n\n";
   $File="arform_data/data.txt";
   if ($fp=fopen($File, "a")) {
	flock($fp,2);
	fwrite($fp,$Body);
	flock($fp,3);
	fclose($fp); }
   if (ereg("443",$SERVER_PORT)) $pfx="https://";
   else $pfx="http://";
   $Path=eregi_replace("arform\.php", "", $PHP_SELF);
   $Message=$subject.":\n\nTo access the data posted, please go to:\n\n".$pfx.$HTTP_HOST.$Path."arform_data/\n\nSender's IP: ".$REMOTE_ADDR;
   mail($recipient,$subject,$Message,"From: ".$email."\n"); }

if ($redirect) header("Location: $redirect");
else {
?>
<html>
<head>
<title>Thank You!</title>
<style>
a:hover {color:#FF0000;}
BODY{font-size:10pt;font-family:Verdana,Arial,Helvetica,sans-serif}
TD{font-size:10pt;font-family:Verdana,Arial,Helvetica,sans-serif}
.ltxt{font-size:14pt;font-family:Verdana,Arial,Helvetica,sans-serif}
</style>
</head>
<body bgcolor="#FFFFFF" link="#0000FF" vlink="#0000FF">
<div align="center"><center>
<table border="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td align="center"><b><font color="#000080" class="ltxt">Thank You!</font></b></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td align="center"><b><i><font color="#FF0000">The information you submitted has been sent successfully!</font></i></b></td>
  </tr>
  <tr>
    <td height="15"></td>
  </tr>
  <tr>
    <td align="center">Thank you for contacting us!</td>
  </tr>
  <tr>
    <td height="15"></td>
  </tr>
</table>
</center></div>
<p align="center"><br><font face="Arial" size="1">© Auto Reply Form by <a href="http://www.webmasters.com" target="_blank">WEBMASTERS.COM</a>. All Rights Reserved.</font></p>
</body>
</html>
<?php

}
	
?>
/*
Welcome to phpFormProtect.

Installation
1) Copy the phpfp folder into the same folder that contains the form and form processing page on your web host
3) Put the following code somewhere between your form tags of the form you want to protect:
	<?php include 'phpfp/phpfp.php'; ?>
4) The file "contact-process.php" contains sample code showing how to use the class.  You will either need to use this file, or add similar calls to your form processing page.

TODO:
-separate test code from the test form
-email report
-add logging
-add license
-add config file
-somehow get js into <head> 
-integrate akismet
-integrate project honeypot
-run spam assassin http://ppadron.blog.br/2010/05/04/php-api-to-spamassassin-spamd-protocol/
-integrate https://code.google.com/p/phpspamdetection/ 
-integrate spamhaus dbl: http://www.spamhaus.org/dbl/
	http://www.lockergnome.com/net/2012/04/23/checking-a-domain-against-the-spamhaus-dbl-in-php/

RESEARCH
http://stackoverflow.com/questions/1577918/blocking-comment-spam-without-using-captcha
http://nedbatchelder.com/text/stopbots.html
http://www.sitepoint.com/stop-comment-spam/
http://www.sitepoint.com/comment-spam-compiled-and-interpreted/
http://www.sitepoint.com/spam-fighters-toolkit/

Alternative to phpfp, but requires call to their server:
http://sblam.com/en.html
*/
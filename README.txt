phpFormProtect
-----------------
phpFormProtect is a rough port of CFFormProtect (http://cfformprotect.riaforge.org/) which protects 
forms from spammers in a way that doesn't annoy users.  We found that when switching from ColdFusion to PHP, 
there wasn't anything similar.  Many thanks to the folks at CFFormProtect, especially for fp.js, which is a copy of cffp.js.

CONTRIBUTORS
Dan McCarthy (mcc@rthy.net) 

INSTALLATION
-Copy the phpfp folder into the same folder that contains the form and form processing page on your web host
-Put this  beween the form tags of the form you want to protect: 
     <?php include 'phpfp/phpfp.php'; ?>
-The files "contact.php" and "contact-process.php" contain sample code showing how to use phpFormProtect.  
-You can either use the sample code files, or add similar logic to your form processing page.

TODO
-Add logging
-Add config file
-Move JS into <head> 
-Integrate akismet
-Integrate project honeypot
-Integrate https://code.google.com/p/phpspamdetection/ 
-Integrate spamhaus dbl: 
	http://www.spamhaus.org/dbl/
	http://www.lockergnome.com/net/2012/04/23/checking-a-domain-against-the-spamhaus-dbl-in-php/
-Integrate http://www.linksleeve.org/

RESEARCH/INSPIRATION
http://stackoverflow.com/questions/1577918/blocking-comment-spam-without-using-captcha
http://nedbatchelder.com/text/stopbots.html
http://www.sitepoint.com/stop-comment-spam/
http://www.sitepoint.com/comment-spam-compiled-and-interpreted/
http://www.sitepoint.com/spam-fighters-toolkit/
http://sblam.com/en.html

LICENSE
This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/. 

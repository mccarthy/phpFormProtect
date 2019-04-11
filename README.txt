phpFormProtect
-----------------
phpFormProtect protects forms from spammers in a way that doesn't annoy users.  It is an alternative to a CAPTCHA, and could also be used to prevent comment spam.  It works by running each submission through a number of tests, and then scoring the submission.  Any one of the tests by itself has flaws, but working together they provide a really good indicator of the spamminess of a given form submission.  The last two tests by default cause failure based on the points assigned.  This is easily configurable.

This project is a port of CFFormProtect (http://cfformprotect.riaforge.org/). We found that when switching from ColdFusion to PHP, 
there wasn't anything similar.  Many thanks to the folks at CFFormProtect, especially for fp.js, which is a copy of cffp.js.  

The tests are as follows:
-Hidden Form Field - If hidden form field is filled in, this is an indicator of spam
-Time Form Submission - If form is filled out too fast or too slow, this is an indicator of spam
-Too many URLs - If the comment field has too many URLs (Number is configurable) this is an indicator of spam
-Mouse Movement - If the user does not use their mouse, this is an indicator of spam
-Used Keyboard - If the user does not use their keybaord, this is an indicator of spam
-Validate Referer - If the HTTP referer does not match the form URL, we shouldn't accept the submission.
-Validate Email - If the email address provided in the form is not valid from a syntax perspective, we shouldn't accept the submission.

CONTRIBUTORS
Dan McCarthy (mcc@rthy.net) 

VERSION
0.1

INSTALLATION
-Copy the phpfp folder into the same folder that contains the form and form processing page on your web host
-Put this  beween the form tags of the form you want to protect: 
     <?php include 'phpfp/phpfp.php'; ?>
-The files "contact.php" and "contact-process.php" contain sample code showing how to use phpFormProtect.  
-You can either use the sample code files, or add similar logic to your form processing page.

TODO
-Eliminate or fix spam words test
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

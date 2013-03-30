<html>
<body>

<h1>Contact Us</h1>
<p>We'd love to hear from you via the form below.
<hr>
</p>

<form action="contact-process.php" method="post" name="contactus">
<label for="email">Email:</label><input type="text" name="email" id="email" /><br />
<label for="phone">Phone:</label><input type="text" name="phone" id="phone" /><br />
<label for="comments">Comments:</label><textarea name="comments" id="comments" cols="40" rows="5" /></textarea>
<br />
<input type="submit" value="Send" />
<?php include 'phpfp/phpfp.php'; ?>     
</form>
</body>
</html>
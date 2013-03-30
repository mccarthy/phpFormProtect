<html>
<head>
<title>phpFormProtect</title>
</head>
<body>
	<h1>Contact Us</h1>
	<p>We'd love to hear from you</p>
	<form action="<?php echo $PHP_SELF;?>" method="post" name="contactus">
	<?php include 'phpfp.php'; ?>
	<label for="email">Email:</label><input type="text" name="email" id="email" value="dan@mccarthyphoto.com" /><br />
	<label for="phone">Phone:</label><input type="text" name="phone" id="phone" /><br />
	<label for="comments">Comments:</label><br /><textarea name="comments" id="comments" cols="40" rows="5" />seo http://www.example.com</textarea><br />
	<br /><input type="submit" value="Send" />     
	</form>
</body>
</html>
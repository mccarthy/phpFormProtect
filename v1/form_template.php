<html>
<head>
<title>phpFormProtect</title>
<script type="text/javascript" src="fp.js"></script>
</head>
<body>
	<h1>Contact Us</h1>
	<p>We'd love to hear from you</p>
	<form action="<?php echo $PHP_SELF;?>" method="post" name="contactus">
	<label for="email">Email:</label><input type="text" name="email" id="email" value="dan@mccarthyphoto.com" /><br />
	<label for="phone">Phone:</label><input type="text" name="phone" id="phone" /><br />
	<label for="formfield1234567894">Leave empty</label><input type="text" name="formfield1234567894" id="additional" value="foo" /><br />
	<!--<span style="display:none">Leave this field empty <input id="fp<? echo uniqid();?>" type="text" name="formfield1234567894" value="" /></span><br /-->
	<label for="comments">Comments:</label><br /><textarea name="comments" id="comments" cols="40" rows="5" />seo http://www.example.com</textarea><br />
	<input type="hidden" name="st" value="<? echo time()+14921; ?>" /><br />
	<input id="fp<? echo uniqid();?>" type="hidden" name="formfield1234567891" class="cffp_mm" value="" /><br />
	<input id="fp<? echo uniqid();?>" type="hidden" name="formfield1234567892" class="cffp_kp" value="" /><br />
	<br /><input type="submit" value="Send" />     
	</form>
</body>
</html>
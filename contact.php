<?php include 'header.php'; ?>


<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">
	<h1>Contact Us</h1>
	<p>We'd love to hear from you by phone, email, or via the form below.
	<br />  
	Phone: 617-733-8822<br />
	Email: <a href="mailto:dan@mccarthyphoto.com">dan@mccarthyphoto.com</a>
	<hr>
	</p>
	<div>
	<form action="contact-process.php" method="post" name="contactus">
	<label for="email">Email:</label><input type="text" name="email" id="email" />
	<label for="phone">Phone:</label><input type="text" name="phone" id="phone" />
	<label for="comments">Comments:</label><textarea name="comments" id="comments" cols="40" rows="5" /></textarea>
	<br />
	<input type="submit" value="Send" />
	<?php include 'phpfp/phpfp.php'; ?>     
	</form>
	</div>
</div>
</div>
</div>
<?php include 'footer.php'; ?>

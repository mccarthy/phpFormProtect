<?
$score = 0;
$displayTime = $_POST["st"]-14921;
$submitTime = time();
$fillOutTime = $submitTime-$displayTime;

//initial page load, display form
if(!isset($_POST["email"])) {
include 'form_template.php'; 
}
else {
//if email is set, run our tests 

	//dump form
	if($debug==true) {
	echo "======DUMP FORM======<br><br>";
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	}

	//check contents of hidden form field
	echo "======HIDDEN FORM FIELD======<br><br>";
	if(strlen($_POST["formfield1234567894"]) > 0) {
		$score = $score+10;
		echo "hidden=filled<br>";
	}

	//check for filled out too quickly
	echo "======TIMING======<br><br>";
	if($fillOutTime <2) {
		$score = $score+10;
		echo "too quick<br>";
	}

	//check for filled out too slowly
	elseif($fillOutTime >3600) {
		$score = $score+10;
		echo "too slow<br>";
	}

	else {
		echo "timing OK";	
	}
	
	echo $displayTime . "<br>";
	echo $submitTime . "<br>";
	echo $fillOutTime . "<br>";

	//num urls, subtract one for my site
	echo "======NUM URLS=====<br><br>";
	foreach ($_POST as $key => $value) {
		//count urls in all form fields
		$numUrls = preg_match_all('/https?:\/\//', strtolower($value),$urls);
		$numUrlsTotal = $numUrlsTotal+$numUrls;
	}
	echo "urls: " . $numUrlsTotal . "<br>";
	$numUrlsTotal=$numUrlsTotal-1;
	if($numUrlsTotal>0) {
		$score = $score+($numUrlsTotal*10);
	}

	//spam keywords
	echo "======SPAM WORDS======<br><br>";
	$words = file("spamwords-prod.txt");
	$spamWordCount = 0;
	//loop over all words in file
	foreach ($words as $wordkey => $wordvalue) {
		$wordvalue = trim(preg_replace( '/\s+/', ' ', $wordvalue));
		foreach ($_POST as $fieldkey => $fieldvalue) {
			//check all form fields for the current word
			$spamSearch = stripos($fieldvalue,$wordvalue); 
			if ($spamSearch!==false) {
				echo "found: "; 
				echo $wordvalue . "<br>";
				$spamWordCount++;
			}
		}
	}
 	echo "spamWordCount: " . $spamWordCount;
	$score = $score+$spamWordCount;

	//mouse
	echo "<br><br>======MOUSE======<br><br>";
	if(is_numeric($_POST["formfield1234567891"])===false) {
		$score = $score+10;
		echo "didn't use mouse<br>";
	}
	else {
		echo "used mouse";
	}
	
	//keyboard
	echo "<br><br>======KEYBOARD======<br><br>";
	if(is_numeric($_POST["formfield1234567892"])===false) {
		$score = $score+10;
		echo "didn't use keyboard<br>";
	}
	else {
		echo "used keyboard";
	}
	
	//output score
	echo "<br><br>======SCORE======<br><br>";
	echo "score: " . $score . "<br>";

	//tests complete, email report
	//mail();
}
	
?>

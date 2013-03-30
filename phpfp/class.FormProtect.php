<?php
class FormProtect {

//thresholds
var $numUrlsAllowed = 4;
var $spamWordsAllowed = 0;
var $maxScoreAllowed = 30;

//points added to score for each failed test
var $mouseMovementPoints = 10;
var $usedKeyboardPoints = 10;
var $timedFormPoints = 20;
var $hiddenFieldPoints = 30;
var $tooManyUrlsPoints = 30;
var $spamStringPoints = 20;
var $validateEmailPoints = 100;
var $validateRefererPoints = 100;

function testSubmission($formContents) {
	$results["pass"] = true;
	$results["score"] = 0;

	$results["testHiddenformField"] = $this->testHiddenFormField($formContents);
	if($results["testHiddenformField"]["pass"]!=true) {
		$results["score"] = $results["score"]+$this->hiddenFieldPoints;
		$results["testsFailed"][] = "testHiddenFormField";
	}

	$results["testTimedFormSubmission"] = $this->testTimedFormSubmission($formContents);
	if($results["testTimedFormSubmission"]["pass"]!=true) {
		$results["score"] = $results["score"]+$this->timedFormPoints;
		$results["testsFailed"][] = "testTimedFormSubmission";
	}
	
	$results["testTooManyUrls"] = $this->testTooManyUrls($formContents);
	if($results["testTooManyUrls"]["pass"]!=true) {
		$results["score"] = $results["score"]+$this->tooManyUrlsPoints;
		$results["testsFailed"][] = "testTooManyUrls";
	}

	/*
	$results[testSpamStrings] = $this->testSpamStrings($formContents);
	if($results[testSpamStrings][pass]!=true) {
		$results[score] = $results[score]+$this->spamStringPoints;
		$results[testsFailed][] = "testSpamStrings";
	}
	*/
	$results["testMouseMovement"] = $this->testMouseMovement($formContents);
	if($results["testMouseMovement"]["pass"]!=true) {
		$results["score"] = $results["score"]+$this->mouseMovementPoints;
		$results["testsFailed"][] = "testMouseMovement";
	}

	$results["testUsedKeyboard"] = $this->testUsedKeyboard($formContents);
	if($results["testUsedKeyboard"]["pass"]!=true) {
		$results["score"] = $results["score"]+$this->usedKeyboardPoints;
		$results["testsFailed"][] = "testUsedKeyboard";
	}

	$results["validateReferer"] = $this->validateReferer($formContents);
	if($results["validateReferer"]["pass"]!=true) {
		$results["score"] = $results["score"]+$this->validateRefererPoints;
		$results["testsFailed"][] = "validateReferer";
	}

	$results["validateEmail"] = $this->validateEmail($formContents);
	if($results["validateEmail"]["pass"]!=true) {
		$results["score"] = $results["score"]+$this->validateEmailPoints;
		$results["testsFailed"][] = "validateEmail";
	}	

	if($results["score"]>=$this->maxScoreAllowed) {
		$results["pass"] = false;
	}

	return $results;

}

function formatDebugInfo($formContents, $results) {

		$debugInfo = "======FORM======<br><br>";
		$debugInfo = $debugInfo . "<pre>";
		$debugInfo = $debugInfo . print_r($formContents, true);
		$debugInfo = $debugInfo .  "</pre>";
		$debugInfo = $debugInfo .  "<br><br>======SCORE======<br><br>";
		$debugInfo = $debugInfo .  "score: " . $results["score"] . "<br>";
		$debugInfo = $debugInfo .  "<br><br>======CONFIG======<br><br>";		
		$debugInfo = $debugInfo . "<pre>";
		$debugInfo = $debugInfo . print_r(get_class_vars(get_class($this)), true);
		$debugInfo = $debugInfo .  "</pre>";
		$debugInfo = $debugInfo .  "<br><br>======RESULTS======<br><br>";
		$debugInfo = $debugInfo . "<pre>";
		$debugInfo = $debugInfo . print_r($results, true);
		$debugInfo = $debugInfo .  "</pre>";
		return $debugInfo;
}


function testHiddenFormField($formContents) {
	$result["pass"] = false; 
	if(strlen($formContents["formfield1234567894"]) > 0) {
		$result["status"] = "Hidden form field populated";	
	}
	else {
		$result["status"] = "Hidden form field empty";
		$result["pass"] = true;
	}
	return $result;
}

function testTimedFormSubmission($formContents) {
	$result["pass"] = false; 
	$displayTime = $formContents["st"]-14921;
	$submitTime = time();
	$fillOutTime = $submitTime-$displayTime;
	
	//less than 2 seconds or more than 60 minutes
	if($fillOutTime < 2) {
		$result["status"] = "Filled out too quickly";
	}
	elseif($fillOutTime > 3600) {
		$result["status"] = "Filled out too slowly";
	}
	else {
		$result["status"] = "Filled out in appropriate amount of time";
		$result["pass"] = true; 	
	}
	
	$result["displayTime"] = $displayTime;
	$result["submitTime"] = $submitTime;
	$result["fillOutTime"] = $fillOutTime;	
	return $result;
}

function testTooManyUrls($formContents) {
	$result["pass"] = false; 
	$result["status"] = "";
	$numUrls = 0;
	foreach ($formContents as $key => $value) {
		//count urls in all form fields
		$numUrlsTemp = preg_match_all('/https?:\/\//', strtolower($value),$urls);
		$numUrls = $numUrls+$numUrlsTemp;
	}
	$result["numUrls"] = $numUrls;

	if($numUrls<=$this->numUrlsAllowed) {
		$result["pass"] = true;
		$result["status"] = "Number of Urls is OK";
	}
	else {
		$result["status"] = "Too many Urls. Found: ".$numUrls." Allowed: ".$this->numUrlsAllowed;
	}
	return $result;
}

function testSpamStrings($formContents) {
	$result["pass"] = false; 
	$words = file("spamwords.txt");
	$spamWordCount = 0;
	//loop over all words in file
	foreach ($words as $wordkey => $wordvalue) {
		$wordvalue = trim(preg_replace( '/\s+/', ' ', $wordvalue));
		foreach ($formContents as $fieldkey => $fieldvalue) {
			//check all form fields for the current word
			$spamSearch = stripos($fieldvalue,$wordvalue); 
			if ($spamSearch!==false) {
				$result["spamWords"][$spamWordCount] = $wordvalue ; 
				$spamWordCount++;
			}
		}
	}
	if($spamWordCount<=$this->spamWordsAllowed) {
		$result["pass"] = true;
	}
 	$result["status"] = "Number of spam words: " . $spamWordCount;
	return $result;
}
	
function testMouseMovement($formContents) {
	$result["pass"] = false; 
	if(is_numeric($formContents["formfield1234567891"])===false) {
		$result["status"] =  "Didn't use mouse";
	}
	else {
		$result["pass"] = true;
		$result["status"] = "Used mouse";
	}
	return $result;
}
	
function testUsedKeyboard($formContents) {
	$result["pass"] = false; 
	if(is_numeric($formContents["formfield1234567892"])===false) {
		$result["status"] =  "Didn't use keyboard";
	}
	else {
		$result["status"] =  "Used keyboard";
		$result["pass"] = true;
	}
	return $result;	
}

function validateReferer($formContents) {
	if(isset($_SERVER['HTTPS'])) {
		$protocol = "https://";
	} else {
		$protocol = "http://";
	}
	$absurl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
	$absurlParsed = parse_url($absurl);
	$result["pass"] = false;
	$result["hasReferrer"] = false;
	$httpReferer = $_SERVER['HTTP_REFERER'];
	if(isset($httpReferer)) {
	    $refererParsed = parse_url($httpReferer);
	    if (isset($refererParsed['host'])) {
	        $result["hasReferrer"] = true;
	        $absUrlRegex = '/'.strtolower($absurlParsed['host']).'/';
	        $isRefererValid = preg_match($absUrlRegex, strtolower($refererParsed['host']));
	        if($isRefererValid==1) {
	        	$result["pass"] = true;
	    	}
	    }
	    else {
	    	$result["status"] = "Absolute URL: ".$absurl." Referer: ".$httpReferer;	
	    }
	}
	else {
		$result["status"] = "Absolute URL: " .$absurl." Referer: ".$httpReferer;
	}
	return $result;
	}

function validateEmail($formContents) {
	$result["pass"] = false;
	if (filter_var($formContents["email"],FILTER_VALIDATE_EMAIL)) {
		$result["pass"] = true;
	} else {
		$result["status"] = "Email: " .$formContents["email"];
	}
	return $result;
	}
}
?>

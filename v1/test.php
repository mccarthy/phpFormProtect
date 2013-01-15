<?php

$words = file("spamwords-dev.txt");
echo "<pre>";
print_r($words);
$words = Array("seo","viagra","rolex","cialis");
print_r($words);
$spamWordCount = 0;
//loop over all words in file

foreach ($words as $wordkey => $wordvalue) {

	$haystack = 'seo http://www.example.com';
	$needle = 'seo';
	$result = stripos($haystack,$wordvalue);
	echo $wordvalue . ": ";
	if ($result===false) {
		echo "not found in " . $haystack . "<br>";
	}
	else {
		echo "found, position: " . $result . "<br>";
		$spamWordCount++;
		echo "spamWordCount: " . $spamwordCount . "<br>";
	}
}
?>
<?php
include ('class.Time.php');
$oTime = new Time;
$sTime = $oTime->GenerateCurrentTime();
print 'The time is: ' . $sTime;
?>
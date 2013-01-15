<?php
class Time {
  function GenerateCurrentTime(){
    $sTime = gmdate("d-m-Y H:i:s");
    return $sTime;
  }
}
?>
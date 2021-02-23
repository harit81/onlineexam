<?php
$a=1;$b=12;
$numbers = range($a, $b);
shuffle($numbers);
foreach ($numbers as $value){
   "$value" . "<br>";
    $ad=array($value);
   print_r($ad);
}

?>
<?php
ob_start();
session_start();
$file = fopen('data.txt',"r");
$text = fgets($file);
fclose($file);



$i=0;
$data = explode("/", $text);
   
$_SESSION['lat'] = $data[0];
$_SESSION['long'] = $data[1];
$_SESSION['day'] = $data[2];
$_SESSION['month'] = $data[3];
$_SESSION['year'] = $data[4];
$_SESSION['temp'] = $data[5];
$_SESSION['pressure'] = $data[6];
$_SESSION['timecorr'] = $data[7];   
$_SESSION['sexer'] = $data[8];
$_SESSION['height'] = $data[9];  
   
var_dump($data);   

header("Location: index.php");
ob_flush();

?>



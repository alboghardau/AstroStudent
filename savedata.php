<?php
ob_start();
session_start();
//unlink("data.txt");
$file = fopen("data.txt","w+");
fwrite($file, $_SESSION['lat']."/");
fwrite($file, $_SESSION['long']."/");
fwrite($file, $_SESSION['day']."/");
fwrite($file, $_SESSION['month']."/");
fwrite($file, $_SESSION['year']."/");
fwrite($file, $_SESSION['temp']."/");
fwrite($file, $_SESSION['pressure']."/");
fwrite($file, $_SESSION['timecorr']."/");
fwrite($file, $_SESSION['sexer']."/");
fwrite($file, $_SESSION['height']."/");
fclose($file);

header("Location: index.php");
ob_flush();
?>

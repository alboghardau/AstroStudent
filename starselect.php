<?php
ob_start();
session_start();
$number = $_GET['number'];
$id = $_GET['id'];

if($number == 1 )
{
    $_SESSION['star1id']=$id;
    
 
}
if($number == 2 )
{
    $_SESSION['star2id']=$id;
    
 
}
echo $_SESSION['star1id'];
header("Location: night.php");
ob_flush();
?>

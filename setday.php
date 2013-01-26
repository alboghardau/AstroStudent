<?php
ob_start();
session_start();
include("functions.php");

//sun1 altitude

if(isset($_POST['sun1deg']))
{
    $sun1deg = $_POST['sun1deg'];
} 
else $sun1deg = 0;

if(isset($_POST['sun1min']))
{
    $sun1min = $_POST['sun1min'];
}
else $sun1min = 0;

if(isset($_POST['sun1sec']))
{
    $sun1sec = $_POST['sun1sec'];
}
else $sun1sec = 0;


$_SESSION['sun1h'] = degtonum($sun1deg, $sun1min, $sun1sec);

// sun 1 time

if(isset($_POST['sun1th']))
{
    if(is_numeric($_POST['sun1th']))
    {        
        $_SESSION['sun1th'] = $_POST['sun1th'];        
        }
}
else $_SESSION['sun1th'] = 0;

if(isset($_POST['sun1tm']))
{
         if(is_numeric($_POST['sun1tm']))
     {
    $_SESSION['sun1tm'] = $_POST['sun1tm'];
     }
}
else $_SESSION['sun1tm'] = 0;

if(isset($_POST['sun1ts']))
{
     if(is_numeric($_POST['sun1ts']))
     {
    $_SESSION['sun1ts'] = $_POST['sun1ts'];
    }
}
else $_SESSION['sun1ts'] = 0;

if(isset($_POST['type']))
{
    $_SESSION['type'] = $_POST['type'];
}

header('Location: day.php');
ob_flush();
?>

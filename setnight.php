<?php
ob_start();
session_start();
include("functions.php");

//star1 altitude

if(isset($_POST['star1deg']))
{
    $star1deg = $_POST['star1deg'];
} 
else $star1deg = 0;

if(isset($_POST['star1min']))
{
    $star1min = $_POST['star1min'];
}
else $star1min = 0;

if(isset($_POST['star1sec']))
{
    $star1sec = $_POST['star1sec'];
}
else $star1sec = 0;


$_SESSION['star1h'] = degtonum($star1deg, $star1min, $star1sec);


//star2 altitude

if(isset($_POST['star2deg']))
{
    $star2deg = $_POST['star2deg'];
}
else $star2deg = 0;

if(isset($_POST['star2min']))
{
    $star2min = $_POST['star2min'];
}
else $star2min = 0;

if(isset($_POST['star2sec']))
{
    $star2sec = $_POST['star2sec'];
}
else $star2sec = 0;

  
$_SESSION['star2h'] = degtonum($star2deg, $star2min, $star2sec);



if(isset($_POST['star1th']))
{
    if(is_numeric($_POST['star1th']))
    {        
        $_SESSION['star1th'] = $_POST['star1th'];        
        }
}
else $_SESSION['star1th'] = 0;

if(isset($_POST['star1tm']))
{
         if(is_numeric($_POST['star1tm']))
     {
    $_SESSION['star1tm'] = $_POST['star1tm'];
     }
}
else $_SESSION['star1tm'] = 0;

if(isset($_POST['star1ts']))
{
     if(is_numeric($_POST['star1ts']))
     {
    $_SESSION['star1ts'] = $_POST['star1ts'];
    }
}
else $_SESSION['star1ts'] = 0;



if(isset($_POST['star2th']))
{
        if(is_numeric($_POST['star2th']))
        {
    $_SESSION['star2th'] = $_POST['star2th'];
        }
}
else $_SESSION['star2th'] = 0;



if(isset($_POST['star2tm']))
{
            if(is_numeric($_POST['star2tm']))
        {
    $_SESSION['star2tm'] = $_POST['star2tm'];
        }
}
else $_SESSION['star2tm'] = 0;



if(isset($_POST['star2ts']))
{
            if(is_numeric($_POST['star2ts']))
        {
    $_SESSION['star2ts'] = $_POST['star2ts'];
        }
}
else $_SESSION['star2ts'] = 0;

header("Location: night.php");
ob_flush();
?>

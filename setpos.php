<?php
ob_start();
session_start();
include('functions.php');

//latitude read vars

if(isset($_POST['latdeg']))
    {
   $latdeg = $_POST['latdeg']; 
}else{
    $latdeg = 0;
}
if(isset($_POST['latmin']))
{
    $latmin = $_POST['latmin'];
}else{
    $latmin = 0;
}
if(isset($_POST['latsec']))
{
$latsec = $_POST['latsec'];
}else{
    $latsec = 0;
}
$latname = $_POST['latname'];

//longitude read vars

if(isset($_POST['longdeg']))
{
    $longdeg = $_POST['longdeg'];
}else
{
    $longdeg = 0;
}
if(isset($_POST['longmin']))
{
$longmin = $_POST['longmin'];
}else{
    $longmin = 0;
}
if(isset($_POST['longsec']))
{
    $longsec = $_POST['longsec'];
}else{
    $longsec = 0;
}
$longname = $_POST['longname'];

$_SESSION["lat"] = degtonum($latdeg, $latmin, $latsec);
$_SESSION["long"] = degtonum($longdeg, $longmin, $longsec);

if($latname == "S")
{
    $_SESSION['lat'] = $_SESSION['lat'] * (-1);
}

if($longname == "W")
{
    $_SESSION['long'] = $_SESSION['long'] * (-1);
}


header('Location: index.php');
ob_flush();
?>

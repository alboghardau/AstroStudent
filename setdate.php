<?php
ob_start();
session_start();
if(isset($_POST['day'])){
    $_SESSION['day'] = $_POST['day'];
}
if(isset($_POST['month'])){
    $_SESSION['month'] = $_POST['month'];
}
if(isset($_POST['year'])){
    $_SESSION['year'] = $_POST['year'];
}

if(isset($_POST['pressure']))
{
    $_SESSION['pressure'] = $_POST['pressure'];
}

if(isset($_POST['temp']))
{
    $_SESSION['temp'] = $_POST['temp'];
}

if(isset($_POST['timecorr']))
{
    $_SESSION['timecorr'] = $_POST['timecorr'];
}

if(isset($_POST['sexer']))
{
    $_SESSION['sexer'] = $_POST['sexer'];
}

if(isset($_POST['height']))
{
    $_SESSION['height'] = $_POST['height'];
}

header("Location: index.php");
ob_flush();
?>

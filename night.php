<?php
session_start();
$_SESSION['page']=3;

include("functions.php");
include("settings.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
    <head>
         <title>Astro Demo</title>
         <link rel="stylesheet" href="style/style.css" type="text/css" />
    </head>
    <body>
     <div id="topspace"></div>   
        <div id="main">

<div id="topbar">
    
<?php include("menu.php"); ?>

</div>
<div id="contentmain">
  
        <form action="setnight.php" method="post">
        <table class="start"><tr>
                <td class="space"></td>
                <td>Star h:</td>
                <td class="input"><input class="trans" type="text" name="star1deg" value="<?php if(isset($_SESSION['star1h'])) { echo only_deg($_SESSION['star1h']); }?>"/></td>
                <td class="space">&deg</td>
                <td class="input"><input class="trans" type="text" name="star1min" value="<?php if(isset($_SESSION['star1h'])) { echo only_min($_SESSION['star1h']); }?>"/></td>
                <td class="space">'</td>
                <td class="input"><input class="trans" type="text" name="star1sec" value="<?php if(isset($_SESSION['star1h'])) { echo only_sec($_SESSION['star1h']); }?>"/></td>
                <td>"</td>
                <td>
   
                                       
 
                    
                </td>
            </tr><tr>
                <td class="space"></td>
                <td>Star Time:</td>
                <td class="input"><input class="trans" type="text" name="star1th" value="<?php if(isset($_SESSION['star1th'])) { echo $_SESSION['star1th']; }?>"/></td>
                <td class="space">h</td>
                <td class="input"><input class="trans" type="text" name="star1tm" value="<?php if(isset($_SESSION['star1tm'])) { echo $_SESSION['star1tm']; }?>"/></td>
                <td class="space">min</td>
                <td class="input"><input class="trans" type="text" name="star1ts" value="<?php if(isset($_SESSION['star1ts'])) { echo $_SESSION['star1ts']; }?>"/></td>
                <td>sec</td>

         
            <td></td><td><input type="image" class="submitbt" /></td></tr></table>
        </form>
</div>
<div id="lowbar">
    
    <?php include("nightresult.php");?>
    
</div>
             <div id="low"></div>
        </div>
    </body>
</html>
<?php
session_start();
$_SESSION['page']=2;

include("functions.php");
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
  
    <form action="setday.php" method="post">
        <table class="start"><tr>
                <td class="space"></td>
                <td>Sun h:</td>
                <td class="input"><input class="trans" type="text" name="sun1deg" value="<?php if(isset($_SESSION['sun1h'])) { echo only_deg($_SESSION['sun1h']); }?>"/></td>
                <td class="space">&deg</td>
                <td class="input"><input class="trans" type="text" name="sun1min" value="<?php if(isset($_SESSION['sun1h'])) { echo only_min($_SESSION['sun1h']); }?>"/></td>
                <td class="space">'</td>
                <td class="input"><input class="trans" type="text" name="sun1sec" value="<?php if(isset($_SESSION['sun1h'])) { echo only_sec($_SESSION['sun1h']); }?>"/></td>

                <td>"</td>
                <td class="space"></td>
                <td>Bord inferior<input type="radio" name="type" value="l" <?php if(isset($_SESSION['type'])&&($_SESSION['type']=="l")) { echo 'checked="checked"';}?>/></td>
                <td class="space"></td>
                <td>Bord superior<input type="radio" name="type" value="u" <?php if(isset($_SESSION['type'])&&($_SESSION['type']=="u")) { echo 'checked="checked"';}?>/></td>
            
            </tr>
            
            <tr>
                <td class="space"></td>
                <td>Sun Time:</td>
                <td class="input"><input class="trans" type="text" name="sun1th" value="<?php if(isset($_SESSION['sun1th'])) { echo $_SESSION['sun1th']; }?>"/></td>
                <td class="space">h</td>
                <td class="input"><input class="trans" type="text" name="sun1tm" value="<?php if(isset($_SESSION['sun1tm'])) { echo $_SESSION['sun1tm']; }?>"/></td>
                <td class="space">min</td>
                <td class="input"><input class="trans" type="text" name="sun1ts" value="<?php if(isset($_SESSION['sun1ts'])) { echo $_SESSION['sun1ts']; }?>"/></td>
                <td>sec</td>

            </tr>
               
                    

            </tr>
            <tr><td></td><td><input type="image" class="submitbt" /></td></tr></table>
        </form>
                    </div>                 
                    
<div id="lowbar">
    
    <?php include('dayresult.php');?>
    
</div>
 <div id="low"></div>
        </div>
    </body>
</html>
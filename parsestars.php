<?php 


$year = $_POST['year'];
$sday = $_POST['sday'];
$smonth = $_POST['smonth'];
$text = $_POST['data'];
$eday = $_POST['eday'];
$emonth = $_POST['emonth'];

?>



<form action="parsestars.php" method="post">
    <input type="text" name="sday" value="<?php  echo $sday;?>"/>startday
    <input type="text" name="smonth" value="<?php  echo $smonth;?>"/>startmonth
        <input type="text" name="eday" value="<?php  echo $eday;?>"/>endday
    <input type="text" name="emonth" value="<?php  echo $emonth;?>"/>endmonth
    <input type='text' name="year" value="<?php  echo $year;?>"/>year
    <input type="text" name="data"/>data
    <input type="submit"/>
</form>

<?php

include("settings.php");

$startdate = gmmktime(0, 0, 0, $smonth, $sday, $year);
$enddate = gmmktime(23, 59, 59, $emonth, $eday, $year);


$text = str_replace("\n"," ",$text);
$text = str_replace(" Aust.","",$text);
$text = str_replace(" Kent","",$text);
$text = str_replace("  "," ",$text);
echo $text;
echo '<br/>';
$i=0;


$data = explode (" ",$text);

$last= sizeof($data);
var_dump($data);
echo $last;

for($a = 0; $a < $last/6;$a++)
{
    $data[$a*6] =  str_replace('°','',$data[$a*6]);
    $data[$a*6+3] =  str_replace('°','',$data[$a*6+3]);
    $data[$a*6+2] =  str_replace("'",'',$data[$a*6+2]);   
    $data[$a*6+4] =  str_replace("'",'',$data[$a*6+4]);
            

if($data[$a*6+5] == "N")
{
    $data[$a*6+5]=1;
}
if($data[$a*6+5] == "S")
{
    $data[$a*6+5]=-1;
}
    
$newdata[$a*3]=$data[$a*6];
$newdata[$a*3+1]=$data[$a*6+1]+$data[$a*6+2]/6/10;
$newdata[$a*3+2]=($data[$a*6+3]+$data[$a*6+4]/6/10)*$data[$a*6+5];
}
   
    include('settings.php');
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);

for($b = 0; $b <sizeof($newdata)/3;$b++)
{
    
    $query = "INSERT INTO stars (idstar,startdate,enddate,sha,declination) VALUES (".$b.",".$startdate.",".$enddate.",".$newdata[$b*3+1].",".$newdata[$b*3+2].")";
   mysql_query($query);
    echo $query."<br/>";
}




mysql_close($conn);

   

var_dump($newdata);

?>

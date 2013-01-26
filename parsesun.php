<?php 
//error_reporting(E_ALL ^ E_NOTICE);

$year = $_POST['year'];
$sday = $_POST['sday'];
$smonth = $_POST['smonth'];
$text = $_POST['data'];



?>



<form action="parsesun.php" method="post">
    <input type="text" name="sday" value="<?php  echo $sday;?>"/>startday
    <input type="text" name="smonth" value="<?php  echo $smonth;?>"/>startmonth

    <input type='text' name="year" value="<?php  echo $year;?>"/>year
    <input type="text" name="data"/>data
    <input type="submit"/>
</form>

<?php



$startdate = gmmktime(0, 0, 0, $smonth, $sday, $year);



$text = str_replace("\n","*",$text);

$text = str_replace("  "," ",$text);

echo $text;
echo '<br/>';
$i=0;


$data = explode (' ',$text);

$last= sizeof($data);
//var_dump($data);
echo $last;

//var_dump(strpos($text,"a"));
$a = 0;
for($i=0;$i<$last;$i++)
{
   if((strpos($data[$i],"\260")!= NULL)&&(($data[$i+4])=="S")||(($data[$i+4])=="N"))
   {
       echo $i;
       $dec = $data[$i+2];
       echo "<br/>".$dec;
       if($data[$i+4]=='N')
       {
       $sign = 1;
       }
       if($data[$i+4]=='S')
       {
       $sign = -1;
       }
       
       $data[$i+1] = str_replace("'", "", $data[$i+1]);
       $data[$i+3] = str_replace("'", "", $data[$i+3]);
       
       $newdata[$a] = $data[$i]+$data[$i+1]/60;
       $newdata[$a+1] = ($data[$i+2]+$data[$i+3]/60)*$sign;
       $a = $a+2;
   }
   if((strpos($data[$i],"\260")!= NULL)&&(strpos($data[$i+1],"'")!= NULL)&&(strpos($data[$i+2],"'")!= NULL)) 
           
   {
       echo $i;
       $data[$i+1] = str_replace("'", "", $data[$i+1]);
       $data[$i+2] = str_replace("'", "", $data[$i+2]);
       $newdata[$a]= $data[$i]+$data[$i+1]/60;
       $newdata[$a+1] = ($dec + $data[$i+2]/60)*$sign;
       
       $a = $a+2;
   }
}
var_dump($newdata);

include("settings.php");

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
$db = mysql_select_db($data, $conn);
   
for($i = 0;$i <sizeof($newdata);$i=$i+2)
{
    $query = "INSERT INTO sun VALUES (".$startdate.",".($startdate+3599).",". $newdata[$i].",".$newdata[$i+1].");";
    $startdate = $startdate + 3600;
    
    mysql_query($query,$conn);
    echo mysql_error()."<br/>";
    
    echo $query ."<br/>";
    
}

mysql_close($conn);

?>

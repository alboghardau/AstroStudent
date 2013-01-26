<?php
include("settings.php");

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
   $query = "SELECT * FROM stars ORDER BY startdate";
    
    $result = mysql_query($query);
    $row2 = mysql_fetch_array($result);
    
    $sd = $row2["startdate"];
    
    while($row = mysql_fetch_array($result))
    {
        

        $ed = $row["enddate"];
       
}
    
$startdate = gmmktime(0, 0, 0, 1, 1, 2003);
//echo $startdate."<br/>";
echo "Stars Database: ".date("j-F-Y",$sd)." -- ";
echo date("j-F-Y",$ed);
//echo gmmktime(0, 0, 0, 1, 1, 2003);       
        mysql_close($conn);
?>



<?php
//deactivate notices
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
/*
if(isset($_SESSION['star1h'])&&isset($_SESSION['temp'])&&isset($_SESSION['pressure']))
{

    echo "<td>Star 1 Alt:</td><td>";
    $star1h = $_SESSION['star1h'];
    $star1h = $star1h - meanrefraction($star1h)+degtonum(0,tempcorr($star1h,$_SESSION['temp']),0)+degtonum(0,  prescor($star1h, $_SESSION['pressure']),0);
    //var_dump(tempcorr($star1h,0));
    echo finddeg($star1h)."&deg ".  findmin($star1h)."'";
    echo '</td>';
    
}*/
?>
<table><tr>
        
        <?php
   
        
if(isset($_SESSION['star1th'])&&isset($_SESSION['star1tm'])&&isset($_SESSION['star1ts']))    
{
    $time = gmmktime($_SESSION['star1th'], $_SESSION['star1tm'], $_SESSION['star1ts'], $_SESSION['month'], $_SESSION['day'], $_SESSION['year']);
    $corr = $_SESSION['timecorr'];
    $time = $time + $_SESSION['timecorr'];
    
}
?>
</tr></table>
<br/>

<table><tr>
<?php
if(isset($_SESSION['star1th'])&&isset($_SESSION['star1tm'])&&isset($_SESSION['star1ts'])&&isset($_SESSION['star1id']))    
{


    $gha2 = find_gha($_SESSION['star1ts'], $_SESSION['star1tm'], $_SESSION['star1th'], $_SESSION['day'], $_SESSION['month'], $_SESSION['year']);
    
    echo "<td>GHA Aries:</td>";
    echo "<td>".finddeg($gha2)."&deg ".findmin($gha2)."'</td>";
    echo "</tr><tr>";

    
    $sha =  find_sha($_SESSION['day'], $_SESSION['month'], $_SESSION['year'], $_SESSION['star1id']);
    echo "<td>SHA:</td>";
    echo '<td>'.finddeg($sha)."&deg ".findmin($sha)."'</td>";   



    
     
    echo "</tr><tr>";

    
        if(isset($gha2)&&isset($sha)&&isset($_SESSION['long']))
    {
        echo '<td>Unghi la Pol:</td><td>';
        $pol1 = polarangle($gha2, $sha, $_SESSION['long']);

        
        if($pol1 <=180)
        {
            echo finddeg($pol1).'&deg '.findmin($pol1)."'";
            $tippol1 = "Pw";
            echo " Pw";
        }
        
        if($pol1 >180)
        {
            $pol1 = 360-$pol1;
            echo finddeg($pol1).'&deg '.findmin($pol1)."'";
            echo " Pe";
            $tippol1 = "Pe";
        }
        echo "</td>";
        echo "</tr><tr>";
    }
    
                if(isset($_SESSION['star1id'])&&isset($_SESSION['day'])&&isset($_SESSION['month'])&&isset($_SESSION['year']))
            {
                echo "<td>Declinatie:</td><td>";
                $star1dec = find_stardec($_SESSION['day'],$_SESSION['month'],$_SESSION['year'],$_SESSION['star1id']);
                echo finddeg($star1dec).'&deg '.findmin($star1dec)."'";
                echo "</td>";
            }
    
}




?>


<?php

if(isset($_SESSION['star1th'])&&isset($_SESSION['star1tm'])&&isset($_SESSION['star1ts']))    
{

    $gha = find_gha($_SESSION['star1ts'], $_SESSION['star1tm'], $_SESSION['star1th'], $_SESSION['day'], $_SESSION['month'], $_SESSION['year']);

    
}
?>


<?php

if(isset($_SESSION['star1h'])&&isset($_SESSION['temp'])&&isset($_SESSION['pressure']))
{
    $star1h = $_SESSION['star1h'];
    $star1hg = $_SESSION['star1h'];

    $sexer = degtonum(0, $_SESSION['sexer'], 0);

    
    $star1h = $star1h + $sexer;

    $depr = dip($_SESSION['height']);
;
    $star1h = $star1h-$depr;

    $mean = meanrefraction($star1hg);
    
    $t = degtonum(0,tempcorr($star1hg,$_SESSION['temp']),0);
  
    $p = degtonum(0,prescor($star1hg,$_SESSION['pressure']),0);


    echo "</tr><tr>";
    echo '<td>H Corectat:</td>';    
    $star1h = $star1h - $mean + $t + $p;
    echo '<td>'.finddeg($star1h)."&deg ".  findmin($star1h)."'</td>";
  
    $dh = $star1h - $he1;

    

    $star1h = $star1h - meanrefraction($star1h)+degtonum(0,tempcorr($star1h,$_SESSION['temp']),0)+degtonum(0,  prescor($star1h, $_SESSION['pressure']),0);
    //var_dump(tempcorr($star1h,0));
    //echo finddeg($star1h)."&deg ".  findmin($star1h)."'";
    echo '</td>';

    
}
?>
 

<?php
/*  

if(isset($_SESSION['star1th'])&&isset($_SESSION['star1tm'])&&isset($_SESSION['star1ts']))    
{
    echo "<td>Star 1 GHA:</td><td>";
    $gha = find_gha($_SESSION['star1ts'], $_SESSION['star1tm'], $_SESSION['star1th'], $_SESSION['day'], $_SESSION['month'], $_SESSION['year']);
    echo finddeg($gha)."&deg ".findmin($gha)."'";
    echo "</td>";
    
}

    if(isset($_SESSION['star1id']))
    {
        echo '<td>Star 1 SHA:</td><td>';
        $sha =  find_sha($_SESSION['day'], $_SESSION['month'], $_SESSION['year'], $_SESSION['star1id']);
        echo finddeg($sha).'&deg '.findmin($sha)."'";
        echo "</td>";
    }
        
    if(isset($gha)&&isset($sha)&&isset($_SESSION['long']))
    {
        echo '<td>Star 1 P:</td><td>';
        $pol1 = polarangle($gha, $sha, $_SESSION['long']);

        
        if($pol1 <=180)
        {
            echo finddeg($pol1).'&deg '.findmin($pol1)."'";
            $tippol1 = "Pw";
            echo " Pw";
        }
        
        if($pol1 >180)
        {
            $pol1 = 360-$pol1;
            echo finddeg($pol1).'&deg '.findmin($pol1)."'";
            echo " Pe";
            $tippol1 = "Pe";
        }
        echo "</td>";
    }
    */
    ?>
        
    </tr>    
    <tr>
            <?php 
          
            
            if(isset($_SESSION['star1id'])&&isset($_SESSION['day'])&&isset($_SESSION['month'])&&isset($_SESSION['year']))
            {
                echo "<td>Declinatie:</td><td>";
                $star1dec = find_stardec($_SESSION['day'],$_SESSION['month'],$_SESSION['year'],$_SESSION['star1id']);
                echo finddeg($star1dec).'&deg '.findmin($star1dec)."'";
                echo "</td>";
                echo "</tr><tr>";
            }
            

            
            if(isset($star1dec)&&isset($_SESSION['lat'])&&isset($pol1))
            {
                echo "<td>H Estimat:</td><td>";
                $he1 = calc_he($_SESSION['lat'],$star1dec,$pol1);

                echo finddeg($he1).'&deg '.findmin($he1)."'";
                echo '</td>';
                echo "</tr><tr>";
              
            }
 
           
           if(isset($_SESSION['lat'])&&isset($he1)&&isset($star1dec)&&isset($pol1)&&isset($tippol1))
           {
               echo "<td>Azimut:</td><td>";
               $az1 = calc_az($_SESSION['lat'], $he1, $star1dec, $pol1, $tippol1);
               echo $az1.'&deg ';
               echo "</td>";
           }

           ?> 
            
            
</tr></table>




<?php

include('settings.php');

    if(isset($_SESSION['day'])&&isset($_SESSION['month'])&&isset($_SESSION['year'])&&isset($gha)&&isset($_SESSION['long']))
    {

$conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $date = gmmktime(12, 0, 0, $_SESSION['month'], $_SESSION['day'], $_SESSION['year']);
    
    $query = "SELECT * FROM stars WHERE startdate<".$date." AND enddate>".$date;
    
    $result = mysql_query($query);
    
    echo '<table>';
    
    $a=0;

    while($row = mysql_fetch_array($result))
    {
    
        $polx = polarangle($gha, $row['sha'], $_SESSION['long']);
               
        if($polx >180)
        {
            $polx = 360-$polx;
        }
        
        $hex = calc_he($_SESSION['lat'],$row['declination'],$polx);
                
         
                
                if($a / 6 == 0)
                {
                    echo "<tr>";
                }
              
              
              $query2 = "SELECT * FROM starsname WHERE id=".$row['idstar'];
              
              $result2 = mysql_query($query2);
              
              $row2 = mysql_fetch_array($result2);
              
              echo "<td>".$row2['name']." ".'<a href="starselect.php?number=1&id='.$row2['id'].'"><img src="img/star.png" alt="star"/></a></td>';
              
              
              if($a % 6 == 5)
                {
                    echo "</tr>";
                }
              $a++;
       
}
    }
    echo '</tr></table>';

?>


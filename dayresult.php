<table><tr>
        
        <?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        

?>

<?php
if(isset($_SESSION['sun1th'])&&isset($_SESSION['sun1tm'])&&isset($_SESSION['sun1ts']))    
{
    $time = gmmktime($_SESSION['sun1th'], $_SESSION['sun1tm'], $_SESSION['sun1ts'], $_SESSION['month'], $_SESSION['day'], $_SESSION['year']);
    $corr = $_SESSION['timecorr'];
    
    $time = $time + $_SESSION['timecorr'];
}


if(isset($_SESSION['sun1h'])&&isset($_SESSION['temp'])&&isset($_SESSION['pressure']))
{
    
   
    $sun1h = $_SESSION['sun1h'];
    $sun1hg = $_SESSION['sun1h'];

    $sexer = degtonum(0, $_SESSION['sexer'], 0);

    
    $sun1h = $sun1h + $sexer;

    $depr = dip($_SESSION['height']);

    $sun1h = $sun1h-$depr;

  
    $mean = meanrefraction($sun1hg);
 
    $t = degtonum(0,tempcorr($sun1h,$_SESSION['temp']),0);

  
    $p = degtonum(0,prescor($sun1h,$_SESSION['pressure']),0);

    
    
    $sunsd = sunsd($sun1hg,$time,$_SESSION['type']);

    $sun1h = $sun1h - $mean + $t + $p + $sunsd;

    echo "</tr><tr>";
    
    echo '<td>H corectat</td>';    
    $dh = $sun1h;
    echo '<td>'.finddeg($dh)."&deg ".  findmin($dh)."'</td>";
    echo "</tr><tr>";
    

  
    
}


$gha1 = find_sungha($_SESSION['sun1ts'],$_SESSION['sun1tm'],$_SESSION['sun1th'],$_SESSION['day'],$_SESSION['month'],$_SESSION['year']);
echo '<td>GHA: </td><td>'. finddeg($gha1).'&deg'.findmin($gha1)."'";
echo "</tr><tr>";
  


$dec1 = find_sundec($_SESSION['sun1ts'],$_SESSION['sun1tm'],$_SESSION['sun1th'],$_SESSION['day'],$_SESSION['month'],$_SESSION['year']);
echo '<td>Declinatie: </td><td>'. finddeg($dec1).'&deg'.findmin($dec1)."'";
echo "</tr><tr>";
   

    if(isset($gha1)&&isset($_SESSION['long']))
    {
        echo '<td>Unghi la pol:</td><td>';
        $pol1 = $gha1+$_SESSION['long'];

        if($pol1 >= 360)
        {
            $pol1 = $pol1 - 360;
    }
        
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
    
    
    
                if(isset($dec1)&&isset($_SESSION['lat'])&&isset($pol1))
            {
                echo "<td>H estimat:</td><td>";
                $he1 = calc_he($_SESSION['lat'],$dec1,$pol1);

                echo finddeg($he1).'&deg '.findmin($he1)."'";
                echo '</td>';
                echo "</tr><tr>";
              
            }
            
            
                       if(isset($_SESSION['lat'])&&isset($he1)&&isset($dec1)&&isset($pol1)&&isset($tippol1))
           {
               echo "<td>Azimut:</td><td>";
               $az1 = calc_az($_SESSION['lat'], $he1, $dec1, $pol1, $tippol1);
               echo $az1.'&deg ';
               echo "</td>";
           }
           
           
?>       
    
        
</tr></table>    </td></tr></table>
<?php

function only_min($deg)
{
    if($deg<0)
    {
        $deg = $deg * -1;
    }
    $min = ($deg - floor($deg))*60;
    $min = floor($min);
    
    return $min;
}

function only_sec($deg)
{
    if($deg<0)
    {
        $deg = $deg * -1;
    }
    
    $min = ($deg - floor($deg))*60;
    $min = floor($min);
    $sec = $deg - floor($deg) - $min/60;
    
    return round($sec*3600,0);
}

function only_deg($deg)
{
        if($deg<0)
    {
        $deg = $deg * -1;
    }   
    
    return floor($deg);
}
//converts deg to number

function degtonum($deg,$min,$sec)
{
  $number = $deg+$min/60+$sec/3600;
  return $number;
}

//finds deg of a converted deg

function finddeg($deg)
{
    if($deg<0)
    {
        return ceil($deg);
    }
    return floor($deg);
}

//finds minutes of a converted deg

function findmin($deg)
{
    if($deg<0)
    {
        $min = ($deg-ceil($deg))*60*-1;
        $min = round($min,1);
    }
    if($deg >= 0)
    {
    $min = ($deg - floor($deg))*60;
    $min = round($min,1);
    }
    return $min;
}

//finds mean refraction

function meanrefraction($deg)
{
    include('settings.php');
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM refraction";
    
    $result = mysql_query($query);
    
    while($row = mysql_fetch_array($result))
    {
        if( $deg >= $row['angle'])
        {
            $mindeg = $row['angle'];
            $mincor = $row['corr'];          
        }
        if( $row['angle'] >= $deg)
        {
            $maxdeg = $row['angle'];
            $maxcor = $row['corr'];
            break;
        }
    }
    //solving division by zero warning
    if (($mincor-$maxcor)!=0)
    {
    $corr = ($mincor-$maxcor)*($deg-$mindeg)/($maxdeg-$mindeg);
    }
    if (($mincor-$maxcor)==0){
        $corr = 0;
    }
    
    
    
    $corr = $mincor - $corr;
    mysql_close($conn);
    return degtonum(0,$corr,0);


}

function correct($deg,$min,$sec)
{

    
    $angle = degtonum($deg, $min, $sec);
    
    $refraction = meanrefraction($angle);

    $angle = $angle - $refraction;
    return $angle;
}


function tempcorr($deg,$temp)
{
    include('settings.php');
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM temperature";
    
    $result = mysql_query($query);
    
    while($row = mysql_fetch_array($result))
    {
                if( $deg >= $row['degree'])
                {
                $mindeg = $row['degree'];

                }
                if( $row['degree'] >= $deg)
                {
                $maxdeg = $row['degree'];
                break;
                }
    }

    $query = "SELECT * FROM temperature WHERE degree=".$mindeg;
    $result2 = mysql_query($query);
    $row2 = mysql_fetch_array($result2);
    
    //calc coll name
    
    $mintemp = strval(floor($temp/5)*5);
    $maxtemp = strval(ceil($temp/5)*5);
    
    //fix for -0 coll name error
    
    if($maxtemp == "-0")
    {
        $maxtemp = "0";
    }
    if($maxtemp == "-0")
    {
        $mintemp = "0";
    }
    
    $corrNW = $row2[$mintemp];
    $corrNE = $row2[$maxtemp];
    
    $query = "SELECT * FROM temperature WHERE degree=".$maxdeg;
    $result3 = mysql_query($query);
    $row3 = mysql_fetch_array($result3);
    
    $corrSW = $row3[$mintemp];
    $corrSE = $row3[$maxtemp];
    
    //+0.000001 to fix division by 0
    
    $corrLH = $corrNW-($corrNW-$corrSW)*($deg-$mindeg)/($maxdeg-$mindeg+0.000001);
    $corrRH = $corrNE-($corrNE-$corrSE)*($deg-$mindeg)/($maxdeg-$mindeg+0.000001);
    
    $corr = $corrLH-($corrLH-$corrRH)*($temp-$mintemp)/($maxtemp-$mintemp+0.000001);
    
   
    mysql_close($conn);
    return $corr;
    //return degtonum(0,$corr,0);


}


function find_gha($sec, $min, $hour, $day, $month, $year)
{
    include("settings.php");
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM gha WHERE year=".$year;
    
    $result = mysql_query($query);
    
    $row = mysql_fetch_array($result);
    
    $refrdate = gmmktime(0, 0, 0, 1, 1, $year);
    $refrGHA = $row['angle'];
    $GHAct = 15.04106873;
    
    $nowdate = gmmktime($hour, $min, $sec, $month, $day, $year);
    
    if(isset($_SESSION['timecorr']))
    {
        $nowdate = $nowdate + $_SESSION['timecorr'];
    }
    
    if($nowdate >= $refrdate)
    {
        $gha = $refrGHA+(($nowdate-$refrdate)/3600*$GHAct);
        $gha = $gha-floor($gha/360)*360;
    }
    
    mysql_close($conn);
    
    return $gha;
}

function find_sha($day , $month, $year, $starid)
{
    include("settings.php");
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $date = gmmktime(12, 0, 0, $month, $day, $year);
    
    $query = "SELECT * FROM stars WHERE idstar=".$starid." AND startdate<".$date." AND enddate>".$date;
    
    $result = mysql_query($query);
    
    $row = mysql_fetch_array($result);
    
    $result = mysql_query($query);    
    
    mysql_close($conn);
    
    return $row['sha'];

}

function polarangle($gha,$sha,$long)
{
    $polar = $gha+$sha+$long;
    
    if($polar >= 360){
    $polar = $polar - 360;    
    }
    

    
    
    
    return $polar;
}


function find_stardec($day , $month, $year, $starid)
{
    include("settings.php");
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $date = gmmktime(12, 0, 0, $month, $day, $year);
    
    $query = "SELECT * FROM stars WHERE idstar=".$starid." AND startdate<".$date." AND enddate>".$date;
    
    $result = mysql_query($query);
    
    $row = mysql_fetch_array($result);
    
    $result = mysql_query($query);    
    
    mysql_close($conn);
    
    return $row['declination'];

}


function calc_he($lat,$dec,$pol)
{
    
    $sinhe = sin(deg2rad($lat))*sin(deg2rad($dec))+cos(deg2rad($lat))*cos(deg2rad($dec))*cos(deg2rad($pol));
    
    $a = sin($lat)*sin($dec);
    
    $he = asin($sinhe);

    return $he*180/pi();

    
}

function calc_az($lat,$he,$dec,$pol,$tippol)
{
    $sinz = sin(deg2rad($pol))*(1/cos(deg2rad($he)))*cos(deg2rad($dec));    
   
    $z = asin($sinz)*180/pi();    
    
    $sinhi = sin(deg2rad($dec))*(1/sin(deg2rad($lat)));
    
    $hi = asin($sinhi)*180/pi();
    
    
    if($lat*$dec <0)
    {
        if($lat >= 0)
        {
            $cont = "S";
        }
        if($lat < 0)
        {
            $cont = "N";
        }
    }
   
    
    if($lat*$dec >=0)
    {
        if($dec<$lat)
        {
            if($he > $hi)
            {
                        if($lat >= 0)
        {
            $cont = "S";
        }
                        if($lat < 0)
        {
            $cont = "N";
        }
            }
            if($he < $hi)
            {
                            if($lat >= 0)
        {
            $cont = "N";
        }
                            if($lat < 0)
        {
            $cont = "S";
        }
            }
        }
        if($lat<$dec)
        {
            if($lat >= 0)
        {
            $cont = "N";
        }
            if($lat < 0)
        {
            $cont = "S";
        }
        }
    }
    
    $nume = $cont.$tippol;
    
    if($nume == "NPe")
    {
        $az = $z;
    }
      if($nume == "NPw")
    {
        $az = 360-$z;
    }
      if($nume == "SPe")
    {
        $az = 180-$z;
    }
      if($nume == "SPw")
    {
        $az = $z+180;
    }
    
    $az = round($az, 1);
    return $az;
}





function prescor($deg,$press)
{
    include('settings.php');
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM pressure";
    
    $result = mysql_query($query);
    
    while($row = mysql_fetch_array($result))
    {
                if( $deg >= $row['degree'])
                {
                $mindeg = $row['degree'];

                }
                if( $row['degree'] >= $deg)
                {
                $maxdeg = $row['degree'];
                break;
                }
    }

    $query = "SELECT * FROM pressure WHERE degree=".$mindeg;
    $result2 = mysql_query($query);
    $row2 = mysql_fetch_array($result2);
    
    //calc coll name
    
    if($press>=960 && $press <980)
    {
        $mintemp = 960;
        $maxtemp = 980;
    }
     if($press>=980 && $press <1000)
    {
        $mintemp = 980;
        $maxtemp = 1000;
    }
      if($press>=1000 && $press <1020)
    {
        $mintemp = 1000;
        $maxtemp = 1020;
    }
          if($press>=1020 && $press <1030)
    {
        $mintemp = 1020;
        $maxtemp = 1030;
    }
    
    $corrNW = $row2[$mintemp];
    $corrNE = $row2[$maxtemp];
    
    $query = "SELECT * FROM pressure WHERE degree=".$maxdeg;
    $result3 = mysql_query($query);
    $row3 = mysql_fetch_array($result3);
    
    $corrSW = $row3[$mintemp];
    $corrSE = $row3[$maxtemp];
    
    //+0.000001 to fix division by 0
    
    $corrLH = $corrNW-($corrNW-$corrSW)*($deg-$mindeg)/($maxdeg-$mindeg+0.000001);
    $corrRH = $corrNE-($corrNE-$corrSE)*($deg-$mindeg)/($maxdeg-$mindeg+0.000001);
    
    $corr = $corrLH-($corrLH-$corrRH)*($press-$mintemp)/($maxtemp-$mintemp+0.000001);
    
   
    mysql_close($conn);
    return $corr;
    //return degtonum(0,$corr,0);

    
}


function find_sungha($sec, $min, $hour, $day, $month, $year)
{
    include("settings.php");
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $date = gmmktime($hour, $min, $sec, $month, $day, $year);
    
    $query = "SELECT * FROM sun WHERE startdate<=".$date." AND enddate>".$date;
    
    $result = mysql_query($query);
    
    $row = mysql_fetch_array($result);
    
    $Ngha = $row['gha'];
    
    $date = $date + 3600;
    
    $query = "SELECT * FROM sun WHERE startdate<=".$date." AND enddate>".$date;
    
    $result2 = mysql_query($query);
    
    $row2 = mysql_fetch_array($result2);
    
    $Sgha = $row2['gha'];
    
    mysql_close($conn);
    
    if($Sgha < $Ngha)
    {
        $Sgha = $Sgha +360;
    }
    
    $gha= $Ngha + ($Sgha-$Ngha)*(($date-3600-$row['startdate'])/3600);
    
    
    return $gha;
}


function find_sundec($sec, $min, $hour, $day, $month, $year)
{
    include("settings.php");
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $date = gmmktime($hour, $min, $sec, $month, $day, $year);
    
    $query = "SELECT * FROM sun WHERE startdate<=".$date." AND enddate>".$date;
    
    $result = mysql_query($query);
    
    $row = mysql_fetch_array($result);
    
    $Ngha = $row['dec'];
    
    $date = $date + 3600;
    
    $query = "SELECT * FROM sun WHERE startdate<=".$date." AND enddate>".$date;
    
    $result2 = mysql_query($query);
    
    $row2 = mysql_fetch_array($result2);
    
    $Sgha = $row2['dec'];
    
    mysql_close($conn);
    
    if($Sgha < $Ngha)
    {
        $Sgha = $Sgha +360;
    }
    
    $gha= $Ngha + ($Sgha-$Ngha)*(($date-3600-$row['startdate'])/3600);
    
    
    return $gha;
}


function find_ghanc($sec, $min, $hour, $day, $month, $year)
{
    include("settings.php");
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM gha WHERE year=".$year;
    
    $result = mysql_query($query);
    
    $row = mysql_fetch_array($result);
    
    $refrdate = gmmktime(0, 0, 0, 1, 1, $year);
    $refrGHA = $row['angle'];
    $GHAct = 15.04106873;
    
    $nowdate = gmmktime($hour, $min, $sec, $month, $day, $year);
    
    
    
    if($nowdate >= $refrdate)
    {
        $gha = $refrGHA+(($nowdate-$refrdate)/3600*$GHAct);
        $gha = $gha-floor($gha/360)*360;
    }
    
    mysql_close($conn);
    
    return $gha;
}

function dip($height)
{
    include('settings.php');
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM dip";
    
    $result = mysql_query($query);
    
    while($row = mysql_fetch_array($result))
    {
        if( $height >= $row['height'])
        {
            $mindeg = $row['height'];
            $mincor = $row['dip'];          
        }
        if( $row['height'] >= $height)
        {
            $maxdeg = $row['height'];
            $maxcor = $row['dip'];
            break;
        }
    }
    //solving division by zero warning
    if (($mincor-$maxcor)!=0)
    {
    $corr = ($mincor-$maxcor)*($height-$mindeg)/($maxdeg-$mindeg);
    }
    else {
        $corr = 0;
    }
    
    
    
    $corr = $mincor - $corr;
    mysql_close($conn);
    return degtonum(0,$corr,0);


}

function sunsd($alt,$date,$type)
{
    include('settings.php');
    
    $conn = mysql_connect($mysql[0],$mysql[1],$mysql[2]);
    
    $db = mysql_select_db($data, $conn);
    
    $query = "SELECT * FROM sunsd";
    
    $result = mysql_query($query);
    
    $h = round($alt/30)*30;

        $search = $type.$h;

    
    while($row = mysql_fetch_array($result))
    {
        if(($date<=$row['enddate'])&&($date>=$row['startdate']))
        {
            $corr = $row[$search];
        }
    }
    
    
    
    

    mysql_close($conn);
    return degtonum(0,$corr,0);


}




?>

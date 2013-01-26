<?php


?>
<table class="menu"><tr>
        
       <?php 
       if($_SESSION['page']==1)
       {
           echo '<td><img src="img/day/homepr.png" alt="home" /></td>';
       }
       else
       {
           echo '<td><a href="index.php" class="homebt" ></a></td>';
       }
       ?>
        <td class="space"></td>
        
              <?php 
       if($_SESSION['page']==2)
       {
           echo '<td><img src="img/day/sunpr.png" alt="home" /></td>';
       }
       else
       {
           echo '<td><a href="day.php" class="sunbt" ></a></td>';
       }
       ?> 

<td class="space"></td>

              <?php 
       if($_SESSION['page']==3)
       {
           echo '<td><img src="img/day/moonpr.png" alt="home" /></td>';
       }
       else
       {
           echo '<td><a href="night.php" class="moonbt" ></a></td>';
       }
       ?> 

<td class="space"></td>

              <?php 
       if($_SESSION['page']==4)
       {
           echo '<td><img src="img/day/setpr.png" alt="home" /></td>';
       }
       else
       {
           echo '<td><a href="info.php" class="setbt" ></a></td>';
       }
       ?> 

</tr></table>
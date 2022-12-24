
  <?php
    $Cities=array("cairo","paris","dubai","london","rome","istanbul","delhi","tokyo","moscow","madrid");
    for ($i=0; $i<sizeof($Cities); $i++)
    {
        if(strtolower(substr($Cities[$i],0,strlen($_GET['City'])))==strtolower($_GET['City']))
            echo("<option value='$Cities[$i]'>");
    }
    ?>

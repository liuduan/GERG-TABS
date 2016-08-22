<html>
<head>
<title>Buoy Details</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />
<style type="text/css">
<!--
body
{
background-image:url('../blue-shadow.png');
background-repeat:repeat-x;
} 

-->
</style>


</head>
<body bgcolor="c0c8d6">


<?php
// Create connection
$con = mysqli_connect("localhost","tabs","tabsuser","tabs_status");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  // else {echo '):';}
?>






<h2 class="TITLE-STYLE"><center>Buoy <?=$_GET["buoy"]?> Details</center></h2>



<DIV id = "tool-bar"> 
 <a href="../../Buoy-log/Deployment/deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>




<?php 
// echo '$_GET["buoy"] = ', $_GET["buoy"], '<br>';
		
?>


<p />
<center>
<h2 class="Sub_Title-STYLE">
<a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=<?=$_GET["buoy"]?>">Buoy <?=$_GET["buoy"]?> Data</a><br>




<?php

$SQL_Str = "SELECT * FROM deployment_table2 WHERE site = '". $_GET["buoy"]. "' ORDER BY depl_time Desc limit 1";	

//echo $SQL_Str, '<br>';
$result_Obj = mysqli_query($con, $SQL_Str);

$row = mysqli_fetch_array($result_Obj);

//  echo $row['site'] . " " . $row['depl_time']. " " . $row['checkout'];
  echo "<br>";


?>




<a href="../../Buoy-log/Deployment/report.php?checkout='<?=$row["checkout"];?>'">Buoy <?=$_GET["buoy"]?> Metadata</a>


</H2>



<hr>



<?php

mysqli_close($con);
?>


</body>
</html>
<!--- This file download from www.shotdev.com -->
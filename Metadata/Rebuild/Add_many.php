<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>


<?php
$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("Metadata");

echo "hello.".'<br>';
echo "Old Assembly Number: ". $_GET["Old_checkout"]. '<br>';
echo "System Number and Date: ". $_GET["System_Number"]. '-'.  $_GET["Start_Date"]. '<br>';

if ($_GET["System_Number"] != "" AND $_GET["Start_Date"] != ""){
	$New_checkout = $_GET["System_Number"] . "-". $_GET["Start_Date"];
	}
	else {$New_checkout = $_GET["System_Number"] . $_GET["Start_Date"];}
echo '$New_checkout: '. $New_checkout. '<br>';


print_r($_GET);
echo '<br>';



# Insert a record into Assemblies:
$sql='INSERT INTO Assemblies ( checkout, Component_N )
     SELECT "'. $New_checkout. '", Component_N
      FROM Assemblies WHERE checkout = "'. $_GET["Old_checkout"]. '"';
echo '<br>'. 'The commend: '. $sql.'<br>';
mysql_query($sql) or die(mysql_error());





# Insert a record into deployment_table2:
mysql_select_db("tabs_status");
$sql2='INSERT INTO deployment_table2 ( checkout, Depl_time, Prev_checkout ) Values ("'. $New_checkout. '", "2050-00-00", "'.
$_GET["Old_checkout"]. '")';

echo '<br>'. 'The commend: '. $sql2.'<br>';
mysql_query($sql2) or die(mysql_error());

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./Rebuild.php?New_checkout=<?=$New_checkout;?>&Old_checkout=<? echo $_GET['Old_checkout'];?>"
		//"../../Buoy-log/Deployment/deployment.php"
}
//-->
setTimeout(redirect_page,500);

</script>
<a href="./Rebuild.php?New_checkout=<?=$New_checkout;?>&Old_checkout=<? echo $_GET['Old_checkout'];?>">    Next</a>
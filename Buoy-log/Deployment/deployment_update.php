<?php
include ("authorization.php");
?>
<html>
<head>
<title>Deployment Update</title>
</head>
<body>
<?php

echo "Here is the _POST array: ";
print_r($_POST);


echo $_POST["field3"].'<br>';
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "UPDATE deployment_table2 SET ";
	
	# $strSQL .="checkout = '".$_POST["checkout"]."'";
	$strSQL .=" old_checkout = '".$_POST["old_checkout"]."'";
	$strSQL .=", Buoy_type = '".$_POST["Buoy_type"]."'";
	$strSQL .=", site = '".$_POST["site"]."'";
	$strSQL .=", Seapac_SN = '".$_POST["Seapac_SN"]."'";
	$strSQL .=", Current_Sensor_SN = '".$_POST["Current_Sensor_SN"]."'";
	$strSQL .=", Current_Sensor_model = '".$_POST["Current_Sensor_model"]."'";
	$strSQL .=", Modem_Type = '".$_POST["Modem_Type"]."'";
	$strSQL .=", Deployment_Ship = '".$_POST["Deployment_Ship"]."'";
	$strSQL .=", Depl_time = '".$_POST["Depl_time"]."'";
	$strSQL .=", rec_time = '".$_POST["rec_time"]."'";
	$strSQL .=", Recovery_Ship = '".$_POST["Recovery_Ship"]."'";
	$strSQL .=", Deployed_days = '".$_POST["Deployed_days"]."'";
	$strSQL .=", inclination = '".$_POST["inclination"]."'";

	$strSQL .=", Comments = '".$_POST["Comments"]."'";
	$strSQL .=", NetID = '".$_POST["NetID"]."'";
	$strSQL .=", Last_change = '".$_POST["Last_change"]."'";
	
	
	$strSQL .=" WHERE checkout = '".$_POST["checkout"]."' ";
echo '$_GET["checkout"] = '. $_GET["checkout"]. '<br>';
echo $strSQL. '<br>'.'<br>';
	$objQuery = mysql_query($strSQL) or die(mysql_error());
	
	
	
	
	echo $strSQL;
	if($objQuery)
	{
		echo "Save completed.";
		echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
	}
	else
	{
		echo '$$strSQL;'. $strSQL;
		echo "Error Save [".$strSQL."]";
	}
	mysql_close($objConnect);
?>

<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	/*window.location = "./deployment_display.php?checkout='" + "<? //echo $_POST["checkout"]; ?>" + "'";*/
	window.location = "./deployment.php";
}
//-->
setTimeout(redirect_page,50); /* used to be 5000 */

</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
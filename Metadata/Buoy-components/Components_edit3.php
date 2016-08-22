<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>

<html>
<head>
<title>Edit 3</title>
</head>
<body>
<?php
echo "The _POST array:";
print_r($_POST);
echo '<br>';



echo '<br>';
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("Metadata");
	$strSQL = "UPDATE Components SET ";
	
	$strSQL .="Component_N = '".$_POST["Component_N"]."'";
	$strSQL .=", Component_type = '".$_POST["Component_type"]."'";
	$strSQL .=", Date_received = '".$_POST["Date_received"]."'";
	$strSQL .=", Manufacture = '".$_POST["Manufacture"]."'";
	
	$strSQL .=", Model = '".$_POST["Model"]."'";
	$strSQL .=", Serial_N = '".$_POST["Serial_N"]."'";
	$strSQL .=", Owner = '".$_POST["Owner"]."'";
	$strSQL .=", Inventory_N = '".$_POST["Inventory_N"]."'";
	
	$strSQL .=", Sensor_range = '".$_POST["Sensor_range"]."'";
	$strSQL .=", Factory_precision = '".$_POST["Factory_precision"]."'";
	$strSQL .=", Factory_accuracy = '".$_POST["Factory_accuracy"]."'";
	$strSQL .=", Other_specif = '".$_POST["Other_specif"]."'";

	$strSQL .=", Status = '".$_POST["Status"]."'";
	$strSQL .=", Current_location = '".$_POST["Current_location"]."'";	


if ($_POST["Component_type"] == "Data Modem"){

	$strSQL .=", Repetition_period = '".$_POST["Repetition_period"]."'";	
	$strSQL .=", Platform = '".$_POST["Platform"]."'";	
	$strSQL .=", Firmware = '".$_POST["Firmware"]."'";	
	$strSQL .=", Phone_x121 = '".$_POST["Phone_x121"]."'";
	$strSQL .=", Phone_ESN = '".$_POST["Phone_ESN"]."'";	

	$strSQL .=", Cycle = '".$_POST["Cycle"]."'";	
	$strSQL .=", Offset = '".$_POST["Offset"]."'";	
	$strSQL .=", Call_window = '".$_POST["Call_window"]."'";
	$strSQL .=", Base_number = '".$_POST["Base_number"]."'";	

	$strSQL .=", PTT_ID = '".$_POST["PTT_ID"]."'";	
	$strSQL .=", Argos_PTT_SN = '".$_POST["Argos_PTT_SN"]."'";	
	$strSQL .=", Test_sched = '".$_POST["Test_sched"]."'";
	$strSQL .=", Records_unack = '".$_POST["Records_unack"]."'";	

	$strSQL .=", HEX_ESN = '".$_POST["HEX_ESN"]."'";	
	$strSQL .=", DEC_ESN = '".$_POST["DEC_ESN"]."'";	
	}

if ($_POST["Component_type"] == "Current Meter"){
	$strSQL .=", Average_interval = '".$_POST["Average_interval"]."'";	
	$strSQL .=", Sample_interval = '".$_POST["Sample_interval"]."'";	
	}
	
	$strSQL .=", Calibration_notes = '".$_POST["Calibration_notes"]."'";
	$strSQL .=", Notes = '".$_POST["Notes"]."'";
	
	$strSQL .=" WHERE Component_N = '".$_POST["Component_N"]."' ";

echo $strSQL. '<br>'.'<br>';

	# This line update the fields.
	$objQuery = mysql_query($strSQL) or die(mysql_error("Not recorded."));
	
	


	
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
	window.location = "./Components.php"
}
//-->
setTimeout(redirect_page, 250);

</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
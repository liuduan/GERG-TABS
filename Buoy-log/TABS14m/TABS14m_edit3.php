<?php
include ("../Deployment/authorization.php");
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



echo $_POST["field3"].'<br>';
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "UPDATE TABS14m SET ";
	
	$strSQL .="checkout = '".$_GET["checkout"]."'";
	
	$strSQL .=", system_SN = '".$_POST["system_SN"]."'";
	$strSQL .=", start_date = '".$_POST["start_date"]."'";
	$strSQL .=", Hull_SN = '".$_POST["Hull_SN"]."'";
	$strSQL .=", Site = '".$_POST["Site"]."'";
	$strSQL .=", HEX_ESN = '".$_POST["HEX_ESN"]."'";
	$strSQL .=", deploy_date = '".$_POST["deploy_date"]."'";
	$strSQL .=", Phone = '".$_POST["Phone"]."'";
	$strSQL .=", Technicians = '".$_POST["Technicians"]."'";

	$strSQL .=", ADCP_SN = '".$_POST["ADCP_SN"]."'";
	$strSQL .=", ADCP_port = '".$_POST["ADCP_port"]."'";
	$strSQL .=", MicroCat_SN_a = '".$_POST["MicroCat_SN_a"]."'";
	$strSQL .=", MicroCat_port_a = '".$_POST["MicroCat_port_a"]."'";
	$strSQL .=", MicroCat_SN_b = '".$_POST["MicroCat_SN_b"]."'";
	$strSQL .=", MicroCat_port_b = '".$_POST["MicroCat_port_b"]."'";
    
	$strSQL .=", Gill_SN = '".$_POST["Gill_SN"]."'";
	$strSQL .=", Gill_port = '".$_POST["Gill_port"]."'";
	$strSQL .=", Airmar_SN_a = '".$_POST["Airmar_SN_a"]."'";
	$strSQL .=", Airmar_port_a = '".$_POST["Airmar_port_a"]."'";
	$strSQL .=", Airmar_SN_b = '".$_POST["Airmar_SN_b"]."'";
	$strSQL .=", Airmar_port_b = '".$_POST["Airmar_port_b"]."'";    
	$strSQL .=", Airmar_SN_c = '".$_POST["Airmar_SN_c"]."'";
	$strSQL .=", Airmar_port_c = '".$_POST["Airmar_port_c"]."'";   
	$strSQL .=", Airmar_SN_d = '".$_POST["Airmar_SN_d"]."'";
	$strSQL .=", Airmar_port_d = '".$_POST["Airmar_port_d"]."'";       

	$strSQL .=", TransSystem_SN = '".$_POST["TransSystem_SN"]."'";
	$strSQL .=", TransSystem_port = '".$_POST["TransSystem_port"]."'"; 
	$strSQL .=", Honeywell_SN = '".$_POST["Honeywell_SN"]."'";
	$strSQL .=", Honeywell_port = '".$_POST["Honeywell_port"]."'";    
	$strSQL .=", MicroStrain_SN_a = '".$_POST["MicroStrain_SN_a"]."'";
	$strSQL .=", MicroStrain_port_a = '".$_POST["MicroStrain_port_a"]."'";  
	$strSQL .=", MicroStrain_SN_b = '".$_POST["MicroStrain_SN_b"]."'";
	$strSQL .=", MicroStrain_port_b = '".$_POST["MicroStrain_port_b"]."'";  
	$strSQL .=", MicroStrain_SN_c = '".$_POST["MicroStrain_SN_c"]."'";
	$strSQL .=", MicroStrain_port_c = '".$_POST["MicroStrain_port_c"]."'";  

	$strSQL .=", Iridium_SN = '".$_POST["Iridium_SN"]."'";
	$strSQL .=", Iridium_port = '".$_POST["Iridium_port"]."'"; 
	$strSQL .=", Freewave_SN = '".$_POST["Freewave_SN"]."'";
	$strSQL .=", Freewave_port = '".$_POST["Freewave_port"]."'"; 
    
	$strSQL .=", Sensor_Notes = '".$_POST["Sensor_Notes"]."'"; 

	$strSQL .=", Battery_1a = '".$_POST["Battery_1a"]."'";
	$strSQL .=", Battery_1b = '".$_POST["Battery_1b"]."'";
	$strSQL .=", Battery_1c = '".$_POST["Battery_1c"]."'";
	$strSQL .=", Battery_1d = '".$_POST["Battery_1d"]."'";
	$strSQL .=", Battery_1e = '".$_POST["Battery_1e"]."'";
	$strSQL .=", Battery_1f = '".$_POST["Battery_1f"]."'";

	$strSQL .=", Battery_2a = '".$_POST["Battery_2a"]."'";
	$strSQL .=", Battery_2b = '".$_POST["Battery_2b"]."'"; 
	$strSQL .=", Battery_2c = '".$_POST["Battery_2c"]."'";
	$strSQL .=", Battery_2d = '".$_POST["Battery_2d"]."'";
	$strSQL .=", Battery_2e = '".$_POST["Battery_2e"]."'"; 
	$strSQL .=", Battery_2f = '".$_POST["Battery_2f"]."'";

	$strSQL .=", Battery_3a = '".$_POST["Battery_3a"]."'";
	$strSQL .=", Battery_3b = '".$_POST["Battery_3b"]."'"; 
	$strSQL .=", Battery_3c = '".$_POST["Battery_3c"]."'";
	$strSQL .=", Battery_3d = '".$_POST["Battery_3d"]."'";
	$strSQL .=", Battery_3e = '".$_POST["Battery_3e"]."'"; 
	$strSQL .=", Battery_3f = '".$_POST["Battery_3f"]."'";

	$strSQL .=", Measurements_1 = '".$_POST["Measurements_1"]."'";
	$strSQL .=", Measurements_2 = '".$_POST["Measurements_2"]."'";
	$strSQL .=", Measurements_3 = '".$_POST["Measurements_3"]."'";
	$strSQL .=", Measurements_4 = '".$_POST["Measurements_4"]."'";
	$strSQL .=", Measurements_5 = '".$_POST["Measurements_5"]."'";
	$strSQL .=", Measurements_6 = '".$_POST["Measurements_6"]."'";

	$strSQL .=", Measurements_7 = '".$_POST["Measurements_7"]."'";
	$strSQL .=", Measurements_8 = '".$_POST["Measurements_8"]."'";
	$strSQL .=", Measurements_9 = '".$_POST["Measurements_9"]."'";
	$strSQL .=", Measurements_10 = '".$_POST["Measurements_10"]."'";
	$strSQL .=", Measurements_11 = '".$_POST["Measurements_11"]."'";
	$strSQL .=", Measurements_12 = '".$_POST["Measurements_12"]."'";

	$strSQL .=", Measure_Notes = '".$_POST["Measure_Notes"]."'"; 

	$strSQL .=", Analog_1 = '".$_POST["Analog_1"]."'";
	$strSQL .=", Analog_2 = '".$_POST["Analog_2"]."'";
	$strSQL .=", Analog_3 = '".$_POST["Analog_3"]."'";
	$strSQL .=", Analog_4 = '".$_POST["Analog_4"]."'";
	$strSQL .=", Analog_5 = '".$_POST["Analog_5"]."'";
	$strSQL .=", Analog_6 = '".$_POST["Analog_6"]."'";

	$strSQL .=", Analog_Notes = '".$_POST["Analog_Notes"]."'"; 

	$strSQL .=", Allignment_1 = '".$_POST["Allignment_1"]."'";
	$strSQL .=", Allignment_2 = '".$_POST["Allignment_2"]."'";
	$strSQL .=", Allignment_3 = '".$_POST["Allignment_3"]."'";
	$strSQL .=", Allignment_4 = '".$_POST["Allignment_4"]."'";
	$strSQL .=", Allignment_5 = '".$_POST["Allignment_5"]."'";

	$strSQL .=", Telemetry_1 = '".$_POST["Telemetry_1"]."'";
	$strSQL .=", Telemetry_1_date = '".$_POST["Telemetry_1_date"]."'";
	$strSQL .=", Telemetry_2 = '".$_POST["Telemetry_2"]."'";
	$strSQL .=", Telemetry_2_date = '".$_POST["Telemetry_2_date"]."'";
	$strSQL .=", Telemetry_3 = '".$_POST["Telemetry_3"]."'";
	$strSQL .=", Telemetry_3_date = '".$_POST["Telemetry_3_date"]."'";
	$strSQL .=", Telemetry_4 = '".$_POST["Telemetry_4"]."'";
	$strSQL .=", Telemetry_4_date = '".$_POST["Telemetry_4_date"]."'";

	$strSQL .=", Mechanical_1 = '".$_POST["Mechanical_1"]."'";
	$strSQL .=", Mechanical_7 = '".$_POST["Mechanical_7"]."'";
	$strSQL .=", Mechanical_2 = '".$_POST["Mechanical_2"]."'";
	$strSQL .=", Mechanical_8 = '".$_POST["Mechanical_8"]."'";
	$strSQL .=", Mechanical_3 = '".$_POST["Mechanical_3"]."'";
	$strSQL .=", Mechanical_9 = '".$_POST["Mechanical_9"]."'";

	$strSQL .=", Mechanical_4 = '".$_POST["Mechanical_4"]."'";
	$strSQL .=", Mechanical_10 = '".$_POST["Mechanical_10"]."'";
	$strSQL .=", Mechanical_5 = '".$_POST["Mechanical_5"]."'";
	$strSQL .=", Mechanical_11 = '".$_POST["Mechanical_11"]."'";
	$strSQL .=", Mechanical_5 = '".$_POST["Mechanical_5"]."'";

	$strSQL .=", Mechanical_Notes = '".$_POST["Mechanical_Notes"]."'"; 
	
	$strSQL .=" WHERE checkout = '".$_GET["checkout"]."' ";

echo $strSQL. '<br>'.'<br>';

	# This line update the fields.
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
	window.location = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php"
}
//-->
setTimeout(redirect_page, 250);

</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
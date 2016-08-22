<?php
include ("../Deployment/authorization.php");
?>

<html>
<head>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />
<style type="text/css">
<!--

-->
</style>
<title>TABS 1.4 m Buoy Setup and Testing</title>
</head>
<body>
<center><h3 class="TITLE-STYLE">TABS 1.4 m Buoy Setup and Test</h3></center>

<h4 class="STYLE4">
<center>
<form action="./TABS14m_edit3.php?checkout=<?=$_GET["checkout"]; ?>" name="frmEdit" method="post">
<input type="submit" name="submit" value="Submit & Back"><br><br>

<?php
	# echo $_GET["checkout"].' hh<br>';
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM TABS14m WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found checkout=".$_GET["checkout"];
	}
	else
	{
	?>
<b>

<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
<a href='http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php'> Deployment History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
  <a href="../Deployment/CAS-logout">NetID Logout</a>
</div>


<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><td align="right"><b>Checkout: </td><td><?php echo $objResult["checkout"];?></td>

<td align="right"><b>System S/N:</td>
<td><input type="text" name="system_SN" size="20" value="<?=$objResult["system_SN"];?>"></td>
</tr>

<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Start Date:</td>
<td><input type="text" name="start_date" size="20" value="<?=$objResult["start_date"];?>"></br></td>

<td align="right"><b>Hull S/N:</td>
<td><input type="text" name="Hull_SN" size="20" value="<?=$objResult["Hull_SN"];?>">&nbsp;</td>

</tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Proposed Deployment Site:</td>
<td><input type="text" name="Site" size="20" value="<?=$objResult["Site"];?>"></br></td>


<td align="right">
<b>Globastar HEX ESN:</td><td><input type="text" name="HEX_ESN" size="20" value="<?=$objResult["HEX_ESN"];?>"></br></td>



<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Deployment Date:</td>
<td><input type="text" name="deploy_date" size="20" value="<?=$objResult["deploy_date"];?>"></br></td>



<td align="right"><b>Globalstar Phone:</td>
<td><input type="text" name="Phone" size="20" value="<?=$objResult["Phone"];?>"></br></td></tr>

<tr BGCOLOR="#FFFFCC">


<td align="right"><b>Lead Technician: </td>
<td colspan="3"><input type="text" name="Technicians" size="73" value="<?=$objResult["Technicians"];?>"> </td></tr>

</table>
</b>


<?php
# echo "_SESSION[]: ";
# print_r($_SESSION);
?>


<SCRIPT TYPE="text/javascript">
<!-- 
function signature(form_obj, field_A, field_B_hold, field_B_show){
	// set references to fields
	var field_A_obj = form_obj[field_A];
	var B_hold_obj = form_obj[field_B_hold];
	var B_show_obj = form_obj[field_B_show];
   
	B_hold_obj.value = <?php echo '"'.  $_SESSION["person"]. '"';?>;
	B_show_obj.value = <?php echo '"'.  $_SESSION["person"]. '"';?>;

	not_allowed(form_obj, field_B_hold, field_B_show)
}

function not_allowed(form_obj, field_B_hold, field_B_show){

   var B_hold_obj = form_obj[field_B_hold];
   var B_show_obj = form_obj[field_B_show];

   B_show_obj.value = B_hold_obj.value;
}
// -->
</SCRIPT>

<p><br>





<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><TH>Type</td><TH>Manufacture</b></td><TH><b>Model</b></th>
<TH><b>Serial Number</b></td><TH><b>Range</b></td><TH><b>Port</b></th></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">ADCP: </td><td align="center">Teledyne RDI </td><td align="center">WH600 </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="ADCP_SN" SIZE=15 value="<?=$objResult["ADCP_SN"];?>" ></TD>
<td align="center"> +/- 20 m/s</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="ADCP_port" SIZE=15 value="<?=$objResult["ADCP_port"];?>" ></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Water Temperature: </td>
</td><td align="center">MicroCat</td><td align="center">SBE-37SI</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="MicroCat_SN_a" SIZE=15 value="<?=$objResult["MicroCat_SN_a"];?>" ></TD>
<td align="center">-5 to +35&deg;C</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="MicroCat_port_a" SIZE=15 
	value="<?=$objResult["MicroCat_port_a"];?>" ></TD></tr>
    
<tr BGCOLOR="#FFFFCC"><td align="right">Salinity Sensor: </td>
</td><td align="center">MicroCat</td><td align="center">SBE-37SI</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="MicroCat_SN_b" SIZE=15 value="<?=$objResult["MicroCat_SN_b"];?>" ></TD>
<td align="center">0 - 70 mS/cm</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="MicroCat_port_b" SIZE=15 
	value="<?=$objResult["MicroCat_port_b"];?>" ></TD></tr>
    
<tr BGCOLOR="#FFFFCC"><td align="right">Anemometer 1: </td>
</td><td align="center">Gill</td><td align="center">Windsonic</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Gill_SN" SIZE=15 value="<?=$objResult["Gill_SN"];?>" ></TD>
<td align="center">0 - 60 m/s</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Gill_port" SIZE=15 
	value="<?=$objResult["Gill_port"];?>" ></TD></tr>
    
<tr BGCOLOR="#FFFFCC"><td align="right">Anemometer 2: </td>
</td><td align="center">Airmar</td><td align="center">PB200</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="Airmar_SN_a" SIZE=15 value="<?=$objResult["Airmar_SN_a"];?>" ></TD>
<td align="center">0 - 40 m/s</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Airmar_port_a" SIZE=15 
	value="<?=$objResult["Airmar_port_a"];?>" ></TD></tr>
    
    
<tr BGCOLOR="#FFFFCC"><td align="right">Barometer: </td>
</td><td align="center">Airmar</td><td align="center">PB200</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="Airmar_SN_b" SIZE=15 value="<?=$objResult["Airmar_SN_b"];?>" ></TD>
<td align="center">850 - 1150 hPa</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Airmar_port_b" SIZE=15 
	value="<?=$objResult["Airmar_port_b"];?>" ></TD></tr>    

<tr BGCOLOR="#FFFFCC"><td align="right">Air Temperature: </td>
</td><td align="center">Airmar</td><td align="center">PB200</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="Airmar_SN_c" SIZE=15 value="<?=$objResult["Airmar_SN_c"];?>" ></TD>
<td align="center">-25 to +55&deg;C</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Airmar_port_c" SIZE=15 
	value="<?=$objResult["Airmar_port_c"];?>" ></TD></tr>   
    
<tr BGCOLOR="#FFFFCC"><td align="right">GPS: </td>
</td><td align="center">Airmar</td><td align="center">PB200</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="Airmar_SN_d" SIZE=15 value="<?=$objResult["Airmar_SN_d"];?>" ></TD>
<td align="center">N/A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Airmar_port_d" SIZE=15 
	value="<?=$objResult["Airmar_port_d"];?>" ></TD></tr>       
  
<tr BGCOLOR="#FFFFCC"><td align="right">GPS: </td>
</td><td align="center">TransSystem</td><td align="center">EB505</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="TransSystem_SN" SIZE=15 value="<?=$objResult["TransSystem_SN"];?>" ></TD>
<td align="center">N/A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="TransSystem_port" SIZE=15 
	value="<?=$objResult["TransSystem_port"];?>" ></TD></tr> 
  
<tr BGCOLOR="#FFFFCC"><td align="right">Compass: </td>
</td><td align="center">Honeywell</td><td align="center">HMR3300</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="Honeywell_SN" SIZE=15 value="<?=$objResult["Honeywell_SN"];?>" ></TD>
<td align="center">0 - 360&deg;</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Honeywell_port" SIZE=15 
	value="<?=$objResult["Honeywell_port"];?>" ></TD></tr>    
    
<tr BGCOLOR="#FFFFCC"><td align="right" rowspan="3">Inertial Motion: </td>
</td><td align="center">MicroStrain</td><td align="center">3DM-GX1</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="MicroStrain_SN_a" SIZE=15 value="<?=$objResult["MicroStrain_SN_a"];?>" ></TD>
<td align="center">N/A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="MicroStrain_port_a" SIZE=15 
	value="<?=$objResult["MicroStrain_port_a"];?>" ></TD></tr>  

<tr BGCOLOR="#FFFFCC">
</td><td align="center">MicroStrain</td><td align="center">3DM-GX3-25</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="MicroStrain_SN_b" SIZE=15 value="<?=$objResult["MicroStrain_SN_b"];?>" ></TD>
<td align="center">N/A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="MicroStrain_port_b" SIZE=15 
	value="<?=$objResult["MicroStrain_port_b"];?>" ></TD></tr>  
    
<tr BGCOLOR="#FFFFCC">
</td><td align="center">MicroStrain</td><td align="center">3DM-GX4-25</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="MicroStrain_SN_c" SIZE=15 value="<?=$objResult["MicroStrain_SN_c"];?>" ></TD>
<td align="center">N/A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="MicroStrain_port_c" SIZE=15 
	value="<?=$objResult["MicroStrain_port_c"];?>" ></TD></tr>  
        
<tr BGCOLOR="#FFFFCC"><td align="right">SBD Transmitter IMEI: </td>
</td><td align="center">Iridium</td><td align="center">9603</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="Iridium_SN" SIZE=15 value="<?=$objResult["Iridium_SN"];?>" ></TD>
<td align="center">N/A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Iridium_port" SIZE=15 
	value="<?=$objResult["Iridium_port"];?>" ></TD></tr> 
    
<tr BGCOLOR="#FFFFCC"><td align="right">Freewave Technologies: </td>
</td><td align="center">Freewave</td><td align="center">GXM-MR-R</td>
<TD align="center">
<INPUT align="center" TYPE=TEXT NAME="Freewave_SN" SIZE=15 value="<?=$objResult["Freewave_SN"];?>" ></TD>
<td align="center">N/A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="Freewave_port" SIZE=15 
	value="<?=$objResult["Freewave_port"];?>" ></TD></tr> 
    
    
    
    
    
</table>



<br>
<b>Instrument/Sensor Comments:</b>
<br>
<textarea name="Sensor_Notes" rows="3" cols="97"><?php echo $objResult["Sensor_Notes"];?></textarea><br>


<br>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Submit & Back"><br>





<table border="1">

<tr BGCOLOR="#99CCFF">
<th align="center" colspan="9" ><b>Power System</b></th></tr>



<tr BGCOLOR="#99CCFF">
<th>&nbsp;</th><th>Battery #</th><th>Voltage</th><th>Check<br>Fuse</th><th>Installation Date</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="center" rowspan="2">Battery Bank 1</td><td align="center">1</td>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_1a" SIZE=15 value="<?=$objResult["Battery_1a"];?>"></TD>

<td align="center"><input type="checkbox" name="Battery_1b" value="checked" <? echo $objResult["Battery_1b"];?>></TD>

<td align="center"><INPUT TYPE=TEXT NAME="Battery_1c" SIZE=15 value="<?=$objResult["Battery_1c"];?>" ></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="center">2</td>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_1d" SIZE=15 value="<?=$objResult["Battery_1d"];?>"></TD>

<td align="center"><input type="checkbox" name="Battery_1e" value="checked" <? echo $objResult["Battery_1e"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_1f" SIZE=15 value="<?=$objResult["Battery_1f"];?>" ></TD>
</tr>


<tr BGCOLOR="#FFFFCC"><td align="center" rowspan="2">Battery Bank 2</td><td align="center">1</td>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_2a" SIZE=15 value="<?=$objResult["Battery_2a"];?>"></TD>

<td align="center"><input type="checkbox" name="Battery_2b" value="checked" <? echo $objResult["Battery_2b"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_2c" SIZE=15 value="<?=$objResult["Battery_2c"];?>" ></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="center">2</td>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_2d" SIZE=15 value="<?=$objResult["Battery_2d"];?>"></TD>

<td align="center"><input type="checkbox" name="Battery_2e" value="checked" <? echo $objResult["Battery_2e"];?>></TD>
                  <input type="checkbox" name="Allignment_2" value="checked" <? echo $objResult["Allignment_2"];?>></TD>





<td align="center"><INPUT TYPE=TEXT NAME="Battery_2f" SIZE=15 value="<?=$objResult["Battery_2f"];?>" ></TD>
</tr>



<tr BGCOLOR="#FFFFCC"><td align="center" rowspan="2">Battery Bank 3</td><td align="center">1</td>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_3a" SIZE=15 value="<?=$objResult["Battery_3a"];?>"></TD>

<td align="center"><input type="checkbox" name="Battery_3b" value="checked" <? echo $objResult["Battery_3b"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_3c" SIZE=15 value="<?=$objResult["Battery_3c"];?>" ></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="center">2</td>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_3d" SIZE=15 value="<?=$objResult["Battery_3d"];?>"></TD>

<td align="center"><input type="checkbox" name="Battery_3e" value="checked" <? echo $objResult["Battery_3e"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Battery_3f" SIZE=15 value="<?=$objResult["Battery_3f"];?>" ></TD>
</tr>
</table>



<br>

<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Measured (V)</b></th>
</tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery Bank 1</td><td align="center">12 - 13.5 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_1" SIZE=15 value="<?=$objResult["Measurements_1"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery Bank 2</td><td align="center">12 - 13.5 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_2" SIZE=15 value="<?=$objResult["Measurements_2"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery Bank 3</td><td align="center">12 - 13.5 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_3" SIZE=15 value="<?=$objResult["Measurements_3"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">System Voltage</td><td align="center">12 - 13.5 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_4" SIZE=15 value="<?=$objResult["Measurements_4"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">ADCP Voltage Supply</td><td align="center">54 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_5" SIZE=15 value="<?=$objResult["Measurements_5"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Solar Panel 1 Output (full sun)</td><td align="center">18 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_6" SIZE=15 value="<?=$objResult["Measurements_6"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Solar Panel 2 Output (full sun)</td><td align="center">18 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_7" SIZE=15 value="<?=$objResult["Measurements_7"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Solar Panel 3 Output (full sun)</td><td align="center">18 V</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_8" SIZE=15 value="<?=$objResult["Measurements_8"];?>"></TD>
</tr>
</table><br>

<table border="1">
<tr BGCOLOR="#FFFFCC"><td align="right">Confirm Batteries are Charging</td>
<td align="center">
<input type="checkbox" name="Measurements_9" value="checked" <? echo $objResult["Measurements_9"];?>></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery Charging Monitored for (days)</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_10" SIZE=15 value="<?=$objResult["Measurements_10"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Max System Voltage (daytime)</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_11" SIZE=15 value="<?=$objResult["Measurements_11"];?>"></TD>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Min. System Voltage (nighttime)</td>
<td align="center"><INPUT TYPE=TEXT NAME="Measurements_12" SIZE=15 value="<?=$objResult["Measurements_12"];?>"></TD>
</tr>
</table>

<br>
<b>Power System Comments:</b>
<br>
<textarea name="Measure_Notes" rows="3" cols="97"><?php echo $objResult["Measure_Notes"];?></textarea><br>

<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Submit & Back"><br>


<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Analog Ports</b></th><th><b>Reported (V)</b></th></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery 1 Output</td>
<td align="center"><INPUT TYPE=TEXT NAME="Analog_1" SIZE=15 value="<?=$objResult["Analog_1"];?>"></TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery 2 Output</td>
<td align="center"><INPUT TYPE=TEXT NAME="Analog_2" SIZE=15 value="<?=$objResult["Analog_2"];?>"></TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery 3 Output</td>
<td align="center"><INPUT TYPE=TEXT NAME="Analog_3" SIZE=15 value="<?=$objResult["Analog_3"];?>"></TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">System Voltage</td>
<td align="center"><INPUT TYPE=TEXT NAME="Analog_4" SIZE=15 value="<?=$objResult["Analog_4"];?>"></TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">ADCP Voltage Supply</td>
<td align="center"><INPUT TYPE=TEXT NAME="Analog_5" SIZE=15 value="<?=$objResult["Analog_5"];?>"></TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">System Current (Amps)</td>
<td align="center"><INPUT TYPE=TEXT NAME="Analog_6" SIZE=15 value="<?=$objResult["Analog_6"];?>"></TD></tr>
</table>
<br>
<b>Analog Port Comments:</b>
<br>
<textarea name="Analog_Notes" rows="2" cols="87"><?php echo $objResult["Analog_Notes"];?></textarea><br>
<br>


<table border="1">

<tr BGCOLOR="#99CCFF">
<th align="center" colspan="9" ><b>Allignments</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>&nbsp;</th><th>Direction</th><th>Calibrated</th>
<td BGCOLOR="#0000c6"></td><th>&nbsp;</th><th>Direction</th><th>Locked in Place</th><th>Masts Marked</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Compass HMR-3300</td>
<td align="center"><INPUT TYPE=TEXT NAME="Allignment_1" SIZE=15 value="<?=$objResult["Allignment_1"];?>" ></TD>

<td align="center">
<input type="checkbox" name="Allignment_2" value="checked" <? echo $objResult["Allignment_2"];?>></TD>

<td BGCOLOR="#0000c6"></td>

<td align="center">Windsonic Anemometer</TD>

<td align="center"><INPUT TYPE=TEXT NAME="Allignment_3" SIZE=15 value="<?=$objResult["Allignment_3"];?>" ></TD>

<td align="center">
<input type="checkbox" name="Allignment_4" value="checked" <? echo $objResult["Allignment_4"];?>></TD>

<td align="center">
<input type="checkbox" name="Allignment_5" value="checked" <? echo $objResult["Allignment_5"];?>></TD>
</table>

<br>



<table border="1">
<tr BGCOLOR="#99CCFF">
<th align="center" colspan="3" ><b>Telemetry</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>&nbsp;</th><th>Tested</th><td align="center">Tech/Date</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">FreeWave</td>
<td align="center">
<input type="checkbox" name="Telemetry_1" value="checked" <? echo $objResult["Telemetry_1"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Telemetry_1_date" SIZE=25 value="<?=$objResult["Telemetry_1_date"];?>" >
</TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Globalstar</td>
<td align="center">
<input type="checkbox" name="Telemetry_2" value="checked" <? echo $objResult["Telemetry_2"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Telemetry_2_date" SIZE=25 value="<?=$objResult["Telemetry_2_date"];?>" >
</TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Iridium</td>
<td align="center">
<input type="checkbox" name="Telemetry_3" value="checked" <? echo $objResult["Telemetry_3"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Telemetry_3_date" SIZE=25 value="<?=$objResult["Telemetry_3_date"];?>" >
</TD></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Others</td>
<td align="center">
<input type="checkbox" name="Telemetry_4" value="checked" <? echo $objResult["Telemetry_4"];?>></TD>
<td align="center"><INPUT TYPE=TEXT NAME="Telemetry_4_date" SIZE=25 value="<?=$objResult["Telemetry_4_date"];?>" >
</TD></tr>

</table>
<br>
















<table border="1">

<tr BGCOLOR="#99CCFF"><th><b>Mechnical</b></td><th><b>Tested</b></td>
<td BGCOLOR="#0000c6"></td><th><b>Mechnical</b></td><th><b>Tested</b></td>
</tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">DELRIN Isolators in Place</td>
<td align="center"><input type="checkbox" name="Mechanical_1" value="checked" <? echo $objResult["Mechanical_1"];?>>
</TD>

<td BGCOLOR="#0000c6"></td>

<td align="right">Dummy Plugs in Place</td>
<td align="center">
<input type="checkbox" name="Mechanical_7" value="checked" <? echo $objResult["Mechanical_7"];?>></TD></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Zincs in Place</td>
<td align="center">
<input type="checkbox" name="Mechanical_2" value="checked" <? echo $objResult["Mechanical_2"];?>></TD>

<td BGCOLOR="#0000c6"></td>
<td align="right">Fresh Dessicant Installed</td>
<td align="center">
<input type="checkbox" name="Mechanical_8" value="checked" <? echo $objResult["Mechanical_8"];?>></TD></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Check All NUTS and Bolts</td>
<td align="center">
<input type="checkbox" name="Mechanical_3" value="checked" <? echo $objResult["Mechanical_3"];?>></TD>

<td BGCOLOR="#0000c6"></td>
<td align="right">Vent Valves Checked</td>
<td align="center">
<input type="checkbox" name="Mechanical_9" value="checked" <? echo $objResult["Mechanical_9"];?>></TD></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Loose Cables secured</td>
<td align="center">
<input type="checkbox" name="Mechanical_4" value="checked" <? echo $objResult["Mechanical_4"];?>></TD>

<td BGCOLOR="#0000c6"></td>
<td align="right">Flashing Light Tested</td>
<td align="center">
<input type="checkbox" name="Mechanical_10" value="checked" <? echo $objResult["Mechanical_10"];?>></TD></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Wrap Exposed Cables</td>
<td align="center">
<input type="checkbox" name="Mechanical_5" value="checked" <? echo $objResult["Mechanical_5"];?>></TD>

<td BGCOLOR="#0000c6"></td>
<td align="right">Radar Reflector Installed</td>
<td align="center">
<input type="checkbox" name="Mechanical_11" value="checked" <? echo $objResult["Mechanical_11"];?>></TD></tr>



<tr BGCOLOR="#FFFFCC"><td align="right">Locking Sleeves Tight</td>
<td align="center">
<input type="checkbox" name="Mechanical_5" value="checked" <? echo $objResult["Mechanical_5"];?>></TD>

<td BGCOLOR="#0000c6"></td>
<td align="right">&nbsp;</td><td align="center">&nbsp;</TD></tr>

</table>

<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Submit & Back">



<br>
<b>Comments/Notes:</b>
<br>
<textarea name="Mechanical_Notes" rows="3" cols="97"><?php echo $objResult["Mechanical_Notes"];?></textarea><br>

<br><br>
<input type="submit" name="submit" value="Submit & Back">















<?php
}
mysql_close($objConnect);
?>





<?php 

?>


</form>







</html>
<!--- This file download from www.shotdev.com -->
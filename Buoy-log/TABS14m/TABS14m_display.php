<?php
include ("../Deployment/authorization.php");
?>


<html>
<head>
<title>TABS 1.4 m Buoy Setup and Testing</title>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />
<style type="text/css">
<!-- -->
table.table_style
{
border-width: 1 3 5px 1px;
border-spacing: 0;
border-collapse: collapse;
border-color:#000;
border-style: solid;
font-size:12px;
}

.table_style td, .table_style th
{
margin: 0;
padding: 3px;
border-width: 1px 1px 0 0;
border-style: solid;
}
</style>

</head>
<body bgcolor="c0c8d6">
<center><h4 class="Sub_TITLE-STYLE">TABS 1.4 m Buoy Setup and Test Report</h4>

<div id = "tool-bar"> 
 <a href="./TABS225m.php">Back to List</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="../Deployment/CAS-logout">NetID Logout</a>
</div>

<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM TABS1,4m WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found checkout=".$_GET["checkout"];
	}
	else
	{
	?>

<div style="position: ralative;
            text-align:justify;
            left: 10%; right: 10%;
            width:80%;" 
class="Heading-STYLE">



<form action="./TABS14m.php" name="frmEdit" method="post">
<center>

<table class="table_style">
<tr>
<td BGCOLOR="#99CCFF" align="right"><b>Assembly Number: </td>
<td BGCOLOR="#FFFFCC"><?php echo $objResult["checkout"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>old_checkout: </td>
<td BGCOLOR="#FFFFCC"><?=$objResult["old_checkout"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>Planned Deployment Site: </td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["Site"];?>&nbsp;</td> 
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>Start Date: </td>
<td BGCOLOR="#FFFFCC"><?=$objResult["start_date"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>Hull S/N:</td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["Hull_SN"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>Globalstar HEX ESN:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["HEX_ESN"];?></td>
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>System S/N:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["system_SN"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>PTT SN:</td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["PTT_SN"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>Inventory Number:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["Inventory_N"];?>&nbsp;</td>
</tr>

<tr><td BGCOLOR="#99CCFF" align="right"><b>Phone Number:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["Phone"];?></br></td>

<td BGCOLOR="#99CCFF" align="right"><b>ARGOS ID: </td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["ARGOS"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>Lead Technician: </td><td BGCOLOR="#FFFFCC"><?=$objResult["Technicians"];?> </td>
</table>
</center><center>


<br>
<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH>Sensor Type</td><TH>Manufacture</td><TH><b>Model</b></td><TH>Serial Number</b></td>
<TH><b>Range</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td align="right">Anemometer 1: </td><td align="center">Gill</td><td align="center">Windsonic</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field12a"];?></TD>
<td align="center">0 - 60 m/s</td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Anemometer 2: </td><TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field11a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field11b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field11c"];?></TD><td align="center">0 - 60 m/s</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Compass 1: </td><td align="center">Honeywell</td><td align="center">HMR3300 </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field14a"];?></TD>
<td align="center">0 - 360 d Mag.</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Compass 2: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field13a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field13b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field13c"];?></TD><td align="center">0 - 360 d Mag.</td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Pitch/Roll: </td><td align="center">Honeywell</td><td align="center">HMR3300</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field15a"];?></TD>
<td align="center">+/- 60 degrees</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Barometer: </td><td align="center">Vaisala</td><td align="center">PTB210</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field16a"];?></TD>
<td align="center">500 - 1100 hPa</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Air Temperature: </td><td align="center">Rotronics</td><td align="center">MP101A</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field17a"];?></TD><td align="center">-30&deg;C to +70&deg;C</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Humidity: </td><td align="center">Rotronics</td><td align="center">MP101A</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field18a"];?></TD><td align="center">0 - 100%</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">PAR: </td><td align="center">Biospherical</td><td align="center">QSR-2150</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field19a"];?></TD><td align="center">&nbsp; </td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Current Sensor 1: </td><td align="center">Aanderea</td><td align="center">DCS4100R</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field20a"];?></TD><td align="center">0 - 300 cm/s</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Current Sensor 2: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field21a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field21b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field21c"];?></TD><td align="center">0 - 350 cm/s</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Water Temperature: </td><td align="center">MicroCat</td><td align="center">SBE-37SI</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field22a"];?></TD><td align="center">-5&deg;C to +35&deg;C</td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Salinity Sensor: </td><td align="center">MicroCat</td><td align="center">SBE-37SI</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field23a"];?></TD><td align="center">0 - 70 mS/cm</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Fluorometer: </td><td align="center">Web Labs</td><td align="center">FLNTUS</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field24a"];?></TD><td align="center">0.02-60 ug/l <br>0-25 NTU</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Nutrients: </td><TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field25a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field25b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field25c"];?></TD><td align="center">&nbsp; </td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Inertial Motion: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field26a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field26b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field26c"];?></TD><td align="center">NA</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">GPS: </td><td align="center">Garmin</td><td align="center">16</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field27a"];?></TD>
<td align="center">NA</td></tr>
</table>




<br>
<b>Instrument/Sensor Comments:</b>
<br>

<textarea name="Notes" rows="5" cols="72"><?php echo $objResult["Notes"];?></textarea><br>

<br>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Back to List"><br>




<table class="table_style">

<tr BGCOLOR="#99CCFF">
<th align="center" colspan="9" ><b>Power System</b></th></tr>

<tr BGCOLOR="#99CCFF"><th colspan="2" align="right">Lead Acid Battery Manufacturer:</th>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field93a"];?></td><th align="right">Type:</th>
<td align="left" colspan="2" BGCOLOR="#FFFFCC" ><?=$objResult["field93b"];?></td></tr>


<tr BGCOLOR="#99CCFF">
<th>&nbsp;</th><th>Battery #</th><th>Voltage</th><th>Check<br>Fuse</th><th>Installation Date</th><th>NetID</th></tr>

<tr BGCOLOR="#c0C8d6"><td align="center" rowspan="3">Battery Bank 1</td><td align="center">1</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field94a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field94b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field94c"];?></TD>
<TD><?=$objResult["field94_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">2</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field95a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field95b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field95c"];?></TD>
<TD><?=$objResult["field95_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">3</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field96a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field96b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field96c"];?></TD>
<TD><?=$objResult["field96_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="center" rowspan="3">Battery Bank 2</td><td align="center">1</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field97a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field97b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field97c"];?></TD>
<TD><?=$objResult["field97_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">2</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field98a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field98b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field98c"];?></TD>
<TD><?=$objResult["field98_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">3</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field99a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field99b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field99c"];?></TD>
<TD><?=$objResult["field99_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="center" rowspan="2">Battery Bank 3</td><td align="center">1</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field100a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field100b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field100c"];?></TD>
<TD><?=$objResult["field100_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">2</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field101a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field101b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field101c"];?></TD>
<TD><?=$objResult["field101_sig"];?></td></tr>



<tr BGCOLOR="#99CCFF"><td align="center" colspan="9" BGCOLOR="#0000c6" height="4"></td></tr>
<tr BGCOLOR="#99CCFF"><th colspan="2" align="right">Gell Cell Battery Manufacturer:</th>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field102a"];?></td>
<th align="right">Model:</th><td align="left" colspan="2" BGCOLOR="#FFFFCC"><?=$objResult["field102b"];?></td></tr>

<tr BGCOLOR="#99CCFF">
<th>&nbsp;</th><th>Battery #</th><th>Voltage</th><th>Check<br>Fuse</th><th>Installation Date</th><th>NetID</th></tr>

<tr BGCOLOR="#c0C8d6"><td align="center" rowspan="2">Argos Battery</td><td align="center">1</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field103a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field103b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field103c"];?></TD>
<TD><?=$objResult["field103_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">2</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field104a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field104b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field104c"];?></TD>
<TD><?=$objResult["field104_sig"];?></td></tr>

</table>
<br>

<br>


<table class="table_style">
<tr BGCOLOR="#99CCFF"><th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td><td BGCOLOR="#0000c6"></td>
<th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td align="right">Solar Panel Voltage 1 (full sunlight)</td><td align="center">18 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field34a"];?></TD><TD><?=$objResult["field34_sig"];?></td>
<td BGCOLOR="#0000c6"></td>

<td align="right">System Voltage</td><td align="center">13.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field40"];?></TD><TD><?=$objResult["field40_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Solar Panel Voltage 2 (full sunlight)</td><td align="center">18 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field35a"];?></TD><TD><?=$objResult["field35_sig"];?></td>
<td BGCOLOR="#0000c6"></td>

<td align="right">ADCP Voltage Supply</td><td align="center">54 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field41"];?></TD><TD><?=$objResult["field41_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Solar Panel Voltage 3 (full sunlight)</td><td align="center">18 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field36a"];?></TD><TD><?=$objResult["field36_sig"];?></td>
<td BGCOLOR="#0000c6"></td>

<td align="right">ARGOS Batteries</td><td align="center">13.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field42"];?></TD><TD><?=$objResult["field42_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Regulator 1 Output</td><td align="center">13.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field37"];?></TD>
<TD><?=$objResult["field37_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">Voltage across PC104 switch</td><td align="center">13.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field43"];?></TD>
<TD><?=$objResult["field43_sig"];?></td>

<tr BGCOLOR="#c0C8d6">
<td align="right">Regulator 2 Output</td><td align="center">13.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field38"];?></TD>
<TD><?=$objResult["field38_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">3 V supply</td><td align="center">3 V</td><TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field44"];?></TD>
<TD><?=$objResult["field44_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Regulator 3 Output</td><td align="center">13.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field39"];?></TD><TD><?=$objResult["field39_sig"];?></td>
<td BGCOLOR="#0000c6"></td><td></td><td></td><td></td><td></td></tr>

</table>


<table class="table_style">
<tr BGCOLOR="#99CCFF"><th colspan="10"><b>Switched Power Ports</b></td></tr></b>
<tr BGCOLOR="#99CCFF"><th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td><td BGCOLOR="#0000c6"></td>
<th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td>
</tr></b>
<tr BGCOLOR="#c0C8d6"><td align="right">P1</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field45"];?></TD>
<TD><?=$objResult["field45_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">P7</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field46"];?></TD>
<TD><?=$objResult["field46_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">P2</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field47"];?></TD>
<TD><?=$objResult["field47_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">P8</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field48"];?></TD>
<TD><?=$objResult["field48_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">P3</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field49"];?></TD>
<TD><?=$objResult["field49_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">P9</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field50"];?></TD>
<TD><?=$objResult["field50_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">P4</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field51"];?></TD>
<TD><?=$objResult["field51_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">P10</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field52"];?></TD>
<TD><?=$objResult["field52_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">P5</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field53"];?></TD>
<TD><?=$objResult["field53_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">P11</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field54"];?></TD>
<TD><?=$objResult["field54_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">P6</td><td align="center">12.5 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field55"];?></TD>
<TD><?=$objResult["field55_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">P12</td><td align="center">54 V</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field56"];?></TD>
<TD><?=$objResult["field56_sig"];?></td></tr>

</table>

<br>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Back to List">



<table class="table_style">

<tr BGCOLOR="#99CCFF">
<th align="center" colspan="9" ><b>Compass Allignment and Calibrations</b></th></tr>

<tr BGCOLOR="#99CCFF"><th></th><th>Direction</th><th>Calibrated</th><th>NetID</th>
<td BGCOLOR="#0000c6"></td><th>&nbsp;</th><th>Direction</th><th>Calibrated</th><th>NetID</th></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">HMR-3300</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field29a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field29b"];?></TD>
<TD><?=$objResult["field29_sig"];?></td>

<td BGCOLOR="#0000c6"></td>

<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field30c"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field30a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field30b"];?></TD>
<TD><?=$objResult["field30_sig"];?></td>

<tr BGCOLOR="#c0C8d6"><td align="right">IMU</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field31a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field31b"];?></TD>
<TD><?=$objResult["field31_sig"];?></td><td BGCOLOR="#0000c6"></td>
<th align="left" colspan="4" >
</table>

&nbsp;



<br>

<table class="table_style">
<tr BGCOLOR="#99CCFF">
<th align="center" colspan="5" ><b>Wind Sensor Allignment</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>&nbsp;</th><th>Direction</th><td align="center">Locked<br>in place</td>
<td align="center">Masts<br>Marked</td><th>NetID</th></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Windsonic</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field32a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field32b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field32c"];?></TD>
<TD><?=$objResult["field32_sig"];?></td></tr>

<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field33d"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field33a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field33b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field33c"];?></TD>
<TD><?=$objResult["field33_sig"];?></td></tr>

</table><br>


<table class="table_style">
<tr BGCOLOR="#99CCFF"><th><b>Port Timing<br>/Operation</b></td><th><b>Sensor</b></td><th><b>Tested</b></td><th><b>NetID</b></td>
<td BGCOLOR="#0000c6"></td>
<th><b>Port Timing<br>/Operation</b></td><th><b>Sensor</b></td><th><b>Tested</b></td><th><b>NetID</b></td>
</tr></b>
<tr BGCOLOR="#c0C8d6"><td align="right">EMM1</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field57a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field57b"];?></TD>
<TD><?=$objResult["field57_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">EMM7</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field63a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field63b"];?></TD>
<TD><?=$objResult["field63_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">EMM2</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field58a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field58b"];?></TD>
<TD><?=$objResult["field58_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">EMM8</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field64a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field64b"];?></TD>
<TD><?=$objResult["field64_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">EMM3</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field59a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field59b"];?></TD>
<TD><?=$objResult["field59_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM1</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field65a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field65b"];?></TD>
<TD><?=$objResult["field65_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">EMM4</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field60a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field60b"];?></TD>
<TD><?=$objResult["field60_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM2</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field66a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field66b"];?></TD>
<TD><?=$objResult["field66_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">EMM5</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field61a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field61b"];?></TD>
<TD><?=$objResult["field61_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM3</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field67a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field67b"];?></TD>
<TD><?=$objResult["field67_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">EMM6</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field62a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field62b"];?></TD>
<TD><?=$objResult["field62_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM4</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field68a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field68b"];?></TD>
<TD><?=$objResult["field68_sig"];?></td></tr>

</table>

<br>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Back to List">


<table class="table_style">
<tr BGCOLOR="#99CCFF"><th><b>Analog Ports</b></td><th><b>Data</b></td><th><b>Notes</b></td><th><b>NetID</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td align="right">External Temp/Humidity</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field69a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field69b"];?></TD>
<TD><?=$objResult["field69_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Internal Temp/Humidity</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field70a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field70b"];?></TD>
<TD><?=$objResult["field70_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Battery Voltages</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field71a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field71b"];?></TD>
<TD><?=$objResult["field71_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Charge Currents</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field72a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field72b"];?></TD>
<TD><?=$objResult["field72_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">ADCP Voltage</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field73a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field73b"];?></TD>
<TD><?=$objResult["field73_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Others</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field74a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field74b"];?></TD>
<TD><?=$objResult["field74_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right"></td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field75a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field75b"];?></TD>
<TD><?=$objResult["field75_sig"];?></td></tr>

</table>
<br>


<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;&nbsp; </b>
<input type="submit" name="submit" value="Back to List">



<table class="table_style">
<tr BGCOLOR="#99CCFF"><th><b>Telemetry</b></td><th><b>Tested</b></td><th><b>Date</b></td><th><b>NetID</b></td>
<td BGCOLOR="#0000c6"></td>
<th><b>Telemetry</b></td><th><b>Tested</b></td><th><b>Date</b></td><th><b>NetID</b></td>
</tr></b>

<tr BGCOLOR="#c0C8d6"><td align="right">ARGOS</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field76a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field76b"];?></TD>
<TD><?=$objResult["field76_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td align="right">WIFI</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field77a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field77b"];?></TD>
<TD><?=$objResult["field77_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Globalstar</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field78a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field78b"];?></TD>
<TD><?=$objResult["field78_sig"];?></td><td BGCOLOR="#0000c6"></td>

<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field79c"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field79a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field79b"];?></TD>
<TD><?=$objResult["field79_sig"];?></td></tr>

</table>

<br>

<table class="table_style">
<tr BGCOLOR="#99CCFF"><th><b>Mechanical</b></td><th><b>Tested</b></td><th><b>Notes</b></td><th><b>NetID</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td align="right">Isolators on through rods</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field105a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field105b"];?></TD>
<TD><?=$objResult["field105_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Isolators on substructure</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field106a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field106b"];?></TD>
<TD><?=$objResult["field106_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Isolators on pad eye</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field107a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field107b"];?></TD>
<TD><?=$objResult["field107_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">DELRIN Isolators in Place</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field80a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field80b"];?></TD>
<TD><?=$objResult["field80_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Zincs in Place</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field81a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field81b"];?></TD>
<TD><?=$objResult["field81_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Through rods tight</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field108a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field108b"];?></TD>
<TD><?=$objResult["field108_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Check All NUTS and Bolts</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field82a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field82b"];?></TD>
<TD><?=$objResult["field82_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Loose Cables secured</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field83a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field83b"];?></TD>
<TD><?=$objResult["field83_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Wrap Exposed Cables</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field84a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field84b"];?></TD>
<TD><?=$objResult["field84_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Locking Sleeves in Place</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field85a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field85b"];?></TD>
<TD><?=$objResult["field85_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td align="right">Dummy Plugs in Place</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field86a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field86b"];?></TD>
<TD><?=$objResult["field86_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Fresh Dessicant Installed</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field87a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field87b"];?></TD>
<TD><?=$objResult["field87_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Hatch Secured</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field88a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field88b"];?></TD>
<TD><?=$objResult["field88_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Vent Valves Checked</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field89a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field89b"];?></TD>
<TD><?=$objResult["field89_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Flashing Light Tested</td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field90a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field90b"];?></TD>
<TD><?=$objResult["field90_sig"];?></td></tr>

</table>

<br>
<b>Comments/Notes:</b>
<br>
<textarea name="Comments" rows="5" cols="72"><?php echo $objResult["Comments"];?></textarea><br>


<br>
<input type="submit" name="submit" value="Back to List">



<?php
}
mysql_close($objConnect);
?>



</div>
</body>
</html>
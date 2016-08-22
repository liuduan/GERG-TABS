<?php
include ("../Deployment/authorization.php");
?>

<html>
<head>
<title>TABS II Setup and Testing</title>
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
<center><h4 class="Sub_TITLE-STYLE">TABS II Buoy Setup and Test Report</h4>

<div id = "tool-bar"> 
  <a href="./TABSII.php">Back to List</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a>
</div>

<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM TABSII_table WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
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



<form action="./TABSII.php" name="frmEdit" method="post">
<center>

<table class="table_style">
<tr>
<td BGCOLOR="#99CCFF" align="right"><b>File Number: </td>
<td BGCOLOR="#FFFFCC"><?php echo $objResult["checkout"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>old_checkout: </td>
<td BGCOLOR="#FFFFCC"><?=$objResult["old_checkout"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>Planned Deployment Site: </td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["Site"];?>&nbsp;</td> 
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>Start Date: </td>
<td BGCOLOR="#FFFFCC"><?=$objResult["start_date"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>PTT ID:</td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["PTT_ID"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>Current Sensor Model/S/N: </td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["current_sensor"];?>&nbsp;</td>
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>System S/N:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["system_SN"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>PTT SN:</td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["PTT_SN"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>Modem ESN(HEX):</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["Modem_ESN"];?>&nbsp;</td>

</tr>

<tr><td BGCOLOR="#99CCFF" align="right"><b>Phone Number:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["Phone"];?></br></td>

<td BGCOLOR="#99CCFF" align="right"><b>Hull S/N:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["Hull"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>Lead Technician: </td><td BGCOLOR="#FFFFCC"><?=$objResult["Technicians"];?> </td>
</table>
</center><center>


<br>
<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH>Sensor</td><TH>Serial Number</b></td><TH><b>Model</b></td>
<TH><b>Range</b></td><TH><b>Port#</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td align="right">Anemometer: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field11"];?></TD>
<td align="center">Windsonic</td><td align="center">0 - 60 m/s</td><td align="center">EMM 8</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Temperature & Humidity: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field12"];?></TD>
<td align="center">MP101A</td><td align="center">-30/+70 degrees 0, 0 - 100% </td><td align="center">T5-7, T5-9</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Pressure Transmitter: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field13"];?></TD>
<td align="center">PTB210</td><td align="center">500 - 1100 hPa</td><td align="center">EMM 7</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Compass: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field14"];?></TD>
<td align="center">HMR3300</td><td align="center">0 - 360 degree Magnetic</td><td align="center">Com4</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Conductivity: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field15"];?></TD>
<td align="center" BGCOLOR="#FFFFCC"><?=$objResult["field15b"];?></td>
<td align="center">0 - 75 mmho/cm</td><td align="center">EMM 3</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">LSS Sensor: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field16"];?></TD>
<td align="center" BGCOLOR="#FFFFCC"><?=$objResult["field16b"];?></td>
<td align="center">&nbsp;</td><td align="center">&nbsp;</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Current Sensor: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field17"];?></TD>
<td align="center" BGCOLOR="#FFFFCC"><?=$objResult["field17b"];?></td>
<td align="center">0 - 350 cm/sec</td><td align="center">EMM 6</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">ADCP: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field18a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field18b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field18c"];?></TD>
<td align="center">EMM 1</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Modem: </td><TD align="center">See above</TD>
<td align="center"  BGCOLOR="#FFFFCC"><?=$objResult["field18m"];?></td><td align="center">NA</td><td align="center">EMM 5</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Argos: </td><TD align="center">See above</TD>
<td align="center" BGCOLOR="#FFFFCC"><?=$objResult["field18s"];?></td><td align="center">NA</td><td align="center">EMM 2</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">GPS: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field19"];?></TD>
<td align="center" BGCOLOR="#FFFFCC"><?=$objResult["field19b"];?></td><td align="center">NA</td><td align="center">EMM 4</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">LinkQuest Modem: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field20a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field20b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field20c"];?></TD>
<td align="center">EMM 1</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">System Monitor Port: </td><TD align="center">NA</TD>
<td align="center">NA</td><td align="center">&nbsp;</td><td align="center">Com 2</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Spare: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field21a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field21b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field21c"];?></TD>
<td align="center">Com 1</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="right">Spare: </td>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field22a"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field22b"];?></TD>
<TD align="center" BGCOLOR="#FFFFCC"><?=$objResult["field22c"];?></TD>
<td align="center">Com 3</td></tr>

</table>

<br>

<table class="table_style">
<tr BGCOLOR="#99CCFF"><th align="center" colspan ="4"><b>Battery Test</b></td></tr>
<tr><td align="right" BGCOLOR="#c0C8d6">Installation Date</td><TD BGCOLOR="#FFFFCC"><?=$objResult["Battery"];?>&nbsp;</TD>
<td align="right" BGCOLOR="#c0C8d6">Battery Bype</td><TD BGCOLOR="#FFFFCC"><?=$objResult["Battery_type"];?>&nbsp;</TD></tr>

<tr><td align="right" BGCOLOR="#c0C8d6">Battery Manufacture</td><TD BGCOLOR="#FFFFCC"><?=$objResult["Battery_manu"];?>&nbsp;</TD>
<Td align="right" BGCOLOR="#c0C8d6">NetID</td><TD BGCOLOR="#c0C8d6"><?=$objResult["Battery_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#99CCFF">
<th align="left" colspan="4" ><b>Battery voltages after 12 hrs charging and 1 hr rest (fuses removed).</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>&nbsp;</th><th>Open Loop</th><th>100 Ohm</th><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B1-Argos</td>
<td align="center"><?=$objResult["field23a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field23b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field23_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B2-Argos</td>
<td align="center"><?=$objResult["field24a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field24b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field24_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B1-Sys</td>
<td align="center"><?=$objResult["field25a"];?></TD>
<td align="center"><?=$objResult["field25b"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field25_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B2-Sys</td>
<td align="center"><?=$objResult["field26a"];?></TD>
<td align="center"><?=$objResult["field26b"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field26_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B3-Sys</td>
<td align="center"><?=$objResult["field27a"];?></TD>
<td align="center"><?=$objResult["field27b"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field27_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B4-Sys</td>
<td align="center"><?=$objResult["field28a"];?></TD>
<td align="center"><?=$objResult["field28b"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field28_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B5-Sys</td>
<td align="center"><?=$objResult["field29a"];?></TD>
<td align="center"><?=$objResult["field29b"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field29_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B6-Sys</td>
<td align="center"><?=$objResult["field30a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field30b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field30_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B7-Sys</td>
<td align="center"><?=$objResult["field31a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field31b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field31_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B8-Sys</td>
<td align="center"><?=$objResult["field32a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field32b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field32_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B9-Sys</td>
<td align="center"><?=$objResult["field33a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field33b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field33_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B10-Sys</td>
<td align="center"><?=$objResult["field34a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field34b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field34_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B11-Sys</td>
<td align="center"><?=$objResult["field35a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field35b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field35_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B12-Sys</td>
<td align="center"><?=$objResult["field36a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field36b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field36_sig"];?>&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B13-Sys</td>
<td align="center"><?=$objResult["field37a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field37b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field37_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">B14-Sys</td>
<td align="center"><?=$objResult["field38a"];?>&nbsp;</TD>
<td align="center"><?=$objResult["field38b"];?>&nbsp;</TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field38_sig"];?>&nbsp;</td></tr>

</table>

&nbsp;

<table class="table_style">
<tr>
<td>
<div id = "tool-bar"> 
Page 2, <b class="fixed-width">&nbsp; &nbsp; &nbsp; </b>
File Number: <?php echo $objResult["checkout"];?> <b class="fixed-width">&nbsp; &nbsp; &nbsp; </b>
old_checkout: <?=$objResult["old_checkout"];?><b class="fixed-width">
</div>
</td></tr></table>

&nbsp;
<table class="table_style">

<tr BGCOLOR="#99CCFF"><th><b>&nbsp;</b></td><th><b>Nominal<br>Value</b></td><th></br><b>Readout</b></td><th></br><b>NetID</b></td></tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Solar Panel Voltage (in sunlight)</td>               
<td align="center" BGCOLOR="#c0C8d6">18 V</td>
<TD><?=$objResult["field39"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field39_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Regulator Output (to charged batteries)</td>               
<td align="center" BGCOLOR="#c0C8d6">13.5 V</td>
<TD><?=$objResult["field40"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field40_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">System Batteries (average with fuses installed)</td>               <td align="center" BGCOLOR="#c0C8d6">13.5 V</td>
<TD><?=$objResult["field41"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field41_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">ARGOS Batteries (average with fuses installed)</td>               <td align="center" BGCOLOR="#c0C8d6">13.5 V</td>
<TD><?=$objResult["field42"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field42_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Voltage across PC104 main switch</td>               
<td align="center" BGCOLOR="#c0C8d6">13.5 V</td>
<TD><?=$objResult["field43"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field43_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">ADCP Power Supply Voltage</td>               
<td align="center" BGCOLOR="#c0C8d6">54.5 V</td>
<TD><?=$objResult["field44"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field44_sig"];?></td></tr>

</table>


<br>

<table class="table_style">
<tr BGCOLOR="#99CCFF"><th><b>General System Tests</b></td><th><b>Nominal</b></td><th><b>Comments</b></td><th><b>NetID</b></td></tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Operating Current (Sensors Running)</td>               
<td align="center" BGCOLOR="#c0C8d6">~290 mA</td>
<TD><?=$objResult["field46"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field46_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Sleep Current (PC104 in Sleep Mode)</td>               
<td align="center" BGCOLOR="#c0C8d6">~190 mA</td>
<TD><?=$objResult["field47"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field47_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Sensor Fuses checked</td>               
<td align="center" BGCOLOR="#c0C8d6">Y</td>
<TD><?=$objResult["field48"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field48_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">LED Lights come on when sensors power on</td>               
<td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field49"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field49_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Check all connections on Sensor Interface Board</td>               <td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field50"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field50_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Check Ribbon Cable connections</td>               
<td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field51"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field51_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Check sencurity of VESPA computer and wires</td>               
<td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field52"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field52_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Output Voltage to Sensors (Com 1 - Com 12)</td>               
<td align="center" BGCOLOR="#c0C8d6">~12.5 V</td>
<TD><?=$objResult["field53"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field53_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">All sensors plugged in and tightened</td>               
<td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field54"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field54_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Dessicant installed in computer housing</td>               
<td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field55"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field55_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Dessicant installed in battery chamber</td>               
<td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field56"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field56_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Catylators installed in battery chamber</td>               
<td align="center" BGCOLOR="#c0C8d6">&nbsp;</td>
<TD><?=$objResult["field57"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field57_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">MET station installed</td>               
<td align="center" BGCOLOR="#c0C8d6"></td>
<TD><?=$objResult["field58"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field58_sig"];?></td></tr>

</table>

<br>

<table class="table_style">
<tr BGCOLOR="#99CCFF"><th><b>Vacuum Tests</b></td><th><b>Comments</b></td><th><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Make sure inside bulkhead plate is secured in place</td>
<TD><?=$objResult["field59"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field59_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Close chassis & bolt in place making sure O-ring is greased</td>
<TD><?=$objResult["field60"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field60_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Install vacuum gauge on chassis plate</td>
<TD><?=$objResult["field61"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field61_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Draw a 10 in Hg Vacuum and let sit 12 hrs</td>
<TD><?=$objResult["field62"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field62_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Starting Pressure</td>
<TD><?=$objResult["field63"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field63_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Ending Pressure</td>
<TD><?=$objResult["field64"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field64_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">If difference between start & end, pressurize buoy to 5 psi</td>
<TD><?=$objResult["field65"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field65_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Locate and repair leak, repeat tests</td>
<TD><?=$objResult["field66"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field66_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Bolt mast endcap in place making sure O-ring is greased</td>
<TD><?=$objResult["field67"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field67_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Install vacuum gauge on mast endcap plate</td>
<TD><?=$objResult["field68"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field68_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Draw a 10 in Hg Vacuum and let sit 12 hrs</td>
<TD><?=$objResult["field69"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field69_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Starting Pressure</td>
<TD><?=$objResult["field70"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field70_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Ending Pressure</td>
<TD><?=$objResult["field71"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field71_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">If difference between start & end, pressurize buoy to 5 psi</td>
<TD><?=$objResult["field72"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field72_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Locate and repair leak, repeat tests</td>
<TD><?=$objResult["field73"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field73_sig"];?></td></tr>

</table>

<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  </b>
<input type="submit" name="submit" value="Back to List">
<br><br>
<table class="table_style">
<tr>
<td><div id = "tool-bar"> 
Page 3, <b class="fixed-width">&nbsp; &nbsp; &nbsp; </b>
Assembly Number: <?php echo $objResult["checkout"];?> <b class="fixed-width">&nbsp; &nbsp; &nbsp; </b>
old_checkout: <?=$objResult["old_checkout"];?><b class="fixed-width">
</div>
</td></tr></table>

<hr>
System Test and Setup
<hr>



<table class="table_style">
<tr BGCOLOR="#99CCFF"><th align="left" colspan="4" ><b>Computer Port Setup, 9600,n,8,1</b></th></tr>
<tr BGCOLOR="#99CCFF"><th align="left" colspan="4" ><b>Plug into Monitor port and put system in TEST mode</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>Barometric Pressure, Temperature/Humidity</th><th>&nbsp; </th><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Fill dessicant chamber with fresh dessicant.</td>
<TD><?=$objResult["field74"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field74_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Replace PolyOlefin membrane.</td>
<TD><?=$objResult["field75"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field75_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Check all plumbing connections.</td>
<TD><?=$objResult["field76"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field76_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Measure local pressure with Mercury Barometer. Reading 1</td>
<TD><?=$objResult["field77"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field77_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Reading 2</td>
<TD><?=$objResult["field78"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field78_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Measure local pressure with TABS II barometer. Reading 1</td>
<TD><?=$objResult["field79"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field79_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Reading 2</td>
<TD><?=$objResult["field80"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field80_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Difference</td>
<TD><?=$objResult["field81"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field81_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">If difference > 1 mb adjust with Vaisala software (PTB210 Wizard).</td>
<TD><?=$objResult["field82"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field82_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">If adjusted diff > 1 mb check Mercury barometer readings.</td>
<TD><?=$objResult["field83"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field83_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">If still > 1 mb replace barometer.</td>
<TD><?=$objResult["field84"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field84_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Check temperature output against mercury thermometer.</td>
<TD><?=$objResult["field85"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field85_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Check humidity against shop sensor.</td>
<TD><?=$objResult["field86"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field86_sig"];?></td></tr>

</table>

<br>



<table class="table_style">
<tr BGCOLOR="#99CCFF"><th>Wind Test/Alignment</th><th>&nbsp; </th><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Install and level Laser Level on tripod.</td>
<TD><?=$objResult["field87"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field87_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Bolt buoy chassis closed as if in field.</td>
<TD><?=$objResult["field88"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field88_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Align laser with Compass North using 2 pts of ref.</td>
<TD><?=$objResult["field89"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field89_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Align N-S axis of anemometer with laser.</td>
<TD><?=$objResult["field90"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field90_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Secure set screws to lock anemometer position.</td>
<TD><?=$objResult["field91"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field91_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Install Buoy on Rocket Launcher and raise to Vertical.</td>
<TD><?=$objResult["field92"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field92_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Rotate buoy checking compass heading.</td>
<TD><?=$objResult["field93"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field93_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Calibrate compass if necessary.</td>
<TD><?=$objResult["field94"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field94_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Take a minimum of two wind readings in each quadrant.</td>
<TD><?=$objResult["field95"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field95_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Plot results against RM Young anemometer.</td>
<TD><?=$objResult["field96"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field96_sig"];?></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right" BGCOLOR="#c0C8d6">Attach plots.</td>
<TD><?=$objResult["field97"];?></TD>
<TD BGCOLOR="#c0C8d6"><?=$objResult["field97_sig"];?></td></tr>
</table>
<br>
<b>Comments:</b>
<br>
<textarea name="comments" rows="5" cols="70"><?php echo $objResult["comments"];?></textarea><br>

<br>
<input type="submit" name="submit" value="Back to List">



<?php
}
mysql_close($objConnect);
?>



</div>
</body>
</html>
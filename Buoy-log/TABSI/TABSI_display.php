<?php
include ("../Deployment/authorization.php");
?>
<html>
<head>
<title>TABS I Setup and Testing</title>
<link rel="stylesheet" href = "./record_style.css" type="text/css" />
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
<center><h3 class="TITLE-STYLE">TABS I Buoy Setup and Test Report</h3>

<form name="frmSample" action="TABSI_edit1.php" method="post">	


<div id = "tool-bar"> 
 <a href="./TABSI_edit1.php">Back to List</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="../Deployment/CAS-logout">NetID Logout</a>
</div>

<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM TABSI_table1 WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
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




<center>

<table class="table_style">
<tr>
<td BGCOLOR="#99CCFF" align="right"><b>Assembly Number: </td>
<td BGCOLOR="#FFFFCC"><?php echo $objResult["checkout"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>old_checkout: </td>
<td BGCOLOR="#FFFFCC"><?=$objResult["old_checkout"];?></td>


<td BGCOLOR="#99CCFF" align="right"><b>System S/N:</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field3"];?></td>
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>Start Date: </td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field4"];?></td>

<td BGCOLOR="#99CCFF" align="right"><b>
Current Sensor Model S/N: </td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["field5"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>
MicroCat S/N:</td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["field6"];?>&nbsp;</td>
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>
PTT ID# and S/N: </td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["field7"];?>&nbsp;</td> 

<td BGCOLOR="#99CCFF" align="right"><b>
Firmware version:</td>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["field8"];?>&nbsp;</td>

<td BGCOLOR="#99CCFF" align="right"><b>Modem Type:</td><td BGCOLOR="#FFFFCC"><?=$objResult["field9"];?>&nbsp;&nbsp;&nbsp;</td>
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>Sat Link:</td><td BGCOLOR="#FFFFCC"><?=$objResult["field10"];?></br></td>
<td BGCOLOR="#99CCFF" align="right"><b>Hull S/N:</td><td BGCOLOR="#FFFFCC"><?=$objResult["field11"];?>&nbsp;&nbsp;&nbsp;</td>
<td BGCOLOR="#99CCFF" align="right"><b>Phone Number/ESN:</td><td BGCOLOR="#FFFFCC"><?=$objResult["field12"];?></br></td>
</tr>

<tr>
<td BGCOLOR="#99CCFF" align="right"><b>Lead Technician: </td><td BGCOLOR="#FFFFCC"><?=$objResult["technician"];?> </td>
<td BGCOLOR="#99CCFF" align="right" colspan="5" ></td>
</tr>
</table>
</center><center>



<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Here are the parameters when SatLink was NOT connected:
<table class="table_style" align="center">
<tr align="center" BGCOLOR="#99CCFF"><td><br><b><br>RSM/SeaPac Battery Vltages</b></td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td><td BGCOLOR="#0000c6"></td>

<td><br><b><br>RSM/SeaPac Battery Vltages</b></td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td></tr>

<tr align="center"><td>Vin - TP15</td><td>10 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field14"];?>&nbsp;</td>
<td><?=$objResult["field14_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>12Vdc - TP14</td><td>10 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field16"];?>&nbsp;</td>
<td><?=$objResult["field16_sig"];?>&nbsp;</td></tr>

<tr align="center"><td>Vsys - TP13</td><td>10 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field18"];?>&nbsp;</td>
<td><?=$objResult["field18_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>Current Draw across R37</td><td>5-10 mA</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field20"];?>&nbsp;</td>
<td><?=$objResult["field20_sig"];?>&nbsp;</td></tr>

<tr align="center"><td>Vbatt - TP4</td><td>10 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field22"];?></td>
<td><?=$objResult["field22_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td>Vcc - TP5</td><td>5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field24"];?></td>
<td><?=$objResult["field24_sig"];?></td></tr>

<tr align="center"><td>Button Battery uner Daughterboard</td><td>3.0 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field26"];?></td>
<td><?=$objResult["field26_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td>Clock Battery (CPU Board if installed)</td><td>3.6 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field28"];?></td>
<td><?=$objResult["field28_sig"];?></td></tr>


<tr><td colspan="9" BGCOLOR="#99CCFF"><b>Daughterboard Measurements </b></td></tr>
<tr align="center"><td>Vbatt - TP6</td><td>10 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field30"];?></td>
<td><?=$objResult["field30_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td>+12V TP5 - TP4 (jumped)</td><td>10 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field32"];?></td>
<td><?=$objResult["field32_sig"];?></td></tr>

<tr align="center"><td>Vcc - TP3</td><td>5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field34"];?></td>
<td><?=$objResult["field34_sig"];?></td><td BGCOLOR="#0000c6"></td>
<td colspan="9" ></td>
</tr>

</table>




<br>When SatLink WAS connected:
<table class="table_style">

<tr BGCOLOR="#99CCFF" align="center"><td><b>RSM/SeaPac Battery Vltages</b></td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td><td BGCOLOR="#0000c6"></td>

<td><b>RSM/SeaPac Battery Vltages</b></td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td>
</tr></b>




<tr align="center"><td>Vin - TP15</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field36"];?>&nbsp;</td>
<td><?=$objResult["field36_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>12Vdc - TP14</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field38"];?>&nbsp;</td>
<td><?=$objResult["field38_sig"];?>&nbsp;</td></tr>

<tr align="center"><td>Vsys - TP13</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field40"];?>&nbsp;</td>
<td><?=$objResult["field40_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>Current Draw across R37</td><td>10-15 mA</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field42"];?>&nbsp;</td>
<td><?=$objResult["field42_sig"];?>&nbsp;</td></tr>

<tr align="center"><td>Vbatt - TP4</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field44"];?>&nbsp;</td>
<td><?=$objResult["field44_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>Vcc - TP5</td><td>5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field46"];?>&nbsp;</td>
<td><?=$objResult["field46_sig"];?>&nbsp;</td></tr>



<tr><td colspan="9" BGCOLOR="#99CCFF"><b>Daughterboard Measurements </b></td></tr>
<tr align="center"><td>Vbatt - TP6</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field48"];?>&nbsp;</td>
<td><?=$objResult["field48_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>+12V TP5 - TP4 (jumped)</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field50"];?>&nbsp;</td>
<td><?=$objResult["field50_sig"];?>&nbsp;</td></tr>

<tr align="center"><td>Vcc - TP3</td><td>5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field52"];?>&nbsp;</td>
<td><?=$objResult["field52_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td><td colspan="4" ></td></tr>

</table>




</div>


<br><b>
SatLink measurements, when the charger was NOT connected.
<table class="table_style">

<tr align="center" BGCOLOR="#99CCFF"><td><b><br>SatLink Measurements</b></td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td><td BGCOLOR="#0000c6"></td>

<td><b><br>SatLink Measurements</b></td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td></tr></b>

<tr align="center"><td>Battery 1</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field54"];?>&nbsp;</td>
<td><?=$objResult["field54_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>Battery 2</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field56"];?>&nbsp;</td>
<td><?=$objResult["field56_sig"];?>&nbsp;</td></tr>

<tr align="center"><td>Voltage across the fuse to ground</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field58"];?>&nbsp;</td>
<td><?=$objResult["field58_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td>

<td>PTT Voltage</td><td>12.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field60"];?>&nbsp;</td>
<td><?=$objResult["field60_sig"];?>&nbsp;</td></tr>
</table>

<br><b>SatLink measurements, when solar panels was connected through top plate.</b>
<br>With solar panels in sunlight check that the regulator indicates charging.
<table class="table_style">

<tr BGCOLOR="#99CCFF" align="center"><td><b>SatLink Measurement</td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td><td BGCOLOR="#0000c6"></td>
<td><b>SatLink Measurement</td><td><b>Nominal<br>Value</b></td><td></br><b>Setting/Value</b></td><td></br><b>NetID</b></td>

</tr></b>

<tr align="center"><td>Output from solar panels going into regulator: </td><td>18 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field62"];?></td>
<td><?=$objResult["field62_sig"];?></td><td BGCOLOR="#0000c6"></td>

<td>Regulator Output</td><td>13.5 V</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field64"];?></td>
<td><?=$objResult["field64_sig"];?></td></tr>

</table>

<br>

<b>Comments:</b><br>
<textarea name="comments" rows="5" cols="94"><?php echo $objResult["field66"];?></textarea>


<?php
}
mysql_close($objConnect);
?>

</div>


<?php 

# include 2nd part of the page.
include './TABSI2/TABSI2_display.php'; 

# include 3rd part of the page.
include './TABSI3/TABSI3_display.php'; 

?>



</body>
</html>
<!--- This file download from www.shotdev.com -->
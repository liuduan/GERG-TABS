<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>

<html>
<head>
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
<title>Buoy Component</title>
</head>
<body bgcolor="c0c8d6">
<center><h3 class="TITLE-STYLE">Buoy Component</h3></center>

<h4 class="STYLE4">
<center>
<form action="./Components_edit3.php" name="frmEdit" method="post">
<input type="submit" name="submit" value="Submit & Back">

<br><br>

<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("Metadata");
	$strSQL = "SELECT * FROM Components WHERE Component_N = '".$_GET["Component_N"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found Component_N =".$_GET["Component_N"];
	}
	else
	{
	?>
<b>

<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php'> Deployment History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="./Components.php">List of All Components</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>


<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><td align="right"><b>Component Number: </td><td><?php echo $objResult["Component_N"];?>
<input type="hidden" name="Component_N" value="<?=$objResult["Component_N"];?>">
</td>
<td align="right"><b>Component Type:</td>
<td><input type="text" name="Component_type" size="23" value="<?=$objResult["Component_type"];?>"></br></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right"><b>Date Received:</td>
<td><input type="text" name="Date_received" size="20" value="<?=$objResult["Date_received"];?>"></td>


<td align="right"><b>Manufacture:</td>
<td><input type="text" name="Manufacture" size="20" value="<?=$objResult["Manufacture"];?>"></br></td>
</tr>


<tr BGCOLOR="#FFFFCC"><td align="right"><b>


<a href ="../Manuals/Manuals.php?Manufacture=<?=$objResult["Manufacture"];?>&Model=<?=$objResult["Model"];?>" target = _blank>Manual</a>;


Model:</td>


<?php
if ($objResult["Component_type"] == "System"){
	print <<<END
<td> 			
<select name="Model" onChange="signature(this.form)" >
<option value=$objResult[Model]> $objResult[Model]</option>
<option value="TABSI">TABSI</option>
<option value="TABSII">TABSII</option>
<option value="2.25m">2.25m</option>
<option value="1.4m">1.4m</option>
</select>
</td>

END;
	}// end of if system
	else{
		echo '<td><input type="text" name="Model" size="20" value = "'. $objResult["Model"]. '"></td>';
	}
?>







<td align="right"><b>S/N:</td>
<td><input type="text" name="Serial_N" size="20" value="<?=$objResult["Serial_N"];?>">&nbsp;</td>



<tr BGCOLOR="#FFFFCC"><td align="right"><b>Owner: </td>
<td><input type="text" name="Owner" size="20" value="<?=$objResult["Owner"];?>"></td>

<td align="right">
<b>Inventory Number:</td><td><input type="text" name="Inventory_N" size="20" value="<?=$objResult["Inventory_N"];?>"></br></td></tr>




<?php
if ($objResult["Component_type"] == "Current Meter"){
	print <<<END

<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Average Interval:</td>
<td><input type="text" name="Average_interval" size="20" value= $objResult[Average_interval] >&nbsp; </td>

<td align="right"><b>Sample Interval: </td>
<td><input type="text" name="Sample_interval" size="20" value= $objResult[Sample_interval] > </td></tr>

END;
	}
?>

<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Sensor Range:</td>
<td><input type="text" name="Sensor_range" size="20" value="<?=$objResult["Sensor_range"];?>">&nbsp;</td>

<td align="right"><b>Factory Precision:</td>
<td><input type="text" name="Factory_precision" size="20" value="<?=$objResult["Factory_precision"];?>"></br></td></tr>

<tr BGCOLOR="#FFFFCC">

<td align="right"><b>Factory Accuracy:</td>
<td><input type="text" name="Factory_accuracy" size="20" value="<?=$objResult["Factory_accuracy"];?>">&nbsp; </td>

<td align="right"><b>Other Specifications: </td>
<td><input type="text" name="Other_specif" size="20" value="<?=$objResult["Other_specif"];?>"> </td></tr>

<tr BGCOLOR="#FFFFCC">

<td align="right"><b>Status:</td>
<td><input type="text" name="Status" size="20" value="<?=$objResult["Status"];?>">&nbsp; </td>

<td align="right"><b>Current Location: </td>
<td><input type="text" name="Current_location" size="20" value="<?=$objResult["Current_location"];?>"> </td></tr>

</table>
</b>


<?php
if ($objResult["Component_type"] == "Data Modem"){
	print <<<END

<br>
Telemetry Information
<table BORDER CELLPADDING=3>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Firmware Version:</td>
<td><input type="text" name="Firmware" size="20" value= "$objResult[Firmware]" >&nbsp; </td>

<td align="right"><b>Phone Number (x121 Address): </td>
<td><input type="text" name="Phone_x121" size="20" value= "$objResult[Phone_x121]" > </td></tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Phone ESN (xcvr S/N):</td>
<td><input type="text" name="Phone_ESN" size="20" value= "$objResult[Phone_ESN]" >&nbsp; </td>

<td align="right"><b>Cycle (min): </td>
<td><input type="text" name="Cylce" size="20" value= "$objResult[Cycle]" > </td></tr>



<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Offset (min):</td>
<td><input type="text" name="Offset" size="20" value= "$objResult[Offset]" >&nbsp; </td>

<td align="right"><b>Call Window (min): </td>
<td><input type="text" name="Call_window" size="20" value= "$objResult[Call_window]" > </td></tr>

<tr BGCOLOR="#FFFFCC">
<td align="right"><b>HEX ESN: </td>
<td><input type="text" name="HEX_ESN" size="20" value= "$objResult[HEX_ESN]" > </td>

<td align="right"><b>DEC ESN: </td>
<td><input type="text" name="DEC_ESN" size="20" value= "$objResult[DEC_ESN]" > </td></tr>

<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Base Number:</td>
<td><input type="text" name="Base_number" size="20" value= "$objResult[Base_number]" >&nbsp; </td>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Repetition Period (min):</td>
<td><input type="text" name="Repetition_period" size="20" value= "$objResult[Repetition_period]" >&nbsp; </td>

<td align="right"><b>Platform: </td>
<td><input type="text" name="Platform" size="20" value= "$objResult[Platform]" > </td></tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>ARGOS PTT ID: </td>
<td><input type="text" name="PTT_ID" size="20" value= "$objResult[PTT_ID]" > </td>

<td align="right"><b>ARGOS PTT S/N:</td>
<td><input type="text" name="Argos_PTT_SN" size="20" value= "$objResult[Argos_PTT_SN]" >&nbsp; </td></tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Test Scheduled (days): </td>
<td><input type="text" name="Test_sched" size="20" value= "$objResult[Test_sched]" > </td>

<td align="right"><b>Records unacknoledged:</td>
<td><input type="text" name="Records_unack" size="20" value= "$objResult[Records_unack]" >&nbsp; </td></tr>







END;
	}
?>
</table>

</b>

<br>
<b>Calibrations:</b>
<br>
<textarea name="Calibration_notes" rows="5" cols="97"><?php echo $objResult["Calibration_notes"];?></textarea><br>

<br>
<b>Notes:</b>
<br>
<textarea name="Notes" rows="7" cols="97"><?php echo $objResult["Notes"];?></textarea><br>

<br><br>
<input type="submit" name="submit" value="Submit & Back">



<?php
}
mysql_close($objConnect);
?>

</form>

</html>

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
<title>TABS 2.25 m Buoy Setup and Testing</title>
</head>
<body bgcolor="c0c8d6">
<center><h3 class="TITLE-STYLE">TABS 2.25 m Buoy Setup and Test</h3></center>

<h4 class="STYLE4">
<center>
<form action="./TABS225m_edit3.php?checkout=<?=$_GET["checkout"]; ?>" name="frmEdit" method="post">
<input type="submit" name="submit" value="Submit & Back"><br><br>

<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM TABS225m WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
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
<td align="right"><b>Lead Technician: </td>
<td><input type="text" name="Technicians" size="20" value="<?=$objResult["Technicians"];?>"> </td>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right"><b>System S/N:</td>
<td><input type="text" name="system_SN" size="20" value="<?=$objResult["system_SN"];?>"></td>

<td align="right"><b>Start Date:</td>
<td><input type="text" name="start_date" size="20" value="<?=$objResult["start_date"];?>"></br></td>
</tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Hull S/N:</td>
<td><input type="text" name="Hull_SN" size="20" value="<?=$objResult["Hull_SN"];?>">&nbsp;</td>

<td align="right"><b>Proposed Deployment Site:</td>
<td><input type="text" name="Site" size="20" value="<?=$objResult["Site"];?>"></br></td>
</tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Inventory Number:</td>
<td><input type="text" name="Inventory_N" size="20" value="<?=$objResult["Inventory_N"];?>">&nbsp;</td>

<td align="right"><b>ARGOS ID: </td>
<td><input type="text" name="ARGOS" size="20" value="<?=$objResult["ARGOS"];?>"></td>
</tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Globalstar Phone:</td>
<td><input type="text" name="Phone" size="20" value="<?=$objResult["Phone"];?>"></br></td>
<td align="right"><b>PTT S/N:</td>
<td><input type="text" name="PTT_SN" size="20" value="<?=$objResult["PTT_SN"];?>">&nbsp; </td>
</tr>



<tr BGCOLOR="#FFFFCC">
<td align="right">
<b>Globastar HEX ESN:</td><td><input type="text" name="HEX_ESN" size="20" value="<?=$objResult["HEX_ESN"];?>"></br></td>


</tr>

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
<tr BGCOLOR="#99CCFF"><TH>Type</td><TH>Manufacture</b></td><TH><b>Model</b></td>
<TH><b>Serial Number</b></td><TH><b>Range</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">Anemometer 1: </td><td align="center">Gill </td><td align="center">Windsonic </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field12a" SIZE=15 value="<?=$objResult["field12a"];?>" ></TD>
<td align="center">0 - 60 m/s</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Anemometer 2: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field11a" SIZE=15 value="<?=$objResult["field11a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field11b" SIZE=10 value="<?=$objResult["field11b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field11c" SIZE=15 value="<?=$objResult["field11c"];?>" ></TD>
<td align="center">0 - 60 m/s</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Compass 1: </td><td align="center">Honeywell</td><td align="center">HMR3300 </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field14a" SIZE=15 value="<?=$objResult["field14a"];?>" ></TD>
<td align="center">0 - 360 d Mag.</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Compass 2: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field13a" SIZE=15 value="<?=$objResult["field13a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field13b" SIZE=10 value="<?=$objResult["field13b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field13c" SIZE=15 value="<?=$objResult["field13c"];?>" ></TD>
<td align="center">0 - 360 d Mag.</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Pitch/Roll: </td><td align="center">Honeywell</td><td align="center">HMR3300</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field15a" SIZE=15 value="<?=$objResult["field15a"];?>" ></TD>
<td align="center">+/- 60 degrees</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Barometer: </td><td align="center">Vaisala</td><td align="center">PTB210</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field16a" SIZE=15 value="<?=$objResult["field16a"];?>" ></TD>
<td align="center">500 - 1100 hPa</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Air Temperature: </td><td align="center">Rotronics</td><td align="center">MP101A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field17a" SIZE=15 value="<?=$objResult["field17a"];?>" ></TD>
<td align="center">-30&deg;C to +70&deg;C</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Humidity: </td><td align="center">Rotronics</td><td align="center">MP101A</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field18a" SIZE=15 value="<?=$objResult["field18a"];?>" ></TD>
<td align="center">0 - 100%</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">PAR: </td><td align="center">Biospherical</td><td align="center">QSR-2150</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field19a" SIZE=15 value="<?=$objResult["field19a"];?>" ></TD>
<td align="center">&nbsp; </td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Current Sensor 1: </td><td align="center">Aanderea</td><td align="center">DCS4100R</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field20a" SIZE=15 value="<?=$objResult["field20a"];?>" ></TD>
<td align="center">0 - 300 cm/s</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Current Sensor 2: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field21a" SIZE=15 value="<?=$objResult["field21a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field21b" SIZE=10 value="<?=$objResult["field21b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field21c" SIZE=15 value="<?=$objResult["field21c"];?>" ></TD>
<td align="center">0 - 350 cm/s</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Water Temperature: </td><td align="center">MicroCat</td><td align="center">SBE-37SI</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field22a" SIZE=15 value="<?=$objResult["field22a"];?>" ></TD>
<td align="center">-5&deg;C to +35&deg;C</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Salinity Sensor: </td><td align="center">MicroCat</td><td align="center">SBE-37SI</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field23a" SIZE=15 value="<?=$objResult["field23a"];?>" ></TD>
<td align="center">0 - 70 mS/cm</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Fluorometer:<br>/Turbidity: </td><td align="center">Web Labs</td>
<td align="center">FLNTUS</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field24a" SIZE=15 value="<?=$objResult["field24a"];?>" ></TD>
<td align="center">0.02-60 ug/l <br>0-25 NTU</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Nutrients: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field25a" SIZE=15 value="<?=$objResult["field25a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field25b" SIZE=10 value="<?=$objResult["field25b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field25c" SIZE=15 value="<?=$objResult["field25c"];?>" ></TD>
<td align="center">&nbsp; </td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Inertial Motion: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field26a" SIZE=15 value="<?=$objResult["field26a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field26b" SIZE=10 value="<?=$objResult["field26b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field26c" SIZE=15 value="<?=$objResult["field26c"];?>" ></TD>
<td align="center">NA</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">GPS: </td><td align="center">Garmin</td><td align="center">16</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field27a" SIZE=15 value="<?=$objResult["field27a"];?>" ></TD>
<td align="center">NA</td></tr>

</table>



<br>
<b>Instrument/Sensor Comments:</b>
<br>
<textarea name="Notes" rows="10" cols="97"><?php echo $objResult["Notes"];?></textarea><br>


<br>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Submit & Back"><br>





<table border="1">

<tr BGCOLOR="#99CCFF">
<th align="center" colspan="9" ><b>Power System</b></th></tr>

<tr BGCOLOR="#99CCFF"><th colspan="2" align="right">Lead Acid Battery Manufacturer:</th>
<td align="center"><INPUT TYPE=TEXT NAME="field93a" SIZE=15 value="<?=$objResult["field93a"];?>" ></td>
<th align="right">Type:</th>
<td align="left" colspan="2" ><INPUT TYPE=TEXT NAME="field93b" SIZE=20 value="<?=$objResult["field93b"];?>" ></td></tr>


<tr BGCOLOR="#99CCFF">
<th>&nbsp;</th><th>Battery #</th><th>Voltage</th><th>Check<br>Fuse</th><th>Installation Date</th><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="center" rowspan="3">Battery Bank 1</td><td align="center">1</td>
<td align="center"><INPUT TYPE=TEXT NAME="field94a" SIZE=15 value="<?=$objResult["field94a"];?>" 
onChange="signature(this.form, 'field94a', 'field94_hold', 'field94_sig')"></TD>

<td align="center"><input type="checkbox" name="field94b" value="checked" <? echo $objResult["field94b"];?>
 onclick="signature(this.form, 'field94b', 'field94_hold', 'field94_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field94c" SIZE=15 value="<?=$objResult["field94c"];?>" 
onChange="signature(this.form, 'field94c', 'field94_hold', 'field94_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field94_hold" value="<?=$objResult["field94_sig"];?>">
<input type="text" name="field94_sig" size="15" value="<?=$objResult["field94_sig"];?>" 
onChange="not_allowed(this.form, 'field94_hold', 'field94_sig')">&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="center">2</td>
<td align="center"><INPUT TYPE=TEXT NAME="field95a" SIZE=15 value="<?=$objResult["field95a"];?>" 
onChange="signature(this.form, 'field95a', 'field95_hold', 'field95_sig')"></TD>

<td align="center"><input type="checkbox" name="field95b" value="checked" <? echo $objResult["field95b"];?>
 onclick="signature(this.form, 'field95b', 'field95_hold', 'field95_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field95c" SIZE=15 value="<?=$objResult["field95c"];?>" 
onChange="signature(this.form, 'field95c', 'field95_hold', 'field95_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field95_hold" value="<?=$objResult["field95_sig"];?>">
<input type="text" name="field95_sig" size="15" value="<?=$objResult["field95_sig"];?>" 
onChange="not_allowed(this.form, 'field95_hold', 'field95_sig')">&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="center">3</td>
<td align="center"><INPUT TYPE=TEXT NAME="field96a" SIZE=15 value="<?=$objResult["field96a"];?>" 
onChange="signature(this.form, 'field96a', 'field96_hold', 'field96_sig')"></TD>

<td align="center"><input type="checkbox" name="field96b" value="checked" <? echo $objResult["field96b"];?>
 onclick="signature(this.form, 'field96b', 'field96_hold', 'field96_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field96c" SIZE=15 value="<?=$objResult["field96c"];?>" 
onChange="signature(this.form, 'field96c', 'field96_hold', 'field96_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field96_hold" value="<?=$objResult["field96_sig"];?>">
<input type="text" name="field96_sig" size="15" value="<?=$objResult["field96_sig"];?>" 
onChange="not_allowed(this.form, 'field96_hold', 'field96_sig')"></td></tr>



<tr BGCOLOR="#FFFFCC"><td align="center" rowspan="3">Battery Bank 2</td><td align="center">1</td>
<td align="center"><INPUT TYPE=TEXT NAME="field97a" SIZE=15 value="<?=$objResult["field97a"];?>" 
onChange="signature(this.form, 'field97a', 'field97_hold', 'field97_sig')"></TD>

<td align="center"><input type="checkbox" name="field97b" value="checked" <? echo $objResult["field97b"];?>
 onclick="signature(this.form, 'field97b', 'field97_hold', 'field97_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field97c" SIZE=15 value="<?=$objResult["field97c"];?>" 
onChange="signature(this.form, 'field97c', 'field97_hold', 'field97_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field97_hold" value="<?=$objResult["field97_sig"];?>">
<input type="text" name="field97_sig" size="15" value="<?=$objResult["field97_sig"];?>" 
onChange="not_allowed(this.form, 'field97_hold', 'field97_sig')">&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="center">2</td>
<td align="center"><INPUT TYPE=TEXT NAME="field98a" SIZE=15 value="<?=$objResult["field98a"];?>" 
onChange="signature(this.form, 'field98a', 'field98_hold', 'field98_sig')"></TD>

<td align="center"><input type="checkbox" name="field98b" value="checked" <? echo $objResult["field98b"];?>
 onclick="signature(this.form, 'field98b', 'field98_hold', 'field98_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field98c" SIZE=15 value="<?=$objResult["field98c"];?>" 
onChange="signature(this.form, 'field98c', 'field98_hold', 'field98_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field98_hold" value="<?=$objResult["field98_sig"];?>">
<input type="text" name="field98_sig" size="15" value="<?=$objResult["field98_sig"];?>" 
onChange="not_allowed(this.form, 'field98_hold', 'field98_sig')">&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="center">3</td>
<td align="center"><INPUT TYPE=TEXT NAME="field99a" SIZE=15 value="<?=$objResult["field99a"];?>" 
onChange="signature(this.form, 'field99a', 'field99_hold', 'field99_sig')"></TD>

<td align="center"><input type="checkbox" name="field99b" value="checked" <? echo $objResult["field99b"];?>
 onclick="signature(this.form, 'field99b', 'field99_hold', 'field99_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field99c" SIZE=15 value="<?=$objResult["field99c"];?>" 
onChange="signature(this.form, 'field99c', 'field99_hold', 'field99_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field99_hold" value="<?=$objResult["field99_sig"];?>">
<input type="text" name="field99_sig" size="15" value="<?=$objResult["field99_sig"];?>" 
onChange="not_allowed(this.form, 'field99_hold', 'field99_sig')">&nbsp;</td></tr>



<tr BGCOLOR="#FFFFCC"><td align="center" rowspan="2">Battery Bank 3</td><td align="center">1</td>
<td align="center"><INPUT TYPE=TEXT NAME="field100a" SIZE=15 value="<?=$objResult["field100a"];?>" 
onChange="signature(this.form, 'field100a', 'field100_hold', 'field100_sig')"></TD>

<td align="center"><input type="checkbox" name="field100b" value="checked" <? echo $objResult["field100b"];?>
 onclick="signature(this.form, 'field100b', 'field100_hold', 'field100_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field100c" SIZE=15 value="<?=$objResult["field100c"];?>" 
onChange="signature(this.form, 'field100c', 'field100_hold', 'field100_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field100_hold" value="<?=$objResult["field100_sig"];?>">
<input type="text" name="field100_sig" size="15" value="<?=$objResult["field100_sig"];?>" 
onChange="not_allowed(this.form, 'field100_hold', 'field100_sig')">&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="center">2</td>
<td align="center"><INPUT TYPE=TEXT NAME="field101a" SIZE=15 value="<?=$objResult["field101a"];?>" 
onChange="signature(this.form, 'field101a', 'field101_hold', 'field101_sig')"></TD>

<td align="center"><input type="checkbox" name="field101b" value="checked" <? echo $objResult["field101b"];?>
 onclick="signature(this.form, 'field101b', 'field101_hold', 'field101_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field101c" SIZE=15 value="<?=$objResult["field101c"];?>" 
onChange="signature(this.form, 'field101c', 'field101_hold', 'field101_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field101_hold" value="<?=$objResult["field101_sig"];?>">
<input type="text" name="field101_sig" size="15" value="<?=$objResult["field101_sig"];?>" 
onChange="not_allowed(this.form, 'field101_hold', 'field101_sig')">&nbsp;</td></tr>








<tr BGCOLOR="#99CCFF"><td align="center" colspan="9" BGCOLOR="#0000c6" height="4"></td></tr>

<tr BGCOLOR="#99CCFF"><th colspan="2" align="right">Gell Cell Battery Manufacturer:</th>
<td align="center"><INPUT TYPE=TEXT NAME="field102a" SIZE=15 value="<?=$objResult["field102a"];?>" ></td>
<th align="right">Model:</th>
<td align="left" colspan="2" ><INPUT TYPE=TEXT NAME="field102b" SIZE=20 value="<?=$objResult["field102b"];?>" ></td></tr>


<tr BGCOLOR="#99CCFF">
<th>&nbsp;</th><th>Battery #</th><th>Voltage</th><th>Check<br>Fuse</th><th>Installation Date</th><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="center" rowspan="2">Argos Battery</td><td align="center">1</td>
<td align="center"><INPUT TYPE=TEXT NAME="field103a" SIZE=15 value="<?=$objResult["field103a"];?>" 
onChange="signature(this.form, 'field103a', 'field103_hold', 'field103_sig')"></TD>

<td align="center"><input type="checkbox" name="field103b" value="checked" <? echo $objResult["field103b"];?>
 onclick="signature(this.form, 'field103b', 'field103_hold', 'field103_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field103c" SIZE=15 value="<?=$objResult["field103c"];?>" 
onChange="signature(this.form, 'field103c', 'field103_hold', 'field103_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field103_hold" value="<?=$objResult["field103_sig"];?>">
<input type="text" name="field103_sig" size="15" value="<?=$objResult["field103_sig"];?>" 
onChange="not_allowed(this.form, 'field103_hold', 'field103_sig')">&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="center">2</td>
<td align="center"><INPUT TYPE=TEXT NAME="field104a" SIZE=15 value="<?=$objResult["field104a"];?>" 
onChange="signature(this.form, 'field104a', 'field104_hold', 'field104_sig')"></TD>

<td align="center"><input type="checkbox" name="field104b" value="checked" <? echo $objResult["field104b"];?>
 onclick="signature(this.form, 'field104b', 'field104_hold', 'field104_sig')"></TD>
 
 <td align="center"><INPUT TYPE=TEXT NAME="field104c" SIZE=15 value="<?=$objResult["field104c"];?>" 
onChange="signature(this.form, 'field104c', 'field104_hold', 'field104_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field104_hold" value="<?=$objResult["field104_sig"];?>">
<input type="text" name="field104_sig" size="15" value="<?=$objResult["field104_sig"];?>" 
onChange="not_allowed(this.form, 'field104_hold', 'field104_sig')">&nbsp;</td></tr>

</table>



<br>

<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td><td BGCOLOR="#0000c6"></td>
<th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td>
</tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">Solar Panel Voltage 1 <br>(full sunlight)</td><td align="center">18 V</td>

<td align="center"><input type="checkbox" name="field34a" value="checked" <? echo $objResult["field34a"];?>
 onclick="signature(this.form, 'field34a', 'field34_hold', 'field34_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field34_hold" value="<?=$objResult["field34_sig"];?>">
<input type="text" name="field34_sig" size="15" value="<?=$objResult["field34_sig"];?>" 
onChange="not_allowed(this.form, 'field34_hold', 'field34_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">System Voltage</td><td align="center">13.5 V</td>
<td align="center"><input type="checkbox" name="field40" value="checked" <? echo $objResult["field40"];?>
 onclick="signature(this.form, 'field40', 'field40_hold', 'field40_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field40_hold" value="<?=$objResult["field40_sig"];?>">
<input type="text" name="field40_sig" size="15" value="<?=$objResult["field40_sig"];?>" 
onChange="not_allowed(this.form, 'field40_hold', 'field40_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Solar Panel Voltage 2 <br>(full sunlight)</td><td align="center">18 V</td>
<td align="center"><input type="checkbox" name="field35a" value="checked" <? echo $objResult["field35a"];?>
 onclick="signature(this.form, 'field35a', 'field35_hold', 'field35_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field35_hold" value="<?=$objResult["field35_sig"];?>">
<input type="text" name="field35_sig" size="15" value="<?=$objResult["field35_sig"];?>" 
onChange="not_allowed(this.form, 'field35_hold', 'field35_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">ADCP Voltage Supply</td><td align="center">54 V</td>
<td align="center"><input type="checkbox" name="field41" value="checked" <? echo $objResult["field41"];?>
 onclick="signature(this.form, 'field41', 'field41_hold', 'field41_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field41_hold" value="<?=$objResult["field41_sig"];?>">
<input type="text" name="field41_sig" size="15" value="<?=$objResult["field41_sig"];?>" 
onChange="not_allowed(this.form, 'field41_hold', 'field41_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Solar Panel Voltage 3 <br>(full sunlight)</td><td align="center">18 V</td>
<td align="center"><input type="checkbox" name="field36a" value="checked" <? echo $objResult["field36a"];?>
 onclick="signature(this.form, 'field36a', 'field36_hold', 'field36_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field36_hold" value="<?=$objResult["field36_sig"];?>">
<input type="text" name="field36_sig" size="15" value="<?=$objResult["field36_sig"];?>" 
onChange="not_allowed(this.form, 'field36_hold', 'field36_sig')"></td><td BGCOLOR="#0000c6"></td>


<td align="right">ARGOS Batteries</td><td align="center">13.5 V</td>
<td align="center"><input type="checkbox" name="field42" value="checked" <? echo $objResult["field42"];?>
 onclick="signature(this.form, 'field42', 'field42_hold', 'field42_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field42_hold" value="<?=$objResult["field42_sig"];?>">
<input type="text" name="field42_sig" size="15" value="<?=$objResult["field42_sig"];?>" 
onChange="not_allowed(this.form, 'field42_hold', 'field42_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Regulator 1 Output</td><td align="center">13.5 V</td>
<td align="center"><input type="checkbox" name="field37" value="checked" <? echo $objResult["field37"];?>
 onclick="signature(this.form, 'field37', 'field37_hold', 'field37_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field37_hold" value="<?=$objResult["field37_sig"];?>">
<input type="text" name="field37_sig" size="15" value="<?=$objResult["field37_sig"];?>" 
onChange="not_allowed(this.form, 'field37_hold', 'field37_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">Voltage across <br>PC104 switch</td><td align="center">13.5 V</td>
<td align="center"><input type="checkbox" name="field43" value="checked" <? echo $objResult["field43"];?>
 onclick="signature(this.form, 'field43', 'field43_hold', 'field43_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field43_hold" value="<?=$objResult["field43_sig"];?>">
<input type="text" name="field43_sig" size="15" value="<?=$objResult["field43_sig"];?>" 
onChange="not_allowed(this.form, 'field43_hold', 'field43_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Regulator 2 Output</td><td align="center">13.5 V</td>
<td align="center"><input type="checkbox" name="field38" value="checked" <? echo $objResult["field38"];?>
 onclick="signature(this.form, 'field38', 'field38_hold', 'field38_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field38_hold" value="<?=$objResult["field38_sig"];?>">
<input type="text" name="field38_sig" size="15" value="<?=$objResult["field38_sig"];?>" 
onChange="not_allowed(this.form, 'field38_hold', 'field38_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">3 V supply</td><td align="center">3 V</td>
<td align="center"><input type="checkbox" name="field44" value="checked" <? echo $objResult["field44"];?>
 onclick="signature(this.form, 'field44', 'field44_hold', 'field44_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field44_hold" value="<?=$objResult["field44_sig"];?>">
<input type="text" name="field44_sig" size="15" value="<?=$objResult["field44_sig"];?>" 
onChange="not_allowed(this.form, 'field44_hold', 'field44_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Regulator 3 Output</td><td align="center">13.5 V</td>
<td align="center"><input type="checkbox" name="field39" value="checked" <? echo $objResult["field39"];?>
 onclick="signature(this.form, 'field39', 'field39_hold', 'field39_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field39_hold" value="<?=$objResult["field39_sig"];?>">
<input type="text" name="field39_sig" size="15" value="<?=$objResult["field39_sig"];?>" 
onChange="not_allowed(this.form, 'field39_hold', 'field39_sig')"></td><td BGCOLOR="#0000c6"></td></tr>

</table>







<table border="1">
<tr BGCOLOR="#99CCFF"><th colspan="10"><b>Switched Power Ports</b></td></tr></b>
<tr BGCOLOR="#99CCFF"><th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td><td BGCOLOR="#0000c6"></td>
<th><b>Measurements</b></td><th><b>Nominal<br>Value</b></td><th><b>Checked</b></td>
<th><b>NetID</b></td>
</tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">P1</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field45" value="checked" <? echo $objResult["field45"];?>
 onclick="signature(this.form, 'field45', 'field45_hold', 'field45_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field45_hold" value="<?=$objResult["field45_sig"];?>">
<input type="text" name="field45_sig" size="15" value="<?=$objResult["field45_sig"];?>" 
onChange="not_allowed(this.form, 'field45_hold', 'field45_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">P7</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field46" value="checked" <? echo $objResult["field46"];?>
 onclick="signature(this.form, 'field46', 'field46_hold', 'field46_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field46_hold" value="<?=$objResult["field46_sig"];?>">
<input type="text" name="field46_sig" size="15" value="<?=$objResult["field46_sig"];?>" 
onChange="not_allowed(this.form, 'field46_hold', 'field46_sig')"></td></tr>



<tr BGCOLOR="#FFFFCC"><td align="right">P2</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field47" value="checked" <? echo $objResult["field47"];?>
 onclick="signature(this.form, 'field47', 'field47_hold', 'field47_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field47_hold" value="<?=$objResult["field47_sig"];?>">
<input type="text" name="field47_sig" size="15" value="<?=$objResult["field47_sig"];?>" 
onChange="not_allowed(this.form, 'field47_hold', 'field47_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">P8</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field48" value="checked" <? echo $objResult["field48"];?>
 onclick="signature(this.form, 'field48', 'field48_hold', 'field48_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field48_hold" value="<?=$objResult["field48_sig"];?>">
<input type="text" name="field48_sig" size="15" value="<?=$objResult["field48_sig"];?>" 
onChange="not_allowed(this.form, 'field48_hold', 'field48_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">P3</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field49" value="checked" <? echo $objResult["field49"];?>
 onclick="signature(this.form, 'field49', 'field49_hold', 'field49_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field49_hold" value="<?=$objResult["field49_sig"];?>">
<input type="text" name="field49_sig" size="15" value="<?=$objResult["field49_sig"];?>" 
onChange="not_allowed(this.form, 'field49_hold', 'field49_sig')"></td><td BGCOLOR="#0000c6"></td>


<td align="right">P9</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field50" value="checked" <? echo $objResult["field50"];?>
 onclick="signature(this.form, 'field50', 'field50_hold', 'field50_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field50_hold" value="<?=$objResult["field50_sig"];?>">
<input type="text" name="field50_sig" size="15" value="<?=$objResult["field50_sig"];?>" 
onChange="not_allowed(this.form, 'field50_hold', 'field50_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">P4</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field51" value="checked" <? echo $objResult["field51"];?>
 onclick="signature(this.form, 'field51', 'field51_hold', 'field51_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field51_hold" value="<?=$objResult["field51_sig"];?>">
<input type="text" name="field51_sig" size="15" value="<?=$objResult["field51_sig"];?>" 
onChange="not_allowed(this.form, 'field51_hold', 'field51_sig')"></td><td BGCOLOR="#0000c6"></td>


<td align="right">P10</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field52" value="checked" <? echo $objResult["field52"];?>
 onclick="signature(this.form, 'field52', 'field52_hold', 'field52_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field52_hold" value="<?=$objResult["field52_sig"];?>">
<input type="text" name="field52_sig" size="15" value="<?=$objResult["field52_sig"];?>" 
onChange="not_allowed(this.form, 'field52_hold', 'field52_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">P5</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field53" value="checked" <? echo $objResult["field53"];?>
 onclick="signature(this.form, 'field53', 'field53_hold', 'field53_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field53_hold" value="<?=$objResult["field53_sig"];?>">
<input type="text" name="field53_sig" size="15" value="<?=$objResult["field53_sig"];?>" 
onChange="not_allowed(this.form, 'field53_hold', 'field53_sig')"></td><td BGCOLOR="#0000c6"></td>


<td align="right">P11</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field54" value="checked" <? echo $objResult["field54"];?>
 onclick="signature(this.form, 'field54', 'field54_hold', 'field54_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field54_hold" value="<?=$objResult["field54_sig"];?>">
<input type="text" name="field54_sig" size="15" value="<?=$objResult["field54_sig"];?>" 
onChange="not_allowed(this.form, 'field54_hold', 'field54_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">P6</td><td align="center">12.5 V</td>

<td align="center"><input type="checkbox" name="field55" value="checked" <? echo $objResult["field55"];?>
 onclick="signature(this.form, 'field55', 'field55_hold', 'field55_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field55_hold" value="<?=$objResult["field55_sig"];?>">
<input type="text" name="field55_sig" size="15" value="<?=$objResult["field55_sig"];?>" 
onChange="not_allowed(this.form, 'field55_hold', 'field55_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">P12</td><td align="center">54 V</td>

<td align="center"><input type="checkbox" name="field56" value="checked" <? echo $objResult["field56"];?>
 onclick="signature(this.form, 'field56', 'field56_hold', 'field56_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field56_hold" value="<?=$objResult["field56_sig"];?>">
<input type="text" name="field56_sig" size="15" value="<?=$objResult["field56_sig"];?>" 
onChange="not_allowed(this.form, 'field56_hold', 'field56_sig')"></td></tr>

</table>

<br><br>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">





<table border="1">

<tr BGCOLOR="#99CCFF">
<th align="center" colspan="9" ><b>Compass Allignment and Calibrations</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>&nbsp;</th><th>Direction</th><th>Calibrated</th><th>NetID</th>
<td BGCOLOR="#0000c6"></td><th>&nbsp;</th><th>Direction</th><th>Calibrated</th><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">HMR-3300</td>
<td align="center"><INPUT TYPE=TEXT NAME="field29a" SIZE=15 value="<?=$objResult["field29a"];?>" 
onChange="signature(this.form, 'field29a', 'field29_hold', 'field29_sig')"></TD>

<td align="center"><input type="checkbox" name="field29b" value="checked" <? echo $objResult["field29b"];?>
 onclick="signature(this.form, 'field29b', 'field29_hold', 'field29_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field29_hold" value="<?=$objResult["field29_sig"];?>">
<input type="text" name="field29_sig" size="15" value="<?=$objResult["field29_sig"];?>" 
onChange="not_allowed(this.form, 'field29_hold', 'field29_sig')">&nbsp;</td>

<td BGCOLOR="#0000c6"></td>

<td align="center"><INPUT TYPE=TEXT NAME="field30c" SIZE=15 value="<?=$objResult["field30c"];?>" 
onChange="signature(this.form, 'field30c', 'field30_hold', 'field30_sig')"></TD>

<td align="center"><INPUT TYPE=TEXT NAME="field30a" SIZE=15 value="<?=$objResult["field30a"];?>" 
onChange="signature(this.form, 'field30a', 'field30_hold', 'field30_sig')"></TD>

<td align="center"><input type="checkbox" name="field30b" value="checked" <? echo $objResult["field30b"];?>
 onclick="signature(this.form, 'field30b', 'field30_hold', 'field30_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field30_hold" value="<?=$objResult["field30_sig"];?>">
<input type="text" name="field30_sig" size="15" value="<?=$objResult["field30_sig"];?>" 
onChange="not_allowed(this.form, 'field30_hold', 'field30_sig')">&nbsp;</td>

<tr BGCOLOR="#FFFFCC"><td align="right">IMU</td>
<td align="center"><INPUT TYPE=TEXT NAME="field31a" SIZE=15 value="<?=$objResult["field31a"];?>" 
onChange="signature(this.form, 'field31a', 'field31_hold', 'field31_sig')"></TD>

<td align="center"><input type="checkbox" name="field31b" value="checked" <? echo $objResult["field31b"];?>
 onclick="signature(this.form, 'field31b', 'field31_hold', 'field31_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field31_hold" value="<?=$objResult["field31_sig"];?>">
<input type="text" name="field31_sig" size="15" value="<?=$objResult["field31_sig"];?>" 
onChange="not_allowed(this.form, 'field31_hold', 'field31_sig')"></td><td BGCOLOR="#0000c6"></td>
<th align="left" colspan="4" >

</table>

<br>


<table border="1">
<tr BGCOLOR="#99CCFF">
<th align="center" colspan="5" ><b>Wind Sensor Allignment</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>&nbsp;</th><th>Direction</th><td align="center">Locked<br>in place</td>
<td align="center">Masts<br>Marked</td><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Windsonic</td>
<td align="center"><INPUT TYPE=TEXT NAME="field32a" SIZE=15 value="<?=$objResult["field32a"];?>" 
onChange="signature(this.form, 'field32a', 'field32_hold', 'field32_sig')"></TD>

<td align="center"><input type="checkbox" name="field32b" value="checked" <? echo $objResult["field32b"];?>
 onclick="signature(this.form, 'field32b', 'field32_hold', 'field32_sig')"></TD>
 
<td align="center"><input type="checkbox" name="field32c" value="checked" <? echo $objResult["field32c"];?>
 onclick="signature(this.form, 'field32c', 'field32_hold', 'field32_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field32_hold" value="<?=$objResult["field32_sig"];?>">
<input type="text" name="field32_sig" size="15" value="<?=$objResult["field32_sig"];?>" 
onChange="not_allowed(this.form, 'field32_hold', 'field32_sig')">&nbsp;</td></tr>



<tr BGCOLOR="#FFFFCC"><td align="center"><INPUT TYPE=TEXT NAME="field33d" SIZE=15 value="<?=$objResult["field33d"];?>" 
onChange="signature(this.form, 'field33d', 'field33_hold', 'field33_sig')"></TD>

<td align="center"><INPUT TYPE=TEXT NAME="field33a" SIZE=15 value="<?=$objResult["field33a"];?>" 
onChange="signature(this.form, 'field33a', 'field33_hold', 'field33_sig')"></TD>

<td align="center"><input type="checkbox" name="field33b" value="checked" <? echo $objResult["field33b"];?>
 onclick="signature(this.form, 'field33b', 'field33_hold', 'field33_sig')"></TD>
 
<td align="center"><input type="checkbox" name="field33c" value="checked" <? echo $objResult["field33c"];?>
 onclick="signature(this.form, 'field33c', 'field33_hold', 'field33_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field33_hold" value="<?=$objResult["field33_sig"];?>">
<input type="text" name="field33_sig" size="15" value="<?=$objResult["field33_sig"];?>" 
onChange="not_allowed(this.form, 'field33_hold', 'field33_sig')">&nbsp;</td></tr>

</table>

<br>




<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Port Timing<br>/Operation</b></td><th><b>Sensor</b></td><th><b>Tested</b></td><th><b>NetID</b></td>
<td BGCOLOR="#0000c6"></td>
<th><b>Port Timing<br>/Operation</b></td><th><b>Sensor</b></td><th><b>Tested</b></td><th><b>NetID</b></td>
</tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">EMM1</td>
<TD><INPUT TYPE=TEXT NAME="field57a" SIZE=20 value="<?=$objResult["field57a"];?>" 
onChange="signature(this.form, 'field57a', 'field57_hold', 'field57_sig')"></TD>

<td align="center"><input type="checkbox" name="field57b" value="checked" <? echo $objResult["field57b"];?>
 onclick="signature(this.form, 'field57b', 'field57_hold', 'field57_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field57_hold" value="<?=$objResult["field57_sig"];?>">
<input type="text" name="field57_sig" size="15" value="<?=$objResult["field57_sig"];?>" 
onChange="not_allowed(this.form, 'field57_hold', 'field57_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">EMM7</td>
<TD><INPUT TYPE=TEXT NAME="field63a" SIZE=20 value="<?=$objResult["field63a"];?>" 
onChange="signature(this.form, 'field63a', 'field63_hold', 'field63_sig')"></TD>

<td align="center"><input type="checkbox" name="field63b" value="checked" <? echo $objResult["field63b"];?>
 onclick="signature(this.form, 'field63b', 'field63_hold', 'field63_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field63_hold" value="<?=$objResult["field63_sig"];?>">
<input type="text" name="field63_sig" size="15" value="<?=$objResult["field63_sig"];?>" 
onChange="not_allowed(this.form, 'field63_hold', 'field63_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">EMM2</td>
<TD><INPUT TYPE=TEXT NAME="field58a" SIZE=20 value="<?=$objResult["field58a"];?>" 
onChange="signature(this.form, 'field58a', 'field58_hold', 'field58_sig')"></TD>

<td align="center"><input type="checkbox" name="field58b" value="checked" <? echo $objResult["field58b"];?>
 onclick="signature(this.form, 'field58b', 'field58_hold', 'field58_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field58_hold" value="<?=$objResult["field58_sig"];?>">
<input type="text" name="field58_sig" size="15" value="<?=$objResult["field58_sig"];?>" 
onChange="not_allowed(this.form, 'field58_hold', 'field58_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">EMM8</td>
<TD><INPUT TYPE=TEXT NAME="field64a" SIZE=20 value="<?=$objResult["field64a"];?>" 
onChange="signature(this.form, 'field64a', 'field64_hold', 'field64_sig')"></TD>

<td align="center"><input type="checkbox" name="field64b" value="checked" <? echo $objResult["field64b"];?>
 onclick="signature(this.form, 'field64b', 'field64_hold', 'field64_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field64_hold" value="<?=$objResult["field64_sig"];?>">
<input type="text" name="field64_sig" size="15" value="<?=$objResult["field64_sig"];?>" 
onChange="not_allowed(this.form, 'field64_hold', 'field64_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">EMM3</td>
<TD><INPUT TYPE=TEXT NAME="field59a" SIZE=20 value="<?=$objResult["field59a"];?>" 
onChange="signature(this.form, 'field59a', 'field59_hold', 'field59_sig')"></TD>

<td align="center"><input type="checkbox" name="field59b" value="checked" <? echo $objResult["field59b"];?>
 onclick="signature(this.form, 'field59b', 'field59_hold', 'field59_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field59_hold" value="<?=$objResult["field59_sig"];?>">
<input type="text" name="field59_sig" size="15" value="<?=$objResult["field59_sig"];?>" 
onChange="not_allowed(this.form, 'field59_hold', 'field59_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM1</td>
<TD><INPUT TYPE=TEXT NAME="field65a" SIZE=20 value="<?=$objResult["field65a"];?>" 
onChange="signature(this.form, 'field65a', 'field65_hold', 'field65_sig')"></TD>

<td align="center"><input type="checkbox" name="field65b" value="checked" <? echo $objResult["field65b"];?>
 onclick="signature(this.form, 'field65b', 'field65_hold', 'field65_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field65_hold" value="<?=$objResult["field65_sig"];?>">
<input type="text" name="field65_sig" size="15" value="<?=$objResult["field65_sig"];?>" 
onChange="not_allowed(this.form, 'field65_hold', 'field65_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">EMM4</td>

<TD><INPUT TYPE=TEXT NAME="field60a" SIZE=20 value="<?=$objResult["field60a"];?>" 
onChange="signature(this.form, 'field60a', 'field60_hold', 'field60_sig')"></TD>

<td align="center"><input type="checkbox" name="field60b" value="checked" <? echo $objResult["field60b"];?>
 onclick="signature(this.form, 'field60b', 'field60_hold', 'field60_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field60_hold" value="<?=$objResult["field60_sig"];?>">
<input type="text" name="field60_sig" size="15" value="<?=$objResult["field60_sig"];?>" 
onChange="not_allowed(this.form, 'field60_hold', 'field60_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM2</td>
<TD><INPUT TYPE=TEXT NAME="field66a" SIZE=20 value="<?=$objResult["field66a"];?>" 
onChange="signature(this.form, 'field66a', 'field66_hold', 'field66_sig')"></TD>

<td align="center"><input type="checkbox" name="field66b" value="checked" <? echo $objResult["field66b"];?>
 onclick="signature(this.form, 'field66b', 'field66_hold', 'field66_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field66_hold" value="<?=$objResult["field66_sig"];?>">
<input type="text" name="field66_sig" size="15" value="<?=$objResult["field66_sig"];?>" 
onChange="not_allowed(this.form, 'field66_hold', 'field66_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">EMM5</td>

<TD><INPUT TYPE=TEXT NAME="field61a" SIZE=20 value="<?=$objResult["field61a"];?>" 
onChange="signature(this.form, 'field61a', 'field61_hold', 'field61_sig')"></TD>

<td align="center"><input type="checkbox" name="field61b" value="checked" <? echo $objResult["field61b"];?>
 onclick="signature(this.form, 'field61b', 'field61_hold', 'field61_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field61_hold" value="<?=$objResult["field61_sig"];?>">
<input type="text" name="field61_sig" size="15" value="<?=$objResult["field61_sig"];?>" 
onChange="not_allowed(this.form, 'field61_hold', 'field61_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM3</td>
<TD><INPUT TYPE=TEXT NAME="field67a" SIZE=20 value="<?=$objResult["field67a"];?>" 
onChange="signature(this.form, 'field67a', 'field67_hold', 'field67_sig')"></TD>

<td align="center"><input type="checkbox" name="field67b" value="checked" <? echo $objResult["field67b"];?>
 onclick="signature(this.form, 'field67b', 'field67_hold', 'field67_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field67_hold" value="<?=$objResult["field67_sig"];?>">
<input type="text" name="field67_sig" size="15" value="<?=$objResult["field67_sig"];?>" 
onChange="not_allowed(this.form, 'field67_hold', 'field67_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">EMM6</td>
<TD><INPUT TYPE=TEXT NAME="field62a" SIZE=20 value="<?=$objResult["field62a"];?>" 
onChange="signature(this.form, 'field62a', 'field62_hold', 'field62_sig')"></TD>

<td align="center"><input type="checkbox" name="field62b" value="checked" <? echo $objResult["field62b"];?>
 onclick="signature(this.form, 'field62b', 'field62_hold', 'field62_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field62_hold" value="<?=$objResult["field62_sig"];?>">
<input type="text" name="field62_sig" size="15" value="<?=$objResult["field62_sig"];?>" 
onChange="not_allowed(this.form, 'field62_hold', 'field62_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">COM4</td>
<TD><INPUT TYPE=TEXT NAME="field68a" SIZE=20 value="<?=$objResult["field68a"];?>" 
onChange="signature(this.form, 'field68a', 'field68_hold', 'field68_sig')"></TD>

<td align="center"><input type="checkbox" name="field68b" value="checked" <? echo $objResult["field68b"];?>
 onclick="signature(this.form, 'field68b', 'field68_hold', 'field68_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field68_hold" value="<?=$objResult["field68_sig"];?>">
<input type="text" name="field68_sig" size="15" value="<?=$objResult["field68_sig"];?>" 
onChange="not_allowed(this.form, 'field68_hold', 'field68_sig')"></td></tr>

</table>

<br><br>

<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">


<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Analog Ports</b></td><th><b>Data</b></td><th><b>Notes</b></td><th><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">External Temp/Humidity</td>
<TD><INPUT TYPE=TEXT NAME="field69a" SIZE=20 value="<?=$objResult["field69a"];?>" 
onChange="signature(this.form, 'field69a', 'field69_hold', 'field69_sig')"></TD>

<TD><INPUT TYPE=TEXT NAME="field69b" SIZE=40 value="<?=$objResult["field69b"];?>" 
onChange="signature(this.form, 'field69b', 'field69_hold', 'field69_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field69_hold" value="<?=$objResult["field69_sig"];?>">
<input type="text" name="field69_sig" size="15" value="<?=$objResult["field69_sig"];?>" 
onChange="not_allowed(this.form, 'field69_hold', 'field69_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Internal Temp/Humidity</td>
<TD><INPUT TYPE=TEXT NAME="field70a" SIZE=20 value="<?=$objResult["field70a"];?>" 
onChange="signature(this.form, 'field70a', 'field70_hold', 'field70_sig')"></TD>

<TD><INPUT TYPE=TEXT NAME="field70b" SIZE=40 value="<?=$objResult["field70b"];?>" 
onChange="signature(this.form, 'field70b', 'field70_hold', 'field70_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field70_hold" value="<?=$objResult["field70_sig"];?>">
<input type="text" name="field70_sig" size="15" value="<?=$objResult["field70_sig"];?>" 
onChange="not_allowed(this.form, 'field70_hold', 'field70_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Battery Voltages</td>
<TD><INPUT TYPE=TEXT NAME="field71a" SIZE=20 value="<?=$objResult["field71a"];?>" 
onChange="signature(this.form, 'field71a', 'field71_hold', 'field71_sig')"></TD>

<TD><INPUT TYPE=TEXT NAME="field71b" SIZE=40 value="<?=$objResult["field71b"];?>" 
onChange="signature(this.form, 'field71b', 'field71_hold', 'field71_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field71_hold" value="<?=$objResult["field71_sig"];?>">
<input type="text" name="field71_sig" size="15" value="<?=$objResult["field71_sig"];?>" 
onChange="not_allowed(this.form, 'field71_hold', 'field71_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Charge Currents</td>
<TD><INPUT TYPE=TEXT NAME="field72a" SIZE=20 value="<?=$objResult["field72a"];?>" 
onChange="signature(this.form, 'field72a', 'field72_hold', 'field72_sig')"></TD>

<TD><INPUT TYPE=TEXT NAME="field72b" SIZE=40 value="<?=$objResult["field72b"];?>" 
onChange="signature(this.form, 'field72b', 'field72_hold', 'field72_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field72_hold" value="<?=$objResult["field72_sig"];?>">
<input type="text" name="field72_sig" size="15" value="<?=$objResult["field72_sig"];?>" 
onChange="not_allowed(this.form, 'field72_hold', 'field72_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">ADCP Voltage</td>
<TD><INPUT TYPE=TEXT NAME="field73a" SIZE=20 value="<?=$objResult["field73a"];?>" 
onChange="signature(this.form, 'field73a', 'field73_hold', 'field73_sig')"></TD>

<TD><INPUT TYPE=TEXT NAME="field73b" SIZE=40 value="<?=$objResult["field73b"];?>" 
onChange="signature(this.form, 'field73b', 'field73_hold', 'field73_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field73_hold" value="<?=$objResult["field73_sig"];?>">
<input type="text" name="field73_sig" size="15" value="<?=$objResult["field73_sig"];?>" 
onChange="not_allowed(this.form, 'field73_hold', 'field73_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Others</td>
<TD><INPUT TYPE=TEXT NAME="field74a" SIZE=20 value="<?=$objResult["field74a"];?>" 
onChange="signature(this.form, 'field74a', 'field74_hold', 'field74_sig')"></TD>

<TD><INPUT TYPE=TEXT NAME="field74b" SIZE=40 value="<?=$objResult["field74b"];?>" 
onChange="signature(this.form, 'field74b', 'field74_hold', 'field74_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field74_hold" value="<?=$objResult["field74_sig"];?>">
<input type="text" name="field74_sig" size="15" value="<?=$objResult["field74_sig"];?>" 
onChange="not_allowed(this.form, 'field74_hold', 'field74_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right"></td>
<TD><INPUT TYPE=TEXT NAME="field75a" SIZE=20 value="<?=$objResult["field75a"];?>" 
onChange="signature(this.form, 'field75a', 'field75_hold', 'field75_sig')"></TD>

<TD><INPUT TYPE=TEXT NAME="field75b" SIZE=40 value="<?=$objResult["field75b"];?>" 
onChange="signature(this.form, 'field75b', 'field75_hold', 'field75_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field75_hold" value="<?=$objResult["field75_sig"];?>">
<input type="text" name="field75_sig" size="15" value="<?=$objResult["field75_sig"];?>" 
onChange="not_allowed(this.form, 'field75_hold', 'field75_sig')"></td></tr>

</table>


<br><br>



<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">



<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Telemetry</b></td><th><b>Tested</b></td><th><b>Date</b></td><th><b>NetID</b></td>
<td BGCOLOR="#0000c6"></td>
<th><b>Telemetry</b></td><th><b>Tested</b></td><th><b>Date</b></td><th><b>NetID</b></td>
</tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">ARGOS</td>
<td align="center"><input type="checkbox" name="field76a" value="checked" <? echo $objResult["field76a"];?>
 onclick="signature(this.form, 'field76b', 'field76_hold', 'field76_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field76b" SIZE=8 value="<?=$objResult["field76b"];?>" 
onChange="signature(this.form, 'field76b', 'field76_hold', 'field76_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field76_hold" value="<?=$objResult["field76_sig"];?>">
<input type="text" name="field76_sig" size="15" value="<?=$objResult["field76_sig"];?>" 
onChange="not_allowed(this.form, 'field76_hold', 'field76_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right">WIFI</td>
<td align="center"><input type="checkbox" name="field77a" value="checked" <? echo $objResult["field77a"];?>
 onclick="signature(this.form, 'field77b', 'field77_hold', 'field77_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field77b" SIZE=8 value="<?=$objResult["field77b"];?>" 
onChange="signature(this.form, 'field77b', 'field77_hold', 'field77_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field77_hold" value="<?=$objResult["field77_sig"];?>">
<input type="text" name="field77_sig" size="15" value="<?=$objResult["field77_sig"];?>" 
onChange="not_allowed(this.form, 'field77_hold', 'field77_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Globalstar</td>
<td align="center"><input type="checkbox" name="field78a" value="checked" <? echo $objResult["field78a"];?>
 onclick="signature(this.form, 'field78b', 'field78_hold', 'field78_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field78b" SIZE=8 value="<?=$objResult["field78b"];?>" 
onChange="signature(this.form, 'field78b', 'field78_hold', 'field78_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field78_hold" value="<?=$objResult["field78_sig"];?>">
<input type="text" name="field78_sig" size="15" value="<?=$objResult["field78_sig"];?>" 
onChange="not_allowed(this.form, 'field78_hold', 'field78_sig')"></td><td BGCOLOR="#0000c6"></td>

<td align="right"><INPUT TYPE=TEXT NAME="field79c" SIZE=8 value="<?=$objResult["field79c"];?>" 
onChange="signature(this.form, 'field79c', 'field79_hold', 'field79_sig')"></TD>

<td align="center"><input type="checkbox" name="field79a" value="checked" <? echo $objResult["field79a"];?>
 onclick="signature(this.form, 'field79b', 'field79_hold', 'field79_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field79b" SIZE=8 value="<?=$objResult["field79b"];?>" 
onChange="signature(this.form, 'field79b', 'field79_hold', 'field79_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field79_hold" value="<?=$objResult["field79_sig"];?>">
<input type="text" name="field79_sig" size="15" value="<?=$objResult["field79_sig"];?>" 
onChange="not_allowed(this.form, 'field79_hold', 'field79_sig')"></td></tr>

</table>

<br>

<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Mechanical</b></td><th><b>Tested</b></td><th><b>Notes</b></td><th><b>NetID</b></td></tr></b>


<tr BGCOLOR="#FFFFCC"><td align="right">Isolators on through rods</td>
<td align="center"><input type="checkbox" name="field105a" value="checked" <? echo $objResult["field105a"];?>
 onclick="signature(this.form, 'field105b', 'field105_hold', 'field105_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field105b" SIZE=40 value="<?=$objResult["field105b"];?>" 
onChange="signature(this.form, 'field105b', 'field105_hold', 'field105_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field105_hold" value="<?=$objResult["field105_sig"];?>">
<input type="text" name="field105_sig" size="15" value="<?=$objResult["field105_sig"];?>" 
onChange="not_allowed(this.form, 'field105_hold', 'field105_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Isolators on substructure</td>
<td align="center"><input type="checkbox" name="field106a" value="checked" <? echo $objResult["field106a"];?>
 onclick="signature(this.form, 'field106b', 'field106_hold', 'field106_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field106b" SIZE=40 value="<?=$objResult["field106b"];?>" 
onChange="signature(this.form, 'field106b', 'field106_hold', 'field106_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field106_hold" value="<?=$objResult["field106_sig"];?>">
<input type="text" name="field106_sig" size="15" value="<?=$objResult["field106_sig"];?>" 
onChange="not_allowed(this.form, 'field106_hold', 'field106_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Isolators on pad eye</td>
<td align="center"><input type="checkbox" name="field107a" value="checked" <? echo $objResult["field107a"];?>
 onclick="signature(this.form, 'field107b', 'field107_hold', 'field107_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field107b" SIZE=40 value="<?=$objResult["field107b"];?>" 
onChange="signature(this.form, 'field107b', 'field107_hold', 'field107_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field107_hold" value="<?=$objResult["field107_sig"];?>">
<input type="text" name="field107_sig" size="15" value="<?=$objResult["field107_sig"];?>" 
onChange="not_allowed(this.form, 'field107_hold', 'field107_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">DELRIN Isolators in Place</td>
<td align="center"><input type="checkbox" name="field80a" value="checked" <? echo $objResult["field80a"];?>
 onclick="signature(this.form, 'field80b', 'field80_hold', 'field80_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field80b" SIZE=40 value="<?=$objResult["field80b"];?>" 
onChange="signature(this.form, 'field80b', 'field80_hold', 'field80_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field80_hold" value="<?=$objResult["field80_sig"];?>">
<input type="text" name="field80_sig" size="15" value="<?=$objResult["field80_sig"];?>" 
onChange="not_allowed(this.form, 'field80_hold', 'field80_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Zincs in Place</td>
<td align="center"><input type="checkbox" name="field81a" value="checked" <? echo $objResult["field81a"];?>
 onclick="signature(this.form, 'field81b', 'field81_hold', 'field81_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field81b" SIZE=40 value="<?=$objResult["field81b"];?>" 
onChange="signature(this.form, 'field81b', 'field81_hold', 'field81_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field81_hold" value="<?=$objResult["field81_sig"];?>">
<input type="text" name="field81_sig" size="15" value="<?=$objResult["field81_sig"];?>" 
onChange="not_allowed(this.form, 'field81_hold', 'field81_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Through rods tight</td>
<td align="center"><input type="checkbox" name="field108a" value="checked" <? echo $objResult["field108a"];?>
 onclick="signature(this.form, 'field108b', 'field108_hold', 'field108_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field108b" SIZE=40 value="<?=$objResult["field108b"];?>" 
onChange="signature(this.form, 'field108b', 'field108_hold', 'field108_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field108_hold" value="<?=$objResult["field108_sig"];?>">
<input type="text" name="field108_sig" size="15" value="<?=$objResult["field108_sig"];?>" 
onChange="not_allowed(this.form, 'field108_hold', 'field108_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Check All NUTS and Bolts</td>
<td align="center"><input type="checkbox" name="field82a" value="checked" <? echo $objResult["field82a"];?>
 onclick="signature(this.form, 'field82b', 'field82_hold', 'field82_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field82b" SIZE=40 value="<?=$objResult["field82b"];?>" 
onChange="signature(this.form, 'field82b', 'field82_hold', 'field82_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field82_hold" value="<?=$objResult["field82_sig"];?>">
<input type="text" name="field82_sig" size="15" value="<?=$objResult["field82_sig"];?>" 
onChange="not_allowed(this.form, 'field82_hold', 'field82_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Loose Cables secured</td>
<td align="center"><input type="checkbox" name="field83a" value="checked" <? echo $objResult["field83a"];?>
 onclick="signature(this.form, 'field83b', 'field83_hold', 'field83_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field83b" SIZE=40 value="<?=$objResult["field83b"];?>" 
onChange="signature(this.form, 'field83b', 'field83_hold', 'field83_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field83_hold" value="<?=$objResult["field83_sig"];?>">
<input type="text" name="field83_sig" size="15" value="<?=$objResult["field83_sig"];?>" 
onChange="not_allowed(this.form, 'field83_hold', 'field83_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Wrap Exposed Cables</td>
<td align="center"><input type="checkbox" name="field84a" value="checked" <? echo $objResult["field84a"];?>
 onclick="signature(this.form, 'field84b', 'field84_hold', 'field84_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field84b" SIZE=40 value="<?=$objResult["field84b"];?>" 
onChange="signature(this.form, 'field84b', 'field84_hold', 'field84_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field84_hold" value="<?=$objResult["field84_sig"];?>">
<input type="text" name="field84_sig" size="15" value="<?=$objResult["field84_sig"];?>" 
onChange="not_allowed(this.form, 'field84_hold', 'field84_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Locking Sleeves in Place</td>
<td align="center"><input type="checkbox" name="field85a" value="checked" <? echo $objResult["field85a"];?>
 onclick="signature(this.form, 'field85b', 'field85_hold', 'field85_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field85b" SIZE=40 value="<?=$objResult["field85b"];?>" 
onChange="signature(this.form, 'field85b', 'field85_hold', 'field85_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field85_hold" value="<?=$objResult["field85_sig"];?>">
<input type="text" name="field85_sig" size="15" value="<?=$objResult["field85_sig"];?>" 
onChange="not_allowed(this.form, 'field85_hold', 'field85_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Dummy Plugs in Place</td>
<td align="center"><input type="checkbox" name="field86a" value="checked" <? echo $objResult["field86a"];?>
 onclick="signature(this.form, 'field86b', 'field86_hold', 'field86_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field86b" SIZE=40 value="<?=$objResult["field86b"];?>" 
onChange="signature(this.form, 'field86b', 'field86_hold', 'field86_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field86_hold" value="<?=$objResult["field86_sig"];?>">
<input type="text" name="field86_sig" size="15" value="<?=$objResult["field86_sig"];?>" 
onChange="not_allowed(this.form, 'field86_hold', 'field86_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Fresh Dessicant Installed</td>
<td align="center"><input type="checkbox" name="field87a" value="checked" <? echo $objResult["field87a"];?>
 onclick="signature(this.form, 'field87b', 'field87_hold', 'field87_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field87b" SIZE=40 value="<?=$objResult["field87b"];?>" 
onChange="signature(this.form, 'field87b', 'field87_hold', 'field87_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field87_hold" value="<?=$objResult["field87_sig"];?>">
<input type="text" name="field87_sig" size="15" value="<?=$objResult["field87_sig"];?>" 
onChange="not_allowed(this.form, 'field87_hold', 'field87_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Hatch Secured</td>
<td align="center"><input type="checkbox" name="field88a" value="checked" <? echo $objResult["field88a"];?>
 onclick="signature(this.form, 'field88b', 'field88_hold', 'field88_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field88b" SIZE=40 value="<?=$objResult["field88b"];?>" 
onChange="signature(this.form, 'field88b', 'field88_hold', 'field88_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field88_hold" value="<?=$objResult["field88_sig"];?>">
<input type="text" name="field88_sig" size="15" value="<?=$objResult["field88_sig"];?>" 
onChange="not_allowed(this.form, 'field88_hold', 'field88_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Vent Valves Checked</td>
<td align="center"><input type="checkbox" name="field89a" value="checked" <? echo $objResult["field89a"];?>
 onclick="signature(this.form, 'field89b', 'field89_hold', 'field89_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field89b" SIZE=40 value="<?=$objResult["field89b"];?>" 
onChange="signature(this.form, 'field89b', 'field89_hold', 'field89_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field89_hold" value="<?=$objResult["field89_sig"];?>">
<input type="text" name="field89_sig" size="15" value="<?=$objResult["field89_sig"];?>" 
onChange="not_allowed(this.form, 'field89_hold', 'field89_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Flashing Light Tested</td>
<td align="center"><input type="checkbox" name="field90a" value="checked" <? echo $objResult["field90a"];?>
 onclick="signature(this.form, 'field90b', 'field90_hold', 'field90_sig')"></TD>
 
<TD><INPUT TYPE=TEXT NAME="field90b" SIZE=40 value="<?=$objResult["field90b"];?>" 
onChange="signature(this.form, 'field90b', 'field90_hold', 'field90_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field90_hold" value="<?=$objResult["field90_sig"];?>">
<input type="text" name="field90_sig" size="15" value="<?=$objResult["field90_sig"];?>" 
onChange="not_allowed(this.form, 'field90_hold', 'field90_sig')"></td></tr>







</table>


























<br><br>


<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">



<br>
<b>Comments/Notes:</b>
<br>
<textarea name="Comments" rows="10" cols="97"><?php echo $objResult["Comments"];?></textarea><br>

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
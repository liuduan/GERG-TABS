<?php
include ("../Deployment/authorization.php");
?>

<html>
<head>
<link rel="stylesheet" href = "./record_style.css" type="text/css" />
<style type="text/css">
<!--

-->
</style>
<title>TABS I Setup and Testing</title>
</head>
<body bgcolor="c0c8d6">
<center><h3 class="TITLE-STYLE">TABS I Setup and Test</h3></center>

<h4 class="STYLE4">
<center>
<form action="TABSI_edit3.php?checkout=<?=$_GET["checkout"]; ?>" name="frmEdit" method="post">
<input type="submit" name="submit" value="Submit & Back"><br><br>

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
<b>

<DIV id = "tool-bar"> 
  <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href='http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php'> Deployment History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
  <a href="../Deployment/CAS-logout">NetID Logout</a>
</div>


<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF">
<td align="right"><b>Checkout: </td><td>	<?php echo $objResult["checkout"];?></td>
<td align="right"><b>Lead Technician: </td><td><input type="text" name="technician" size="20" value="<?=$objResult["technician"];?>"> </td>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right"><b>System S/N:</td><td> 	<input type="text" name="field3" size="20" value="<?=$objResult["field3"];?>"></td>
<td align="right"><b>Start Date:</td><td><input type="text" name="field4" size="20" value="<?=$objResult["field4"];?>"></br></td></tr>
<tr BGCOLOR="#FFFFCC"><td align="right"><b>Current Sensor Model/S/N: </td><td>
				<input type="text" name="field5" size="20" value="<?=$objResult["field5"];?>"></td>
<td align="right"><b>MicroCat S/N:</td><td><input type="text" name="field6" size="20" value="<?=$objResult["field6"];?>"></br></td>
<tr BGCOLOR="#FFFFCC"><td align="right"><b>PTT ID#/SN:</td><td><input type="text" name="field7" size="20" value="<?=$objResult["field7"];?>">&nbsp;&nbsp;&nbsp; </td>
<td align="right"><b>Firmware version:</td><td><input type="text" name="field8" size="20" value="<?=$objResult["field8"];?>"></br></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right"><b>Modem Type:</td><td><input type="text" name="field9" size="20" value="<?=$objResult["field9"];?>">&nbsp;&nbsp;&nbsp;</td>
<td align="right"><b>Sat Link:</td><td><input type="text" name="field10" size="20" value="<?=$objResult["field10"];?>"></br></td></tr>
<tr BGCOLOR="#FFFFCC"><td align="right"><b>Hull S/N:</td><td><input type="text" name="field11" size="20" value="<?=$objResult["field11"];?>">&nbsp;&nbsp;&nbsp;</td>
<td align="right"><b>Phone Number/ESN:</td><td><input type="text" name="field12" size="20" value="<?=$objResult["field12"];?>"></br></td></tr>

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




<b>Parameters: </b>
<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><TH><b>(No SatLink)<br>RSM/SeaPac Battery Vltages</b></td><TH><b>Nominal<br>Value</b></td>
<TH><br><b>Setting/Value</b></td><TH></br><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">Vin - TP15</td><td align="center">10 V</td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field14" SIZE=15 value="<?=$objResult["field14"];?>" 
onChange="signature(this.form, 'field14', 'field14_hold', 'field14_sig')">
</TD>


<TD align="right"><INPUT TYPE=HIDDEN NAME="field14_hold" value="<?=$objResult["field14_sig"];?>">
<input type="text" name="field14_sig" size="15" value="<?=$objResult["field14_sig"];?>" 
onChange="not_allowed(this.form, 'field14_hold', 'field14_sig')" align="right"/>&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">12Vdc - TP14</td><td align="center">10 V</td>
<TD><INPUT TYPE=TEXT NAME="field16" SIZE=15 value="<?=$objResult["field16"];?>" 
onChange="signature(this.form, 'field16', 'field16_hold', 'field16_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field16_hold" value="<?=$objResult["field16_sig"];?>">
<input type="text" name="field16_sig" size="15" value="<?=$objResult["field16_sig"];?>" 
onChange="not_allowed(this.form, 'field16_hold', 'field16_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Vsys - TP13</td><td align="center">10 V</td>
<TD><INPUT TYPE=TEXT NAME="field18" SIZE=15 value="<?=$objResult["field18"];?>" 
onChange="signature(this.form, 'field18', 'field18_hold', 'field18_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field18_hold" value="<?=$objResult["field18_sig"];?>">
<input type="text" name="field18_sig" size="15" value="<?=$objResult["field18_sig"];?>" 
onChange="not_allowed(this.form, 'field18_hold', 'field18_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Current Draw across R37</td><td align="center">5-10 mA</td>
<TD><INPUT TYPE=TEXT NAME="field20" SIZE=15 value="<?=$objResult["field20"];?>" 
onChange="signature(this.form, 'field20', 'field20_hold', 'field20_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field20_hold" value="<?=$objResult["field20_sig"];?>">
<input type="text" name="field20_sig" size="15" value="<?=$objResult["field20_sig"];?>" 
onChange="not_allowed(this.form, 'field20_hold', 'field20_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Vbatt - TP4</td><td align="center">10 V</td>
<TD><INPUT TYPE=TEXT NAME="field22" SIZE=15 value="<?=$objResult["field22"];?>" 
onChange="signature(this.form, 'field22', 'field22_hold', 'field22_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field22_hold" value="<?=$objResult["field22_sig"];?>">
<input type="text" name="field22_sig" size="15" value="<?=$objResult["field22_sig"];?>" 
onChange="not_allowed(this.form, 'field22_hold', 'field22_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Vcc - TP5</td><td align="center">5 V</td>
<TD><INPUT TYPE=TEXT NAME="field24" SIZE=15 value="<?=$objResult["field24"];?>" 
onChange="signature(this.form, 'field24', 'field24_hold', 'field24_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field24_hold" value="<?=$objResult["field24_sig"];?>">
<input type="text" name="field24_sig" size="15" value="<?=$objResult["field24_sig"];?>" 
onChange="not_allowed(this.form, 'field24_hold', 'field24_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Button Battery under Daughterboard</td><td align="center">3.0 V</td>
<TD><INPUT TYPE=TEXT NAME="field26" SIZE=15 value="<?=$objResult["field26"];?>" 
onChange="signature(this.form, 'field26', 'field26_hold', 'field26_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field26_hold" value="<?=$objResult["field26_sig"];?>">
<input type="text" name="field26_sig" size="15" value="<?=$objResult["field26_sig"];?>" 
onChange="not_allowed(this.form, 'field26_hold', 'field26_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Clock Battery</td><td align="center">3.6 V</td>
<TD><INPUT TYPE=TEXT NAME="field28" SIZE=15 value="<?=$objResult["field28"];?>" 
onChange="signature(this.form, 'field28', 'field28_hold', 'field28_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field28_hold" value="<?=$objResult["field28_sig"];?>">
<input type="text" name="field28_sig" size="15" value="<?=$objResult["field28_sig"];?>" 
onChange="not_allowed(this.form, 'field28_hold', 'field28_sig')">&nbsp;&nbsp;&nbsp;</td></tr>




<tr BGCOLOR="#99CCFF"><th><br><b>(No SatLink)<br>Daughterboard Measurements </b></td></tr>
<tr BGCOLOR="#FFFFCC"><td align="right">Vbatt - TP6</td><td align="center">10 V</td>
<TD><INPUT TYPE=TEXT NAME="field30" SIZE=15 value="<?=$objResult["field30"];?>" 
onChange="signature(this.form, 'field30', 'field30_hold', 'field30_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field30_hold" value="<?=$objResult["field30_sig"];?>">
<input type="text" name="field30_sig" size="15" value="<?=$objResult["field30_sig"];?>" 
onChange="not_allowed(this.form, 'field30_hold', 'field30_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">+12V TP5 - TP4 (jumped)</td><td align="center">10 V</td>
<TD><INPUT TYPE=TEXT NAME="field32" SIZE=15 value="<?=$objResult["field32"];?>" 
onChange="signature(this.form, 'field32', 'field32_hold', 'field32_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field32_hold" value="<?=$objResult["field32_sig"];?>">
<input type="text" name="field32_sig" size="15" value="<?=$objResult["field32_sig"];?>" 
onChange="not_allowed(this.form, 'field32_hold', 'field32_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Vcc - TP3</td><td align="center">5 V</td>
<TD><INPUT TYPE=TEXT NAME="field34" SIZE=15 value="<?=$objResult["field34"];?>" 
onChange="signature(this.form, 'field34', 'field34_hold', 'field34_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field34_hold" value="<?=$objResult["field34_sig"];?>">
<input type="text" name="field34_sig" size="15" value="<?=$objResult["field34_sig"];?>" 
onChange="not_allowed(this.form, 'field34_hold', 'field34_sig')">&nbsp;&nbsp;&nbsp;</td></tr>
</table>








<br>





<p><br>
<table border="1">

<tr BGCOLOR="#99CCFF"><th><b>(SatLink connected)<br>RSM/SeaPac Battery Vltages</b></td><th><b>Nominal<br>Value</b></td><th></br><b>Setting/Value</b></td><th></br><b>NetID</b></td></tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">Vin - TP15</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field36" SIZE=20 value="<?=$objResult["field36"];?>" 
onChange="signature(this.form, 'field36', 'field36_hold', 'field36_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field36_hold" value="<?=$objResult["field36_sig"];?>">
<input type="text" name="field36_sig" size="15" value="<?=$objResult["field36_sig"];?>" 
onChange="not_allowed(this.form, 'field36_hold', 'field36_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">12Vdc - TP14</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field38" SIZE=20 value="<?=$objResult["field38"];?>" 
onChange="signature(this.form, 'field38', 'field38_hold', 'field38_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field38_hold" value="<?=$objResult["field38_sig"];?>">
<input type="text" name="field38_sig" size="15" value="<?=$objResult["field38_sig"];?>" 
onChange="not_allowed(this.form, 'field38_hold', 'field38_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Vsys - TP13</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field40" SIZE=20 value="<?=$objResult["field40"];?>" 
onChange="signature(this.form, 'field40', 'field40_hold', 'field40_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field40_hold" value="<?=$objResult["field40_sig"];?>">
<input type="text" name="field40_sig" size="15" value="<?=$objResult["field40_sig"];?>" 
onChange="not_allowed(this.form, 'field40_hold', 'field40_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Current Draw across R37</td><td align="center">10-15 mA</td>
<TD><INPUT TYPE=TEXT NAME="field42" SIZE=20 value="<?=$objResult["field42"];?>" 
onChange="signature(this.form, 'field42', 'field42_hold', 'field42_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field42_hold" value="<?=$objResult["field42_sig"];?>">
<input type="text" name="field42_sig" size="15" value="<?=$objResult["field42_sig"];?>" 
onChange="not_allowed(this.form, 'field42_hold', 'field42_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Vbatt - TP4</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field44" SIZE=20 value="<?=$objResult["field44"];?>" 
onChange="signature(this.form, 'field44', 'field44_hold', 'field44_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field44_hold" value="<?=$objResult["field44_sig"];?>">
<input type="text" name="field44_sig" size="15" value="<?=$objResult["field44_sig"];?>" 
onChange="not_allowed(this.form, 'field44_hold', 'field44_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Vcc - TP5</td><td align="center">5 V</td>
<TD><INPUT TYPE=TEXT NAME="field46" SIZE=20 value="<?=$objResult["field46"];?>" 
onChange="signature(this.form, 'field46', 'field46_hold', 'field46_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field46_hold" value="<?=$objResult["field46_sig"];?>">
<input type="text" name="field46_sig" size="15" value="<?=$objResult["field46_sig"];?>" 
onChange="not_allowed(this.form, 'field46_hold', 'field46_sig')">&nbsp;&nbsp;&nbsp;</td></tr>



<tr BGCOLOR="#99CCFF"><th><br><b>(SatLink connected)<br>Daughterboard Measurements </b></td></tr>
<tr BGCOLOR="#FFFFCC"><td align="right">Vbatt - TP6</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field48" SIZE=20 value="<?=$objResult["field48"];?>" 
onChange="signature(this.form, 'field48', 'field48_hold', 'field48_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field48_hold" value="<?=$objResult["field48_sig"];?>">
<input type="text" name="field48_sig" size="15" value="<?=$objResult["field48_sig"];?>" 
onChange="not_allowed(this.form, 'field48_hold', 'field48_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">+12V TP5 - TP4 (jumped)</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field50" SIZE=20 value="<?=$objResult["field50"];?>" 
onChange="signature(this.form, 'field50', 'field50_hold', 'field50_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field50_hold" value="<?=$objResult["field50_sig"];?>">
<input type="text" name="field50_sig" size="15" value="<?=$objResult["field50_sig"];?>" 
onChange="not_allowed(this.form, 'field50_hold', 'field50_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Vcc - TP3</td><td align="center">5 V</td>
<TD><INPUT TYPE=TEXT NAME="field52" SIZE=20 value="<?=$objResult["field52"];?>" 
onChange="signature(this.form, 'field52', 'field52_hold', 'field52_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field52_hold" value="<?=$objResult["field52_sig"];?>">
<input type="text" name="field52_sig" size="15" value="<?=$objResult["field52_sig"];?>" 
onChange="not_allowed(this.form, 'field52_hold', 'field52_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

</table>






<p><br>
<table border="1">

<tr BGCOLOR="#99CCFF"><th><b>(Not connected to charger)<br>SatLink Measurements</b></td><th><b>Nominal<br>Value</b></td><th></br><b>Setting/Value</b></td><th></br><b>NetID</b></td></tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">Battery 1</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field54" SIZE=20 value="<?=$objResult["field54"];?>" 
onChange="signature(this.form, 'field54', 'field54_hold', 'field54_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field54_hold" value="<?=$objResult["field54_sig"];?>">
<input type="text" name="field54_sig" size="15" value="<?=$objResult["field54_sig"];?>" 
onChange="not_allowed(this.form, 'field54_hold', 'field54_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Battery 2</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field56" SIZE=20 value="<?=$objResult["field56"];?>" 
onChange="signature(this.form, 'field56', 'field56_hold', 'field56_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field56_hold" value="<?=$objResult["field56_sig"];?>">
<input type="text" name="field56_sig" size="15" value="<?=$objResult["field56_sig"];?>" 
onChange="not_allowed(this.form, 'field56_hold', 'field56_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Voltage across the fuse to ground</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field58" SIZE=20 value="<?=$objResult["field58"];?>" 
onChange="signature(this.form, 'field58', 'field58_hold', 'field58_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field58_hold" value="<?=$objResult["field58_sig"];?>">
<input type="text" name="field58_sig" size="15" value="<?=$objResult["field58_sig"];?>" 
onChange="not_allowed(this.form, 'field58_hold', 'field58_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">PTT Voltage</td><td align="center">12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field60" SIZE=20 value="<?=$objResult["field60"];?>" 
onChange="signature(this.form, 'field60', 'field60_hold', 'field60_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field60_hold" value="<?=$objResult["field60_sig"];?>">
<input type="text" name="field60_sig" size="15" value="<?=$objResult["field60_sig"];?>" 
onChange="not_allowed(this.form, 'field60_hold', 'field60_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

</table>

<br><b>(Connected to solar panels through top plate)<br>SatLink Measurement</b>
<br>With solar panels in sunlight check that the regulator indicates charging.
<table border="1">

<tr BGCOLOR="#99CCFF"><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><th><b>Nominal<br>Value</b></td><th></br><b>Setting/Value</b></td><th></br><b>NetID</b></td></tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">Output from solar panels going into regulator: </td><td align="center">18 V</td>
<TD><INPUT TYPE=TEXT NAME="field62" SIZE=20 value="<?=$objResult["field62"];?>" 
onChange="signature(this.form, 'field62', 'field62_hold', 'field62_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field62_hold" value="<?=$objResult["field62_sig"];?>">
<input type="text" name="field62_sig" size="15" value="<?=$objResult["field62_sig"];?>" 
onChange="not_allowed(this.form, 'field62_hold', 'field62_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Regulator Output</td><td align="center">13.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field64" SIZE=20 value="<?=$objResult["field64"];?>" 
onChange="signature(this.form, 'field64', 'field64_hold', 'field64_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field64_hold" value="<?=$objResult["field64_sig"];?>">
<input type="text" name="field64_sig" size="15" value="<?=$objResult["field64_sig"];?>" 
onChange="not_allowed(this.form, 'field64_hold', 'field64_sig')">&nbsp;&nbsp;&nbsp;</td></tr>
</table>

<br><br>


<b>Comments:</b>
<br>
<textarea name="field66" rows="10" cols="80"><?php echo $objResult["field66"];?></textarea>
<input type="submit" name="submit" value="Submit & Back">

<?php
}
mysql_close($objConnect);
?>













<?php 

# include 2nd part of the page.
include './TABSI2/TABSI2_edit2.php'; 

# include 3rd part of the page.
include './TABSI3/TABSI3_edit2.php'; 

?>


</form>







</html>
<!--- This file download from www.shotdev.com -->
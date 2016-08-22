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
<title>TABS II Setup and Testing</title>
</head>
<body bgcolor="c0c8d6">
<center><h3 class="TITLE-STYLE">TABS II Setup and Test</h3></center>

<h4 class="STYLE4">
<center>
<form action="./TABSII_edit3.php?checkout=<?=$_GET["checkout"]; ?>" name="frmEdit" method="post">
<input type="submit" name="submit" value="Submit & Back"><br><br>

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
<b>

<DIV id = "tool-bar"> 
<a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php'> Deployment History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a>
</div>


<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF">
<td align="right"><b>Checkout: </td><td><?php echo $objResult["checkout"];?></td>
<td align="right"><b>Lead Technician: </td>
<td><input type="text" name="Technicians" size="20" value="<?=$objResult["Technicians"];?>"> </td>
</tr>

<tr BGCOLOR="#FFFFCC"><td align="right">
<b>System S/N:</td>
<td><input type="text" name="system_SN" size="20" value="<?=$objResult["system_SN"];?>"></td>
<td align="right"><b>Start Date:</td>
<td><input type="text" name="start_date" size="20" value="<?=$objResult["start_date"];?>"></br></td>
</tr>


<tr BGCOLOR="#FFFFCC">
<td align="right">
<b>Hull S/N:</td><td><input type="text" name="Software" size="20" value="<?=$objResult["Hull"];?>"></br></td>

<td align="right"><b>Planned Deployment Site:</td>
<td><input type="text" name="Site" size="20" value="<?=$objResult["Site"];?>"></br></td>
</tr>

<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Current Sensor Model/S/N: </td>
<td><input type="text" name="current_sensor" size="20" value="<?=$objResult["current_sensor"];?>"></td>
                
<td align="right"><b>PTT ID:</td>
<td><input type="text" name="PTT_ID" size="20" value="<?=$objResult["PTT_ID"];?>">&nbsp;&nbsp;&nbsp; </td>


<tr BGCOLOR="#FFFFCC"><td align="right"><b>Modem ESN(HEX):</td>
<td><input type="text" name="Modem_ESN" size="20" value="<?=$objResult["Modem_ESN"];?>">&nbsp;</td>

<td align="right"><b>PTT SN:</td>
<td><input type="text" name="PTT_SN" size="20" value="<?=$objResult["PTT_SN"];?>">&nbsp;&nbsp;&nbsp; </td>
</tr>


<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Phone Number:</td>
<td><input type="text" name="Phone" size="20" value="<?=$objResult["Phone"];?>"></br></td></tr>






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
<tr BGCOLOR="#99CCFF"><TH>Sensor</td><TH>Serial Number</b></td><TH><b>Model</b></td>
<TH><br><b>Range</b></td><TH></br><b>Port#</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">Anemometer: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field11" SIZE=15 value="<?=$objResult["field11"];?>" ></TD>
<td align="center">Windsonic</td><td align="center">0 - 60 m/s</td><td align="center">EMM 8</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Temperature & Humidity: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field12" SIZE=15 value="<?=$objResult["field12"];?>" ></TD>
<td align="center">MP101A</td><td align="center">-30/+70 degrees 0, 0 - 100% </td><td align="center">T5-7, T5-9</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Pressure Transmitter: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field13" SIZE=15 value="<?=$objResult["field13"];?>" ></TD>
<td align="center">PTB210</td><td align="center">500 - 1100 hPa</td><td align="center">EMM 7</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Compass: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field14" SIZE=15 value="<?=$objResult["field14"];?>" ></TD>
<td align="center">HMR3300</td><td align="center">0 - 360 degree Magnetic</td><td align="center">Com4</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Conductivity: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field15" SIZE=15 value="<?=$objResult["field15"];?>" ></TD>
<td align="center"><INPUT align="center" TYPE=TEXT NAME="field15b" SIZE=15 
value='<?php echo $objResult["field15b"]; if ($objResult["field15b"] == "") echo "3919"; ?>'></td>
<td align="center">0 - 75 mmho/cm</td><td align="center">EMM 3</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">LSS Sensor: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field16" SIZE=15 value="<?=$objResult["field16"];?>" ></TD>
<td align="center"><INPUT align="center" TYPE=TEXT NAME="field16b" SIZE=15 value="<?=$objResult["field16b"];?>" ></td>
<td align="center">&nbsp;</td><td align="center">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Current Sensor: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field17" SIZE=15 value="<?=$objResult["field17"];?>" ></TD>
<td align="center"><INPUT align="center" TYPE=TEXT NAME="field17b" SIZE=15 value="<?=$objResult["field17b"];?>" ></td>
<td align="center">0 - 350 cm/sec</td><td align="center">EMM 6</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">ADCP: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field18a" SIZE=15 value="<?=$objResult["field18a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field18b" SIZE=15 value="<?=$objResult["field18b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field18c" SIZE=15 value="<?=$objResult["field18c"];?>" ></TD>
<td align="center">EMM 1</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Modem: </td><TD align="center">See above</TD>
<td align="center"><INPUT align="center" TYPE=TEXT NAME="field18c" SIZE=15 
value="<?=$objResult["field18m"]; if ($objResult["field18m"]=='') echo 'GSP1620'; ?>" ></td>
<td align="center">NA</td><td align="center">EMM 5</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Argos: </td><TD align="center">See above</TD>
<td align="center"><INPUT align="center" TYPE=TEXT NAME="field18s" SIZE=15 
value="<?=$objResult["field18s"]; if ($objResult["field18s"]=='') echo 'Wildcat'; ?>" ></td>
<td align="center">NA</td><td align="center">EMM 2</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">GPS: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field19" SIZE=15 value="<?=$objResult["field19"];?>" ></TD>
<td align="center"><INPUT align="center" TYPE=TEXT NAME="field19b" SIZE=15 
value="<?php echo $objResult["field19b"]; if ($objResult["field19b"]=='') echo 'Garmin 16'; ?>" ></td>
<td align="center">NA</td><td align="center">EMM 4</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">LinkQuest Modem: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field20a" SIZE=15 value="<?=$objResult["field20a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field20b" SIZE=15 value="<?=$objResult["field20b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field20c" SIZE=15 value="<?=$objResult["field20c"];?>" ></TD>
<td align="center">EMM 1</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">System Monitor Port: </td><TD align="center">NA</TD>
<td align="center">NA</td><td align="center">&nbsp;</td><td align="center">Com 2</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Spare: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field21a" SIZE=15 value="<?=$objResult["field21a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field21b" SIZE=15 value="<?=$objResult["field21b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field21c" SIZE=15 value="<?=$objResult["field21c"];?>" ></TD>
<td align="center">Com 1</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Spare: </td>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field22a" SIZE=15 value="<?=$objResult["field22a"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field22b" SIZE=15 value="<?=$objResult["field22b"];?>" ></TD>
<TD align="center"><INPUT align="center" TYPE=TEXT NAME="field22c" SIZE=15 value="<?=$objResult["field22c"];?>" ></TD>
<td align="center">Com 3</td></tr>

</table>








<br>
<p><br>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   </b>
<input type="submit" name="submit" value="Submit & Back"><br>

<table border="1">
<tr BGCOLOR="#99CCFF"><th align="center" colspan="4" ><b>Battery Test</b></td></tr>
<tr BGCOLOR="#FFFFCC"><td align="right">Installation Date</td>

<TD><INPUT TYPE=TEXT NAME="Battery" SIZE=20 value="<?=$objResult["Battery"];?>" 
onChange="signature(this.form, 'Battery', 'Battery_hold', 'Battery_sig')"></TD>
<!-- Battery_hold is for Battery_sig, other _hold is similar -->

<td align="right">Battery Type</td>

<TD><INPUT TYPE=TEXT NAME="Battery_type" SIZE=15 value="<?=$objResult["Battery_type"];?>" 
onChange="signature(this.form, 'Battery_type', 'Battery_hold', 'Battery_sig')"></TD></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Battery Manufacture</td>

<TD><INPUT TYPE=TEXT NAME="Battery_manu" SIZE=20 value="<?=$objResult["Battery_manu"];?>" 
onChange="signature(this.form, 'Battery_manu', 'Battery_hold', 'Battery_sig')"></TD>


<Td align="right">NetID: </td>
<TD><INPUT TYPE=HIDDEN NAME="Battery_hold" value="<?=$objResult["Battery_sig"];?>">
<input type="text" name="Battery_sig" size="15" value="<?=$objResult["Battery_sig"];?>" 
onChange="not_allowed(this.form, 'Battery_hold', 'Battery_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#99CCFF">
<th align="left" colspan="4" ><b>Battery voltages after 12 hrs charging and 1 hr rest (fuses removed).</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>&nbsp;</th><th>Open Loop</th><th>100 Ohm</th><th>NetID</th></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">B1-Argos</td>
<td align="center"><INPUT TYPE=TEXT NAME="field23a" SIZE=20 value="<?=$objResult["field23a"];?>" 
onChange="signature(this.form, 'field23a', 'field23_hold', 'field23_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field23b" SIZE=20 value="<?=$objResult["field23b"];?>" 
onChange="signature(this.form, 'field23b', 'field23_hold', 'field23_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field23_hold" value="<?=$objResult["field23_sig"];?>">
<input type="text" name="field23_sig" size="15" value="<?=$objResult["field23_sig"];?>" 
onChange="not_allowed(this.form, 'field23_hold', 'field23_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B2-Argos</td>
<td align="center"><INPUT TYPE=TEXT NAME="field24a" SIZE=20 value="<?=$objResult["field24a"];?>" 
onChange="signature(this.form, 'field24a', 'field24_hold', 'field24_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field24b" SIZE=20 value="<?=$objResult["field24b"];?>" 
onChange="signature(this.form, 'field24b', 'field24_hold', 'field24_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field24_hold" value="<?=$objResult["field24_sig"];?>">
<input type="text" name="field24_sig" size="15" value="<?=$objResult["field24_sig"];?>" 
onChange="not_allowed(this.form, 'field24_hold', 'field24_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B1-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field25a" SIZE=20 value="<?=$objResult["field25a"];?>" 
onChange="signature(this.form, 'field25a', 'field25_hold', 'field25_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field25b" SIZE=20 value="<?=$objResult["field25b"];?>" 
onChange="signature(this.form, 'field25b', 'field25_hold', 'field25_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field25_hold" value="<?=$objResult["field25_sig"];?>">
<input type="text" name="field25_sig" size="15" value="<?=$objResult["field25_sig"];?>" 
onChange="not_allowed(this.form, 'field25_hold', 'field25_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B2-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field26a" SIZE=20 value="<?=$objResult["field26a"];?>" 
onChange="signature(this.form, 'field26a', 'field26_hold', 'field26_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field26b" SIZE=20 value="<?=$objResult["field26b"];?>" 
onChange="signature(this.form, 'field26b', 'field26_hold', 'field26_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field26_hold" value="<?=$objResult["field26_sig"];?>">
<input type="text" name="field26_sig" size="15" value="<?=$objResult["field26_sig"];?>" 
onChange="not_allowed(this.form, 'field26_hold', 'field26_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B3-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field27a" SIZE=20 value="<?=$objResult["field27a"];?>" 
onChange="signature(this.form, 'field27a', 'field27_hold', 'field27_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field27b" SIZE=20 value="<?=$objResult["field27b"];?>" 
onChange="signature(this.form, 'field27b', 'field27_hold', 'field27_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field27_hold" value="<?=$objResult["field27_sig"];?>">
<input type="text" name="field27_sig" size="15" value="<?=$objResult["field27_sig"];?>" 
onChange="not_allowed(this.form, 'field27_hold', 'field27_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B4-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field28a" SIZE=20 value="<?=$objResult["field28a"];?>" 
onChange="signature(this.form, 'field28a', 'field28_hold', 'field28_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field28b" SIZE=20 value="<?=$objResult["field28b"];?>" 
onChange="signature(this.form, 'field28b', 'field28_hold', 'field28_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field28_hold" value="<?=$objResult["field28_sig"];?>">
<input type="text" name="field28_sig" size="15" value="<?=$objResult["field28_sig"];?>" 
onChange="not_allowed(this.form, 'field28_hold', 'field28_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B5-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field29a" SIZE=20 value="<?=$objResult["field29a"];?>" 
onChange="signature(this.form, 'field29a', 'field29_hold', 'field29_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field29b" SIZE=20 value="<?=$objResult["field29b"];?>" 
onChange="signature(this.form, 'field29b', 'field29_hold', 'field29_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field29_hold" value="<?=$objResult["field29_sig"];?>">
<input type="text" name="field29_sig" size="15" value="<?=$objResult["field29_sig"];?>" 
onChange="not_allowed(this.form, 'field29_hold', 'field29_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B6-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field30a" SIZE=20 value="<?=$objResult["field30a"];?>" 
onChange="signature(this.form, 'field30a', 'field30_hold', 'field30_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field30b" SIZE=20 value="<?=$objResult["field30b"];?>" 
onChange="signature(this.form, 'field30b', 'field30_hold', 'field30_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field30_hold" value="<?=$objResult["field30_sig"];?>">
<input type="text" name="field30_sig" size="15" value="<?=$objResult["field30_sig"];?>" 
onChange="not_allowed(this.form, 'field30_hold', 'field30_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B7-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field31a" SIZE=20 value="<?=$objResult["field31a"];?>" 
onChange="signature(this.form, 'field31a', 'field31_hold', 'field31_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field31b" SIZE=20 value="<?=$objResult["field31b"];?>" 
onChange="signature(this.form, 'field31b', 'field31_hold', 'field31_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field31_hold" value="<?=$objResult["field31_sig"];?>">
<input type="text" name="field31_sig" size="15" value="<?=$objResult["field31_sig"];?>" 
onChange="not_allowed(this.form, 'field31_hold', 'field31_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B8-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="fiel32a" SIZE=20 value="<?=$objResult["field32a"];?>" 
onChange="signature(this.form, 'field32a', 'field32_hold', 'field32_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field32b" SIZE=20 value="<?=$objResult["field32b"];?>" 
onChange="signature(this.form, 'field32b', 'field32_hold', 'field32_sig')"></TD>

<TD><INPUT TYPE=HIDDEN NAME="field32_hold" value="<?=$objResult["field32_sig"];?>">
<input type="text" name="field32_sig" size="15" value="<?=$objResult["field32_sig"];?>" 
onChange="not_allowed(this.form, 'field32_hold', 'field32_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B9-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field33a" SIZE=20 value="<?=$objResult["field33a"];?>" 
onChange="signature(this.form, 'field33a', 'field33_hold', 'field33_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field33b" SIZE=20 value="<?=$objResult["field33b"];?>" 
onChange="signature(this.form, 'field33b', 'field33_hold', 'field33_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field33_hold" value="<?=$objResult["field33_sig"];?>">
<input type="text" name="field33_sig" size="15" value="<?=$objResult["field33_sig"];?>" 
onChange="not_allowed(this.form, 'field33_hold', 'field33_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B10-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field34a" SIZE=20 value="<?=$objResult["field34a"];?>" 
onChange="signature(this.form, 'field34a', 'field34_hold', 'field34_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field34b" SIZE=20 value="<?=$objResult["field34b"];?>" 
onChange="signature(this.form, 'field34b', 'field34_hold', 'field34_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field34_hold" value="<?=$objResult["field34_sig"];?>">
<input type="text" name="field34_sig" size="15" value="<?=$objResult["field34_sig"];?>" 
onChange="not_allowed(this.form, 'field34_hold', 'field34_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B11-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field35a" SIZE=20 value="<?=$objResult["field35a"];?>" 
onChange="signature(this.form, 'field35a', 'field35_hold', 'field35_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field35b" SIZE=20 value="<?=$objResult["field35b"];?>" 
onChange="signature(this.form, 'field35b', 'field35_hold', 'field35_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field35_hold" value="<?=$objResult["field35_sig"];?>">
<input type="text" name="field35_sig" size="15" value="<?=$objResult["field35_sig"];?>" 
onChange="not_allowed(this.form, 'field35_hold', 'field35_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B12-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field36a" SIZE=20 value="<?=$objResult["field36a"];?>" 
onChange="signature(this.form, 'field36a', 'field36_hold', 'field36_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field36b" SIZE=20 value="<?=$objResult["field36b"];?>" 
onChange="signature(this.form, 'field36b', 'field36_hold', 'field36_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field36_hold" value="<?=$objResult["field36_sig"];?>">
<input type="text" name="field36_sig" size="15" value="<?=$objResult["field36_sig"];?>" 
onChange="not_allowed(this.form, 'field36_hold', 'field36_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B13-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field37a" SIZE=20 value="<?=$objResult["field37a"];?>" 
onChange="signature(this.form, 'field37a', 'field37_hold', 'field37_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field37b" SIZE=20 value="<?=$objResult["field37b"];?>" 
onChange="signature(this.form, 'field37b', 'field37_hold', 'field37_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field37_hold" value="<?=$objResult["field37_sig"];?>">
<input type="text" name="field37_sig" size="15" value="<?=$objResult["field37_sig"];?>" 
onChange="not_allowed(this.form, 'field37_hold', 'field37_sig')">&nbsp;&nbsp;&nbsp;</td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">B14-Sys</td>
<td align="center"><INPUT TYPE=TEXT NAME="field38a" SIZE=20 value="<?=$objResult["field38a"];?>" 
onChange="signature(this.form, 'field38a', 'field38_hold', 'field38_sig')"></TD>
<td align="center"><INPUT TYPE=TEXT NAME="field38b" SIZE=20 value="<?=$objResult["field38b"];?>" 
onChange="signature(this.form, 'field38b', 'field38_hold', 'field38_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field38_hold" value="<?=$objResult["field38_sig"];?>">
<input type="text" name="field38_sig" size="15" value="<?=$objResult["field38_sig"];?>" 
onChange="not_allowed(this.form, 'field38_hold', 'field38_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

</table>






<p><br>
<table border="1">

<tr BGCOLOR="#99CCFF"><th><b>&nbsp;</b></td><th><b>Nominal<br>Value</b></td><th></br><b>Readout</b></td><th></br><b>NetID</b></td></tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">Solar Panel Voltage (in sunlight)</td><td align="center">18 V</td>
<TD><INPUT TYPE=TEXT NAME="field39" SIZE=20 value="<?=$objResult["field39"];?>" 
onChange="signature(this.form, 'field39', 'field39_hold', 'field39_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field39_hold" value="<?=$objResult["field39_sig"];?>">
<input type="text" name="field39_sig" size="15" value="<?=$objResult["field39_sig"];?>" 
onChange="not_allowed(this.form, 'field39_hold', 'field39_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Regulator Output (to charged batteries)</td><td align="center">13.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field40" SIZE=20 value="<?=$objResult["field40"];?>" 
onChange="signature(this.form, 'field40', 'field40_hold', 'field40_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field40_hold" value="<?=$objResult["field40_sig"];?>">
<input type="text" name="field40_sig" size="15" value="<?=$objResult["field40_sig"];?>" 
onChange="not_allowed(this.form, 'field40_hold', 'field40_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">System Batteries (average with fuses installed)</td><td align="center">13.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field41" SIZE=20 value="<?=$objResult["field41"];?>" 
onChange="signature(this.form, 'field41', 'field41_hold', 'field41_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field41_hold" value="<?=$objResult["field41_sig"];?>">
<input type="text" name="field41_sig" size="15" value="<?=$objResult["field41_sig"];?>" 
onChange="not_allowed(this.form, 'field41_hold', 'field41_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">ARGOS Batteries (average with fuses installed)</td><td align="center">13.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field42" SIZE=20 value="<?=$objResult["field42"];?>" 
onChange="signature(this.form, 'field42', 'field42_hold', 'field42_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field42_hold" value="<?=$objResult["field42_sig"];?>">
<input type="text" name="field42_sig" size="15" value="<?=$objResult["field42_sig"];?>" 
onChange="not_allowed(this.form, 'field42_hold', 'field42_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Voltage across PC104 main switch</td><td align="center">13.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field43" SIZE=20 value="<?=$objResult["field43"];?>" 
onChange="signature(this.form, 'field43', 'field43_hold', 'field43_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field43_hold" value="<?=$objResult["field43_sig"];?>">
<input type="text" name="field43_sig" size="15" value="<?=$objResult["field43_sig"];?>" 
onChange="not_allowed(this.form, 'field43_hold', 'field43_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">ADCP Power Supply Voltage</td><td align="center">54.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field44" SIZE=20 value="<?=$objResult["field44"];?>" 
onChange="signature(this.form, 'field44', 'field44_hold', 'field44_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field44_hold" value="<?=$objResult["field44_sig"];?>">
<input type="text" name="field44_sig" size="15" value="<?=$objResult["field44_sig"];?>" 
onChange="not_allowed(this.form, 'field44_hold', 'field44_sig')">&nbsp;</td></tr>

</table>

<br><br>


<b>Comments:</b>
<br>
<textarea name="comments" rows="10" cols="80"><?php echo $objResult["comments"];?></textarea><br><br><p>




<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">

<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>General System Tests</b></td><th><b>Nominal</b></td><th><b>Comments</b></td><th><b>NetID</b></td></tr></b>
<tr BGCOLOR="#FFFFCC"><td align="right">Operating Current (Sensors Running)</td><td align="center">~290 mA</td>
<TD><INPUT TYPE=TEXT NAME="field46" SIZE=20 value="<?=$objResult["field46"];?>" 
onChange="signature(this.form, 'field46', 'field46_hold', 'field46_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field46_hold" value="<?=$objResult["field46_sig"];?>">
<input type="text" name="field46_sig" size="15" value="<?=$objResult["field46_sig"];?>" 
onChange="not_allowed(this.form, 'field46_hold', 'field46_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Sleep Current (PC104 in Sleep Mode)</td><td align="center">~190 mA</td>
<TD><INPUT TYPE=TEXT NAME="field47" SIZE=20 value="<?=$objResult["field47"];?>" 
onChange="signature(this.form, 'field47', 'field47_hold', 'field47_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field47_hold" value="<?=$objResult["field47_sig"];?>">
<input type="text" name="field47_sig" size="15" value="<?=$objResult["field47_sig"];?>" 
onChange="not_allowed(this.form, 'field47_hold', 'field47_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Sensor Fuses checked</td><td align="center">Y</td>
<TD><INPUT TYPE=TEXT NAME="field48" SIZE=20 value="<?=$objResult["field48"];?>" 
onChange="signature(this.form, 'field48', 'field48_hold', 'field48_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field48_hold" value="<?=$objResult["field48_sig"];?>">
<input type="text" name="field48_sig" size="15" value="<?=$objResult["field48_sig"];?>" 
onChange="not_allowed(this.form, 'field48_hold', 'field48_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">LED Lights come on when sensors power on</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field49" SIZE=20 value="<?=$objResult["field49"];?>" 
onChange="signature(this.form, 'field49', 'field49_hold', 'field49_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field49_hold" value="<?=$objResult["field49_sig"];?>">
<input type="text" name="field49_sig" size="15" value="<?=$objResult["field49_sig"];?>" 
onChange="not_allowed(this.form, 'field49_hold', 'field49_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Check all connections on Sensor Interface Board</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field50" SIZE=20 value="<?=$objResult["field50"];?>" 
onChange="signature(this.form, 'field50', 'field50_hold', 'field50_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field50_hold" value="<?=$objResult["field50_sig"];?>">
<input type="text" name="field50_sig" size="15" value="<?=$objResult["field50_sig"];?>" 
onChange="not_allowed(this.form, 'field50_hold', 'field50_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Check Ribbon Cable connections</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field51" SIZE=20 value="<?=$objResult["field51"];?>" 
onChange="signature(this.form, 'field51', 'field51_hold', 'field51_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field51_hold" value="<?=$objResult["field51_sig"];?>">
<input type="text" name="field51_sig" size="15" value="<?=$objResult["field51_sig"];?>" 
onChange="not_allowed(this.form, 'field51_hold', 'field51_sig')">&nbsp;</td></tr>


<!--
<tr BGCOLOR="#FFFFCC"><td align="right">Check sencurity of VESPA computer and wires</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field52" SIZE=20 value="<?php # $objResult["field52"];?>" 
onChange="signature(this.form, 'field52', 'field52_hold', 'field52_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field52_hold" value="<?php # $objResult["field52_sig"];?>">
<input type="text" name="field52_sig" size="15" value="<?php # $objResult["field52_sig"];?>" 
onChange="not_allowed(this.form, 'field52_hold', 'field52_sig')">&nbsp;</td></tr>
-->

<tr BGCOLOR="#FFFFCC"><td align="right">Output Voltage to Sensors (Com 1 - Com 12)</td><td align="center">~12.5 V</td>
<TD><INPUT TYPE=TEXT NAME="field53" SIZE=20 value="<?=$objResult["field53"];?>" 
onChange="signature(this.form, 'field53', 'field53_hold', 'field53_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field53_hold" value="<?=$objResult["field53_sig"];?>">
<input type="text" name="field53_sig" size="15" value="<?=$objResult["field53_sig"];?>" 
onChange="not_allowed(this.form, 'field53_hold', 'field53_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">All sensors plugged in and tightened</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field54" SIZE=20 value="<?=$objResult["field54"];?>" 
onChange="signature(this.form, 'field54', 'field54_hold', 'field54_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field54_hold" value="<?=$objResult["field54_sig"];?>">
<input type="text" name="field54_sig" size="15" value="<?=$objResult["field54_sig"];?>" 
onChange="not_allowed(this.form, 'field54_hold', 'field54_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Dessicant installed in computer housing</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field55" SIZE=20 value="<?=$objResult["field55"];?>" 
onChange="signature(this.form, 'field55', 'field55_hold', 'field55_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field55_hold" value="<?=$objResult["field55_sig"];?>">
<input type="text" name="field55_sig" size="15" value="<?=$objResult["field55_sig"];?>" 
onChange="not_allowed(this.form, 'field55_hold', 'field55_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Dessicant installed in battery chamber</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field56" SIZE=20 value="<?=$objResult["field56"];?>" 
onChange="signature(this.form, 'field56', 'field56_hold', 'field56_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field56_hold" value="<?=$objResult["field56_sig"];?>">
<input type="text" name="field56_sig" size="15" value="<?=$objResult["field56_sig"];?>" 
onChange="not_allowed(this.form, 'field56_hold', 'field56_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Catylators installed in battery chamber</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field57" SIZE=20 value="<?=$objResult["field57"];?>" 
onChange="signature(this.form, 'field57', 'field57_hold', 'field57_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field57_hold" value="<?=$objResult["field57_sig"];?>">
<input type="text" name="field57_sig" size="15" value="<?=$objResult["field57_sig"];?>" 
onChange="not_allowed(this.form, 'field57_hold', 'field57_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">MET station installed</td><td align="center">&nbsp;</td>
<TD><INPUT TYPE=TEXT NAME="field58" SIZE=20 value="<?=$objResult["field58"];?>" 
onChange="signature(this.form, 'field58', 'field58_hold', 'field58_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field58_hold" value="<?=$objResult["field58_sig"];?>">
<input type="text" name="field58_sig" size="15" value="<?=$objResult["field58_sig"];?>" 
onChange="not_allowed(this.form, 'field58_hold', 'field58_sig')">&nbsp;</td></tr>

</table>

<br><br>









<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">

<table border="1">
<tr BGCOLOR="#99CCFF"><th><b>Vacuum Tests</b></td><th><b>Comments</b></td><th><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">Make sure inside bulkhead plate is secured in place</td>
<TD><INPUT TYPE=TEXT NAME="field59" SIZE=20 value="<?=$objResult["field59"];?>" 
onChange="signature(this.form, 'field59', 'field59_hold', 'field59_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field59_hold" value="<?=$objResult["field59_sig"];?>">
<input type="text" name="field59_sig" size="15" value="<?=$objResult["field59_sig"];?>" 
onChange="not_allowed(this.form, 'field59_hold', 'field59_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Close chassis & bolt in place making sure O-ring is greased</td>
<TD><INPUT TYPE=TEXT NAME="field60" SIZE=20 value="<?=$objResult["field60"];?>" 
onChange="signature(this.form, 'field60', 'field60_hold', 'field60_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field60_hold" value="<?=$objResult["field60_sig"];?>">
<input type="text" name="field60_sig" size="15" value="<?=$objResult["field60_sig"];?>" 
onChange="not_allowed(this.form, 'field60_hold', 'field60_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Install vacuum gauge on chassis plate</td>
<TD><INPUT TYPE=TEXT NAME="field61" SIZE=20 value="<?=$objResult["field61"];?>" 
onChange="signature(this.form, 'field61', 'field61_hold', 'field61_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field61_hold" value="<?=$objResult["field61_sig"];?>">
<input type="text" name="field61_sig" size="15" value="<?=$objResult["field61_sig"];?>" 
onChange="not_allowed(this.form, 'field61_hold', 'field61_sig')">&nbsp;</td></tr>



<tr BGCOLOR="#FFFFCC"><td align="right">Draw a 10 in Hg Vacuum and let sit 12 hrs</td>
<TD><INPUT TYPE=TEXT NAME="field62" SIZE=20 value="<?=$objResult["field62"];?>" 
onChange="signature(this.form, 'field62', 'field62_hold', 'field62_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field62_hold" value="<?=$objResult["field62_sig"];?>">
<input type="text" name="field62_sig" size="15" value="<?=$objResult["field62_sig"];?>" 
onChange="not_allowed(this.form, 'field62_hold', 'field62_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Starting Pressure</td>
<TD><INPUT TYPE=TEXT NAME="field63" SIZE=20 value="<?=$objResult["field63"];?>" 
onChange="signature(this.form, 'field63', 'field63_hold', 'field63_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field63_hold" value="<?=$objResult["field63_sig"];?>">
<input type="text" name="field63_sig" size="15" value="<?=$objResult["field63_sig"];?>" 
onChange="not_allowed(this.form, 'field63_hold', 'field63_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Ending Pressure</td>
<TD><INPUT TYPE=TEXT NAME="field64" SIZE=20 value="<?=$objResult["field64"];?>" 
onChange="signature(this.form, 'field64', 'field64_hold', 'field64_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field64_hold" value="<?=$objResult["field64_sig"];?>">
<input type="text" name="field64_sig" size="15" value="<?=$objResult["field64_sig"];?>" 
onChange="not_allowed(this.form, 'field64_hold', 'field64_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">If difference between start & end, pressurize buoy to 5 psi</td>
<TD><INPUT TYPE=TEXT NAME="field65" SIZE=20 value="<?=$objResult["field65"];?>" 
onChange="signature(this.form, 'field65', 'field65_hold', 'field65_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field65_hold" value="<?=$objResult["field65_sig"];?>">
<input type="text" name="field65_sig" size="15" value="<?=$objResult["field65_sig"];?>" 
onChange="not_allowed(this.form, 'field65_hold', 'field65_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Locate and repair leak, repeat tests</td>
<TD><INPUT TYPE=TEXT NAME="field66" SIZE=20 value="<?=$objResult["field66"];?>" 
onChange="signature(this.form, 'field66', 'field66_hold', 'field66_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field66_hold" value="<?=$objResult["field66_sig"];?>">
<input type="text" name="field66_sig" size="15" value="<?=$objResult["field66_sig"];?>" 
onChange="not_allowed(this.form, 'field66_hold', 'field66_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Bolt mast endcap in place making sure O-ring is greased</td>
<TD><INPUT TYPE=TEXT NAME="field67" SIZE=20 value="<?=$objResult["field67"];?>" 
onChange="signature(this.form, 'field67', 'field67_hold', 'field67_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field67_hold" value="<?=$objResult["field67_sig"];?>">
<input type="text" name="field67_sig" size="15" value="<?=$objResult["field67_sig"];?>" 
onChange="not_allowed(this.form, 'field67_hold', 'field67_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Install vacuum gauge on mast endcap plate</td>
<TD><INPUT TYPE=TEXT NAME="field68" SIZE=20 value="<?=$objResult["field68"];?>" 
onChange="signature(this.form, 'field68', 'field68_hold', 'field68_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field68_hold" value="<?=$objResult["field68_sig"];?>">
<input type="text" name="field68_sig" size="15" value="<?=$objResult["field68_sig"];?>" 
onChange="not_allowed(this.form, 'field68_hold', 'field68_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Draw a 10 in Hg Vacuum and let sit 12 hrs</td>
<TD><INPUT TYPE=TEXT NAME="field69" SIZE=20 value="<?=$objResult["field69"];?>" 
onChange="signature(this.form, 'field69', 'field69_hold', 'field69_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field69_hold" value="<?=$objResult["field69_sig"];?>">
<input type="text" name="field69_sig" size="15" value="<?=$objResult["field69_sig"];?>" 
onChange="not_allowed(this.form, 'field69_hold', 'field69_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Starting Pressure</td>
<TD><INPUT TYPE=TEXT NAME="field70" SIZE=20 value="<?=$objResult["field70"];?>" 
onChange="signature(this.form, 'field70', 'field70_hold', 'field70_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field70_hold" value="<?=$objResult["field70_sig"];?>">
<input type="text" name="field70_sig" size="15" value="<?=$objResult["field70_sig"];?>" 
onChange="not_allowed(this.form, 'field70_hold', 'field70_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Ending Pressure</td>
<TD><INPUT TYPE=TEXT NAME="field71" SIZE=20 value="<?=$objResult["field71"];?>" 
onChange="signature(this.form, 'field71', 'field71_hold', 'field71_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field71_hold" value="<?=$objResult["field71_sig"];?>">
<input type="text" name="field71_sig" size="15" value="<?=$objResult["field71_sig"];?>" 
onChange="not_allowed(this.form, 'field71_hold', 'field71_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">If difference between start & end, pressurize buoy to 5 psi</td>
<TD><INPUT TYPE=TEXT NAME="field72" SIZE=20 value="<?=$objResult["field72"];?>" 
onChange="signature(this.form, 'field72', 'field72_hold', 'field72_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field72_hold" value="<?=$objResult["field72_sig"];?>">
<input type="text" name="field72_sig" size="15" value="<?=$objResult["field72_sig"];?>" 
onChange="not_allowed(this.form, 'field72_hold', 'field72_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Locate and repair leak, repeat tests</td>
<TD><INPUT TYPE=TEXT NAME="field73" SIZE=20 value="<?=$objResult["field73"];?>" 
onChange="signature(this.form, 'field73', 'field73_hold', 'field73_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field73_hold" value="<?=$objResult["field73_sig"];?>">
<input type="text" name="field73_sig" size="15" value="<?=$objResult["field73_sig"];?>" 
onChange="not_allowed(this.form, 'field73_hold', 'field73_sig')">&nbsp;</td></tr>

</table>

<br><br>


<hr>
System Test and Setup
<hr>


<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">

<table border="1">
<tr BGCOLOR="#99CCFF"><th align="left" colspan="4" ><b>Computer Port Setup, 9600,n,8,1</b></th></tr>
<tr BGCOLOR="#99CCFF"><th align="left" colspan="4" ><b>Plug into Monitor port and put system in TEST mode</b></th></tr>

<tr BGCOLOR="#99CCFF"><th>Barometric Pressure, Temperature/Humidity</th><th>&nbsp; </th><th>NetID</th></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Fill dessicant chamber with fresh dessicant</td>
<TD><INPUT TYPE=TEXT NAME="field74" SIZE=20 value="<?=$objResult["field74"];?>" 
onChange="signature(this.form, 'field74', 'field74_hold', 'field74_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field74_hold" value="<?=$objResult["field74_sig"];?>">
<input type="text" name="field74_sig" size="15" value="<?=$objResult["field74_sig"];?>" 
onChange="not_allowed(this.form, 'field74_hold', 'field74_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Replace PolyOlefin membrane</td>
<TD><INPUT TYPE=TEXT NAME="field75" SIZE=20 value="<?=$objResult["field75"];?>" 
onChange="signature(this.form, 'field75', 'field75_hold', 'field75_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field75_hold" value="<?=$objResult["field75_sig"];?>">
<input type="text" name="field75_sig" size="15" value="<?=$objResult["field75_sig"];?>" 
onChange="not_allowed(this.form, 'field75_hold', 'field75_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Check all plumbing connections</td>
<TD><INPUT TYPE=TEXT NAME="field76" SIZE=20 value="<?=$objResult["field76"];?>" 
onChange="signature(this.form, 'field76', 'field76_hold', 'field76_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field76_hold" value="<?=$objResult["field76_sig"];?>">
<input type="text" name="field76_sig" size="15" value="<?=$objResult["field76_sig"];?>" 
onChange="not_allowed(this.form, 'field76_hold', 'field76_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Measure local pressure with Mercury Barometer, Reading 1</td>
<TD><INPUT TYPE=TEXT NAME="field77" SIZE=20 value="<?=$objResult["field77"];?>" 
onChange="signature(this.form, 'field77', 'field77_hold', 'field77_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field77_hold" value="<?=$objResult["field77_sig"];?>">
<input type="text" name="field77_sig" size="15" value="<?=$objResult["field77_sig"];?>" 
onChange="not_allowed(this.form, 'field77_hold', 'field77_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Reading 2</td>
<TD><INPUT TYPE=TEXT NAME="field78" SIZE=20 value="<?=$objResult["field78"];?>" 
onChange="signature(this.form, 'field78', 'field78_hold', 'field78_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field78_hold" value="<?=$objResult["field78_sig"];?>">
<input type="text" name="field78_sig" size="15" value="<?=$objResult["field78_sig"];?>" 
onChange="not_allowed(this.form, 'field78_hold', 'field78_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Measure local pressure with TABS II barometer, Reading 1</td>
<TD><INPUT TYPE=TEXT NAME="field79" SIZE=20 value="<?=$objResult["field79"];?>" 
onChange="signature(this.form, 'field79', 'field79_hold', 'field79_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field79_hold" value="<?=$objResult["field79_sig"];?>">
<input type="text" name="field79_sig" size="15" value="<?=$objResult["field79_sig"];?>" 
onChange="not_allowed(this.form, 'field79_hold', 'field79_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Reading 2</td>
<TD><INPUT TYPE=TEXT NAME="field80" SIZE=20 value="<?=$objResult["field80"];?>" 
onChange="signature(this.form, 'field80', 'field80_hold', 'field80_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field80_hold" value="<?=$objResult["field80_sig"];?>">
<input type="text" name="field80_sig" size="15" value="<?=$objResult["field80_sig"];?>" 
onChange="not_allowed(this.form, 'field80_hold', 'field80_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Difference</td>
<TD><INPUT TYPE=TEXT NAME="field81" SIZE=20 value="<?=$objResult["field81"];?>" 
onChange="signature(this.form, 'field81', 'field81_hold', 'field81_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field81_hold" value="<?=$objResult["field81_sig"];?>">
<input type="text" name="field81_sig" size="15" value="<?=$objResult["field81_sig"];?>" 
onChange="not_allowed(this.form, 'field81_hold', 'field81_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">If difference > 1 mb adjust with Vaisala software (PTB210 Wizard)</td>
<TD><INPUT TYPE=TEXT NAME="field82" SIZE=20 value="<?=$objResult["field82"];?>" 
onChange="signature(this.form, 'field82', 'field82_hold', 'field82_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field82_hold" value="<?=$objResult["field82_sig"];?>">
<input type="text" name="field82_sig" size="15" value="<?=$objResult["field82_sig"];?>" 
onChange="not_allowed(this.form, 'field82_hold', 'field82_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">If adjusted diff > 1 mb check Mercury barometer readings</td>
<TD><INPUT TYPE=TEXT NAME="field83" SIZE=20 value="<?=$objResult["field83"];?>" 
onChange="signature(this.form, 'field83', 'field83_hold', 'field83_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field83_hold" value="<?=$objResult["field83_sig"];?>">
<input type="text" name="field83_sig" size="15" value="<?=$objResult["field83_sig"];?>" 
onChange="not_allowed(this.form, 'field83_hold', 'field83_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">If still > 1 mb replace barometer</td>
<TD><INPUT TYPE=TEXT NAME="field84" SIZE=20 value="<?=$objResult["field84"];?>" 
onChange="signature(this.form, 'field84', 'field84_hold', 'field84_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field84_hold" value="<?=$objResult["field84_sig"];?>">
<input type="text" name="field84_sig" size="15" value="<?=$objResult["field84_sig"];?>" 
onChange="not_allowed(this.form, 'field84_hold', 'field84_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Check temperature output against mercury thermometer</td>
<TD><INPUT TYPE=TEXT NAME="field85" SIZE=20 value="<?=$objResult["field85"];?>" 
onChange="signature(this.form, 'field85', 'field85_hold', 'field85_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field85_hold" value="<?=$objResult["field85_sig"];?>">
<input type="text" name="field85_sig" size="15" value="<?=$objResult["field85_sig"];?>" 
onChange="not_allowed(this.form, 'field85_hold', 'field85_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Check humidity against shop sensor</td>
<TD><INPUT TYPE=TEXT NAME="field86" SIZE=20 value="<?=$objResult["field86"];?>" 
onChange="signature(this.form, 'field86', 'field86_hold', 'field86_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field86_hold" value="<?=$objResult["field86_sig"];?>">
<input type="text" name="field86_sig" size="15" value="<?=$objResult["field86_sig"];?>" 
onChange="not_allowed(this.form, 'field86_hold', 'field86_sig')">&nbsp;</td></tr>



</table>

<br><br>


<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;  &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">



<table border="1">
<tr BGCOLOR="#99CCFF"><th>Wind Test/Alignment</th><th>&nbsp; </th><th>NetID</th></tr>



<tr BGCOLOR="#FFFFCC"><td align="right">Install and level Laser Level on tripod</td>
<TD><INPUT TYPE=TEXT NAME="field87" SIZE=20 value="<?=$objResult["field87"];?>" 
onChange="signature(this.form, 'field87', 'field87_hold', 'field87_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field87_hold" value="<?=$objResult["field87_sig"];?>">
<input type="text" name="field87_sig" size="15" value="<?=$objResult["field87_sig"];?>" 
onChange="not_allowed(this.form, 'field87_hold', 'field87_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Bolt buoy chassis closed as if in field</td>
<TD><INPUT TYPE=TEXT NAME="field88" SIZE=20 value="<?=$objResult["field88"];?>" 
onChange="signature(this.form, 'field88', 'field88_hold', 'field88_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field88_hold" value="<?=$objResult["field88_sig"];?>">
<input type="text" name="field88_sig" size="15" value="<?=$objResult["field88_sig"];?>" 
onChange="not_allowed(this.form, 'field88_hold', 'field88_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Align laser with Compass North using 2 pts of ref.</td>
<TD><INPUT TYPE=TEXT NAME="field89" SIZE=20 value="<?=$objResult["field89"];?>" 
onChange="signature(this.form, 'field89', 'field89_hold', 'field89_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field89_hold" value="<?=$objResult["field89_sig"];?>">
<input type="text" name="field89_sig" size="15" value="<?=$objResult["field89_sig"];?>" 
onChange="not_allowed(this.form, 'field89_hold', 'field89_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Align N-S axis of anemometer with laser</td>
<TD><INPUT TYPE=TEXT NAME="field90" SIZE=20 value="<?=$objResult["field90"];?>" 
onChange="signature(this.form, 'field90', 'field90_hold', 'field90_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field90_hold" value="<?=$objResult["field90_sig"];?>">
<input type="text" name="field90_sig" size="15" value="<?=$objResult["field90_sig"];?>" 
onChange="not_allowed(this.form, 'field90_hold', 'field90_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Secure set screws to lock anemometer position</td>
<TD><INPUT TYPE=TEXT NAME="field91" SIZE=20 value="<?=$objResult["field91"];?>" 
onChange="signature(this.form, 'field91', 'field91_hold', 'field91_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field91_hold" value="<?=$objResult["field91_sig"];?>">
<input type="text" name="field91_sig" size="15" value="<?=$objResult["field91_sig"];?>" 
onChange="not_allowed(this.form, 'field91_hold', 'field91_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Install Buoy on Rocket Launcher and raise to Vertical</td>
<TD><INPUT TYPE=TEXT NAME="field92" SIZE=20 value="<?=$objResult["field92"];?>" 
onChange="signature(this.form, 'field92', 'field92_hold', 'field92_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field92_hold" value="<?=$objResult["field92_sig"];?>">
<input type="text" name="field92_sig" size="15" value="<?=$objResult["field92_sig"];?>" 
onChange="not_allowed(this.form, 'field92_hold', 'field92_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Rotate buoy checking compass heading</td>
<TD><INPUT TYPE=TEXT NAME="field93" SIZE=20 value="<?=$objResult["field93"];?>" 
onChange="signature(this.form, 'field93', 'field93_hold', 'field93_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field93_hold" value="<?=$objResult["field93_sig"];?>">
<input type="text" name="field93_sig" size="15" value="<?=$objResult["field93_sig"];?>" 
onChange="not_allowed(this.form, 'field93_hold', 'field93_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Calibrate compass if necessary</td>
<TD><INPUT TYPE=TEXT NAME="field94" SIZE=20 value="<?=$objResult["field94"];?>" 
onChange="signature(this.form, 'field94', 'field94_hold', 'field94_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field94_hold" value="<?=$objResult["field94_sig"];?>">
<input type="text" name="field94_sig" size="15" value="<?=$objResult["field94_sig"];?>" 
onChange="not_allowed(this.form, 'field94_hold', 'field94_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Take a minimum of two wind readings in each quadrant</td>
<TD><INPUT TYPE=TEXT NAME="field95" SIZE=20 value="<?=$objResult["field95"];?>" 
onChange="signature(this.form, 'field95', 'field95_hold', 'field95_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field95_hold" value="<?=$objResult["field95_sig"];?>">
<input type="text" name="field95_sig" size="15" value="<?=$objResult["field95_sig"];?>" 
onChange="not_allowed(this.form, 'field95_hold', 'field95_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Plot results against RM Young anemometer</td>
<TD><INPUT TYPE=TEXT NAME="field96" SIZE=20 value="<?=$objResult["field96"];?>" 
onChange="signature(this.form, 'field96', 'field96_hold', 'field96_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field96_hold" value="<?=$objResult["field96_sig"];?>">
<input type="text" name="field96_sig" size="15" value="<?=$objResult["field96_sig"];?>" 
onChange="not_allowed(this.form, 'field96_hold', 'field96_sig')">&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Attach plots</td>
<TD><INPUT TYPE=TEXT NAME="field97" SIZE=20 value="<?=$objResult["field97"];?>" 
onChange="signature(this.form, 'field97', 'field97_hold', 'field97_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field97_hold" value="<?=$objResult["field97_sig"];?>">
<input type="text" name="field97_sig" size="15" value="<?=$objResult["field97_sig"];?>" 
onChange="not_allowed(this.form, 'field97_hold', 'field97_sig')">&nbsp;</td></tr>
</table>

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
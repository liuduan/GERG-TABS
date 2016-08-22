<?php
include ("../../Deployment/authorization.php");
?>
<h4 class="STYLE4">


<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM TABSI_table3 WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found checkout=".$_GET["checkout"];
	}
	else
	{
	?>
<b><br />
<table border="3" BGCOLOR="#99CCFF" style="display: inline; vertical-align:middle;">
  <tr>
  <td><b>File Number: </b></td><td><b>	<?php echo $objResult["checkout"]. '&nbsp;&nbsp;&nbsp;';?></b></td>
<td><b>old_checkout:</b></td><td><b><?php echo $objResult["old_checkout"];?></b></br></tr>
</table>


<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b><b>TABS I Setup and Test, Page 3</b>
<center>


<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a>
</div>

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

<b>From UTIL Menu</b>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  </b>
<input type="submit" name="submit" value="Submit & Back">




<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><TH><b></b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">MODEM_VTH</td>
<td><center>
<input type="checkbox" name="field140" value="checked" <? echo $objResult["field140"];?>
 onclick="signature(this.form, 'field140', 'field140_hold', 'field140_sig')"></TD><td><center>8</td>
<TD><INPUT TYPE=HIDDEN NAME="field140_hold" value="<?=$objResult["field140_sig"];?>">
<input type="text" name="field140_sig" size="20" value="<?=$objResult["field140_sig"];?>" 
onChange="not_allowed(this.form, 'field140_hold', 'field140_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">ACK_WAIT</td>
<td><center><input type="checkbox" name="field141" value="checked" <? echo $objResult["field141"];?>
 onclick="signature(this.form, 'field141', 'field141_hold', 'field141_sig')"></TD><td><center>60</td>
<TD><INPUT TYPE=HIDDEN NAME="field141_hold" value="<?=$objResult["field141_sig"];?>">
<input type="text" name="field141_sig" size="20" value="<?=$objResult["field141_sig"];?>" 
onChange="not_allowed(this.form, 'field141_hold', 'field141_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">CON_WAIT</td>
<td><center><input type="checkbox" name="field142" value="checked" <? echo $objResult["field142"];?> 
 onclick="signature(this.form, 'field142', 'field142_hold', 'field142_sig')"></TD><td><center>60</td>
<TD><INPUT TYPE=HIDDEN NAME="field142_hold" value="<?=$objResult["field142_sig"];?>">
<input type="text" name="field142_sig" size="20" value="<?=$objResult["field142_sig"];?>" 
onChange="not_allowed(this.form, 'field142_hold', 'field142_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">A2D_COEF</td>
<td><center><input type="checkbox" name="field143" value="checked" <? echo $objResult["field143"];?>
 onclick="signature(this.form, 'field143', 'field143_hold', 'field143_sig')"></TD><td><center>8 SYS_BAT 4.9</td>
<TD><INPUT TYPE=HIDDEN NAME="field143_hold" value="<?=$objResult["field143_sig"];?>">
<input type="text" name="field143_sig" size="20" value="<?=$objResult["field143_sig"];?>" 
onChange="not_allowed(this.form, 'field143_hold', 'field143_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">MODEM_SHOW</td>
<td><center><input type="checkbox" name="field144" value="checked" <? echo $objResult["field144"];?>
 onclick="signature(this.form, 'field144', 'field144_hold', 'field144_sig')"></TD><td><center>AT&F </td>
<TD><INPUT TYPE=HIDDEN NAME="field144_hold" value="<?=$objResult["field144_sig"];?>">
<input type="text" name="field144_sig" size="20" value="<?=$objResult["field144_sig"];?>" 
onChange="not_allowed(this.form, 'field144_hold', 'field144_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td></td><td><center><input type="checkbox" name="field145" value="checked" <? echo $objResult["field145"];?>
 onclick="signature(this.form, 'field145', 'field145_hold', 'field145_sig')"></TD><td><center>AT&D0 </td>
<TD><INPUT TYPE=HIDDEN NAME="field145_hold" value="<?=$objResult["field145_sig"];?>">
<input type="text" name="field145_sig" size="20" value="<?=$objResult["field145_sig"];?>" 
onChange="not_allowed(this.form, 'field145_hold', 'field145_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><center><input type="checkbox" name="field146" value="checked" <? echo $objResult["field146"];?>
 onclick="signature(this.form, 'field146', 'field146_hold', 'field146_sig')"></TD><td><center>AT+ES=3,2,2</td>
<TD><INPUT TYPE=HIDDEN NAME="field146_hold" value="<?=$objResult["field146_sig"];?>">
<input type="text" name="field146_sig" size="20" value="<?=$objResult["field146_sig"];?>" 
onChange="not_allowed(this.form, 'field146_hold', 'field146_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><center><input type="checkbox" name="field147" value="checked" <? echo $objResult["field147"];?>
 onclick="signature(this.form, 'field147', 'field147_hold', 'field147_sig')"></TD><td><center>AT&C1</td>
<TD><INPUT TYPE=HIDDEN NAME="field147_hold" value="<?=$objResult["field147_sig"];?>">
<input type="text" name="field147_sig" size="20" value="<?=$objResult["field147_sig"];?>" 
onChange="not_allowed(this.form, 'field147_hold', 'field147_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><center><input type="checkbox" name="field148" value="checked" <? echo $objResult["field148"];?>
 onclick="signature(this.form, 'field148', 'field148_hold', 'field148_sig')"></TD><td><center>ATS0=1</td>
<TD><INPUT TYPE=HIDDEN NAME="field148_hold" value="<?=$objResult["field148_sig"];?>">
<input type="text" name="field148_sig" size="20" value="<?=$objResult["field148_sig"];?>" 
onChange="not_allowed(this.form, 'field148_hold', 'field148_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><center><input type="checkbox" name="field149" value="checked" <? echo $objResult["field149"];?>
 onclick="signature(this.form, 'field149', 'field149_hold', 'field149_sig')"></TD><td><center>ATE0</td>
<TD><INPUT TYPE=HIDDEN NAME="field149_hold" value="<?=$objResult["field149_sig"];?>">
<input type="text" name="field149_sig" size="20" value="<?=$objResult["field149_sig"];?>" 
onChange="not_allowed(this.form, 'field149_hold', 'field149_sig')"> </td></tr>
</table>
<br><br>
<b>From PTT menu</b><b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   </b>
<input type="submit" name="submit" value="Submit & Back">





<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><TH><b></b></td><TH><b>Input</b></td>
<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>
    
<tr BGCOLOR="#FFFFCC"><td align="right">PTT_SENSOR</td>
<TD><INPUT TYPE=TEXT NAME="field150" SIZE=20 value="<?=$objResult["field150"];?>" 
onChange="signature(this.form, 'field150', 'field150_hold', 'field150_sig')"></TD><td>4 if using DCS, 1 if ADCP</td>
<TD><INPUT TYPE=HIDDEN NAME="field150_hold" value="<?=$objResult["field150_sig"];?>">
<input type="text" name="field150_sig" size="20" value="<?=$objResult["field150_sig"];?>" 
onChange="not_allowed(this.form, 'field150_hold', 'field150_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">PTT_CTS_STATUS</td>
<TD><INPUT TYPE=TEXT NAME="field151" SIZE=20 value="<?=$objResult["field151"];?>" 
onChange="signature(this.form, 'field151', 'field151_hold', 'field151_sig')"></TD><td>0</td>
<TD><INPUT TYPE=HIDDEN NAME="field151_hold" value="<?=$objResult["field151_sig"];?>">
<input type="text" name="field151_sig" size="20" value="<?=$objResult["field151_sig"];?>" 
onChange="not_allowed(this.form, 'field151_hold', 'field151_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">PTT_PWR_STATUS</td>
<TD><INPUT TYPE=TEXT NAME="field152" SIZE=20 value="<?=$objResult["field152"];?>" 
onChange="signature(this.form, 'field152', 'field152_hold', 'field152_sig')"></TD>
<td align="left">0 if older system, 1 if newer system</td>
<TD><INPUT TYPE=HIDDEN NAME="field152_hold" value="<?=$objResult["field152_sig"];?>">
<input type="text" name="field152_sig" size="20" value="<?=$objResult["field152_sig"];?>" 
onChange="not_allowed(this.form, 'field152_hold', 'field152_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">PTT_INFO</td>
<TD><INPUT TYPE=TEXT NAME="field153" SIZE=20 value="<?=$objResult["field153"];?>" 
onChange="signature(this.form, 'field153', 'field153_hold', 'field153_sig')"></TD><td align="left">Sensor for PTT = 4(DCS)</td>
<TD><INPUT TYPE=HIDDEN NAME="field153_hold" value="<?=$objResult["field153_sig"];?>">
<input type="text" name="field153_sig" size="20" value="<?=$objResult["field153_sig"];?>" 
onChange="not_allowed(this.form, 'field153_hold', 'field153_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td></td><TD><INPUT TYPE=TEXT NAME="field154" SIZE=20 value="<?=$objResult["field154"];?>" 
onChange="signature(this.form, 'field154', 'field154_hold', 'field154_sig')"></TD>
<td>CTS state of PTT = 0(PTT ready to receive data)</td>
<TD><INPUT TYPE=HIDDEN NAME="field154_hold" value="<?=$objResult["field154_sig"];?>">
<input type="text" name="field154_sig" size="20" value="<?=$objResult["field154_sig"];?>" 
onChange="not_allowed(this.form, 'field154_hold', 'field154_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td></td><TD><INPUT TYPE=TEXT NAME="field155" SIZE=20 value="<?=$objResult["field155"];?>" 
onChange="signature(this.form, 'field155', 'field155_hold', 'field155_sig')"></TD>
<td>PWR state of PTT = 0 or 1 (Turn on PTT using this state)</td>
<TD><INPUT TYPE=HIDDEN NAME="field155_hold" value="<?=$objResult["field155_sig"];?>">
<input type="text" name="field155_sig" size="20" value="<?=$objResult["field155_sig"];?>" 
onChange="not_allowed(this.form, 'field155_hold', 'field155_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td></td><TD><INPUT TYPE=TEXT NAME="field156" SIZE=20 value="<?=$objResult["field156"];?>" 
onChange="signature(this.form, 'field156', 'field156_hold', 'field156_sig')"></TD><td>Polar state of PTT = 1</td>
<TD><INPUT TYPE=HIDDEN NAME="field156_hold" value="<?=$objResult["field156_sig"];?>">
<input type="text" name="field156_sig" size="20" value="<?=$objResult["field156_sig"];?>" 
onChange="not_allowed(this.form, 'field156_hold', 'field156_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td></td><TD><INPUT TYPE=TEXT NAME="field157" SIZE=20 value="<?=$objResult["field157"];?>" 
onChange="signature(this.form, 'field157', 'field157_hold', 'field157_sig')"></TD>
<td>Offset hour for PTT = 0(PTT turn on/off delay)</td>
<TD><INPUT TYPE=HIDDEN NAME="field157_hold" value="<?=$objResult["field157_sig"];?>">
<input type="text" name="field157_sig" size="20" value="<?=$objResult["field157_sig"];?>" 
onChange="not_allowed(this.form, 'field157_hold', 'field157_sig')"></td></tr>
</table><br><br>



<b class="fixed-width"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; </b>
<input type="submit" name="submit" value="Submit & Back">



<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><TH><b>System Tests</b></td><TH><b>Expected Value</b></td><TH><b>Returned Value</b></td>
<TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">Reset system</td><td></td><TD><INPUT TYPE=TEXT NAME="field158" SIZE=20 value="<?=$objResult["field158"];?>" 
onChange="signature(this.form, 'field158', 'field158_hold', 'field158_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field158_hold" value="<?=$objResult["field158_sig"];?>">
<input type="text" name="field158_sig" size="20" value="<?=$objResult["field158_sig"];?>" 
onChange="not_allowed(this.form, 'field158_hold', 'field158_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Julian Date</td><TD><INPUT TYPE=TEXT NAME="field159" SIZE=10 value="<?=$objResult["field159"];?>" 
onChange="signature(this.form, 'field159', 'field159_hold', 'field159_sig')"></TD>
<td>Check against PTT Sched. <br />Change sched if a multiple.</td>
<TD><INPUT TYPE=HIDDEN NAME="field159_hold" value="<?=$objResult["field159_sig"];?>">
<input type="text" name="field159_sig" size="20" value="<?=$objResult["field159_sig"];?>" 
onChange="not_allowed(this.form, 'field159_hold', 'field159_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Perform DCS Hang Test of Compass and Tilt</td><td></td>
<TD><INPUT TYPE=TEXT NAME="field160" SIZE=20 value="<?=$objResult["field160"];?>" 
onChange="signature(this.form, 'field160', 'field160_hold', 'field160_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field160_hold" value="<?=$objResult["field160_sig"];?>">
<input type="text" name="field160_sig" size="20" value="<?=$objResult["field160_sig"];?>" 
onChange="not_allowed(this.form, 'field160_hold', 'field160_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Initial state of enable line</td><td><center>Low</td>
<TD><INPUT TYPE=TEXT NAME="field161" SIZE=20 value="<?=$objResult["field161"];?>" 
onChange="signature(this.form, 'field161', 'field161_hold', 'field161_sig')">PTT Disabled</TD>
<TD><INPUT TYPE=HIDDEN NAME="field161_hold" value="<?=$objResult["field161_sig"];?>">
<input type="text" name="field161_sig" size="20" value="<?=$objResult["field161_sig"];?>" 
onChange="not_allowed(this.form, 'field161_hold', 'field161_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Initial state of CTS line</td><td><center>Low</td>
<TD><INPUT TYPE=TEXT NAME="field162" SIZE=20 value="<?=$objResult["field162"];?>" 
onChange="signature(this.form, 'field162', 'field162_hold', 'field162_sig')">PTT Disabled</TD>
<TD><INPUT TYPE=HIDDEN NAME="field162_hold" value="<?=$objResult["field162_sig"];?>">
<input type="text" name="field162_sig" size="20" value="<?=$objResult["field162_sig"];?>" 
onChange="not_allowed(this.form, 'field162_hold', 'field162_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Does PTT transmit?</td><td><center>No</td>
<TD><INPUT TYPE=TEXT NAME="field163" SIZE=20 value="<?=$objResult["field163"];?>" 
onChange="signature(this.form, 'field163', 'field163_hold', 'field163_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field163_hold" value="<?=$objResult["field163_sig"];?>">
<input type="text" name="field163_sig" size="20" value="<?=$objResult["field163_sig"];?>" 
onChange="not_allowed(this.form, 'field163_hold', 'field163_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Does RSM confirm PTT disabled</td><td><center>Y</td>
<TD><INPUT TYPE=TEXT NAME="field164" SIZE=20 value="<?=$objResult["field164"];?>" 
onChange="signature(this.form, 'field164', 'field164_hold', 'field164_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field164_hold" value="<?=$objResult["field164_sig"];?>">
<input type="text" name="field164_sig" size="20" value="<?=$objResult["field164_sig"];?>" 
onChange="not_allowed(this.form, 'field164_hold', 'field164_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Allow system to collect at least 4 records (FIFO Buffer)</td><td></td>
<TD><INPUT TYPE=TEXT NAME="field165" SIZE=20 value="<?=$objResult["field165"];?>" 
onChange="signature(this.form, 'field165', 'field165_hold', 'field165_sig')">(records)</TD>
<TD><INPUT TYPE=HIDDEN NAME="field165_hold" value="<?=$objResult["field165_sig"];?>">
<input type="text" name="field165_sig" size="20" value="<?=$objResult["field165_sig"];?>" 
onChange="not_allowed(this.form, 'field165_hold', 'field165_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">State of enable line (Pin24 J1 Daughterboard)</td><td><center>High</td>
<TD><INPUT TYPE=TEXT NAME="field166" SIZE=20 value="<?=$objResult["field166"];?>" 
onChange="signature(this.form, 'field166', 'field166_hold', 'field166_sig')">PTT Enabled</TD>
<TD><INPUT TYPE=HIDDEN NAME="field166_hold" value="<?=$objResult["field166_sig"];?>">
<input type="text" name="field166_sig" size="20" value="<?=$objResult["field166_sig"];?>" 
onChange="not_allowed(this.form, 'field166_hold', 'field166_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">State of CTS line (Pin 19 J1 Daughterboard)</td><td><center>High</td>
<TD><INPUT TYPE=TEXT NAME="field167" SIZE=20 value="<?=$objResult["field167"];?>" 
onChange="signature(this.form, 'field167', 'field167_hold', 'field167_sig')">PTT Enabled</TD>
<TD><INPUT TYPE=HIDDEN NAME="field167_hold" value="<?=$objResult["field167_sig"];?>">
<input type="text" name="field167_sig" size="20" value="<?=$objResult["field167_sig"];?>" 
onChange="not_allowed(this.form, 'field167_hold', 'field167_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Does the RSM send data to PTT as expected?</td><td><center>Y</td>
<TD><INPUT TYPE=TEXT NAME="field168" SIZE=20 value="<?=$objResult["field168"];?>" 
onChange="signature(this.form, 'field168', 'field168_hold', 'field168_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field168_hold" value="<?=$objResult["field168_sig"];?>">
<input type="text" name="field168_sig" size="20" value="<?=$objResult["field168_sig"];?>" 
onChange="not_allowed(this.form, 'field168_hold', 'field168_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Does the PTT transmit the data in ARGOS Buffer?</td><td><center>Y</td>
<TD><INPUT TYPE=TEXT NAME="field169" SIZE=20 value="<?=$objResult["field169"];?>" 
onChange="signature(this.form, 'field169', 'field169_hold', 'field169_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field169_hold" value="<?=$objResult["field169_sig"];?>">
<input type="text" name="field169_sig" size="20" value="<?=$objResult["field169_sig"];?>" 
onChange="not_allowed(this.form, 'field169_hold', 'field169_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Does RSM confirm PTT enabled?</td><td><center>Y</td>
<TD><INPUT TYPE=TEXT NAME="field170" SIZE=20 value="<?=$objResult["field170"];?>" 
onChange="signature(this.form, 'field170', 'field170_hold', 'field170_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field170_hold" value="<?=$objResult["field170_sig"];?>">
<input type="text" name="field170_sig" size="20" value="<?=$objResult["field170_sig"];?>" 
onChange="not_allowed(this.form, 'field170_hold', 'field170_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Set DEBUG level back to 0</td><td><center>DEBUG 0</td>
<TD><INPUT TYPE=TEXT NAME="field171" SIZE=20 value="<?=$objResult["field171"];?>" 
onChange="signature(this.form, 'field171', 'field171_hold', 'field171_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field171_hold" value="<?=$objResult["field171_sig"];?>">
<input type="text" name="field171_sig" size="20" value="<?=$objResult["field171_sig"];?>" 
onChange="not_allowed(this.form, 'field171_hold', 'field171_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Let system call: confirm buffers empty</td><td></td>
<TD><INPUT TYPE=TEXT NAME="field172" SIZE=20 value="<?=$objResult["field172"];?>" 
onChange="signature(this.form, 'field172', 'field172_hold', 'field172_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field172_hold" value="<?=$objResult["field172_sig"];?>">
<input type="text" name="field172_sig" size="20" value="<?=$objResult["field172_sig"];?>" 
onChange="not_allowed(this.form, 'field172_hold', 'field172_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Argos buffers emptied</td><td><center>Y</td>
<TD><INPUT TYPE=TEXT NAME="field173" SIZE=20 value="<?=$objResult["field173"];?>" 
onChange="signature(this.form, 'field173', 'field173_hold', 'field173_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field173_hold" value="<?=$objResult["field173_sig"];?>">
<input type="text" name="field173_sig" size="20" value="<?=$objResult["field173_sig"];?>" 
onChange="not_allowed(this.form, 'field173_hold', 'field173_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Initial state of enable line</td><td><center>Low</center></td>
<TD><INPUT TYPE=TEXT NAME="field174" SIZE=20 value="<?=$objResult["field174"];?>" 
onChange="signature(this.form, 'field174', 'field174_hold', 'field174_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field174_hold" value="<?=$objResult["field174_sig"];?>">
<input type="text" name="field174_sig" size="20" value="<?=$objResult["field174_sig"];?>" 
onChange="not_allowed(this.form, 'field174_hold', 'field174_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Initial state of CTS line</td><td><center>Low</center></td>
<TD><INPUT TYPE=TEXT NAME="field175" SIZE=20 value="<?=$objResult["field175"];?>" 
onChange="signature(this.form, 'field175', 'field175_hold', 'field175_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field175_hold" value="<?=$objResult["field175_sig"];?>">
<input type="text" name="field175_sig" size="20" value="<?=$objResult["field175_sig"];?>" 
onChange="not_allowed(this.form, 'field175_hold', 'field175_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Does PTT transmit?</td><td><center>No</td>
<TD><INPUT TYPE=TEXT NAME="field176" SIZE=20 value="<?=$objResult["field176"];?>" 
onChange="signature(this.form, 'field176', 'field176_hold', 'field176_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field176_hold" value="<?=$objResult["field176_sig"];?>">
<input type="text" name="field176_sig" size="20" value="<?=$objResult["field176_sig"];?>" 
onChange="not_allowed(this.form, 'field176_hold', 'field176_sig')"></td></tr>

</table>


<br><br><b>CHANGE BACK TO FIELD SETTINGS FOR DEPLOYMENT</b>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="Submit & Back">
<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><TH><b></b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>


<tr BGCOLOR="#FFFFCC"><td align="right">COMPOSE_INT</td>
<td><center><input type="checkbox" name="field177" value="checked" <? echo $objResult["field177"];?>
 onclick="signature(this.form, 'field177', 'field177_hold', 'field177_sig')"></TD><td><center>30</td>
<TD><INPUT TYPE=HIDDEN NAME="field177_hold" value="<?=$objResult["field177_sig"];?>">
<input type="text" name="field177_sig" size="20" value="<?=$objResult["field177_sig"];?>" 
onChange="not_allowed(this.form, 'field177_hold', 'field177_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">SCHED</td>
<td><center><input type="checkbox" name="field178" value="checked" <? echo $objResult["field178"];?>
 onclick="signature(this.form, 'field178', 'field178_hold', 'field178_sig')"></TD><td><center>2 30 1 0 0</td>
<TD><INPUT TYPE=HIDDEN NAME="field178_hold" value="<?=$objResult["field178_sig"];?>">
<input type="text" name="field178_sig" size="20" value="<?=$objResult["field178_sig"];?>" 
onChange="not_allowed(this.form, 'field178_hold', 'field178_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">SCHED</td>
<td><center><input type="checkbox" name="field179" value="checked" <? echo $objResult["field179"];?>
 onclick="signature(this.form, 'field179', 'field179_hold', 'field179_sig')"></TD><td><center>4 30 6 0 0</td>
<TD><INPUT TYPE=HIDDEN NAME="field179_hold" value="<?=$objResult["field179_sig"];?>">
<input type="text" name="field179_sig" size="20" value="<?=$objResult["field179_sig"];?>" 
onChange="not_allowed(this.form, 'field179_hold', 'field179_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">PTT_SCHED</td>
<td><center><input type="checkbox" name="field180" value="checked" <? echo $objResult["field180"];?>
 onclick="signature(this.form, 'field180', 'field180_hold', 'field180_sig')"></TD><td><center>5 30 6 10 48</td>
<TD><INPUT TYPE=HIDDEN NAME="field180_hold" value="<?=$objResult["field180_sig"];?>">
<input type="text" name="field180_sig" size="20" value="<?=$objResult["field180_sig"];?>" 
onChange="not_allowed(this.form, 'field180_hold', 'field180_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">DEBUG</td>
<td><center><input type="checkbox" name="field181" value="checked" <? echo $objResult["field181"];?>
 onclick="signature(this.form, 'field181', 'field181_hold', 'field181_sig')"></TD><td><center>0</td>
<TD><INPUT TYPE=HIDDEN NAME="field181_hold" value="<?=$objResult["field181_sig"];?>">
<input type="text" name="field181_sig" size="20" value="<?=$objResult["field181_sig"];?>" 
onChange="not_allowed(this.form, 'field181_hold', 'field181_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td></td><td><center><input type="checkbox" name="field182" value="checked" <? echo $objResult["field182"];?> 
 onclick="signature(this.form, 'field182', 'field182_hold', 'field182_sig')"></TD><td><center>set phone# BASE 19798622440</td>
<TD><INPUT TYPE=HIDDEN NAME="field182_hold" value="<?=$objResult["field182_sig"];?>">
<input type="text" name="field182_sig" size="20" value="<?=$objResult["field182_sig"];?>" 
onChange="not_allowed(this.form, 'field182_hold', 'field182_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><Td>Set system to field call schedule</td><Td>60 5 offset 1</td><Td><b></b></td>
<Td><b></b></td></tr></b>
    

<tr BGCOLOR="#FFFFCC"><td align="right">State of enable line</td><td><center>Low</td>
<TD><INPUT TYPE=TEXT NAME="field183" SIZE=20 value="<?=$objResult["field183"];?>" 
onChange="signature(this.form, 'field183', 'field183_hold', 'field183_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field183_hold" value="<?=$objResult["field183_sig"];?>">
<input type="text" name="field183_sig" size="20" value="<?=$objResult["field183_sig"];?>" 
onChange="not_allowed(this.form, 'field183_hold', 'field183_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">State of CTS line</td><td><center>Low</td>
<TD><INPUT TYPE=TEXT NAME="field184" SIZE=20 value="<?=$objResult["field184"];?>" 
onChange="signature(this.form, 'field184', 'field184_hold', 'field184_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field184_hold" value="<?=$objResult["field184_sig"];?>">
<input type="text" name="field184_sig" size="20" value="<?=$objResult["field184_sig"];?>" 
onChange="not_allowed(this.form, 'field184_hold', 'field184_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Does PTT stop sending data?</td><td><center>Y</td>
<TD><INPUT TYPE=TEXT NAME="field185" SIZE=20 value="<?=$objResult["field185"];?>" 
onChange="signature(this.form, 'field185', 'field185_hold', 'field185_sig')">(records)</TD>
<TD><INPUT TYPE=HIDDEN NAME="field185_hold" value="<?=$objResult["field185_sig"];?>">
<input type="text" name="field185_sig" size="20" value="<?=$objResult["field185_sig"];?>" 
onChange="not_allowed(this.form, 'field185_hold', 'field185_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">enter TOM8 and leave for 10 minutes</td><td><center></td>
<TD><INPUT TYPE=TEXT NAME="field186" SIZE=20 value="<?=$objResult["field186"];?>" 
onChange="signature(this.form, 'field186', 'field186_hold', 'field186_sig')">PTT Enabled</TD>
<TD><INPUT TYPE=HIDDEN NAME="field186_hold" value="<?=$objResult["field186_sig"];?>">
<input type="text" name="field186_sig" size="20" value="<?=$objResult["field186_sig"];?>" 
onChange="not_allowed(this.form, 'field186_hold', 'field186_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Does system RESET?</td><td><center>Y</td>
<TD><INPUT TYPE=TEXT NAME="field187" SIZE=20 value="<?=$objResult["field187"];?>" 
onChange="signature(this.form, 'field187', 'field187_hold', 'field187_sig')">PTT Enabled</TD>
<TD><INPUT TYPE=HIDDEN NAME="field187_hold" value="<?=$objResult["field187_sig"];?>">
<input type="text" name="field187_sig" size="20" value="<?=$objResult["field187_sig"];?>" 
onChange="not_allowed(this.form, 'field187_hold', 'field187_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">Firmware version and date</td><td><center></td>
<TD><INPUT TYPE=TEXT NAME="field188" SIZE=20 value="<?=$objResult["field188"];?>" 
onChange="signature(this.form, 'field188', 'field188_hold', 'field188_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field188_hold" value="<?=$objResult["field188_sig"];?>">
<input type="text" name="field188_sig" size="20" value="<?=$objResult["field188_sig"];?>" 
onChange="not_allowed(this.form, 'field188_hold', 'field188_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Format Flashcard</td><td><center></td>
<TD><INPUT TYPE=TEXT NAME="field189" SIZE=20 value="<?=$objResult["field189"];?>" 
onChange="signature(this.form, 'field189', 'field189_hold', 'field189_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field189_hold" value="<?=$objResult["field189_sig"];?>">
<input type="text" name="field189_sig" size="20" value="<?=$objResult["field189_sig"];?>" 
onChange="not_allowed(this.form, 'field189_hold', 'field189_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Record, Print and date RESET record</td><td><center></td>
<TD><INPUT TYPE=TEXT NAME="field190" SIZE=20 value="<?=$objResult["field190"];?>" 
onChange="signature(this.form, 'field190', 'field190_hold', 'field190_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field190_hold" value="<?=$objResult["field190_sig"];?>">
<input type="text" name="field190_sig" size="20" value="<?=$objResult["field190_sig"];?>" 
onChange="not_allowed(this.form, 'field190_hold', 'field190_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Install Dessicant in Cell Link</td>
<td><center><input type="checkbox" name="field191" value="checked" <? echo $objResult["field191"];?>
 onclick="signature(this.form, 'field191', 'field191_hold', 'field191_sig')"></TD><td></td>
<TD><INPUT TYPE=HIDDEN NAME="field191_hold" value="<?=$objResult["field191_sig"];?>">
<input type="text" name="field191_sig" size="20" value="<?=$objResult["field191_sig"];?>" 
onChange="not_allowed(this.form, 'field191_hold', 'field191_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Install Dessicant in SeaPac</td>
<td><center><input type="checkbox" name="field192" value="checked" <? echo $objResult["field192"];?> 
 onclick="signature(this.form, 'field192', 'field192_hold', 'field192_sig')"></TD><td></td>
<TD><INPUT TYPE=HIDDEN NAME="field192_hold" value="<?=$objResult["field192_sig"];?>">
<input type="text" name="field192_sig" size="20" value="<?=$objResult["field192_sig"];?>" 
onChange="not_allowed(this.form, 'field192_hold', 'field192_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">Install Dessicant in Buoy Hull</td>
<td><center><input type="checkbox" name="field193" value="checked" <? echo $objResult["field193"];?>
 onclick="signature(this.form, 'field193', 'field193_hold', 'field193_sig')"></TD><td></td>
<TD><INPUT TYPE=HIDDEN NAME="field193_hold" value="<?=$objResult["field193_sig"];?>">
<input type="text" name="field193_sig" size="20" value="<?=$objResult["field193_sig"];?>" 
onChange="not_allowed(this.form, 'field193_hold', 'field193_sig')"></td></tr>

</table><br>

<input type="submit" name="submit" value="Submit & Back">

<?php
}
mysql_close($objConnect);
?>

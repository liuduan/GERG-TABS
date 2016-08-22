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


<b>From UTIL Menu</b>
<b class="fixed-width">&nbsp; &nbsp; &nbsp;  </b>

<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH><b></b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td>
    
    
<td BGCOLOR="#0000c6"></td>
<TH><b></b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td>
    </tr></b>

<tr BGCOLOR="#c0C8d6"><td>MODEM_VTH</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field140"];?>
</TD><td><center>8</td>
<TD><?=$objResult["field140_sig"];?></td>

<td BGCOLOR="#0000c6"></td>

<td>ACK_WAIT</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field141"];?>
</TD><td><center>60</td>
<TD><?=$objResult["field141_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>CON_WAIT</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field142"];?> 
</TD><td><center>60</td>
<TD><?=$objResult["field142_sig"];?></td>

<td BGCOLOR="#0000c6"></td>

<td>A2D_COEF</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field143"];?>
</TD><td><center>8 SYS_BAT 4.9</td>
<TD><?=$objResult["field143_sig"];?>
</td></tr>

<tr BGCOLOR="#c0C8d6"><td>MODEM_SHOW</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field144"];?>
</TD><td><center>AT&F </td>
<TD><?=$objResult["field144_sig"];?></td>

<td BGCOLOR="#0000c6"></td>

<td></td><td BGCOLOR="#FFFFCC"><center><? echo $objResult["field145"];?>
</TD><td><center>AT&D0 </td>
<TD><?=$objResult["field145_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><center><? echo $objResult["field146"];?>
</TD><td><center>AT+ES=3,2,2</td>
<TD><?=$objResult["field146_sig"];?></td>

<td BGCOLOR="#0000c6"></td>

<td></td><td BGCOLOR="#FFFFCC"><center><? echo $objResult["field147"];?>
</TD><td><center>AT&C1</td>
<TD><?=$objResult["field147_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><center>  148  <? echo $objResult["field148"];?>
</TD><td><center>ATS0=1</td>
<TD><?=$objResult["field148_sig"];?></td>

<td BGCOLOR="#0000c6"></td>

<td></td><td BGCOLOR="#FFFFCC"><center><? echo $objResult["field149"];?>
</TD><td><center>ATE0</td>
<TD><?=$objResult["field149_sig"];?></td></tr>
</table>


<br><b>From PTT menu</b>
<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH><b></b></td><TH><b>Input</b></td>
<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>
    
<tr BGCOLOR="#c0C8d6"><td>PTT_SENSOR</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field150"];?></TD><td><center>4 if using DCS, 1 if ADCP</td>
<TD><?=$objResult["field150_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>PTT_CTSSTAT</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field151"];?></TD><td><center>0</td>
<TD><?=$objResult["field151_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>PTT_PWRSTAT</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field152"];?></TD>
<td><center>0 if older system, 1 if newer system</td>
<TD><?=$objResult["field152_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>PTT_INFO</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field153"];?></TD><td>Sensor for PTT = 4(DCS)</td>
<TD><?=$objResult["field153_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td></td><TD BGCOLOR="#FFFFCC"><?=$objResult["field154"];?></TD>
<td>CTS state of PTT = 0(PTT ready to receive data)</td>
<TD><?=$objResult["field154_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td></td><TD BGCOLOR="#FFFFCC"><?=$objResult["field155"];?></TD>
<td>PWR state of PTT = 0 or 1 (Turn on PTT using this state)</td>
<TD><?=$objResult["field155_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td></td><TD BGCOLOR="#FFFFCC"><?=$objResult["field156"];?></TD><td>Polar state of PTT = 1</td>
<TD><?=$objResult["field156_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td></td><TD BGCOLOR="#FFFFCC"><?=$objResult["field157"];?></TD>
<td>Offset hour for PTT = 0(PTT turn on/off delay)</td>
<TD><?=$objResult["field157_sig"];?></td></tr>
</table>


<br>
<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH><b>System Tests</b></td><TH><b>Expected Value</b></td><TH><b>Returned Value</b></td>
<TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td>Reset system</td><td></td><TD BGCOLOR="#FFFFCC"><?=$objResult["field158"];?></TD>
<TD><?=$objResult["field158_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Julian Date</td><TD BGCOLOR="#FFFFCC"><?=$objResult["field159"];?></TD>
<td>Check against PTT Sched. <br />Change sched if a multiple.</td>
<TD><?=$objResult["field159_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Perform DCS</td><td></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field160"];?></TD>
<TD><?=$objResult["field160_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Initial state of enable line</td><td><center>Low</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field161"];?> PTT Disabled</TD>
<TD><?=$objResult["field161_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Initial state of CTS line</td><td><center>Low</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field162"];?> PTT Disabled</TD>
<TD><?=$objResult["field162_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Does PTT transmit?</td><td><center>No</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field163"];?></TD>
<TD><?=$objResult["field163_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Does RSM confirm PTT disabled</td><td><center>Y</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field164"];?></TD>
<TD><?=$objResult["field164_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Allow system to collect at least 4 records (FIFO Buffer)</td><td></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field165"];?>(records)</TD>
<TD><?=$objResult["field165_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>State of enable line (Pin24 J1 Daughterboard)</td><td><center>High</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field166"];?> PTT Enabled</TD>
<TD><?=$objResult["field166_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>State of CTS line (Pin 19 J1 Daughterboard)</td><td><center>High</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field167"];?>PTT Enabled</TD>
<TD><?=$objResult["field167_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>Does the RSM send data to PTT as expected?</td><td><center>Y</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field168"];?></TD>
<TD><?=$objResult["field168_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Does the PTT transmit the data in SRGOS Buffer?</td><td><center>Y</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field169"];?></TD>
<TD><?=$objResult["field169_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Does RSM confirm PTT enabled?</td><td><center>Y</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field170"];?></TD>
<TD><?=$objResult["field170_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Set DEBUG level back to 0</td><td><center>DEBUG 0</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field171"];?></TD>
<TD><?=$objResult["field171_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>Let system call: confirm buffers empty</td><td></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field172"];?></TD>
<TD><?=$objResult["field172_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Argo buffers emptied</td><td><center>Y</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field173"];?></TD>
<TD><?=$objResult["field173_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Initial state of enable line</td><td><center>Low</center></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field174"];?></TD>
<TD><?=$objResult["field174_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Initial state of CTS line</td><td><center>Low</center></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field175"];?></TD>
<TD><?=$objResult["field175_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Does PTT transmit?</td><td><center>No</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field176"];?></TD>
<TD><?=$objResult["field176_sig"];?></td></tr>

</table>
<br />
<b>TABS I Setup and Testing, Page 3<b class="fixed-width">&nbsp; &nbsp; &nbsp;  </b>
<table border="3" BGCOLOR="#99CCFF" style="display: inline; vertical-align:middle;">
  <tr>
  <td><b>Assembly Number: </b></td><td><b>	<?php echo $objResult["checkout"]. '&nbsp;&nbsp;&nbsp;';?></b></td>
<td><b>Checkout:</b></td><td><b><?php echo $objResult["checkout"];?></b></br></tr>
</table>
</br>


<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>




<br><b>CHANGE BACK TO FIELD SETTINGS FOR DEPLOYMENT</b>
<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH><b></b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>


<tr BGCOLOR="#c0C8d6"><td>COMPOSE_INT</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field177"];?>
</TD><td><center>30</td>
<TD><?=$objResult["field177_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>SCHED</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field178"];?>
</TD><td><center>2 30 1 0 0</td>
<TD><?=$objResult["field178_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>SCHED</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field179"];?>
</TD><td><center>4 30 6 0 0</td>
<TD><?=$objResult["field179_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>PTT_SCHED</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field180"];?>
</TD><td><center>5 30 6 10 48</td>
<TD><?=$objResult["field180_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>DEBUG</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field181"];?>
</TD><td><center>0</td>
<TD><?=$objResult["field181_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td></td><TD BGCOLOR="#FFFFCC"><center>  182  <? echo $objResult["field182"];?> 
</TD><td><center>set phone# BASE 19798622440</td>
<TD><?=$objResult["field182_sig"];?></td></tr>

<tr BGCOLOR="#99CCFF"><TH><b>Set system to 1 hour call schedule</b></td><TH><b>60 5 offset 1</b></td><TH><b></b></td>
<TH><b></b></td></tr></b>
    

<tr BGCOLOR="#c0C8d6"><td>State of enable line</td><td><center>Low</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field183"];?></TD>
<TD><?=$objResult["field183_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>State of CTS line</td><td><center>Low</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field184"];?></TD>
<TD><?=$objResult["field184_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Does PTT stop sending data?</td><td><center>Y</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field185"];?></TD>
<TD><?=$objResult["field185_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>enter TOM8 and leave for 10 minutes</td><td><center></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field186"];?></TD>
<TD><?=$objResult["field186_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Does system RESET?</td><td><center>Y</td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field187"];?></TD>
<TD><?=$objResult["field187_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>Firmware version and date</td><td><center></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field188"];?></TD>
<TD><?=$objResult["field188_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Format Flashcard</td><td><center></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field189"];?></TD>
<TD><?=$objResult["field189_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Record, Print and date RESET record</td><td><center></td>
<TD BGCOLOR="#FFFFCC"><?=$objResult["field190"];?></TD>
<TD><?=$objResult["field190_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Install Dessicant in Cell Link</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field191"];?>
</TD><td></td>
<TD><?=$objResult["field191_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Install Dessicant in SeaPac</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field192"];?> 
</TD><td></td>
<TD><?=$objResult["field192_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>Install Dessicant in Buoy Hull</td>
<td BGCOLOR="#FFFFCC"><center><? echo $objResult["field193"];?>
</TD><td></td>
<TD><?=$objResult["field193_sig"];?></td></tr>

</table><br>

<input type="submit" name="submit" value="Back to List"></form>

<?php
}
mysql_close($objConnect);
?>

<?php
include ("../../Deployment/authorization.php");
?>



<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM TABSI_table2 WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found checkout=".$_GET["checkout"];
	}
	else
	{
	?>
    
<h3 class="TITTLE-STYLE">

<form action="../TABSI_edit1.php" method="post">	

<b>Parameters: </b>

<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH><b>RSM & PTT <br /> Setup Commands for TEST</b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td>
<td BGCOLOR="#0000c6"></td>

<TH><b>RSM & PTT <br /> Setup Commands for TEST</b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td>
    
</tr></b>

<tr BGCOLOR="#c0C8d6"><td align="center">COMPOSTE_INT</td><td BGCOLOR="#FFFFCC">
<? echo $objResult["field70"];?></TD><td>10</td>
<TD><?=$objResult["field70_sig"];?>&nbsp;</td>

<td BGCOLOR="#0000c6"></td>

<td align="center">MAX_PKT</td><td BGCOLOR="#FFFFCC"><? echo $objResult["field71"];?></TD><td>96</td>
<TD><?=$objResult["field71_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">ANALOG_SCHED</td><TD BGCOLOR="#FFFFCC"><? echo $objResult["field72"];?> </TD>
<td>30 1 0 0</td><TD><?=$objResult["field72_sig"];?>&nbsp;</td>

<td BGCOLOR="#0000c6"></td>

<td align="center">DEBUG</td><TD BGCOLOR="#FFFFCC"><? echo $objResult["field73"];?></TD><td>2</td>
<TD><?=$objResult["field73_sig"];?>&nbsp;</td></tr>

<tr BGCOLOR="#c0C8d6"><td align="center">SHOW_CNFG4</td><TD BGCOLOR="#FFFFCC"><? echo $objResult["field74"];?></TD><td>ActivateRS232Loop()</td>
<TD><?=$objResult["field74_sig"];?>&nbsp;</td><td BGCOLOR="#0000c6"></td><td colspan = 4></tr>
</table></b>
<xmp>Delete "ActivateRS232Loop" after initial config to prevent reconfiguring sensor with a RESET. Type EDIT_CNFG 4 1<spacebar><cr></xmp>



<table class="table_style" BGCOLOR="#c0C8d6">
<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field75"];?></TD><td>Set_Property_Averagebase(300)</td>
<TD><?=$objResult["field75_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field76"];?></TD><td>Set_Property_Current_type(Rectangular)</td>
<TD><?=$objResult["field76_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field77"];?>
</TD><td>Set_Property_Compensation_Compass(On)</td>
<TD><?=$objResult["field77_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field78"];?>
</TD><td>Set_Property_Compensation_Tilt(On)</td>
<TD><?=$objResult["field78_sig"];?> </td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field79"];?>
</TD><td>Set_Property_Compensation_Upstream(On)</td>
<TD><?=$objResult["field79_sig"];?> </td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field80"];?>
</TD><td>Set_Property_Output_Comprehensive()</td>
<TD><?=$objResult["field80_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field81"];?>
</TD><td>Set_Property_Output_Format(Engineering)</td>
<TD><?=$objResult["field81_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td></td><td BGCOLOR="#FFFFCC"><? echo $objResult["field82"];?>
</TD><td>Set_Property_Output_Polled(Off)</td>
<TD><?=$objResult["field82_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field83"];?>
</TD><td>Set_Property_Pingrate(120)</td>
<TD><?=$objResult["field83_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field84"];?>
</TD><td>Get_Property_Pingrate()</td>
<TD><?=$objResult["field84_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field85"];?>
</TD><td>Get_Property_Averagebase()</td>
<TD><?=$objResult["field85_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field86"];?>
</TD><td>Get_Property_Compensation_Tilt()</td>
<TD><?=$objResult["field86_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field87"];?>
</TD><td>Get_Property_Compensation_Compass</td>
<TD><?=$objResult["field87_sig"];?> </td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field88"];?>
</TD><td>Get_Property_Current_Type()</td>
<TD> <?=$objResult["field88_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field89"];?>
</TD><td>DeactivateRS232Loop()</td>
<TD> <?=$objResult["field89_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>SERNSOR <br />(if MicroCat installed)</td>
<td BGCOLOR="#FFFFCC"><? echo $objResult["field90"];?>
</TD><td>2 0 Mcat 20 9</td>
<TD><?=$objResult["field90_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>SERNSOR</td>
<td BGCOLOR="#FFFFCC"><? echo $objResult["field91"];?>
</TD><td></td>
<TD><?=$objResult["field91_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td>SERNSOR </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field92"];?>
</TD><td>5 5 PTT 128 9</td>
<TD><?=$objResult["field92_sig"];?></td></tr>
</table><br>


<br /><br /><br />
TABS I Setup and Testing, Page 2 &nbsp;&nbsp;&nbsp;

<b>

<table class="table_style" style="display: inline; vertical-align:middle;">
<tr BGCOLOR="#99CCFF" style="display: inline; vertical-align:middle;">
  <td><b>Assembly Number: </b></td><td BGCOLOR="#FFFFCC">
  <b>	<?php echo $objResult["checkout"]. '&nbsp;&nbsp;&nbsp;';?></b></td>
<td><b>old_checkout:</b></td><td BGCOLOR="#FFFFCC"><b><?php echo $objResult["old_checkout"];?>&nbsp;</b></tr>
</table>


<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>



<table class="table_style">
<tr  BGCOLOR="#c0C8d6"><td>SHOW_SERNSOR </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field93"];?>
</TD>

<td BGCOLOR="#99CCFF">SENSOR#</td><td BGCOLOR="#99CCFF">Type</td><td BGCOLOR="#99CCFF">Name</td><td BGCOLOR="#99CCFF">BuffSz</td>
<td BGCOLOR="#99CCFF">DataSz</td><td BGCOLOR="#99CCFF">V</td>
<TD><?=$objResult["field93_sig"];?></td></tr>

<tr  BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field94"];?>
</TD><td>Port: 1</td><td>1</td><td>ADCP</td><td>0</td>
<td>0</td><td>9.00</td>
<TD><?=$objResult["field94_sig"];?></td></tr>

<tr  BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field95"];?>
</TD><td>Port: 2</td><td>0</td><td>Mcat</td><td>256</td>
<td>20</td><td>9.00</td>
<TD><?=$objResult["field95_sig"];?></td></tr>

<tr  BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field96"];?>
</TD><td>Port: 3</td><td>0</td><td>Sens3</td><td>0</td>
<td>0</td><td>9.00</td>
<TD><?=$objResult["field96_sig"];?></td></tr>

<tr  BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field97"];?>
</TD><td>Port: 4</td><td>6</td><td>DCS</td><td>256</td>
<td>98</td><td>9.00</td>
<TD><?=$objResult["field97_sig"];?> </td></tr>

<tr  BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field98"];?>
</TD><td>Port: 5</td><td>5</td><td>PTT</td><td>512</td>
<td>128</td><td>9.00</td>
<TD><?=$objResult["field98_sig"];?></td></tr>

<tr  BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field99"];?>
</TD><td>Port: 6</td><td>8</td><td>SEAPAC</td><td>0</td>
<td>0</td><td>9.00</td>
<TD><?=$objResult["field99_sig"];?></td></tr>
</table>



<br>


<table class="table_style"> 
<tr BGCOLOR="#99CCFF"><TH><b>RSM & PTT Setup Commands for TESTING</b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td>SCHED (if Microcat installed)</td>
<td BGCOLOR="#FFFFCC"><? echo $objResult["field100"];?>
</TD><td>2 10 1 0 0</td>
<TD><?=$objResult["field100_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>SCHED</td><td BGCOLOR="#FFFFCC"><? echo $objResult["field101"];?>
</TD><td>4 10 6 0 0</td>
<TD><?=$objResult["field101_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>PTT_SCHED(lin PTT menu)</td>
<td BGCOLOR="#FFFFCC"><? echo $objResult["field102"];?>
</TD><td>5 10 6 2 4</td>
<TD><?=$objResult["field102_sig"];?></td></tr>
</table><br>



<table class="table_style">   
<tr BGCOLOR="#99CCFF"><td><b>SHOW_SERNSOR </b></td><td><b>Input</b></TD><td><b>SCHEDULE#</b></td><td><b>Blnt</b></td><td><b>BLen</b></td><td><b>Opt#1</b></td><td><b>Opt#2</b></td><td><b>NetID</b></td></tr>

<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field103"];?>
</TD>
<td>Port: 1</td><td>5</td><td>2</td><td>0</td><td>0</td>
<td><?=$objResult["field103_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>(if MicroCat installed)</td><td BGCOLOR="#FFFFCC">
<? echo $objResult["field104"];?>
</TD>
<td>Port: 2</td><td>10</td><td>1</td><td>0</td><td>0</td>
<TD><?=$objResult["field104_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC">  105  <? echo $objResult["field105"];?> 
</TD>
<td>Port: 3</td><td>10</td><td>1</td><td>0</td><td>0</td>
<TD><?=$objResult["field105_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field106"];?>
</TD>
<td>Port: 4</td><td>10</td><td>6</td><td>0</td><td>0</td>
<TD><?=$objResult["field106_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC">  107  <? echo $objResult["field107"];?>
</TD>
<td>Port: 5</td><td>10</td><td>6</td><td>2</td><td>4</td>
<TD><?=$objResult["field107_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field108"];?>
</TD>
<td>Port: 6</td><td>5</td><td>2</td><td>0</td><td>0</td>
<TD><?=$objResult["field108_sig"];?></td></tr>
</table><br>



<table class="table_style">  
<tr BGCOLOR="#99CCFF"><td><b>SHOW_PORTS </b></td><td><b>Input</b></TD><td><b>PORT Setting</b></td><td><b>Baud</b></td><td><b>Parity</b></td><td><b>Data</b></td><td><b>Stop</b></td><td><b>NetID</b></td></tr>

<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field109"];?>
</TD>
<td>Port: 1</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><?=$objResult["field109_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field110"];?>
</TD>
<td>Port: 2</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><?=$objResult["field110_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field111"];?> 
</TD>
<td>Port: 3</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><?=$objResult["field111_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field112"];?>
</TD>
<td>Port: 4</td><td>9600</td><td>N</td><td>8</td><td>2</td>
<TD><?=$objResult["field112_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field113"];?>
</TD>
<td>Port: 5</td><td><? echo $objResult["field113b"];?></td><td>N</td><td>8</td><td>1</td>
<TD><?=$objResult["field113_sig"];?></td></tr>


<tr BGCOLOR="#c0C8d6"><td> </td><td BGCOLOR="#FFFFCC"><? echo $objResult["field114"];?>
</TD>
<td>Port: 6</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><?=$objResult["field114_sig"];?></td></tr>
</table><br>



<table class="table_style">
<tr BGCOLOR="#99CCFF"><TH><b>RSM & PTT Setup Commands for TESTING</b></td><TH><b></b></td>
<TH><b>Value</b></td><TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#c0C8d6"><td>SET_TIME mm/dd/yyyy hh:mm:ss</td><td>GMT Time</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field115"];?></TD>
<TD><?=$objResult["field115_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>STATION</td><td>TABS S/N</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field116"];?></TD>
<TD><?=$objResult["field116_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>BASE (for test ONLY)</td><td>19798621347</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field117"];?></TD>
<TD><?=$objResult["field117_sig"];?></td></tr>

<tr BGCOLOR="#c0C8d6"><td>TELE_SCHED (for test)</td><td>60 5 offset 1</td>
<td BGCOLOR="#FFFFCC"><?=$objResult["field118"];?></TD>
<TD><?=$objResult["field118_sig"];?></td></tr>
</table><br>

<?php
}
mysql_close($objConnect);
?>
<!--
</form>
-->
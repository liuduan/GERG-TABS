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
<br><br>
<table BORDER CELLPADDING=3 style="display: inline; vertical-align:middle;">
<tr BGCOLOR="#99CCFF" style="display: inline; vertical-align:middle;">
  <td><b>File Number: </b></td><td><b>	<?php echo $objResult["checkout"]. '&nbsp;&nbsp;&nbsp;';?></b></td>
<td><b>Checkout:</b></td><td><b><?php echo $objResult["checkout"];?></b></tr>
</table>

<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b><b>TABS I Setup and Test, Page 2

<b>








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

<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>








<b>Parameters: </b>
<b class="fixed-width">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
<input type="submit" name="submit" value="submit & Back">
<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF" align="center"><TH><b>RSM & PTT Setup Commands for TEST</b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">COMPOSE_INT</td><td><input type="checkbox" name="field70" value="checked" <? echo $objResult["field70"];?>
 onclick="signature(this.form, 'field70', 'field70_hold', 'field70_sig')"></TD><td>10</td>
<TD><INPUT TYPE=HIDDEN NAME="field70_hold" value="<?=$objResult["field70_sig"];?>">
<input type="text" name="field70_sig" size="20" value="<?=$objResult["field70_sig"];?>" 
onChange="not_allowed(this.form, 'field70_hold', 'field70_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">MAX_PKT</td><td><input type="checkbox" name="field71" value="checked" <? echo $objResult["field71"];?>
 onclick="signature(this.form, 'field71', 'field71_hold', 'field71_sig')"></TD><td>96</td>
<TD><INPUT TYPE=HIDDEN NAME="field71_hold" value="<?=$objResult["field71_sig"];?>">
<input type="text" name="field71_sig" size="20" value="<?=$objResult["field71_sig"];?>" 
onChange="not_allowed(this.form, 'field71_hold', 'field71_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">ANALOG_SCHED</td><td><input type="checkbox" name="field72" value="checked" <? echo $objResult["field72"];?> 
 onclick="signature(this.form, 'field72', 'field72_hold', 'field72_sig')"></TD><td>30 1 0 0</td>
<TD><INPUT TYPE=HIDDEN NAME="field72_hold" value="<?=$objResult["field72_sig"];?>">
<input type="text" name="field72_sig" size="20" value="<?=$objResult["field72_sig"];?>" 
onChange="not_allowed(this.form, 'field72_hold', 'field72_sig')">&nbsp;&nbsp;&nbsp;</td></tr>




<tr BGCOLOR="#FFFFCC"><td align="right">DEBUG</td><td><input type="checkbox" name="field73" value="checked" <? echo $objResult["field73"];?>
 onclick="signature(this.form, 'field73', 'field73_hold', 'field73_sig')"></TD><td>2</td>
<TD><INPUT TYPE=HIDDEN NAME="field73_hold" value="<?=$objResult["field73_sig"];?>">
<input type="text" name="field73_sig" size="20" value="<?=$objResult["field73_sig"];?>" 
onChange="not_allowed(this.form, 'field73_hold', 'field73_sig')">&nbsp;&nbsp;&nbsp;</td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">SHOW_CNFG4</td><td><input type="checkbox" name="field74" value="checked" <? echo $objResult["field74"];?>
 onclick="signature(this.form, 'field74', 'field74_hold', 'field74_sig')"></TD><td>ActivateRS232Loop()</td>
<TD><INPUT TYPE=HIDDEN NAME="field74_hold" value="<?=$objResult["field74_sig"];?>">
<input type="text" name="field74_sig" size="20" value="<?=$objResult["field74_sig"];?>" 
onChange="not_allowed(this.form, 'field74_hold', 'field74_sig')">&nbsp;&nbsp;&nbsp;</td></tr>
</table></b>
<xmp>Delete "ActivateRS232Loop" after initial config to prevent reconfiguring sensor with a RESET. 
Type EDIT_CNFG 4 1<spacebar><cr></xmp>

<table BORDER CELLPADDING=3>
<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field75" value="checked" <? echo $objResult["field75"];?>
 onclick="signature(this.form, 'field75', 'field75_hold', 'field75_sig')"></TD><td>Set_Property_Averagebase(300)</td>
<TD><INPUT TYPE=HIDDEN NAME="field75_hold" value="<?=$objResult["field75_sig"];?>">
<input type="text" name="field75_sig" size="20" value="<?=$objResult["field75_sig"];?>" 
onChange="not_allowed(this.form, 'field75_hold', 'field75_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field76" value="checked" <? echo $objResult["field76"];?>
 onclick="signature(this.form, 'field76', 'field76_hold', 'field76_sig')"></TD><td>Set_Property_Current_type(Rectangular)</td>
<TD><INPUT TYPE=HIDDEN NAME="field76_hold" value="<?=$objResult["field76_sig"];?>">
<input type="text" name="field76_sig" size="20" value="<?=$objResult["field76_sig"];?>" 
onChange="not_allowed(this.form, 'field76_hold', 'field76_sig')"></td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field77" value="checked" <? echo $objResult["field77"];?>
 onclick="signature(this.form, 'field77', 'field77_hold', 'field77_sig')"></TD><td>Set_Property_Compensation_Compass(On)</td>
<TD><INPUT TYPE=HIDDEN NAME="field77_hold" value="<?=$objResult["field77_sig"];?>">
<input type="text" name="field77_sig" size="20" value="<?=$objResult["field77_sig"];?>" 
onChange="not_allowed(this.form, 'field77_hold', 'field77_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field78" value="checked" <? echo $objResult["field78"];?>
 onclick="signature(this.form, 'field78', 'field78_hold', 'field78_sig')"></TD><td>Set_Property_Compensation_Tilt(On)</td>
<TD><INPUT TYPE=HIDDEN NAME="field78_hold" value="<?=$objResult["field78_sig"];?>">
<input type="text" name="field78_sig" size="20" value="<?=$objResult["field78_sig"];?>" 
onChange="not_allowed(this.form, 'field78_hold', 'field78_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field79" value="checked" <? echo $objResult["field79"];?>
 onclick="signature(this.form, 'field79', 'field79_hold', 'field79_sig')"></TD><td>Set_Property_Compensation_Upstream(On)</td>
<TD><INPUT TYPE=HIDDEN NAME="field79_hold" value="<?=$objResult["field79_sig"];?>">
<input type="text" name="field79_sig" size="20" value="<?=$objResult["field79_sig"];?>" 
onChange="not_allowed(this.form, 'field79_hold', 'field79_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field80" value="checked" <? echo $objResult["field80"];?>
 onclick="signature(this.form, 'field80', 'field80_hold', 'field80_sig')"></TD><td>Set_Property_Output_Comprehensive()</td>
<TD><INPUT TYPE=HIDDEN NAME="field80_hold" value="<?=$objResult["field80_sig"];?>">
<input type="text" name="field80_sig" size="20" value="<?=$objResult["field80_sig"];?>" 
onChange="not_allowed(this.form, 'field80_hold', 'field80_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field81" value="checked" <? echo $objResult["field81"];?>
 onclick="signature(this.form, 'field81', 'field81_hold', 'field81_sig')"></TD><td>Set_Property_Output_Format(Engineering)</td>
<TD><INPUT TYPE=HIDDEN NAME="field81_hold" value="<?=$objResult["field81_sig"];?>">
<input type="text" name="field81_sig" size="20" value="<?=$objResult["field81_sig"];?>" 
onChange="not_allowed(this.form, 'field81_hold', 'field81_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td></td><td><input type="checkbox" name="field82" value="checked" <? echo $objResult["field82"];?>
 onclick="signature(this.form, 'field82', 'field82_hold', 'field82_sig')"></TD><td>Set_Property_Output_Polled(Off)</td>
<TD><INPUT TYPE=HIDDEN NAME="field82_hold" value="<?=$objResult["field82_sig"];?>">
<input type="text" name="field82_sig" size="20" value="<?=$objResult["field82_sig"];?>" 
onChange="not_allowed(this.form, 'field82_hold', 'field82_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td> </td><td><input type="checkbox" name="field83" value="checked" <? echo $objResult["field83"];?>
 onclick="signature(this.form, 'field83', 'field83_hold', 'field83_sig')"></TD><td>Set_Property_Pingrate(120)</td>
<TD><INPUT TYPE=HIDDEN NAME="field83_hold" value="<?=$objResult["field83_sig"];?>">
<input type="text" name="field83_sig" size="20" value="<?=$objResult["field83_sig"];?>" 
onChange="not_allowed(this.form, 'field83_hold', 'field83_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td> </td><td><input type="checkbox" name="field84" value="checked" <? echo $objResult["field84"];?>
 onclick="signature(this.form, 'field84', 'field84_hold', 'field84_sig')"></TD><td>Get_Property_Pingrate()</td>
<TD><INPUT TYPE=HIDDEN NAME="field84_hold" value="<?=$objResult["field84_sig"];?>">
<input type="text" name="field84_sig" size="20" value="<?=$objResult["field84_sig"];?>" 
onChange="not_allowed(this.form, 'field84_hold', 'field84_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td> </td><td><input type="checkbox" name="field85" value="checked" <? echo $objResult["field85"];?>
 onclick="signature(this.form, 'field85', 'field85_hold', 'field85_sig')"></TD><td>Get_Property_Averagebase()</td>
<TD><INPUT TYPE=HIDDEN NAME="field85_hold" value="<?=$objResult["field85_sig"];?>">
<input type="text" name="field85_sig" size="20" value="<?=$objResult["field85_sig"];?>" 
onChange="not_allowed(this.form, 'field85_hold', 'field85_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td> </td><td><input type="checkbox" name="field86" value="checked" <? echo $objResult["field86"];?>
 onclick="signature(this.form, 'field86', 'field86_hold', 'field86_sig')"></TD><td>Get_Property_Compensation_Tilt()</td>
<TD><INPUT TYPE=HIDDEN NAME="field86_hold" value="<?=$objResult["field86_sig"];?>">
<input type="text" name="field86_sig" size="20" value="<?=$objResult["field86_sig"];?>" 
onChange="not_allowed(this.form, 'field86_hold', 'field86_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td> </td><td><input type="checkbox" name="field87" value="checked" <? echo $objResult["field87"];?>
 onclick="signature(this.form, 'field87', 'field87_hold', 'field87_sig')"></TD><td>Get_Property_Compensation_Compass</td>
<TD><INPUT TYPE=HIDDEN NAME="field87_hold" value="<?=$objResult["field87_sig"];?>">
<input type="text" name="field87_sig" size="20" value="<?=$objResult["field87_sig"];?>" 
onChange="not_allowed(this.form, 'field87_hold', 'field87_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td> </td><td><input type="checkbox" name="field88" value="checked" <? echo $objResult["field88"];?>
 onclick="signature(this.form, 'field88', 'field88_hold', 'field88_sig')"></TD><td>Get_Property_Current_Type()</td>
<TD><INPUT TYPE=HIDDEN NAME="field88_hold" value="<?=$objResult["field88_sig"];?>">
<input type="text" name="field88_sig" size="20" value="<?=$objResult["field88_sig"];?>" 
onChange="not_allowed(this.form, 'field88_hold', 'field88_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td> </td><td><input type="checkbox" name="field89" value="checked" <? echo $objResult["field89"];?>
 onclick="signature(this.form, 'field89', 'field89_hold', 'field89_sig')"></TD><td>DeactivateRS232Loop()</td>
<TD><INPUT TYPE=HIDDEN NAME="field89_hold" value="<?=$objResult["field89_sig"];?>">
<input type="text" name="field89_sig" size="20" value="<?=$objResult["field89_sig"];?>" 
onChange="not_allowed(this.form, 'field89_hold', 'field89_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">SENSOR (if MicroCat installed)</td>
<td><input type="checkbox" name="field90" value="checked" <? echo $objResult["field90"];?>
 onclick="signature(this.form, 'field90', 'field90_hold', 'field90_sig')"></TD><td>2 0 Mcat 20 9</td>
<TD><INPUT TYPE=HIDDEN NAME="field90_hold" value="<?=$objResult["field90_sig"];?>">
<input type="text" name="field90_sig" size="20" value="<?=$objResult["field90_sig"];?>" 
onChange="not_allowed(this.form, 'field90_hold', 'field90_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">SENSOR</td>
<td><input type="checkbox" name="field91" value="checked" <? echo $objResult["field91"];?>
 onclick="signature(this.form, 'field91', 'field91_hold', 'field91_sig')"></TD><td>4 6 DCS 98 9</td>
<TD><INPUT TYPE=HIDDEN NAME="field91_hold" value="<?=$objResult["field91_sig"];?>">
<input type="text" name="field91_sig" size="20" value="<?=$objResult["field91_sig"];?>" 
onChange="not_allowed(this.form, 'field91_hold', 'field91_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC"><td align="right">SENSOR </td><td><input type="checkbox" name="field92" value="checked" <? echo $objResult["field92"];?>
 onclick="signature(this.form, 'field92', 'field92_hold', 'field92_sig')"></TD><td>5 5 PTT 128 9</td>
<TD><INPUT TYPE=HIDDEN NAME="field92_hold" value="<?=$objResult["field92_sig"];?>">
<input type="text" name="field92_sig" size="20" value="<?=$objResult["field92_sig"];?>" 
onChange="not_allowed(this.form, 'field92_hold', 'field92_sig')"> </td></tr>
</table><br>



<b class="fixed-width"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b>
<input type="submit" name="submit" value="Submit & Back">

<table BORDER CELLPADDING=3>   
<tr BGCOLOR="#FFFFCC"><td>SHOW_SENSOR </td><th><input type="checkbox" name="field93" value="checked" <? echo $objResult["field93"];?>
 onclick="signature(this.form, 'field93', 'field93_hold', 'field93_sig')"></TD>

<th BGCOLOR="#99CCFF">SENSOR#</td><th BGCOLOR="#99CCFF">Type</td><th BGCOLOR="#99CCFF">Name</td><th BGCOLOR="#99CCFF">BuffSz</td>
<th BGCOLOR="#99CCFF">DataSz</td><th BGCOLOR="#99CCFF">V</td>
<TD><INPUT TYPE=HIDDEN NAME="field93_hold" value="<?=$objResult["field93_sig"];?>">
<input type="text" name="field93_sig" size="20" value="<?=$objResult["field93_sig"];?>" 
onChange="not_allowed(this.form, 'field93_hold', 'field93_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field94" value="checked" <? echo $objResult["field94"];?>
 onclick="signature(this.form, 'field94', 'field94_hold', 'field94_sig')"></TD><td>Port: 1</td><td>1</td><td>ADCP</td><td>0</td>
<td>0</td><td>9.00</td>
<TD><INPUT TYPE=HIDDEN NAME="field94_hold" value="<?=$objResult["field94_sig"];?>">
<input type="text" name="field94_sig" size="20" value="<?=$objResult["field94_sig"];?>" 
onChange="not_allowed(this.form, 'field94_hold', 'field94_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field95" value="checked" <? echo $objResult["field95"];?>
 onclick="signature(this.form, 'field95', 'field95_hold', 'field95_sig')"></TD><td>Port: 2</td><td>0</td><td>Mcat</td><td>256</td>
<td>20</td><td>9.00</td>
<TD><INPUT TYPE=HIDDEN NAME="field95_hold" value="<?=$objResult["field95_sig"];?>">
<input type="text" name="field95_sig" size="20" value="<?=$objResult["field95_sig"];?>" 
onChange="not_allowed(this.form, 'field95_hold', 'field95_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field96" value="checked" <? echo $objResult["field96"];?>
 onclick="signature(this.form, 'field96', 'field96_hold', 'field96_sig')"></TD><td>Port: 3</td><td>0</td><td>Sens3</td><td>0</td>
<td>0</td><td>9.00</td>
<TD><INPUT TYPE=HIDDEN NAME="field96_hold" value="<?=$objResult["field96_sig"];?>">
<input type="text" name="field96_sig" size="20" value="<?=$objResult["field96_sig"];?>" 
onChange="not_allowed(this.form, 'field96_hold', 'field96_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field97" value="checked" <? echo $objResult["field97"];?>
 onclick="signature(this.form, 'field97', 'field97_hold', 'field97_sig')"></TD><td>Port: 4</td><td>6</td><td>DCS</td><td>256</td>
<td>98</td><td>9.00</td>
<TD><INPUT TYPE=HIDDEN NAME="field97_hold" value="<?=$objResult["field97_sig"];?>">
<input type="text" name="field97_sig" size="20" value="<?=$objResult["field97_sig"];?>" 
onChange="not_allowed(this.form, 'field97_hold', 'field97_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field98" value="checked" <? echo $objResult["field98"];?>
 onclick="signature(this.form, 'field98', 'field98_hold', 'field98_sig')"></TD><td>Port: 5</td><td>5</td><td>PTT</td><td>512</td>
<td>128</td><td>9.00</td>
<TD><INPUT TYPE=HIDDEN NAME="field98_hold" value="<?=$objResult["field98_sig"];?>">
<input type="text" name="field98_sig" size="20" value="<?=$objResult["field98_sig"];?>" 
onChange="not_allowed(this.form, 'field98_hold', 'field98_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field99" value="checked" <? echo $objResult["field99"];?>
 onclick="signature(this.form, 'field99', 'field99_hold', 'field99_sig')"></TD><td>Port: 6</td><td>8</td><td>SEAPAC</td><td>0</td>
<td>0</td><td>9.00</td>
<TD><INPUT TYPE=HIDDEN NAME="field99_hold" value="<?=$objResult["field99_sig"];?>">
<input type="text" name="field99_sig" size="20" value="<?=$objResult["field99_sig"];?>" 
onChange="not_allowed(this.form, 'field99_hold', 'field99_sig')"> </td></tr>
</table>



<br>



<table BORDER CELLPADDING=3>   
<tr BGCOLOR="#99CCFF"><TH><b>RSM & PTT Setup Commands for TESTING</b></td><TH><b>Input</b></td>
	<TH><b>EXPECTED INPUT</b></td><TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">SCHED (if Microcat installed)</td>
<td align="center"><input type="checkbox" name="field100" value="checked" <? echo $objResult["field100"];?>
 onclick="signature(this.form, 'field100', 'field100_hold', 'field100_sig')"></TD><td>2 10 1 0 0</td>
<TD><INPUT TYPE=HIDDEN NAME="field100_hold" value="<?=$objResult["field100_sig"];?>">
<input type="text" name="field100_sig" size="20" value="<?=$objResult["field100_sig"];?>" 
onChange="not_allowed(this.form, 'field100_hold', 'field100_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">SCHED</td>
<td align="center"><input type="checkbox" name="field101" value="checked" <? echo $objResult["field101"];?>
 onclick="signature(this.form, 'field101', 'field101_hold', 'field101_sig')"></TD><td>4 10 6 0 0</td>
<TD><INPUT TYPE=HIDDEN NAME="field101_hold" value="<?=$objResult["field101_sig"];?>">
<input type="text" name="field101_sig" size="20" value="<?=$objResult["field101_sig"];?>" 
onChange="not_allowed(this.form, 'field101_hold', 'field101_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">PTT_SCHED(lin PTT menu)</td>
<td align="center"><input type="checkbox" name="field102" value="checked" <? echo $objResult["field102"];?>
 onclick="signature(this.form, 'field102', 'field102_hold', 'field102_sig')"></TD><td>5 10 6 2 4</td>
<TD><INPUT TYPE=HIDDEN NAME="field102_hold" value="<?=$objResult["field102_sig"];?>">
<input type="text" name="field102_sig" size="20" value="<?=$objResult["field102_sig"];?>" 
onChange="not_allowed(this.form, 'field102_hold', 'field102_sig')"> </td></tr>
</table><br>



<b class="fixed-width"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; </b>
<input type="submit" name="submit" value="Submit & Back">

<table BORDER CELLPADDING=3>   
<tr BGCOLOR="#99CCFF"><th><b>SHOW_SENSOR </b></td><td><b>Input</b></TD><th><b>SCHEDULE#</b></td><th><b>Blnt</b></td><th><b>BLen</b></td><th><b>Opt#1</b></td><th><b>Opt#2</b></td><th><b>NetID</b></td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field103" value="checked" <? echo $objResult["field103"];?>
 onclick="signature(this.form, 'field103', 'field103_hold', 'field103_sig')"></TD>
<td>Port: 1</td><td>5</td><td>2</td><td>0</td><td>0</td>
<TD><INPUT TYPE=HIDDEN NAME="field103_hold" value="<?=$objResult["field103_sig"];?>">
<input type="text" name="field103_sig" size="20" value="<?=$objResult["field103_sig"];?>" 
onChange="not_allowed(this.form, 'field103_hold', 'field103_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td>(if MicroCat installed)</td><td><input type="checkbox" name="field104" value="checked" 
<? echo $objResult["field104"];?>
 onclick="signature(this.form, 'field104', 'field104_hold', 'field104_sig')"></TD>
<td>Port: 2</td><td>10</td><td>1</td><td>0</td><td>0</td>
<TD><INPUT TYPE=HIDDEN NAME="field104_hold" value="<?=$objResult["field104_sig"];?>">
<input type="text" name="field104_sig" size="20" value="<?=$objResult["field104_sig"];?>" 
onChange="not_allowed(this.form, 'field104_hold', 'field104_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field105" value="checked" <? echo $objResult["field105"];?> 
 onclick="signature(this.form, 'field105', 'field105_hold', 'field105_sig')"></TD>
<td>Port: 3</td><td>10</td><td>1</td><td>0</td><td>0</td>
<TD><INPUT TYPE=HIDDEN NAME="field105_hold" value="<?=$objResult["field105_sig"];?>">
<input type="text" name="field105_sig" size="20" value="<?=$objResult["field105_sig"];?>" 
onChange="not_allowed(this.form, 'field105_hold', 'field105_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field106" value="checked" <? echo $objResult["field106"];?>
 onclick="signature(this.form, 'field106', 'field106_hold', 'field106_sig')"></TD>
<td>Port: 4</td><td>10</td><td>6</td><td>0</td><td>0</td>
<TD><INPUT TYPE=HIDDEN NAME="field106_hold" value="<?=$objResult["field106_sig"];?>">
<input type="text" name="field106_sig" size="20" value="<?=$objResult["field106_sig"];?>" 
onChange="not_allowed(this.form, 'field106_hold', 'field106_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field107" value="checked" <? echo $objResult["field107"];?>
 onclick="signature(this.form, 'field107', 'field107_hold', 'field107_sig')"></TD>
<td>Port: 5</td><td>10</td><td>6</td><td>2</td><td>4</td>
<TD><INPUT TYPE=HIDDEN NAME="field107_hold" value="<?=$objResult["field107_sig"];?>">
<input type="text" name="field107_sig" size="20" value="<?=$objResult["field107_sig"];?>" 
onChange="not_allowed(this.form, 'field107_hold', 'field107_sig')"> </td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field108" value="checked" <? echo $objResult["field108"];?>
 onclick="signature(this.form, 'field108', 'field108_hold', 'field108_sig')"></TD>
<td>Port: 6</td><td>5</td><td>2</td><td>0</td><td>0</td>
<TD><INPUT TYPE=HIDDEN NAME="field108_hold" value="<?=$objResult["field108_sig"];?>">
<input type="text" name="field108_sig" size="20" value="<?=$objResult["field108_sig"];?>" 
onChange="not_allowed(this.form, 'field108_hold', 'field108_sig')"> </td></tr>
</table><br>



<table BORDER CELLPADDING=3>   
<tr BGCOLOR="#99CCFF"><th><b>SHOW_PORTS </b></td><th><b>Input</b></TD><th><b>PORT Setting</b></td><th><b>Baud</b></td><th><b>Parity</b></td><th><b>Data</b></td><th><b>Stop</b></td><th><b>NetID</b></td></tr>

<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field109" value="checked" <? echo $objResult["field109"];?>
 onclick="signature(this.form, 'field109', 'field109_hold', 'field109_sig')"></TD>
<td>Port: 1</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><INPUT TYPE=HIDDEN NAME="field109_hold" value="<?=$objResult["field109_sig"];?>">
<input type="text" name="field109_sig" size="20" value="<?=$objResult["field109_sig"];?>" 
onChange="not_allowed(this.form, 'field109_hold', 'field109_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field110" value="checked" <? echo $objResult["field110"];?>
 onclick="signature(this.form, 'field110', 'field110_hold', 'field110_sig')"></TD>
<td>Port: 2</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><INPUT TYPE=HIDDEN NAME="field110_hold" value="<?=$objResult["field110_sig"];?>">
<input type="text" name="field110_sig" size="20" value="<?=$objResult["field110_sig"];?>" 
onChange="not_allowed(this.form, 'field110_hold', 'field110_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field111" value="checked" <? echo $objResult["field111"];?> 
 onclick="signature(this.form, 'field111', 'field111_hold', 'field111_sig')"></TD>
<td>Port: 3</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><INPUT TYPE=HIDDEN NAME="field111_hold" value="<?=$objResult["field111_sig"];?>">
<input type="text" name="field111_sig" size="20" value="<?=$objResult["field111_sig"];?>" 
onChange="not_allowed(this.form, 'field111_hold', 'field111_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field112" value="checked" <? echo $objResult["field112"];?>
 onclick="signature(this.form, 'field112', 'field112_hold', 'field112_sig')"></TD>
<td>Port: 4</td><td>9600</td><td>N</td><td>8</td><td>2</td>
<TD><INPUT TYPE=HIDDEN NAME="field112_hold" value="<?=$objResult["field112_sig"];?>">
<input type="text" name="field112_sig" size="20" value="<?=$objResult["field112_sig"];?>" 
onChange="not_allowed(this.form, 'field112_hold', 'field112_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field113" value="checked" <? echo $objResult["field113"];?>
 onclick="signature(this.form, 'field113', 'field113_hold', 'field113_sig')"></TD>
<td>Port: 5</td>

<TD><INPUT TYPE=TEXT NAME="field113b" SIZE=8 value="<?=$objResult["field113b"]; if ($objResult["field113b"] == "") echo "4800";?>" 
onChange="signature(this.form, 'field113b', 'field113_hold', 'field113_sig')"></TD>

<td>N</td><td>8</td><td>1</td>
<TD><INPUT TYPE=HIDDEN NAME="field113_hold" value="<?=$objResult["field113_sig"];?>">
<input type="text" name="field113_sig" size="20" value="<?=$objResult["field113_sig"];?>" 
onChange="not_allowed(this.form, 'field113_hold', 'field113_sig')"> </td></tr>


<tr BGCOLOR="#FFFFCC" align="center"><td> </td><td><input type="checkbox" name="field114" value="checked" <? echo $objResult["field114"];?>
 onclick="signature(this.form, 'field114', 'field114_hold', 'field114_sig')"></TD>
<td>Port: 6</td><td>9600</td><td>N</td><td>8</td><td>1</td>
<TD><INPUT TYPE=HIDDEN NAME="field114_hold" value="<?=$objResult["field114_sig"];?>">
<input type="text" name="field114_sig" size="20" value="<?=$objResult["field114_sig"];?>" 
onChange="not_allowed(this.form, 'field114_hold', 'field114_sig')"> </td></tr>
</table><br>



<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><TH><b>RSM & PTT Setup Commands for TESTING</b></td><TH><b>&nbsp;</b></td>
<TH><b>Value</b></td><TH><b>NetID</b></td></tr></b>

<tr BGCOLOR="#FFFFCC"><td align="right">SET_TIME mm/dd/yyyy hh:mm:ss</td><td align="center"><b>GMT Time</b></td>
<TD><INPUT TYPE=TEXT NAME="field115" SIZE=20 value="<?=$objResult["field115"];?>" 
onChange="signature(this.form, 'field115', 'field115_hold', 'field115_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field115_hold" value="<?=$objResult["field115_sig"];?>">
<input type="text" name="field115_sig" size="20" value="<?=$objResult["field115_sig"];?>" 
onChange="not_allowed(this.form, 'field115_hold', 'field115_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">STATION</td><td align="center">TABS S/N</td>
<TD><INPUT TYPE=TEXT NAME="field116" SIZE=20 value="<?=$objResult["field116"];?>" 
onChange="signature(this.form, 'field116', 'field116_hold', 'field116_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field116_hold" value="<?=$objResult["field116_sig"];?>">
<input type="text" name="field116_sig" size="20" value="<?=$objResult["field116_sig"];?>" 
onChange="not_allowed(this.form, 'field116_hold', 'field116_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">BASE</td><td align="center">19798621347</td>
<TD><INPUT TYPE=TEXT NAME="field117" SIZE=20 value="<?=$objResult["field117"];?>" 
onChange="signature(this.form, 'field117', 'field117_hold', 'field117_sig')">(for testing ONLY)</TD>
<TD><INPUT TYPE=HIDDEN NAME="field117_hold" value="<?=$objResult["field117_sig"];?>">
<input type="text" name="field117_sig" size="20" value="<?=$objResult["field117_sig"];?>" 
onChange="not_allowed(this.form, 'field117_hold', 'field117_sig')"></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right">TELE_SCHED (for testing)</td><td align="center">60 5 offset 1</td>
<TD><INPUT TYPE=TEXT NAME="field118" SIZE=20 value="<?=$objResult["field118"];?>" 
onChange="signature(this.form, 'field118', 'field118_hold', 'field118_sig')"></TD>
<TD><INPUT TYPE=HIDDEN NAME="field118_hold" value="<?=$objResult["field118_sig"];?>">
<input type="text" name="field118_sig" size="20" value="<?=$objResult["field118_sig"];?>" 
onChange="not_allowed(this.form, 'field118_hold', 'field118_sig')"></td></tr>
</table><br>

<input type="submit" name="submit" value="Submit & Back">

<?php
}
mysql_close($objConnect);
?>
<!--
</form>
-->
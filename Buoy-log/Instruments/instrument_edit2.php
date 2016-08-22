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
<title>Editing Instrument Table</title>
</head>
<body>
<center><h3 class="TITLE-STYLE">Editing Instrument Table</h3></center>

<h4 class="STYLE4">
<center>
<form action="./instrument_edit3.php" name="frmEdit" method="post">
<input type="submit" name="submit" value="Submit & Back"><br><br>

<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM instrument_table WHERE ordinal = '".$_GET["ordinal"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found ordinal=".$_GET["ordinal"];
	}
	else
	{
	?>
<b>

<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a></div>


<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF"><td align="right"><b>Checkout: </td>
<td><input type="text" name="checkout" size="20" value="<?=$objResult["checkout"];?>"></br></td>

<td align="right"><b>old_checkout:</td>
<td><input type="text" name="old_checkout" size="20" value="<?=$objResult["old_checkout"];?>"></br></td></tr>

<tr BGCOLOR="#FFFFCC"><td align="right"><b>Instrument Number:</td>
<td><input type="text" name="ordinal" size="20" value="<?=$objResult["ordinal"];?>"></br></td>


<td align="right"><b>Deployment Site:</td>
<td><input type="text" name="field9" size="20" value="<?=$objResult["field9"];?>"></br></td>
</tr>


<tr BGCOLOR="#FFFFCC"><td align="right"><b>Type:</td>
<td><input type="text" name="field3" size="20" value="<?=$objResult["field3"];?>"></br></td>

<td align="right"><b>Sensor Manufacture:</td>
<td><input type="text" name="field4" size="20" value="<?=$objResult["field4"];?>">&nbsp;</td>



<tr BGCOLOR="#FFFFCC"><td align="right"><b>Sensor Model: </td>
<td><input type="text" name="field5" size="20" value="<?=$objResult["field5"];?>"></td>

<td align="right">
<b>Sensor S/N:</td><td><input type="text" name="field6" size="20" value="<?=$objResult["field6"];?>"></br></td>

<tr BGCOLOR="#FFFFCC">
<td align="right"><b>Limit:</td>
<td><input type="text" name="field7" size="20" value="<?=$objResult["field7"];?>">&nbsp;</td>

<td align="right"><b>Unit:</td>
<td><input type="text" name="field8" size="20" value="<?=$objResult["field8"];?>"></br></td></tr>

</table>
</b>


<?php
# echo "_SESSION[]: ";
# print_r($_SESSION);
?>


<?php
}
mysql_close($objConnect);
?>

<input type="submit" name="submit" value="Submit & Back"><br><br>
</form>







</html>
<!--- This file download from www.shotdev.com -->
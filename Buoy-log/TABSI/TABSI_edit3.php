<?php
include ("../Deployment/authorization.php");
?>

<html>
<head>
<title>Edit 3</title>
</head>
<body>
<?php
echo "The _POST array:";
print_r($_POST);
echo '<br>';





echo $_POST["field3"].'<br>';
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "UPDATE TABSI_table1 SET ";
	
	# $strSQL .="checkout = '".$_POST["checkout"]."'";
	$strSQL .=" old_checkout = '".$_POST["old_checkout"]."'";
	$strSQL .=", field3 = '".$_POST["field3"]."'";
	$strSQL .=", field4 = '".$_POST["field4"]."'";
	$strSQL .=", field5 = '".$_POST["field5"]."'";
	$strSQL .=", field6 = '".$_POST["field6"]."'";
	$strSQL .=", field7 = '".$_POST["field7"]."'";
	$strSQL .=", field8 = '".$_POST["field8"]."'";
	$strSQL .=", field9 = '".$_POST["field9"]."'";
	$strSQL .=", field10 = '".$_POST["field10"]."'";
	$strSQL .=", field11 = '".$_POST["field11"]."'";
	$strSQL .=", field12 = '".$_POST["field12"]."'";
	$strSQL .=", technician = '".$_POST["technician"]."'";

	$strSQL .=", field14 = '".$_POST["field14"]."'";
	$strSQL .=", field14_sig = '".$_POST["field14_sig"]."'";
	$strSQL .=", field16 = '".$_POST["field16"]."'";
	$strSQL .=", field16_sig = '".$_POST["field16_sig"]."'";
	$strSQL .=", field18 = '".$_POST["field18"]."'";
	$strSQL .=", field18_sig = '".$_POST["field18_sig"]."'";
	$strSQL .=", field20 = '".$_POST["field20"]."'";	
	
	$strSQL .=", field20_sig = '".$_POST["field20_sig"]."'";
	$strSQL .=", field22 = '".$_POST["field22"]."'";
	$strSQL .=", field22_sig = '".$_POST["field22_sig"]."'";
	$strSQL .=", field24 = '".$_POST["field24"]."'";
	$strSQL .=", field24_sig = '".$_POST["field24_sig"]."'";
	$strSQL .=", field26 = '".$_POST["field26"]."'";
	$strSQL .=", field26_sig = '".$_POST["field26_sig"]."'";
	$strSQL .=", field28 = '".$_POST["field28"]."'";
	$strSQL .=", field28_sig = '".$_POST["field28_sig"]."'";
	$strSQL .=", field30 = '".$_POST["field30"]."'";	
	
	$strSQL .=", field30_sig = '".$_POST["field30_sig"]."'";
	$strSQL .=", field32 = '".$_POST["field32"]."'";
	$strSQL .=", field32_sig = '".$_POST["field32_sig"]."'";
	$strSQL .=", field34 = '".$_POST["field34"]."'";
	$strSQL .=", field34_sig = '".$_POST["field34_sig"]."'";
	$strSQL .=", field36 = '".$_POST["field36"]."'";
	$strSQL .=", field36_sig = '".$_POST["field36_sig"]."'";
	$strSQL .=", field38 = '".$_POST["field38"]."'";
	$strSQL .=", field38_sig = '".$_POST["field38_sig"]."'";
	$strSQL .=", field40 = '".$_POST["field40"]."'";
	
	$strSQL .=", field40_sig = '".$_POST["field40_sig"]."'";
	$strSQL .=", field42 = '".$_POST["field42"]."'";
	$strSQL .=", field42_sig = '".$_POST["field42_sig"]."'";
	$strSQL .=", field44 = '".$_POST["field44"]."'";
	$strSQL .=", field44_sig = '".$_POST["field44_sig"]."'";
	$strSQL .=", field46 = '".$_POST["field46"]."'";
	$strSQL .=", field46_sig = '".$_POST["field46_sig"]."'";
	$strSQL .=", field48 = '".$_POST["field48"]."'";
	$strSQL .=", field48_sig = '".$_POST["field48_sig"]."'";
	$strSQL .=", field50 = '".$_POST["field50"]."'";	
	
	$strSQL .=", field50_sig = '".$_POST["field50_sig"]."'";
	$strSQL .=", field52 = '".$_POST["field52"]."'";
	$strSQL .=", field52_sig = '".$_POST["field52_sig"]."'";
	$strSQL .=", field54 = '".$_POST["field54"]."'";
	$strSQL .=", field54_sig = '".$_POST["field54_sig"]."'";
	$strSQL .=", field56 = '".$_POST["field56"]."'";
	$strSQL .=", field56_sig = '".$_POST["field56_sig"]."'";
	$strSQL .=", field58 = '".$_POST["field58"]."'";
	$strSQL .=", field58_sig = '".$_POST["field58_sig"]."'";
	$strSQL .=", field60 = '".$_POST["field60"]."'";
	
	$strSQL .=", field60_sig = '".$_POST["field60_sig"]."'";
	$strSQL .=", field62 = '".$_POST["field62"]."'";
	$strSQL .=", field62_sig = '".$_POST["field62_sig"]."'";
	$strSQL .=", field64 = '".$_POST["field64"]."'";
	$strSQL .=", field64_sig = '".$_POST["field64_sig"]."'";
	
	$strSQL .=", field66 = '".$_POST["field66"]."'";
	
	$strSQL .=" WHERE checkout = '".$_GET["checkout"]."' ";
	
echo $strSQL. '<br>'.'<br>';

	# This line update the fields.
	$objQuery = mysql_query($strSQL) or die(mysql_error());
	
# Put it into TABSI_table2
# send "old_checkout" value to table2 





$sql2= "UPDATE TABSI_table2 SET old_checkout = '". $_POST["old_checkout"]. "'";
	$sql2 .=" WHERE checkout = '". $_GET["checkout"]. "' ";
echo $sql2. '<br>';
mysql_query($sql2) or die(mysql_error());
echo "sql2 = ".$sql2. '<br>'.'<br>';

	
	
	
	
	
	
	
	
	
# Put it into TABSI_table2
# send "old_checkout" value to table2 
$sql3= "UPDATE TABSI_table3 SET old_checkout = '". $_POST["old_checkout"]. "'";
	$sql3 .=" WHERE checkout = '". $_GET["checkout"]. "' ";


echo $sql3. '<br>';
mysql_query($sql3) or die(mysql_error());
echo "sql3 = ".$sql3. '<br>'.'<br>';
	

	
	echo $strSQL;
	if($objQuery)
	{
		echo "Save completed.";
		echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
	}
	else
	{
		echo '$$strSQL;'. $strSQL;
		echo "Error Save [".$strSQL."]";
	}
	mysql_close($objConnect);
	
	
	
	
include "./TABSI2/TABSI2_edit3.php";
include "./TABSI3/TABSI3_edit3.php";
?>

<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php"
}
//-->
setTimeout(redirect_page, 0000);

</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
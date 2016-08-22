<?php
  session_start();
  if ($_SESSION["person"] == ""){
		echo '<script type="text/javascript">';
		echo 'window.location = "./instrument.php";';
		echo '</script>';
  }  
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
	$strSQL = "UPDATE instrument_table SET ";
	
	$strSQL .="Assembly_N = '".$_POST["Assembly_N"]."'";
	$strSQL .=", checkout = '".$_POST["checkout"]."'";
	$strSQL .=", ordinal = '".$_POST["ordinal"]."'";

	$strSQL .=", field3 = '".$_POST["field3"]."'";
	$strSQL .=", field4 = '".$_POST["field4"]."'";
	$strSQL .=", field5 = '".$_POST["field5"]."'";
	$strSQL .=", field6 = '".$_POST["field6"]."'";
	$strSQL .=", field7 = '".$_POST["field7"]."'";
	$strSQL .=", field8 = '".$_POST["field8"]."'";
	$strSQL .=", field9 = '".$_POST["field9"]."'";
	
	
	$strSQL .=" WHERE ordinal = '".$_POST["ordinal"]."' ";

echo $strSQL. '<br>'.'<br>';

	# This line update the fields.
	$objQuery = mysql_query($strSQL) or die(mysql_error());
	
	

	
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
	
	
?>

<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./instrument.php"
}
//-->
setTimeout(redirect_page, 1250);

</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
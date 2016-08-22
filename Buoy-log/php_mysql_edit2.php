<html>
<head>
<title>Edit 2</title>
</head>
<body>

<form action="php_mysql_edit3.php?CusID=<?=$_GET["CusID"]; ?>" name="frmEdit" method="post">

<?php
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM tabs_I_setup WHERE Buoy_assembly_number = '".$_GET["CusID"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found CustomerID=".$_GET["CusID"];
	}
	else
	{
	?>


Buoy Assembly Number: 
<input type="text" name="txtCustomerID" size="20" value="<?php echo $objResult["Buoy_assembly_number"];?>"></br>

SeaPac S/N: <input type="text" name="txtName" size="20" value="<?=$objResult["SeaPac_SN"];?>"></br>
Start Date:		<input type="text" name="txtEmail" size="20" value="<?=$objResult["start_date"];?>"></br>
Current Sensor Model/S/N: 
<input type="text" name="txtCountryCode" size="2" value="<?=$objResult["current_sensor_model_SN"];?>"></br>
MicroCat S/N: 		<input type="text" name="txtBudget" size="5" value="<?=$objResult["MicroCat_SN"];?>"></br>
PTT ID#/SN: 	<input type="text" name="txtUsed" size="5" value="<?=$objResult["PTT_ID_SN"];?>"></br>

	  <input type="submit" name="submit" value="submit">

<?
}
mysql_close($objConnect);
?>
</form>
</body>
</html>
<!--- This file download from www.shotdev.com -->
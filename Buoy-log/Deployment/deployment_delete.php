<?php
include ("authorization.php");
?>
<html>
<head>
<title>TABS Deployment, Delete A Record</title>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />

<style type="text/css">
<!--
body
{
background-image:url('blue-shadow.png');
background-repeat:repeat-x;
} 

-->
</style>

</head>
<body bgcolor="c0c8d6">
<center>
<br /><br />
<h2 class="TITLE-STYLE">Deleting A Buoy Deployment Record</h2>
<?php


// echo '<br>'.'$sNetid = '. $sNetid;
// echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];

IF ($_SESSION["person"] == "walpert" or $_SESSION["person"] == "liu-duan" ||
    $_SESSION["person"] == "guinasso")
	{echo " ";}
else{
	echo "This NetID is not authorized";
	echo <<<_END
	<FORM><INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-2)"></FORM>
_END;
	exit;
    }

?>
<h3 class="HEADING-STYLE">
<br />
<br />		

<div id = "tool-bar"> 
 <a href="./deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./CAS-logout">NetID Logout</a>
</div>

<?php

$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());
	
// echo '<br>'. '$_SESSION["person"]: ', $_SESSION["person"].'<br>';

// NetID authorization
IF ($_SESSION["person"] == "liu-duan" or $_SESSION["person"] == "walpert" or $_SESSION["person"] =="guinasso"){
		
	echo '<hr>';	
	echo '<h1>The deletion has completed, and this record is gone.</h1>';
	echo '<hr>';	
	echo "";}
else{
	echo "This NetID is not authorized to delete a record. Please ask LIU Duan to delete the records.";
	echo "";
	echo <<<_END
	<FORM><INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-2)"></FORM>
_END;
	exit;
    }

// Display the record that is going to be deleted.
	$strSQL = "SELECT * FROM deployment_table2 WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found checkout=".$_POST["checkout"].'<br>';
		echo '$strSQL = '. $strSQL. '<br>';
	}
		else
	{

?>

<br>
<table BORDER='1' CELLPADDING=3 width ="600" BGCOLOR="#99CCFF">

 <tr>
<td align="right">checkout:</td><td BGCOLOR="#FFFFCC">			<? echo $objResult["checkout"];?>&nbsp;</td>
<td align="right">Old_checkout:</td><td BGCOLOR="#FFFFCC">     		<? echo $objResult["old_checkout"];?> &nbsp;</td>
<td align="right">site:</td><td BGCOLOR="#FFFFCC">				<? echo $objResult["site"];?>&nbsp; </td></tr>
 
 <tr>
<td align="right">Seapac SN:</td><td BGCOLOR="#FFFFCC"> 			<? echo $objResult["Seapac_SN"];?>&nbsp; </td>
<td align="right">Current Sensor SN:</td><td BGCOLOR="#FFFFCC">  	<? echo $objResult["Current_Sensor_SN"];?>&nbsp;</td>
<td align="right">Current Sensor Model:</td><td BGCOLOR="#FFFFCC"><? echo $objResult["Current_Sensor_model"];?>&nbsp;</td></tr>
<td align="right">Modem Type:</td><td BGCOLOR="#FFFFCC">     		<? echo $objResult["Modem_Type"];?>&nbsp;</td></tr>
</table>
<br />

<table BORDER='1' CELLPADDING=3 width ="600" BGCOLOR="#99CCFF"><tr>
<td align="right">Deployment Ship:</td><td BGCOLOR="#FFFFCC"> 	<? echo $objResult["Deployment_Ship"];?>&nbsp;</td>
<td align="right">Deployment time:</td><td BGCOLOR="#FFFFCC"> 	<? echo $objResult["Dep_time"];?>&nbsp;</td></tr>

<tr>
<td align="right">Recovery Ship:</td><td BGCOLOR="#FFFFCC">     	<? echo $objResult["Recovery_Ship" ];?>&nbsp;</td>
<td align="right">Recovery time:</td><td BGCOLOR="#FFFFCC">  		<? echo $objResult["rec_time"];?>&nbsp;</td></tr>
 
 <tr>
<td align="right">Deployment Days:</td><td BGCOLOR="#FFFFCC"> 	<? echo $objResult["Deployment_days"];?>&nbsp;</td>
<td align="right">Site Inclination:</td><td BGCOLOR="#FFFFCC"> 	<? echo $objResult["inclination"];?>&nbsp;</td></tr>

<tr>
<td align="right">Comments:</td><td BGCOLOR="#FFFFCC" colspan="5">  			<? echo $objResult["Comments"];?>&nbsp;</td></tr>
</table>
 


<?php 
	}

echo '<br>';

# Delete from deployment_table2:
	$objDB = mysql_select_db("tabs_status");
	$strSQL2 = "DELETE FROM deployment_table2 WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL2);
	
	echo '<hr>';	
	echo '<h1>The Above Record Has Been Deleted!</h1>';
	echo '<hr>';	
	
# Delete from deployment_table2:	
	$objDB = mysql_select_db("Metadata");
	$strSQL3 = "DELETE FROM Assemblies WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	// echo "--strSQL3: ". $strSQL3;
	$objQuery = mysql_query($strSQL3);
	
	
	

mysql_close($db_server);

?>


<FORM><INPUT TYPE="BUTTON" VALUE="Deployment History" ONCLICK="history.go(-1)"></FORM>

</h3></center>
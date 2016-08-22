<?php
include ("authorization.php");
?>
<html>
<head>
<title>Deployment Record</title>
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
<br />
<h2 class="TITLE-STYLE"><center>Buoy Deployment Record</center></h2>

<?php 

$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());	
?>   



<br />		
<div id = "tool-bar"> 
 <a href="./deployment.php">Record List</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a>
</div>




<?php
//echo '$_GET[checkout] = '. $_GET["checkout"];
$_GET["checkout"] = substr($_GET["checkout"], 2, -2) ;
//print_r($_GET);



	$objDB = mysql_select_db("tabs_status");
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

<?php 
// echo $strSQL. 'haha<br>';
// echo $objResult["checkout"];
// print_r($objResult);
?>
<br>
<div style="position: relative;
            text-align:justify;
            left: 10%; right: 10%;
            width:80%;" 
class="Heading-STYLE">
 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This buoy record was identified as the File Number x 
<table border="1" style="display: inline; vertical-align:middle;">	<tr>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["checkout"];?>&nbsp;</td></tr></table> &nbsp;and the Old_checkout Number  

<table border="1" style="display: inline; vertical-align:middle;">	<tr  BGCOLOR="#FFFFCC">
<td>    <? echo $objResult["old_checkout"];?>&nbsp; </td></tr></table>.

A current meter was installed in this buoy, and the electronic unit of the current meter had a System Serial Number 
<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 			<? echo $objResult["Seapac_SN"];?>&nbsp; </td></tr></table>. The model of the current sensor was 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td><? echo $objResult["Current_Sensor_model"];?>&nbsp;</td></tr></table>, and the serial number was

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>  	<? echo $objResult["Current_Sensor_SN"];?>&nbsp;</td></tr></table>. The modem type was 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>    		<? echo $objResult["Modem_Type"];?>&nbsp;</td></tr></table>.
<br /><br />


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This buoy was deployed to site
<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>				&nbsp;<? echo $objResult["site"];?>&nbsp; </td></tr></table>&nbsp;by the ship
 
<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 	<? echo $objResult["Deployment_Ship"];?>&nbsp;</td></tr></table> &nbsp;on 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>		<? echo $objResult["Depl_time"];?>&nbsp;</td></tr></table>&nbsp;UTC, and it was recovered by the ship 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>    	<? echo $objResult["Recovery_Ship" ];?>&nbsp;</td></tr></table> &nbsp;on 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 		<? echo $objResult["rec_time"];?>&nbsp;</td></tr></table> &nbsp;UTC after a total of 
 
<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 	<? echo $objResult["Deployment_days"]; ?> &nbsp; </td> </tr> </table> &nbsp; days of deployment. During this period of time the magnetic inclination at the site was 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 	<? echo $objResult["inclination"];?>&nbsp;</td></tr></table>. The comments for the buoy were 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td><? echo $objResult["Comments"];?>&nbsp;</td></tr></table>.

<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This record was last modified by 
<table border="1" style="display: inline; vertical-align:middle;">	<tr  BGCOLOR="#FFFFCC" >
<td> &nbsp;<? echo $objResult["NetID"];?>&nbsp;</td></tr></table>&nbsp;at 

<table border="1" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>&nbsp;<? echo $objResult["Last_change"];?> &nbsp;</td></tr></table> &nbsp;UTC.
 



 </div>
 <br>
 <hr>
<div style="position: relative;
            text-align:center;
            left: 10%; right: 10%;
            width:80%;" 
class="Heading-STYLE">

<form action="deployment.php" method="post" style="display: inline; vertical-align:middle;">
<input type="submit" value="Go To List" /> </form>


<form action="deployment_edit.php?checkout='<?=$objResult["checkout"];?>'" 
method="post" style="display: inline; vertical-align:middle;">
<input type="submit" value="Edit This Record" /> </form>
 </div>

<?php 
	}

mysql_close($db_server);

function get_post($var)
{  
	return mysql_real_escape_string($_POST[$var]);
}
?>
<div id = "bottom">

<br><br><br><br><br>
</div>
</body>
</html>
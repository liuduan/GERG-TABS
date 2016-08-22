<?php
include ("authorization.php");
?>
<html>
<head>
<title>Buoy Metadata</title>
<link rel="stylesheet" href = "./record_style.css" type="text/css" />

<style type="text/css">
<!--
body
{
background-image:url('blue-shadow.png');
background-repeat:repeat-x;
} 
-->
</style>
<style type="text/css">
<!-- -->
table.table_style
{
border-width: 1 2 2px 1px;
border-spacing: 0;
border-collapse: collapse;
border-color:#000;
border-style: solid;
font-size:16px;
}

.table_style td, .table_style th
{
margin: 0;
padding: 3px;
border-width: 1px 1px 0 0;
border-style: solid;
}
</style>

</head>
<body bgcolor="c0c8d6">
<br />
<h2 class="TITLE-STYLE"><center>Buoy Metadata</center></h2>

<?php 

$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());	
?>   



<br />		
<div id = "tool-bar"> 
 <a href="./metadata.php">Select Another</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./CAS-logout">NetID Logout</a>
</div>




<?php
# echo '$_GET[site] = '. $_GET["site"]. '<br>';
# echo '$_GET[Requested_Date] = '. $_GET["Requested_Date"]. '<br>';
# $_GET["file_number"] = substr($_GET["file_number"], 2, -2) ;
# print_r($_GET);



	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM deployment_table2 WHERE site = '".$_GET["site"]."' ";  // <!-- check the data table name -->
    $strSQL .= "AND '". $_GET["Requested_Date"].  "'> Depl_time AND ('";
    $strSQL .= $_GET["Requested_Date"]. "' < rec_time OR rec_time = '0000-00-00')";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo 'No Buoy Metadata was found. <br>';
		echo '$strSQL = '. $strSQL. '<br>';
	}
		else
	{

?>

<?php 
// echo $strSQL. 'haha<br>';
// echo $objResult["File_Number"];
// print_r($objResult);
?>
<br>
<div style="position: relative;
            text-align:justify;
            left: 10%; right: 10%;
            width:80%;" 
class="Heading-STYLE">

The metadata stored in the Buoy Deployment database:<p><ul>
<li>This buoy record was identified as the File Number  
<table class="table_style" style="display: inline; vertical-align:middle;">	<tr>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["File_Number"];?>&nbsp;</td></tr></table> &nbsp;and the old_checkout Number  

<table class="table_style" style="display: inline; vertical-align:middle;">	<tr  BGCOLOR="#FFFFCC">
<td>    <? echo $objResult["old_checkout"];?>&nbsp; </td></tr></table>.<br></li>

<li>
A current meter was installed in this buoy, and the electronic unit of the current meter had a System Serial Number 
<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 			<? echo $objResult["Seapac_SN"];?>&nbsp; </td></tr></table>. The model of the current sensor was 

<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td><? echo $objResult["Current_Sensor_model"];?>&nbsp;</td></tr></table>, and the serial number was

<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>  	<? echo $objResult["Current_Sensor_SN"];?>&nbsp;</td></tr></table>. <br>
</li><li>
A type 
<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>    		<? echo $objResult["Modem_Type"];?>&nbsp;</td></tr></table> modem was installed in this buoy. 
<br /><br />
</li>

<li>This buoy was deployed to site
<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>				&nbsp;<? echo $objResult["site"];?>&nbsp; </td></tr></table>&nbsp;by the ship
 
<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 	<? echo $objResult["Deployment_Ship"];?>&nbsp;</td></tr></table> &nbsp;on 

<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>		<? echo $objResult["Depl_time"];?>&nbsp;</td></tr></table>&nbsp;UTC.<br></li>

<li>It was recovered by the ship 
<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td>    	<? echo $objResult["Recovery_Ship" ];?>&nbsp;</td></tr></table> &nbsp;on 

<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 		<? if (substr($objResult["rec_time"], 0, 4) == "0000") $objResult["rec_time"]="(Not yet recovered)";echo $objResult["rec_time"];?>&nbsp;</td></tr></table> &nbsp;UTC.<br></li>

<li>
During this period of time the magnetic inclination at the site was 
<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td> 	<? echo $objResult["inclination"];?>&nbsp;</td></tr></table>. 

</li><li>Comments for the buoy:

<table class="table_style" style="display: inline; vertical-align:middle;">	<tr BGCOLOR="#FFFFCC">
<td><? echo $objResult["Comments"];?>&nbsp;</td></tr></table>. 
</ul>
<?php 
	}
mysql_close($db_server);
?>






<hr>



<?php 

$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());	

	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM equipment_table WHERE file_number = '". $objResult["File_Number"]. "' ";  
	// <!-- check the data table name -->

	# echo $strSQL;
	# echo '<hr>';
	$objQuery = mysql_query($strSQL);
	# $objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "No Instrument Installation data was found.".'<br>';
		echo '$strSQL = '. $strSQL. '<br>';
	}
		else
	  {
?>
<br>
The following are metadata stored in the Instrument Installation database for this buoy:

<p>
<table border="1">
  <tr BGCOLOR="#99CCFF">
    <th WIDTH="140">File Number</th>
    <th> old_checkout</th>
    <th> Edit</th>
    <th>Instrument_N</th>
    <th>Type</th>
    <th> Sensor Manufacture</th>
    <th WIDTH="160"> Sensor Model</th>
    <th> Sensor S/N</th>
    <th WIDTH="100">Range</th>
    <th> Unit</th>
    <th>Site</th>
  </tr>






<?php
while($objResult = mysql_fetch_array($objQuery))				# get data row by row
{
?>
  <tr BGCOLOR="#FFFFCC">
    <td><div align="center"><?=$objResult["file_number"];?></div></td>
    <td><div align="center"><?=$objResult["old_checkout"];?></div></td>
        <td align="center">
    <a href="./instrument_edit2.php?instrument_n=<?=$objResult["instrument_n"];?>">
    	Edit</a> </td>
    <td><div align="center"><?=$objResult["instrument_n"];?></div></td>
    <td><div align="center"><?=$objResult["field3"];?></div></td>
    <td><div align="center"><?=$objResult["field4"];?></div></td>
    <td align="center"><?=$objResult["field5"];?></td>
    <td align="center"><?=$objResult["field6"];?></td>
    <td><div align="center"><?=$objResult["field7"];?></div></td>
    <td><div align="center"><?=$objResult["field8"];?></div></td>
    <td width="200"><div align="center"><?=$objResult["field9"];?></div></td>
  </tr>
<?php
}
?>
</table>




 

<?php 
	}
mysql_close($db_server);
?>




 </div>
 <br>
 <hr>
<div style="position: relative;
            text-align:center;
            left: 10%; right: 10%;
            width:80%;" 
class="Heading-STYLE">

<form action="metadata.php" method="post" style="display: inline; vertical-align:middle;">
<input type="submit" value="Select Another" /> </form>

 </div>













<?php 
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
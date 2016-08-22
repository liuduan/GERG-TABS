<?php
include ("authorization.php");
?>

<html>
<head>
<title>Buoy Metadata Report</title>
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


</head>
<body bgcolor="c0c8d6">


<a href="./deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;







<?php 

$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());	


//echo '$_GET[checkout] = '. $_GET["checkout"];
$_GET["checkout"] = substr($_GET["checkout"], 1, -1) ;
//print_r($_GET);



$objDB = mysql_select_db("tabs_status");
$strSQL = "SELECT * FROM deployment_table2 WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

//Find out the buoy type by join tables.
$objDB_2nd = mysql_select_db("Metadata");
$strSQL_2nd = "SELECT Model FROM Metadata.Components JOIN Metadata.Assemblies".
	" ON Components.Component_N = Assemblies.Component_N".
	' WHERE checkout = "'. $_GET["checkout"]. '"'. 
    ' AND Component_type = "System" LIMIT 1';
// echo $strSQL_2nd;
$objQuery_2nd = mysql_query($strSQL_2nd);
$objResult_2nd = mysql_fetch_array($objQuery_2nd);


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
<h3 class="HEADING-STYLE"><center>Buoy Metadata Report for Site <? echo $objResult["site"];?></center></h3>
<div style="position: relative;
			top: 0%;
            text-align:justify;
            left: 5%; right: 5%;
            width:90%;" 
class="plain-STYLE">

<bold>Deployment: </bold><br>

This buoy is identified as Checkout: 
<table border="0" style="display: inline; vertical-align:middle; line-height: 12px;" class="plain-STYLE">	<tr>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult["checkout"];?>&nbsp;</td></tr></table>, 

model:
<table border="0" style="display: inline; vertical-align:middle; line-height: 12px;" class="plain-STYLE">	<tr>
<td  BGCOLOR="#FFFFCC">	<? echo $objResult_2nd["Model"];?>&nbsp;</td></tr></table> buoy.
<br />

This buoy was deployed to site
<table border="0" style="display: inline; vertical-align:middle; line-height: 12px;" class="plain-STYLE">	<tr BGCOLOR="#FFFFCC">
<td>				&nbsp;<? echo $objResult["site"];?>&nbsp; </td></tr></table>&nbsp;by the ship
 
<table border="0" style="display: inline; vertical-align:middle; line-height: 12px;" class="plain-STYLE">	<tr BGCOLOR="#FFFFCC">
<td> 	<? echo $objResult["Deployment_Ship"];?>&nbsp;</td></tr></table> &nbsp;on 

<table border="0" style="display: inline; vertical-align:middle; line-height: 12px;" class="plain-STYLE">	<tr BGCOLOR="#FFFFCC">
<td>		<? echo $objResult["Depl_time"];?>&nbsp;</td></tr></table>&nbsp;UTC. 

<br>
<?php
if ($objResult["Recovery_Ship" ] == "" and $objResult["rec_time"] == "0000-00-00 00:00:00"){
	echo "This buoy has not been recovered.";}
	else
		{echo 'It was recovered by the ship <table border="0" style="display: inline; vertical-align:middle; line-height: 12px;" class="plain-STYLE"><tr BGCOLOR="#FFFFCC">
			<td>';
		echo $objResult["Recovery_Ship" ];
		echo '&nbsp;</td></tr></table> &nbsp;on
		
			<table border="0" style="display: inline; vertical-align:middle; line-height: 12px;" class="plain-STYLE">	<tr BGCOLOR="#FFFFCC">		
			<td> ';
			
		echo $objResult["rec_time"];
		echo '&nbsp;</td></tr></table> &nbsp;UTC.<br> <br> ';} // end of if else

	}  // close server
mysql_close($db_server);
?>



<br><br>
<bold>Major Components in this Buoy:</bold>

<?php 
$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());

if ($objResult["Depl_time"]>"2011-05-07"){
 
$objDB = mysql_select_db("Metadata");


$query = "SELECT Assemblies.*, Components.* ".
 	"FROM Assemblies, Components ".
	"WHERE Assemblies.Component_N = Components.Component_N ".
	"ORDER BY Components.Component_N"; 


// List system: 
$result = mysql_query($query) or die(mysql_error());
// Print out the contents of each row into a table 
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "System")){
		// print_r($row);
		//echo "<br /><br />";
		//echo "Component Number: ". $row['Component_N']. ", ";
		//echo "Component_type: ". $row['Component_type']. "<br />";
		echo "<br />The system serial number was: $row[Serial_N].";
		}		// end of if system.
}				// end of while $row available.

// List Hull:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Hull")){
		echo "<br />The hull serial number was: $row[Serial_N].";
		}		// end of if Hull
}				// end of while $row available.
		
// List Current Meter:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Current Meter")){
		echo "<br /><br />The current meter was an $row[Manufacture] $row[Model], ";
		echo "with a serial number $row[Serial_N]. ";
		echo "It was purchased on $row[Date_received].";
		echo "<br />The current meter measurement range: $row[Sensor_range].";		
		echo "<br />The current meter accuracy: $row[Factory_accuracy].<br />";	
		echo 'For more details, <a href = "../../Metadata/Manuals/Manuals.php?Manufacture=';
		echo $row[Manufacture]. '" target = _blank>the manual is available here.</a><br />';
		if ($row['Calibration_notes'] <> ""){
			echo "The calibration information: $row[Calibration_notes].<br />";
			} //end if calibration_Note
		// echo '<br>';	
		}		// end of if Current Meter
}	//End of while $row available.
		
// List Anemometer:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Anemometer")){
		echo "<br />The anemometer was a $row[Manufacture] $row[Model], ";
		echo "with a serial number $row[Serial_N]. ";
		echo "It was purchased on $row[Date_received].";
		echo "<br />The anemometer measurement range: $row[Sensor_range]";		
		echo "<br />The anemometer accuracy: $row[Factory_accuracy]<br />";	
		echo 'For more details, <a href ="../../Metadata/Manuals/Manuals.php?Manufacture='. $row[Manufacture]. 
			'" target = _blank>the manual is available here.</a><br />';
		if ($row['Calibration_notes'] <> ""){
			echo "The calibration information: $row[Calibration_notes]<br />";
			} //end if calibration_Note
		}		// end of if anemometer
}	//End of while $row available.


// List Pressure Sensor:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Pressure Sensor")){
		echo "<br />The pressure sensor was a $row[Manufacture] $row[Model], ";
		echo "with a serial number $row[Serial_N]. ";
		echo "It was purchased on $row[Date_received].";
		echo "<br />The pressure sensor measurement range: $row[Sensor_range].";		
		echo "<br />The pressure sensor accuracy: $row[Factory_accuracy].<br />";	
		echo 'For more details, <a href ="../../Metadata/Manuals/Manuals.php?Manufacture='. $row[Manufacture]. 
			'" target = _blank>the manual is available here.</a><br />';
		if ($row['Calibration_notes'] <> ""){
			echo "The calibration information: $row[Calibration_notes]<br />";
			} //end if calibration_Note
		}		// end of if Pressure Sensor
}	//End of while $row available.

// List Conductivity/Temp Senso:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Conductivity/Temp Sensor")){
		echo "<br />The conductivity/temp sensor was a $row[Manufacture] $row[Model], ";
		echo "with a serial number $row[Serial_N]. ";
		echo "It was purchased on $row[Date_received].";
		echo "<br />The conductivity/temp sensor measurement range: $row[Sensor_range].";		
		echo "<br />The conductivity/temp sensor accuracy: $row[Factory_accuracy].<br />";	
		echo 'For more details, <a href ="../../Metadata/Manuals/Manuals.php?Manufacture='. $row[Manufacture]. 
			'" target = _blank>the manual is available here.</a><br />';
		if ($row['Calibration_notes'] <> ""){
			echo "The calibration information: $row[Calibration_notes]<br />";
			} //end if calibration_Note
		}		// end of if Conductivity/Temp Sensor
}	//End of while $row available.


// List Temp/Humidity Sensor:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Temp/Humidity Sensor")){
		echo "<br />The temperature/humidity sensor was a $row[Manufacture] $row[Model], ";
		echo "with a serial number $row[Serial_N]. ";
		echo "It was purchased on $row[Date_received].";
		echo "<br />The temperature/humidity sensor measurement range: $row[Sensor_range].";		
		echo "<br />The temperature/humidity sensor accuracy: $row[Factory_accuracy].<br />";	
		echo 'For more details, <a href ="../../Metadata/Manuals/Manuals.php?Manufacture='. $row[Manufacture]. 
			'" target = _blank>the manual is available here.</a><br />';
		if ($row['Calibration_notes'] <> ""){
			echo "The calibration information: $row[Calibration_notes]<br />";
			} //end if calibration_Note
		}		// end of if temperature/humidity sensor
}	//End of while $row available.



// List Air All-In-One:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Air All-In-One")){
		echo "<br />The Air All-In-One sensor was a $row[Manufacture] $row[Model], ";
		echo "with a serial number $row[Serial_N]. ";
		echo "It was purchased on $row[Date_received].";
		echo "<br />The Air All-In-One sensor measurement range: $row[Sensor_range].";		
		echo "<br />The Air All-In-One sensor accuracy: $row[Factory_accuracy].<br />";	
		echo 'For more details, <a href ="../../Metadata/Manuals/Manuals.php?Manufacture='. $row[Manufacture]. 
			'" target = _blank>the manual is available here.</a><br />';
		if ($row['Calibration_notes'] <> ""){
			echo "The calibration information: $row[Calibration_notes]<br /><br />";
			} //end if calibration_Note
		}		// end of if Air All-In-One
}	//End of while $row available.


// List Accelerometer:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Accelerometer")){
		echo "<br />The accelerometer was a $row[Manufacture] $row[Model], ";
		echo "with a serial number $row[Serial_N]. ";
		echo "It was purchased on $row[Date_received].";
		echo "<br />The accelerometer measurement range: $row[Sensor_range].";		
		echo "<br />The accelerometer accuracy: $row[Factory_accuracy].<br />";	
		echo 'For more details, <a href ="../../Metadata/Manuals/Manuals.php?Manufacture='. $row[Manufacture]. 
			'" target = _blank>the manual is available here.</a><br />';
		if ($row['Calibration_notes'] <> ""){
			echo "The calibration information: $row[Calibration_notes].<br /><br />";
			} //end if calibration_Note
		}		// end of if Accelerometer
}	//End of while $row available.


}		// end of if date > 2011-05-07


else {		// date later than 2011-05-07


	mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());	

	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM instrument_table WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->

	# echo $strSQL;
	# echo '<hr>';
	$objQuery = mysql_query($strSQL);
	# $objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found checkout = ".$_GET["checkout"].'<br>';
		echo '$strSQL = '. $strSQL. '<br>';
	}
		else
	  {
?>



<br>
<table border="1">
  <tr BGCOLOR="#99CCFF">
    <th WIDTH="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checkout&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th> Edit</th>
    <th>ordinal</th>
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
    <td><div align="center"><?=$objResult["checkout"];?></div></td>
        <td align="center">
    <a href="./instrument_edit2.php?ordinal=<?=$objResult["ordinal"];?>">
    	Edit</a> </td>
    <td><div align="center"><?=$objResult["ordinal"];?></div></td>
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

<form action="deployment.php" method="post" style="display: inline; vertical-align:middle;">
<input type="submit" value="Go To List" /> </form>


<form action="deployment_edit.php?checkout='<?=$objResult["checkout"];?>'" 
method="post" style="display: inline; vertical-align:middle;">
<input type="submit" value="Edit This Record" /> </form>
 </div>


<?php 
function get_post($var){  
	return mysql_real_escape_string($_POST[$var]);
}	// end of the function get_post.

} // for the else of deployment date (earlier than 2011-05-07

?>
				
				

<br>
<a href="../../Buoy-log/Deployment/deployment.php" target="_new">Back to Deployment History</a>



<div id = "bottom">

<br><br><br><br><br>
</div>
</body>
</html>
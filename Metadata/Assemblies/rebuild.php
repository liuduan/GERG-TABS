<?php
  session_start();
  global $sNetid, $sUin;
  require_once '../cas.php';

  if ($_SESSION["person"] == ""){
	    getCAS();
  		$_SESSION["person"] = $sNetid;
  }
?>
<html>
<head>
<title>Buoy Rebuilding</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />

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
<h2 class="TITLE-STYLE"><center>Buoy Rebuilding</center></h2>

<?php 

$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());	
?>   



<br />		
<div id = "tool-bar"> 
 <a href="./deployment.php">Record List</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a>
</div>


<center>

Please give a new Assembly number:_____

<?php
//echo '$_GET[Assembly_N] = '. $_GET["Assembly_N"];
// $_GET["Assembly_N"] = substr($_GET["Assembly_N"], 2, -2) ;
//print_r($_GET);



	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM deployment_table2 WHERE Assembly_N = '".$_GET["Assembly_N"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found Assembly_N=".$_POST["Assembly_N"].'<br>';
		echo '$strSQL = '. $strSQL. '<br>';
	}
		else
	{

?>

<?php 
	}
mysql_close($db_server);
?>











<hr>

Major components in this buoy:

<?php 
$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());

if ($objResult["Depl_time"]>"2012-04-21"){
 
$objDB = mysql_select_db("Metadata");


$query = "SELECT Assemblies.*, Components.* ".
 	"FROM Assemblies, Components ".
	"WHERE Assemblies.Component_N = Components.Component_N ".
	"ORDER BY Components.Component_N"; 
	 



print <<<END
<table border="1">
  <tr BGCOLOR="#99CCFF"><th>Ordinal <br> Component Number</th><th>Remove</th><th>Component type</th><th>Date_received</th><th>Manufacture</th><th>Model</th>
    <th>S/N</th> <th>Current Location</th>
  </tr>
END;

// List system: 
$result = mysql_query($query) or die(mysql_error());

// Print out the contents of each row into a table 
while($row = mysql_fetch_array($result)){
	if (($row['Assembly_N']==$_GET['Assembly_N']) AND ($row['Component_type'] == "System")){
		// print_r($row);
		//echo "<br /><br />";
		//echo "Component Number: ". $row['Component_N']. ", ";
		//echo "Component_type: ". $row['Component_type']. "<br />";
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
			
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	Remove</a> </td>
    		<td><div align="center">$row[Date_received]</div></td>
    		<td><div align="center">$row[Manufacture]</div></td>
    		<td><div align="center">$row[Model]</div></td>
    		<td align="center">$row[Serial_N]</td>
    		<td align="center">$row[Current_location]</td>
  			</tr>
END;
		}		// end of if system.
}				// end of while $row available.

// List Hull:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['Assembly_N']==$_GET['Assembly_N']) AND ($row['Component_type'] == "Hull")){
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	Remove</a> </td>
    		<td><div align="center">$row[Date_received]</div></td>
    		<td><div align="center">$row[Manufacture]</div></td>
    		<td><div align="center">$row[Model]</div></td>
    		<td align="center">$row[Serial_N]</td>
    		<td align="center">$row[Current_location]</td>
  			</tr>
END;
		}		// end of if Hull
}				// end of while $row available.
		
// List Everything Else:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['Assembly_N']==$_GET['Assembly_N']) AND ($row['Component_type'] != "System") AND  ($row['Component_type'] != "Hull")){
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	Remove</a> </td>
    		<td><div align="center">$row[Date_received]</div></td>
    		<td><div align="center">$row[Manufacture]</div></td>
    		<td><div align="center">$row[Model]</div></td>
    		<td align="center">$row[Serial_N]</td>
    		<td align="center">$row[Current_location]</td>
  			</tr>
END;
		}		// end of if not system and not hull
}				// end of while $row available.

echo '</table>';

}		// end of if date > 2012-09-20





else {		// date later than 2012-04-21


	mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());	

	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM instrument_table WHERE Assembly_N = '".$_GET["Assembly_N"]."' ";  // <!-- check the data table name -->

	# echo $strSQL;
	# echo '<hr>';
	$objQuery = mysql_query($strSQL);
	# $objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found Assembly_N = ".$_GET["Assembly_N"].'<br>';
		echo '$strSQL = '. $strSQL. '<br>';
	}
		else
	  {
?>



<br>
<table border="1">
  <tr BGCOLOR="#99CCFF">
    <th WIDTH="140">Assembly Number</th>
    <th> Checkout</th>
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
    <td><div align="center"><?=$objResult["Assembly_N"];?></div></td>
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


<form action="deployment_edit.php?Assembly_N='<?=$objResult["Assembly_N"];?>'" 
method="post" style="display: inline; vertical-align:middle;">
<input type="submit" value="Edit This Record" /> </form>
 </div>


<?php 
function get_post($var){  
	return mysql_real_escape_string($_POST[$var]);
}	// end of the function get_post.

} // for the else of deployment date (earlier than 2012-04-21

?>
				
				
<br>
<a href="../../Metadata/Assemblies/Assemble.php" target="_new">Assemble Another Buoy</a>
<br><br>
<a href="../../Buoy-log/Deployment/deployment.php" target="_new">Deployment History</a>



<div id = "bottom">

<br><br><br><br><br>
</div>
</body>
</html>
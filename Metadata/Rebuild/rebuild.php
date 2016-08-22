<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<html>
<head>
<title>Buoy Rebuilding</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />

<style type="text/css">
<!--
body
{
background-image:url('../blue-shadow.png');
background-repeat:repeat-x;
} 
-->
</style>


</head>
<body bgcolor="c0c8d6">
<br />
<h2 class="TITLE-STYLE"><center>Buoy Rebuilding</center></h2>
	
<div id = "tool-bar"> 
 <a href="../../Buoy-log/Deployment/deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./Rebuild_entry.php">Rebuild Entry</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../Buoy-components/Components.php" target="_blank">Components</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a>
</div>


<center>


<?php 
// echo "GET array:";
// print_r($_GET);

print <<<END
<h3 class="SUB_TITLE-STYLE"> The New Assembly Number is: $_GET[New_checkout]. </H3>
<h3 class="HEADING-STYLE"> (It Was Rebuilt From: $_GET[Old_checkout])</h3>
END;
?>











<h3 class="SUB_TITLE-STYLE"> Major components in this buoy:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<form action="Add_others.php?New_checkout=<?php echo $_GET[New_checkout];?>&Old_checkout=<? echo $_GET['Old_checkout'];?>" 
	method="post" style="display: inline; vertical-align:middle;">
<input type="submit" value="Add Other Components" /> </form>

</h3>

<?php 
$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());

$objDB = mysql_select_db("Metadata");


$query = "SELECT Assemblies.*, Components.* ".
 	"FROM Assemblies, Components ".
	"WHERE Assemblies.Component_N = Components.Component_N ".
	"ORDER BY Components.Component_N"; 
	 

print <<<END
<table border="1">
  <tr BGCOLOR="#99CCFF"><th>Ordinal <br> Component Number</th><th>Component type</th><th>Remove</th><th>Date_received</th><th>Manufacture</th><th>Model</th>
    <th>S/N</th> <th>Current Location</th>
  </tr>
END;


// List system: 
$result = mysql_query($query) or die(mysql_error());

// Print out the contents of each row into the table 
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['New_checkout']) AND ($row['Component_type'] == "System")){

				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
			
			
						
        <td align="center">
	    <a href="./Remove.php?Assembly_ordinal=$row[Ordinal]&New_checkout=$_GET[New_checkout]&Old_checkout=$_GET[Old_checkout]">

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
	if (($row['checkout']==$_GET['New_checkout']) AND ($row['Component_type'] == "Hull")){
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
        <td align="center">
    <a href="./Remove.php?Assembly_ordinal=$row[Ordinal]&New_checkout=$_GET[New_checkout]&Old_checkout=$_GET[Old_checkout]">
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
	if (($row['checkout']==$_GET['New_checkout']) AND ($row['Component_type'] != "System") AND  ($row['Component_type'] != "Hull")){
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../../Metadata/Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
        <td align="center">
    <a href="./Remove.php?Assembly_ordinal=$row[Ordinal]&New_checkout=$_GET[New_checkout]&Old_checkout=$_GET[Old_checkout]">
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







?>



</table>




 

<?php 

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

 </div>

		


<div id = "bottom">

<br><br><br><br><br>
</div>
</body>
</html>
<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<html>
<head>
<title>Buoy Assembly Components</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />

<script type="text/javascript">
// If the length of the element's string is 0 then display helper message   
function required(inputtx)   {  
     if (inputtx.value.length == 0)  {   
         alert("The new buoy Assembly Number should not be blank.");   
		 inputtx.focus();     
         return false;   
      }       
      return true;   
}   	
</script>





</head>
<body>

<h2 class="STYLE3"><center>Components in Buoy Assembly Number: <?php echo $_GET["checkout"]; ?></h2>
<?php
$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("Metadata");


$query = "SELECT Assemblies.*, Components.* ".
 	"FROM Assemblies, Components ".
	"WHERE Assemblies.Component_N = Components.Component_N ".
	"ORDER BY Components.Component_N"; 
	 



print <<<END
<table border="1">
  <tr BGCOLOR="#99CCFF"><th>Ordinal <br> Component Number</th><th>Component type</th><th>Date_received</th><th>Manufacture</th><th>Model</th>
    <th>S/N</th> <th>Current Location</th>
  </tr>
END;

// List system: 
$result = mysql_query($query) or die(mysql_error());

// Print out the contents of each row into a table 
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "System")){
		// print_r($row);
		//echo "<br /><br />";
		//echo "Component Number: ". $row['Component_N']. ", ";
		//echo "Component_type: ". $row['Component_type']. "<br />";
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
    		<td><div align="center">$row[Date_received]</div></td>
    		<td><div align="center">$row[Manufacture]</div></td>
    		<td><div align="center">$row[Model]</div></td>
    		<td align="center">$row[Serial_N]</td>
    		<td align="center">$row[Current_location]</td>
  			</tr>
END;
		}
}

// List Hull:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] == "Hull")){
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
    		<td><div align="center">$row[Date_received]</div></td>
    		<td><div align="center">$row[Manufacture]</div></td>
    		<td><div align="center">$row[Model]</div></td>
    		<td align="center">$row[Serial_N]</td>
    		<td align="center">$row[Current_location]</td>
  			</tr>
END;
		}
}
		
// List Everything Else:
$result = mysql_query($query) or die(mysql_error());		
while($row = mysql_fetch_array($result)){
	if (($row['checkout']==$_GET['checkout']) AND ($row['Component_type'] != "System") AND  ($row['Component_type'] != "Hull")){
				print <<<END
  			<tr BGCOLOR="#FFFFCC">
        <td align="center">
    <a href="../Buoy-components/Components_edit2.php?Component_N= $row[Component_N]" target=_blank>
    	$row[Component_N]</a> </td>
			<td><div align="center">$row[Component_type]</div></td>
    		<td><div align="center">$row[Date_received]</div></td>
    		<td><div align="center">$row[Manufacture]</div></td>
    		<td><div align="center">$row[Model]</div></td>
    		<td align="center">$row[Serial_N]</td>
    		<td align="center">$row[Current_location]</td>
  			</tr>
END;
		}
}
		
		
		


echo '</table>';

mysql_close($objConnect);
?>
<br>
<a href="./Assemble.php" target="_new">Assemble Another Buoy</a>
<br><br>
<a href="../../Buoy-log/Deployment/deployment.php" target="_new">Deployment History</a>



</body>
</html>
<!--- This file download from www.shotdev.com -->
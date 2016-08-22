<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<html>
<head>
<title>Add Other Components</title>
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
<center>
<h2 class="STYLE3">To Add Other Components to the Buoy</h2>


<?php

if ($_GET["New_checkout"] == ""){
	$_GET["New_checkout"] = $_GET["System_Number"] . "-". $_GET["Start_Date"];
	}
	
print <<<END
<h3 class="SUB_TITLE-STYLE"> The Current Assembly Number is: $_GET[New_checkout]. </H3>
<h3 class="HEADING-STYLE"> (It Was Rebuilt From: $_GET[Old_checkout])</h3>
END;



// echo print_r($_GET);

?>


<div id = "tool-bar"> 
 <a href="../../Buoy-log/Deployment/deployment.php">Deployment History</a>
 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="../Buoy-components/Components.php" target="_blank">New Component</a>
 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a>
</div>

<form name="form1"  action="./Insert_others.php" method="get" bgcolor ="red" 
style="display: inline; vertical-align:middle;">	

<INPUT TYPE=HIDDEN NAME="Old_checkout" value="<?=$_GET["Old_checkout"];?>">
<INPUT TYPE=HIDDEN NAME="New_checkout" value="<?=$_GET["New_checkout"];?>">


<h2 class="STYLE3"><center>Please choose a System: </h2>


<?php
$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("Metadata");
if  ($_GET['order'] == "") $_GET['order'] = "ORDER BY Component_N DESC"; 
$strSQL = "SELECT * FROM Components  ". $_GET['order']; 


print <<<END
<table border="1">
  <tr BGCOLOR="#99CCFF"><th>Component Number</th><th> Select</th><th>Date_received</th><th>Manufacture</th><th>Model</th>
    <th>S/N</th> <th>Current Location</th>
  </tr>
END;

$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");	
while($objResult = mysql_fetch_array($objQuery)){	
	if ($objResult["Component_type"] == "System"){
		print <<<END
  			<tr BGCOLOR="#FFFFCC">
    		<td><div align="center">$objResult[Component_N]</div></td>
        	<td align="center">
			<input type="radio" name="Sys_Component_N" value="$objResult[Component_N]"> </td>
    		<td><div align="center">$objResult[Date_received]</div></td>
    		<td><div align="center">$objResult[Manufacture]</div></td>
    		<td><div align="center">$objResult[Model]</div></td>
    		<td align="center">$objResult[Serial_N]</td>
    		<td align="center">$objResult[Current_location]</td>
  			</tr>
END;
	}
}
echo '</table>';




print <<<END
<br>
<h2 class="STYLE3"><center>Please choose a Hull: </h2>
<table border="1">
  <tr BGCOLOR="#99CCFF"><th>Component Number</th><th> Select</th><th>Date_received</th><th>Manufacture</th><th>Model</th>
    <th>S/N</th> <th>Current Location</th>
  </tr>
END;

$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");	
while($objResult = mysql_fetch_array($objQuery)){	
	if ($objResult["Component_type"] == "Hull"){
		print <<<END
  			<tr BGCOLOR="#FFFFCC">
    		<td><div align="center">$objResult[Component_N]</div></td>
        	<td align="center">
			<input type="radio" name="Hull_Component_N" value="$objResult[Component_N]"> </td>
    		<td><div align="center">$objResult[Date_received]</div></td>
    		<td><div align="center">$objResult[Manufacture]</div></td>
    		<td><div align="center">$objResult[Model]</div></td>
    		<td align="center">$objResult[Serial_N]</td>
    		<td align="center">$objResult[Current_location]</td>
  			</tr>
END;
	}
}
echo '</table>';



print <<<END
<br>
<h2 class="STYLE3"><center>Please choose other buoy components: </h2>
<table border="1">
  <tr BGCOLOR="#99CCFF"><th>Component Number</th><th>Component Type</th><th> Select</th><th>Date_received</th><th>Manufacture</th>
  <th>Model</th><th>S/N</th> <th>Current Location</th>
  </tr>
END;

$strSQL = "SELECT * FROM Components ORDER BY Component_type"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");	
while($objResult = mysql_fetch_array($objQuery)){	
	if ($objResult["Component_type"] != ("Hull") AND  $objResult["Component_type"] != ("System") ){
		print <<<END
  			<tr BGCOLOR="#FFFFCC">
    		<td><div align="center">$objResult[Component_N]</div></td>
    		<td><div align="center">$objResult[Component_type]</div></td>
        	<td align="center">
			<input type="checkbox" name="$objResult[Component_N]" value="$objResult[Component_N]"> </td>
    		<td><div align="center">$objResult[Date_received]</div></td>
    		<td><div align="center">$objResult[Manufacture]</div></td>
    		<td><div align="center">$objResult[Model]</div></td>
    		<td align="center">$objResult[Serial_N]</td>
    		<td align="center">$objResult[Current_location]</td>
  			</tr>
END;
	}
}
echo '</table>';


?>


<br>
<input type="submit" value="Add New Components" />

</form>





<?php
mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
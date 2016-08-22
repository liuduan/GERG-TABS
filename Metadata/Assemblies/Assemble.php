<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<html>
<head>
<title>Assemble</title>
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
<h2 class="STYLE3"><center>To Assemble a Buoy</h2>

<h2 class="STYLE3"><center>Step 1. </h2>

<form name="form1"  action="./Assemblies_insert.php" onSubmit="return required(document.form1.checkout)" method="get" bgcolor ="red" 
style="display: inline; vertical-align:middle;">	

<table BORDER='0' CELLPADDING=3>
<tr BGCOLOR="#99CCFF" class="HEADING-STYLE"><td align="right" width ="340">What is the New Buoy Assembly Number: </td>
<td>
<input name="checkout">
</td>
</tr>

</table>
<br><br>


<h2 class="STYLE3"><center>Step 2. Please choose a System: </h2>


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
<h2 class="STYLE3"><center>Step 3. Please choose a Hull: </h2>
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
<h2 class="STYLE3"><center>Step 4. Please choose other buoy components: </h2>
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
<input type="submit" value="Add A New Assembly" />

</form>





<?php
mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
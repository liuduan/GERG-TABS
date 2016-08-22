<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<html>
<head>
<title>Buoy Components</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />
</head>
<body  bgcolor="#bdc7d6">
<center><h2 class="STYLE3">Buoy Components</h2>

<form name="Insert" action="./Components_insert.php" method="get" bgcolor ="red" 
style="display: inline; vertical-align:middle;">	

<table BORDER='0' CELLPADDING=3>
<tr BGCOLOR="#99CCFF" class="HEADING-STYLE"><td align="right" width ="180">New Component Type: </td>
<td>

<select name="Component_type">
<option value="Others">Others</option>
<option value="System">System</option>
<option value="Hull">Hull</option>
<option value="Current Meter">Current Meter</option>
<option value="Conductivity/Temp Sensor">Conductivity/Temp Sensor</option>
<option value="Pressure Sensor">Pressure Sensor</option>
<option value="Accelerometer">Accelerometer</option>
<option value="Air All-In-One">Air All-In-One</option>
<option value="Anemometer">Anemometer</option>
<option value="Temp/Humidity Sensor">Temp/Humidity Sensor</option>
<option value="Compass">Compass</option>
<option value="Data Modem">Data Modem</option>
<option value="GPS">GPS</option>
</select></td>

<td>
<input type="submit" name="mysubmit" value="Add A New Component" />
</td></tr>
</form>
</table>

<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="../../Buoy-log/Deployment/deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>


<?php
$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("Metadata");
if  ($_GET['order'] == "") $_GET['order'] = "ORDER BY Component_N DESC"; 
$strSQL = "SELECT * FROM Components  ". $_GET['order']; 



$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");				# $objQuery is the Resource
?>


<?php
if ($_SESSION['Component_N'] == "ASC") $_SESSION['Component_N'] = "DESC"; else $_SESSION['Component_N'] = "ASC";
if ($_SESSION['Component_type'] == "ASC") $_SESSION['Component_type'] = "DESC"; else $_SESSION['Component_type'] = "ASC";
if ($_SESSION['Date_received'] == "ASC") $_SESSION['Date_received'] = "DESC"; else $_SESSION['Date_received'] = "ASC";

if ($_SESSION['Manufacture'] == "ASC") $_SESSION['Manufacture'] = "DESC"; else $_SESSION['Manufacture'] = "ASC";
if ($_SESSION['Model'] == "ASC") $_SESSION['Model'] = "DESC"; else $_SESSION['Model'] = "ASC";
if ($_SESSION['Serial_N'] == "ASC") $_SESSION['Serial_N'] = "DESC"; else $_SESSION['Serial_N'] = "ASC";

if ($_SESSION['Current_location'] == "ASC") $_SESSION['Current_location'] = "DESC"; else $_SESSION['Current_location'] = "ASC";
if ($_SESSION['field7'] == "ASC") $_SESSION['field7'] = "DESC"; else $_SESSION['field7'] = "ASC";
if ($_SESSION['field8'] == "ASC") $_SESSION['field8'] = "DESC"; else $_SESSION['field8'] = "ASC";
if ($_SESSION['field9'] == "ASC") $_SESSION['field9'] = "DESC"; else $_SESSION['field9'] = "ASC";


# echo '$_POST["order"] = '. $_POST["order"];
# echo '$_GET["order"] = '. $_GET["order"];

?>
<table border="1">
  <tr BGCOLOR="#99CCFF">
    <th> <form action="Components.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Component_N <?php echo $_SESSION['Component_N'];?>" />
<input type="submit" name="mysubmit" value="Ordinal" /></form></th>

    <th> <form action="Components.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Component_type <?php echo $_SESSION['Component_type'];?>" />
<input type="submit" name="mysubmit" value="Component Type" /></form></th>

    <th> Edit</th>

    <th> <form action="Components.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Date_received <?php echo $_SESSION['Date_received'];?>" />
<input type="submit" name="mysubmit" value="Date_received" /></form></th>

    <th> <form action="Components.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Manufacture <?php echo $_SESSION['Manufacture'];?>" />
<input type="submit" name="mysubmit" value="Manufacture" /></form></th>


    <th> <form action="Components.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Model <?php echo $_SESSION['Model'];?>" />
<input type="submit" name="mysubmit" value="Model" /></form></th>

    <th> <form action="Components.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Serial_N <?php echo $_SESSION['Serial_N'];?>" />
<input type="submit" name="mysubmit" value="S/N" /></form></th>

    <th> <form action="Components.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Current_location <?php echo $_SESSION['Current_location'];?>" />
<input type="submit" name="mysubmit" value="Current Location" /></form></th>


  </tr>
  
<?php
while($objResult = mysql_fetch_array($objQuery))				# get data row by row
{
	
		$n = $n + 1;
?>
  <tr <?php if ($n % 3){echo 'BGCOLOR="#C4E1FF"';}
  else {echo 'BGCOLOR="#FFFFCC"';} ?>align="center" >
	
    <td><div align="center"><?=$objResult["Component_N"];?></div></td>
    <td><div align="center"><?=$objResult["Component_type"];?></div></td>
        <td align="center">
    <a href="./Components_edit2.php?Component_N=<?=$objResult["Component_N"];?>">
    	Edit</a> </td>
    <td><div align="center"><?=$objResult["Date_received"];?></div></td>
    <td><div align="center"><?=$objResult["Manufacture"];?></div></td>
    <td><div align="center"><?=$objResult["Model"];?></div></td>
    <td align="center"><?=$objResult["Serial_N"];?></td>
    <td align="center"><?=$objResult["Current_location"];?></td>
  </tr>
<?php
}
?>
</table>



<?php
/*
mysql_data_seek($objQuery, mysql_num_rows($objQuery)-1); 		# goto last row.
$last_row = mysql_fetch_array($objQuery);						# last row into an array.

$extra_row_number = $last_row["Buoy_umber"] + 1;
echo '$extra_row_number : '. $extra_row_number;
*/
?>

<!--
<form action="insert.php" method="post">	
Buoy_umber: <input type="text" name="Buoy_umber" />
<input type="submit" name="mysubmit" value="Insert New Record" />
</form>
--!>
 







<?php
mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
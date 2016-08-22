<?php
session_start(); 
?>
<html>
<head>
<title>Equipment</title>
</head>
<body>
<?php
# echo '$_GET["site"] = '. $_GET["site"]. '<br>';
# $_GET['site'] = substr($_GET['site'], 0,-5).substr($_GET['site'], -4,-2).substr($_GET['site'], -1,1);
$_GET['site'] = substr($_GET['site'], 0, 14) . substr($_GET['site'], 16, -2) . substr($_GET['site'], -1,1);
# $_SESSION['site'] = $_GET['site'];
# echo '$_SESSION["site"] '. $_SESSION['site'].  '<br>';

# echo '$_GET["site"] after trimming: '. substr($_GET['site'], 0, 14) . substr($_GET['site'], 16, -2) . substr($_GET['site'], -1,1).'<br>';
# echo '$_GET["site"] = '. $_GET["site"]. '<br>';
# echo 'substr($_GET["site"], 0, 3): '. substr($_GET['site'], 0, 3). '<br>';
# $_SESSION['site'] = "";

if ($_GET["site"] !=="") $_SESSION['site'] = $_GET['site'];
if (substr($_GET['site'], 0, 3) == 'all') $_SESSION['site'] = '';
# echo '$_SESSION["site"] = '. $_SESSION["site"]. '<br>';

$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");
$strSQL = "SELECT * FROM equipment_table ". $_SESSION["site"]. " ". $_GET['order'];					# Change table name here.
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");				# $objQuery is the Resource
?>


<form name="myform" action="equipment.php" method="get">
Buoy Site Selection 
<select name="site">
<option value="all-all-all">All</option>
<option value=" WHERE field9= 'B'">B</option>
<option value=" WHERE field9= 'D'">D</option>
<option value=" WHERE field9= 'F'">F</option>
<option value=" WHERE field9= 'J'">J</option>
<option value=" WHERE field9= 'K'">K</option>
<option value=" WHERE field9= 'N'">N</option>
<option value=" WHERE field9= 'P'">P</option>
<option value=" WHERE field9= 'R'">R</option>
<option value=" WHERE field9= 'V'">V</option>
<option value=" WHERE field9= 'w'">W</option>
<option value=" WHERE field9= 'missing'">missing</option>
</select>
<input type="submit" name="mysubmit" value="Show This Site Only" />
</form>

<?php
if ($_SESSION['file_number'] == "ASC") $_SESSION['file_number'] = "DESC"; else $_SESSION['file_number'] = "ASC";
if ($_SESSION['checkout'] == "ASC") $_SESSION['checkout'] = "DESC"; else $_SESSION['checkout'] = "ASC";
if ($_SESSION['field3'] == "ASC") $_SESSION['field3'] = "DESC"; else $_SESSION['field3'] = "ASC";
if ($_SESSION['field4'] == "ASC") $_SESSION['field4'] = "DESC"; else $_SESSION['field4'] = "ASC";
if ($_SESSION['field5'] == "ASC") $_SESSION['field5'] = "DESC"; else $_SESSION['field5'] = "ASC";
if ($_SESSION['field6'] == "ASC") $_SESSION['field6'] = "DESC"; else $_SESSION['field6'] = "ASC";
if ($_SESSION['field7'] == "ASC") $_SESSION['field7'] = "DESC"; else $_SESSION['field7'] = "ASC";
if ($_SESSION['field8'] == "ASC") $_SESSION['field8'] = "DESC"; else $_SESSION['field8'] = "ASC";
if ($_SESSION['field9'] == "ASC") $_SESSION['field9'] = "DESC"; else $_SESSION['field9'] = "ASC";


# echo '$_POST["order"] = '. $_POST["order"];
# echo '$_GET["order"] = '. $_GET["order"];

?>
<table border="1">
  <tr>
    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY file_number <?php echo $_SESSION['file_number'];?>" />
<input type="submit" name="mysubmit" value="_File_Name_" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY checkout <?php echo $_SESSION['checkout'];?>" />
<input type="submit" name="mysubmit" value="Checkout" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field3 <?php echo $_SESSION['field3'];?>" />
<input type="submit" name="mysubmit" value="Type" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field4 <?php echo $_SESSION['field4'];?>" />
<input type="submit" name="mysubmit" value="Sensor Manufacture" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field5 <?php echo $_SESSION['field5'];?>" />
<input type="submit" name="mysubmit" value="Sensor Model" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field6 <?php echo $_SESSION['field6'];?>" />
<input type="submit" name="mysubmit" value="Sensor SN" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field7 <?php echo $_SESSION['field7'];?>" />
<input type="submit" name="mysubmit" value="Limit" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field8 <?php echo $_SESSION['field8'];?>" />
<input type="submit" name="mysubmit" value="Unit" /></form></th>

    <th> <form action="equipment.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field9 <?php echo $_SESSION['field9'];?>" />
<input type="submit" name="mysubmit" value="Site" /></form></th>

  </tr>
  
<?php
while($objResult = mysql_fetch_array($objQuery))				# get data row by row
{
?>
  <tr>
    <td><div align="center"><?=$objResult["file_number"];?></div></td>
    <td><div align="center"><?=$objResult["checkout"];?></div></td>
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
/*
mysql_data_seek($objQuery, mysql_num_rows($objQuery)-1); 		# goto last row.
$last_row = mysql_fetch_array($objQuery);						# last row into an array.

$extra_row_number = $last_row["Buoy_assembly_number"] + 1;
echo '$extra_row_number : '. $extra_row_number;
*/
?>

<!--
<form action="insert.php" method="post">	
Buoy_assembly_number: <input type="text" name="Buoy_assembly_number" />
<input type="submit" name="mysubmit" value="Insert New Record" />
</form>
--!>
 







<?php
mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
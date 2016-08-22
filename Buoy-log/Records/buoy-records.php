<?php
include ("../Deployment/authorization.php");
?>
<html>
<head>
<title>Buoy Records</title>
<link rel="stylesheet" href = "record_style.css" type="text/css" />
</head>
<body>
<h2 class="STYLE3"><center>General Buoy Information</h2>
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
echo '$_SESSION["site"] = '. $_SESSION["site"]. '<br>';

$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");
$strSQL = "SELECT * FROM record_table ". $_SESSION["site"]. " ". $_GET['order'];					# Change table name here.
echo $strSQL. '<br>';
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");				# $objQuery is the Resource
?>


<form name="myform" action="buoy-records.php" method="get"><h4 class="STYLE4">
Buoy Site Selection  
<select name="site">
<option value="all-all-all">All</option>
<option value=" WHERE field6= 'B'">B</option>
<option value=" WHERE field6= 'D'">D</option>
<option value=" WHERE field6= 'F'">F</option>
<option value=" WHERE field6= 'J'">J</option>
<option value=" WHERE field6= 'K'">K</option>
<option value=" WHERE field6= 'N'">N</option>
<option value=" WHERE field6= 'P'">P</option>
<option value=" WHERE field6= 'R'">R</option>
<option value=" WHERE field6= 'V'">V</option>
<option value=" WHERE field6= 'w'">W</option>
<option value=" WHERE field6= 'missing'">missing</option>
</select>
<input type="submit" name="mysubmit" value="Show" />
</form></h4>

<?php
if ($_SESSION['checkout'] == "ASC") $_SESSION['checkout'] = "DESC"; else $_SESSION['checkout'] = "ASC";
if ($_SESSION['old_checkout'] == "ASC") $_SESSION['old_checkout'] = "DESC"; else $_SESSION['old_checkout'] = "ASC";
if ($_SESSION['field3'] == "ASC") $_SESSION['field3'] = "DESC"; else $_SESSION['field3'] = "ASC";
if ($_SESSION['field4'] == "ASC") $_SESSION['field4'] = "DESC"; else $_SESSION['field4'] = "ASC";
if ($_SESSION['field5'] == "ASC") $_SESSION['field5'] = "DESC"; else $_SESSION['field5'] = "ASC";
if ($_SESSION['field6'] == "ASC") $_SESSION['field6'] = "DESC"; else $_SESSION['field6'] = "ASC";
if ($_SESSION['field7'] == "ASC") $_SESSION['field7'] = "DESC"; else $_SESSION['field7'] = "ASC";
if ($_SESSION['field8'] == "ASC") $_SESSION['field8'] = "DESC"; else $_SESSION['field8'] = "ASC";
if ($_SESSION['field9'] == "ASC") $_SESSION['field9'] = "DESC"; else $_SESSION['field9'] = "ASC";
if ($_SESSION['field10'] == "ASC") $_SESSION['field10'] = "DESC"; else $_SESSION['field10'] = "ASC";
if ($_SESSION['field11'] == "ASC") $_SESSION['field11'] = "DESC"; else $_SESSION['field11'] = "ASC";
if ($_SESSION['field12'] == "ASC") $_SESSION['field12'] = "DESC"; else $_SESSION['field12'] = "ASC";

# echo '$_POST["order"] = '. $_POST["order"];
# echo '$_GET["order"] = '. $_GET["order"];

?>
<table border="1">
  <tr BGCOLOR="#99CCFF">
    <th width="200"> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY checkout <?php echo $_SESSION['checkout'];?>" />
<input type="submit" name="mysubmit" value="_checkout_" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY old_checkout <?php echo $_SESSION['old_checkout'];?>" />
<input type="submit" name="mysubmit" value="old_checkout" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field3 <?php echo $_SESSION['field3'];?>" />
<input type="submit" name="mysubmit" value="System_SN" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field4 <?php echo $_SESSION['field4'];?>" />
<input type="submit" name="mysubmit" value="Hull_SN" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field5 <?php echo $_SESSION['field5'];?>" />
<input type="submit" name="mysubmit" value="Inventory#" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field6 <?php echo $_SESSION['field6'];?>" />
<input type="submit" name="mysubmit" value="Site" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field7 <?php echo $_SESSION['field7'];?>" />
<input type="submit" name="mysubmit" value="GS_Hex_ESN" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field8 <?php echo $_SESSION['field8'];?>" />
<input type="submit" name="mysubmit" value="Argos_ID" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field9 <?php echo $_SESSION['field9'];?>" />
<input type="submit" name="mysubmit" value="PTT_SN" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field10 <?php echo $_SESSION['field10'];?>" />
<input type="submit" name="mysubmit" value="      Date      " /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field11 <?php echo $_SESSION['field11'];?>" />
<input type="submit" name="mysubmit" value="Globalstar_Phone#" /></form></th>

    <th> <form action="buoy-records.php" method="get">	
<input type="hidden" id="age" name="order" value="ORDER BY field12 <?php echo $_SESSION['field12'];?>" />
<input type="submit" name="mysubmit" value="                   Technician                  " /></form></th>
  </tr>
  
<?php
while($objResult = mysql_fetch_array($objQuery))				# get data row by row
{
?>
  <tr BGCOLOR="#FFFFCC">
    <td width="400"><div align="center"><?=$objResult["checkout"];?></div></td>
    <td><div align="center"><?=$objResult["old_checkout"];?></div></td>
    <td><div align="center"><?=$objResult["field3"];?></div></td>
    <td><div align="center"><?=$objResult["field4"];?></div></td>
    <td align="center"><?=$objResult["field5"];?></td>
    <td align="center"><?=$objResult["field6"];?></td>
    <td><div align="center"><?=$objResult["field7"];?></div></td>
    <td><div align="center"><?=$objResult["field8"];?></div></td>
    <td><div align="center"><?=$objResult["field9"];?></div></td>
    <td width="800"><div align="center"><?=$objResult["field10"];?></div></td>
    <td align="center"><?=$objResult["field11"];?></td>
    <td height="30"><?=$objResult["field12"];?></td>
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
<?php
include ("../Deployment/authorization.php");
?>

<html>
<head>

<title>TABSI Records</title>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />
<style type="text/css">
<!--

-->
</style>
</head>
<body bgcolor="c0c8d6">
<h2 class="TITLE-STYLE"><center>TABS I Records</h2>

<center>
<?php
echo 'Welcome: '. $_SESSION['person'];

$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");
$strSQL = "SELECT * FROM TABSI_table1";												# Change table name here.
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");				# $objQuery is the Resource
?>
<br>
<br>

<h3 class="HEADING-STYLE">
</h3></center>

<DIV id = "tool-bar"> 
  <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a STYLE="color: #FFFF37; font-size: 15px"> TABSI Record </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../TABSII/TABSII.php">TABSII Record</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../TABS225m/TABS225m.php">TABS 2.25 m Record</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../Deployment/CAS-logout">NetID Logout</a>
  </div>


<center>
<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF">
    <th> <div align="center">checkout</div></th>
    <th> <div align="center">old_checkout</div></th>
    <th> <div align="center">SeaPac_SN</div></th>
    <th> <div align="center">Start_Date</div></th>
    <th> <div align="center">Phone_Number_ESN</div></th>
    <th> <div align="center">Lead_Technician</div></th>
    <th> <div align="center">Display </div></th>
    <th><div align="center">Edit</div></th>
    <th> <div align="center">Delete (Caution!) </div></th>
  </tr>
<?php
while($objResult = mysql_fetch_array($objQuery))				# get data row by row
{
?>
  <tr BGCOLOR="#FFFFCC">
    <td><div align="center"><?=$objResult["checkout"];?></div></td>		<!-- File Name -->
    <td><div align="center"><?=$objResult["old_checkout"];?></div></td>		<!-- old_checkout # -->
    <td><div align="center"><?=$objResult["field3"];?></div></td>		<!-- SeaPac S/N -->
    <td><div align="center"><?=$objResult["field4"];?></div></td>		
    <td align="right"><?=$objResult["field12"];?></td>
    <td align="right"><?=$objResult["technician"];?></td>
    <td align="center"><a href="TABSI_display.php?checkout=<?=$objResult["checkout"];?>">Display</a></td>
    <td align="center">
    <a href="TABSI_edit2.php?checkout=<?=$objResult["checkout"];?>&old_checkout=<?=$objResult["old_checkout"];?>">Edit</a> </td>
    <td align="center"><a href="TABSI_delete.php?checkout=<?=$objResult["checkout"];?>">Delete(Caution!)</a></td>
  </tr>
<?php
}
?>
</table>
</center>




<?php
mysql_close($objConnect);
?>
<div style="
	background-image: url(http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/TABSI/bottom-bg.png);
	background-repeat: repeat-x;
    position: absolute;
    bottom:0px;
	left: 0px;
    right: 0px;
    z-index: -1;
    width:101%">

<br><br><br><br><br>
</div>
</body>
</html>
<!--- This file download from www.shotdev.com -->
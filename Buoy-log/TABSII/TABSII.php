<?php
include ("../Deployment/authorization.php");
?>

<html>
<head>

<title>TABSII Records</title>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />
<style type="text/css">
<!--

-->
</style>
</head>
<body bgcolor="c0c8d6">
<center>
<h2 class="TITLE-STYLE"><center>TABS II Records</h2>


<?php
echo 'Welcome: '. $_SESSION['person'];

$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");
$strSQL = "SELECT * FROM TABSII_table";												# Change table name here.
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");				# $objQuery is the Resource
?>
<br>
<br>





<h3 class="HEADING-STYLE">
</h3></center>



<DIV id = "tool-bar"> 
  <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../Deployment/deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../TABSI/TABSI_edit1.php">TABSI Record</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a STYLE="color: #FFFF37; font-size: 15px"> TABSII Record </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../TABS225m/TABS225m.php">TABS 2.25 m Record</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a>
</div>


<center>
<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF">
    <th> <div align="center">checkout</div></th>
    <th> <div align="center">old_checkout</div></th>
    <th> <div align="center">SeaPac_SN</div></th>
    <th> <div align="center">Start_Date</div></th>
    <th> <div align="center">Current Sensor</div></th>
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
    <td><div align="center"><?=$objResult["system_SN"];?></div></td>		<!-- SeaPac S/N -->
    <td><div align="center"><?=$objResult["start_date"];?></div></td>		
    <td align="right"><?=$objResult["current_sensor"];?></td>
    <td align="right"><?=$objResult["Technicians"];?></td>
    <td align="center"><a href="./TABSII_display.php?checkout=<?=$objResult["checkout"];?>">Display</a></td>
    <td align="center">
    <a href="./TABSII_edit2.php?checkout=<?=$objResult["checkout"];?>">Edit</a> </td>
    <td align="center"><a href="./TABSII_delete.php?checkout=<?=$objResult["checkout"];?>">Delete(Caution!)</a></td>
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
<?php
include ("authorization.php");
?>
<html>
<head>
<title>Deployment History</title>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />

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
<h2 class="TITLE-STYLE"><center>Buoy List and Deployment History</h2>
<?php


// echo '<br>'.'$sNetid = '. $sNetid;
// echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];




$_GET['site'] = substr($_GET['site'], 0, 11). substr($_GET['site'], 12, -2). substr($_GET['site'], -1,1);

if ($_GET["site"] !=""){ 
	$_SESSION['select_site'] = $_GET['site'];}
	else $_GET['site'] = $_SESSION['select_site'];
if (substr($_GET['site'], 0, 3) == 'all') $_SESSION['select_site'] = '';

// echo '$_GET["years"] = '. $_GET["years"]. ';  ';
// echo '$_GET["site"] = '. $_GET["site"].';   ';
// echo '$_SESSION["select_site"] = '. $_SESSION["select_site"].';   ';


if ($_GET["years"] =="" and $_SESSION['years'] =="") {
	$_SESSION['years'] = " WHERE year(Depl_time) > 2010";}
	
	elseif ($_GET["years"] !="") {
	$_SESSION['years'] = $_GET["years"];}
	
// echo '$_GET["years"]2 = '. $_GET["years"]. '<br>';

$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");


if ($_GET['order']==''){$_GET['order']="ORDER BY depl_time Desc";}

$strSQL = "SELECT * FROM deployment_table2 ". $_SESSION["years"]. " ". $_SESSION['select_site']. " ". $_GET['order'];	
// $strSQL = "SELECT * FROM deployment_table2 ". $_SESSION["years"]. " ". $_SESSION['select_site']. " ". "order by Depl_time Asc";	
# Change table name here.
// echo $strSQL. '<br>';

$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."], ". mysql_error());				# $objQuery is the Resource


############
$year_selection = array("");

switch ($_SESSION["years"]) {
   case " WHERE year(Depl_time) > 1994": $year_selection[0] = "selected = 'selected'"; break;
   case " WHERE year(Depl_time) > 2010": $year_selection[1] = "selected = 'selected'"; break;
   case " WHERE year(Depl_time) > 2005": $year_selection[2] = "selected = 'selected'"; break;
   case " WHERE year(Depl_time) > 2000": $year_selection[3] = "selected = 'selected'"; break;
}

$site_stay = array("");
switch ($_GET["site"]) {
   case "": $site_stay[0] = "selected = 'selected'"; break;
   case ' AND site= "A"': $site_stay[1] = "selected = 'selected'"; break;
   case ' AND site= "A-2"': $site_stay[2] = "selected = 'selected'"; break;
   case ' AND site= "B"': $site_stay[3] = "selected = 'selected'"; break;
   case ' AND site= "B-2"': $site_stay[4] = "selected = 'selected'"; break;
   case ' AND site= "C"': $site_stay[5] = "selected = 'selected'"; break;
   case ' AND site= "D"': $site_stay[6] = "selected = 'selected'"; break;
   case ' AND site= "E"': $site_stay[7] = "selected = 'selected'"; break;
   case ' AND site= "F"': $site_stay[8] = "selected = 'selected'"; break;
   case ' AND site= "G"': $site_stay[9] = "selected = 'selected'"; break;
   case ' AND site= "H"': $site_stay[10] = "selected = 'selected'"; break;
   case ' AND site= "I"': $site_stay[11] = "selected = 'selected'"; break;
   case ' AND site= "J"': $site_stay[12] = "selected = 'selected'"; break;
   case ' AND site= "K"': $site_stay[13] = "selected = 'selected'"; break;
   case ' AND site= "L"': $site_stay[14] = "selected = 'selected'"; break;
   case ' AND site= "M"': $site_stay[15] = "selected = 'selected'"; break;
   case ' AND site= "N"': $site_stay[16] = "selected = 'selected'"; break;
   case ' AND site= "P"': $site_stay[17] = "selected = 'selected'"; break;
   case ' AND site= "R"': $site_stay[18] = "selected = 'selected'"; break;
   case ' AND site= "S"': $site_stay[19] = "selected = 'selected'"; break;
   case ' AND site= "T"': $site_stay[20] = "selected = 'selected'"; break;
   case ' AND site= "U"': $site_stay[21] = "selected = 'selected'"; break;
   case ' AND site= "V"': $site_stay[22] = "selected = 'selected'"; break;
   case ' AND site= "W"': $site_stay[23] = "selected = 'selected'"; break;
   case ' AND site= "X"': $site_stay[24] = "selected = 'selected'"; break;
   case ' AND site= "Y"': $site_stay[25] = "selected = 'selected'"; break;
   case ' AND site= "missing"': $site_stay[26] = "selected = 'selected'"; break;
}
?>
<center>
<table BORDER='1' CELLPADDING=3><tr BGCOLOR="#99CCFF"><td><hh class="HEADING-STYLE">
<form name="myform" action="deployment.php" method="get" style="display: inline; vertical-align:top;">
Display Years: 
<select name="years">
<option value=" WHERE year(Depl_time) >= 0000" <?=$year_selection[0];?>>All</option>
<option value=" WHERE year(Depl_time) > 2010" <?=$year_selection[1];?>>After 2010</option>
<option value=" WHERE year(Depl_time) > 2005" <?=$year_selection[2];?>>After 2005</option>
<option value=" WHERE year(Depl_time) > 2000" <?=$year_selection[3];?>>After 2000</option>
</select>

&nbsp; &nbsp; 
 Display Sites:
<select name="site">
<option value=" " <?=$site_stay[0];?>>All</option>
<option value=' AND site= "A"' <?=$site_stay[1];?>>A</option>
<option value=' AND site= "A-2"' <?=$site_stay[2];?>>A-2</option>
<option value=' AND site= "B"' <?=$site_stay[3];?>>B</option>
<option value=' AND site= "B2"' <?=$site_stay[4];?>>B2</option>
<option value=' AND site= "C"' <?=$site_stay[5];?>>C</option>
<option value=' AND site= "D"' <?=$site_stay[6];?>>D</option>
<option value=' AND site= "E"' <?=$site_stay[7];?>>E</option>
<option value=' AND site= "F"' <?=$site_stay[8];?>>F</option>
<option value=' AND site= "G"' <?=$site_stay[9];?>>G</option>
<option value=' AND site= "H"' <?=$site_stay[10];?>>H</option>
<option value=' AND site= "I"' <?=$site_stay[11];?>>I</option>
<option value=' AND site= "J"' <?=$site_stay[12];?>>J</option>
<option value=' AND site= "K"' <?=$site_stay[13];?>>K</option>
<option value=' AND site= "L"' <?=$site_stay[14];?>>L</option>
<option value=' AND site= "M"' <?=$site_stay[15];?>>M</option>
<option value=' AND site= "N"' <?=$site_stay[16];?>>N</option>
<option value=' AND site= "P"' <?=$site_stay[17];?>>P</option>
<option value=' AND site= "R"' <?=$site_stay[18];?>>R</option>
<option value=' AND site= "S"' <?=$site_stay[19];?>>S</option>
<option value=' AND site= "T"' <?=$site_stay[20];?>>T</option>
<option value=' AND site= "U"' <?=$site_stay[21];?>>U</option>
<option value=' AND site= "V"' <?=$site_stay[22];?>>V</option>
<option value=' AND site= "W"' <?=$site_stay[23];?>>W</option>
<option value=' AND site= "X"' <?=$site_stay[24];?>>X</option>
<option value=' AND site= "Y"' <?=$site_stay[25];?>>Y</option>
<option value=' AND site= "missing"' <?=$site_stay[26];?>>missing</option>
</select>
&nbsp; 
<input type="submit" name="mysubmit" value = "Show" style="display: inline; vertical-align:middle;"/>&nbsp; 
</form>
</td></tr></table>


<h3 class="HEADING-STYLE">
</h3></center>

<DIV id = "tool-bar"> 
<a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../../Metadata/Rebuild/Rebuild_entry.php?checkout=None">Brand New Buoy</a></td>  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="../../Metadata/Buoy-components/Components.php">Components</a></td>  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="./CAS-logout">NetID Logout</a>
</div>


<?php
if ($_SESSION['checkout'] == "ASC") $_SESSION['checkout'] = "DESC"; else $_SESSION['checkout'] = "ASC";
if ($_SESSION['site'] == "ASC") $_SESSION['site'] = "DESC"; else $_SESSION['site'] = "ASC";

if ($_SESSION['Seapac_SN'] == "ASC") $_SESSION['Seapac_SN'] = "DESC"; else $_SESSION['Seapac_SN'] = "ASC";
if ($_SESSION['Current_Sensor_SN'] == "ASC") $_SESSION['Current_Sensor_SN'] = "DESC"; else $_SESSION['Current_Sensor_SN'] = "ASC";
if ($_SESSION['Current_Sensor_model'] == "ASC") $_SESSION['Current_Sensor_model'] = "DESC"; else $_SESSION['Current_Sensor_model'] = "ASC";
if ($_SESSION['Modem_Type'] == "ASC") $_SESSION['Modem_Type'] = "DESC"; else $_SESSION['Modem_Type'] = "ASC";
if ($_SESSION['Deployment_Ship'] == "ASC") $_SESSION['Deployment_Ship'] = "DESC"; else $_SESSION['Deployment_Ship'] = "ASC";
if ($_SESSION['Depl_time'] == "ASC") $_SESSION['Depl_time'] = "DESC"; else $_SESSION['Depl_time'] = "ASC";
?>

<table border="1" align="center">
  <tr BGCOLOR="#99CCFF">
    <th> <form action="deployment.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY checkout <?php echo $_SESSION['checkout'];?>" />
<input type="submit" name="mysubmit" value=" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Checkout &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" /></form></th>

    <th> Report</th>
    <th> Mantainance</th>
    <th> <form action="deployment.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY site <?php echo $_SESSION['site'];?>" />
<input type="submit" name="mysubmit" value="Site" /></form></th>


    <th> <form action="deployment.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Depl_time <?php echo $_SESSION['Depl_time'];?>" />
<input type="submit" name="mysubmit" value="Deployment Date" /></form></th>


    <th width="200"> <form action="deployment.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY rec_time <?php echo $_SESSION['rec_time'];?>" />
<input type="submit" name="mysubmit" value="&nbsp; Recovery Date &nbsp;" /></form></th>

    <th> <form action="deployment.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Seapac_SN <?php echo $_SESSION['Seapac_SN'];?>" />
<input type="submit" name="mysubmit" value="System Number" style="width: 110px;" /></form></th>

    <th> <form action="deployment.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Deployment_Ship <?php echo $_SESSION['Deployment_Ship'];?>" />
<input type="submit" name="mysubmit" value="Deployment Ship" /></form></th>



    <th> <form action="deployment.php" method="get" style="display: inline; vertical-align:top;">	
<input type="hidden" id="age" name="order" value="ORDER BY Recovery_Ship <?php echo $_SESSION['Recovery_Ship'];?>" />
<input type="submit" name="mysubmit" value="Recovery Ship" /></form></th>


  </tr>
  
<?php
while($objResult = mysql_fetch_array($objQuery))				# get data row by row
{
	$n = $n + 1;
?>
  <tr <?php if ($n % 3){echo 'BGCOLOR="#C4E1FF"';}
  else {echo 'BGCOLOR="#FFFFCC"';} ?>align="center" >
    <td><div align="center"><?=$objResult["checkout"];?></div></td>
    
    <td align="center"><a href="report.php?checkout='<?=$objResult["checkout"];?>'">Report</a></td>
    <td align="center"><a href="../../Metadata/Rebuild/Rebuild_entry.php?checkout=<?=$objResult["checkout"];?>">Mantainance</a></td>   

    
    
    <td><?=$objResult["site"];?>&nbsp; </td>
    
    <td width="200" align="center"><?=$objResult["Depl_time"];?>&nbsp; </td>
    <td align="center"><?=$objResult["rec_time"];?>&nbsp; </td>
            
    <td align="center"><?=$objResult["Seapac_SN"];?>&nbsp; </td>
    <td align="center"><?=$objResult["Deployment_Ship"];?>&nbsp; </td>
    <td width="200" align="center"><?=$objResult["Recovery_Ship"];?>&nbsp; </td>

  </tr>
<?php
}
?>
</table>



<?php
mysql_close($objConnect);
?>










<?php


function escape($var)
{  
	return mysql_real_escape_string($var);
}
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
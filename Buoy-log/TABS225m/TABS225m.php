<?php
  session_start();
  global $sNetid, $sUin;
  require_once './cas.php';

if ($_SESSION["person"] == ""){
	header( 'Location: http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php' ) ;
  }
?>

<html>
<head>

<title>TABS 2.25 m Buoy Records</title>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />
<style type="text/css">
<!--

-->
</style>
</head>
<body bgcolor="c0c8d6">
<center>
<h2 class="TITLE-STYLE">TABS 2.25 m Buoy Records</h2>


<?php
echo 'Welcome: '. $_SESSION['person'];

$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");
$strSQL = "SELECT * FROM TABS225m";												# Change table name here.
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");				# $objQuery is the Resource
?>
<br>
<br>


<script type="text/javascript">
<!--
function validateForm()
 {
 var x=document.forms["myForm"]["Start_Date"].value;
 if (x==null || x=="")
   {
   alert("Start Date must be filled out.");
   return false;
   }
 }
 

/**
 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/datevalidation.asp)
 */
// Declaring valid date character, minimum year and maximum year
var dtCh= "-";
var minYear=1900;
var maxYear=2100;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr){
//	alert("within isDate")
	
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)

	var strYear=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strDay=dtStr.substring(pos2+1)
	
//	var strMonth=dtStr.substring(0,pos1)
//	var strDay=dtStr.substring(pos1+1,pos2)
//	var strYear=dtStr.substring(pos2+1)

	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : yyyy-mm-dd")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month, month: " + strMonth)
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date")
		return false
	}
return true
}

function ValidateForm2(){
//	var dt=document.frmSample.Start_Date
//	alert("within ValidateForm2")
//	alert("within ValidateForm2, dt")
	var dt=document.frmSample.Start_Date
//	alert("within ValidateForm2, dt" + dt.value)
	if (isDate(dt.value)==false){
		dt.focus()
		return false
	}
    return true
 }

 
 
//-->
</script>


<form name="frmSample" action="./TABS225m_insert.php" onSubmit="return ValidateForm2()" method="post" bgcolor ="red" 
style="display: inline; vertical-align:middle;">	

<table BORDER='0' CELLPADDING=3 width ="600">
<tr BGCOLOR="#99CCFF" class="HEADING-STYLE"><td align="right">System Number: </td><td><input type="text" name="SeaPac_SN" /><br> (no space)</tr>
<td align="right">Start Date: </td><td><input type="text" name="Start_Date" /> <br> (yyyy-mm-dd)</td></tr>

</table>
<input type="submit" name="mysubmit" value="Insert New Record" />

</form>




<h3 class="HEADING-STYLE">
</h3></center>

<DIV id = "tool-bar"> 
  <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../TABSI/TABSI_edit1.php">TABSI Record</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="../TABSII/TABSII.php">TABSII Record</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a STYLE="color: #FFFF37; font-size: 15px"> TABS 2.25 m Record </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a>
</div>



<center>
<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF">
    <th> <div align="center">Assembly Number</div></th>
    <th> <div align="center">old_checkout</div></th>
    <th> <div align="center">System S/N</div></th>
    <th> <div align="center">Start Date</div></th>
    <th> <div align="center">ARGOS</div></th>
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
    <td align="right"><?=$objResult["ARGOS"];?></td>
    <td align="right"><?=$objResult["Technicians"];?></td>
    <td align="center"><a href="./TABS225m_display.php?checkout=<?=$objResult["checkout"];?>">Display</a></td>
    <td align="center">
    <a href="./TABS225m_edit2.php?checkout=<?=$objResult["checkout"];?>&old_checkout=<?=$objResult["old_checkout"];?>">
    	Edit</a> </td>
    <td align="center"><a href="./TABS225m_delete.php?checkout=<?=$objResult["checkout"];?>">Delete(Caution!)</a></td>
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
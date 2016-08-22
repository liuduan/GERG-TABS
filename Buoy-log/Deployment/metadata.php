<?php
include ("authorization.php");
?>

<html>
<head>
<title>Metadata</title>
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
<h2 class="TITLE-STYLE"><center>Buoy Metadata</h2>
<?php



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

$strSQL = "SELECT * FROM deployment_table2 ". $_SESSION["years"]. " ". $_SESSION['select_site']. " ". $_GET['order'];	
// $strSQL = "SELECT * FROM deployment_table2 ". $_SESSION["years"]. " ". $_SESSION['select_site']. " ". "order by Depl_time Asc";	
# Change table name here.
// echo $strSQL. '<br>';

$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."], ". mysql_error());				# $objQuery is the Resource


############


?>



<script type="text/javascript">
<!--
function validateForm()
 {
 var x=document.forms["myform"]["Requested_Date"].value;
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
	var dt=document.myform.Requested_Date
//	alert("within ValidateForm2, dt" + dt.value)
	if (isDate(dt.value)==false){
		dt.focus()
		return false
	}
    return true
 }
//-->
</script>




<center>
<table BORDER='1' CELLPADDING=3 width="400"><tr BGCOLOR="#99CCFF"><td><hh class="HEADING-STYLE">
<center>
<form name="myform" action="metadata_one_buoy.php" method="get" onSubmit="return ValidateForm2()" 
style="display: inline; vertical-align:top;">





 Buoy Site:
<select name="site">
<option value='A' <?=$site_stay[1];?>>A</option>
<option value='A-2' <?=$site_stay[2];?>>A-2</option>
<option value='B' <?=$site_stay[3];?>>B</option>
<option value='B2' <?=$site_stay[4];?>>B2</option>
<option value='C' <?=$site_stay[5];?>>C</option>
<option value='D' <?=$site_stay[6];?>>D</option>
<option value='E' <?=$site_stay[7];?>>E</option>
<option value='F' <?=$site_stay[8];?>>F</option>
<option value='G' <?=$site_stay[9];?>>G</option>
<option value='H' <?=$site_stay[10];?>>H</option>
<option value='I' <?=$site_stay[11];?>>I</option>
<option value='J' <?=$site_stay[12];?>>J</option>
<option value='K' <?=$site_stay[13];?> selected>K</option>
<option value='L' <?=$site_stay[14];?>>L</option>
<option value='M' <?=$site_stay[15];?>>M</option>
<option value='N' <?=$site_stay[16];?>>N</option>
<option value='P' <?=$site_stay[17];?>>P</option>
<option value='R' <?=$site_stay[18];?>>R</option>
<option value='S' <?=$site_stay[19];?>>S</option>
<option value='T' <?=$site_stay[20];?>>T</option>
<option value='U' <?=$site_stay[21];?>>U</option>
<option value='V' <?=$site_stay[22];?>>V</option>
<option value='W' <?=$site_stay[23];?>>W </option>
<option value='X' <?=$site_stay[24];?>>X</option>
<option value='Y' <?=$site_stay[25];?>>Y</option>
</select>
&nbsp; <br><br>


Date Requested: <input type="text" name="Requested_Date" />(yyyy-mm-dd)
&nbsp; &nbsp; 
<br><br>
<input type="submit" name="mysubmit" value = "Submit" style="display: inline; vertical-align:middle;"/>&nbsp; 
</form>
</td></tr></table>
<br>




<?php


function escape($var)
{  
	return mysql_real_escape_string($var);
}
mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
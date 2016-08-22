<?php
  session_start();
  global $sNetid, $sUin;
  require_once '../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Buoy-log/TABSI/cas.php';
  getCAS();
  
  if ($_SESSION["person"] == ""){
  	$_SESSION["person"] = $sNetid;
  }
?>

<html>
<head>

<title>TABSI Records</title>

<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:1015px;
	height:285px;
	z-index:1;
	left: 92px;
	top: 491px;
}
.STYLE3 {
	color: #000066;
	font-size: 30px;
}
.STYLE4 {
	font-size: 18px;
	font-family: Arial, Helvetica, sans-serif;
}
.STYLE5 {font-size: 18px; font-family: "Arial", Times, serif; }
.STYLE6 {color: #0000FF;}
.STYLE7 {font-family: Arial, Helvetica, sans-serif; 		}
.STYLE9 {font-family: Arial, Helvetica, sans-serif, serif; color: #800000; font-size: 14px;}
#Layer2 {
	position:absolute;
	width:855px;
	height:228px;
	z-index:1;
	left: 159px;
	top: 535px;
}
#Layer3 {
	position:relative;
	width:auto;
	height:115px;
	left: 2px;
	top: 5px;
	z-index:1;
}
-->
</style>
</head>
<body>
<h2 class="STYLE3"><center>TABS I Records</h2>

<h4 class="STYLE4">
<?php
echo 'Welcome: '. $_SESSION['person']. ', ';
?>

  <a href="https://cas.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/TABSI/">Logout</a>
 </h4>
 <br><br>
<?php
$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");
$strSQL = "SELECT * FROM TABSI_table1";												# Change table name here.
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");				# $objQuery is the Resource
?>
<table BORDER CELLPADDING=3>
<tr BGCOLOR="#99CCFF">
    <th> <div align="center">File_Number</div></th>
    <th> <div align="center">Checkout</div></th>
    <th> <div align="center">SeaPac_SN</div></th>
    <th> <div align="center">Start_Date</div></th>
    <th> <div align="center">Phone_Number_ESN</div></th>
    <th> <div align="center">Lead_Technician</div></th>
    <th> <div align="center">Display </div></th>
    <th> <div align="center"></div></th><th><div align="center">Edit</div></th><th><div align="center"></div></th>
    <th> <div align="center">Delete (Caution!) </div></th>
  </tr>
<?php
while($objResult = mysql_fetch_array($objQuery))				# get data row by row
{
?>
  <tr BGCOLOR="#FFFFCC">
    <td><div align="center"><?=$objResult["file_number"];?></div></td>		<!-- File Name -->
    <td><div align="center"><?=$objResult["checkout"];?></div></td>		<!-- Checkout # -->
    <td><div align="center"><?=$objResult["field3"];?></div></td>		<!-- SeaPac S/N -->
    <td><div align="center"><?=$objResult["field4"];?></div></td>		
    <td align="right"><?=$objResult["field12"];?></td>
    <td align="right"><?=$objResult["technician"];?></td>
    <td align="center"><a href="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Buoy-log/TABSI/TABSI_display.php?file_number=<?=$objResult["file_number"];?>">Display</a></td>
    <td align="center"><a href="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Buoy-log/TABSI/TABSI_edit2.php?file_number=<?=$objResult["file_number"];?>&checkout=<?=$objResult["checkout"];?>">Edit Page 1</a>    </td>
	<td align="center"><a href="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Buoy-log/TABSI/TABSI2/TABSI2_edit2.php?file_number=<?=$objResult["file_number"];?>&checkout=<?=$objResult["checkout"];?>">Edit Page 2</a>    </td>
	<td align="center"><a href="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Buoy-log/TABSI/TABSI3/TABSI3_edit2.php?file_number=<?=$objResult["file_number"];?>&checkout=<?=$objResult["checkout"];?>">Edit Page 3</a>    
    
    </td>
    <td align="center"><a href="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Buoy-log/TABSI/TABSI_delete.php?file_number=<?=$objResult["file_number"];?>">Delete(Caution!)</a></td>
  </tr>
<?php
}
?>
</table>

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


<h4 class="STYLE4">
<form name="frmSample" action="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Buoy-log/TABSI/TABSI_insert.php" onSubmit="return ValidateForm2()" method="post" bgcolor ="red">	

<table BORDER='0' CELLPADDING=3 width ="400">
<tr BGCOLOR="#99CCFF" ><td><h4 class="STYLE4">SeaPac_SN : </td><td><input type="text" name="SeaPac_SN" />(no space)</tr>
<tr BGCOLOR="#99CCFF" ><td><h4 class="STYLE4">Start Date: </td><td><input type="text" name="Start_Date" /> (yyyy-mm-dd)</td></tr>

</table>
<input type="submit" name="mysubmit" value="Insert New Record" />

</form></h4>






<?php
mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
<?php
session_start(); 
global $sNetid, $sUin;
require_once '../cas.php';
getCAS();
  
if ($_SESSION["person"] == ""){
 	$_SESSION["person"] = $sNetid;
    }
?>
<html>
<head>
<title>New Assembly Number</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />
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

<?php
IF ($sNetid == "liu-duan" or "woodyl" or "walpert" or "guinasso" or "wmblake" or "willie" or "weiyan" or "t-wade" or "smpitts" or "s-sweet" or "rjwilson" or "rj-albers" or "pdancer" or "p-stine" or "p-clark2" or "m-bohn" or "l-mcdonald6" or "kuehl.joe" or "jlsericano" or "jeo27" or "j-wade14482" or "ewq450" or "erw" or "d-defreitas" or "cj_c_ag" or "cfpaul" or "bauerroad" or "andreym" or "alicia08" or "adancer" or "calliefornia17")
	{echo " ";}
else{
	echo "This NetID is not authorized";
	echo <<<_END
	<FORM><INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-2)"></FORM>
_END;
	exit;
    }


?>


<h2 class="TITLE-STYLE"><center>Please Give a New Assembly Number for the Rebuilding Buoy</h2>



<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a></div>


<br><br>

<h2 class="HEADING-STYLE"><center>A new assembly number usually consiste of a system number and a start date.</h2>

<?php 

echo "Old Assembly Number: ". $_GET["Assembly_N"];
$_SESSION["Old_Assembly_N"] = $_GET["Assembly_N"];

?>
<br><br>


<table BORDER='0' CELLPADDING=3 width ="600">
<form name="frmSample" action="Add_many.php" method="get" 
style="display: inline; vertical-align:middle;">	

<tr BGCOLOR="#99CCFF" class="HEADING-STYLE"><td align="right">System Number : </td>
<td><input type="text" name="System_Number" /><br>(no space)</td>
<td align="right">Start Date: </td><td><input type="text" name="Start_Date" /><br> (yyyy-mm-dd)</td></tr>

</table>
<br>
<input type="submit" name="mysubmit" value="Generate a New Buoy Assembly Number" style="display: inline; vertical-align:top;"/>
</form>
<h3 class="HEADING-STYLE">
</h3></center>







</body>
</html>
<!--- This file download from www.shotdev.com -->
<?php
session_start(); 
global $sNetid, $sUin;

require_once '../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Metadata/cas.php';
if ($_SESSION["person"] == ""){
	header( 'Location: http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php' ) ;
  }
?>
<html>
<head>
<title>New Assembly Number</title>
<link rel="stylesheet" href = "../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Metadata/metadata_style.css" type="text/css" />
<style type="text/css">
<!--
body
{
background-image:url('../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Metadata/blue-shadow.png');
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


<h2 class="TITLE-STYLE"><center>New Assembly Number</h2>



<DIV id = "tool-bar"> 
 <a href="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a></div>

<center>
<br><br>
<h2 class="HEADING-STYLE"><center>The old aasembly number for this buoy was: "<?php echo $_GET["Assembly_N"]; ?>". </h2>
<h2 class="HEADING-STYLE"><center>Please assign a new assembly number.</h2>


<?php 

# echo "Old Assembly Number: ". $_GET["Assembly_N"];
$_SESSION["Old_Assembly_N"] = $_GET["Assembly_N"];

?>
<br>

<h2 class="HEADING-STYLE"><center>A new assembly number usually consists of a system number and a start date.</h2>
<table BORDER='0' CELLPADDING=3 width ="600">
<form name="frmSample" action="Add_many.php" method="get" 
style="display: inline; vertical-align:middle;">	

<INPUT TYPE=HIDDEN NAME="Old_Assembly_N" value="<?=$_GET["Assembly_N"];?>">

<tr BGCOLOR="#99CCFF" class="HEADING-STYLE"><td align="right">System Number : </td>
<td><input type="text" name="System_Number" /><br>(no space)</td>
<td align="right">Start Date: </td><td><input type="text" name="Start_Date" /><br> (yyyy-mm-dd)</td></tr>

</table>

<br>
<input type="submit" name="mysubmit" value="Generate a New Buoy Assembly Number" style="display: inline; vertical-align:top;"/>
</form>






<form name="frmSample345" action="../../../../../Users/liu-duan/Documents/Unnamed Site 2/liuduan/testpages/Metadata/Rebuild/Rebuild.php?New_Assembly_N=<? echo $_GET['Assembly_N'];?>"
method="post" 
style="display: inline; vertical-align:middle;">	

<br>
<input type="submit" name="mysubmit" value="Working on Existing Assembly" style="display: inline; vertical-align:top;"/>
</form>




<h3 class="HEADING-STYLE">
</h3></center>







</body>
</html>
<!--- This file download from www.shotdev.com -->
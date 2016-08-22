<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<html>
<head>
<title>Mantainance Entry</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />
<style type="text/css">
<!--
body
{
background-image:url('../blue-shadow.png');
background-repeat:repeat-x;
} 

-->
</style>


</head>
<body bgcolor="c0c8d6">

<?php

// echo '<br>'.'$sNetid = '. $sNetid;
// echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];

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

<?php
$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("tabs_status");
?>



<h2 class="TITLE-STYLE"><center>Buoy Mantainance</center></h2>



<DIV id = "tool-bar"> 
 <a href="../../Buoy-log/Deployment/deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>


<?php 
// Showing different contents with brand new buoy.
if ($_GET["checkout"]=="None"){				// for a brand new buoy.
		print <<<END

<center>
<h2 class="Sub_Title-STYLE">To Assign a Checkout for a Brand New Buoy</h2>




<h2 class="HEADING-STYLE">.A new assembly number usually consists of a system number and a start date.</h2>
<table BORDER='0' CELLPADDING=3 width ="600">




<form name="frmSample" action="Add_others.php" method="get" 
style="display: inline; vertical-align:middle;">	

<INPUT TYPE=HIDDEN NAME="Old_checkout" value=$_GET[checkout]>

<tr BGCOLOR="#99CCFF" class="HEADING-STYLE"><td align="right">System Number : </td>
<td><input type="text" name="System_Number" /><br>(no space)</td>
<td align="right">Start Date: </td><td><input type="text" name="Start_Date" /><br> (yyyy-mm-dd)</td></tr>

</table>

<input type="submit" name="mysubmit" value="Generate a New Checkout" style="display: inline; vertical-align:top;"/>
</form>



END;
	
	}  // end for a brand new buoy.
	
	
	
	
	
	
	
	else{			// for a buoy reconstruction.
		print <<<END
<center>
<h2 class="Sub_Title-STYLE">For assigning a new checkout number</h2>

<h2 class="HEADING-STYLE">The previous checkout number for this buoy was: $_GET[checkout]. </h2>

<h2 class="HEADING-STYLE">A new checkout number usually consists of a system number and a start date.</h2>
<table BORDER='0' CELLPADDING=3 width ="600">


<form name="frmSample" action="Add_many.php" method="get" 
style="display: inline; vertical-align:middle;">	

<INPUT TYPE=HIDDEN NAME="Old_checkout" value=$_GET[checkout]>

<tr BGCOLOR="#99CCFF" class="HEADING-STYLE"><td align="right">System Number : </td>
<td><input type="text" name="System_Number" /><br>(no space)</td>
<td align="right">Start Date: </td><td><input type="text" name="Start_Date" /><br> (yyyy-mm-dd)</td></tr>

</table>

<input type="submit" name="mysubmit" value="Generate a New Buoy Checkout." style="display: inline; vertical-align:top;"/>
</form>

<hr>
	
	

	
<script language="JavaScript">
 <!-- Hide the script from old browsers --

img0_on = new Image(186,25);
 img0_on.src="red-components.png";
 img0_off = new Image(186,25);
 img0_off.src="yellow-components.png";

 img1_on = new Image(103,33);
 img1_on.src="red-test.png";
 img1_off = new Image(103,33);
 img1_off.src="yellow-test.png";
 
 img2_on = new Image(186,25);
 img2_on.src="red-deployment.png";
 img2_off = new Image(186,25);
 img2_off.src="yellow-deployment.png";

 img3_on = new Image(103,33);
 img3_on.src="red-delete.png";
 img3_off = new Image(103,33);
 img3_off.src="yellow-delete.png";

 function over_image(parm_name)
      {
         document[parm_name].src = eval(parm_name + "_on.src");
      }
 function off_image(parm_name)
      {
         document[parm_name].src = eval(parm_name + "_off.src");
      }
 // --End Hiding Here -->
 </script> 
<div id="maintenance" style="background-color:#66B3FF;"><!-- Start of the maintenance div -->

<br>

<h2 class="Sub_Title-STYLE">For the buoy checkout: $_GET[checkout] </h2>

<a href="./Rebuild.php?New_checkout=$_GET[checkout]" onmouseover="over_image('img0');" onmouseout="off_image('img0')"> 
<img src="yellow-components.png" border="0" name="img0"> </a> 

 <a href="./Test_entry.php?checkout=$_GET[checkout]" onmouseover="over_image('img1');" onmouseout="off_image('img1')"> 
 <img src="yellow-test.png" border="0" name="img1"> </a> 
	
<a href= "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment_edit.php?checkout=$_GET[checkout]" 
onmouseover="over_image('img2');" onmouseout="off_image('img2')"> <img src="yellow-deployment.png" border="0" name="img2"> </a> 



 <a href="http://www.thehtmlsource.com" onmouseover="over_image('img3');" onmouseout="off_image('img3')"> 
 <img src="yellow-delete.png" border="0" name="img3"> </a> 
<p>
	
</div> <!-- End of the maintenance div -->
<br>
<hr>
	
END;

		}		// end for a buoy reconstruction.

?>



<hr>

    <a href="http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment_delete.php?checkout=<?=$_GET["checkout"];?>">Delet a Checkout Entry</a>    
	

 <?php   
// echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];
// echo '<br>'.'$sNetid = '. $sNetid;
    
    
    

mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
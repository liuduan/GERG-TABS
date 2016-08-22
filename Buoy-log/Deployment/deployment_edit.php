<?php
include ("authorization.php");
?>
<html>
<head>
<title>Editing Deployment Record</title>
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
<br />
<h2 class="TITLE-STYLE"><center>Editing Buoy Deployment Record</h2>


<SCRIPT TYPE="text/javascript">
<!-- 
function signature(form_obj){
	form_obj["Last_change"].value = time_string();
	form_obj["Last_change_hold"].value = time_string();
	
	form_obj["NetID"].value = <?php echo '"'.  $_SESSION["person"]. '"';?>;
	form_obj["NetID_hold"].value = <?php echo '"'.  $_SESSION["person"]. '"';?>;
	}

function not_allowed(form_obj){
   form_obj["NetID"].value = form_obj["NetID_hold"].value;
   form_obj["Last_change"].value = form_obj["Last_change_hold"].value;
}

function time_string(){
 var currentDate = new Date()
  var day = currentDate.getUTCDate()
     if (day < 10)
  		day = "0" + day
  var month = currentDate.getUTCMonth() + 1
       if (month < 10)
  		month = "0" + month
  var year = currentDate.getUTCFullYear()

 var currentDate2 = new Date()
  var hour_A = currentDate2.getUTCHours()
       if (hour_A < 10)
  		hour_A = "0" + hour_A
  var minute_A = currentDate2.getMinutes()
       if (minute_A < 10)
  		minute_A = "0" + minute_A
  var second_A = currentDate2.getSeconds()
       if (second_A < 10)
  		second_A = "0" + second_A

time_string_A = year + "-" + month + "-" + day + " " + hour_A + ":" + minute_A + ":" + second_A 
return time_string_A
 // document.write("<b> " + time_string + "<br>")
}
// -->
</SCRIPT>


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





$db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());
	
	// echo '$_GET = ';
	// print_r($_GET);
	
?>   

		

<br />		
<div id = "tool-bar"> 
 <a href="./deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a>
</div>

<?php
// echo '$_GET[checkout] = '. $_GET["checkout"];
// $_GET["checkout"] = substr($_GET["checkout"], 2, -2) ;
// print_r($_GET);


	$objDB = mysql_select_db("tabs_status");
	$strSQL = "SELECT * FROM deployment_table2 WHERE checkout = '".$_GET["checkout"]."' ";  // <!-- check the data table name -->
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Not found checkout=".$_GET["checkout"].'<br>';
		echo '$strSQL = '. $strSQL. '<br>';
	}
		else
	{
?>

<?php 
// echo $strSQL. '<br>';
// echo $objResult["checkout"];
// print_r($objResult);
?>
<center>









 <form action="deployment_update.php" method="post"><table>
 <tr>
<td align="right">checkout:</td><td BGCOLOR="#FFFFCC"><?php echo $objResult["checkout"];?>

<INPUT TYPE=HIDDEN NAME="checkout" value="<?=$objResult["checkout"];?>" />



</td>
 
<tr>
<td align="right">Site:</td><td>					
<input type="text" name="site" value="<?=$objResult["site"];?>" onChange="signature(this.form)" /></td>

<td align="right">System SN:</td>
<td><input type="text" name="Seapac_SN" value="<?=$objResult["Seapac_SN"];?>" onChange="signature(this.form)" /></td></tr>
 
<tr>

<tr>
<td align="right">&nbsp; </td>  </tr>

<tr>
<td align="right">Deployment Ship:</td>
<td><input type="text" name="Deployment_Ship" value="<?=$objResult["Deployment_Ship"];?>" onChange="signature(this.form)" />
</td>

<td align="right">Deployment time:</td>
<td><input type="text" name="Depl_time" value="<?=$objResult["Depl_time"];?>" onChange="signature(this.form)" /></td>
<td>yyyy-mm-dd hh-mm-ss(UTC)</td></tr>

<tr>
<td align="right">Recovery Ship:</td>
<td><input type="text" name="Recovery_Ship" value="<?=$objResult["Recovery_Ship" ];?>" onChange="signature(this.form)" /></td>

<td align="right">Recovery time:</td>
<td><input type="text" name="rec_time" value="<?=$objResult["rec_time"];?>" onChange="signature(this.form)" /></td>
<td>yyyy-mm-dd hh-mm-ss(UTC)</td>
</tr>
 
<tr></tr>

<tr><td align="right">Comments:</td>
<td colspan="5"><input type="text" name="Comments" value="<?=$objResult["Comments"];?>" size ="90" 
onChange="signature(this.form)" /></td></tr>


<tr>
<td align="right">&nbsp; </td>  </tr>
</table>

<table>
<tr>

<td align="right">Last modified by:</td>
<td><INPUT TYPE=HIDDEN NAME="NetID_hold" value="<?=$objResult["NetID"];?>" >
<input type="text" name="NetID" value="<?=$objResult["NetID"];?>" onChange="not_allowed(this.form)" 
style="width:5em;" /></td>

<td align="right">&nbsp;&nbsp;&nbsp;at:</td>
<td><INPUT TYPE=HIDDEN NAME="Last_change_hold" value="<?=$objResult["Last_change"];?>" >
<input type="text" name="Last_change" value="<?=$objResult["Last_change"];?>" onChange="not_allowed(this.form)" size = 17/></td>
<td>(UTC)</td>
</tr>

</table>
 
<hr>
<input type="submit" value="Update Record" />
</form>

</center>


<?php 
	}

mysql_close($db_server);

function get_post($var)
{  
	return mysql_real_escape_string($_POST[$var]);
}
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
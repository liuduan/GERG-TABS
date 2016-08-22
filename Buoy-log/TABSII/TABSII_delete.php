<?php
include ("../Deployment/authorization.php");

IF ($_SESSION["person"] == "walpert" or $_SESSION["person"] == "liu-duan" ||
    $_SESSION["person"] == "guinasso")
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
echo '$_GET[checkout]: '. $_GET[checkout]. '<br>';

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("tabs_status");
 

$sql="DELETE FROM TABSII_table WHERE checkout = '". $_GET[checkout]."'";

mysql_query($sql);
echo '$_POST[checkout]: '. $_GET[checkout]. '<br>';
echo 'Command: '. $sql. '<br>';
echo "1 record added";
 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./TABSII.php"
}
//-->
setTimeout(redirect_page,5250);

</script>
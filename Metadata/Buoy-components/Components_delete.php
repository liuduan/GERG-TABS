<?php
include ("../../Buoy-log/Deployment/authorization.php");

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
echo '$_GET[file_number]: '. $_GET[file_number]. '<br>';

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("tabs_status");
 

$sql="DELETE FROM TABS225m WHERE file_number = '". $_GET[file_number]."'";

mysql_query($sql);
echo '$_POST[file_number]: '. $_GET[file_number]. '<br>';
echo 'Command: '. $sql. '<br>';
echo "1 record added";
 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 54 Seconds');
	window.location = "./TABS225m.php"
}
//-->
setTimeout(redirect_page,5250);

</script>
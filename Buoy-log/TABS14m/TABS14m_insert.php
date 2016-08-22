<?php
include ("../Deployment/authorization.php");
?>
<?php

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("tabs_status");

$_POST["checkout"] = $_POST["SeaPac_SN"]. "-". $_POST["Start_Date"];

$sql="INSERT INTO TABS225m (checkout) VALUES('". $_POST["checkout"]. "')";

echo $sql.'<br>';

mysql_query($sql) or die(mysql_error());

echo '$_POST[checkout]: '.$_POST["checkout"].'<br>';
echo "1 record added".'<br>'.'<br>';

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./TABS225m.php"
}
//-->
setTimeout(redirect_page,5250);

</script>
<?php
include ("../Deployment/authorization.php");
?>
<?php

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("tabs_status");

$_POST["checkout"] = $_POST["SeaPac_SN"]. "-". $_POST["Start_Date"];

$sql="INSERT INTO TABSI_table1 (checkout) VALUES('". $_POST["checkout"]. "')";
$sql2="INSERT INTO TABSI_table2 (checkout) VALUES('". $_POST["checkout"]. "')";
$sql3="INSERT INTO TABSI_table3 (checkout) VALUES('". $_POST["checkout"]. "')";

$strSQL4 = "UPDATE TABSI_table1 SET field3 = '". $_POST["SeaPac_SN"]."', field4 = '". $_POST["Start_Date"];
	$strSQL4 .= "' WHERE checkout = '".$_POST["checkout"]."' ";;


echo $sql.'<br>';
echo $sql2.'<br>';
echo $sql3.'<br>';
echo $strSQL4.'<br>';


mysql_query($sql) or die(mysql_error());
mysql_query($sql2) or die(mysql_error());
mysql_query($sql3) or die(mysql_error());
mysql_query($strSQL4) or die(mysql_error());

echo '$_POST[checkout]: '.$_POST["checkout"].'<br>';
echo '$_POST[checkout]: '.$_POST["checkout"].'<br>';
echo "1 record added".'<br>'.'<br>';

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./TABSI_edit1.php"
}
//-->
setTimeout(redirect_page,5250);

</script>
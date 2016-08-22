<?php
include ("authorization.php");
?>


<?php
print_r($_POST);

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("tabs_status");

$_POST["checkout"] = $_POST["SeaPac_SN"]. "-". $_POST["Start_Date"];

$sql="INSERT INTO deployment_table2 (checkout) VALUES('". $_POST["checkout"]. "')";


echo $sql.'<br>';

mysql_query($sql) or die(mysql_error());

echo '$_POST[checkout]: '.$_POST["checkout"].'<br>';
echo "1 record added".'<br>'.'<br>';
$_GET["checkout"]= $_POST["checkout"];

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';

print_r($_GET);
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./deployment_edit.php?checkout='" + "<?=$_POST['checkout']; ?>" + "'";
}
//-->
setTimeout(redirect_page,5250);

</script>
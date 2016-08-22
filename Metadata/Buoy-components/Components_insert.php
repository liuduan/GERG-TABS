<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<?php

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("Metadata");

$last_record = mysql_query("select Component_N from Components order by Component_N desc limit 1") or die(mysql_error());
$last_ID = mysql_fetch_array($last_record);
# $objResult["Component_N"];
echo 'Last_ID: '. $last_ID["Component_N"]. '<br>'; 
$last_N = $last_ID["Component_N"] + 1;
echo mysql_insert_id(). '<br>'; 


$sql="INSERT INTO Components (Component_type, Component_N) VALUES ('". $_GET["Component_type"]. "', $last_N)";

echo $sql.'<br>';

mysql_query($sql) or die(mysql_error());

echo '$_GET[Component_type]: '.$_GET["Component_type"].'<br>';
echo "1 record added".'<br>'.'<br>';

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';

 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./Components.php"
}
//-->
setTimeout(redirect_page,1);

</script>
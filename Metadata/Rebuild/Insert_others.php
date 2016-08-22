<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<?php

print_r($_GET);

echo '<br>'.'<br>';






$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("Metadata");

$sql="INSERT INTO Assemblies (checkout) VALUES ('". $_GET["New_checkout"]. "')";

echo $sql.'<br>';

# mysql_query($sql) or die(mysql_error());

echo '$_GET[New_checkout]: '.$_GET["New_checkout"].'<br>';
print_r($_GET);

echo '<br>'.'<br>';

while (list($key, $value) = each($_GET)){
	echo "key $key has value $value <br>";
	$new_array[]= $value;
}

print_r($new_array);

echo '<br>'. "Array size with count: ".count($new_array).'<br>';  
for ($i = 2; $i <= count($new_array)-1; $i++) {
    echo $new_array[$i].'<br>';
	
	$sql="INSERT INTO Assemblies (checkout, Component_N) VALUES ('". $_GET["New_checkout"]. "', '". $new_array[$i].  "')";
	echo $sql.'<br>';

	mysql_query($sql) or die(mysql_error());
	}


# The following two lines insert a record into tabs_status.deployment_table2.
# This is a mistake, it should be inserted from the file Add_many.php
# Therefore blocked here.
# If there is other problem, somewhere else, we need to change here later.
$sql_2 = "INSERT INTO tabs_status.deployment_table2 (checkout, Depl_time) VALUES ('". $_GET["New_checkout"]. "', '2050-00-01')";
# mysql_query($sql_2) or die(mysql_error());

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./Rebuild.php?New_checkout=<?=$_GET["New_checkout"];?>&Old_checkout=<? echo $_GET['Old_checkout'];?>";
	//"../../Buoy-log/Deployment/deployment.php"
}
//-->
// setTimeout(redirect_page,5000);

</script>
<a href="./Rebuild.php?New_checkout=<?=$_GET["New_checkout"];?>&Old_checkout=<? echo $_GET['Old_checkout'];?>">
Next</a>
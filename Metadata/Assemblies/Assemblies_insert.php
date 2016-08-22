<?php
include ("../../Buoy-log/Deployment/authorization.php");
?>
<?php

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("Metadata");

$sql="INSERT INTO Assemblies (checkout) VALUES ('". $_GET["checkout"]. "')";

echo $sql.'<br>';

# mysql_query($sql) or die(mysql_error());

echo '$_GET[checkout]: '.$_GET["checkout"].'<br>';
print_r($_GET);

echo '<br>'.'<br>';

while (list($key, $value) = each($_GET)){
	echo "key $key has value $value <br>";
	$new_array[]= $value;
}

print_r($new_array);

echo '<br>'. "Array size with count: ".count($new_array).'<br>';  
for ($i = 1; $i <= count($new_array)-1; $i++) {
    echo $new_array[$i].'<br>';
	
	
$sql="INSERT INTO Assemblies (checkout, Component_N) VALUES ('". $_GET["checkout"]. "', '". $new_array[$i].  "')";
echo $sql.'<br>';
mysql_query($sql) or die(mysql_error());
	
	
	
}


# echo "1 record added".'<br>'.'<br>';

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./Assembly_one.php" 			//"../../Buoy-log/Deployment/deployment.php"
}
//-->
// setTimeout(redirect_page,500000);

</script>
<a href="./Assembly_one.php?checkout=<?php echo $_GET['checkout']; ?>">    Next</a>
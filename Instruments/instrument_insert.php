<?php
  session_start();
  if ($_SESSION["person"] == ""){
		echo '<script type="text/javascript">';
		echo 'window.location = "./instrument.php";';
		echo '</script>';
  }  
?>

<?php

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("tabs_status");

# $_POST["Assembly_N"] = $_POST["SeaPac_SN"]. "-". $_POST["Start_Date"];

$sql="INSERT INTO instrument_table (Assembly_N) VALUES('". $_POST["Assembly_N"]. "')";

echo $sql.'<br>';

mysql_query($sql) or die(mysql_error());

echo '$_POST[Assembly_N]: '.$_POST["Assembly_N"].'<br>';
echo "1 record added".'<br>'.'<br>';

 
mysql_close($con);
echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "./instrument.php"
}
//-->
setTimeout(redirect_page, 250);

</script>
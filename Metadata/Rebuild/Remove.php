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

$con = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
mysql_select_db("Metadata");


echo "Old Assembly Number: ". $_SESSION["Old_checkout"]. '<br>';
echo "New Assembly Number: ". $_SESSION["New_checkout"]. '<br>';

echo "The _GET[Component_N]: ". $_GET["Assembly_ordinal"]. '<br>';


$sql='DELETE FROM Assemblies WHERE Ordinal = "'. $_GET["Assembly_ordinal"].  '"';


echo '<br>'. 'The commend: '. $sql.'<br>';

mysql_query($sql) or die(mysql_error());

 
mysql_close($con);

echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
 ?> 
 


<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location.href = "./Rebuild.php?New_checkout=<?=$_GET["New_checkout"];?>&Old_checkout=<? echo $_GET['Old_checkout'];?>" ; 

}
//-->
setTimeout(redirect_page,500);

</script>
<a href="./Assembly_one.php?checkout=<?php echo $_GET['checkout']; ?>">    Next</a>
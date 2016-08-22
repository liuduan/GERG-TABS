<?php
include ("../../Deployment/authorization.php");
?>
<html>
<head>
<title>Edit 3</title>
</head>
<body>
<?php

echo $_POST["field3"].'<br>';
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "UPDATE TABSI_table2 SET ";

	$strSQL .=" field70 = '".$_POST["field70"]."'";						# Be aware not be begin with ","
	$strSQL .=", field70_sig = '".$_POST["field70_sig"]."'";
	$strSQL .=", field71 = '".$_POST["field71"]."'";
	$strSQL .=", field71_sig = '".$_POST["field71_sig"]."'";
	$strSQL .=", field72 = '".$_POST["field72"]."'";
	$strSQL .=", field72_sig = '".$_POST["field72_sig"]."'";
	$strSQL .=", field73 = '".$_POST["field73"]."'";	
	$strSQL .=", field73_sig = '".$_POST["field73_sig"]."'";
	$strSQL .=", field74 = '".$_POST["field74"]."'";
	$strSQL .=", field74_sig = '".$_POST["field74_sig"]."'";
	$strSQL .=", field75 = '".$_POST["field75"]."'";
	$strSQL .=", field75_sig = '".$_POST["field75_sig"]."'";
	$strSQL .=", field76 = '".$_POST["field76"]."'";
	$strSQL .=", field76_sig = '".$_POST["field76_sig"]."'";
	$strSQL .=", field77 = '".$_POST["field77"]."'";
	$strSQL .=", field77_sig = '".$_POST["field77_sig"]."'";
	$strSQL .=", field78 = '".$_POST["field78"]."'";
	$strSQL .=", field78_sig = '".$_POST["field78_sig"]."'";
	$strSQL .=", field79 = '".$_POST["field79"]."'";	
	$strSQL .=", field79_sig = '".$_POST["field79_sig"]. "'";
	
	$strSQL .=", field80 = '".$_POST["field80"]."'";						
	$strSQL .=", field80_sig = '".$_POST["field80_sig"]."'";
	$strSQL .=", field81 = '".$_POST["field81"]."'";
	$strSQL .=", field81_sig = '".$_POST["field81_sig"]."'";
	$strSQL .=", field82 = '".$_POST["field82"]."'";
	$strSQL .=", field82_sig = '".$_POST["field82_sig"]."'";
	$strSQL .=", field83 = '".$_POST["field83"]."'";	
	$strSQL .=", field83_sig = '".$_POST["field83_sig"]."'";
	$strSQL .=", field84 = '".$_POST["field84"]."'";
	$strSQL .=", field84_sig = '".$_POST["field84_sig"]."'";
	$strSQL .=", field85 = '".$_POST["field85"]."'";
	$strSQL .=", field85_sig = '".$_POST["field85_sig"]."'";
	$strSQL .=", field86 = '".$_POST["field86"]."'";
	$strSQL .=", field86_sig = '".$_POST["field86_sig"]."'";
	$strSQL .=", field87 = '".$_POST["field87"]."'";
	$strSQL .=", field87_sig = '".$_POST["field87_sig"]."'";
	$strSQL .=", field88 = '".$_POST["field88"]."'";
	$strSQL .=", field88_sig = '". $_POST["field88_sig"]. "'";
	$strSQL .=", field89 = '". $_POST["field89"]. "'";	
	$strSQL .=", field89_sig = '". $_POST["field89_sig"]. "'";
	
	$strSQL .=", field90 = '". $_POST["field90"]."'";						
	$strSQL .=", field90_sig = '".$_POST["field90_sig"]."'";
	$strSQL .=", field91 = '".$_POST["field91"]."'";
	$strSQL .=", field91_sig = '".$_POST["field91_sig"]."'";
	$strSQL .=", field92 = '".$_POST["field92"]."'";
	$strSQL .=", field92_sig = '".$_POST["field92_sig"]."'";
	$strSQL .=", field93 = '".$_POST["field93"]."'";	
	$strSQL .=", field93_sig = '".$_POST["field93_sig"]."'";
	$strSQL .=", field94 = '".$_POST["field94"]."'";
	$strSQL .=", field94_sig = '".$_POST["field94_sig"]."'";
	$strSQL .=", field95 = '".$_POST["field95"]."'";
	$strSQL .=", field95_sig = '".$_POST["field95_sig"]."'";
	$strSQL .=", field96 = '".$_POST["field96"]."'";
	$strSQL .=", field96_sig = '".$_POST["field96_sig"]."'";
	$strSQL .=", field97 = '".$_POST["field97"]."'";
	$strSQL .=", field97_sig = '".$_POST["field97_sig"]."'";
	$strSQL .=", field98 = '".$_POST["field98"]."'";
	$strSQL .=", field98_sig = '".$_POST["field98_sig"]."'";
	$strSQL .=", field99 = '".$_POST["field99"]."'";	
	$strSQL .=", field99_sig = '".$_POST["field99_sig"]."'";
	
	$strSQL .=", field100 = '".$_POST["field100"]."'";						
	$strSQL .=", field100_sig = '".$_POST["field100_sig"]."'";
	$strSQL .=", field101 = '".$_POST["field101"]."'";
	$strSQL .=", field101_sig = '".$_POST["field101_sig"]."'";
	$strSQL .=", field102 = '".$_POST["field102"]."'";
	$strSQL .=", field102_sig = '".$_POST["field102_sig"]."'";
	$strSQL .=", field103 = '".$_POST["field103"]."'";	
	$strSQL .=", field103_sig = '".$_POST["field103_sig"]."'";
	$strSQL .=", field104 = '".$_POST["field104"]."'";
	$strSQL .=", field104_sig = '".$_POST["field104_sig"]."'";
	$strSQL .=", field105 = '".$_POST["field105"]."'";
	$strSQL .=", field105_sig = '".$_POST["field105_sig"]."'";
	$strSQL .=", field106 = '".$_POST["field106"]."'";
	$strSQL .=", field106_sig = '".$_POST["field106_sig"]."'";
	$strSQL .=", field107 = '".$_POST["field107"]."'";
	$strSQL .=", field107_sig = '".$_POST["field107_sig"]."'";
	$strSQL .=", field108 = '".$_POST["field108"]."'";
	$strSQL .=", field108_sig = '".$_POST["field108_sig"]."'";
	$strSQL .=", field109 = '".$_POST["field109"]."'";	
	$strSQL .=", field109_sig = '".$_POST["field109_sig"]."'";
	
	$strSQL .=", field110 = '".$_POST["field110"]."'";						
	$strSQL .=", field110_sig = '".$_POST["field110_sig"]."'";
	$strSQL .=", field111 = '".$_POST["field111"]."'";
	$strSQL .=", field111_sig = '".$_POST["field111_sig"]."'";
	$strSQL .=", field112 = '".$_POST["field112"]."'";
	$strSQL .=", field112_sig = '".$_POST["field112_sig"]."'";
	$strSQL .=", field113 = '".$_POST["field113"]."'";	
	$strSQL .=", field113b = '".$_POST["field113b"]."'";	
	$strSQL .=", field113_sig = '".$_POST["field113_sig"]."'";
	$strSQL .=", field114 = '".$_POST["field114"]."'";
	$strSQL .=", field114_sig = '".$_POST["field114_sig"]."'";
	$strSQL .=", field115 = '".$_POST["field115"]."'";
	$strSQL .=", field115_sig = '".$_POST["field115_sig"]."'";
	$strSQL .=", field116 = '".$_POST["field116"]."'";
	$strSQL .=", field116_sig = '".$_POST["field116_sig"]."'";
	$strSQL .=", field117 = '".$_POST["field117"]."'";
	$strSQL .=", field117_sig = '".$_POST["field117_sig"]."'";
	$strSQL .=", field118 = '".$_POST["field118"]."'";
	$strSQL .=", field118_sig = '".$_POST["field118_sig"]."'";
	
	
	$strSQL .=" WHERE checkout = '".$_GET["checkout"]."' ";
	
echo $strSQL. '<br>'.'<br>';
	$objQuery = mysql_query($strSQL) or die(mysql_error());
	
echo ", field66 = '".$_POST["field66"]."'". '<br>'.'<br>';
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	echo $strSQL;
	if($objQuery)
	{
		echo "Save completed.";
		echo '<br> <br><br><br><center>Redirect in 5 seconds</center>';
	}
	else
	{
		echo '$$strSQL;'. $strSQL;
		echo "Error Save [".$strSQL."]";
	}
	mysql_close($objConnect);
?>

<script type="text/javascript">

<!--
function redirect_page(){
	document.write('Redirect in 5 Seconds');
	window.location = "../TABSI_edit1.php"
}
//-->


</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
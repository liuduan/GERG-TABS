<?php
include ("../Deployment/authorization.php");
?>

<html>
<head>
<title>Edit 3</title>
</head>
<body>
<?php
echo "The _POST array:";
print_r($_POST);
echo '<br>';



echo $_POST["field3"].'<br>';
	$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
	$objDB = mysql_select_db("tabs_status");
	$strSQL = "UPDATE TABSII_table SET ";
	
	$strSQL .="checkout = '".$_GET["checkout"]."'";
	$strSQL .=", old_checkout = '".$_POST["old_checkout"]."'";
	$strSQL .=", system_SN = '".$_POST["system_SN"]."'";
	$strSQL .=", start_date = '".$_POST["start_date"]."'";
	$strSQL .=", current_sensor = '".$_POST["current_sensor"]."'";
	$strSQL .=", Hull = '".$_POST["Hull"]."'";
	$strSQL .=", Site = '".$_POST["Site"]."'";
	$strSQL .=", PTT_ID = '".$_POST["PTT_ID"]."'";
	$strSQL .=", PTT_SN = '".$_POST["PTT_SN"]."'";
	$strSQL .=", Modem_ESN = '".$_POST["Modem_ESN"]."'";
	$strSQL .=", Phone = '".$_POST["Phone"]."'";
	$strSQL .=", Technicians = '".$_POST["Technicians"]."'";

	$strSQL .=", field11 = '".$_POST["field11"]."'";
	$strSQL .=", field12 = '".$_POST["field12"]."'";	
	$strSQL .=", field13 = '".$_POST["field13"]."'";
	$strSQL .=", field14 = '".$_POST["field14"]."'";
	$strSQL .=", field15 = '".$_POST["field15"]."'";
	$strSQL .=", field15b = '".$_POST["field15b"]."'";
	$strSQL .=", field16 = '".$_POST["field16"]."'";
	$strSQL .=", field16b = '".$_POST["field16b"]."'";
	$strSQL .=", field17 = '".$_POST["field17"]."'";
	$strSQL .=", field17b = '".$_POST["field17b"]."'";
	$strSQL .=", field18a = '".$_POST["field18a"]."'";
	$strSQL .=", field18b = '".$_POST["field18b"]."'";
	$strSQL .=", field18c = '".$_POST["field18c"]."'";
	$strSQL .=", field18m = '".$_POST["field18m"]."'";
	$strSQL .=", field18s = '".$_POST["field18s"]."'";
	$strSQL .=", field19 = '".$_POST["field19"]."'";
	$strSQL .=", field19b = '".$_POST["field19b"]."'";
	
	$strSQL .=", field20a = '".$_POST["field20a"]."'";
	$strSQL .=", field20b = '".$_POST["field20b"]."'";
	$strSQL .=", field20c = '".$_POST["field20c"]."'";
	$strSQL .=", field21a = '".$_POST["field21a"]."'";
	$strSQL .=", field21b = '".$_POST["field21b"]."'";
	$strSQL .=", field21c = '".$_POST["field21c"]."'";
	$strSQL .=", field22a = '".$_POST["field22a"]."'";
	$strSQL .=", field22b = '".$_POST["field22b"]."'";
	$strSQL .=", field22c = '".$_POST["field22c"]."'";

	$strSQL .=", Battery = '".$_POST["Battery"]."'";
	$strSQL .=", Battery_type = '".$_POST["Battery_type"]."'";
	$strSQL .=", Battery_manu = '".$_POST["Battery_manu"]."'";
	$strSQL .=", Battery_sig = '".$_POST["Battery_sig"]."'";

	$strSQL .=", field23a = '".$_POST["field23a"]."'";
	$strSQL .=", field23b = '".$_POST["field23b"]."'";
	$strSQL .=", field24a = '".$_POST["field24a"]."'";
	$strSQL .=", field24b = '".$_POST["field24b"]."'";
	$strSQL .=", field25a = '".$_POST["field25a"]."'";
	$strSQL .=", field25b = '".$_POST["field25b"]."'";

	$strSQL .=", field23_sig = '".$_POST["field23_sig"]."'";
	$strSQL .=", field24_sig = '".$_POST["field24_sig"]."'";
	$strSQL .=", field25_sig = '".$_POST["field25_sig"]."'";
					
	$strSQL .=", field26a = '".$_POST["field26a"]."'";
	$strSQL .=", field26b = '".$_POST["field26b"]."'";
	$strSQL .=", field27a = '".$_POST["field27a"]."'";
	$strSQL .=", field27b = '".$_POST["field27b"]."'";
	$strSQL .=", field28a = '".$_POST["field28a"]."'";
	$strSQL .=", field28b = '".$_POST["field28b"]."'";
	$strSQL .=", field29a = '".$_POST["field29a"]."'";
	$strSQL .=", field29b = '".$_POST["field29b"]."'";	
	$strSQL .=", field30a = '".$_POST["field30a"]."'";
	$strSQL .=", field30b = '".$_POST["field30b"]."'";
	
	$strSQL .=", field26_sig = '".$_POST["field26_sig"]."'";
	$strSQL .=", field27_sig = '".$_POST["field27_sig"]."'";
	$strSQL .=", field28_sig = '".$_POST["field28_sig"]."'";
	$strSQL .=", field29_sig = '".$_POST["field29_sig"]."'";
	$strSQL .=", field30_sig = '".$_POST["field30_sig"]."'";

	$strSQL .=", field31a = '".$_POST["field31a"]."'";
	$strSQL .=", field31b = '".$_POST["field31b"]."'";
	$strSQL .=", field32a = '".$_POST["field32a"]."'";
	$strSQL .=", field32b = '".$_POST["field32b"]."'";	
	$strSQL .=", field33a = '".$_POST["field33a"]."'";
	$strSQL .=", field33b = '".$_POST["field33b"]."'";
	$strSQL .=", field34a = '".$_POST["field34a"]."'";
	$strSQL .=", field34b = '".$_POST["field34b"]."'";
	$strSQL .=", field35a = '".$_POST["field35a"]."'";
	$strSQL .=", field35b = '".$_POST["field35b"]."'";
	
	$strSQL .=", field31_sig = '".$_POST["field31_sig"]."'";
	$strSQL .=", field32_sig = '".$_POST["field32_sig"]."'";
	$strSQL .=", field33_sig = '".$_POST["field33_sig"]."'";
	$strSQL .=", field34_sig = '".$_POST["field34_sig"]."'";
	$strSQL .=", field35_sig = '".$_POST["field35_sig"]."'";
		
	$strSQL .=", field36a = '".$_POST["field36a"]."'";
	$strSQL .=", field36b = '".$_POST["field36b"]."'";
	$strSQL .=", field37a = '".$_POST["field37a"]."'";
	$strSQL .=", field37b = '".$_POST["field37b"]."'";
	$strSQL .=", field38a = '".$_POST["field38a"]."'";
	$strSQL .=", field38b = '".$_POST["field38b"]."'";	

	$strSQL .=", field36_sig = '".$_POST["field36_sig"]."'";
	$strSQL .=", field37_sig = '".$_POST["field37_sig"]."'";
	$strSQL .=", field38_sig = '".$_POST["field38_sig"]."'";

	$strSQL .=", field39 = '".$_POST["field39"]."'";	
	$strSQL .=", field40 = '".$_POST["field40"]."'";
	$strSQL .=", field41 = '".$_POST["field41"]."'";
	$strSQL .=", field42 = '".$_POST["field42"]."'";
	$strSQL .=", field43 = '".$_POST["field43"]."'";
	$strSQL .=", field44 = '".$_POST["field44"]."'";
		
	$strSQL .=", field39_sig = '".$_POST["field39_sig"]."'";
	$strSQL .=", field40_sig = '".$_POST["field40_sig"]."'";
	$strSQL .=", field41_sig = '".$_POST["field41_sig"]."'";
	$strSQL .=", field42_sig = '".$_POST["field42_sig"]."'";
	$strSQL .=", field43_sig = '".$_POST["field43_sig"]."'";
	$strSQL .=", field44_sig = '".$_POST["field44_sig"]."'";
	
	$strSQL .=", comments = '".$_POST["comments"]."'";
	
	$strSQL .=", field46 = '".$_POST["field46"]."'";
	$strSQL .=", field47 = '".$_POST["field47"]."'";
	$strSQL .=", field48 = '".$_POST["field48"]."'";
	$strSQL .=", field49 = '".$_POST["field49"]."'";	
	$strSQL .=", field50 = '".$_POST["field50"]."'";

	$strSQL .=", field46_sig = '".$_POST["field46_sig"]."'";
	$strSQL .=", field47_sig = '".$_POST["field47_sig"]."'";
	$strSQL .=", field48_sig = '".$_POST["field48_sig"]."'";		
	$strSQL .=", field49_sig = '".$_POST["field49_sig"]."'";
	$strSQL .=", field50_sig = '".$_POST["field50_sig"]."'";
	
	$strSQL .=", field51 = '".$_POST["field51"]."'";
	$strSQL .=", field52 = '".$_POST["field52"]."'";
	$strSQL .=", field53 = '".$_POST["field53"]."'";
	$strSQL .=", field54 = '".$_POST["field54"]."'";
	$strSQL .=", field55 = '".$_POST["field55"]."'";		
	$strSQL .=", field56 = '".$_POST["field56"]."'";
	$strSQL .=", field57 = '".$_POST["field57"]."'";
	$strSQL .=", field58 = '".$_POST["field58"]."'";
	$strSQL .=", field59 = '".$_POST["field59"]."'";	

	$strSQL .=", field51_sig = '".$_POST["field51_sig"]."'";
	$strSQL .=", field52_sig = '".$_POST["field52_sig"]."'";
	$strSQL .=", field53_sig = '".$_POST["field53_sig"]."'";
	$strSQL .=", field54_sig = '".$_POST["field54_sig"]."'";
	$strSQL .=", field55_sig = '".$_POST["field55_sig"]."'";
	$strSQL .=", field56_sig = '".$_POST["field56_sig"]."'";
	$strSQL .=", field57_sig = '".$_POST["field57_sig"]."'";
	$strSQL .=", field58_sig = '".$_POST["field58_sig"]."'";		
	$strSQL .=", field59_sig = '".$_POST["field59_sig"]."'";
	
	$strSQL .=", field60 = '".$_POST["field60"]."'";	
	$strSQL .=", field61 = '".$_POST["field61"]."'";
	$strSQL .=", field62 = '".$_POST["field62"]."'";
	$strSQL .=", field63 = '".$_POST["field63"]."'";
	$strSQL .=", field64 = '".$_POST["field64"]."'";
	$strSQL .=", field65 = '".$_POST["field65"]."'";		
	$strSQL .=", field66 = '".$_POST["field66"]."'";
	$strSQL .=", field67 = '".$_POST["field67"]."'";
	$strSQL .=", field68 = '".$_POST["field68"]."'";
	$strSQL .=", field69 = '".$_POST["field69"]."'";	

	$strSQL .=", field60_sig = '".$_POST["field60_sig"]."'";
	$strSQL .=", field61_sig = '".$_POST["field61_sig"]."'";
	$strSQL .=", field62_sig = '".$_POST["field62_sig"]."'";
	$strSQL .=", field63_sig = '".$_POST["field63_sig"]."'";
	$strSQL .=", field64_sig = '".$_POST["field64_sig"]."'";
	$strSQL .=", field65_sig = '".$_POST["field65_sig"]."'";
	$strSQL .=", field66_sig = '".$_POST["field66_sig"]."'";
	$strSQL .=", field67_sig = '".$_POST["field67_sig"]."'";
	$strSQL .=", field68_sig = '".$_POST["field68_sig"]."'";		
	$strSQL .=", field69_sig = '".$_POST["field69_sig"]."'";
	
	$strSQL .=", field70 = '".$_POST["field70"]."'";	
	$strSQL .=", field71 = '".$_POST["field71"]."'";
	$strSQL .=", field72 = '".$_POST["field72"]."'";
	$strSQL .=", field73 = '".$_POST["field73"]."'";
	$strSQL .=", field74 = '".$_POST["field74"]."'";
	$strSQL .=", field75 = '".$_POST["field75"]."'";		
	$strSQL .=", field76 = '".$_POST["field76"]."'";
	$strSQL .=", field77 = '".$_POST["field77"]."'";
	$strSQL .=", field78 = '".$_POST["field78"]."'";
	$strSQL .=", field79 = '".$_POST["field79"]."'";	

	$strSQL .=", field70_sig = '".$_POST["field70_sig"]."'";
	$strSQL .=", field71_sig = '".$_POST["field71_sig"]."'";
	$strSQL .=", field72_sig = '".$_POST["field72_sig"]."'";
	$strSQL .=", field73_sig = '".$_POST["field73_sig"]."'";
	$strSQL .=", field74_sig = '".$_POST["field74_sig"]."'";
	$strSQL .=", field75_sig = '".$_POST["field75_sig"]."'";
	$strSQL .=", field76_sig = '".$_POST["field76_sig"]."'";
	$strSQL .=", field77_sig = '".$_POST["field77_sig"]."'";
	$strSQL .=", field78_sig = '".$_POST["field78_sig"]."'";		
	$strSQL .=", field79_sig = '".$_POST["field79_sig"]."'";
	
	$strSQL .=", field80 = '".$_POST["field80"]."'";	
	$strSQL .=", field81 = '".$_POST["field81"]."'";
	$strSQL .=", field82 = '".$_POST["field82"]."'";
	$strSQL .=", field83 = '".$_POST["field83"]."'";
	$strSQL .=", field84 = '".$_POST["field84"]."'";
	$strSQL .=", field85 = '".$_POST["field85"]."'";		
	$strSQL .=", field86 = '".$_POST["field86"]."'";
	$strSQL .=", field87 = '".$_POST["field87"]."'";
	$strSQL .=", field88 = '".$_POST["field88"]."'";
	$strSQL .=", field89 = '".$_POST["field89"]."'";	

	$strSQL .=", field80_sig = '".$_POST["field80_sig"]."'";
	$strSQL .=", field81_sig = '".$_POST["field81_sig"]."'";
	$strSQL .=", field82_sig = '".$_POST["field82_sig"]."'";
	$strSQL .=", field83_sig = '".$_POST["field83_sig"]."'";
	$strSQL .=", field84_sig = '".$_POST["field84_sig"]."'";
	$strSQL .=", field85_sig = '".$_POST["field85_sig"]."'";
	$strSQL .=", field86_sig = '".$_POST["field86_sig"]."'";
	$strSQL .=", field87_sig = '".$_POST["field87_sig"]."'";
	$strSQL .=", field88_sig = '".$_POST["field88_sig"]."'";		
	$strSQL .=", field89_sig = '".$_POST["field89_sig"]."'";
	
	
	$strSQL .=", field90 = '".$_POST["field90"]."'";	
	$strSQL .=", field91 = '".$_POST["field91"]."'";
	$strSQL .=", field92 = '".$_POST["field92"]."'";
	$strSQL .=", field93 = '".$_POST["field93"]."'";
	$strSQL .=", field94 = '".$_POST["field94"]."'";
	$strSQL .=", field95 = '".$_POST["field95"]."'";		
	$strSQL .=", field96 = '".$_POST["field96"]."'";
	$strSQL .=", field97 = '".$_POST["field97"]."'";

	$strSQL .=", field90_sig = '".$_POST["field90_sig"]."'";
	$strSQL .=", field91_sig = '".$_POST["field91_sig"]."'";
	$strSQL .=", field92_sig = '".$_POST["field92_sig"]."'";
	$strSQL .=", field93_sig = '".$_POST["field93_sig"]."'";
	$strSQL .=", field94_sig = '".$_POST["field94_sig"]."'";
	$strSQL .=", field95_sig = '".$_POST["field95_sig"]."'";
	$strSQL .=", field96_sig = '".$_POST["field96_sig"]."'";
	$strSQL .=", field97_sig = '".$_POST["field97_sig"]."'";
	
	$strSQL .=" WHERE checkout = '".$_GET["checkout"]."' ";
	
echo $strSQL. '<br>'.'<br>';

	# This line update the fields.
	$objQuery = mysql_query($strSQL) or die(mysql_error());
	
	

	
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
	window.location = "http://tabs2.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php"
}
//-->
setTimeout(redirect_page, 50);

</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
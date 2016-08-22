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
	$strSQL = "UPDATE TABS225m SET ";
	
	$strSQL .="checkout = '".$_GET["checkout"]."'";
	$strSQL .=", old_checkout = '".$_POST["old_checkout"]."'";
	$strSQL .=", system_SN = '".$_POST["system_SN"]."'";
	$strSQL .=", start_date = '".$_POST["start_date"]."'";
	$strSQL .=", ARGOS = '".$_POST["ARGOS"]."'";
	$strSQL .=", Hull_SN = '".$_POST["Hull_SN"]."'";
	$strSQL .=", Site = '".$_POST["Site"]."'";
	$strSQL .=", Inventory_N = '".$_POST["Inventory_N"]."'";
	$strSQL .=", PTT_SN = '".$_POST["PTT_SN"]."'";
	$strSQL .=", HEX_ESN = '".$_POST["HEX_ESN"]."'";
	$strSQL .=", Phone = '".$_POST["Phone"]."'";
	$strSQL .=", Technicians = '".$_POST["Technicians"]."'";

	$strSQL .=", field11a = '".$_POST["field11a"]."'";
	$strSQL .=", field12a = '".$_POST["field12a"]."'";	
	$strSQL .=", field13a = '".$_POST["field13a"]."'";
	$strSQL .=", field14a = '".$_POST["field14a"]."'";
	$strSQL .=", field15a = '".$_POST["field15a"]."'";
	$strSQL .=", field16a = '".$_POST["field16a"]."'";
	$strSQL .=", field17a = '".$_POST["field17a"]."'";
	$strSQL .=", field18a = '".$_POST["field18a"]."'";
	$strSQL .=", field19a = '".$_POST["field19a"]."'";
	
	$strSQL .=", field11b = '".$_POST["field11b"]."'";
	$strSQL .=", field12b = '".$_POST["field12b"]."'";	
	$strSQL .=", field13b = '".$_POST["field13b"]."'";
	$strSQL .=", field14b = '".$_POST["field14b"]."'";
	$strSQL .=", field15b = '".$_POST["field15b"]."'";
	$strSQL .=", field16b = '".$_POST["field16b"]."'";
	$strSQL .=", field17b = '".$_POST["field17b"]."'";
	$strSQL .=", field18b = '".$_POST["field18b"]."'";
	$strSQL .=", field19b = '".$_POST["field19b"]."'";
	
	$strSQL .=", field11c = '".$_POST["field11c"]."'";
	$strSQL .=", field13c = '".$_POST["field13c"]."'";	
	
	$strSQL .=", field20a = '".$_POST["field20a"]."'";
	$strSQL .=", field20b = '".$_POST["field20b"]."'";
	$strSQL .=", field21a = '".$_POST["field21a"]."'";
	$strSQL .=", field21b = '".$_POST["field21b"]."'";
	$strSQL .=", field21c = '".$_POST["field21c"]."'";	
	$strSQL .=", field22a = '".$_POST["field22a"]."'";
	$strSQL .=", field22b = '".$_POST["field22b"]."'";
	$strSQL .=", field23a = '".$_POST["field23a"]."'";
	$strSQL .=", field23b = '".$_POST["field23b"]."'";
	$strSQL .=", field24a = '".$_POST["field24a"]."'";
	$strSQL .=", field24b = '".$_POST["field24b"]."'";
	$strSQL .=", field25a = '".$_POST["field25a"]."'";
	$strSQL .=", field25b = '".$_POST["field25b"]."'";
	$strSQL .=", field25c = '".$_POST["field25c"]."'";

	$strSQL .=", field26a = '".$_POST["field26a"]."'";
	$strSQL .=", field26b = '".$_POST["field26b"]."'";
	$strSQL .=", field26c = '".$_POST["field26c"]."'";
	$strSQL .=", field27a = '".$_POST["field27a"]."'";
	$strSQL .=", field27b = '".$_POST["field27b"]."'";
	
	$strSQL .=", Notes = '".$_POST["Notes"]."'";
		
	$strSQL .=", field29a = '".$_POST["field29a"]."'";
	$strSQL .=", field29b = '".$_POST["field29b"]."'";	
	$strSQL .=", field30a = '".$_POST["field30a"]."'";
	$strSQL .=", field30b = '".$_POST["field30b"]."'";
	$strSQL .=", field30c = '".$_POST["field30c"]."'";

	$strSQL .=", field31a = '".$_POST["field31a"]."'";
	$strSQL .=", field31b = '".$_POST["field31b"]."'";
	
	$strSQL .=", field32a = '".$_POST["field32a"]."'";
	$strSQL .=", field32b = '".$_POST["field32b"]."'";	
	$strSQL .=", field32c = '".$_POST["field32c"]."'";	
	$strSQL .=", field33a = '".$_POST["field33a"]."'";
	$strSQL .=", field33b = '".$_POST["field33b"]."'";
	$strSQL .=", field33c = '".$_POST["field33c"]."'";
	$strSQL .=", field33d = '".$_POST["field33d"]."'";
	
	$strSQL .=", field34a = '".$_POST["field34a"]."'";
	$strSQL .=", field34b = '".$_POST["field34b"]."'";
	$strSQL .=", field35a = '".$_POST["field35a"]."'";
	$strSQL .=", field35b = '".$_POST["field35b"]."'";

	$strSQL .=", field36a = '".$_POST["field36a"]."'";
	$strSQL .=", field36b = '".$_POST["field36b"]."'";
	
	$strSQL .=", field37 = '".$_POST["field37"]."'";
	$strSQL .=", field38 = '".$_POST["field38"]."'";
	$strSQL .=", field39 = '".$_POST["field39"]."'";	

	$strSQL .=", field29_sig = '".$_POST["field29_sig"]."'";
	
	$strSQL .=", field30_sig = '".$_POST["field30_sig"]."'";	
	$strSQL .=", field31_sig = '".$_POST["field31_sig"]."'";
	$strSQL .=", field32_sig = '".$_POST["field32_sig"]."'";
	$strSQL .=", field33_sig = '".$_POST["field33_sig"]."'";
	$strSQL .=", field34_sig = '".$_POST["field34_sig"]."'";
	$strSQL .=", field35_sig = '".$_POST["field35_sig"]."'";
	$strSQL .=", field36_sig = '".$_POST["field36_sig"]."'";
	$strSQL .=", field37_sig = '".$_POST["field37_sig"]."'";
	$strSQL .=", field38_sig = '".$_POST["field38_sig"]."'";
	$strSQL .=", field39_sig = '".$_POST["field39_sig"]."'";

	$strSQL .=", field40 = '".$_POST["field40"]."'";
	$strSQL .=", field41 = '".$_POST["field41"]."'";
	$strSQL .=", field42 = '".$_POST["field42"]."'";
	$strSQL .=", field43 = '".$_POST["field43"]."'";
	$strSQL .=", field44 = '".$_POST["field44"]."'";
	$strSQL .=", field45 = '".$_POST["field45"]."'";		
	$strSQL .=", field46 = '".$_POST["field46"]."'";
	$strSQL .=", field47 = '".$_POST["field47"]."'";
	$strSQL .=", field48 = '".$_POST["field48"]."'";
	$strSQL .=", field49 = '".$_POST["field49"]."'";	
	
	$strSQL .=", field40_sig = '".$_POST["field40_sig"]."'";
	$strSQL .=", field41_sig = '".$_POST["field41_sig"]."'";
	$strSQL .=", field42_sig = '".$_POST["field42_sig"]."'";
	$strSQL .=", field43_sig = '".$_POST["field43_sig"]."'";
	$strSQL .=", field44_sig = '".$_POST["field44_sig"]."'";
	$strSQL .=", field45_sig = '".$_POST["field45_sig"]."'";
	$strSQL .=", field46_sig = '".$_POST["field46_sig"]."'";
	$strSQL .=", field47_sig = '".$_POST["field47_sig"]."'";
	$strSQL .=", field48_sig = '".$_POST["field48_sig"]."'";		
	$strSQL .=", field49_sig = '".$_POST["field49_sig"]."'";	
	
	$strSQL .=", field50 = '".$_POST["field50"]."'";
	$strSQL .=", field51 = '".$_POST["field51"]."'";
	$strSQL .=", field52 = '".$_POST["field52"]."'";
	$strSQL .=", field53 = '".$_POST["field53"]."'";
	$strSQL .=", field54 = '".$_POST["field54"]."'";
	$strSQL .=", field55 = '".$_POST["field55"]."'";		
	$strSQL .=", field56 = '".$_POST["field56"]."'";
	
	$strSQL .=", field57a = '".$_POST["field57a"]."'";
	$strSQL .=", field58a = '".$_POST["field58a"]."'";
	$strSQL .=", field59a = '".$_POST["field59a"]."'";	

	$strSQL .=", field57b = '".$_POST["field57b"]."'";
	$strSQL .=", field58b = '".$_POST["field58b"]."'";
	$strSQL .=", field59b = '".$_POST["field59b"]."'";	

	$strSQL .=", field50_sig = '".$_POST["field50_sig"]."'";
	$strSQL .=", field51_sig = '".$_POST["field51_sig"]."'";
	$strSQL .=", field52_sig = '".$_POST["field52_sig"]."'";
	$strSQL .=", field53_sig = '".$_POST["field53_sig"]."'";
	$strSQL .=", field54_sig = '".$_POST["field54_sig"]."'";
	$strSQL .=", field55_sig = '".$_POST["field55_sig"]."'";
	$strSQL .=", field56_sig = '".$_POST["field56_sig"]."'";
	$strSQL .=", field57_sig = '".$_POST["field57_sig"]."'";
	$strSQL .=", field58_sig = '".$_POST["field58_sig"]."'";		
	$strSQL .=", field59_sig = '".$_POST["field59_sig"]."'";
	
	$strSQL .=", field60a = '".$_POST["field60a"]."'";	
	$strSQL .=", field61a = '".$_POST["field61a"]."'";
	$strSQL .=", field62a = '".$_POST["field62a"]."'";
	$strSQL .=", field63a = '".$_POST["field63a"]."'";
	$strSQL .=", field64a = '".$_POST["field64a"]."'";
	$strSQL .=", field65a = '".$_POST["field65a"]."'";		
	$strSQL .=", field66a = '".$_POST["field66a"]."'";
	$strSQL .=", field67a = '".$_POST["field67a"]."'";
	$strSQL .=", field68a = '".$_POST["field68a"]."'";
	$strSQL .=", field69a = '".$_POST["field69a"]."'";	
	
	$strSQL .=", field60b = '".$_POST["field60b"]."'";	
	$strSQL .=", field61b = '".$_POST["field61b"]."'";
	$strSQL .=", field62b = '".$_POST["field62b"]."'";
	$strSQL .=", field63b = '".$_POST["field63b"]."'";
	$strSQL .=", field64b = '".$_POST["field64b"]."'";
	$strSQL .=", field65b = '".$_POST["field65b"]."'";		
	$strSQL .=", field66b = '".$_POST["field66b"]."'";
	$strSQL .=", field67b = '".$_POST["field67b"]."'";
	$strSQL .=", field68b = '".$_POST["field68b"]."'";
	$strSQL .=", field69b = '".$_POST["field69b"]."'";	

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

	
	$strSQL .=", field70a = '".$_POST["field70a"]."'";	
	$strSQL .=", field71a = '".$_POST["field71a"]."'";
	$strSQL .=", field72a = '".$_POST["field72a"]."'";
	$strSQL .=", field73a = '".$_POST["field73a"]."'";
	$strSQL .=", field74a = '".$_POST["field74a"]."'";
	$strSQL .=", field75a = '".$_POST["field75a"]."'";		
	$strSQL .=", field76a = '".$_POST["field76a"]."'";
	$strSQL .=", field77a = '".$_POST["field77a"]."'";
	$strSQL .=", field78a = '".$_POST["field78a"]."'";
	$strSQL .=", field79a = '".$_POST["field79a"]."'";	
	
	$strSQL .=", field70b = '".$_POST["field70b"]."'";	
	$strSQL .=", field71b = '".$_POST["field71b"]."'";
	$strSQL .=", field72b = '".$_POST["field72b"]."'";
	$strSQL .=", field73b = '".$_POST["field73b"]."'";
	$strSQL .=", field74b = '".$_POST["field74b"]."'";
	$strSQL .=", field75b = '".$_POST["field75b"]."'";		
	$strSQL .=", field76b = '".$_POST["field76b"]."'";
	$strSQL .=", field77b = '".$_POST["field77b"]."'";
	$strSQL .=", field78b = '".$_POST["field78b"]."'";
	$strSQL .=", field79b = '".$_POST["field79b"]."'";	
	$strSQL .=", field79c = '".$_POST["field79c"]."'";	

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
	

	$strSQL .=", field80a = '".$_POST["field80a"]."'";	
	$strSQL .=", field81a = '".$_POST["field81a"]."'";
	$strSQL .=", field82a = '".$_POST["field82a"]."'";
	$strSQL .=", field83a = '".$_POST["field83a"]."'";
	$strSQL .=", field84a = '".$_POST["field84a"]."'";
	$strSQL .=", field85a = '".$_POST["field85a"]."'";		
	$strSQL .=", field86a = '".$_POST["field86a"]."'";
	$strSQL .=", field87a = '".$_POST["field87a"]."'";
	$strSQL .=", field88a = '".$_POST["field88a"]."'";
	$strSQL .=", field89a = '".$_POST["field89a"]."'";	
	$strSQL .=", field90a = '".$_POST["field90a"]."'";	
	
	$strSQL .=", field80b = '".$_POST["field80b"]."'";	
	$strSQL .=", field81b = '".$_POST["field81b"]."'";
	$strSQL .=", field82b = '".$_POST["field82b"]."'";
	$strSQL .=", field83b = '".$_POST["field83b"]."'";
	$strSQL .=", field84b = '".$_POST["field84b"]."'";
	$strSQL .=", field85b = '".$_POST["field85b"]."'";		
	$strSQL .=", field86b = '".$_POST["field86b"]."'";
	$strSQL .=", field87b = '".$_POST["field87b"]."'";
	$strSQL .=", field88b = '".$_POST["field88b"]."'";
	$strSQL .=", field89b = '".$_POST["field89b"]."'";	
	$strSQL .=", field90b = '".$_POST["field90b"]."'";	

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
	$strSQL .=", field90_sig = '".$_POST["field90_sig"]."'";
	
	$strSQL .=", field92a = '".$_POST["field92a"]."'";	
	$strSQL .=", field92b = '".$_POST["field92b"]."'";	
	$strSQL .=", field92_sig = '".$_POST["field92_sig"]."'";
	
	$strSQL .=", field93a = '".$_POST["field93a"]."'";	
	$strSQL .=", field93b = '".$_POST["field93b"]."'";	
	
	
	
	$strSQL .=", field94a = '".$_POST["field94a"]."'";
	$strSQL .=", field95a = '".$_POST["field95a"]."'";		
	$strSQL .=", field96a = '".$_POST["field96a"]."'";
	$strSQL .=", field97a = '".$_POST["field97a"]."'";
	$strSQL .=", field98a = '".$_POST["field98a"]."'";
	$strSQL .=", field99a = '".$_POST["field99a"]."'";	
	$strSQL .=", field100a = '".$_POST["field100a"]."'";	
	$strSQL .=", field101a = '".$_POST["field101a"]."'";
	
	$strSQL .=", field94b = '".$_POST["field94b"]."'";
	$strSQL .=", field95b = '".$_POST["field95b"]."'";		
	$strSQL .=", field96b = '".$_POST["field96b"]."'";
	$strSQL .=", field97b = '".$_POST["field97b"]."'";
	$strSQL .=", field98b = '".$_POST["field98b"]."'";
	$strSQL .=", field99b = '".$_POST["field99b"]."'";	
	$strSQL .=", field100b = '".$_POST["field100b"]."'";	
	$strSQL .=", field101b = '".$_POST["field101b"]."'";

	$strSQL .=", field94c = '".$_POST["field94c"]."'";
	$strSQL .=", field95c = '".$_POST["field95c"]."'";		
	$strSQL .=", field96c = '".$_POST["field96c"]."'";
	$strSQL .=", field97c = '".$_POST["field97c"]."'";
	$strSQL .=", field98c = '".$_POST["field98c"]."'";
	$strSQL .=", field99c = '".$_POST["field99c"]."'";	
	$strSQL .=", field100c = '".$_POST["field100c"]."'";	
	$strSQL .=", field101c = '".$_POST["field101c"]."'";

	$strSQL .=", field94_sig = '".$_POST["field94_sig"]."'";
	$strSQL .=", field95_sig = '".$_POST["field95_sig"]."'";
	$strSQL .=", field96_sig = '".$_POST["field96_sig"]."'";
	$strSQL .=", field97_sig = '".$_POST["field97_sig"]."'";
	$strSQL .=", field98_sig = '".$_POST["field98_sig"]."'";		
	$strSQL .=", field99_sig = '".$_POST["field99_sig"]."'";
	$strSQL .=", field100_sig = '".$_POST["field100_sig"]."'";
	$strSQL .=", field101_sig = '".$_POST["field101_sig"]."'";
	

	$strSQL .=", field102a = '".$_POST["field102a"]."'";	
	$strSQL .=", field102b = '".$_POST["field102b"]."'";		

	$strSQL .=", field103a = '".$_POST["field103a"]."'";
	$strSQL .=", field104a = '".$_POST["field104a"]."'";	
	
	$strSQL .=", field103b = '".$_POST["field103b"]."'";
	$strSQL .=", field104b = '".$_POST["field104b"]."'";	

	$strSQL .=", field103c = '".$_POST["field103c"]."'";
	$strSQL .=", field104c = '".$_POST["field104c"]."'";	

	$strSQL .=", field103_sig = '".$_POST["field103_sig"]."'";
	$strSQL .=", field104_sig = '".$_POST["field104_sig"]."'";	

	$strSQL .=", field105a = '".$_POST["field105a"]."'";		
	$strSQL .=", field106a = '".$_POST["field106a"]."'";
	$strSQL .=", field107a = '".$_POST["field107a"]."'";
	$strSQL .=", field108a = '".$_POST["field108a"]."'";
	
	$strSQL .=", field105b = '".$_POST["field105b"]."'";		
	$strSQL .=", field106b = '".$_POST["field106b"]."'";
	$strSQL .=", field107b = '".$_POST["field107b"]."'";
	$strSQL .=", field108b = '".$_POST["field108b"]."'";
	
	$strSQL .=", field105_sig = '".$_POST["field105_sig"]."'";
	$strSQL .=", field106_sig = '".$_POST["field106_sig"]."'";
	$strSQL .=", field107_sig = '".$_POST["field107_sig"]."'";
	$strSQL .=", field108_sig = '".$_POST["field108_sig"]."'";		

	$strSQL .=", Comments = '".$_POST["Comments"]."'";
	
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
setTimeout(redirect_page, 250);

</script>

</body>
</html>
<!--- This file download from www.shotdev.com -->
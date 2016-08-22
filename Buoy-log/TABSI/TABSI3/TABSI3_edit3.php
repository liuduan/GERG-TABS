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
	$strSQL = "UPDATE TABSI_table3 SET ";

	$strSQL .=" field140 = '".$_POST["field140"]."'";						# Be aware not be begin with ","
	$strSQL .=", field140_sig = '".$_POST["field140_sig"]."'";
	$strSQL .=", field141 = '".$_POST["field141"]."'";
	$strSQL .=", field141_sig = '".$_POST["field141_sig"]."'";
	$strSQL .=", field142 = '".$_POST["field142"]."'";
	$strSQL .=", field142_sig = '".$_POST["field142_sig"]."'";
	$strSQL .=", field143 = '".$_POST["field143"]."'";	
	$strSQL .=", field143_sig = '".$_POST["field143_sig"]."'";
	$strSQL .=", field144 = '".$_POST["field144"]."'";
	$strSQL .=", field144_sig = '".$_POST["field144_sig"]."'";
	$strSQL .=", field145 = '".$_POST["field145"]."'";
	$strSQL .=", field145_sig = '".$_POST["field145_sig"]."'";
	$strSQL .=", field146 = '".$_POST["field146"]."'";
	$strSQL .=", field146_sig = '".$_POST["field146_sig"]."'";
	$strSQL .=", field147 = '".$_POST["field147"]."'";
	$strSQL .=", field147_sig = '".$_POST["field147_sig"]."'";
	$strSQL .=", field148 = '".$_POST["field148"]."'";
	$strSQL .=", field148_sig = '".$_POST["field148_sig"]."'";
	$strSQL .=", field149 = '".$_POST["field149"]."'";	
	$strSQL .=", field149_sig = '".$_POST["field149_sig"]. "'";
	
	$strSQL .=", field150 = '".$_POST["field150"]."'";						
	$strSQL .=", field150_sig = '".$_POST["field150_sig"]."'";
	$strSQL .=", field151 = '".$_POST["field151"]."'";
	$strSQL .=", field151_sig = '".$_POST["field151_sig"]."'";
	$strSQL .=", field152 = '".$_POST["field152"]."'";
	$strSQL .=", field152_sig = '".$_POST["field152_sig"]."'";
	$strSQL .=", field153 = '".$_POST["field153"]."'";	
	$strSQL .=", field153_sig = '".$_POST["field153_sig"]."'";
	$strSQL .=", field154 = '".$_POST["field154"]."'";
	$strSQL .=", field154_sig = '".$_POST["field154_sig"]."'";
	$strSQL .=", field155 = '".$_POST["field155"]."'";
	$strSQL .=", field155_sig = '".$_POST["field155_sig"]."'";
	$strSQL .=", field156 = '".$_POST["field156"]."'";
	$strSQL .=", field156_sig = '".$_POST["field156_sig"]."'";
	$strSQL .=", field157 = '".$_POST["field157"]."'";
	$strSQL .=", field157_sig = '".$_POST["field157_sig"]."'";
	$strSQL .=", field158 = '".$_POST["field158"]."'";
	$strSQL .=", field158_sig = '". $_POST["field158_sig"]. "'";
	$strSQL .=", field159 = '". $_POST["field159"]. "'";	
	$strSQL .=", field159_sig = '". $_POST["field159_sig"]. "'";
	
	$strSQL .=", field160 = '". $_POST["field160"]."'";						
	$strSQL .=", field160_sig = '".$_POST["field160_sig"]."'";
	$strSQL .=", field161 = '".$_POST["field161"]."'";
	$strSQL .=", field161_sig = '".$_POST["field161_sig"]."'";
	$strSQL .=", field162 = '".$_POST["field162"]."'";
	$strSQL .=", field162_sig = '".$_POST["field162_sig"]."'";
	$strSQL .=", field163 = '".$_POST["field163"]."'";	
	$strSQL .=", field163_sig = '".$_POST["field163_sig"]."'";
	$strSQL .=", field164 = '".$_POST["field164"]."'";
	$strSQL .=", field164_sig = '".$_POST["field164_sig"]."'";
	$strSQL .=", field165 = '".$_POST["field165"]."'";
	$strSQL .=", field165_sig = '".$_POST["field165_sig"]."'";
	$strSQL .=", field166 = '".$_POST["field166"]."'";
	$strSQL .=", field166_sig = '".$_POST["field166_sig"]."'";
	$strSQL .=", field167 = '".$_POST["field167"]."'";
	$strSQL .=", field167_sig = '".$_POST["field167_sig"]."'";
	$strSQL .=", field168 = '".$_POST["field168"]."'";
	$strSQL .=", field168_sig = '".$_POST["field168_sig"]."'";
	$strSQL .=", field169 = '".$_POST["field169"]."'";	
	$strSQL .=", field169_sig = '".$_POST["field169_sig"]."'";
	
	$strSQL .=", field170 = '".$_POST["field170"]."'";						
	$strSQL .=", field170_sig = '".$_POST["field170_sig"]."'";
	$strSQL .=", field171 = '".$_POST["field171"]."'";
	$strSQL .=", field171_sig = '".$_POST["field171_sig"]."'";
	$strSQL .=", field172 = '".$_POST["field172"]."'";
	$strSQL .=", field172_sig = '".$_POST["field172_sig"]."'";
	$strSQL .=", field173 = '".$_POST["field173"]."'";	
	$strSQL .=", field173_sig = '".$_POST["field173_sig"]."'";
	$strSQL .=", field174 = '".$_POST["field174"]."'";
	$strSQL .=", field174_sig = '".$_POST["field174_sig"]."'";
	$strSQL .=", field175 = '".$_POST["field175"]."'";
	$strSQL .=", field175_sig = '".$_POST["field175_sig"]."'";
	$strSQL .=", field176 = '".$_POST["field176"]."'";
	$strSQL .=", field176_sig = '".$_POST["field176_sig"]."'";
	$strSQL .=", field177 = '".$_POST["field177"]."'";
	$strSQL .=", field177_sig = '".$_POST["field177_sig"]."'";
	$strSQL .=", field178 = '".$_POST["field178"]."'";
	$strSQL .=", field178_sig = '".$_POST["field178_sig"]."'";
	$strSQL .=", field179 = '".$_POST["field179"]."'";	
	$strSQL .=", field179_sig = '".$_POST["field179_sig"]."'";
	
	$strSQL .=", field180 = '".$_POST["field180"]."'";						
	$strSQL .=", field180_sig = '".$_POST["field180_sig"]."'";
	$strSQL .=", field181 = '".$_POST["field181"]."'";
	$strSQL .=", field181_sig = '".$_POST["field181_sig"]."'";
	$strSQL .=", field182 = '".$_POST["field182"]."'";
	$strSQL .=", field182_sig = '".$_POST["field182_sig"]."'";
	$strSQL .=", field183 = '".$_POST["field183"]."'";	
	$strSQL .=", field183_sig = '".$_POST["field183_sig"]."'";
	$strSQL .=", field184 = '".$_POST["field184"]."'";
	$strSQL .=", field184_sig = '".$_POST["field184_sig"]."'";
	$strSQL .=", field185 = '".$_POST["field185"]."'";
	$strSQL .=", field185_sig = '".$_POST["field185_sig"]."'";
	$strSQL .=", field186 = '".$_POST["field186"]."'";
	$strSQL .=", field186_sig = '".$_POST["field186_sig"]."'";
	$strSQL .=", field187 = '".$_POST["field187"]."'";
	$strSQL .=", field187_sig = '".$_POST["field187_sig"]."'";
	$strSQL .=", field188 = '".$_POST["field188"]."'";
	$strSQL .=", field188_sig = '".$_POST["field188_sig"]."'";

	$strSQL .=", field189 = '".$_POST["field189"]."'";	
	$strSQL .=", field189_sig = '".$_POST["field189_sig"]."'";
	$strSQL .=", field190 = '".$_POST["field190"]."'";						
	$strSQL .=", field190_sig = '".$_POST["field190_sig"]."'";
	$strSQL .=", field191 = '".$_POST["field191"]."'";
	$strSQL .=", field191_sig = '".$_POST["field191_sig"]."'";
	$strSQL .=", field192 = '".$_POST["field192"]."'";
	$strSQL .=", field192_sig = '".$_POST["field192_sig"]."'";
	$strSQL .=", field193 = '".$_POST["field193"]."'";	
	$strSQL .=", field193_sig = '".$_POST["field193_sig"]."'";

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
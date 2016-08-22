<?php
session_start(); 
global $sNetid, $sUin;
require_once '../cas.php';
// getCAS();

//if ($_SESSION["person"] == ""){
	// header( 'Location: http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php' ) ;
//  }
?>
<html>
<head>
<title>Test Entry</title>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />
<style type="text/css">
<!--
body
{
background-image:url('../blue-shadow.png');
background-repeat:repeat-x;
} 

-->
</style>


</head>
<body bgcolor="c0c8d6">

<?php

function Goto_add_components(){
	echo '<script type="text/javascript">';
 	echo 'window.location = "'. 'http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Rebuild/Rebuild.php"';
	echo '</script>';
	}	


echo '<br>'.'$sNetid = '. $sNetid;
echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];
echo '<br>';


IF ($_SESSION["person"] == "liu-duan" || $_SESSION["person"] == "walpert" || $_SESSION["person"] == "guinasso" ||
    $_SESSION["person"] == "willie"    || $_SESSION["person"] == "adancer" || $_SESSION["person"] == "kuehl.joe" ||
	$_SESSION["person"] == "woodyl"  )

//or "wmblake" or "weiyan" or "t-wade" or "smpitts" or "s-sweet" or "rjwilson" or "rj-albers" or  "p-stine" or "p-clark2" or "m-bohn" or "l-mcdonald6"  or "jlsericano" or "jeo27" or "j-wade14482" or "ewq450" or "erw" or "d-defreitas" or "cj_c_ag" or "cfpaul" or "bauerroad" or "andreym" or "alicia08" or "pdancer" or "calliefornia17")
	{echo " ".'<br>';}
else{
	echo "This NetID is not authorized";
	echo <<<_END
	<FORM><INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-2)"></FORM>
_END;
	exit;
    }
?>




<?php

function If_row_exist($checkout, $System_model){
	if ($System_model == "TABSI"){$Table_Name = TABSI_table1;}
		elseif ($System_model == "TABSII"){$Table_Name = TABSII_table;}
		elseif ($System_model == "2.25m"){$Table_Name = TABS225m;}
	$result = mysql_query("SELECT * FROM tabs_status.$Table_Name WHERE checkout = '". $checkout. "' limit 1");

	# Get one row of data.
	$row = mysql_fetch_array($result, MYSQL_BOTH);
  
	if($row["checkout"]==""){return(0);}
		else{return(1);}
}		//The end of the function If_row_exist()






$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("Metadata");


// $_GET["checkout"]=="V-2013-01-17";
echo "The get array: ";
print_r($_GET);
echo '<br>';







// Showing different contents with brand new buoy.
if ($_GET["checkout"]=="None" or $_GET["checkout"]==""){				// for a brand new buoy.
		echo '<script type="text/javascript">';
		echo 'window.location = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php";';
		echo '</script>';
	}  // end for a brand new buoy.
	
// Get buoy system model number.
$query = "SELECT * FROM Components ".
	"JOIN Assemblies ".
	"ON Assemblies.Component_N = Components.Component_N ".
	"WHERE Assemblies.checkout = '". $_GET["checkout"]. "' ". 
	"AND Components.Component_type = 'System'";

echo '<br>number:';	
echo $_GET["checkout"]; 
echo '<br> The Query:<br> '. $query;
echo '<br>';

$result = mysql_query($query) or die(mysql_error());

echo '<br>3 $result: '. $result. '<br>';

echo '<br>';

$objDB = mysql_select_db("tabs_status");	//for access test tables.
// $query2 = "REPLACE INTO TABSII_table SET checkout = '". $_GET["checkout"]. "' ";

$checkout = $_GET["checkout"];



echo '<br>11 $row["Model"]: '. $row["Model"]. '<br>';

// here determine where to go.
while($row = mysql_fetch_array($result)){
	echo "<br>22. The row array: ";
	print_r($row);
	$Model = $row["Model"];
	if ($row['Model']=='TABSI'){
		$part_link = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/TABSI/TABSI_edit2.php?checkout=";
		if (If_row_exist($checkout, $row['Model']) == 0) {
			$query2 = "INSERT INTO TABSI_table1 SET checkout = '". $_GET["checkout"]. "' ";
			mysql_query($query2); 
			$query2 = "INSERT INTO TABSI_table2 SET checkout = '". $_GET["checkout"]. "' ";
			mysql_query($query2); 
			$query2 = "INSERT INTO TABSI_table3 SET checkout = '". $_GET["checkout"]. "' ";
			mysql_query($query2); 						
			}}
		elseif ($row['Model']=="2.25m"){
			$part_link = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/TABS225m/TABS225m_edit2.php?checkout=";
			if(If_row_exist($checkout, $row['Model']) == 0) {
				$query2 = "INSERT INTO TABS225m SET checkout = '". $_GET["checkout"]. "' ";
				mysql_query($query2); 
				}}		// end of elseif 2.25m, and end of if_row_exist.
		elseif ($row['Model']=="TABSII"){
			$part_link = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/TABSII/TABSII_edit2.php?checkout=";	
			if(If_row_exist($checkout, $row['Model']) == 0)   {
				$query2 = "INSERT INTO tabs_status.TABSII_table SET checkout = '". $_GET["checkout"]. "' ";
				mysql_query($query2); 
				}}
		elseif ($row['Model']=="1.4m"){
			$part_link = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/TABS14m/TABS14m_edit2.php?checkout=";	
			if(If_row_exist($checkout, $row['Model']) == 0)   {
				$query2 = "INSERT INTO tabs_status.TABS14m_table SET checkout = '". $_GET["checkout"]. "' ";
				mysql_query($query2); 
				}}
		else{
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br> 33333: ';
			
			echo '$checkout, $row[Model]: '. $checkout.', '.$row['Model'];
			echo '<br>';
			echo 'If_row_exist($checkout, $row[Model]): '.If_row_exist($checkout, $row['Model']);

			echo ', haha2<br>';			
			
			echo '$query2: '. $query2;
			echo ', haha2<br>';
			$part_link = "What is the buoy model?";
			Goto_add_components();
			} // end of else (if)
	}		// end of while

if (mysql_fetch_array($result)){
	# Goto_add_components();
	echo '<br>55 $row["Model"]: '. $row["Model"]. '<br>';
	}


echo 'haha, <br>';

echo $part_link;
echo '<br>Here is the row array again: '. $Model;
print_r($row);
	
echo '<br>';
	
	echo 'go to here?'. $part_link. $_GET["checkout"]. '"';
	echo '<br>$row["Model"]: '. $row["Model"];
echo '<script type="text/javascript">';
 	echo 'window.location = "'. $part_link. $_GET["checkout"]. '"';
	
echo '</script>';

echo '<br>';
echo $part_link;
echo '<br>';
echo $_GET['checkout'];
echo '<br>';
echo '<a href = "'. $part_link. $_GET['checkout']. '"> test page</a>';


	
// The link should go to insert
	



?>



<h2 class="TITLE-STYLE"><center>Entry to Buoy Test</center></h2>



<DIV id = "tool-bar"> 
 <a href="../../Buoy-log/Deployment/deployment.php">Deployment History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://cas-dev.tamu.edu/cas/logout?service=http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/">NetID Logout</a></div>



Always get the checkout;<br><br>

Check system model<br><br>

Go to the right system model<br>
Feed the checkout<br><br>


Direct to test page.<br>





<?php 
$_GET["checkout"]=="not-None";
print_r($_GET);
// Showing different contents with brand new buoy.
if ($_GET["checkout"]=="None" or $_GET["checkout"]==""){				// for a brand new buoy.
		echo '<script type="text/javascript">';
		// echo 'window.location = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php";';
		echo '</script>';
		
	}  // end for a brand new buoy.
	
		
	
	
	else{			// for a buoy reconstruction.
		print <<<END

<center>
<hr>
	

<br>
<font class="Sub_title-STYLE">Working on existing assembly:
<form name="frmSample345" action="./Rebuild.php?New_checkout=$_GET[checkout]>"
method="post" 
style="display: inline; vertical-align:middle;">	

<input type="submit" name="mysubmit" value="Working on Existing Assembly" style="display: inline; vertical-align:top;"/>
</form>
</font>
<br>
<font class="heading-STYLE">(Add or remove components.)</font>
<br><br>
<hr>

<br>
<h2 class="Sub_HEADING-STYLE">Buoy tests:	
	
END;

$sql='select * from deployment_table2 where checkout = "'. $_GET['checkout']. '"';

// echo '<br>'. 'The commend: '. $sql.'<br>';
$result = mysql_query($sql) or die(mysql_error());

while($row = mysql_fetch_array($result)){
	if ($row['Buoy_type']=="TABSI") 
		{$link = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/TABSI/TABSI_edit1.php";}
		elseif ($row['Buoy_type']=="2.25m") {
			$link = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/TABS225m/TABS225m.php";}		
		else{
			$link = "http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/TABSII/TABSII.php";}
	}		// end of while
//	if (($row['checkout']==$_GET['New_checkout']) AND ($row['Component_type'] == "System")){



print <<<END

<form name="frmSample345" action="<? echo $link;?>"
method="post" 
style="display: inline; vertical-align:middle;">	

<input type="submit" name="mysubmit" value="Buoy Test" style="display: inline; vertical-align:top;"/>
</form></h2>

END;

		}		// end for a buoy reconstruction.

?>

	



<?php
mysql_close($objConnect);
?>
</body>
</html>
<!--- This file download from www.shotdev.com -->
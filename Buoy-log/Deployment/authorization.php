<?php
session_start(); 
global $sNetid, $sUin;
require_once 'cas.php';

if ($_SESSION["person"] == ""){
	getCAS(); 
  }

// echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];
// echo '<br>'.'$sNetid = '. ".".$sNetid.".";

if ($sNetid != ""){
	$_SESSION["person"] = $sNetid;
	//echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];
  }


// echo '<br>'.'$sNetid = '. $sNetid;
// echo '<br>'.'$_SESSION["person"] = '. $_SESSION["person"];
// echo '<br>';

IF ($_SESSION["person"] == "woodyl" or $_SESSION["person"] == "walpert" or $_SESSION["person"] == "liu-duan" ||
    $_SESSION["person"] == "guinasso" or $_SESSION["person"] == "wmblake" or $_SESSION["person"] == "willie" or 
	$_SESSION["person"] == "weiyan" or $_SESSION["person"] == "t-wade" or $_SESSION["person"] == "smpitts" or 
	$_SESSION["person"] == "s-sweet" or $_SESSION["person"] == "rjwilson" or $_SESSION["person"] == "rj-albers" or 
	$_SESSION["person"] == "pdancer" or $_SESSION["person"] == "p-stine" or $_SESSION["person"] == "p-clark2" or 
	$_SESSION["person"] == "m-bohn" or $_SESSION["person"] == "l-mcdonald6" or $_SESSION["person"] == "kuehl.joe" or 
	$_SESSION["person"] == "jlsericano" or $_SESSION["person"] == "jeo27" or $_SESSION["person"] == "j-wade14482" or 
	$_SESSION["person"] == "ewq450" or $_SESSION["person"] == "erw" or $_SESSION["person"] == "d-defreitas" or 
	$_SESSION["person"] == "cj_c_ag" or $_SESSION["person"] == "cfpaul" or $_SESSION["person"] == "bauerroad" or 
	$_SESSION["person"] == "andreym" or $_SESSION["person"] == "alicia08" or $_SESSION["person"] == "adancer" or 
	$_SESSION["person"] == "calliefornia17" or $_SESSION["person"] == "sdimarco" or $_SESSION["person"] == "heather3621")
	{echo " ";}
else{
	echo <<<_END
	<html>
<head>
<title>Authorization</title>
<link rel="stylesheet" href = "../TABSI/record_style.css" type="text/css" />

<style type="text/css">
<!--
body
{
background-image:url('blue-shadow.png');
background-repeat:repeat-x;
} 

-->
</style>


</head>
<body bgcolor="c0c8d6">

<!--
<DIV id = "tool-bar"> 
<a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../../Metadata/Rebuild/Rebuild_entry.php?checkout=None">Brand New Buoy</a></td>  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="../../Metadata/Buoy-components/Components.php">Components</a></td>  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="./CAS-logout">NetID Logout</a></div>
-->

	
	<center>	<p><p><br><p><br>
	This NetID is not authorized.
	
	<p><p><br>
	<FORM><INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-2)"></FORM>
_END;
	exit;
    }

?>






</body>
</html>
<!--- This file download from www.shotdev.com -->
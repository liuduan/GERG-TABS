<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
  <META HTTP-EQUIV ="Expire" CONTENT ="0">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>File Management</title>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style type="text/css">
<!--
.STYLE3 {color: #800000}
-->
</style>
</head>
<body background="http://tabs2.gerg.tamu.edu/tglo/testpages/Comparison/gradient_bgr.png">



<?php
// The following PHP script check 5 day old file names and delete the files.

# $dir = './forecast_files';
$dir = '/var/www/tglo/testpages/Comparison/forecast_files';
$dp = opendir($dir) or die ('Could not open '.$dir);
$file = readdir($dp);
print_r ($file);
while ($file = readdir($dp)) {
if ((filemtime($dir.'/'.$file)) < (strtotime('-6 days')))
 	{
	unlink($dir.'/'.$file);
	}
}
closedir($dp);
?>

</center>
  
</body>
</html>

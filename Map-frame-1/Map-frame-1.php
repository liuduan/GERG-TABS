<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- This program embeds Google Map in the web page.
To switch a buoy on/off, change lines around 227.
-->
<html>
<head>
<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35509235-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<META HTTP-EQUIV ="Expire" CONTENT ="0">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

<title>The Texas Automated Buoy System -- Web Site Test Running</title>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCVE6LORIN-R9TFnQvU_bRQjvpB7juwVTs&sensor=false"></script>

<script src="./infobox.js"></script> <!-- for info box. -->

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />


<?php
# This php script take the arguement of model and fcast_hour to find 

if ($_POST["model"] == "") {$_POST["model"] = "R";}  // give a initial value.
if ($_POST["fcast_hour"] == ""){$_POST["fcast_hour"] = "-2";}

//day adjust.
switch ($_GET["model"]){
	case "POM_2m_":
		if (date("H")<7) {$day_adjust = 1;}
	break;
		
	case "R":
		if (gmdate("H")<7) {$day_adjust = 1;}
	break;
		
	case "eta_":
		if (gmdate("H")<6) {$day_adjust = 1;}
	break;
}


// Create image file name.



// Wind showing every 3 hours.
if ($_POST["model"] == "eta_") {
	$roundup = sprintf ("%02d", (round((gmdate('H', time() + 3600 * $_POST['fcast_hour']))/3)*3));
	$file_name_part2 = $_POST["model"]. gmdate("ymd", time() + 3600 * $_POST["fcast_hour"]). $roundup;

	//echo "After round up the ymdH is: ", $file_name_part2. '<br>';
	}
else {$file_name_part2 = $_POST["model"]. gmdate("ymdH", time() + 3600*$_POST["fcast_hour"]);}
//echo "The file name part2 is: ", $file_name_part2. '<br>';

// Check the file_exists.
//print_r($_POST);




// if (! file_exists('../Comparison/forecast_files/'.gmdate("d"). $file_name_part2.'.png'))
//	{exit('<H1><center><br>Sorry <br>The forecast data is not available <br>at the specified time point.</center></H1>');
//	}      //end of Checking file existant.


// Prepare the file name for overlay in Javascript (Google API)
$forecast_img = 'http://tabs1.gerg.tamu.edu/tglo/testpages/Comparison/forecast_files/'. gmdate("d", time()). $file_name_part2. ".png";
$local_forecast_img = '../'.substr($forecast_img, 42);

if (! file_exists($local_forecast_img))						//use the local path to check the file exists, works better.
	{$forecast_img = 'http://tabs1.gerg.tamu.edu/tglo/testpages/Comparison/forecast_files/'. gmdate("d", time() - 24*3600). $file_name_part2. ".png";
    }      //end of Checking file existant.

echo '<script type="text/javascript">';
echo 'var forecast_img = "'.$forecast_img. '"';
echo '</script>';

?> 






<?php


// The whole PHP script get wind and current data from a file, latest_obs.txt
// The file is written by making-arrows.php, and the file is renewed twice a hour. 
// This file shows the data on the web page as buoy message in text.


$fp = fopen("/home/liuduan/testpages/Map-frame-1/latest_obs.txt", "r");


function Retrieve_Show_Data($Table_Name, $Last_Report){
	# This function retrieve data from latest_obs.txt, and showing on map as buoy messages.
	# latest_obs.txt is produced by making-arrows.php
	$latest_obs = fopen("/home/liuduan/testpages/Map-frame-1/latest_obs.txt", "r");
	
while (($line = fgetcsv($latest_obs, 1000)) !== FALSE) {


 	if ($line[0] == $Table_Name){	
		# echo '$Table_Name: '. $Table_Name. '<br>';
		# echo '$line[0]: '. $line[0]. '<br>';
# Get resource ID for retrieving data.
//$result = mysql_query("SELECT * FROM $Table_Name ORDER BY obs_time DESC limit 1");

# Get one row of data.
//$row = mysql_fetch_array($result, MYSQL_BOTH);
// mysql_free_result($result);

		$row[obs_time] = $line[1];
		
	// Determin how old the data is, if the data is more than 5 days old, then do not draw arrows.
	// echo '<br> $Table_Name = '. $Table_Name. '</br>';
	// echo '$row[obs_time] = '.$row[obs_time].' (UTC)</br>';
	// echo 'substr($row[obs_time], 11, 2)'. substr($row[obs_time], 12, 2). '</br>';
	$obsv_time = mktime(substr($row[obs_time], 12, 2), substr($row[obs_time], 15, 2), 0, 
		substr($row[obs_time], 6, 2), substr($row[obs_time], 9, 2), substr($row[obs_time], 1, 4));
		// mktime ("HH", "MM", "SS", $day, $year, $is_dst = -1)

	$serv_time = mktime(); 

	$objDateTime = new DateTime('NOW');
	// echo 'Now:       '. $objDateTime->format(DateTime::ISO8601); // ISO8601 formatted time
	// echo ' (CDT) <br>';

	// echo '$serv_time =', $serv_time, ';  $obsv_time =', $obsv_time, '<br />';
	$time_ago = ($serv_time - $obsv_time)/3600 + 5;

	// printf("Reported: %.2f", round($time_ago, 2));
	// echo " hour(s) ago. &nbsp; (". substr($row[obs_time], 1, 16). " UTC)". '<br />';
	
	// #### exit if the data is more than 5 days old. ####
	if ($time_ago > 120){break;}		
		
		
		
		
		
		
		
		

	##### The following write the data.
	echo '<font size="2" face="courier new">';
if (preg_match ("/met/i", $Table_Name)){		//if met
	$row[veast] = $line[2];
	$row[vnorth] = $line[3];
	echo "Wind:   &nbsp;&nbsp;&nbsp; ". (string) (round(sqrt(pow("$row[veast]", 2) + pow("$row[vnorth]",2)), 2)). ' m/s from ';
	if ("$row[vnorth]">0){
		echo (string) ((int) (180/M_PI*atan("$row[veast]"/"$row[vnorth]")) + 180). '°;<br\>';
		}	
		elseif ("$row[vnorth]" == 0){echo "Not reported.". '<br>';}
		else{
		echo (string) ((int) (180/M_PI*atan("$row[veast]"/"$row[vnorth]"))). '°;<br\>';
		}
	if (($line[4] > -10) & ($line[4] < 50)){echo "Air Temp: ". $line[4]. '°C;<br\>';}
	}		// end of if met, but there is an elseif follows.
	
	elseif (preg_match ("/ven/i", $Table_Name)){
		$row[veast] = $line[2];
		$row[vnorth] = $line[3];
	
		echo "Current: &nbsp;". (string) round(sqrt(pow("$row[veast]",2) + pow("$row[vnorth]",2)), 1). ' cm/s to ';
		if ("$row[vnorth]">0){
			echo (string) ((int) (180/M_PI*atan("$row[veast]"/"$row[vnorth]"))). '°;<br\>';
			}	
			elseif ("$row[vnorth]" == 0){echo "Not reported.". '<br>';}
			else{
				echo (string) ((int) (180/M_PI*atan("$row[veast]"/"$row[vnorth]")) + 180). '°;<br\>';
				}
	if (($line[4] > -4) & ($line[4] < 50)){echo "Water T:&nbsp;". $line[4]. '°C;<br\>';}
		}

	elseif (preg_match ("/wave/i", $Table_Name)){
		$row[wave_height] = round($line[2], 2);
		$row[peak_period] = round($line[3], 1);
		echo 'Signific. Wave Height: '. $row[wave_height]. ' m;<br\>';
		echo "&nbsp;&nbsp;Period: ". $row[peak_period]. ' s (Peak Period);<br\>';
		}

//fwrite($fp, $Table_Name.", ". $row[obs_time].", ". $row[veast].", ". $row[vnorth]."\n"); 
//fwrite($fp, $Table_Name.", ". $row[obs_time].", ". $row[windspeed].", ". $row[winddir]. "\n"); 

	else {		# including 420, 
		$row[windspeed] = $line[2];
		$row[winddir] = $line[3];
		echo "Wind: &nbsp;&nbsp;&nbsp; ". "$row[windspeed]". ' m/s ';
		echo "from ". "$row[winddir]". '°;<br\>';
		if (($line[4] > -10) & ($line[4] < 50)){echo "Air Temp: ". $line[4]. '°C;<br\>';}
		if (preg_match ("/420/i", $Table_Name)){
			echo 'Signific. Wave Height: '. $line[6]. ' m;<br\>';
			echo "&nbsp;&nbsp;Period: ". $line[7]. ' s (Peak Period);<br\>';	
			}
		if (($line[5] > -4) & ($line[5] < 50)){echo "Water T:&nbsp;". $line[5]. '°C;<br\>';}
		}   
	
	
##### The following calculate how many hour has passed since last measurement.
if ($Last_Report == 1){
	$obsv_time = mktime(substr($row[obs_time], 12, 2), substr($row[obs_time], 15, 2), 0, substr($row[obs_time], 6, 2), substr($row[obs_time], 9, 2), substr($row[obs_time], 1, 4));

	$serv_time = mktime(gmdate("H"), gmdate("i"), 0, gmdate("m"), gmdate("d"), gmdate("Y")); 
	$time_ago = ($serv_time - $obsv_time)/3600;

	printf("Reported: %.2f", round($time_ago, 2));
	# echo '<br> $row[obs_time] ='. $row[obs_time];
	# echo '<br /> $serv_time =', $serv_time, '; $obsv_time =', $obsv_time, '<br />';
	echo " hour(s) ago. <br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (". 
		substr($row[obs_time], 1, 16). " UTC)";
	echo '</font>';
	} 		//The end of if
	}		# end of line searching file name. if ($line[0] == $Table_Name)
  }		# end of while (($line = fgetcsv($latest_obs, 1000)) !== FALSE)
}		//The end of the function Retrieve_Show_Data()


//Retrieve_Show_Data("tabs_V_met");
//Retrieve_Show_Data("tabs_W_ven");
?>



<script type="text/javascript">

// create markers.
var stationL = [28.9818, 27.9396, 28.8425, 26.194, 26.2168, 27.8903, 29.635, 27.8966, 28.3507, 27.066,30.2794, 30.57099, 27.92, 26.95, 29.246383, 27.828, 29.683, 28.8117, 27.6874, 28.0417, 28.1921, 28.4, 27];

 var stationG = [-94.9186, -96.8429, -94.2416, -97.0507, -96.4998, -94.0367, -93.6417, -93.5973, -96.0058, -96.3383, -97.7393, -96.29461, -95.36, -96.7, -94.4083, -97.05, -94.033, -94.7433, -96.5434, -94.1667,-94.1914, -95.80, -95];

 var station_title = ["TABS Buoy B", "TABS Buoy D", "TABS Buoy F", "TABS Buoy J", "TABS Buoy K", "Flower Gardens Buoy N", "TABS Buoy R", "Flower Gardens Buoy V", "TABS Buoy W", "Texas General Land Office", "Geochemical & Environmental Research Group", "NDBC Buoy 42019", "NDBC Buoy 42020", "NDBC Buoy 42035", "NDBC Buoy PTAT2", "NDBC Station SRST2", "TABS Buoy X"];
 	// station_title not in use.

var icons = ['http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
  				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/embassy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/workoffice.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/NDBC-buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/NDBC-buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/NDBC-buoy.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/land-obs.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/land-obs.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/blue_MarkerC-2.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/blue_MarkerH-2.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/blue_MarkerL-2.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/blue_MarkerM-2.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/blue_MarkerS-2.png',
				'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/Overlay-Notes.png'
				];

//  Create the Shadow
var shadow = new google.maps.MarkerImage(
	'http://tabs1.gerg.tamu.edu/tglo/testpages/Map-frame-1/icons/shadow50.png',
	new google.maps.Size(41, 47),
	new google.maps.Point(0, 0),
	null
	);

// The order of the message must be the same as in making-arrows.php line 219-237, because the later writes the lastest_obs.txt file, which feed the data in fuction Retrieve_Show_Data(). 
// making-arrow.php writes the lastest_obs.txt.
var message = [
'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy B &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=B" target ="_blank"></font><u>Details...<\/u><\/a><br /><font face="courier new">(28°58.9080\'N, 94°55.1160\'W)<br /><br /><?php 
Retrieve_Show_Data("tabs_B_ven", 0);Retrieve_Show_Data("tabs_B_met", 1);
?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy D &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=D" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(27°56.3760\'N, 96°50.5740\'W)<br /><br /><?php Retrieve_Show_Data("tabs_D_ven", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy F &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=F" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(28°50.5500\'N, 94°14.4960\'W)<br /><br /><?php Retrieve_Show_Data("tabs_F_ven", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy J &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/Tglo/ven.php?buoy=J" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(26° 11.4840\'N, 97° 3.0420\'W)<br /><br /><?php Retrieve_Show_Data("tabs_J_ven", 0); Retrieve_Show_Data("tabs_J_met", 1);?><br />',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy K &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=K" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(26°13.0080\'N, 96°29.9880\'W)<br /><br /><?php Retrieve_Show_Data("tabs_K_ven", 0);
	Retrieve_Show_Data("tabs_K_met", 0);
	Retrieve_Show_Data("tabs_K_wave", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;Flower Gardens Buoy N &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=N" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(27°53.4180\'N, 94°2.2020\'W)<br /><br /><?php Retrieve_Show_Data("tabs_N_ven", 0);
	Retrieve_Show_Data("tabs_N_met", 0);
	Retrieve_Show_Data("tabs_N_wave", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy R &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=R" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(29°38.1000\'N, 93°38.5020\'W)<br /><br /><?php Retrieve_Show_Data("tabs_R_ven", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;Flower Gardens Buoy V &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=V" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(27°53.7960\'N, 93°35.8380\'W)<br /><br /><?php 
	Retrieve_Show_Data("tabs_V_ven", 0);
	Retrieve_Show_Data("tabs_V_met", 1);
	Retrieve_Show_Data("tabs_V_wave", 1);
?>',


'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy W &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=W" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(28°21.0420\'N, 96°0.3480\'W)<br /><br /><?php Retrieve_Show_Data("tabs_W_ven", 1);?><br />',


'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy X &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=X" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(27°3.960\'N, 96°20.30\'W)<br /><br /><?php 
	Retrieve_Show_Data("tabs_X_ven", 0);
	Retrieve_Show_Data("tabs_X_met", 0);
	Retrieve_Show_Data("tabs_X_wave", 1);
?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;<a href="http://www.glo.texas.gov/what-we-do/caring-for-the-coast/oil-spills/index.html" target ="_blank"><u>Texas General Land Office<\/u><\/a><\/center>',

'<font size=2 face= "Arial"><b><a href="http://gerg.tamu.edu/" target ="_blank"><u><h3>Geochemical & Environmental Research Group<\/u><\/a><\/center>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;NDBC Buoy 42019 &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ndbc.php?buoy=42019" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(27°54.7830\'N, 95°21.6000\'W)<br /><br /><?php Retrieve_Show_Data("ndbc_42019", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;NDBC Buoy 42020 &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ndbc.php?buoy=42020" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(26°57.0000\'N, 96°42.0000\'W)<br /><br /><?php Retrieve_Show_Data("ndbc_42020", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;NDBC Buoy 42035 &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ndbc.php?buoy=42035" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(29°14.7830\'N, 94°24.5000\'W)<br /><br /><?php Retrieve_Show_Data("ndbc_42035", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;NDBC Station PTAT2 &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ndbc.php?buoy=PTAT2" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(27°49.7000\'N, 97°3.0000\'W)<br /><br /><?php Retrieve_Show_Data("ndbc_PTAT2", 1);?>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;NDBC Station SRST2 &nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://tabs.gerg.tamu.edu/tglo/ndbc.php?buoy=SRST2" target ="_blank"><u>Details...<\/u><\/a><br /><font face="courier new">(29°40.2000\'N, 94°3.0000\'W)<br /><br /><?php Retrieve_Show_Data("ndbc_SRST2", 1);?>', 

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy C &nbsp;&nbsp;&nbsp;&nbsp;</b><br /><font face="courier new">(28° 48.7000\'N, 94°44.6000\'W)<br /><br />Discontinued. <a href="http://tabs.gerg.tamu.edu/tglo/tabsqueryform.php?buoy=C" target ="_blank"><u>Download Data.<\/u><\/a>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy H &nbsp;&nbsp;&nbsp;&nbsp;</b><br /><font face="courier new">(27°52.0458\'N, 96°32.6010\'W)<br /><br />Discontinued. <a href="http://tabs.gerg.tamu.edu/tglo/tabsqueryform.php?buoy=C" target ="_blank"><u>Download Data.<\/u><\/a>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy L &nbsp;&nbsp;&nbsp;&nbsp;</b><br /><font face="courier new">(28°2.5000\'N, 94°7.0000\'W)<br /><br />Discontinued. <a href="http://tabs.gerg.tamu.edu/tglo/tabsqueryform.php?buoy=C" target ="_blank"><u>Download Data.<\/u><\/a>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy M &nbsp;&nbsp;&nbsp;&nbsp;</b><br /><font face="courier new">(28° 11.5260\'N, 94°11.4840\'W)<br /><br />Discontinued. <a href="http://tabs.gerg.tamu.edu/tglo/tabsqueryform.php?buoy=M" target ="_blank"><u>Download Data.<\/u><\/a>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;TABS Buoy S &nbsp;&nbsp;&nbsp;&nbsp;</b><br /><font face="courier new">(28°31\'N, 96°0\'W)<br /><br />Discontinued. <a href="http://tabs.gerg.tamu.edu/tglo/tabsqueryform.php?buoy=C" target ="_blank"><u>Download Data.<\/u><\/a>',

'<font size=2 face= "Arial"><b>&nbsp;&nbsp;&nbsp;Overlay Notes &nbsp;&nbsp;&nbsp;&nbsp;</b><br /><font face="courier new"><br />The <b>Buoys <\/b>button overlays model vector to each buoy location, and the model valid time is the same hour as the observation. <br />The <b>Field<\/b> overlay button uses the latest model valid for two hours ago.'


];


var mouse_on_message = [
	'TABS Buoy B',
	'TABS Buoy D',
	'TABS Buoy F',
	'TABS Buoy J',
	'TABS Buoy K',
	'Flower Gardens Buoy N',
	'TABS Buoy R',
	'Flower Gardens Buoy V',
	'TABS Buoy W',
	'TABS Buoy X',
	'Texas General Land Office',
	'Geochemical & Environmental Research Group',
	'NDBC Buoy 42019',
	'NDBC Buoy 42020',
	'NDBC Buoy 42035',
	'NDBC Station PTAT2',
	'NDBC Station SRST2'
	];


		
// The five markers show a secret message when clicked, but that message is not within the marker's instance data
function attachSecretMessage(marker, number) {
	box_Options_click = {
		disableAutoPan: false,
		maxWidth: 0,
		pixelOffset: new google.maps.Size(0, 0),
		zIndex: null,
		boxStyle: { 
			background: "#c0c8d6",
			border: "2px solid #000066",
			//textAlign: "center",   
			fontFace: "Courier New, Courier",   
			fontSize: "10pt",
			padding: "5px", 
			opacity: 0.75,
			width: "260px",
			zIndex: 0
			},
		closeBoxMargin: "4px 2px 2px 2px",
			//closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
		infoBoxClearance: new google.maps.Size(1, 1),
		isHidden: false,
		pane: "floatPane",
		enableEventPropagation: false
		};  // end of box_Options
		            
	info_box_click = new InfoBox(box_Options_click);


  	google.maps.event.addListener(marker, 'click', function() {
    	info_box_click.setContent(message[number]);
		info_box_click.open(map,marker);	
		info_box.close();	
	});	  //end of addListener.
		
	google.maps.event.addListener(map, 'click', function() {
		info_box_click.close();});
}  //end of function function attachSecretMessage(marker, old_marker, number) 


	

function attach_Mouse_on_Message(Mouse_on_Marker, mouse_on_message_X) {	
	var boxText = "<div style='margin-top: 0px; padding: 0px; font-weight:bold;'>";
	boxText += mouse_on_message_X;
	boxText += "</div>";
	
	box_Options = {
		disableAutoPan: false,
		maxWidth: 0,
		pixelOffset: new google.maps.Size(0, 0),
		zIndex: null,
		boxStyle: { 
			background: "#14244c",
			border: "1px solid #64e0fe",		
			opacity: 0.5,
			width: "130px",
			textAlign: "center", 
			fontFamily: "Arial",  
			color: "#64e0fe",   
			fontSize: "9pt",
			zIndex: 1
			//color: "#FFFFFF"
			},
		closeBoxMargin: "2px 2px 2px 2px",
			//closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
		infoBoxClearance: new google.maps.Size(1, 1),
		isHidden: false,
		pane: "floatPane",
		enableEventPropagation: false
		};  // end of box_Options
		            
	info_box = new InfoBox(box_Options);

	google.maps.event.addListener(Mouse_on_Marker, 'mouseover', function() {
		info_box.setContent(boxText);
		info_box.open(map, Mouse_on_Marker);
		//setTimeout("info_box.close()",5000); 
		});
		
	// old_info_box.close(map, old_Mouse_on_Marker);	
		//google.maps.event.addListener(marker_X, 'mouseout', function() {
			//info_box.close(map, marker_X);});
}  //end of function function attach_Mouse_on_Message(marker, old_marker, number) 










function initialize(){
  var newark = new google.maps.LatLng(27.2, -93);

  var myOptions = {
    zoom: 7,
    center: newark,
    mapTypeId: google.maps.MapTypeId.SATELLITE,
	scaleControl: true
  }   <!-- end of myOptions -->

  map = new google.maps.Map(document.getElementById("photo"), myOptions);

	
	/*  // adjusting overlay position
	var marker99 = new google.maps.Marker({
  		position: new google.maps.LatLng(29.5, -92), 
  		map: map
		});
	var marker999 = new google.maps.Marker({
  		position: new google.maps.LatLng(26.1, -97), 
  		map: map
		});
	*/
	
	var markers = []; 
	old_marker =  new google.maps.Marker({});
	for (var i = 0; i < 22; i++) {							//The last was not included.
    	var location = new google.maps.LatLng(stationL[i], stationG[i]);
		var icon_one = icons[i];
    	markers[i] = new google.maps.Marker({
        	position: location, 
        	map: map,
			icon: icon_one,
			shadow: shadow
    	});  // end of markers[i]

    	var j = i + 1;
    	// markers[i].setTitle(station_title[i]);

		
		attachSecretMessage(markers[i], i);		
									
		infowindow = new google.maps.InfoWindow({});
		//info_box = new google.maps.InfoBox();		
	} // end of for
	attach_Mouse_on_Message(markers[11], mouse_on_message[11]);
	attach_Mouse_on_Message(markers[10], mouse_on_message[10]);
<?php
# Close Connection.
//mysql_close($conn);

fclose($fp);
?>



// Overlay

	var imageBounds2 = new google.maps.LatLngBounds(
      	new google.maps.LatLng(24.95, -98.975),
      	new google.maps.LatLng(30.455, -91.23));  
  	forecast_map = new google.maps.GroundOverlay(
  	  	forecast_img,
	  	imageBounds2);
  	//forecast_map.setMap(map);
  
  var imageBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(24.87, -99.1),
      new google.maps.LatLng(30.64, -91.3));

  var oldmap = new google.maps.GroundOverlay(
      "./map-2-upright.png",
      imageBounds,{'percentOpacity': 25});
  oldmap.setMap(map);
  
  var oldmap2 = new google.maps.GroundOverlay(
      "./background.png?time="+ new Date(),
      imageBounds, {'percentOpacity': 25});  
  oldmap2.setMap(map);
  
  var imageBounds3 = new google.maps.LatLngBounds(
      new google.maps.LatLng(25.065, -97),
      new google.maps.LatLng(25.735, -94.06));  
  var oldmap3 = new google.maps.GroundOverlay(
      "./date_legend.png?time="+ new Date(),
      imageBounds3, {'percentOpacity': 25});  
  oldmap3.setMap(map);  


  forecast_map2 = new google.maps.GroundOverlay(
   	"./model_stations.png?time="+ new Date(),
  	imageBounds);







//
//markers for overlay image location adjustment.


	var button_image = new google.maps.MarkerImage("./Overlay-Notes.png", 
		null, 
		null, 
		null, 
		new google.maps.Size(90, 20));                 //

	//Add a test marker
	var button_marker = new google.maps.Marker({
		position: new google.maps.LatLng(30.32, -90),    //28.95, -89.65 were good.
		draggable: true,
		bouncy: false, 
		icon: button_image,
		map:map
		});
	attachSecretMessage(button_marker, 21);	

}  //end of function initionization()


</script>


<style type="text/css">
<!--
a:link {color:#FF0000;}      /* unvisited link */
	a:visited {color:#0000FF;}  /* visited link */
	a:hover {color:#FF00FF;}  /* mouse over link */
	a:active {color:#0000FF;}  /* selected link */


#button {
	
	position:absolute;
	height:110px;
	right: 120px;
	top: 5px;
	z-index:3;
}

#button2 {

	position:absolute;
	height:100px;
	right: 170px;
	top: 5px;
	z-index:3;
}

#text {
	font-family:"Arial", sans-serif;
	font-size:11px;
	color:white;  /* selected link */
	position:absolute;
	height:100px;
	right: 152px;
	top: 28px;
	z-index:3;
}

#photo {
	position:relative;
	/*top:100px;	*/
}

-->
</style>



</head>

<body onLoad="initialize()">

<?php
# echo 'var forecast_img = "'.$forecast_img. '"';

?> 




<div id="photo" style="width:auto; height:100%">     
	<!-- another part of Google Map API is targeting this element by ID from the Header part, that created map overlay. -->
	<!-- making-arrow.php only make arrows for above API. --> 
	This is photo div. 1234.
	<?php //include ("making-arrow.php"); ?>
</div> <!-- end of the photo div -->

<div id="button">     

<a href="#" onClick="return changeImage()" >
<img name="jsbutton" src="./field-1.png" width="50" height="21" border="0" 
alt="javascript button"></a> 

<script type="text/javascript">
fliper_3 = 0;
function changeImage()  {  
	if (fliper_3 == 0){
		forecast_map.setMap(map);
		document.images["jsbutton"].src= "./field-2.png";  
		fliper_3 = 1;
		return true} 		
		else {forecast_map.setMap(null);
			Button = "./overlay-button-B.png";
			document.images["jsbutton"].src = "./field-1.png"; 
			fliper_3 = 0;
			return true;  
			}
}  
</script>
</div> <!-- end of #button -->

<div id="button2">  

<a href="#" onClick="return changeImage2()" >
<img name="jsbutton2" src="./buoys-1.png" width="50" height="21" border="0" 
alt="javascript button"></a> 

<script type="text/javascript">
fliper_4 = 0;
function changeImage2()  {  
	if (fliper_4 == 0){
		forecast_map2.setMap(map);
		document.images["jsbutton2"].src= "./buoys-1.png";  
		fliper_4 = 1;
		return true} 		
		else {forecast_map2.setMap(null);
			Button = "./buoys-1.png";
			document.images["jsbutton2"].src = "./buoys-2.png"; 
			fliper_4 = 0;
			return true;  
			}
}  
</script>
</div> <!-- end of #button -->
<div id="text">
Model
</div>

</body>
</html>

	  
</body>    
</html>
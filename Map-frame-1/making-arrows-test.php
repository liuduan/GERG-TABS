<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Making-Arrows</title>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  </head>
  <body bgcolor="#C0C0C0">
  
<!-- This program read the MySQL database and creat a image of current and wind vectors. 
To switch buoys on/off, change near lines 208, 233. -->  
  
<?php
// To turn off or turn on a buoy, change this file, the model arrows will come soon, because the matching hours are available.
// Please see lines near #225

// The whole PHP script get wind and current data from tabs2 server, draw arrows on a transparent background.
// It also read the wave data and write to the file  latest_obs.txt.

// Report errors
error_reporting(E_ALL);
ini_set('display_errors', '1');


if (time()- filemtime ("./background.png") < 30) // should be 1800
// Always make the arrow for now.
{
echo "The file is new.";
// goto no_draw;
}
else 
{



// Create a transparent image.

// Create a 55x30 image
echo "started, <br/>";

$im = imagecreatetruecolor(2500, 2084);
$date_im = imagecreatetruecolor(383, 82);
$red = imagecolorallocate($im, 255, 0, 0);
$yellow = imagecolorallocate($im, 255, 255, 0);
$light_blue = imagecolorallocate($im, 100, 224, 254);
$black = imagecolorallocate($im, 0, 0, 0);

// Make the background transparent
imagecolortransparent($im, $black);
imagecolortransparent($date_im, $black);

// create and save date_legend.png, determine factor
function draw_legend(){
	global $date_im, $yellow, $light_blue, $scale_factor;	
	if ($scale_factor == 0.5){
		imagestring($date_im, 4, 5, 11, "50", $yellow);
		imagestring($date_im, 4, 70, 11, "1.0", $yellow);
	}
	else {
		imagestring($date_im, 4, 5, 11, "25", $yellow);
		imagestring($date_im, 4, 70, 11, "0.5", $yellow);
	}	
	imagestring($date_im, 5, 0, 48, "Plotted: ".gmdate("Y-M-d H:i")." UTC.", $yellow);
	
	//save the image, the date_legend imag.
	imagepng($date_im, "/home/liuduan/testpages/Map-frame-1/date_legend.png");   
}


// This function makes an arrow.
function arrow($im, $x1, $y1, $x2, $y2, $alength, $awidth, $color) {
    $distance = sqrt(pow($x1 - $x2, 2) + pow($y1 - $y2, 2));

	//echo '; $distance: '. $distance. '<br>';
	if ($distance == 0){$distance = 0.000001; }

    $dx = $x2 + ($x1 - $x2) * $alength / $distance;
    $dy = $y2 + ($y1 - $y2) * $alength / $distance;

    $k = $awidth / $alength;

    $x2o = $x2 - $dx;
    $y2o = $dy - $y2;

    $x3 = $y2o * $k + $dx;
    $y3 = $x2o * $k + $dy;

    $x4 = $dx - $y2o * $k;
    $y4 = $dy - $x2o * $k;

    imageline($im, $x1, $y1, $dx, $dy, $color);
	   for ($count =-5; $count <=5; $count++){
        imageline($im, $x1+$count, $y1, $dx+$count, $dy, $color);
		imageline($im, $x1, $y1+$count, $dx, $dy+$count, $color);
       }
    imagefilledpolygon($im, array($x2, $y2, $x3, $y3, $x4, $y4), 3, $color);
}		//The end of the function arrow()






function Retrieve_Data_Draw_Line($Table_Name, $x_position, $y_position, $im, $color){

	# Get resource ID for retrieving data.
	$result = mysql_query("SELECT * FROM $Table_Name ORDER BY obs_time DESC limit 1");

	# Get one row of data.
	$row = mysql_fetch_array($result, MYSQL_BOTH);   
	// print_r($row);
	mysql_free_result($result);

	##### The following draw an arrow; also write the latest observation to latest_obs.txt file.
	$x1=$x_position;
	$y1=$y_position;

 	//echo '$row[veast], $row[vnorth], $Table_Name, $row[obs_time] <br>';
 	//echo "$row[veast], $row[vnorth], $Table_Name, $row[obs_time] <br />";
	global $fp;

	if (preg_match ("/met/i", $Table_Name)){
		//write 1 line to latest_obs.txt
		fwrite($fp, $Table_Name.", ". $row['obs_time'].", ". $row['veast'].", ". $row['vnorth'].", ". $row['airt']."\n"); 		
		$x2 = $x1 + "$row[veast]"*150/15/.514*2;
		$y2 = $y1 - "$row[vnorth]"*150/15/.514*2;}
	elseif (preg_match ("/ven/i", $Table_Name)){
		//write 1 line to latest_obs.txt
		fwrite($fp, $Table_Name.", ". $row['obs_time'].", ". $row['veast'].", ". $row['vnorth'].", ". $row['twater']."\n"); 
		global $scale_factor;
		if ($scale_factor == 0.5){
			$row['veast']= "$row[veast]" * 0.5;
			$row['vnorth'] = "$row[vnorth]" * 0.5;}	
		else {$row[veast]= "$row[veast]" * 1;
			$row[vnorth] = "$row[vnorth]" * 1;}	
		$x2 = $x1 + $row['veast']*150/50*2*2;
		$y2 = $y1 - $row['vnorth']*150/50*2*2;}
	elseif (preg_match ("/wave/i", $Table_Name)){
		//write 1 line to latest_obs.txt
		fwrite($fp, $Table_Name.", ". $row['obs_time'].", ". $row['wave_height']. ", ". $row['peak_period']. "\n"); 
		return;}
	elseif (preg_match ("/420/i", $Table_Name)){
		//write 1 line to latest_obs.txt
		fwrite($fp, $Table_Name.", ". $row['obs_time'].", ". $row['windspeed'].", ". $row['winddir']. ", ". $row['airtemp']. ", ". $row['seawatertemp']. ", ". $row['waveheight']. ", ". $row['waveperiod']. "\n"); 
		$x2 = $x1 + "$row[windspeed]"*sin(M_PI + "$row[winddir]"*M_PI/180)*150/15/.514*2;
		$y2 = $y1 - "$row[windspeed]"*cos(M_PI + "$row[winddir]"*M_PI/180)*150/15/.514*2;}
	else {
		//write 1 line to latest_obs.txt
		fwrite($fp, $Table_Name.", ". $row['obs_time'].", ". $row['windspeed'].", ". $row['winddir']. ", ". $row['airtemp']. "\n"); 
		$x2 = $x1 + "$row[windspeed]"*sin(M_PI + "$row[winddir]"*M_PI/180)*150/15/.514*2;
		$y2 = $y1 - "$row[windspeed]"*cos(M_PI + "$row[winddir]"*M_PI/180)*150/15/.514*2;}
	
	// Draw arrows.
	arrow($im, $x1, $y1, $x2, $y2, 80, 20, $color);

	//save the image, the background imag.
	imagepng($im, "/home/liuduan/testpages/Map-frame-1/background-test.png");   

	// save data to file latest_obs.txt

}		//The end of the function Retrieve-Data-Draw-Line ()




function Total_current($Table_Name){
	# Get resource ID for retrieving data.
	$result = mysql_query("SELECT * FROM $Table_Name ORDER BY obs_time DESC limit 1");

	# Get one row of data.
	$row = mysql_fetch_array($result, MYSQL_BOTH);
  
	mysql_free_result($result);

	global $total_current;
	$total_current = $total_current + abs("$row[vnorth]") + abs("$row[veast]");
	
}		//The end of the function Retrieve-Data-Draw-Line ()





# ##### Connecting to tabs.

$dbhost = 'localhost';
$dbuser = 'tabsweb';
$dbpass = 'tabs';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<br />';

# Select database.
$sql = 'use tabsdb';
$retval = mysql_query($sql);
if(! $retval )
{
  die('Could not change database:' . mysql_error());
}
 echo "Database changed successfully<br />";

// open file to write latest observation data
$fp = fopen("/home/liuduan/testpages/Map-frame-1/latest_obs.txt", "w");


$total_current = 0;
										
Total_current("tabs_B_ven");
Total_current("tabs_D_ven");
Total_current("tabs_F_ven");
Total_current("tabs_J_ven");
Total_current("tabs_K_ven");
Total_current("tabs_N_ven");
Total_current("tabs_R_ven");
Total_current("tabs_V_ven");
Total_current("tabs_W_ven");

echo '$total_current = '. $total_current. '<br>';
if ($total_current > 240){$scale_factor = 0.5;}
else $scale_factor = 1;

echo '$scale_factor = '. $scale_factor. '<br>';
draw_legend();



// Responder buoy

$current_file = 
"http://tabs1.gerg.tamu.edu/~woody/newtabs/viewdata.php?buoy=responder002&filename=responder002.20140326.raw";

$current_handle = fopen($current_file, "r") or die("Couldn't open $current_file");;
if ($current_handle) {
	while (($line = fgets($current_handle)) !== false) {
		echo "2# ".$line;
		$last_line_2 = $last_line;
		$last_line = $line;
    }
} 

echo "Last -2 line: ". $last_line_2;
echo "<br>Last line". $line;
echo "<br>";



$B_current_east = substr($last_line_2, 20, 10);
echo "B current_east: ". $B_current_east;

echo "<br>";



$B_current_north = substr($last_line_2, 30, 9);
echo "B current_north: ". $B_current_north;

fclose($current_handle);

echo "中文";

exit;





// The order of the data table must be the same as in Map-frame-1.php line 203-247, because the lastest_obs.txt file is written here, which feed the data into Map-frame-1.php fuction Retrieve_Show_Data(). 

################################ Change here to switch buoys on or off ###################################################
// Retrieve_Data_Draw_Line("tabs_B_ven", (673-2)*2, 2*(302-5), $im, $yellow);        // Change here to switch buoys on or off ##############
// Retrieve_Data_Draw_Line("tabs_B_met", 1342, 594, $im, $red);
Retrieve_Data_Draw_Line("tabs_D_ven", 724, 969, $im, $yellow);
Retrieve_Data_Draw_Line("tabs_F_ven", 1561, 649, $im, $yellow);
Retrieve_Data_Draw_Line("tabs_J_ven", 656, 1607, $im, $yellow);
Retrieve_Data_Draw_Line("tabs_J_met", 656, 1607, $im, $red);
// Retrieve_Data_Draw_Line("tabs_K_ven", (414+2)*2, 2*(802-4), $im, $yellow);
// Retrieve_Data_Draw_Line("tabs_K_met", (414+2)*2, 2*(802-4), $im, $red);
// Retrieve_Data_Draw_Line("tabs_K_wave", 100, 100, $im, $red);
Retrieve_Data_Draw_Line("tabs_N_ven", 812*2, 2*498, $im, $yellow);
Retrieve_Data_Draw_Line("tabs_N_met", 812*2, 2*498, $im, $red);
Retrieve_Data_Draw_Line("tabs_N_wave", 100, 100, $im, $red);
Retrieve_Data_Draw_Line("tabs_R_ven", 875*2, 364, $im, $yellow);
Retrieve_Data_Draw_Line("tabs_V_ven", (879+2)*2, 2*(499-6), $im, $yellow);
Retrieve_Data_Draw_Line("tabs_V_met", (879+2)*2, 2*(499-6), $im, $red);
Retrieve_Data_Draw_Line("tabs_V_wave", 100, 100, $im, $red);
Retrieve_Data_Draw_Line("tabs_W_ven", 995, 2*(415-2), $im, $yellow);
Retrieve_Data_Draw_Line("ndbc_42019", 1200, 989, $im, $red);
Retrieve_Data_Draw_Line("ndbc_42020", 767, 1339, $im, $red);
Retrieve_Data_Draw_Line("ndbc_42035", 1500, 505, $im, $red);
Retrieve_Data_Draw_Line("ndbc_PTAT2", 657, 1020, $im, $red);
Retrieve_Data_Draw_Line("ndbc_SRST2", 1620, 348, $im, $red);

//echo "<img src=./background.png />";

imagedestroy($im);

# Close Connection.
mysql_close($conn);

# Close the file latest_obs.txt
fclose($fp);
}



$fp = fopen("/home/liuduan/testpages/Map-frame-1/latest_obs.txt", "r");

while ($line = fgetcsv($fp, 1000)){
	echo '<br>';
	echo '$line: '. $line;
	print_r($line);
	}
	
fclose($fp);

?>
  
  
  
  


  </body>
</html>

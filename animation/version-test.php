<?php 
header("Content-Type: application/vnd.google-earth.kml+xml"); 
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo  '<kml xmlns="http://www.opengis.net/kml/2.2">';
?>

<Document>  


<Style id="yellow">      
	<LineStyle>        
		<color>6414F0FF</color>        
		<width>3</width>      
	</LineStyle>          
	<PolyStyle>        
		<color>6414F0FF</color> 
  		<fill>1</fill>                     <!-- boolean -->
  		<outline>1</outline>               <!-- boolean -->
	</PolyStyle>    
</Style>
 
<Style id="red">      
	<LineStyle>        
		<color>641400FF</color>        
		<width>3</width>      
	</LineStyle>          
	<PolyStyle>        
		<color>641400FF</color> 
  		<fill>1</fill>                     <!-- boolean -->
  		<outline>1</outline>               <!-- boolean -->
	</PolyStyle>    

	<IconStyle>
      <scale>1</scale>
    </IconStyle>
</Style>



<?php

if ($_GET["model"]==""){$_GET["model"]="R";} // Give it a default value to run
if ($_GET["forecast_date"]==""){$_GET["forecast_date"]="-1";} // Give it a default value to run

$file_name_part1 = 'http://tabs2.gerg.tamu.edu/tglo/testpages/Comparison/forecast_files/';

switch ($_GET["model"]){
	case "POM_2m_":
		for ($n=0; $n <24; $n++){
			// Create image $file_name.
			if (date("H")<= 7 && $_GET[forecast_date]==0){
				$d= date("d", time()-3600*24);
				$file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+3600*($n+6)-3600*24);
				} 
				else {$d= date("d", time() + $_GET[forecast_date]*3600*24);
					$file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24+3600*($n+6));
					}
			$file_name = $file_name_part1. $d. $file_name_part2.  ".png";
		if (@fopen($file_name, "r")){
			echo '<GroundOverlay>      
  	  				<Icon>        
						<href>';
		   					echo $file_name;
						echo '</href>      
		            </Icon>  '; 
			echo '<TimeSpan id="ID'. $n. 'ID">';	
				if ($n==0 && (date("H")<= 7 && $_GET[forecast_date]==0))
					{$file_name_part22 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+3600*($n+6)-3600*24-3600);
					$box = $file_name_part22;}		
				else if ($n==0)
					{$file_name_part22 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+3600*($n+6) + $_GET[forecast_date]*3600*24-3600);
					$box = $file_name_part22;}
		  		echo '<begin>20'. substr($box, -8, 2). "-". substr($box, -6, 2). "-". substr($box, -4, 2). "T". substr($box, -2, 2). ":00:00Z". '</begin> ';
				echo '<end>20'. substr($file_name_part2, -8, 2). "-". substr($file_name_part2, -6, 2). "-". substr($file_name_part2, -4, 2). "T". substr($file_name_part2, -2, 2). ":00:00Z". '</end> ';
				$box = $file_name_part2;
			echo '</TimeSpan>
				  <LatLonBox>        
	  				<north>30.91</north>        
					<south>24.905</south>        
					<east>-91.23</east>        
					<west>-98.975</west>        
					<rotation>0</rotation>  
				  </LatLonBox>   
				</GroundOverlay>';
		}
		}
		break;
		
		case "R":
		for ($n=0; $n <75; $n++){
			// Create image $file_name.
			$file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24+3600*$n );
			$file_name = $file_name_part1. gmdate("d", time()+$_GET[forecast_date]*3600*24). $file_name_part2.  ".png";
		if (@fopen($file_name, "r")){		
			echo '<GroundOverlay>      
  	  				<Icon>        
						<href>';
							echo $file_name;
			echo '      </href>      
		            </Icon>  '; 
			echo '<TimeSpan id="ID'. $n. 'ID">';
				if ($n==0){
					$file_name_part22 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24 - 3600);
					$box = $file_name_part22;}		
		  		echo '<begin>20'. substr($box, -8, 2). "-". substr($box, -6, 2). "-". substr($box, -4, 2). "T". substr($box, -2, 2). ":00:00Z". '</begin> ';
				echo '<end>20'. substr($file_name_part2, -8, 2). "-". substr($file_name_part2, -6, 2). "-". substr($file_name_part2, -4, 2). "T". substr($file_name_part2, -2, 2). ":00:00Z". '</end> ';
				$box = $file_name_part2;
			echo '</TimeSpan>
				  <LatLonBox>        
	  				<north>30.91</north>        
					<south>24.905</south>        
					<east>-91.23</east>        
					<west>-98.975</west>        
					<rotation>0</rotation>  
				  </LatLonBox>   
				</GroundOverlay>';
		}
		}
		break;
		
		
		
		case "eta_":
		for ($n=0; $n <30; $n++){
			// Create image $file_name.
			$file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24+10800*$n);
			$file_name = $file_name_part1. gmdate("d", time()+$_GET[forecast_date]*3600*24). $file_name_part2.  ".png";
		if (@fopen($file_name, "r")){				
			echo '<GroundOverlay>      
  	  				<Icon>        
						<href>';
							echo $file_name;
			echo '      </href>      
		            </Icon>  '; 
			echo '<TimeSpan id="ID'. $n. 'ID">';
				if ($n==0){
				$file_name_part22 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24 - 10800);
				$box = $file_name_part22;}		
		  		echo '<begin>20'. substr($box, -8, 2). "-". substr($box, -6, 2). "-". substr($box, -4, 2). "T". substr($box, -2, 2). ":00:00Z". '</begin> ';
				echo '<end>20'. substr($file_name_part2, -8, 2). "-". substr($file_name_part2, -6, 2). "-". substr($file_name_part2, -4, 2). "T". substr($file_name_part2, -2, 2). ":00:00Z". '</end> ';
				$box = $file_name_part2;
			echo '</TimeSpan>
				  <LatLonBox>        
	  				<north>30.913</north>        
					<south>24.905</south>        
					<east>-91.228</east>        
					<west>-98.975</west>        
					<rotation>0</rotation>  
				  </LatLonBox>   
				</GroundOverlay>';
		}
		}
		break;
	}
	
	
	
	
// The following PHP code was copied from another file, buoy_anim.php.


// This function makes an kml-arrow.
function kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $alength, $awidth, $color) 
{

    $distance = sqrt(pow($x1 - $x2, 2) + pow($y1 - $y2, 2));

    $dx = $x2 + ($x1 - $x2) * $alength / $distance;
    $dy = $y2 + ($y1 - $y2) * $alength / $distance;

    $k = $awidth / $alength;

    $x2o = $x2 - $dx;
    $y2o = $dy - $y2;

    $x3 = $y2o * $k + $dx;
    $y3 = $x2o * $k + $dy;

    $x4 = $dx - $y2o * $k;
    $y4 = $dy - $x2o * $k;

	$x5=($x3+$x4)/2; $y5=($y3+$y4)/2; 



//The following draws
echo '<Placemark>';  
	echo '<styleUrl>#'.$color. '</styleUrl>      
		<LineString>	                   
			<coordinates>';
			echo $x1. ", ". $y1. "\n";
			echo $x5. ", ". $y5. "\n";
			echo '</coordinates>      
		</LineString>
		<TimeSpan>';
			echo '<begin>'.$time_begin.'</begin> ';
			echo '<end>'.$time_end.'</end> ';
		echo '</TimeSpan>
</Placemark>  ';

echo '<Placemark>';  
	echo '<styleUrl>#'.$color. '</styleUrl>     
  	<Polygon>  
		<altitudeMode>absolute</altitudeMode>        
  		<outerBoundaryIs>        
  		<LinearRing>
			<coordinates>    ';           
				echo $x3.", ". $y3. ", 0.5\n";
				echo $x4.", ". $y4. ", 0.5\n";
				echo $x2.", ". $y2. ", 0.5\n";	
				echo $x3.", ". $y3. ", 0.5\n";
 			echo '</coordinates>        
  		</LinearRing>      
  		</outerBoundaryIs>          
  	</Polygon>
	<TimeSpan>';
		echo '<begin>'.$time_begin.'</begin> ';
		echo '<end>'.$time_end.'</end>';
	echo '</TimeSpan>
</Placemark>';
}    //end of the function making_tabs_arrows()
	//The end of the function kml_arrow()
	    //The end of the function kml_arrow()

# ##### Connecting to tabs.
$dbhost = 'localhost';
$dbuser = 'tabsweb';
$dbpass = 'tabs';
global $conn; $conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
//exit('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully<br />';

# Select database.
$sql = 'use tabsdb';
$retval = mysql_query($sql);
if(! $retval )
{
//  exit('Could not change database:' . mysql_error());
}
// echo "Database changed successfully<br />";



function animate_a_buoy($conn, $time_begin, $time_end, $table_name, $x1, $y1, $color)
{
	if (substr($table_name, -3) == "ven"){$veast_factor = 0.0082; $vnorth_factor = 0.0072;}
		else {$veast_factor = 0.0946; $vnorth_factor = 0.083;}
		
# Get resource ID for retrieving data.
//$command = "SELECT obs_time, veast, vnorth FROM $table_name WHERE obs_time >= \"$time_begin\" AND obs_time <= \"$time_end\" ORDER BY obs_time";
global $result;
$result = mysql_query("SELECT obs_time, veast, vnorth FROM $table_name WHERE obs_time >= \"$time_begin\" AND obs_time <= \"$time_end\" ORDER BY obs_time");

// echo $command;
// echo mysql_affected_rows($conn );
// echo ' rows, <br>';

	for ($n=0; $n < mysql_affected_rows($conn); $n++){
		$time_begin = substr(mysql_result($result, $n, 0) , 0, 10). "T". substr(mysql_result($result, $n, 0) , 11). "Z";
		if ($n < mysql_affected_rows($conn)-1){
			$time_end = substr(mysql_result($result, $n+1, 0) , 0, 10). "T". substr(mysql_result($result, $n+1, 0) , 11). "Z";}
			else {$time_end = $time_begin;}
		if($n==(mysql_affected_rows($conn)-1)){$tune_ebd =$time_begin;}
		$veast = mysql_result($result, $n, 1); $veast = $veast * $veast_factor;
		$vnorth = mysql_result($result, $n, 2); $vnorth = $vnorth * $vnorth_factor;
		
		//kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $alength, $awidth, $color) 
		kml_arrow($time_begin, $time_end, $x1, $y1, $x1+$veast, $y1+$vnorth, .12, 0.04, $color);
		kml_arrow($time_begin, $time_end, $x1, $y1, $x1+$veast, $y1+$vnorth, .12, 0.04, $color);
		kml_arrow($time_begin, $time_end, $x1, $y1, $x1+$veast, $y1+$vnorth, .12, 0.02, $color);
		kml_arrow($time_begin, $time_end, $x1, $y1, $x1+$veast, $y1+$vnorth, .08, 0.02, $color);
	}

}	//end of function animate_a_buoy()



// The following determine the time span for showing observation data.
switch ($_GET["model"]){
	case "POM_2m_":
		// Create image $file_name.
		if (date("H")<= 7 && $_GET[forecast_date]==0){
			$first_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+3600*6-3600*24);
			$last_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+3600*(23+6)-3600*24);
			} 
			else {
			$first_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24+3600*6);
			$last_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24+3600*(23+6));
			}
		break;
		
	case "R":		// determine the first image $file_name.
		$first_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24);
		$last_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24+3600*74);
		break;
			
	case "eta_":	// Determine the first image $file_name.
		$first_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24);
		$last_file_name_part2 = $_GET["model"]. gmdate("ymdH", gmmktime(0, 0, 0, date("m, d, Y", time()))+ $_GET[forecast_date]*3600*24+10800*29);
		break;
}

$time_begin ='20'. substr($first_file_name_part2, -8, 2). "-". substr($first_file_name_part2, -6, 2). "-". substr($first_file_name_part2, -4, 2). "T". substr($first_file_name_part2, -2, 2). ":00:00Z";

$time_end ='20'. substr($last_file_name_part2, -8, 2). "-". substr($last_file_name_part2, -6, 2). "-". substr($last_file_name_part2, -4, 2). "T". substr($last_file_name_part2, -2, 2). ":00:00Z";


animate_a_buoy($conn, $time_begin, $time_end, "tabs_B_met", -94.9186, 28.9818, "red");
animate_a_buoy($conn, $time_begin, $time_end, "tabs_B_ven", -94.9186, 28.9818, "yellow");
animate_a_buoy($conn, $time_begin, $time_end, "tabs_D_ven", -96.8429, 27.9396, "yellow");
animate_a_buoy($conn, $time_begin, $time_end, "tabs_F_ven", -94.2416, 28.8425, "yellow");

animate_a_buoy($conn, $time_begin, $time_end, "tabs_J_met", -97.0507, 26.194, "red");
animate_a_buoy($conn, $time_begin, $time_end, "tabs_J_ven", -97.0507, 26.194, "yellow");

animate_a_buoy($conn, $time_begin, $time_end, "tabs_K_met", -96.4998, 26.2168, "red");
animate_a_buoy($conn, $time_begin, $time_end, "tabs_K_ven", -96.4998, 26.2168, "yellow");

animate_a_buoy($conn, $time_begin, $time_end, "tabs_N_met", -94.0367, 27.8903, "red");
animate_a_buoy($conn, $time_begin, $time_end, "tabs_N_ven", -94.0367, 27.8903, "yellow");

animate_a_buoy($conn, $time_begin, $time_end, "tabs_R_ven", -93.6417, 29.635, "red");

animate_a_buoy($conn, $time_begin, $time_end, "tabs_V_met", -93.5973, 27.8966, "red");
animate_a_buoy($conn, $time_begin, $time_end, "tabs_V_ven", -93.5973, 27.8966, "yellow");

animate_a_buoy($conn, $time_begin, $time_end, "tabs_W_ven", -96.0058, 28.3507, "yellow");

 
mysql_free_result($result);
# Close Connection.
mysql_close($conn);
	
?>


<Placemark>    
	<name>B</name>    
	<description>
		<center><h2>TABS Buoy B</h2>94.9186W, 28.9818N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=B"><u>Details about Buoy B</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-94.9186,28.9818,0</coordinates>    
	   </Point>  
</Placemark>


<Placemark>    
	<name>D</name>    
	<description>
		<center><h2>TABS Buoy D</h2>96.8429W, 27.9396N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=D"><u>Details about Buoy D</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-96.8429, 27.9396,0</coordinates>    
	   </Point>  
</Placemark>

<Placemark>    
	<name>F</name>    
	<description>
		<center><h2>TABS Buoy F</h2>94.2416W, 28.8425N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=F"><u>Details about Buoy F</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-94.2416, 28.8425,0</coordinates>    
	   </Point>  
</Placemark>

<Placemark>    
	<name>J</name>    
	<description>
		<center><h2>TABS Buoy J</h2>97.0507W, 26.194N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=J"><u>Details about Buoy J</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-97.0507,26.194,0</coordinates>    
	   </Point>  
</Placemark>

<Placemark>    
	<name>K</name>    
	<description>
		<center><h2>TABS Buoy K</h2>96.4998W, 26.2168N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=K"><u>Details about Buoy K</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-96.4998,26.2168,0</coordinates>    
	   </Point>  
</Placemark>

<Placemark>    
	<name>N</name>    
	<description>
		<center><h2>TABS Buoy N</h2>94.0367W, 27.8903N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=N"><u>Details about Buoy N</u></a></p></center>
	</description>    
	<Point>      
	   <coordinates>-94.0367,27.8903,0</coordinates>    
	</Point>  
</Placemark>

<Placemark>    
	<name>R</name>    
	<description>
		<center><h2>TABS Buoy R</h2>93.6417W, 29.635N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=R"><u>Details about Buoy R</u></a></p></center>	
	</description>    
	<Point>      
	   <coordinates>-93.6417,29.635,0</coordinates>    
	</Point>  
</Placemark>

<Placemark>    
	<name>V</name>    
	<description>
	   <center><h2>Flower Garden Buoy V</h2>93.5973W, 27.8966N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=V"><u>Details about Buoy V</u></a></p></center>		
	</description>    
	   <Point>      
	   <coordinates>-93.5973,27.8966,0</coordinates>    
	   </Point>  
</Placemark>

<Placemark>    
	<name>W</name>
	<LookAt id="I8D">
  		<longitude>-95</longitude>            <!-- kml:angle180 -->
		<latitude>28</latitude>              <!-- kml:angle90 -->
  		<altitude>1000</altitude>              <!-- double --> 
  		<tilt>0</tilt>                      <!-- kml:anglepos90 -->
  		<range>10000</range>                     <!-- double -->
	</LookAt>    
	<description><center><h2>TABS Buoy W</h2> 28.3507N, 96.0058W. <p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=W"><u>Details about Buoy W</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-96.0058,28.3507,0</coordinates>    
	   </Point>  
</Placemark>


<Placemark>    
	<name></name>
	<description><center> <p><a href="http://www.glo.texas.gov/"><u>Texas General Land Office</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-97.7393,30.2794,0</coordinates>    
	   </Point>  
</Placemark>


<Placemark>    
	<name></name>
	<description><center> <p><a href="http://gerg.tamu.edu/"><u>Geochemical and Environment Research Group</u></a></p></center>
	</description>    
	   <Point>      
	   <coordinates>-96.29461,30.57099,0</coordinates>    
	   </Point>  
</Placemark>











<GroundOverlay>
	<styleUrl>#red</styleUrl> 
	<Icon>   
		<href>http://tabs2.gerg.tamu.edu/tglo/testpages/animation/legend_anim.png</href>
	</Icon>
	<LatLonBox>
    	<north>30.64</north>                     
    	<south>24.87</south>                   
    	<east>-91.3</east>                     
    	<west>-99.1</west>                     
    	<rotation>0</rotation>                  
  	</LatLonBox>                   
</GroundOverlay>

 </Document>  

			</kml>

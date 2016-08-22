<?php 
// comment out kml heading for the moment.
header("Content-Type: application/vnd.google-earth.kml+xml"); 
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo  '<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2">';

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
		<color>501400FF</color>        
		<width>8</width>      
	</LineStyle>          
	<PolyStyle>        
		<color>501400FF</color> 
  		<fill>1</fill>                     <!-- boolean -->
  		<outline>1</outline>               <!-- boolean -->
	</PolyStyle>    

	<IconStyle>
      <scale>1</scale>
    </IconStyle>
</Style>



<?php

// echo 'One hour later: '. One_hour_later('2010-01-08T03:00:00'). '<br>';




function One_hour_later($time_begin) {

	$time_begin = substr($time_begin, 0, 10). ' '. substr($time_begin, 11, 10);
	// echo '$time_begin = '. $time_begin. '<br>';
	$d = strtotime($time_begin);
	$d = $d + 3600;
	$One_hour_later = date('Y-m-d', $d). "T".date('h:i:s', $d);
	// echo '$One_hour_later = '. $One_hour_later. '<br>';
    return $One_hour_later;
	}   



$objConnect = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
$objDB = mysql_select_db("TABS_ADCP");


$MySQL_command = "SELECT obs_time, U_east, V_north, depth FROM TABS_ADCP.225m01_ADCP_large". 
	" WHERE depth <= 62 AND obs_time LIKE '%:00:00' ORDER BY obs_time desc, depth limit 2688"; // 14*48*4";
global $result;
$result = mysql_query($MySQL_command);


// Buoy K official location lat: 26.2168, long: -96.49883;
$x1 = -96.49883; 
$y1 = 26.2168;
$veast_factor = 0.0000082; 	// was 0.0082; 
$vnorth_factor = 0.0000072;	// was 0.0072;

$color = "red";

$n = 0;
while($row = mysql_fetch_array($result)){			# get data row by row

	$n = $n + 1;
	$obs_time[$n] = substr($row["obs_time"], 0, 10). "T". substr($row["obs_time"], 11, 8); 
	// echo ', $obs_time['. $n. '] = '. $obs_time[$n].'<br>';
	
	$U_east[$n] = $row["U_east"]; 
	// echo '$U_east['. $n. '] = '. $U_east[$n].'<br>';
		
	$V_north[$n] = $row["V_north"]; 
	// echo '$V_east['. $n. '] = '. $V_north[$n].'<br>';
	
	$depth[$n] = -1 * $row["depth"]; 
	// echo '$depth['. $n. '] = '. $depth[$n].'<br>';
		
	// calculate angle of current
	$angle[$n] = atan2($V_north[$n], $U_east[$n])/(2*pi())*360 - 90;
	// echo '$angle['. $n. '] = '. $angle[$n].'<br>';
	
	
	// print_r($row);
	// echo '<br>';echo '<br>';
	
	
	$time_begin = $obs_time[$n];
	$time_end   = One_hour_later($obs_time[$n]);
		
	$x2 = $x1 + $U_east[$n] * $veast_factor; 
	$y2 = $y1 + $V_north[$n] * $vnorth_factor;
		
	// kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $head_angle, $color) 
	kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth[$n], $angle[$n], $color);
		
}


// echo $command;
// echo mysql_affected_rows($conn );
// echo ' rows, <br>';




mysql_close($objConnect);



// exit();


// This function makes an kml-arrow.
function kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $head_angle, $color) {

	$x_adj = ($x2-$x1)*0.00006/pow((pow(($x1-$x2), 2) + pow(($y1-$y2),2)), 0.5);

	$y_adj = ($y2-$y1)*0.00006/pow((pow(($x1-$x2), 2) + pow(($y1-$y2),2)), 0.5);


    //The following draws a line
	echo '<Placemark>';  
		echo '<styleUrl>#'.$color. '</styleUrl>      
		<LineString>	 
			<altitudeMode>absolute</altitudeMode>                  
			<coordinates>';
			echo $x1. ",". $y1. ",$depth \n";
			echo ($x2 - $x_adj*2.067). ",". ($y2 - $y_adj*2.067). ",$depth \n";
			echo '</coordinates>      
		</LineString>
		<TimeSpan id="ID'. $x2. $depth. '">';
			echo '<begin>'.$time_begin.'</begin> ';
			echo '<end>'.$time_end.'</end> ';
		echo '</TimeSpan>
	</Placemark>  ';

	// The following is a arrow head.
	echo '<GroundOverlay>
		<Icon>   
			<href>http://tabs1.gerg.tamu.edu/tglo/testpages/ADCP/arrow-head.png</href>
		</Icon>';
	
	echo '<TimeSpan id="ID'. $x2. $depth. 'ID">';
		echo '<begin>'.$time_begin.'</begin> ';
		echo '<end>'.$time_end.'</end>'. "\n";
	echo '</TimeSpan>';
	echo "\n";


	echo '<LatLonBox>	
     	<north>'. ($y2 - $y_adj + 0.00006) . '</north>        
		<south>'. ($y2 - $y_adj - 0.00006) . '</south>        
		<east>'. ($x2 - $x_adj + 0.000066) . '</east>        
		<west>'. ($x2 - $x_adj - 0.000066) . '</west> ' ;      
		echo '<rotation>'. $head_angle. '</rotation>  
	 </LatLonBox>  ';
	echo '<altitude>'. $depth. '</altitude>';
	echo '<altitudeMode>absolute</altitudeMode>    
	</GroundOverlay>';

	}    //end of the function making_tabs_arrows()  *************************************************
		//The end of the function kml_arrow()
	   
		
?>

<Placemark><styleUrl>#yellow</styleUrl>      
		<LineString>	 
			<altitudeMode>absolute</altitudeMode>                
			<coordinates>
            	-96.49883,26.2168,0 
				-96.49883,26.2168,-62
			</coordinates>      
		</LineString>
</Placemark> 



<Placemark>    
	<name></name>    
	<description>
		<center><h2>TABS Buoy N</h2>96.49883W, 26.2168N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=N"><u>Details about Buoy N</u></a></p></center>
	</description>    
	<Point>      
	   <coordinates>-96.49883,26.2168,0.0</coordinates>     
	</Point> 
    <Style>
      <IconStyle>
        <Icon>
          <href>http://tabs1.gerg.tamu.edu/tglo/testpages/animation/ylw-pushpin.png</href>
        </Icon>
      </IconStyle>
   </Style> 
</Placemark>





<GroundOverlay> <!-- for Grid -->
	<Icon>   
		<href>http://tabs1.gerg.tamu.edu/tglo/testpages/ADCP/225m01/grid_20x20.png</href>
	</Icon>
    <altitude>-62</altitude>
        <altitudeMode>absolute</altitudeMode>
	<LatLonBox>
    	<north><?php echo (26.2168 + 0.001); ?></north>                     
    	<south><?php echo (26.2168 - 0.001); ?></south>                   
    	<east><?php echo (-96.49883 + 0.0011); ?></east>                     
    	<west><?php echo (-96.49883 - 0.0011); ?></west>                     
    	<rotation>0</rotation>                  
  	</LatLonBox>  

</GroundOverlay>

<?php
kml_arrow($obs_time[0][0], $obs_time[0][150], 
	-96.49883 + 0.0006, 
	26.2168 + 0.0009, 
	(-96.49883 + 0.0006 + 50*$vnorth_factor), 
	(26.2168 + 0.0009), 
	-100, 270, $color);	
?>






<GroundOverlay> <!-- for Compass overlay -->
	<Icon>   
		<href>http://tabs1.gerg.tamu.edu/tglo/testpages/animation/Compass.png</href>
	</Icon>
	<LatLonBox>
    	<north><?php echo (26.2168 + 0.0001*2) + 0.0008; ?></north>                     
    	<south><?php echo (26.2168 - 0.0001*2 + 0.0008); ?></south>                   
    	<east><?php echo (-96.49883 + 0.0001 - 0.001); ?></east>                     
    	<west><?php echo (-96.49883 - 0.0001 - 0.001); ?></west>                     
    	<rotation>0</rotation>                  
  	</LatLonBox>  
      <altitude>-100.0</altitude>
  <altitudeMode>absolute</altitudeMode>    
</GroundOverlay>


<GroundOverlay> <!-- for Compass overlay -->
	<Icon>   
		<href>http://tabs1.gerg.tamu.edu/tglo/testpages/animation/Compass.png</href>
	</Icon>
	<LatLonBox>
    	<north><?php echo (26.2168 + 0.0001*2) - 0.0008; ?></north>                     
    	<south><?php echo (26.2168 - 0.0001*2 - 0.0008); ?></south>                   
    	<east><?php echo (-96.49883 + 0.0001 + 0.001); ?></east>                     
    	<west><?php echo (-96.49883 - 0.0001 + 0.001); ?></west>                     
    	<rotation>0</rotation>                  
  	</LatLonBox>  
      <altitude>-100.0</altitude>
  <altitudeMode>absolute</altitudeMode>    
</GroundOverlay>
 </Document>  

			</kml>

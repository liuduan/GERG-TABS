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
		<width>8</width>      
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

$file_name = 'kml_data_pass2.txt';

			
$file_handle = @fopen($file_name, "r");
	if (!$file_handle) {	echo "Cannot open file $file_names[$file_n]";}	// end of if ($file_handle)

for ($n=0; $n<=3; $n++) {$buffer[$n] = fgets($file_handle, 200);}	// get rid of the first 4 lines
		
for ($n=0; $n<=13135; $n++) {							// There are 13130 elements ######################################
  		// echo "$file_names[$file_n], The line number is: $n <br>";
		$buffer[$n] = fgets($file_handle, 200);
		// echo '$buffer['. $n. '] = '. $buffer[$n].'<br>';
		
		$obs_time[$n] = substr($buffer[$n], 0, 25); 
		// echo '$obs_time['. $n. '] = a'. $obs_time[$n].'a<br>';
		
		$lon[$n] = substr($buffer[$n], 27, 11); 
		$lat[$n] = substr($buffer[$n], 41, 10); 
		// echo 'lat, lon: a'. $lat[$n]. 'a, a'. $lon[$n].'a<br>';
		
		$depth[$n] = substr($buffer[$n], 52, 7); 
		// echo '$depth['. $n. '] = a'. $depth[$n].'a<br><br>';
			

		
		} 		// end of for ($n=1; $n<=350; $n++)

fclose($file_handle);


//exit();





// This function draws a Vertical line.
function draw_vertical_line($time_begin, $time_end, $x, $y) {

    //The following draws aline
	echo '<Placemark>';  
		echo '<styleUrl>#yellow</styleUrl>      
		<LineString>	
			<altitudeMode>absolute</altitudeMode>                  
			<coordinates>';
			echo $x. ",". $y. ',1000'. "\n";
			echo $x. ",". $y. ',-100'. "\n";
			echo '</coordinates>      
		</LineString>
		<TimeSpan id="ID'. $x2. $depth. '">';
			echo '<begin>'.$time_begin.'</begin> ';
			echo '<end>'.$time_end.'</end> ';
		echo '</TimeSpan>
	</Placemark>  ';
	}    //end of the function draw_vertical_line()  *************************************************



// This function draws a line.
function draw_line($time_begin, $time_end, $x1, $x2, $y1, $y2, $z1, $z2, $color) {

    //The following draws aline
	echo '<Placemark>'."\n";  
		echo '<styleUrl>#'. $color. '</styleUrl>      
		<LineString>	
			<altitudeMode>absolute</altitudeMode>                  
			<coordinates>'."\n";
			echo $x1. ",". $y1. ','.$z1. "\n";
			echo $x2. ",". $y2. ','.$z2. "\n";
			echo '</coordinates>      
		</LineString>
		<TimeSpan id="ID'. $x2. $depth. '">';
			echo '<begin>'.$time_begin.'</begin> ';
			echo '<end>'.$time_end.'</end> ';
		echo '</TimeSpan>
	</Placemark>  '."\n";
	}    //end of the function draw_line()  *************************************************
		



for ($n=0; $n<=13128; $n++) {				// There are 13130 lines ######################################
  		$time_begin = $obs_time[$n];
		$time_end   = $obs_time[$n+1];
		
		$x1 = $lon[$n];
		$y1 = $lat[$n];
		$z1 = $depth[$n];

		$x2 = $lon[$n+1];
		$y2 = $lat[$n+1];
		$z2 = $depth[$n+1];
		if ($depth[$n]>$depth[$n+1]){$color = 'red';}
		if ($depth[$n]<$depth[$n+1]){$color = 'yellow';}
		if ($depth[$n]> -1){
			draw_vertical_line($time_begin, $time_end, $x1, $y1);
			}
		
		draw_line($time_begin, $time_end, $x1, $x2, $y1, $y2, $z1, $z2, $color);
	}	// end of for, cycling file names.
	
?>

<Placemark><styleUrl>#yellow</styleUrl>      
		<LineString>	 
			<altitudeMode>absolute</altitudeMode>                
			<coordinates>
            	-94.03703,27.8897,0 
				-94.03703,27.8897,-100
			</coordinates>      
		</LineString>
</Placemark> 



<Placemark>    
	<name></name>    
	<description>
		<center><h2>TABS Buoy N</h2>94.03703W, 27.8897N<p><a href="http://tabs.gerg.tamu.edu/tglo/ven.php?buoy=N"><u>Details about Buoy N</u></a></p></center>
	</description>    
	<Point>      
	   <coordinates>-93.4909774,29.1368091,0.0</coordinates>     
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
		<href>http://tabs1.gerg.tamu.edu/tglo/testpages/Glider/Mission_7/grid_20x20.png</href>
	</Icon>
    <altitude>1</altitude>
    <gx:altitudeMode>relativeToSeaFloor</gx:altitudeMode>
	<LatLonBox>
    	<north><?php echo (29.1368091+ 0.1); ?></north>                     
    	<south><?php echo (29.1368091- 0.1); ?></south>                   
    	<east><?php echo (-93.4909774 + 0.51); ?></east>                     
    	<west><?php echo (-93.4909774 - 0.01); ?></west>                     
    	<rotation>0</rotation>                  
  	</LatLonBox>  

</GroundOverlay>









<GroundOverlay> <!-- for Compass overlay -->
	<Icon>   
		<href>http://tabs1.gerg.tamu.edu/tglo/testpages/animation/Compass.png</href>
	</Icon>
	<LatLonBox>
    	<north><?php echo (27.889715 + 0.0001*2) - 0.0008; ?></north>                     
    	<south><?php echo (27.889715 - 0.0001*2 - 0.0008); ?></south>                   
    	<east><?php echo (-94.03703 + 0.0001 + 0.001); ?></east>                     
    	<west><?php echo (-94.03703 - 0.0001 + 0.001); ?></west>                     
    	<rotation>0</rotation>                  
  	</LatLonBox>  
      <altitude>-100.0</altitude>
  <altitudeMode>absolute</altitudeMode>    
</GroundOverlay>
 </Document>  

			</kml>

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

$file_dir = '/home/woody/tglo/buoys/N/adcp/';
$file_names = array('toots_n.009.asc', 'toots_n.014.asc', 'toots_n.019.asc', 'toots_n.024.asc', 'toots_n.029.asc',
					'toots_n.034.asc', 'toots_n.039.asc', 'toots_n.044.asc', 'toots_n.049.asc', 'toots_n.054.asc',
					'toots_n.059.asc', 'toots_n.064.asc', 'toots_n.069.asc', 'toots_n.074.asc', 'toots_n.079.asc',
					'toots_n.084.asc', 'toots_n.089.asc', 'toots_n.094.asc', 'toots_n.099.asc');	// 0-18, total: 19 
			
// Constructing arrays $obs_time[19][351], $u_east, $v_north, $temp[351]
for ($file_n=0; $file_n<=18; $file_n++) {			// cycling file names, 

	$file_handle = @fopen($file_dir. $file_names[$file_n], "r");
	if (!$file_handle) {	echo "Cannot open file $file_names[$file_n]";}	// end of if ($file_handle)

	for ($n=0; $n<=350; $n++) {				// should be 350
  		// echo "$file_names[$file_n], The line number is: $n <br>";
		$buffer[$n] = fgets($file_handle, 200);
		// echo '$buffer['. $n. '] = '. $buffer[$n].'<br>';
		
		$obs_time[$file_n][$n] = substr($buffer[$n], 6, 4). '-'. substr($buffer[$n], 0, 2). '-'. substr($buffer[$n], 3, 2). 
			"T". substr($buffer[$n], 11, 8); 
		// echo '$obs_time['. $file_n. ']['. $n. '] = '. $obs_time[$file_n][$n].'<br>';
		
		$u_east[$file_n][$n] = substr($buffer[$n], 20, 10); 
		// echo '$u_east['. $file_n. ']['. $n. '] = '. $u_east[$file_n][$n].'<br>';
		
		$v_north[$file_n][$n] = substr($buffer[$n], 30, 10); 
		// echo '$v_north['. $file_n. ']['. $n. '] = '. $v_north[$file_n][$n].'<br>';
		
		// calculate angle of current
		$angle[$file_n][$n] = atan2($v_north[$file_n][$n], $u_east[$file_n][$n])/(2*pi())*360 - 90;
			
		if($file_n == 0){
			$temp[$n] = substr($buffer[$n], 59, 10); 
			// echo 'temp['. $n. '] = '. $temp[$n].'<br>';
			}
		
		// $row = fgetcsv($file_handle, 200, $delimiter);
		// print_r($row);
		// echo '<br>';
		
		} 		// end of for ($n=1; $n<=350; $n++)

	fclose($file_handle);
	// echo '<br>';
}	// end of for, cycling file names.


// This function makes an kml-arrow.
function kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $head_angle, $color) {

	$x_adj = ($x2-$x1)*0.00006/pow((pow(($x1-$x2), 2) + pow(($y1-$y2),2)), 0.5);

	$y_adj = ($y2-$y1)*0.00006/pow((pow(($x1-$x2), 2) + pow(($y1-$y2),2)), 0.5);


    //The following draws aline
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
	   
		





// Buoy N official location lat: 27.8897, long: -94.03703;


// to draw arrows using the arrays $obs_time[19][351], $u_east, $v_north, $temp[351]
// function kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $alength, $awidth, $color)

$x1 = -94.03703; 
$y1 = 27.8897;
$veast_factor = 0.0000082; 	// was 0.0082; 
$vnorth_factor = 0.0000072;	// was 0.0072;
$depth_list = 
	array(-9.0, -14.0, -19.0, -24.0, -29.0, -34.0, -39.0, -44.0, -49.0, -54.0, -59.0, -64.0, 
		-69.0, -74.0, -79.0, -84.0, -89.0, -94.0, -99.0);
$color = "red";

for ($file_n=0; $file_n<=18; $file_n++) {			// cycling file names, and should be 0 - 18 

	for ($n=0; $n<=150; $n++) {				// should be 0-349
	if (($n%2)==0){
  		$time_begin = $obs_time[$file_n][$n];
		$time_end   = $obs_time[$file_n][$n+2];
		
		$x2 = $x1 + $u_east[$file_n][$n] * $veast_factor; 
		$y2 = $y1 + $v_north[$file_n][$n] * $vnorth_factor;
		
		// kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $color) 
		kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth_list[$file_n], $angle[$file_n][$n], $color);
		} }		// end of for ($n=1; $n<=10; $n++), end of if (($n/3)==0)
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
	   <coordinates>-94.03703,27.8897,0.0</coordinates>     
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
		<href>http://tabs1.gerg.tamu.edu/tglo/testpages/ADCP/grid_20x20.png</href>
	</Icon>
    <altitude>-100</altitude>
        <altitudeMode>absolute</altitudeMode>
	<LatLonBox>
    	<north><?php echo (27.889715 + 0.001); ?></north>                     
    	<south><?php echo (27.889715 - 0.001); ?></south>                   
    	<east><?php echo (-94.03703 + 0.0011); ?></east>                     
    	<west><?php echo (-94.03703 - 0.0011); ?></west>                     
    	<rotation>0</rotation>                  
  	</LatLonBox>  

</GroundOverlay>

<?php
kml_arrow($obs_time[0][0], $obs_time[0][150], 
	-94.03703 + 0.0006, 
	27.889715 + 0.0009, 
	(-94.03703 + 0.0006 + 50*$vnorth_factor), 
	(27.889715 + 0.0009), 
	-100, 270, $color);	
?>






<GroundOverlay> <!-- for Compass overlay -->
	<Icon>   
		<href>http://tabs1.gerg.tamu.edu/tglo/testpages/animation/Compass.png</href>
	</Icon>
	<LatLonBox>
    	<north><?php echo (27.889715 + 0.0001*2) + 0.0008; ?></north>                     
    	<south><?php echo (27.889715 - 0.0001*2 + 0.0008); ?></south>                   
    	<east><?php echo (-94.03703 + 0.0001 - 0.001); ?></east>                     
    	<west><?php echo (-94.03703 - 0.0001 - 0.001); ?></west>                     
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

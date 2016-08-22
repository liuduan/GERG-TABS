<?php 
// comment out kml heading for the moment.
header("Content-Type: application/vnd.google-earth.kml+xml"); 
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo  '<kml xmlns="http://www.opengis.net/kml/2.2 ">';

?>

<Document 222>  


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

$file_dir = '/home/woody/tglo/buoys/N/adcp/';
$file_names = array('toots_n.009.asc', 'toots_n.014.asc', 'toots_n.019.asc', 'toots_n.024.asc', 'toots_n.029.asc',
					'toots_n.034.asc', 'toots_n.039.asc', 'toots_n.044.asc', 'toots_n.049.asc', 'toots_n.054.asc',
					'toots_n.059.asc', 'toots_n.064.asc', 'toots_n.069.asc', 'toots_n.074.asc', 'toots_n.079.asc',
					'toots_n.084.asc', 'toots_n.089.asc', 'toots_n.094.asc', 'toots_n.099.asc');	// 0-18, total: 19 
			
// Constructing arrays $obs_time[19][351], $u_east, $v_north, $temp[351]
for ($file_n=0; $file_n<=18; $file_n++) {			// cycling file names, 

	$file_handle = @fopen($file_dir. $file_names[$file_n], "r");
	if (!$file_handle) {	echo "Cannot open file $file_names[$file_n]";}	// end of if ($file_handle)

	for ($n=0; $n<=10; $n++) {				// should be 350
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
		
		if($file_n == 0){
			$temp[$n] = substr($buffer[$n], 59, 10); 
			// echo 'temp['. $n. '] = '. $temp[$n].'<br>';
			}
		
		// $row = fgetcsv($file_handle, 200, $delimiter);
		// print_r($row);
		// echo '<br>';
		
		} 		// end of for ($n=1; $n<=10; $n++)

	fclose($file_handle);
	// echo '<br>';
}	// end of for, cycling file names.

/*
echo 'hello';
echo 'print_r($obs_time)<br>';


print_r($obs_time);
echo '<br>';
echo 'print_r($u_east)<br>';
print_r($u_east);
echo '<br>';
echo 'print_r($v_north)<br>';
print_r($v_north);
echo '<br>';
echo 'print_r($temp)<br>';
print_r($temp);
echo '<br>';


exit;
*/

// This function makes an kml-arrow.
function kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $alength, $awidth, $color) {

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
			<altitudeMode>absolute</altitudeMode>                  
			<coordinates>';
			echo $x1. ",". $y1. ", $depth \n";
			echo $x5. ",". $y5. ", $depth \n";
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
				echo $x3.",". $y3. ", $depth \n";
				echo $x4.",". $y4. ", $depth \n";
				echo $x2.",". $y2. ", $depth \n";	
				echo $x3.",". $y3. ", $depth \n";
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
		


// Buoy N location lat: 27.889715, long: -94.0370483;


// to draw arrows using the arrays $obs_time[19][351], $u_east, $v_north, $temp[351]
// function kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $alength, $awidth, $color)

$x1 = -94.0370483; 
$y1 = 27.889715;
$veast_factor = 0.0082; 
$vnorth_factor = 0.0072;
$depth_list = array(09, 14, 19, 24, 29, 34, 39, 44, 49, 54, 59, 64, 69, 74, 79, 84, 89, 94, 99);
$color = "red";

for ($file_n=0; $file_n<=1; $file_n++) {			// should be 18, cycling file names, 

	for ($n=0; $n<=1; $n++) {				// should be 350
  		$time_begin = $obs_time[$file_n][$n];
		$time_end   = $obs_time[$file_n][$n];
		
		$x2 = $x1 + $u_east[$file_n][$n] * $veast_factor; 
		$y2 = $y1 + $v_north[$file_n][$n] * $vnorth_factor;
		
		kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth_list[$file_n], .12, 0.04, $color);
		kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth_list[$file_n], .12, 0.04, $color);
		kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth_list[$file_n], .12, 0.02, $color);
		kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth_list[$file_n], .08, 0.02, $color);
	 // kml_arrow($time_begin, $time_end, $x1, $y1, $x2, $y2, $depth, $alength, $awidth, $color) 
		
		} 		// end of for ($n=1; $n<=10; $n++)

	}	// end of for, cycling file names.




	
?>


 </Document>  

			</kml>
<p>&nbsp;</p>
<p>&nbsp;</p>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
  <META HTTP-EQUIV ="Expire" CONTENT ="0">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Daily Forecast Correction</title>

<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:1015px;
	height:285px;
	z-index:1;
	left: 92px;
	top: 491px;
}
.STYLE3 {
	color: #000066;
	font-size: 30px;
}
.STYLE4 {
	font-size: 18px;
	font-family: Arial, Helvetica, sans-serif;
}
.STYLE5 {font-size: 18px; font-family: "Arial", Times, serif; }
.STYLE6 {color: #0000FF;}
.STYLE7 {font-family: Arial, Helvetica, sans-serif; 		}
.STYLE9 {font-family: Arial, Helvetica, sans-serif, serif; color: #800000; font-size: 14px;}
#Layer2 {
	position:absolute;
	width:855px;
	height:228px;
	z-index:1;
	left: 159px;
	top: 535px;
}
#Layer3 {
	position:relative;
	width:auto;
	height:115px;
	left: 2px;
	top: 5px;
	z-index:1;
}
-->
</style>
</head>
<body background="./gradient_bgr.png">

<p>&nbsp;</p>
<center>
<h2 class="STYLE3">THE ADJUSTMENT </P> FOR THE SURFACE CURRENT FORECASTS</h2>
<p align="center">


<p><span class="STYLE6"><h2><b>With TABS Observation Data</b></h2></span> <p>
</p>

<p>

<p>&nbsp;</p>
<p align="center">
<div id="Layer3">  <blockquote>
<h2 align="left"><span class="STYLE6"><blockquote>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Why The Surface Current Forecasts Need To Be Adjusted?</b></span></h2></blockquote> 
  <blockquote>
   <div align="left">
   <blockquote>
     <p align="justify"><span class="STYLE5">In order to make the forecast more accurate, the observations were integrated into the current forecasts. The Texas Automated Buoy System (TABS) continuously reports near-real-time currents and winds along the Texas coast. At the same time, Dr. Robert Hetland’s modeling group issues surface current forecasts four times a day for next 72 hours (<a href="http://csanady.tamu.edu/GNOME/gnome2.html" target="_blank"><font color="black">http://csanady.tamu.edu/GNOME/gnome2.html</font></a>). The forecasts are made with Regional Ocean Modeling System (ROMS), and the major input to the model is the wind forecast from the National Center for Environmental Prediction. However, presently the TABS observation data are not integrated into the ROMS model for the forecasts yet. Here is our way to adjust the surface current forecast with the TABS observation data. We compare the model outputs and the observations in past five days, and the biases are extracted to adjust the forecast for next 72 hours. 
     </p>   </span>
<span class="STYLE5">
     Adjusted forecast files:
     </br>     </blockquote>   <blockquote><align="justify">
   </span>
     
       <table width="1050" border="0">
       <tr>
         <td>
  <?php
$n = 0;
if ($handle = opendir('./Corrected-NetCDF/')) {
    while (false !== ($entry = readdir($handle))) {
			$n = $n + 1;
    }
    closedir($handle);
}
//echo "Total file number is: ". $n.'</br>';

$file_list = array_fill(0, $n, "000");

//print_r($file_list);
//echo '</br>';

$i = 0;
if ($handle = opendir('./Corrected-NetCDF/')) {
    while (false !== ($entry = readdir($handle))) {
			$file_list[$i] = $entry;
			$i = $i + 1;
    }
    closedir($handle);
}

//print_r($file_list);
//echo '</br>';
rsort($file_list);
//print_r($file_list);
//echo '</br>';

for ($i = 0; $i < 8; $i++){
	echo '<a href = ./Corrected-NetCDF/';
	echo $file_list[$i];
	echo '>';
	echo $file_list[$i];
	echo '</a></br>';
}
echo '</td><td>';
for ($i = 8; $i < 16; $i++){
	echo '<a href = ./Corrected-NetCDF/';
	echo $file_list[$i];
	echo '>';
	echo $file_list[$i];
	echo '</a></br>';
}
echo '</td><td>';
for ($i = 16; $i < 24; $i++){
	echo '<a href = ./Corrected-NetCDF/';
	echo $file_list[$i];
	echo '>';
	echo $file_list[$i];
	echo '</a></br>';
}

echo '</td><td>';
for ($i = 24; $i < 32; $i++){
	echo '<a href = ./Corrected-NetCDF/';
	echo $file_list[$i];
	echo '>';
	echo $file_list[$i];
	echo '</a></br>';
}


echo '</td><td>';
for ($i = 32; $i < 40; $i++){
	echo '<a href = ./Corrected-NetCDF/';
	echo $file_list[$i];
	echo '>';
	echo $file_list[$i];
	echo '</a></br>';
}

echo '</td><td>';
for ($i = 40; $i < 48; $i++){
	echo '<a href = ./Corrected-NetCDF/';
	echo $file_list[$i];
	echo '>';
	echo $file_list[$i];
	echo '</a></br>';
}
?> 
  

         </td>
       </tr>
     </table>
   </blockquote>  
   </p>

<h2 align="left"><span class="STYLE6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Will The Forecast Be More Accurate After The Adjustment?</b></span></h2>
  <blockquote>
   <div align="justify"><span class="STYLE5">Yes. 	The forecasts will be more accurate after the adjustment.	
    </p>
     
    Here is how we get the conclusion. 	There are three kinds of offsets that can be potentially adjusted by observation data, Y-shift, X-shift, and amplitude (Figure 1). For the TABS buoys, Y-shift represents net current at a buoy location. X-shift represents the valid time of the forecasts, and the valid time could be faster or slower. The forecast amplitude can be stronger or weaker than the later measurements.
    </p>
     
     <img src="./offset-illustration.jpg" alt="Offset-illustration" width="600"/>
    </p>
     
    <i>Figure 1. The illustration of three kinds of offsets to be calculated from past five days observation and model output.</i>
    </p>
     
     
     
     By looking at the data, there are some obvious biases that could be adjusted. For example, during the three month between October 1, 2011 and January 1, 2012, the standard deviation of model was 2.7 times of observation (Figure 2). This indicated that amplitude of the forecast were 2.7 times larger than the observation. If the amplitude was adjusted, the forecast could be more accurate.	
     
     </p>
     
     
     
     
     
     <img src="./fig-2-2.jpg" alt="distribution-illustration" width="1000"/>
    </p>
     
    <i>Figure 2. Histogram of along shore speed for Buoy J for the three month from October 1, 2011 to January 1, 2012.</i>
    </p>
     
     
     
     
     
    </p>
     
     In order to find whether the adjustments could improve the forecast accuracy, the data between 2011-10-1 and 2012-1-1 were used, and there were 368 model forecasts. Each model forecast before and after adjustments was compared with later observation data. The followings are the steps for the adjustments:</br></p>
     1. Select one buoy at a time.</br>
     2. Get 3 months observation data.</br>
     3. Make the observation series with exactly 30 minute interval.</br>
     4. Use fast Fourier transformation (FFT) to filter the series with 40 hour low pass filter. </br>
     5. Make it exactly hourly interval to match the valid time interval in the model.</br>
     6. Open a model data NetCDF file which contains three month of model data just for the buoy locations.</br>
     7. Make a linear model series with first six hours from each forecast file. </br>
     8. Apply FFT 40 hour low pass filter to the linear model series.</br>
     8. Calculate the skill value of each forecast.</br>
     9. Adjust the X-shift of the forecasts. Cross correlation between the observation and the model was calculated, and the shift was limited within 12 hours.</br>
     10. Adjust the amplitude of the forecasts. Standard deviations were calculated for both observation and model in past five days, and used for amplitude adjustment. </br>
     11. Use past five days to calculate the Y-shift of each forecast. Average currents of past five days were compared between model and the observation.</p>
    </p>
     To assess the accuracy of the forecasts, the Skill values were calculated before and after the adjustments (Hetland 2006, Ocean Modeling vol. 11, pp 214-223). The Skill value is a quantitative evaluation of the accuracy of a forecast or a model originally developed for ocean current. A few days after the forecast was issued, the observation can be compared with previous forecast, and the accuracy of the forecast can be assessed with following formula. </br></p>
     <img src="./formula.jpg" alt="distribution-illustration" width="300"/></p>
     Where oi is the observed current strength;</br>
     mi is the model forecast of current strength, which was made before the observation;</br>
     i    is the specific time point under evaluation;</br>
     N  is the total number of time point under evaluation;</br>
     ci   is the climate value which is the average of the observation in this study.</br></p>
     
     Table 1. The Average Skill Value Before and After the Adjustments:</br>
     
     </span>
   </div>
     <table width="524" border="1">
       <tr>
         <th width="61" scope="col"><span class="STYLE5">&nbsp;Buoys</span></th>
         <th width="64" scope="col"><span class="STYLE5">&nbsp;Before</span></th>
         <th width="63" scope="col"><span class="STYLE5">&nbsp;X-shift</span></th>
         <th width="95" scope="col"><span class="STYLE5">&nbsp;Amplitude</span></th>
         <th width="68" scope="col"><span class="STYLE5">&nbsp;Overall</span></th>
         <th width="67" scope="col"><span class="STYLE5">&nbsp;Y-shift</span></th>
         <th width="60" scope="col"><span class="STYLE5">&nbsp;Affect</span></th>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">B</span></div></th>
         <td><div align="right"><span class="STYLE5">-4.308</span></div></td>
         <td><div align="right"><span class="STYLE5">-4.310</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.434</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.377</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">D</span></div></th>
         <td><div align="right"><span class="STYLE5">-13.612</span></div></td>
         <td><div align="right"><span class="STYLE5">-13.612</span></div></td>
         <td><div align="right"><span class="STYLE5">-12.427</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
         <td><div align="right"><span class="STYLE5">-10.144</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">F</span></div></th>
         <td><div align="right"><span class="STYLE5">-0.002</span></div></td>
         <td><div align="right"><span class="STYLE5">0.072</span></div></td>
         <td><div align="right"><span class="STYLE5">-0.333</span></div></td>
         <td><div align="center"><span class="STYLE5">-</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.858</span></div></td>
         <td><div align="center"><span class="STYLE5">-</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">J</span></div></th>
         <td><div align="right"><span class="STYLE5">-8.200</span></div></td>
         <td><div align="right"><span class="STYLE5">-7.503</span></div></td>
         <td><div align="right"><span class="STYLE5">-3.762</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
         <td><div align="right"><span class="STYLE5">-5.738</span></div></td>
         <td><div align="center"><span class="STYLE5">-</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">K</span></div></th>
         <td><div align="right"><span class="STYLE5">-0.884</span></div></td>
         <td><div align="right"><span class="STYLE5">-0.886</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.063</span></div></td>
         <td><div align="center"><span class="STYLE5">-</span></div></td>
         <td><div align="right"><span class="STYLE5">-0.833</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">N</span></div></th>
         <td><div align="right"><span class="STYLE5">-1.613</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.450</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.512</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.086</span></div></td>
         <td><div align="center"><span class="STYLE5">-</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">R</span></div></th>
         <td><div align="right"><span class="STYLE5">-0.091</span></div></td>
         <td><div align="right"><span class="STYLE5">-0.067</span></div></td>
         <td><div align="right"><span class="STYLE5">-0.077</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
         <td><div align="right"><span class="STYLE5">-1.697</span></div></td>
         <td><div align="center"><span class="STYLE5">-</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">V</span></div></th>
         <td><div align="right"><span class="STYLE5">-50.878</span></div></td>
         <td><div align="right"><span class="STYLE5">-47.591</span></div></td>
         <td><div align="right"><span class="STYLE5">-41.092</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
         <td><div align="right"><span class="STYLE5">-60.077</span></div></td>
         <td><div align="center"><span class="STYLE5">-</span></div></td>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="STYLE5">W</span></div></th>
         <td><div align="right"><span class="STYLE5">-11.847</span></div></td>
         <td><div align="right"><span class="STYLE5">-11.098</span></div></td>
         <td><div align="right"><span class="STYLE5">-2.822</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
         <td><div align="right"><span class="STYLE5">-2.821</span></div></td>
         <td><div align="center"><span class="STYLE5">+</span></div></td>
       </tr>
</table>
  
     <span class="STYLE5">
     </p>
     
     Table 2. Ratio of improved forecast in total corrected:</br>
     </span>
     <table width="400" border="1">
     <tr>
       <td height="20" valign="middle" nowrap="nowrap"><div align="center"><span class="STYLE5"><strong>Buoys</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>X-shift</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>amplitude</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>Y-shift</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>overall</strong></span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>B</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">9/22</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">301/345</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">193/345</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">227/345</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>D</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">0/0</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">19/22</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">17/22</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">18/22</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>F</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">50/78</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">147/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">77/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">76/346</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>J</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">41/48</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">332/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">163/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">229/346</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>K</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">9/24</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">183/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">223/345</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">201/345</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>N</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">39/70</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">190/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">198/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">185/346</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>R</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">36/51</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">190/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">86/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">108/346</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>V</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">19/60</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">157/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">71/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">89/346</span></div></td>
     </tr>
     <tr>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5"><strong>W</strong></span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">17/32</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">292/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">203/346</span></div></td>
       <td height="20" valign="middle"><div align="center"><span class="STYLE5">237/346</span></div></td>
     </tr>
   </table>
   
   
     <div align="justify"><span class="STYLE5">
     </p>
     The skill values improved after adjustments (Table 1 and Table 2). For the three months between October 1, 2011 to January 1, 2012, after X-shift and amplitude correction, the average skill value improved in seven of the nine buoy locations. Surprisingly, Y-shift did not have much improvement in skill values.   </p>
       We plan to make X-shift and amplitude adjustment daily. We will post the correct on the web page, as soon as the model forecast is available.    </p>
       When a bias was noticed at a buoy location, we expect the bias also exist in nearby area. A two-dimensional optimal interpolation was used to estimate the bias extending from the buoy locations. Figure 3 is an example of bias estimation extending from the buoy locations.   </p>
     </p>
     <img src="./surface-3d.jpg" alt="distribution-illustration" width="600"/>
  </br>
  <i>   
    Figure 3. An example of adjustment matrix for the u-east component of forecast file that is valid for 2012-2-26 6:00 to 2012-2-29 6:00. The black rods indicate the TABS buoy locations.  </i>
  </p>
       
       
     When this adjustment matrix applied to the forecast matrix, we expect to improve the skill value of the forecast. The adjusted forecast files in NetCDF are in the above of this web page.
     </p>
     </span></div>
  <blockquote>

</div>
</center>
  <blockquote>
  <blockquote>
</p>

<p class="STYLE5 STYLE7">      
<blockquote>
<span class="STYLE7"></b>
<blockquote>
<blockquote>
</span>
<p> 
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>






















</body>
</html>


















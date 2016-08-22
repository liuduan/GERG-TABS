<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
  <META HTTP-EQUIV ="Expire" CONTENT ="0">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Animation</title>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
.STYLE5 {font-size: 14px; font-family: "Arial", Times, serif; }
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
<body background="./gradient_bgr.png" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">

<p>&nbsp;</p>
<center>
<h2 align="center" class="STYLE3">FORECAST ANIMATIONS  </h2>

<p>&nbsp;</p>
<p align="center">
<form name="form1" action="http://tabs1.gerg.tamu.edu/tglo/testpages/animation/anim_disp-2.php" method="GET" target="_blank">  

<span class="STYLE6"><h2><b>Please Select A Date When The Forecast Was Issued:
<select ID="forecast_date" name="forecast_date">
	<option value="0">Today</option>	
	<option value="-1">Yesterday</option>	
	<option selected value="-2">Two Days Ago</option>
	<option value="-3">Three Days Ago</option>
	<option value="-4">Four Days Ago</option>
</select>

</b></h2></span> 
<p><span class="STYLE6"><h2><b>Please Select The Type Of The Forecast:
<select ID="model" name="model">
	<option value="R">Current Model ROMS</option>
<!--
	<option value="POM_2m_">Current Model POM</option>
-->
	<option value="eta_">Wind</option>
</select>
</b></h2></span> <p>
  

	  	  
<INPUT TYPE=Hidden Name="width"  Value ="">

<INPUT TYPE=Hidden Name="height"  Value ="">



<script type="text/javascript">
function getSelectedValue2(){
	var forecast_date = document.getElementById('forecast_date').value;
	var model = document.getElementById('model').value;
//	var web_page = "http://tabs1.gerg.tamu.edu/tglo/testpages/animation/anim_file.php?model=";
	var web_page = "http://tabs1.gerg.tamu.edu/tglo/testpages/animation/anim_file.php?model=" + model + "&forecast_date=" + forecast_date;
	window.location = web_page
//	alert(web_page);
//	alert("value="+document.getElementById('mySelect').value);
//	document.write.theselected;
}
</script>

<TD><input type="submit" value="Display On A Web Page" OnClick="width_height();" ></TD>

<INPUT TYPE=BUTTON OnClick="getSelectedValue2();" VALUE="Display On Google Earth">
</form>
<br>

<script type="text/javascript"> 

var ScreenW = 720, ScreenH = 700;
ScreenW = screen.availWidth;
ScreenH = screen.availHeight;

function width_height() { 
	document.form1.width.value = ScreenW;
	document.form1.height.value = ScreenH;
	} 
</script> 




















</h3>

<span class="STYLE9">(Google Earth Plug-In or Google Earth is reqired to display the animation.)

    <a href='http://tabs1.gerg.tamu.edu/tglo/testpages/animation/Instruction.html' class="STYLE4" onClick='showPopup(this.href);return(false);'>
<img src="http://tabs1.gerg.tamu.edu/tglo/testpages/animation/instruction_button.png" alt="Instructions_button" width="162" height="24" /></a></span>





<script type="text/javascript"> 
function showPopup(url) {
	newwindow=window.open(url,'name','height=520,width=320,top=0,left=0,resizable');
	if (window.focus) {newwindow.focus()}
}
</script>  





<p>&nbsp;</p>
<p align="center">
<div id="Layer3">
  <blockquote>
   <div align="left"><span class="STYLE5">If you do not have Google Earth or Google Earth Plug-In installed, you may use &quot;Forecast Overlay&quot; to view static overlay. You may also click &quot;Forecast&quot; to see the layouts of the forecast images. Forecast data for ROMS and Wind models are in <a href="http://csanady.tamu.edu/GNOME/gnome2.html" target="_blank"><font color="black">http://csanady.tamu.edu/GNOME/gnome2.html</font></a>.
     </p>
     The current forecasts are using the Princeton Ocean Model (POM) and the Regional Ocean Modeling System (ROMS).  The POM current forecast is issued once a day at 6 am CST predicting the conditions of next 24 hours. The ROMS current forecast is issued four times a day at 0, 6, 12, 18 hours CST predicting the conditions of next three days. For both current forecast models, more information can be found in: Ezer et al. 2002, Developments in terrain-following ocean models: intercomparison of numerical aspects. Ocean Modeling, vol. 4, pp 249-267.
     </p>
   </span></div>
   <p align="justify" class="STYLE5">The wind forecast is made by <a href="http://www.ncep.noaa.gov/" target="_blank"><font color="black">National Center for Environmental Prediction (NCEP)</font></a>, and the plots are made by the TABS team.</p>
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














<p>
<p><p><p><p><p>


<?php
//include ("./anim_images.php");

// $output = shell_exec('/usr/bin/python /home/liuduan/testpages/Python/current_wind.py > /dev/null');
// echo "<pre>$output</pre>";
//include ('../Comparison/file_management.php');
?>

</body>
</html>


















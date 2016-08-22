<!DOCTYPE html>
<html> 
<head> 
  <title>Forecast Animation Loop Auto Start</title> 

<script language="JavaScript1.3" type="text/javascript"></script>

<script src="http://earth-api-utility-library.googlecode.com/svn/trunk/extensions/dist/extensions.pack.js" type="text/javascript">
	</script>

<script type="text/javascript" 
	src="http://www.google.com/jsapi?key=ABQIAAAAO2WokYy3ULpunMQ0pbQHDBSlj4OaKwGAs8YqOoi2oezi7mC6QhS6nVZ22tj35ZurDFeATpa3Krdyuw">
	</script> 

<style type='text/css'> 
body {
	font-family: arial;
	margin: 0px;
	padding: 0px;
	}
#controlbar {
	top: 3px;
}
#title {
	top:10px;
}
#music {
	top:5px;
}
#player {
	top: 5px;
}
#layer {
	left: 10px;
}
#slider {
	top: 10px;
}
#maker {
	top: 5px;
	right: 5px;
}
#map3d_container {
	position: absolute;
	top: 1px;
	left: 204px;
	right: 1px;
}
#map3d {
	height:98%;
	width: 100%;
}

.STYLE3 {
	color: #000066;
	font-size: 18px;
	font-family: Arial, Helvetica, sans-serif;
}

#menu {
	position: relative;
	top:0px;
	left:0px;
	height:240;
	overflow:auto;
}

</style> 


<script> 


var ge = null;
var features = null;
var lookAt;
var latitude;
var longitude;
var heading;
var hh;
var turning_init;
var turning_obj;
var screen_diag;
var range_factor;
var reset_timeslide;
var begin;


// var w_height = <?php echo $_GET["height"];?>;
google.load("earth", "1");


screen_diag = Math.sqrt(Math.pow(window.screen.width, 2) + Math.pow(window.screen.height, 2));
	
	screen_height = window.screen.height;
	screen_width = window.screen.width;


function Show_altitude(){
	ge.getLayerRoot().enableLayerById(ge.LAYER_TERRAIN, true);
	// listen to the click event on the globe and window
    google.earth.addEventListener(ge.getWindow(), 'mousemove', function(event) {
    	var statusHTML = 'N/A';
      	if (event.getDidHitGlobe()) {
        	var latitude = event.getLatitude();
        	var longitude = event.getLongitude();
        
        	var groundAltitude = ge.getGlobe().getGroundAltitude(latitude, longitude);
        		if (groundAltitude) {
          			statusHTML = '<span style="color:#000; font-weight:bold;">' +
              		groundAltitude.toFixed(2) + ' meters</span>';
        			}		// end of if(goundAltitude)
      		}	// end of if (event.getDidHitGlobe()) 
      
		document.getElementById('ground-altitude').innerHTML = statusHTML;})	
		// end of google.earth.addEventListener(ge.getWindow(), 'mousemove', function(event) 
    }	// end of function Show_altitude()


















function fly_to(lat, lon, range, speed, tilt){
	// Create a new LookAt 
	var lookAt = ge.createLookAt('');  
	ge.getOptions().setFlyToSpeed(speed); 
	// Set the position values 
	lookAt.setLatitude(lat); 
	lookAt.setLongitude(lon); 
	lookAt.setRange(range); //default is 0.0  
	lookAt.setTilt(tilt);
	// Update the view in Google Earth 
	ge.getView().setAbstractView(lookAt); 
	} // end of function fly_to()



function Load_kml(){
  var a_link = ge.createLink(""); 
<?php 
//echo '$GET[]<br>';
//print_r($_GET);
echo 'var anim_file="';
echo 'http://tabs1.gerg.tamu.edu/tglo/testpages/animation/anim_file.php?forecast_date=';
echo $_GET[forecast_date]. '&model='. $_GET[model]. '	";';
?>
  a_link.setHref(anim_file);
  var network_link = ge.createNetworkLink("");
  //network_link.setLink(a_link); // without flyto view
  network_link.set(a_link, false, true); // Sets the link, refreshVisibility, and flyToView.
  ge.getFeatures().appendChild(network_link);
  //without flyto view
  //ge.getGlobe().getFeatures().appendChild(network_link);
  //return nl;
}
 
function timeslide(){
   	var extents = ge.getTime().getControl().getExtents();
   	begin = extents.getBegin().get();
	end = extents.getEnd().get();
	// alert("Start time: "+ begin);
	
	var timeStamp = ge.createTimeStamp('');
	timeStamp.getWhen().set(begin);
	ge.getTime().setTimePrimitive(timeStamp);
	ge.getTime().setRate(60*60*24*0.15);
	}	// end of function timeslide()

function pause_time(){
	ge.getTime().setRate(0.0);
	// alert("It should stop now 1.");
	window.clearInterval(reset_timeslide);
	}	// end of function reset_time_begin()

function toggleOptions() {
//	var options = ge.getOptions();
	var root = ge.getLayerRoot();
	var form1 = document.getElementById("options");
  	root.enableLayerById(ge.LAYER_ROADS, form1.roads.checked);
	root.enableLayerById(ge.LAYER_BORDERS, form1.borders.checked);
//  root.enableLayerById(ge.LAYER_BUILDINGS, form.building.checked);
//	ge.getSun().setVisibility(form.sun.checked);

	}	// end of function toggleOptions()

function updateOptions() {
  var options = ge.getOptions();
  var form2 = document.options;
  
  options.setStatusBarVisibility(form2.statusbar.checked);
  options.setGridVisibility(form2.grid.checked);
  options.setOverviewMapVisibility(form2.overview.checked);
  options.setScaleLegendVisibility(form2.scaleLegend.checked);
  options.setAtmosphereVisibility(form2.atmosphere.checked);
  options.setMouseNavigationEnabled(form2.mouseNav.checked);
 
  if (form2.nav.checked) {
    ge.getNavigationControl().setVisibility(ge.VISIBILITY_SHOW);
  	} // partial end of if, else follows
	else {
    ge.getNavigationControl().setVisibility(ge.VISIBILITY_HIDE);
  	}	// end of else.
	

  }		// end of function updateOptions()
 
function updateOptions_2(){		// start or stop turn()
    var turning_chkBox 	 = document.getElementById('turning');
    var time_loop_chkBox = document.getElementById('time_loop');

   	if (turning_chkBox.checked){
		fly_to(27.38, -94.7, 1000000*range_factor, 1, 0);
		setTimeout(function(){
			turning_obj = setInterval("turn()", 50); }, 2000);
		}	// end of if
		else {		
			window.clearInterval(turning_obj);
			window.clearInterval(turning_init);
			fly_to(27.38, -94.7, 475000*range_factor, 0.6, 0);    // best position to look at the study area.
			// alert("It should fly.");
  			}	// end of else.
			
	if (time_loop_chkBox.checked){
		timeslide();
		reset_timeslide = setInterval("timeslide()", 21000); 
		}	// end of if
		else {pause_time(); }	// end of else.
	}	// end of function updateOptions_2()



function popuponclick(){  
   my_window = window.open("http://tabs1.gerg.tamu.edu/tglo/testpages/Hurricane/hurricane-disp.php", "mywindow");  
   setTimeout("closepopup()",60000); 
   }  

function closepopup(){  
   	if(false == my_window.closed){  
   		my_window.close ();  
      	}  
      	else {  
         	alert('Window already closed!');  
      		}  
   }  

function Show_Compass(){		// This function is not needed for now, the compass is shown in KML
	// Create the GroundOverlay
	var CompassOverlay = ge.createGroundOverlay('');

	// Specify the image path and assign it to the GroundOverlay
	var icon = ge.createIcon('');
	icon.setHref("http://tabs1.gerg.tamu.edu/tglo/testpages/animation/Compass.png");
	CompassOverlay.setIcon(icon);

	// Specify the geographic location
	var latLonBox = ge.createLatLonBox('');
	latLonBox.setBox(29.6, 28.6, -96.5, -96.8, 0);
	CompassOverlay.setLatLonBox(latLonBox);

	// Add the GroundOverlay to Earth
	ge.getFeatures().appendChild(CompassOverlay);
	}	// end of function Show_Compass()
		





heading = 0.5;
function turn(){	
   ge.getOptions().setFlyToSpeed(1);
    // heading = heading + .5;
	heading = heading + 0.5;
    if (heading > 360){
    	heading -= 360;}   // end of if
	//alert(heading);
    lookAt.setHeading(heading);
    lookAt.setLatitude(27.38);
    lookAt.setLongitude(-94.7);
	// alert('hh = '+ hh);
	lookAt.setRange(520000*Math.pow(range_factor, 0.47));	
	lookAt.setTilt(50*Math.pow(range_factor, 0.3));  //default is 0.0
    ge.getView().setAbstractView(lookAt);    
   }	// end of function turn()


function refix_w() {
	if (document.body)	{		// for most of the browsers.
		wwidth = Math.max(document.body.clientWidth,document.documentElement.clientWidth); 
		w_height =Math.max(document.body.clientHeight,document.documentElement.clientHeight); 
		} 	// end of if, but the else follows, and it it not end of the else.
		else {			// for some non-standard browsers.
			wwidth = Math.max(screen_diag/3, window.innerWidth);
			w_height = Math.max(screen_diag/3, window.innerHeight);
			alert('non-standard browser.');
			}	// end of if and else
//	document.getElementById("title").style.width=wwidth+"px"; 
	// This determines how big the Google Earth block will be.
	ww = Math.max(screen_diag/3, wwidth-225);		
	hh = Math.max(screen_diag/3, w_height);	
	range_factor = ww/hh;

	//document.getElementById("comments").innerHTML = hh;
	document.getElementById("map3d_container").style.width=ww+"px";
	document.getElementById("map3d_container").style.height=hh+"px";
//	document.getElementById("menu").style.height=hh-370+"px";
	}	// end of function refix_w()



function failureCallback(object) {
  	alert('Failed to initialize Google Earth plugin.');
	} 		// end of function failureCallback(object)
	
	
	

function initCallback(object) {
  	ge = object;
  	ge.getWindow().setVisibility(true);
	
  	Load_kml();
	
	setTimeout(function(){
		reset_timeslide = setInterval("timeslide()", 21000); 
		}, 14000); 
	
	fly_to(0, -90, 90000000.0, 0.16, 0);
	
	//function fly_to(lat, lon, range, speed, tilt){
	setTimeout("fly_to(0, -90, 90000000.0, 0.16, 0)",000); 
	setTimeout("fly_to(0, -90, 90000000.0, 1, 0)",6000); 
	
	setTimeout("fly_to(0, 150, 48000000.0, 0.16, 0)",6000); 
	setTimeout("fly_to(0, 150, 48000000.0, 1, 0)",12000); 
	
	setTimeout("fly_to(0, 30, 30000000.0, 0.14, 0)",13000);
	setTimeout("fly_to(0, 30, 30000000.0, 1, 0)",19000); 
		
	setTimeout("fly_to(0, -90, 16000000.0, 0.16, 0)",20000); 
	setTimeout("fly_to(0, -90, 16000000.0, 1, 0)",29000); 
	

	setTimeout(function () {		// Get to the position befor the turning starts.
	 // fly_to(lat,    lon,  range,                               speed, tilt  						   )
		fly_to(27.38, -94.7, 520000*Math.pow(range_factor, 0.47), 0.2,     50*Math.pow(range_factor, 0.3));
		}, 30000); 
	// setInterval("fly_to(27.38, -94.7, 475000*range_factor, 0.6, 0)", 1000);    // best position to look at the study area.
	// setTimeout("fly_to(27.38, -95, 800000, 0.14, 60)",30000); 
	
	lookAt = ge.createLookAt('');
	setTimeout(
		function () {
			turning_init = setInterval("turn()", 50);}, 
		40000);// 40000
	
	
  	toggleOptions();
	Show_altitude();

  	//reloadOnceOnly()
  	//setTimeout("reloadOnceOnly()",5000); 
	//updateOptions();
	}	// end of function initCallback(object)


function init() {
 	refix_w();
	// popuponclick();
	//Loading_Messages();
 	google.earth.createInstance("map3d", initCallback, failureCallback);
	}	// end of fuction init()



 
 



// alert('run to finish.');

</script> 
 
 
</head> 
<body id="main" onLoad="init()"> 


<table border=1 width="190" >
<tr>
<div id="layer"> 
<td  bgcolor="#E5F6FE"  width="190"> 
	<font class="STYLE3"><b>Options</b></font>
		<font size=2>
		<form id="options" action='javascript:toggleOptions();'> 
			<!--
        	<input type="checkbox" class="chkbox" onclick='toggleOptions();' name="turning" id="turning"> 
				<label for="turning" title="turning">turning</label><br> 
                -->
			<input type="checkbox" class="chkbox" onclick='toggleOptions();' name="roads" id="roads"> 
				<label for="road" title="Road Road">Road</label><br>
			<input type="checkbox" class="chkbox" onclick='toggleOptions();' name="borders" id="borders"> 
            <!--
			<input type="checkbox" class="chkbox" onclick='toggleOptions();' name="borders" id="borders" checked> -->
				<label for="Borders" title="Board-Board">Border</label>
 			</font>
       </form>
	</div> 
		
     <br>
       	<font size=2>
<input type="checkbox" id="turning" onClick="updateOptions_2()" checked />Turning
	<br />
<input type="checkbox" id="time_loop" onClick="updateOptions_2()" checked />Time Loop
	</font>







		
  <div id='options_container'> 
  	<font size=2>
    <form name="options" action='javascript:updateOptions();'>
    

      
      
      
      
      
      
      <input type="checkbox" onclick='updateOptions()' name="nav" />Navigation Control
      <br />
	  <input type="checkbox" onclick='updateOptions()' name="scaleLegend" />Scale Legend
      <br />
      <input type="checkbox" onclick='updateOptions()' name="grid" />Grid
      <br />
      <input type="checkbox" onclick='updateOptions()' name="statusbar" />Status Bar
      <br />
      <input type="checkbox" onclick='updateOptions()' name="overview" />Overview Map
      <br />
      <input type="checkbox" onclick='updateOptions()' name="atmosphere" checked />Atmosphere
      <br />
      <input type="checkbox" onclick='updateOptions()' name="mouseNav" checked />Mouse Navigation
      <br />
	</font>
    </form>
  </div>  


<p>&nbsp;</p>

<!--
<a href='http://tabs1.gerg.tamu.edu/tglo/testpages/animation/Instruction.html' class="STYLE4" onClick='showPopup(this.href);return(false);'>
<img src="http://tabs1.gerg.tamu.edu/tglo/testpages/animation/instruction_button.png" alt="Instructions_button" width="162" height="24" /></a>
<script type="text/javascript"> 
//define a smaller window.
function showPopup(url) {
	newwindow=window.open(url,'name','height=520,width=320,top=0,left=0,resizable');
	if (window.focus) {newwindow.focus()}
}
-->



 
	<font color="#770000" class="STYLE3"><b>Ground Altitude</b></font>
<br>at Mouse: <br>
<span id="ground-altitude" style="color:#ccc;">N/A</span></p>
<div>



<p>&nbsp;</p>
<font color="#770000" class="STYLE3"><b>
<a href="http://tabs1.gerg.tamu.edu/tglo/testpages/Index-frame/Index-frame.php">TABS Home</a></b></font>
</div>


		
		
		
		
		
</td>
</tr>

<tr>
<td  bgcolor="#E5F6FE"  align="center" width="190"> 
		<div id="maker"> 
				</a></div> 
</td></tr></table> 
 
<div id="map3d_container" style='border: 1px solid silver;  margin-left: 0px;'> 

	<div ID="loading_wait">
	</div>

<div id="map3d"></div> 

	<p>&nbsp;</p>
	Known Issues:<br>
	The KML files do not load in a IE. Use Google Chrome.
	<div id="comments"> 
.
	</div> 
</div> 

</body> 
</html>                      

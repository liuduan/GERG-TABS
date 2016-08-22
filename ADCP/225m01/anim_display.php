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
var turn_heading;
var tilt_angle;
var tilt_increment;
var hh;
var screen_diag;
var range_factor;
var reset_timeslide;
var begin;


// var w_height = <?php $test = $_GET["height"];?>;
google.load("earth", "1");


screen_diag = Math.sqrt(Math.pow(window.screen.width, 2) + Math.pow(window.screen.height, 2));
	screen_height = window.screen.height;
	screen_width = window.screen.width;


function Show_altitude(){
	// alert('show altitude');
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














function fly_to(lat, lon, altitude, range, speed, tilt, heading){
	// alert("fly");
	// Create a new LookAt 
	var lookAt = ge.createLookAt('');  
	ge.getOptions().setFlyToSpeed(speed); 
	// Set the position values 
	lookAt.setLatitude(lat); 
	lookAt.setLongitude(lon); 
	lookAt.setRange(range); //default is 0.0  
	lookAt.setTilt(tilt);
	lookAt.setHeading(heading);
	lookAt.setAltitudeMode(ge.ALTITUDE_ABSOLUTE);
	lookAt.setAltitude(altitude);
	// Update the view in Google Earth 
	ge.getView().setAbstractView(lookAt); 
	} // end of function fly_to()



function Load_kml(){
  	var a_link = ge.createLink(""); 
	var anim_file="http://tabs1.gerg.tamu.edu/tglo/testpages/ADCP/225m01/anim_file.php";
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
	
function time_control(){
	var time_loop_chkBox = document.getElementById('time_loop');			
	if (time_loop_chkBox.checked){
		timeslide();
		reset_timeslide = setInterval("timeslide()", 21000); 
		}	// end of if
		else {pause_time(); }	// end of else.
		}

function toggleOptions() {

	var root = ge.getLayerRoot();
	var form1 = document.getElementById("option_group_1");
	var options = ge.getOptions();
  	root.enableLayerById(ge.LAYER_ROADS, form1.roads.checked);
	root.enableLayerById(ge.LAYER_BORDERS, form1.borders.checked);
		
	if (form1.nav.checked) {
		// alert('options.');
    	ge.getNavigationControl().setVisibility(ge.VISIBILITY_SHOW);
  		} // partial end of if, else follows
		else {
    		ge.getNavigationControl().setVisibility(ge.VISIBILITY_HIDE);
  			}	// end of else.
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
  }		// end of function updateOptions()
 


function closepopup(){  
   	if(false == my_window.closed){  
   		my_window.close ();  
      	}  
      	else {  
         	alert('Window already closed!');  
      		}  
   }  


turn_heading = 0.5;
tilt_angle = 65;
tilt_increment = 0.5;
var turning_chkBox;
turning_chkBox = document.getElementById('turn_html');
   	
function turn(){	
	turning_chkBox = document.getElementById('turn_html');
   ge.getOptions().setFlyToSpeed(1);
	turn_heading = turn_heading + 0.5;
    if (turn_heading > 360){
    	turn_heading -= 360;}   // end of if
    lookAt.setHeading(turn_heading);
    lookAt.setLatitude(26.2168);
    lookAt.setLongitude(-96.49883);
	// depth = depth + depth_increment;
    // if (depth > 50){
    //	depth_increment = -0.5;}   // end of if
	// if (depth < -50){
    //	depth_increment = +0.5;}
	// alert("turning 2");  
	lookAt.setAltitude(-50);
	// alert('hh = '+ hh);
	lookAt.setRange(150*Math.pow(range_factor, 0.47));	
	tilt_angle = tilt_angle + tilt_increment;
	lookAt.setTilt(tilt_angle*Math.pow(range_factor, 0.3));  //default is 0.0
    if (tilt_angle >= 90){
    	tilt_increment = -0.5;}   // end of if
	if (tilt_angle <= 0){
    	tilt_increment = +0.5;
		fly_to(26.2168, -96.49883, 10000000, 150*Math.pow(range_factor, 0.47), 0.25, 10, 0);
		setTimeout(function(){
			fly_to(26.2168, -96.49883, 0, 1500000*Math.pow(range_factor, 0.47), 0.25, 0, 0);
			}, 7000); 
		// setTimeout(function(){
			// fly_to(26.2168, -96.49883, 1000000, 150*Math.pow(range_factor, 0.47), 0.25, 50, turn_heading+240);
			// }, 10000); 
		if (turning_chkBox.checked){
			setTimeout("turn()", 15000);}
		} 	// end of if (tilt_angle <= 0)
		else {
    		ge.getView().setAbstractView(lookAt);  
			// setTimeout("turn()", 50);  
			if (turning_chkBox.checked){
		 		setTimeout("turn()", 50); }
			}	// end of else.
   }	// end of function turn()
   
function turn_control(){		// start or stop turn()
	// alert("turn control");
    var turning_chkBox 	 = document.getElementById('turn_html');
   	if (turning_chkBox.checked){
		// fly_to(lat,  lon,  	 altitude, range,      speed, tilt, heading)
		fly_to(26.2168, -96.49883, -50, 200*range_factor, 0.6, 65*Math.pow(range_factor, 0.3), 0);
		// sleep(2000);
		turning_obj = setTimeout("turn()", 5000); 
		}	// end of if
		else {		
			fly_to(26.2168, -96.49883, -50, 200*range_factor, 0.6, 65*Math.pow(range_factor, 0.3), 0);    
			// fly_to(lat,  lon,  	, altitude, range,     speed, tilt, heading)
			setTimeout("fly_to(26.2168, -96.49883, -50, 100*range_factor, 0.6, 75, 0)", 5000);  
  			}	// end of else.
	}	// end of function turn_control()


function window_info() {
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

function initCallback(object) {			// 888888888888888888888888888888888888888888888888888888888888888888888888888888888
  	ge = object;
  	ge.getWindow().setVisibility(true);
	Load_kml();
  	
	setTimeout(function(){
		reset_timeslide = setInterval("timeslide()", 21000); 
		}, 0); 
		
	// fly_to(lat, lon,  , altitude, range,  speed, tilt, heading)
	fly_to(0, -90, 0, 90000000.0, 0.16, 0, 0);
	
	// setTimeout("fly_to(0, 120, 0, 30000000.0, 0.4, 0, 0)", 1500); 
	
	setTimeout("fly_to(0, 150, 0, 30000000.0, 0.6, 0, 0)",1500);
	// setTimeout("fly_to(0, 150, 0, 30000000.0, 1, 0, 0)",10000); 
	
	setTimeout("fly_to(0, 30, 0, 30000000.0, 0.6, 0, 0)",3000); 		// Africa，非洲
	// setTimeout("fly_to(0, 30, 0, 24000000, 1, 0, 0)",13000); 
	
	
	setTimeout("fly_to(0, -94, 0, 10000000.0*range_factor, 0.4, 0, 0)",5000); 	// Full Screen globe
	// setTimeout("fly_to(0, -94, 0, 16000000, 1, 0, 0)",16000); 
	
	
	
	// setTimeout("fly_to(0, -94, 0, 16000000.0, 0.4, 0, 0)",12000); 
	
	
	setTimeout(function(){
		// alert("1");
		fly_to(30.5716, -96.2945, 0, 180*range_factor, .15, 45, 0);		// GERG
		// alert("2");
		}, 10000);
	
	setTimeout("fly_to(26.2168, -96.49883, -50, 200*range_factor, .5, 65*Math.pow(range_factor, 0.3), 0)", 22000); 
		// Buoy N above water.

	// fly_to(lat,    lon,  , altitude, range,                               	speed, 	tilt  				, heading)
	// fly_to(26.216815, -94.0370483, 0, 500*Math.pow(range_factor, 0.47), 0.2, 65*Math.pow(range_factor, 0.3), 180);
	// sleep(10000); 

	
	lookAt = ge.createLookAt('');
	lookAt.setAltitudeMode(ge.ALTITUDE_ABSOLUTE);
	
	setTimeout("turn()", 30000);	// should start at 26 seconds.

  	toggleOptions();
	Show_altitude();
	updateOptions();

	}	// end of function initCallback(object)


function init() {
 	window_info();
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
	<font size=2>ADCP Data at Site N</font><br>
    
	<font class="STYLE3"><b>Options</b></font>
    <br><br>
     <font size=2>
     <form>
		<input type="checkbox" id="turn_html" onClick="turn_control()" checked />Turning
		<br />
		<input type="checkbox" id="time_loop" onClick="time_control()" checked />Time Loop
    </form>
	</font>


	<form id="option_group_1"> 
	<font size=2>

			 <input type="checkbox" class="chkbox" onclick='toggleOptions();' name="nav" id="nav" checked />Navigation Control
      			<br />
      
			<input type="checkbox" class="chkbox" onclick='toggleOptions();' name="roads" id="roads"> 
				<label for="road" title="Road Road">Road</label><br>
                
			<input type="checkbox" class="chkbox" onclick='toggleOptions();' name="borders" id="borders"> 
				<label for="Borders" title="Board-Board">Border</label>
 			</font>
       </form>
	</div> 
		
     <br>







		
  <div id='options_container'> 
  	<font size=2>
    <form name="options" action='javascript:updateOptions();'>

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
	<?php echo "Known Issues:" ?><br>
	The KML files do not load in a IE. Use Google Chrome.
	<div id="comments"> 
.
	</div> 
</div> 

</body> 
</html>                      

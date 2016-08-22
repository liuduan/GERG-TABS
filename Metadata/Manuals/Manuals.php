<html>
<head>
<link rel="stylesheet" href = "../metadata_style.css" type="text/css" />
<style type="text/css">
<!--
body
{
background-image:url('../blue-shadow.png');
background-repeat:repeat-x;
} 

-->
</style>
<title>Manuals</title>
</head>
<body bgcolor="c0c8d6">
<center><h3 class="TITLE-STYLE">Manuals</h3></center>

<h4 class="STYLE4">
<center>


<b>

<DIV id = "tool-bar"> 
 <a href="../../Index-frame/frame.php">TABS Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/deployment.php'> Deployment History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="../Buoy-components/Components.php">List of All Components</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="http://tabs1.gerg.tamu.edu/tglo/testpages/Buoy-log/Deployment/CAS-logout.php">NetID Logout</a></div>

<?php
//print_r($_GET);

echo '<br>';

$Manufacture = $_GET["Manufacture"];
switch ($Manufacture) {

		 
   case "Aanderaa":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Aanderaa/Aanderaa-DCS3820R-datasheet.pdf"> 
		 	Aanderaa Current Meter DCS 3820R Datasheet</a><br><br>';
		 echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Aanderaa/Aanderaa-DCS3900R.pdf"> 
		 	Aanderaa Current Meter DCS 3900R</a><br><br>';
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Aanderaa/Aanderaa-DCS4100R.pdf"> 
		 	Aanderaa Current Meter DCS 4100R</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Aanderaa/Aanderaa-Conductivity-3919.pdf"> 
		 	Aanderaa Conductivity Sensor 3919B</a><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Aanderaa/Aanderaa-Conductivity-3919-datasheet.pdf"> 
		 	Aanderaa Conductivity Sensor 3919B Datasheet</a><br><br>';
         break;
		 
		 
   case "Airmar":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Airmar/PB200UserManual.pdf"> 
		 	Airmar PB200 Manual</a><br><br>';
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Airmar/pb200-datasheet.pdf"> 
		 	Airmar PB200 Datasheet</a><br><br>';
         break;
		 
		 
		 
	case "Crossbow":
         echo '<a href = "./Manuals/Crossbow/Crossbow-IMU400.pdf"> Crossbow IMU400 Inertial Systems</a><br>';
		 echo '<a href = "
		  		http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Crossbow/Crossbow-IMU400CD_Datasheet.pdf"> 
					Crossbow IMU400 Datasheet</a><br>';
         echo '<a href = "./Manuals/Crossbow/Crossbow-IMU440.pdf"> Crossbow IMU440 Inertial Systems</a><br>';
		 echo '<a href = "
		  		http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Crossbow/Crossbow-IMU440_Datasheet.pdf"> 
					Crossbow IMU440 Datasheet</a><br>';
         break;
		 
		 
		 
		 
   case "Garmin":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Garmin/gps16-hvs-manual.pdf"> 
		 	Garmin 16-HVS GPS Receiver Operation Manual</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Garmin/GPS16HVS_TechnicalSpecifications.pdf"> 
		 	Garmin 16-HVS GPS Receiver Technical Specifications</a><br><br>';
         break;
		 
		 
   case "Gill Instruments":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Gill/Gill-Metpak-II.pdf"> 
		 	Gill Instruments, MetPak II, Weather Station, User Manual</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Gill/Gill-WindSonic.pdf"> 
		 	Gill Instruments, Windsonic Anemometer User Manual</a><br><br>';
         break;
		 
   case "Honeywell":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Honeywell/HMR3200,3300_UG.pdf"> 
		 	Honeywell Compass HMR3300 User\'s Guide</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Honeywell/HMR3300_Datasheet.pdf"> 
		 	Honeywell Compass HMR3300 Datasheet</a><br><br>';
         break;
		 
		 case "Iridium":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Iridium/Iridium9603_Brochure.pdf"> 
		 	Iridium 9603 Brochure</a><br><br>';
		         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Iridium/Iridium9603_manual.pdf"> 
		 	Iridium 9603 Brochure</a><br><br>';
         break;
		 
		 
	case "MicroStrain":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/MicroStrain/3DM-GX1-Datasheet.pdf"> 
		 	Datasheet for MicroStrain 3DM-GX1 Orientation Sensor</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/MicroStrain/Microstrain-3DM-GX1-manual.pdf"> 
		 	Manual for MicroStrain 3DM-GX1 Orientation Sensor</a><br><br>';
         break;		 
		 
   case "Qualcomm":
         echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Qualcomm/gsp1620_integrator_manual.pdf"> 		 	Integrator\'s Reference Manual for Qualcomm Globalstar GSP1620 Satellite Data Modem.</a><br><br>';
		 echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Qualcomm/gsp1720_manual.pdf"> 		 	Integrator\'s Reference Manual for Qualcomm Globalstar GSP1720 Satellite Data Modem.</a><br><br>';
		 echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Qualcomm/gsp1720_datasheet-A.pdf"> 		 	Datasheet-A for Qualcomm Globalstar GSP1720 Satellite Data Modem.</a><br><br>';
		 echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Qualcomm/gsp1720_datasheet-B.pdf"> 		 	Datasheet-B for Qualcomm Globalstar GSP1720 Satellite Data Modem.</a><br><br>';
         break;
		 
		 
   case "RM Young":
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/RM-Young/RM-Young-Compass-32500-90P.pdf"> 	
			RM Young Electronic Compass 32500 Instructions.</a><br><br>';
		 echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/RM-Young/RM-Young-anemometer-5106.pdf"> 		
		 	RM Young Wind Monitor 5106 Instruction Manual.</a><br><br>';
         break;
		 
		 
   case "Rotronic":
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Rotronic/Rotronic-MP101A-C4-ds.pdf"> 	
			Rotronic Humidity-Temperature Probe, MP101A-C4 Datasheet.</a><br><br>';
		 echo '<a href = "http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Rotronic/Rotronic-MP101A-C4-im.pdf"> 		
		 	Rotronic Humidity-Temperature Probe, MP101A-C4 Instruction Manual.</a><br><br>';
         break;
		 
		 
   case "Sea-Bird":
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Sea-Bird/SBE-MicroCAT-37SI-manual-v22.pdf"> 	
			Manual v22 for Sea-Bird MicroCAT 37SI Conductivity and Temperature Recorder.</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Sea-Bird/SBE-MicroCAT-37SI_manual-v28.pdf"> 	
			Manual v28 for Sea-Bird MicroCAT 37SI Conductivity and Temperature Recorder.</a><br>
			(Fireware v3.0j or later, SeatermV2 Version 1.1a and later) <br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Sea-Bird/SBE-MicroCAT-37SI_manual-v29.pdf"> 	
			Manual v29 for Sea-Bird MicroCAT 37SI Conductivity and Temperature Recorder.</a><br><br>';			
         break; 
		 
		 
   case "Seimac":
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Seimac/Seimac-WildCAT-manual.pdf"> 	
			User\'s Manual for Seimac WildCAT ARGOS Platform Transmitter Terminal (PTT).</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Seimac/Seimac_WildCAT_Datasheet.pdf"> 	
			Seimac WildCAT Datasheet.</a><br><br>';
         echo 'Manual for Seimac SmartCAT is not available.<br><br>';			
         break; 
		 
		 
   case "Vaisala":
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Vaisala/Vaisala-PTB210-Datasheet.pdf"> 	
			Vaisala PTB210 Barometer Datasheet.</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Vaisala/Vaisala-PTB210_(serial)_User_Guide.pdf"> 	
			User\'s Guide for Vaisala PTB210 Series Digital Barometers with Serial Output.</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Vaisala/Vaisala-PTB210_(analog)_User_Guide.pdf"> 	
			User\'s Guide for Vaisala PTB210 Series Digital Barometers with Analog Output.</a><br><br>';	
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Vaisala/Vaisala-WXT520-datasheet.pdf"> 	
			Vaisala WXT520 Weather Transmitter Technical Data.</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Vaisala/Vaisala-WXT520_User_Guide.pdf"> 	
			User\'s Guide for Vaisala WXT520 Weather Transmitter.</a><br><br>';
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Vaisala/Vaisala-WXT520-update.pdf"> 	
			Vaisala WXT520 Weather Transmitter Specification Update.</a><br><br>';	
         break; 
		 
		 
		 
   case "Teledyne RDI":
         echo '<a href = 
		 	"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Teledyne-RD/workhorse_monitor_ds_lr.pdf"> 	
			Teledyne RD Instruments, Workhorse Monitor Datasheet.</a><br><br>';	
			
         echo '<a href = 		"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Teledyne-RD/WorkHorse-Technical-Manual.pdf"> 	
			Teledyne RD Instruments, Workhorse Technical Manual.</a><br><br>';	
         echo '<a href = 		"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Teledyne-RD/WorkHorse-Users-Guide.pdf"> 	
			Teledyne RD Instruments, Workhorse Users Guide.</a><br><br>';	
         echo '<a href = 		"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Teledyne-RD/quartermaster_ds.pdf"> 	
			Teledyne RD Instruments, Workhorse Quartermaster Datasheet.</a><br><br>';	

         echo '<a href = 		"http://tabs1.gerg.tamu.edu/tglo/testpages/Metadata/Manuals/Manuals/Teledyne-RD/LR_QM-Manual.pdf"> 	
			Teledyne RD Instruments, Workhorse Quartermaster Operation Manual.</a><br><br>';			
			
			
         break; 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
   default:
         echo "Sorry, no munual available.";
}
?>
</html>

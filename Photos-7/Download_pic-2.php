<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Down Load Pictures</title>
	<style type="text/css">
	body {
	margin:0 auto; 
	padding: 0; 

	/* background-image:url('./bg.gif'); 
	background-repeat:repeat-x;
	background-color: #e6e6e6; */
	/*background-image: url(../Index-frame/tile.gif);  *//*changes the color of the striped background*/
  	/*background-repeat: repeat;*/
	background-color: #000000; 
	color:#0099FF;
	font-size:25px;
	font-family:Arial, Helvetica, sans-serif; 
	} 
/*
a:link    {color:green;}
a:visited {color:green;}
a:hover   {color:red;}
a:active  {color:yellow;} 

img:link    {color:green;}
img:visited {color:green;}
img:hover   {color:red;}
img:active  {color:yellow;} 	

*/


	div#outer-frame {
	position:absolute;
	top: 30px;
	left: 110px;
	width: 1050px;
	height: 2450px;
	background-color: #162442;
	}

	div#inner-frame {
	position:absolute;
	top: 50px;	
	left: 82px;
	width: 888px;
	height: 2350px;
	background-color: #162442;
	z-index:3;
	}

			
	div#title {
	position: relative; 
	top: 10px;
	margin: auto; 
	text-align: center;
	}
	
div#thumb_nail {
	margin:4px;  /*between div*/
	border:2px solid white; /* border and the width, height make the image center */
	padding:0px; 
	outline-width: 0;
	
	position: relative; 
	float:left;
	left: 0px;
	width: 136px;
	height: 83px;
	text-align: center;	
	/*background-color: #4085c6;*/
	background-color: white;
	}

	
	div#pic {
	position: relative;
	top:8px;
	/*background-color: #000000;*/
	}
		div#bottom {
	position: absolute;
	top:2500px;
	width: 1088px;
		height: 3px;
	background-color: #000000;
	}
	</style>
</head>

<body link="white" vlink="white" alink="white"> 

&nbsp;<br />
<div id="outer-frame">

	<div id="title">
		Download TABS Operation Pictures
		
	</div> <!-- end of the div "title" -->
<div id="inner-frame">
<?php
// This PHP script is to generate links for the photos.

function Photo_links($file_name){
	
	echo '<div id="thumb_nail">';
	echo '<a href="./Original-Photos/'. $file_name. '">';
	echo '<img src= ./Slide-Show-Pic/tn_'. $file_name. ' height="80" width="130" target="_blank">';
	echo '</a></div>';

}  //end of the Photo_links($file_name){




$current_dir = './Original-Photos';      
$dir = opendir($current_dir);        // Open the sucker  
$files = array(); 
while ($files[] = readdir($dir)); 
sort($files); 
closedir($dir);

$file_count = count($files);  

//print_r($files);

for ($i = 3; $i <= 148; $i++){	// should 148

	Photo_links($files[$i]);

	}

?>
	</div> <!-- end of the div "innner frame" -->
	&nbsp;<br />
	</div> <!-- end of the div "ourer frame" -->
&nbsp;<br />
<div id="bottom">
&nbsp;<br />
</div><!-- end of the div "bottom" -->
</body>

</html>
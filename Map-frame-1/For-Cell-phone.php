<!DOCTYPE html>
<html>
<head>
<title>Texas Automated Buoy System</title>
</head>
<body>

<?php

include("./Map-frame-1.php")

?>


<style>
.beauty {
    width: 100px;
    height: 20px;
    position: absolute;
	right: 10px;
	bottom: 68px;
    background: purple;
    z-index: 0;
    color: white;

    text-align: center;
	}

a:visited {color:yellow;}
.beauty:hover 
	{
	cursor: pointer;
	}
</style>


<script src="../Index-frame/Cell-phone/Draggable-part-A.js"></script>
<script src="../Index-frame/Cell-phone/Draggable-part-B.js"></script>

<div class="beauty">

<a href = "http://tabs2.gerg.tamu.edu/tglo/testpages/Index-frame/Cell-phone/Cell-phone-links.php">Data links

</div>

<script>
var __links = document.querySelectorAll('a');
function __linkClick(e) 
	{ parent.window.postMessage(this.href, '*');
	} ;

for (var i = 0, l = __links.length; i < l; i++) {
	if ( __links[i].getAttribute('data-t') == '_blank' ) 
		{ __links[i].addEventListener('click', __linkClick, false);}
	}
</script>

<script> 
$(function() {
	$( ".beauty2" ).draggable();
	});         //@ sourceURL=pen.js
</script>

</body>
</html>
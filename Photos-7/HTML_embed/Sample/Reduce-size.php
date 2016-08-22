
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Source-Thumb-Nai-Maker</title>

</head>

<body>

<?php

function Reduce_size($file_name){
	
	// Read image
	$image = imagecreatefromjpeg('./Big-pic/'. $file_name);

	// Output
	imagejpeg($image, './Slide-Show-Pic/'. $file_name, 90);
	//bool imagejpeg ( $image [, string $filename [, int $quality ]] )
	
	// Free up memory
	imagedestroy($image);
	
}  //end of the function Reduce_size($file_name)

$current_dir = './Big-pic';      
$dir = opendir($current_dir);        // Open the sucker  
$files = array(); 
while ($files[] = readdir($dir)); 
sort($files); 
closedir($dir);

$file_count = count($files);  

//print_r($files);

for ($i = 3; $i <= $file_count; $i++){	// should 149
	
	if( filesize ('./Big-pic/'. $files[$i])> 1000000){ 
		echo '$file_name: '. $files[$i]. ': '. filesize ('./Big-pic/'. $files[$i]). '<br />';
		Reduce_size($files[$i]);
		echo '$file_name: '. $files[$i]. ': '. filesize ('./Slide-Show-Pic/'. $files[$i]). '<br />';
		}
	else {copy ('./Big-pic/'. $files[$i], './Slide-Show-Pic/'.  $files[$i]);}

	}


// echo '$files[1] '. $files[1]. '<br/>';
// echo '$files[5] '. $files[5]. '<br/>';
echo 'There are '. $file_count. ' files.'.' <br/>';





?>

</body>
</html>

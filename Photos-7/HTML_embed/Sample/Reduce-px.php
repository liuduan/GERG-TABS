
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Source-Thumb-Nai-Maker</title>

</head>

<body>

<?php

function Reduce_size($file_name){

	// Get new dimensions
	list($width, $height) = getimagesize('./TABS_Website_Photos/'. $file_name);
	if ($width >1600 || $height > 1600){
		if ($width > $height){
			$new_width = 1600;
			$new_height = $height*1600/$width;}
		else {
			$new_height = 1600;
			$new_width = $width*1600/$height;}		
		
		echo $file_name. ': width: '. $width, ', height: '. $height, ', info3: '. $info3, ', info4: '. $info4, ', info5: '. $info5. '<br />';

		// Resample
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$image = imagecreatefromjpeg('./TABS_Website_Photos/'. $file_name);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//imagecopyresampled ( $dst_image , $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )

		// Output
		imagejpeg($image_p, './Reduced/'. $file_name, 100);
		//bool imagejpeg ( $image [, string $filename [, int $quality ]] )
	
		// Free up memory
		imagedestroy($image_p);
		imagedestroy($image);
	}  // end of the size determin if
	else {             // small files, just copy
		copy ('./TABS_Website_Photos/'. $file_name, './Reduced/'. $file_name);
		}
	
	
}  //end of the function Thumb_nail($file_name){




$current_dir = './TABS_Website_Photos';      
$dir = opendir($current_dir);        // Open the sucker  
$files = array(); 
while ($files[] = readdir($dir)); 
sort($files); 
closedir($dir);

$file_count = count($files);  

//print_r($files);

for ($i = 100; $i <= 149; $i++){	// should 149

	Reduce_size($files[$i]);

	}


// echo '$files[1] '. $files[1]. '<br/>';
// echo '$files[5] '. $files[5]. '<br/>';
echo 'There are '. $file_count. ' files.'.' <br/>';





?>

</body>
</html>

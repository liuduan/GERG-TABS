<?php
$file_handle = fopen("./source-php.xml", "w");

 
$fc = '<?xml version="1.0" encoding="utf-8"?>'. "\n";

$fc = $fc. '<SlideshowBox>'. "\n".
	'	<items>'. "\n";


fwrite($file_handle, $fc);

$current_dir = '../../../Sample/TABS_Website_Photos';      
$dir = opendir($current_dir);        // Open the sucker  
$files = array(); 
while ($files[] = readdir($dir)); 
sort($files); 
closedir($dir);

$file_count = count($files);  


$i=0; 
// make source.xml
for ($i = 3; $i <= 147; $i++){
	$fc = '		<item>
			<thumbnailPath>../../../Sample/TABS_Website_Photos/tn_'. $files[$i]. '</thumbnailPath>'. "\n";
	$fc = $fc. '			<largeImagePath>../../../Sample/TABS_Website_Photos/'. $files[$i]. '</largeImagePath>'. "\n";
	$fc = $fc. '			<fullScreenImagePath>../../../Sample/TABS_Website_Photos/'. $files[$i]. '</fullScreenImagePath>'. "\n";
	$fc = $fc. '			<title><![CDATA[TABS Operation: '. $files[$i]. ']]></title>
			<description><![CDATA[]]></description>
		</item>'. "\n";
	fwrite($file_handle, $fc);
	}
	$fc = '	</items>
</SlideshowBox>';
fwrite($file_handle, $fc);


fclose($file_handle);

?>

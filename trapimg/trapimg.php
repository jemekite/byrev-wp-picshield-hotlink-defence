<?php
#file_put_contents('trap-info.txt', print_r($_SERVER, true).'-----------------------------------------------------------------'."\n", FILE_APPEND);

$var_test = array('HTTP_REFERER','HTTP_USER_AGENT','REMOTE_ADDR','REMOTE_HOST','REQUEST_TIME');
$__TEXT = array();
foreach ($var_test as $v) :
	$s = (isset($_SERVER[$v])) ? $_SERVER[$v] : "?";
	$__TEXT[] = $v.' = '.$s;
endforeach;

$width = 800;
$height = 150;
$margin = 20;
$padding = $margin+10;
$im = imagecreatetruecolor($width, $height);
$blue = imagecolorallocate($im, 127, 127, 255);
imagefilledrectangle($im, $margin, $margin, $width-$margin, $height-$margin, $blue );

$w = imagecolorallocate($im, 255, 255, 255);
$y = $padding;
foreach ($__TEXT as $_TXT) :
	imagestring($im, 2, $padding, $y,  $_TXT, $w);
	$y += 20;
endforeach;

header("Content-type: image/png"); 
imagepng($im);
imagedestroy($im);
?>
<?php
/*
NOTE: If you use this code or part of this code in your program/scripts, 
I would be glad if you publish that using this script "ByRev-WP-PICShield" and the author's name: Emilian Robert Vicol.
It is not an absolute obligation but prove you respect the work of others!
*/
define('_GTFO_KEY','{gtfo_key}');

if (!array_key_exists('key', $_GET) OR ($_GET['key'] != _GTFO_KEY) ){
	header('HTTP/1.0 401 Unauthorized');
	echo 'Unauthorized!';
	die(401);
}

define('_WATERMARK_ENABLED', {watermark_enabled});
define('_REDIRECT_DIRECT_LINK_IMAGES_FROM_GOOGLE', {redirect_direct_link_images_from_google});
define('_HOTLINK_CACHE_FOLDER', '{hotlink_cache_folder}');
define('_IMAGE_SOURCE_TRANSPARENCY', {image_source_transparency});
define('_BLEND_BAR_WATERMARK', {blend_bar_watermark});
define('_BLEND_BAR_OPACITY', {blend_bar_opacity});
define('_WRITE_HOST_SOURCE', {write_host_source});
define('_WATERMARK_POSITION', {watermark_position});
define('_WRITE_CREDIT_PLUGIN', {write_credit_plugin});
define('_MAXIMUM_MEGAPIXELS_SIZE', {maximum_megapixels_size});
define('_WATERMARK_PNG_FILE', '{watermark_png_file}');
define('_SEND_HOTLINK_GTFO_HEADER_SIGNATURE', {send_hotlink_gtfo_header_signature});
define('_WRITE_TIME_CACHED_OVER_IMAGE', {write_time_cached_over_image});
define('_PRINT_QR_HOST', {print_qr_host});
define('_LOG_REFERER_AND_TARGET_IMG', {log_referer_enabled});
define('_LOG_REFERER_TABLE', '{log_referer_table}');
define('_WATER_MARK_PASS_THROUGH', {watermark_pass_through});
define('_WATER_MARK_REDIRECT_302_MODE', {watermark_redirect_302});
define('_WP_PICSHIELD_VERSION', '{wp-picshield-version}');
define('_WP_PICSHIELD_FORCE_WATERMARK', isset($_GET['fw']));
define('_WP_PICSHIELD_FORCE_DEBUG', isset($_GET['fd']));

$image = strip_tags( $_GET['src'] );

if (_SEND_HOTLINK_GTFO_HEADER_SIGNATURE) {
	header('X-Protect: ByREV WP-PICShield , HOTLINK Defence');
}

#~~~~ headers = watermarked file NOT cache
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 

function _mydb_open($filename, $row_size) {
	return array('handle'=>fopen($filename, "r+"), 'length_row'=>$row_size, 'filename'=>$filename);
}

function _mydb_close($db) {
	return fclose($db['handle']);
}

function _mydb_write_row($db, $data) {
	fseek($db['handle'], 0, SEEK_END);
	fwrite($db['handle'], $data, $db['length_row']);
}

function log_referer_and_target_img($redirect=false) {
/*
	Note: This facility is not yet officially launched, so you do not have access to save and view the logs for now, 
	because still working on the script.
	TOS ~ 30 days. (publication of the first version: 15 ... 30 March)
*/
}

#~~~~  REDIRECT DIRECT LINK IMAGES with GOOGLE IMAGES REFERRER 
global $request_trap;
$request_trap = array();

$request_trap[] = array( 'HTTP_ACCEPT'=> array('#^image#i', true) );
$request_trap[] = array( 'HTTP_REFERER'=> array('#google.(.*)/blank.html#i', true) );

function is_image_loading() {
if (!array_key_exists('HTTP_REFERER', $_SERVER)) return true;
global $request_trap;
	foreach ($request_trap as $patterns):
		$n_matches = 0;
		foreach ($patterns as $key=>$pattern_info) :						
			if (isset($_SERVER[$key])) :
				$subject = $_SERVER[$key];
				$result = preg_match($pattern_info[0], $subject, $matches);
				$result = (!$pattern_info[1]) ? !$result : $result;
				if ($result) $n_matches++;
			endif;
		endforeach;			
		if ($n_matches == count($patterns)) return true;
	endforeach;
return false;
}

function is_image_click() {
	return !is_image_loading();
}

if (_REDIRECT_DIRECT_LINK_IMAGES_FROM_GOOGLE AND !_WP_PICSHIELD_FORCE_WATERMARK) :
	if (is_image_click()) {	
		//log_referer_and_target_img(true);
		require_once('byrev-wp-image2url.php');
		#~~~ script end here; redirection!
	}
endif;

#~~~ log referer after redirect; so, no conversion;
if (_LOG_REFERER_AND_TARGET_IMG) {
	//log_referer_and_target_img(false);
}

#~~~~ if watermak is disabled
function img_get_mime_type($file)
{
	$mime_types = array( "gif"=>"image/gif", "png"=>"image/png", "jpeg"=>"image/jpg", "jpg"=>"image/jpg", );
	$file_exp = explode('.',$file);
	$extension = strtolower(end($file_exp));
	
	if (array_key_exists($extension, $mime_types)) {
		return $mime_types[$extension];
	}	
	return "application/force-download";
}

if (!_WATERMARK_ENABLED) {
	$mime = img_get_mime_type($image);
	header('Content-type: '.$mime);
	fpassthru(fopen($image, 'rb'));
	exit();
}

#~~~~ ~~~~ ~~~~

$dir = dirname(__FILE__);
$watermarked = $dir.'/'._HOTLINK_CACHE_FOLDER.'/'.$image;

#~~ create WATERMARK cache folders if not exists;
$watermark_folder = dirname($watermarked);
if(!is_dir($watermark_folder)) {
	mkdir($watermark_folder, 0777, true);
}

function byrev_image_type_to_extension($imagetype) {
   if(empty($imagetype)) return false;
   switch($imagetype) {
	   case IMAGETYPE_GIF    : return 'gif';
	   case IMAGETYPE_JPEG    : return 'jpeg';
	   case IMAGETYPE_PNG    : return 'png';
	   case IMAGETYPE_XBM    : return 'xbm';
	   case IMAGETYPE_WBMP    : return 'wbmp';
	   default                : return false;
   }
}

function get_qr_data($dest_img_x, $dest_img_y, $text) {
	#~~~ calculate and set maxim qr size;
	//$sizex = $dest_img_x >> 3;
	$sizex = round($dest_img_x / 6);
	if ( ($sizex*$sizex) > 300000) { $sizex = 500; }
	
    $size          = $sizex.'x'.$sizex;
    $ret['qr-url'] = $rootUrl = "http://chart.googleapis.com/chart?cht=qr&chs=$size&chl=$text&choe=UTF-8&chld=H|1";
	
	$ret['x-merge'] = ($dest_img_x - $sizex) - 10;
	$ret['y-merge'] = ($dest_img_y - $sizex) - 10;
	$ret['size-xy'] = $sizex;
	
	return $ret;
}

#~~ if file exist, is serverd from disk, else is generated only once;
if(file_exists($image)&& !file_exists($watermarked)){
	#~~~ image type	
	$image_size = getimagesize($image);	

	$image_mime = $image_size['mime'];
	
	$image_type = $image_size[2];
	$image_extension = byrev_image_type_to_extension($image_type);
	
	#~~~ invalid file-type; "print" file and exit!
	if ($image_extension === FALSE) {
		$mime = img_get_mime_type($image);
		header('Content-type: '.$mime);
		fpassthru(fopen($image, 'rb'));
		exit();
	}
	
	#~~~ ok, valid file, continue ..	
	$imagecreatefrom = 'imagecreatefrom'.$image_extension;
	if (!function_exists($imagecreatefrom)) {
		header("Content-type: {$image_mime}"); 
		fpassthru(fopen($image, 'rb'));
		exit;
	}	
		
	
	$sizex = $image_size[0];
	$sizey = $image_size[1];	
	
	#~~ file si to big, may not be enough memory ... / exit
	$max_size = _MAXIMUM_MEGAPIXELS_SIZE * 1048576;
	if (($sizex*$sizey) > $max_size) {
		header("Content-type: {$image_mime}"); 
		fpassthru(fopen($image, 'rb'));
		exit;
	}
		
	$_font_size = ($sizex < 480) ? 2 : (($sizex < 640)? 3 : 5);

	//~~~ create images;
	$photo = $imagecreatefrom($image); 
	
	$sizex = imagesx($photo); 
	$sizey = imagesy($photo); 	
	
	$watermark = imagecreatefrompng(_WATERMARK_PNG_FILE);
	imagealphablending($photo, true);
	
	$w = imagesx($watermark); 
	$h = imagesy($watermark); 

	$percent = $sizex / (($w>$h)?$w:$h); 
	$nw = floor($w*$percent); 
	$nh = floor($h*$percent); 

	switch (_WATERMARK_POSITION) {
		case 0: $_watermark_ypos = 10; break;
		case 1: $_watermark_ypos = round( ($sizey/2) - ($nh/2) ) ; break;
		case 2: $_watermark_ypos = $sizey - $nh - 40; break;
	}	
	
	#~~~ set original image source opacity
	$opacity_img = imagecreatetruecolor($sizex, $sizey); 
	imagecopymerge($photo, $opacity_img, 0, 0, 0, 0, $sizex, $sizey, _IMAGE_SOURCE_TRANSPARENCY);

	#~~~ set higher opacity band
	if (_BLEND_BAR_WATERMARK) :
		$opacity_img = imagecreatetruecolor($nw, $nh);
		imagecopymerge($photo, $opacity_img, 0, $_watermark_ypos, 0, 0, $nw, $nh, _BLEND_BAR_OPACITY);	
	endif;
	imagedestroy($opacity_img);

	#~~~ resize watermak with great deal of clarity
	$image_p = imagecreatetruecolor($nw, $nh);
	ImageAlphaBlending($image_p,false); 
	ImageSaveAlpha($image_p,true); 
	imagecopyresampled($image_p, $watermark, 0, 0, 0, 0, $nw, $nh, $w, $h);
	imagedestroy($watermark);
		
	#~~~ put watermak over image source
	imagecopy($photo, $image_p, 0, $_watermark_ypos, 0, 0, $nw, $nh);
	imagedestroy($image_p);

	#~~~ write credit over hotlinked image
	if (_WRITE_CREDIT_PLUGIN):
		$textcolor = imagecolorallocate($photo, 128, 128, 128);
		imagestring($photo, $_font_size, 5, $sizey-17, 'Protected by: ByREV WP-PICShield - HOTLINK Defence', $textcolor);	
		$pos_x_host_source = 35;
	else:
		$pos_x_host_source = 20;
	endif;
	
	$_site_url = 'http://'. $_SERVER['SERVER_NAME'];
	
	#~~~ write image source		
	$_strimg = "";
	if (_WRITE_HOST_SOURCE):
		$_strimg .= $_site_url;
	endif;
	
	if (_WRITE_TIME_CACHED_OVER_IMAGE):
		$_strimg .= ' - '.date("M.j.Y/g:i a");
	endif;
	
	if ($_strimg != ""):
		$textcolor = imagecolorallocate($photo, 192, 192, 192);
		imagestring($photo, $_font_size, 5, $sizey - $pos_x_host_source, $_strimg, $textcolor);
	endif; 	
	
	#~~~ print qr code
	if (_PRINT_QR_HOST) :
		$qr_info = get_qr_data($sizex, $sizey, $_site_url);
		
		$src = imagecreatefrompng($qr_info['qr-url']);
		imagealphablending($src, true); 
		
		imagecopymerge($photo, $src, $qr_info['x-merge'], $qr_info['y-merge'], 0, 0, $qr_info['size-xy'], $qr_info['size-xy'], 30);
		imagedestroy($src);			
	endif;
	
	#~~~~ for spy result in serach engines !!!
	if (_WP_PICSHIELD_FORCE_DEBUG) :
		$padding = 110;
		$y = $padding;
		$w = imagecolorallocate($photo, 255, 255, 255);
		$y = $padding;
		foreach ($_SERVER as $key=>$_TXT) :
			if (is_array($_TXT)) $_TXT = serialize($_TXT);
			imagestring($photo, 2, 10, $y,  $key.': '.$_TXT, $w);
			$y += 14;
		endforeach;
	endif;
	#~~~~	

	// Output to the browser 
	imagejpeg($photo, $watermarked, 75);
	imagedestroy($photo);
} 

if (_WATER_MARK_PASS_THROUGH):
	header('Content-type: image/jpeg');
	fpassthru(fopen($watermarked, 'rb'));
else:
	$new_url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/'._HOTLINK_CACHE_FOLDER.$_SERVER['REQUEST_URI'];
	if (_WATER_MARK_REDIRECT_302_MODE) {
		header("HTTP/1.1 302 Found");
		$response = "";
	} else {
		header("HTTP/1.1 307 Temporary Redirect");
		$response = 'This object may be found <a href="'.$new_url.'">here</a>';
	}
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
	header("Location: ". $new_url);
	if ($response !="") echo $response;
endif;
?>
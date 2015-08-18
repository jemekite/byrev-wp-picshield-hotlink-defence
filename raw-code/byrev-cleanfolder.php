<?php
/* = */ die('GTFO'); /* = */
define('_GTFO_KEY','{gtfo_key}');
define('_HOTLINK_CACHE_FOLDER', '{hotlink_cache_folder_full_path}');

#=============================================================================
$adv = '<b>Clean Folder</b> <a target="_blank" href="http://wp-picshield.com/">ByREV</a> PHP Script  ...  <i><a target="_blank" href="http://publicphoto.org/">Public Domain Photos</a>  |  <a target="_blank" href="http://mihella.me/">My Mihella</a></i>';
if ( (!isset($_REQUEST['key'])) OR ($_REQUEST['key'] != _GTFO_KEY) ) { ?>
	<html>
	<head>
	<title>Clean Folder - ByREV Script</title>
	</head>
	<body>
	<form method="POST" action="">
	<div style="margin: 20 auto; width: 500px; border: 3px solid #dfd; padding: 5px; text-align: center;">
	PASSWORD/KEY: <br /><input type="text" name="key" size="35" value="" id="key"><br>
	<div style="margin: 5px; border-top: 1px dotted #ccc; height: 4px;"> </div>
	<input type="submit" value="Remove Folder Content" name="start">
	<hr>
	<i><b style="background: red; color: yellow;">~~~ GTFO KEY ERROR ~~~</b></i>
	<div style="margin: 5px; border-top: 1px dotted #ccc; height: 4px;"> </div>
	<?php echo $adv;?>
	</div>
	</form>
	</body>
	</html>
<?php die(); }

if (!is_dir(_HOTLINK_CACHE_FOLDER)) {
	echo '<center>[ No Cahe Folder! ]<center>';
	die();
}

$max_execution_time = ini_get("max_execution_time");

$file = str_replace("/","\\",__FILE__); 
$file = str_replace("\\","/",$file);
define('_THIS_FILE', $file);
define('_MAX_TIME',$max_execution_time-3);
define('_START_TIME', microtime(true));

$ndir=0; $nfile=0;

$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$part_url = explode('?',$url);
$url=$part_url[0];

define('_THIS_URL',$url);

$endscript = false;

function rmdir_rec($dir) {
global $ndir, $nfile, $endscript;
		if ($endscript) return;
		
        $files = scandir($dir);
        array_shift($files);    // remove '.' from array
        array_shift($files);    // remove '..' from array
       
        foreach ($files as $file) {
            $file = $dir . '/' . $file;
            if (is_dir($file)) {
                rmdir_rec($file);
	                if ($endscript) return;
                @rmdir($file);
				$ndir++;
				
				if ( (microtime(true) - _START_TIME) > _MAX_TIME) { $endscript = true; return;	}
            } else {
            	if ($file != _THIS_FILE) unlink($file);
            	$file = str_replace("/","\\",$file); $file = str_replace("\\","/",$file);
            	$nfile++;
            	
            	if ( (microtime(true) - _START_TIME) > _MAX_TIME) { $endscript = true; return;	}
            }
        }
        //rmdir($dir); #--- not self 
}

rmdir_rec(_HOTLINK_CACHE_FOLDER);
$time_end = round(microtime(true) - _START_TIME, 3);

	if (isset($_REQUEST['r'])) {
		$req_reload = $_REQUEST['reload'] + 1;
		$req_dirs = $_REQUEST['dirs'] + $ndir;
		$req_files = $_REQUEST['files'] + $nfile;		
	} else {
		$req_reload = 1;
		$req_dirs = $ndir;
		$req_files = $nfile;				
	}

$elapsed_time = (($req_reload-1)*$max_execution_time) + $time_end + $req_reload;

if ($endscript) : 
	$query = '?r=true&reload='.$req_reload.'&dirs='.$req_dirs.'&files='.$req_files.'&key='.PASSKEY; 
	$url .= $query; 	
?>

<html><head><title>Clean Folder - ByREV Script</title>
<meta http-equiv="refresh" content="1;url=<?php echo $url;?>">
</head><body>
<br />
<div style="margin: 20 auto; width: 480px; border: 3px solid #dfd; padding: 5px; text-align: center;">
Maximum execution time [ <b><?php echo $max_execution_time;?></b> sec. ] has expired, the script will automatically reload.<hr>
<b><?php echo $req_reload;?></b> RELOADED, <b><?php echo $req_dirs;?></b> FOLDERS and <b><?php echo $req_files;?></b> FILES
<hr>
<?php echo $adv;?>
</div>
</body></html>

<?php else: ?>

<html><head><title>Clean Folder - ByREV Script</title></head><body>
<div style="margin: 20 auto; width: 640px; border: 3px solid #dfd; padding: 5px; text-align: center;">
DONE! <br /><b><?php echo $cache_dir;?></b> <br />Removed!<br /><b><?php echo $req_dirs;?></b> FOLDERS and <b><?php echo $req_files;?></b> FILES<br />
~TIME: <b><?php echo $elapsed_time;?> sec.</b> 
<hr>
<?php echo $adv;?>
</div>
</body></html>

<?php endif; ?>
<style>
#wp-picshield-menu {background: #ddd; border-top: 2px solid #ccc; height: 40px; margin-bottom: 10px; 
	font-family:tahoma, verdana, arial, helvetica;}
#wp-picshield-menu .mitem { float: left; padding: 3px 6px; margin: 6px; background: #eee; }
#wp-picshield-menu .mitem:hover { background: #fff; color: #000;}
#wp-picshield-menu .mitem a {color: #666; font-size: 16px; text-decoration: none; 
font-weight:bold; text-shadow: #aaa 0.1em 0.1em 0.2em;}
#wp-picshield-menu .mitem a:hover {color: #000; }
#wp-picshield-menu .selitem { background: #fff; }
#wp-picshield-menu .selitem a {color: #00f;}

#picshield-topleft {float: left; width: 79%; border-right: 1px solid #f7f7f7; padding-right: 5px;}
#picshield-topright {float: right; width: 19%;  }
</style>
<h2>ByREV WP-PICShield - <span style="color: #666; font-size: 16px;">ver: <?php echo _BYREV_WP_PICSHIELD;?></span></h2>
<?php
#~~~~~menu~~~~
$option_menu = array();
$option_menu['settings'] = array('Plugin Settings', 'byrev-wp-picshield-import-admin.php', '');
$option_menu['clearcache'] = array('Clear Watermark Cache Folder', 'byrev-wp-picshield-clearcache.php', '');
$option_menu['cdn'] = array('CDN Tools and Help', 'byrev-wp-picshield-cdn.php', '');
$option_menu['extra'] = array('EXTRA (Special warning image)', 'byrev-wp-picshield-extra.php', '');
$option_menu['logs'] = array('Logs', 'byrev-wp-picshield-logs.php', '');
#~~~~~~~~~~~~~~

$subpage = (isset($_GET['subpage'])) ? $_GET['subpage'] : "settings";
if (isset($option_menu[$subpage])) {
	$option_menu[$subpage][2]= "selitem";
	$include_php = $option_menu[$subpage][1];
} else { die('GTFO'); }

?>
<style>
#picshield-box {font-family:tahoma, verdana, arial, helvetica; margin-bottom: 20px;}
</style>
<div id="picshield-box" class="wrap">  

	<div id="wp-picshield-menu">
		<?php foreach ($option_menu as $key=>$menu) : $subpage_url = add_query_arg( 'subpage', $key); ?>
		<div class="mitem <?php echo $menu[2];?>"><a href="<?php echo $subpage_url;?>" ><?php echo $menu[0];?></a></div>
		<?php endforeach; ?>
		<div style="clear:both;"></div>
	</div>
	
	<div id="picshield-topleft">
		<?php include($include_php); ?>		
		<div style="clear: both;"></div>
	</div>
	
	<div id="picshield-topright">
		<?php include('byrev-wp-picshield-sidebar.php'); ?>	
		<div style="clear: both;"></div>
	</div>
	
</div>
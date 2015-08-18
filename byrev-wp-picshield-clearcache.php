<?php if(!defined('_BYREV_WP_PICSHIELD')) die('GTFO') ?>

<?php
	if (!isset($byrev_hotlink_gtfo_copy['gtfo_key'])) {
		$gtfo_store_data = get_option(_DB_OPTION_NAME);
		$byrev_gtfo_hotlink_post_data = unserialize($gtfo_store_data);
		$byrev_hotlink_gtfo_copy = &$byrev_gtfo_hotlink_post_data;
		$_gtfo_key = $byrev_hotlink_gtfo_copy['gtfo_key'];
	} else {
		$_gtfo_key = $byrev_hotlink_gtfo_copy['gtfo_key'][0];
	}
?>

	<!-- ************** clean cache ************** -->
	<div style="margin: 30px 0px 15px 0px; padding: 0px 10px 5px 10px; border: 1px solid #eee; background: #fffff0;">
		<h2 style="color: #88f; font-family: verdana, arial, helvetica;">Clear Watermark Cache Folder</h2>
		<br />
		<?php 
			$url_clean_cache = _GTFO_CLEAN_CACHE_URL.'?key='.$_gtfo_key; 
			$valid_clean_action  = (file_exists(_GTFO_DEST_CLEANFOLDER_FILE_CODE)) ? "true" : "false" ;
		?>
		<script>
		var cleancode = '<hr><iframe src="<?php echo $url_clean_cache;?>" marginwidth="1" marginheight="1" height="300" width="90%" name="delcache" title="Clean Cache" scrolling="no" align="absmiddle"></iframe>';
		var valid_clean_action = <?php echo $valid_clean_action;?>;
			function clean_gallery_cache(divid) {
			if (!valid_clean_action) {
				alert('Update Option first. Cache folder will be emptied immediately after saving the new configuration.');
				return false;
			}
			var el = document.getElementById(divid);
			el.innerHTML = cleancode;
			el.style.display = "block";
		}
		</script>
		
		<input onclick="clean_gallery_cache('cleancache');" type="button" value="Clear Gallery Cache" name="B1">
		
		<br />
		
		<p>
			NOTE: after clicking <b>Clear Gallery Cache</b> wait until the script completes execution; 
			Depending on the number of files, execution may take several seconds to tens of minutes.<br />
			The script will not be blocked due to limitations php server ... is specifically designed for such problems !!! 
			Be patient and the script will do the job correctly and completely.
		</p>
		
		<div style="text-align: center; padding: 5px; margin-top: 15px; border-top: 3px solid #ddf; background: #eee;" 
		id="cleancache" style="display: none;"></div>
		
		<?php if($_POST[_OPTION_CHECK_UPDATE] == 'Y') : ?>
		<script>setTimeout("clean_gallery_cache('cleancache')",1000);</script>
		<?php endif;?>
	</div>
	<!-- ************** /clean cache ************** -->
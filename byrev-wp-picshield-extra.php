<?php if(!defined('_BYREV_WP_PICSHIELD')) die('GTFO') ?>

	<?php
		$extra_code1 = htmlentities('<div style="text-align: center; line-height: 0px; font-size: 0px;" ><img src="'._BLANK_REFERRER_PNG_URL.'" ></div>');
		$extra_code2 = htmlentities('<div style="text-align: center; line-height: 0px; font-size: 0px;" ><img src="<?php echo _BLANK_REFERRER_PNG_URL;?>" ></div>');
	?>
	
	<h2>Extra <span style="color: #888;">(Available for those who need it!)</span></h2>
	<div style="text-align: center; padding: 5px; margin 5px; border: 1px solid #aaa; background: #eee; ">
		<p style="font-size: 16px;">Special image, dynamically generated, served as a warning to visitors with blank referer. 
		Script will serve a 1x1 pixel transparent image for Visitors with not empty referrer ! 
		Use bottom code in your <b>header.php</b> or elsewhere.</p>		
		<img style="max-height:48px; max-width: 800px; width: 100%;" src="<?php echo _BLANK_REFERRER_DEMO_PNG_URL;?>" />
		<p>HTML + PHP code when plugin is active/enabled:</p>
		<textarea style="max-width: 1200px; width: 100%; height: 36px; padding: 5px;" ><?php echo $extra_code2;?></textarea>
		<p>HTML code when plugin is not active, but it is installed</p>
		<textarea style="max-width: 1200px; width: 100%; height: 42px; padding: 5px;" ><?php echo $extra_code1;?></textarea>
		<p>or use this simple link as image, anywhere in your template (when plugin active or not, but it is installed)</p>
		<textarea style="max-width: 1200px; width: 100%; height: 42px; padding: 5px;" ><?php echo _BLANK_REFERRER_PNG_URL;?></textarea>		
		<br /><br />
	</div>
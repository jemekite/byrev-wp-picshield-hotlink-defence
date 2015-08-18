<?php
	global $byrev_gtfo_hotlink_post_data;
	global $byrev_hotlink_gtfo_default;
	global $__ONLINE_TRANSLATORS;
	
	$__ONLINE_TRANSLATORS = array('translate.google.com','translate.googleusercontent.com','www.microsofttranslator.com');
	$__SOCIAL_SHARE_USER_AGENT = array ('facebookexternalhit','facebookplatform','pinterest','feedfetcher','ggpht');
	$__SOCIAL_SHARE_REFERER = array ('pinterest.com','tumblr.com','facebook.com','plus.google','twitter.com');	
	$__GOGLE_TEST_REFERER = array ('googleapis.com','googleusercontent.com','ytimg.com','gstatic.com');
	
	$__KNOW_CDN_USER_AGENT = array ('photon', 'smush.it', 'akamai', 'cloudfront', 'netdna', 'bitgravity', 'maxcdn', 'edgecast', 'limelight', 'tineye');	
	$__GOOGLE_TEST_USER_AGENT = array('developers','gstatic','googleapis','googleusercontent','google','ytimg');
	//photon = wordpress images cdn
	//photon ip : 207.198.112.*
	//smush.it ip: 98.139.160.207
	// tineye support
	// developers google 
	// ggpht , google plus
	
	$byrev_hotlink_gtfo_default = array(	
	'Basic Settings',		
	'wp-picshield-version' => array(_BYREV_WP_PICSHIELD,'','','hidden'),
	'enable_hotlink_gtfo' => array('Disable', '<u><b>Enable Hotlink Protection</b></u>','Enable Byrev Hotlink Protection from htacess', array('Enable|1','Disable|0') ),	
	'gtfo_key' => array(get_gtfo_key(), 'GTFO Key', 'Protection against unauthorized requests', ""),	
	'hotlink_cache_folder' => array('~hotlink-cache','Cache Folder', 'Served files cache, for faster response', ""),
	'image_source_transparency' => array('65','Hotlink Image Opacity', 'Original image opacity value: 0-100% maxim; lower = brighter;', ""),
	'Watermark Settings',
	'watermark_enabled' => array('Enable', '<u><b>Enabled Watermark</b></u>', 'Enabled Watermark over Hotlinked Images', array('Enable|1','Disable|0')),
	'watermark_pass_through' => array('Pass Through', '<u><b style="color: #00f;">Rewrite Image Mode</b></u>', '<b>Pass Through</b>: internal redirection. <b>Redirect 302</b>: External redirect to cached image;', array('Pass Through|1', 'Redirect 302|0', 'Temporary Redirect 307 |2')),	
	'watermark_png_file' => array('watermark.png', 'Watermark Filename', 'Custom PNG watermark filename (placed in the root site). Default is watermark.png', ""),	
	'watermark_position' => array('Top', 'Watermark Position', 'Watermark over image custom position: top, center, bottom', array('Top|0','Center|1', 'Bottom|2')),
	'blend_bar_watermark' => array('Enable', 'Enable Watermark Opacity', 'Watermark image/opacity', array('Enable|1','Disable|0')),
	'blend_bar_opacity' => array(25,'Watermark Opacity Value', 'Watermark transprency value: 1-35% maxim', ""),
	'write_host_source' => array('Enable','HostName Over Image', 'Source host over image. Bottom left position', array('Enable|1','Disable|0')),
	'write_time_cached_over_image' => array('Disable','Time Over Image', 'Write time over image (bottom left) when the file was cached', array('Enable|1','Disable|0')),
	'print_qr_host' => array('Disable','Print QR BarCode', 'Source host over image in QR-BarCode Format. Bottom right position; Offers the opportunity to visit the site with smartphones !!!', array('Enable|1','Disable|0')),
	'Optional Settings',
	'send_hotlink_gtfo_header_signature' => array('Disable','Signature in Header', 'Send Hotlink Protection Signature in Images Header', array('Enable|1','Disable|0')),
	'redirect_direct_link_images_from_google' => array('Attachment','<u><b>Redirect Direct Clik</b></u>','Redirect images click-link to: attachment template page or to single/gallery page; None: disbled', array('Attachment|1','Single|2','Homepage|3 ','None|0')),
	'redirect_404_not_found_image' => array('/image-not-found/', 'Image <b>Not Found</b> page', 'Custom URL/Page for "Not Found" images (manualy create this page, template, or static)', ""),
	'redirect_not_found_image_code' => array('404 Not Found', 'Image <b>Not Found</b> code', 'Response code for Custom URL/Page "Not Found"', array('404 Not Found|404 Not Found','307 Temporary Redirect|307 Temporary Redirect','302 Found|302 Found') ),
	'maximum_megapixels_size' => array(3,'Maximum Megapixels', 'Maximum size in megapixels for protected files. Avoid memory errors for big files; 1..128', ""),
	'.htacess Settings',
	'images_extension' => array('jpg jpeg png gif','Files To Protect', 'Image Extensions Files to protected by <b>WP-PICShield</b> plugin (without the dot)', ""),
	'allowed_domains' => array($_SERVER['SERVER_NAME'], 'Allowed Domains', 'Domains that you will allow to hotlink images', array()),		
	'allowed_user_agents' => array('googlebot|msnbot|baiduspider|slurp|webcrawler|teoma|photon', 'Allowed User Agents', 'User Agents list that you will be served directly', array()),
	'allowed_remote_ip' => array("", 'Allowed Remote IP', 'Remote IP that you will allow to hotlink/get images <i>(like CDN, or other services)</i>', array()),		
	'allow_online_translators' => array('Enable','Allow Online Translators', 'Online translatos will be served directly', array('Enable|1','Disable|0')),		
	'allow_socials' => array('Enable','Allow Social Sites', 'Sites like <b>pinterest, thumblr, facebook</b> ... will be served directly; without this share button will not work!', array('Enable|1','Disable|0')),			
	'x_frame_sameorgin' => array('Disable', 'Anti-IFRAME Protection', 'Make sure that your site content is not displayed embed in another website', array('Enable|1','Disable|0')),	
	'Logs Stats ( ~~~ <span style="color: #888;">This feature and statistics will be introduced soon</span> ~~~ )',
	'log_referer_enabled' => array('Disable','Enable Logs', 'Logs Referer, Request URL and Redirection', array('Enable|1','Disable|0')),
	'log_referer_table' => array('** disabled **','Logs DB Table', 'Database TABLE where logs will be saved', ""),
	'Credit (not required, but welcome)',
	'write_credit_plugin' => array('Enable','Credit this Plugin', 'Plugin name displayed in the bottom of watermarked images (original images are untouched.)', array('Enable|1','Disable|0')),
	);
	
	$byrev_gtfo_hotlink_post_data = "";	
	
	if(!$_POST[_OPTION_CHECK_UPDATE] == 'Y') { 
		$gtfo_store_data = get_option(_DB_OPTION_NAME);
		$byrev_gtfo_hotlink_post_data = unserialize($gtfo_store_data);
	} else {
		if (!isset($_POST[_OPTION_CHECK_RESET])) {
			$byrev_gtfo_hotlink_post_data = $_POST[_PREFIX_FIELD];	
			#~~~ sanitize
			$byrev_gtfo_hotlink_post_data = array_map( 'esc_attr', $byrev_gtfo_hotlink_post_data );
		} else {
			// reset $byrev_gtfo_hotlink_post_data
		}
	}

	#~~~ version chcek
	if (!isset($byrev_gtfo_hotlink_post_data['wp-picshield-version'])) {
		//msg_info( false, 'WARNING: You have installed a new version of the plugin. Click <b>Update Options</b> to update with new features!','');		
	}
	elseif ($byrev_gtfo_hotlink_post_data['wp-picshield-version'] != $byrev_hotlink_gtfo_default['wp-picshield-version'][0] ) {
		//msg_info( false, 'WARNING: You have installed a new version of the plugin. Click <b>Update Options</b> to update with new features!','');		
	}
	#~~~ /
	
	foreach ($byrev_gtfo_hotlink_post_data as $key=>&$value) :
		if (!array_key_exists($key, $byrev_hotlink_gtfo_default)) {
			unset($byrev_gtfo_hotlink_post_data[$key]);
		}
	endforeach;
	
	$byrev_hotlink_gtfo_copy = $byrev_hotlink_gtfo_default;
		
	if($_POST[_OPTION_CHECK_UPDATE] == 'Y') {
		$gtfo_store_data = serialize($byrev_gtfo_hotlink_post_data);
		update_option(_DB_OPTION_NAME, $gtfo_store_data); 
		
		echo '<br /><hr />';
		
		validate_byrev_gtfo_hotlink_raw_data($data_basic, $data_redir, $data_htaccess, $data_cleanfolder);
		$data_basic['wp-picshield-version'] = _BYREV_WP_PICSHIELD;
			
		if ($byrev_gtfo_hotlink_post_data['enable_hotlink_gtfo'] != 0) {			
			#~~~~ write _GTFO_DEST_BASE_FILE_CODE to root
			$_search = array(); $_replace=array();		
			$php_code = file_get_contents(_GTFO_BASE_FILE_CODE);
			foreach($data_basic as $key=>$value) :
				$_search[] = '{'.$key.'}';
				$_replace[] = $value;		
			endforeach;		
			$php_code = str_replace($_search, $_replace, $php_code);
			$result1 = @file_put_contents(_GTFO_DEST_BASE_FILE_CODE, $php_code);
			msg_info($result1, 'ERROR! File '._GTFO_DEST_BASE_FILE_CODE. ' not able to be copied.' , 'OK! File '._GTFO_DEST_BASE_FILE_CODE. ' was copied.');
			
			#~~~~ write _GTFO_DEST_REDIRECT_FILE_CODE to root
			$_search = array(); $_replace=array();		
			$php_code = file_get_contents(_GTFO_REDIRECT_FILE_CODE);
			foreach($data_redir as $key=>$value) :
				$_search[] = '{'.$key.'}';
				$_replace[] = $value;		
			endforeach;		
			$php_code = str_replace($_search, $_replace, $php_code);
			$result2 = @file_put_contents(_GTFO_DEST_REDIRECT_FILE_CODE, $php_code);
			msg_info($result2, 'ERROR! File: '._GTFO_DEST_REDIRECT_FILE_CODE. ' not able to be copied.', 'OK! File '._GTFO_DEST_REDIRECT_FILE_CODE. ' was copied.');
			
			#~~~~ write _GTFO_DEST_CLEANFOLDER_FILE_CODE to plugin base folder
			$_search = array(); $_replace=array();		
			$php_code = file_get_contents(_GTFO_CLEANFOLDER_FILE_CODE);
			foreach($data_cleanfolder as $key=>$value) :
				$_search[] = '{'.$key.'}';
				$_replace[] = $value;		
			endforeach;		
			$_search[] = "/* = */ die('GTFO'); /* = */";  #~~~ remove protection run
			$_replace[] = "";
			$php_code = str_replace($_search, $_replace, $php_code);
			$result4 = @file_put_contents(_GTFO_DEST_CLEANFOLDER_FILE_CODE, $php_code);
			msg_info($result4, 'ERROR! File: '._GTFO_DEST_CLEANFOLDER_FILE_CODE. ' not able to be copied.', 'OK! File '._GTFO_DEST_CLEANFOLDER_FILE_CODE. ' was copied.');
			
			#~~~~ write _DEFAULT_WATERMARK_FILE_PNG to root
			if ($data_basic['watermark_png_file'] == _DEFAULT_WATERMARK_FILE_PNG) :
				$result3 = copy(_GTFO_WATERMARK_FILE_PNG, _GTFO_DEST_WATERMARK_FILE_PNG);		
				msg_info($result3, 'ERROR! File: '._GTFO_DEST_WATERMARK_FILE_PNG. ' not able to be copied.', 'OK! File '._GTFO_DEST_WATERMARK_FILE_PNG. ' was copied.');
			else:
				$result3 = true;
			endif;
			
			$result = ($result1 AND $result2 AND $result3 AND $result4);
			msg_info($result, 'FAIL: Can not proceed to the next step because of previous errors.','OK! First steps were executed successfully.');
		
			if (!$result) return; #~~~ error copy files !!!!!!
			
			#~~~~ prepare htacces
			$_s1 = ($data_basic['x_frame_sameorgin']) ? "" : "# ";
			
			$htaccess['begin'] = array(
				_HTACCES_SIGN_BEGIN,
				$_s1.'Header always append X-Frame-Options SAMEORIGIN',
				'<IfModule mod_rewrite.c>',
				'RewriteEngine On',
			);
			
			#~~~~ image extension
			$images_extension = explode(' ', $byrev_gtfo_hotlink_post_data['images_extension']);
			foreach ($images_extension as $index=>&$arr) $arr = trim($arr);
			$images_extension = implode("|", $images_extension);		
			$htaccess['images_extension'][] = 'RewriteCond %{REQUEST_URI} \.('.$images_extension.')$ [NC]';
			
			#~~~~ if redirection non-transparent: via header location!
			if ($data_basic['watermark_pass_through'] == "false") : 				
				$htaccess['exclude_cache'][] = 'RewriteCond %{REQUEST_URI} !'.$data_basic['hotlink_cache_folder'].' [NC]';
			endif;			
			
			#~~~~ allowed self server ip
			$server_ip = $_SERVER['SERVER_ADDR'];
			$htaccess['remote_addr'][] = "RewriteCond %{REMOTE_ADDR} !^(127.0.0.1|".$server_ip.")$ [NC]";
			
			#~~~~ tumblr ips
			if ($data_htaccess['allow_socials']) {
				$htaccess['remote_addr'][] = "RewriteCond %{REMOTE_ADDR} !^66.6.(32|33|36|44|45|46|40). [NC]";
			}
			
			#~~~~ allowed_ips
			$allowed_remote_ip = explode("\n", $byrev_gtfo_hotlink_post_data['allowed_remote_ip']);
			foreach ($allowed_remote_ip as $index=>&$arr) $arr = trim($arr);		
			$allowed_remote_ip = array_filter($allowed_remote_ip, 'strlen' ); #~~ remove empty line				
			$allowed_remote_ip = array_unique($allowed_remote_ip); #~~ remove duplicate
			if (count($allowed_remote_ip)>0) {
				$allowed_remote_ip = implode("|", $allowed_remote_ip);
				$htaccess['remote_addr'][] = "RewriteCond %{REMOTE_ADDR} !^(".$allowed_remote_ip.")$ [NC]";
			}			
			
			#~~~~ allowed_domains
			$allowed_domains = explode("\n", $byrev_gtfo_hotlink_post_data['allowed_domains']);
			foreach ($allowed_domains as $index=>&$arr) $arr = trim($arr);		
			$allowed_domains = array_filter($allowed_domains, 'strlen' ); #~~ remove empty line				
			#~ merge with online translators if enabled
			if ($data_htaccess['online_translators']) {
				$allowed_domains = array_merge($allowed_domains, $__ONLINE_TRANSLATORS);
			}		
			#~ merge with socials			
			if ($data_htaccess['allow_socials']) {
				$allowed_domains = array_merge($allowed_domains, $__SOCIAL_SHARE_REFERER);
			}		
			#~ merge with F***G google if exist! FORCED
			$allowed_domains = array_merge($allowed_domains, $__GOGLE_TEST_REFERER);
			
			$allowed_domains = array_unique($allowed_domains); #~~ remove duplicate					
			if (count($allowed_domains)>0) {
				$allowed_domains = implode("|", $allowed_domains);
				$htaccess['allowed_domains'][] = 'RewriteCond %{HTTP_REFERER} !^http(s)?://(www\.)?('.$allowed_domains.') [NC]';
			}
			
			#~~~~ user_agents
			$allowed_user_agents = explode("\n", $byrev_gtfo_hotlink_post_data['allowed_user_agents']);
			foreach ($allowed_user_agents as $index=>&$arr) $arr = trim($arr);		
			$allowed_user_agents = array_filter($allowed_user_agents, 'strlen' ); #~~ remove empty line			
			#~~~~ merge with socials			
			if ($data_htaccess['allow_socials']) {
				$allowed_user_agents = array_merge($allowed_user_agents, $__SOCIAL_SHARE_USER_AGENT);
			}

			$allowed_user_agents = array_unique($allowed_user_agents); #~~ remove duplicate
			
			if (count($allowed_user_agents)>0) {
				$allowed_user_agents = implode("|", $allowed_user_agents);		
				$htaccess['allowed_user_agents'][] = 'RewriteCond %{HTTP_USER_AGENT} !('.$allowed_user_agents.') [NC]';
			}

			#~~~~ allow with known CDN ... future integrate in option; force to allow for the moment.
			#$allowed_user_agents = array_merge($allowed_user_agents, $__KNOW_CDN_USER_AGENT);
			if (count($__KNOW_CDN_USER_AGENT)>0) {
				$allowed_cdn_user_agents = implode("|", $__KNOW_CDN_USER_AGENT);		
				$htaccess['allowed_cdn_user_agents'][] = 'RewriteCond %{HTTP_USER_AGENT} !('.$allowed_cdn_user_agents.') [NC]';
			}
			
			#F**G google worst and evil search-engine ever.
			if (count($__GOOGLE_TEST_USER_AGENT)>0) {
				$allowed_gtest_user_agents = implode("|", $__GOOGLE_TEST_USER_AGENT);		
				$htaccess['allowed_gtest_user_agents'][] = 'RewriteCond %{HTTP_USER_AGENT} !('.$allowed_gtest_user_agents.') [NC]';
			}			
			

			#~~~
					
			$htaccess['rewrite_rule'][] = 'RewriteRule (.*) byrev-wp-picshield.php?key='.$data_basic['gtfo_key'].'&src=$1 [L]';
			
			$htaccess['end'][] = '</IfModule>';
			$htaccess['end'][] = _HTACCES_SIGN_END;
			
			$htaccess_data = "";		
			foreach ($htaccess as $index=>&$rules) $htaccess_data .= implode(_CRLF, $rules)._CRLF;

			$result4 = update_htaccess($htaccess_data);
			msg_info($result4, 'ERROR! .htaccess file '._GTFO_DEST_BASE_FILE_CODE. ' not able to be updated.' , 'OK! .htacces file '._GTFO_DEST_BASE_FILE_CODE. ' was updated.');		
		} else {
			$result4 = update_htaccess(_HTACCES_SIGN_BEGIN._CRLF._HTACCES_SIGN_END);
			msg_info(false, 'NOTE: Settings were saved, but the plugin is not active yet. Please set <b>Enable</b> from <b>Enable Hotlink Protection</b> option!' , '');			
		}
    } 
	
	if (is_array($byrev_gtfo_hotlink_post_data)) {
		foreach ($byrev_gtfo_hotlink_post_data as $data_name=>$post_data):
			list($_value, $_name, $_info, $_input) = $byrev_hotlink_gtfo_copy[$data_name];
			if ( is_array($_input) && (count($_input)>0) ) {
				foreach ($_input as $_options) {
					list($_op_name, $_op_value) = explode('|', $_options);
					if ($_op_value == $post_data) {
						$byrev_hotlink_gtfo_copy[$data_name][0] = $_op_name;
						break;
					}
				}
			} else {
				$byrev_hotlink_gtfo_copy[$data_name][0] = $post_data;
			}
		endforeach;
	} 	
	
	function validate_byrev_gtfo_hotlink_raw_data(&$data_basic, &$data_redir, &$data_htaccess, &$data_cleanfolder) {
	
		global $byrev_gtfo_hotlink_post_data, $byrev_hotlink_gtfo_default;
		$gp = &$byrev_gtfo_hotlink_post_data;
		$gd = &$byrev_hotlink_gtfo_default;
		$data_basic = array();
		$data_redir = array();
		$data_htaccess = array();
		#~~~~~~
		$data_basic['gtfo_key'] = (strlen($gp['gtfo_key'])>4) ? $gp['gtfo_key'] : $gd['gtfo_key'][0];
		$gp['gtfo_key'] = $data_basic['gtfo_key'];
		
		$data_cleanfolder['gtfo_key'] = $data_basic['gtfo_key'];
		#~~~~~~
		$data_basic['hotlink_cache_folder'] = ($gp['hotlink_cache_folder'] != "") ? $gp['hotlink_cache_folder'] : $gd['hotlink_cache_folder'][0];
		$gp['hotlink_cache_folder'] = $data_basic['hotlink_cache_folder'];
		
		$data_cleanfolder['hotlink_cache_folder_full_path'] = ABSPATH.$data_basic['hotlink_cache_folder'].'/';
		#~~~~~~
		$n = (int)$gp['image_source_transparency'];
		$data_basic['image_source_transparency'] = ( ($n < 0) OR ($n > 100) ) ? $gd['image_source_transparency'][0] : $n;
		$gp['image_source_transparency'] = $data_basic['image_source_transparency'];
		#~~~~~~
		$data_basic['watermark_png_file'] = (stripos($gp['watermark_png_file'], '.png')) ? $gp['watermark_png_file'] : $gd['watermark_png_file'][0];
		$gp['watermark_png_file'] = $data_basic['watermark_png_file'];
		#~~~~~~
		$data_basic['watermark_position'] = (int)$gp['watermark_position'];
		#~~~~~~
		$data_redir['redirect_not_found_image_code'] = $gp['redirect_not_found_image_code'];
		#~~~~~~
		$data_basic['blend_bar_watermark'] = ($gp['blend_bar_watermark'] == 1) ? "true" : "false";
		#~~~~~~
		$data_basic['watermark_enabled'] = ($gp['watermark_enabled'] == 1) ? "true" : "false";			
		#~~~~~~		
		$data_basic['watermark_pass_through'] = ($gp['watermark_pass_through'] == 1) ? "true" : "false";
		$data_basic['watermark_redirect_302'] = ($gp['watermark_pass_through'] == 0) ? "true" : "false";
		#~~~~~~
		$n = (int)$gp['blend_bar_opacity'];
		$data_basic['blend_bar_opacity'] = ( ($n < 20) OR ($n > 40) ) ? $gd['blend_bar_opacity'][0] : $n;
		$gp['blend_bar_opacity'] = $data_basic['blend_bar_opacity'];
		#~~~~~~
		$data_basic['write_host_source'] = ($gp['write_host_source'] == 1) ? "true" : "false";
		#~~~~~~
		$data_basic['write_time_cached_over_image'] = ($gp['write_time_cached_over_image'] == 1) ? "true" : "false";
		#~~
		$data_basic['print_qr_host'] = ($gp['print_qr_host'] == 1) ? "true" : "false";		
		#~~~~~~
		$data_basic['x_frame_sameorgin'] = ($gp['x_frame_sameorgin'] == 1);		
		#~~~~~~
		$data_basic['send_hotlink_gtfo_header_signature'] = ($gp['send_hotlink_gtfo_header_signature'] == 1) ? "true" : "false";
		#~~~~~~
		$n = (int)$gp['redirect_direct_link_images_from_google'];
		$data_basic['redirect_direct_link_images_from_google'] = ($n != 0) ? "true" : "false";
		$data_redir['redirect_direct_link_images_from_google'] = ($n == 2) ? "true" : "false";
		$data_redir['redirect_direct_link_images_from_google_to_homepage'] = ($n == 3) ? "true" : "false";		
		#~~~~~~		
		$data_redir['redirect_404_not_found_image'] = ($gp['redirect_404_not_found_image'] != "") ? $gp['redirect_404_not_found_image'] : $gd['redirect_404_not_found_image'][0];		
		$gp['redirect_404_not_found_image'] = $data_redir['redirect_404_not_found_image'];
		#~~~~~~	
		$n = (int)$gp['maximum_megapixels_size'];
		$data_basic['maximum_megapixels_size'] = ( ($n < 1) OR ($n > 128) ) ? $gd['maximum_megapixels_size'][0] : $n;
		$gp['maximum_megapixels_size'] = $data_basic['maximum_megapixels_size'];
		#~~~~~~				
		$data_basic['write_credit_plugin'] = ($gp['write_credit_plugin'] ==1) ? "true" : "false";
		#~~~~~~		
		// no valid now
		$data_basic['log_referer_enabled'] = 'false';
		$gp['log_referer_enabled'] = $data_basic['log_referer_enabled'];
		
		$data_basic['log_referer_table'] = $gd['log_referer_table'][0];
		$gp['log_referer_table'] = $data_basic['log_referer_table'];
		
		#~~~~~~		
		$allowed_domains = explode("\n", $gp['allowed_domains']);
		foreach ($allowed_domains as $index=>&$arr) $arr = trim($arr); #~~ cleaner
		$allowed_domains = array_filter($allowed_domains, 'strlen' ); #~~ remove empty line
		$allowed_domains = array_unique($allowed_domains); #~~ remove duplicate 
		$data_htaccess['allowed_domains'] = implode("\n", $allowed_domains); #~~~ pack in list format
		$gp['allowed_domains'] = $data_htaccess['allowed_domains'];
		#~~~~~~		
		$allowed_user_agents = explode("\n", $gp['allowed_user_agents']);
		foreach ($allowed_user_agents as $index=>&$arr) $arr = trim($arr); #~~ cleaner
		$allowed_user_agents = array_filter($allowed_user_agents, 'strlen' ); #~~ remove empty line
		$allowed_user_agents = array_unique($allowed_user_agents); #~~ remove duplicate 
		$data_htaccess['allowed_user_agents'] = implode("\n", $allowed_user_agents); #~~~ pack in list format	
		$gp['allowed_user_agents'] = $data_htaccess['allowed_user_agents'];
		#~~~~~~~
		$data_htaccess['online_translators'] = ($gp['allow_online_translators'] == 1);
		$data_htaccess['allow_socials'] = ($gp['allow_socials'] == 1);
		
		#~~~~~~		
		$allowed_remote_ip = explode("\n", $gp['allowed_remote_ip']);
		foreach ($allowed_remote_ip as $index=>&$arr) $arr = trim($arr); #~~ cleaner
		$allowed_remote_ip = array_filter($allowed_remote_ip, 'strlen' ); #~~ remove empty line
		$allowed_remote_ip = array_unique($allowed_remote_ip); #~~ remove duplicate 
		$data_htaccess['allowed_remote_ip'] = implode("\n", $allowed_remote_ip); #~~~ pack in list format	
		$gp['allowed_remote_ip'] = $data_htaccess['allowed_remote_ip'];
		
	}
	
	function msg_info($result, $msg_error, $msg_ok) {
		if (!$result) { 
			echo '<div class="msg_error">'.$msg_error.'</div>';
		} else {
			echo '<div class="msg_ok">'.$msg_ok.'</div>';
		}
	}
	
	function get_gtfo_key() {
		$basechar = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
		$b = str_split($basechar);
		shuffle($b); 
		$key1 = $b[0].$b[1].$b[2].$b[3];
		shuffle($b); 
		$key2 = $b[0].$b[1].$b[2].$b[3];
		return $key1.'-'.$key2;
	}
	
	#~~~~~~~~~
	$byrev_hotlink_gtfo_copy['wp-picshield-version'][0] = _BYREV_WP_PICSHIELD;

?>
<style>
.by_item_name {width: 168px; display: inline-block; float: left; margin-right: 10px; color: #66F;}
.by_item_info {padding-left: 10px; color: #666;}
#by_options input, #by_options select {width: 150px; color: #444;}
#by_options input {height: 20px;  font-size: 12px; padding-top:0px; padding-bottom: 0px;}
#by_options p {margin: 2px 0px 0px 0px; padding: 0px; }
#by_options h4 {border-top: 1px solid #ccc;}
#by_options textarea {display: inline-block; float: left; width: 150px; font-size: 10px; line-height: 10px;}
.dis { color: #aaa;}
.msg_error {background:#F00; color: yellow; padding: 3px 0px 3px 10px; font-size: 16px; margin: 3px;}
.msg_ok {background:#f7f7f7; color: #aaf; padding: 3px 0px 3px 10px; font-size: 14px; margin: 3px;}
#picshieldinfo {font-size: 14px; color: blue; margin: 10px 0 10px 0; padding: 5px 10px; background: #f8f8f8; border: 3px dotted #ccc;}
#picshieldinfo ul li span {width: 160px; display: inline-block;}

</style>

    <?php echo "<h2>" . __( 'ByREV WP-PICShield Plugin Options', _PREFIX_FIELD.'_trdom' ) . "</h2>"; ?>  
    <form name="<?php echo _PREFIX_FIELD;?>_form" id="by_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="<?php echo _OPTION_CHECK_UPDATE;?>" value="Y">  
		<?php 
		if ($byrev_hotlink_gtfo_copy['enable_hotlink_gtfo'][0] == 'Disable') {
			msg_info(false, 'NOTE: Pugin is not active yet. Please set <b>Enable</b> from <b>Enable Hotlink Protection</b> option!' , '');	
		}
		
		if ($byrev_hotlink_gtfo_copy['watermark_enabled'][0] == 'Disable')  {
			msg_info( false, 'WARNING NOTE: Images are not fully protected - Watermark over Hotlink images is Disabled. Set <b>Enable</b> from <b>Enabled Watermark</b> option and click <b>Update Options</b>.','');		
		}
			
		
		foreach ($byrev_hotlink_gtfo_copy as $key_index=>$this_default) : 
			if (is_array($this_default)) :
				$db_field = _PREFIX_FIELD.'['.$key_index.']';
				list($_value, $_name, $_info, $_input) = $this_default;
				if ($_input == 'hidden') {
					echo '<input type="hidden" name="'.$db_field.'" value="'.$_value.'">';
					continue;
				}
				echo '<p class="by_item">'; 
				echo '<div class="by_item_name" >'; _e($_name.": " ); echo '</div>';
				if (!is_array($_input)) {
					if ($_input == 'hidden') {
						//echo '<input type="hidden" name="'.$db_field.'" value="'.$_value.'">';
					} else {
						echo '<input type="text" name="'.$db_field.'" value="'.$_value.'" size="20">';
					}
				} elseif (count($_input) == 0) {
					$_list_value = str_replace('|', "\n", $_value);
					echo '<textarea cols="50" rows="5" name="'.$db_field.'" >';
					echo $_list_value;
					echo '</textarea>';
				} else {
					echo '<select name="'.$db_field.'">';
					foreach ($_input as $_options) {
						list($_op_name, $_op_value) = explode('|', $_options);
						if ($_value == $_op_name) $_s = "selected"; else $_s="";
						if ($_op_name == 'Disable') $_c = "dis"; else $_c = "";
						echo '<option class="'.$_c.'" '.$_s.' value="'.$_op_value.'" >'.$_op_name.'</option>';
					}
					echo '</select>';
				}
				echo '<span class="by_item_info" >'; _e($_info); echo '</span>';
				echo '</p><div style="clear: both;"></div>'; 
			else:
				 echo " <h4>" . __( $this_default, _PREFIX_FIELD.'_trdom' ) . "</h4>";
			endif;			
		endforeach; 
		?>
		<hr />
	   <p class="submit">  
        <input style="color: #44f; background: #f7f7f7; height: 30px; font-size: 20px;" type="submit" name="Submit" value="<?php _e('Update Options', _PREFIX_FIELD.'_trdom' ) ?>" />  
		<span> and <b>Clean CacheFolder after Update</b> <input style="width: auto; " type="checkbox" name="clean-cache" value="1"></span>
		<!--
		<input style="width: 30px;" type="checkbox" name="<?php echo _OPTION_CHECK_RESET;?>" value="1" ><?php _e('Reset to Default', _PREFIX_FIELD.'_trdom' ); ?>
		-->
        </p>  
    </form>  	
<?php if(isset($_POST['clean-cache'])) : include('byrev-wp-picshield-clearcache.php'); 	endif; ?>
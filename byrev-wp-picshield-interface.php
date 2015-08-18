<?php
/*
Plugin Name: ByREV WP-PICShield - HOTLINK Defence
Plugin URI: http://wp-picshield.com/
Description: Images Hotlink Protection for Your Wordpress Websites; Anti-Hotlinking images/photos - Extensive Plugin for Watermark Pictures and images links redirect to the original page, based on Invalid Refferers and Boot.
Version: 1.9.7
Author: Emilian Robert Vicol
Author URI: http://publicphoto.org/
License:  GPL2

 * is probably the world’s best wordpress plugins to protect against hotlinking images by search engines and other sites that basically steal your bandwidth, decrease the traffic on your site, and you can lose a large amount of revenue.
 * Caching Support,  Anti-IFRAME Protection, Customized Watermark, Redirect direct-link images, CDN

 * How to Use? 
 * Read FAQ
 
~~~~~ GNU General Public License, version 2 ~~~~~
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; 
if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
http://www.gnu.org/licenses/gpl-2.0.html
--------- 
NOTE: If you use this code or part of this code in your program/scripts, 
I would be glad if you publish that using this script "ByRev-WP-PICShield" and the author's name: Emilian Robert Vicol.
It is not an obligation but prove you respect the work of others!
*/
?>
<?php
define('_BYREV_WP_PICSHIELD', '1.9.7');

define('_WP_BLOG_SERVER_NAME', $_SERVER['SERVER_NAME']);
define('_PUBLIC_CDN_SERVER', _WP_BLOG_SERVER_NAME.".nyud.net");

define('_PREFIX_FIELD', 'byhln');
define('_DB_OPTION_NAME', 'byrev_'._PREFIX_FIELD);

define('_GTFO_PLUGIN_URL', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) );
define('_GTFO_CLEAN_CACHE_URL',_GTFO_PLUGIN_URL.'/byrev-cleanfolder.php');
define('_GTFO_TRAP_IMG_PATH',_GTFO_PLUGIN_URL.'trapimg');

define('_OPTION_CHECK_UPDATE', _PREFIX_FIELD.'_hidden' );
define('_OPTION_CHECK_RESET', _PREFIX_FIELD.'_reset' );

define('_GTFO_FOLDER_PLUGIN', dirname(__FILE__) );
define('_FOLDER_RAW_CODE', _GTFO_FOLDER_PLUGIN.'/raw-code/');
define('_DEFAULT_WATERMARK_FILE_PNG', 'watermark.png');

define('_GTFO_BASE_FILE_CODE', _FOLDER_RAW_CODE.'byrev-wp-picshield.php');
define('_GTFO_REDIRECT_FILE_CODE', _FOLDER_RAW_CODE.'byrev-wp-image2url.php');
define('_GTFO_CLEANFOLDER_FILE_CODE', _FOLDER_RAW_CODE.'byrev-cleanfolder.php');
define('_GTFO_WATERMARK_FILE_PNG', _FOLDER_RAW_CODE._DEFAULT_WATERMARK_FILE_PNG);

define('_GTFO_DEST_BASE_FILE_CODE', ABSPATH.'byrev-wp-picshield.php');
define('_GTFO_DEST_REDIRECT_FILE_CODE', ABSPATH.'byrev-wp-image2url.php');
define('_GTFO_DEST_CLEANFOLDER_FILE_CODE', _GTFO_FOLDER_PLUGIN.'/byrev-cleanfolder.php');
define('_GTFO_DEST_WATERMARK_FILE_PNG', ABSPATH._DEFAULT_WATERMARK_FILE_PNG);

define('_HTACCESS_FILE', ABSPATH.'.htaccess');

define('_HTACCES_SIGN_BEGIN', '# BEGIN WP-PICShield'); 
define('_HTACCES_SIGN_END', '# END WP-PICShield');

define('_CRLF', "\n");

define('_WP_PICSHIELD_PLUGIN_URL', plugins_url( '' , __FILE__ ) );
define('_WP_PICSHIELD_PLUGIN_IMAGES_URL',_WP_PICSHIELD_PLUGIN_URL. '/images' );

define('_BLANK_REFERRER_PNG_FILE', 'byrev-wp-picshield-noref-img.php');
define('_BLANK_REFERRER_PNG_URL',  _WP_PICSHIELD_PLUGIN_IMAGES_URL. '/'._BLANK_REFERRER_PNG_FILE);
define('_BLANK_REFERRER_DEMO_PNG_URL', _WP_PICSHIELD_PLUGIN_IMAGES_URL.'/warning-blank-referrer.png' );

function byrev_hotlink_nuke_init() {
	//
}

function byrev_hotlink_nuke_deactivate() {
	update_htaccess(_HTACCES_SIGN_BEGIN._CRLF._HTACCES_SIGN_END);
	
	$gtfo_store_data = get_option(_DB_OPTION_NAME);
	$byrev_gtfo_hotlink_post_data = unserialize($gtfo_store_data);	
	
	$byrev_gtfo_hotlink_post_data['enable_hotlink_gtfo'] = 0;
	
	$gtfo_store_data = serialize($byrev_gtfo_hotlink_post_data);
	update_option(_DB_OPTION_NAME, $gtfo_store_data); 
}

function byrev_hotlink_nuke_uninstall() {	
	update_htaccess("");
	delete_option( _DB_OPTION_NAME );
}

add_action('init', 'byrev_hotlink_nuke_init');

add_action('admin_menu', 'byrev_hotlink_nuke_admin_actions');

register_deactivation_hook( __FILE__ , 'byrev_hotlink_nuke_deactivate' );
register_uninstall_hook( __FILE__ ,'byrev_hotlink_nuke_uninstall');

function byrev_hotlink_nuke_admin_actions() {	 
	add_submenu_page( 'options-general.php', 'ByREV WP-PICShield', 'WP-PICShield (ByREV)', 'administrator', 'byrev_picshield_admin', 'byrev_picshield_admin');
}

function byrev_picshield_admin() {
	//include ('byrev-wp-picshield-import-admin.php');	
	include ('byrev-wp-picshield-main.php');
}

// Add settings link on plugin page
function byrev_picshield_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=byrev_picshield_admin">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'byrev_picshield_settings_link' );


function update_htaccess($htaccess_data) {
	$htaccess_original = file_get_contents(_HTACCESS_FILE);
	$pos = strripos($htaccess_original, _HTACCES_SIGN_BEGIN);
	if ($pos !== FALSE) {

		$htaccess_begin = explode(_HTACCES_SIGN_BEGIN, $htaccess_original);
		$htaccess_begin = $htaccess_begin[0];
		$htaccess_end = explode(_HTACCES_SIGN_END, $htaccess_original);
		$htaccess_end = $htaccess_end[1];
		$htaccess_new = trim($htaccess_begin)._CRLF._CRLF.$htaccess_data._CRLF.trim($htaccess_end);

	} else {
		$htaccess_new = trim($htaccess_original)._CRLF._CRLF.$htaccess_data._CRLF;
	}
	return file_put_contents(_HTACCESS_FILE, $htaccess_new);
}
?>
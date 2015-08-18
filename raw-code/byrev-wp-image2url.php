<?php
/*
Redirect Image URL to attachment, gallery, post where is the linked or to custom 404 not-found page.
Copyright (C) 2012 Emilian Robert Vicol a.k.a. byrev
Contact author: byrev@yahoo.com 
Author URI: http://publicphoto.org/
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
I would be glad if you publish that using this script "ByRev-WP-Image2url" and the author's name: Emilian Robert Vicol.
It is not an obligation but prove you respect the work of others!
*/

define('_REDIRECT_2_GALLERY', {redirect_direct_link_images_from_google});
define('_REDIRECT_404_URL', "{redirect_404_not_found_image}");
define('_REDIRECT_2_HOMEPAGE', {redirect_direct_link_images_from_google_to_homepage});
define('_NOT_FOUNDE_RESPONSE_CODE','{redirect_not_found_image_code}');

require_once('wp-blog-header.php');

if (_REDIRECT_2_HOMEPAGE) {
	$homepage = get_bloginfo('url')."/";
	header("HTTP/1.1 302 Found");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
	header("Location: ". $homepage);
	exit;
}  

$imageURL = htmlspecialchars($_GET['src']);
$imageURL = esc_sql($imageURL);

global $_404_error;
$_404_error = false;

function wp_image2id_in_postmeta($imageURL) {
	$post_id = -1;
	global $wpdb;

	#~~~ search for images in meta gallery, all posible size;
	$imageFile = substr(strrchr($imageURL, "/"), 1);
	$query = "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_value LIKE '%$imageFile%'";
	$postmetainfo = $wpdb->get_results($query);
	
	foreach ( $postmetainfo as $postmeta ) {
		$meta_value = unserialize($postmeta->meta_value);
		if ( is_array($meta_value) AND array_key_exists('file', $meta_value) ) {
			$pos = stripos($imageURL, $meta_value['file']);
			if ($pos === false) :
				foreach ( $meta_value['sizes'] as $size ) :
					if (array_key_exists('file', $size)) {
						$pos = stripos($imageURL, $size['file']);
						if ($pos !== false) { return $postmeta->post_id; }
					}
				endforeach;
			else: 
				return $postmeta->post_id;
			endif;
		}
	}
	return $post_id;
}	

function wp_attachmentID_2_postID($metapost_id) {
	$parents = get_post_ancestors( $metapost_id );
	$id = ($parents) ? $parents[count($parents)-1]: $metapost_id;	
	return $id;
}

function wp_attachmentGUID_2_postIDs($imageURL)  { #~~~ not confirmed to work
	global $wpdb;
	if ($imageURL != "") {
		$query = "SELECT ID, post_parent FROM $wpdb->posts WHERE (guid like '%".$imageURL."%' AND post_type = 'attachment') LIMIT 1";
		$result = $wpdb->get_row($query);
		if ($result) {
			return array('ID'=>$result->ID, 'post_parent'=>$result->post_parent);
		}
	}
	return false;
}
function wp_search_in_post_content($imageURL)  { #~~~ not confirmed to work
	global $wpdb;
	if ($imageURL != "") {
		$query = "SELECT ID FROM $wpdb->posts WHERE (post_content like '%".$imageURL."%' AND post_type = 'post') LIMIT 1";
		$post_id = $wpdb->get_var($query);
		return $post_id;
	}
	return -1;
}

function get_not_found_url($post_id, $imageURL) {
	return get_site_url() . _REDIRECT_404_URL."?image=".urlencode($imageURL)."&pid=".$post_id;
}

function resolve_url_by_postid($post_id, $imageURL) {
	if ($post_id > 0) {
		$url = get_permalink($post_id);
	} else {
		global $_404_error; $_404_error = true;
		$url = get_not_found_url($post_id, $imageURL);
	}
	return $url;
}

function wp_image2url($imageURL, $mode=0) {
	#~~~ step 1, search url images in postmeta
	$metapost_id = wp_image2id_in_postmeta($imageURL);
	$post_id = (($mode!=0) AND ($metapost_id != -1)) ? wp_attachmentID_2_postID($metapost_id) : $metapost_id ;
	
	#~~~ step 2, found in meta ? OK: solve url and return;
	if ($post_id > 0) {
		return get_permalink($post_id);
	}
	
	#~~~ step 3, f**k, not found in meta ? search by guid and get id for att or post ($mode!=0)
	$ids = wp_attachmentGUID_2_postIDs($imageURL);
	if ($ids) {
		$post_id = ($mode != 0)? $ids['post_parent'] : $ids['ID'];		
	} 
	
	#~~~ step 4, found in GUID ? OK: solve url and return;
	if ($post_id > 0) {
		return get_permalink($post_id);
	}
	
	#~~~ step 5; wtf ? not found in meta or guid ? this blog is fucked up !!! search in post content;
	$post_id = wp_search_in_post_content($imageURL);
	
	#~~~ step 6, hell no matter what id found or not ... solve url ok or 404 and return;
	return resolve_url_by_postid($post_id, $imageURL);
}

if (_REDIRECT_2_GALLERY) {	$url = wp_image2url($imageURL,1); } else { $url = wp_image2url($imageURL,0); }

if (!$_404_error AND (strlen($url) >10) ) {
	header("HTTP/1.1 302 Found");
	header("Location: ". $url);
	exit;
}  

$NotFoundUrl = get_not_found_url("-2", $imageURL);
header("HTTP/1.0 "._NOT_FOUNDE_RESPONSE_CODE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header("Location: " . $NotFoundUrl);
exit;
?>

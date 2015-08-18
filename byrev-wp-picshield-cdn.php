<?php if(!defined('_BYREV_WP_PICSHIELD')) die('GTFO') ?>

<?php
define('_OPTION_CHECK_UPDATE_CDN', _PREFIX_FIELD.'_cdn_hidden' );

$cdn_string = (isset($_REQUEST['full-cdn-server-name'])) ? $_REQUEST['full-cdn-server-name'] : _PUBLIC_CDN_SERVER;
if ($cdn_string == "") $cdn_string = _PUBLIC_CDN_SERVER;

$info_cdn = parse_url($cdn_string);

if (!isset($info_cdn['host'])) { 
	$info_cdn['host'] = $info_cdn['path']; 
	unset($info_cdn['path']);
}

if (!isset($info_cdn['scheme'])) { 
	$info_cdn['scheme'] = "http";
}

if (!isset($info_cdn['path'])) { 
	$info_cdn['path'] = "/";
} else {
	$info_cdn['path'] = trim($info_cdn['path'], '/').'/';
}

$cdn_scheme = $info_cdn['scheme'];
$cdn_host = $info_cdn['host'];
$cdn_path = $info_cdn['path'];

$cdn_host_path = ($cdn_path != "/") ? $cdn_host.'/'.$cdn_path : $cdn_host.'/';

$full_cdn_str = $cdn_scheme."://".$cdn_host_path;


$cdn_host_replace = $cdn_host.'/'.$cdn_path;

$trap_ximg_name = 'trapimg.php?rand='.mt_rand(100000000,999999999).'.jpg';
$trap_ximg_src = _GTFO_TRAP_IMG_PATH.'/'.$trap_ximg_name;
$trap_cdn_image = str_replace(_WP_BLOG_SERVER_NAME, $cdn_host_replace, $trap_ximg_src);
?>
<style>
#cdn-info span {display: inline-block; width: 70px;}
#cdn-info input {width: 300px;} 
.infolist1 {margin-left: 20px;  list-style-type:circle;}
.txtarr { width: 100%; height: 160px; padding: 5px; font-size: 14px; 
background: #888; color: #ffe; 
font-family: tahoma, georgia, verdana, arial, helvetica, system, serif; 
letter-spacing:2px;}
</style>

<h2>CDN Tools, Info and Help <span style="color: #aaa;">(warning: this is not for dummies, don't screw your server!)</span></h2>
<br />
<form name="<?php echo _PREFIX_FIELD;?>_form_cdn" id="by_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
	<input type="hidden" name="<?php echo _OPTION_CHECK_UPDATE_CDN;?>" value="Y"> 
	<div id="cdn-info">
		<span>Full CDN</span>: <input type="text" name="full-cdn-server-name" value="<?php echo $full_cdn_str;?>" size="20"> Ex: <b>http://domain.tld/</b> or something like this: <b>http://sub.domain.tld/path/</b>
		<br />
		<span>CDN Host</span>: <input style="background: #ddd;" type="text" name="cdn_host" value="<?php echo $cdn_host;?>" size="20">
		<br />
		<span>CDN Path</span>: <input style="background: #ddd;" type="text" name="cdn_path" value="<?php echo $cdn_path;?>" size="20">
		<br />
	</div>

	<hr />
    <p class="submit">  
		<input type="submit" name="Submit" value="Reload CDN Tools" />  
	</p>  
</form>  

<h3>Local Host Image: <?php echo _WP_BLOG_SERVER_NAME;?></h3>
<img src="<?php echo $trap_ximg_src;?>" />
<h3>Image via CDN <span style="color: red;">(JPEG via PHP)</span> : <?php echo $cdn_host;?> </h3>
<img src="<?php echo $trap_cdn_image;?>" />

<p>
Note: identify User-Agent and Remote-Addr, add them to the allowed list in the plugin setting. 
Without this info, your images served via CDN will be watermarked, for any visitors and any host-linked.
</p>

<hr />
<?php
	if (!isset($byrev_hotlink_gtfo_copy['gtfo_key'])) {
		$gtfo_store_data = get_option(_DB_OPTION_NAME);
		$byrev_gtfo_hotlink_post_data = @unserialize($gtfo_store_data);
		$byrev_hotlink_gtfo_copy = &$byrev_gtfo_hotlink_post_data;
		$_gtfo_key = $byrev_hotlink_gtfo_copy['gtfo_key'];
	} else {
		$_gtfo_key = $byrev_hotlink_gtfo_copy['gtfo_key'][0];
	}

$eq_htaccess_cdn_watermark ='<IfModule mod_rewrite.c>
RewriteCond %{HTTP_HOST} ^{CDN_SERVER_NAME} [nc]
RewriteCond %{REQUEST_URI} \.(jpg|jpeg|png|gif)$ [NC]
RewriteCond %{REMOTE_ADDR} .......
RewriteCond %{HTTP_REFERER} .......
RewriteCond %{HTTP_USER_AGENT} .......
RewriteRule ^{PATH_TO_CDN}(.*) http://{BLOG_SERVER_NAME}/byrev-wp-picshield.php?key={GTFO_KEY}&src=$1 [L,R=302]
</IfModule>';

$eq_htaccess_cdn_redir ='<IfModule mod_rewrite.c>
RewriteCond %{HTTP_HOST} ^{CDN_SERVER_NAME} [nc]
RewriteCond %{REQUEST_URI} \.(jpg|jpeg|png|gif)$ [NC]
RewriteCond %{HTTP_REFERER} google\.[^?]+[\?&].*q= [NC]
RewriteRule ^{PATH_TO_CDN}(.*) http://{BLOG_SERVER_NAME}/byrev-wp-image2url.php?src=http://{BLOG_SERVER_NAME}/$1 [L]
</IfModule>';

$str_search = array('{CDN_SERVER_NAME}', '{PATH_TO_CDN}', '{GTFO_KEY}', '{BLOG_SERVER_NAME}');
$str_replace = array($cdn_host, $cdn_path, $_gtfo_key, _WP_BLOG_SERVER_NAME);

$eq_htaccess_cdn_watermark = str_replace($str_search, $str_replace, $eq_htaccess_cdn_watermark);
$eq_htaccess_cdn_watermark = htmlentities($eq_htaccess_cdn_watermark);

$eq_htaccess_cdn_redir = str_replace($str_search, $str_replace, $eq_htaccess_cdn_redir);
$eq_htaccess_cdn_redir = htmlentities($eq_htaccess_cdn_redir);
?>

<h3>Potential .htaccess code that may be adapted for use on the CDN server</h3>

<h4> ~~~ Fallback to watermarks ~~~ </h4>
<textarea class="txtarr" >
<?php echo $eq_htaccess_cdn_watermark;?>
</textarea>

<h4> ~~~ Redirect google referrer / Direct click to pictures link ~~~ </h4>
<textarea class="txtarr" >
<?php echo $eq_htaccess_cdn_redir;?>
</textarea>

<hr />

<p>
<h3>Note: </h3>
Note: <b>nyud.net</b> called <b>Coral Cache</b> or <b>Coral</b>, is a free peer-to-peer content distribution network designed and operated by Michael Freedman
</p>
<p>
The project has been deployed since March 2004, during which it has been hosted on <b>PlanetLab</b>, a large-scale distributed research network of several hundred servers deployed at universities world wide. It has not, as originally intended, been deployed by third-party volunteer systems
</p>
<p>
The  <b>nyud.net</b> is used here only for demo. You can use this free CDN but performances are too weak for serious business.
</p>
<p>
<h3>More info about  <b>Coral Cache</b> (free CDN) you can find here : </h3>
<ul class="infolist1">
	<li>Wikipedia - <a target="_blank" href="http://en.wikipedia.org/wiki/Coral_Content_Distribution_Network" >http://en.wikipedia.org/wiki/Coral_Content_Distribution_Network</a></li>
	<li>CoralCDN Project - <a target="_blank" href="http://www.coralcdn.org/" >http://www.coralcdn.org/</a></li>
</ul>
<hr />
<p style="color: #44f;">
Note: <b>photon</b> user agent from <b>RewriteCond %{HTTP_USER_AGENT}</b> in htaccess is for <b>Wordpress CDN Images</b> (i2.wp.com, i1.wp.com).<br />
Is added in silent mode, but will be added as an option in the plugin (for future).<br />
	<p>example: <i>http://i2.wp.com/wp-picshield.com/wp-content/plugins/byrev-wp-picshield-hotlink-defence/trapimg/trapimg~test6.jpg</i></p>	
</p>
</p>
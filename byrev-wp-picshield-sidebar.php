<?php if(!defined('_BYREV_WP_PICSHIELD')) die('GTFO') ?>

<?php 
	$infobox = array();
	$infobox[] = array('Plugin Official Website','http://wp-picshield.com/','');
	$infobox[] = array('Wordpress Plugin Page','http://wordpress.org/extend/plugins/byrev-wp-picshield-hotlink-defence/','');
	$infobox[] = array('Plugin FAQ','http://wp-picshield.com/faq/','');
	$infobox[] = array('Black Coffee for the <b>white nights</b> $','http://wp-picshield.com/donate/','For those who are grateful, many thanks from me.');
	$infobox[] = array('Author Page','http://publicphoto.org/','Emilian Robert Vicol');
	
function fetch_my_rss_feed($url_rss, $count) {
	include_once(ABSPATH.WPINC.'/rss.php'); // path to include script
	$feed = fetch_rss($url_rss); // specify feed url
	$items = @array_slice($feed->items, 0, ($count-1)); // specify first and last item
	if (!empty($items)) : 
		foreach ($items as $item) : 
			$_tti = strip_tags(substr($item['description'],0, 85)).' ...';
			echo '<li><a title="'.$_tti.'" href="'.$item['link'].'">'.$item['title'].'</a> - <i>'.$_tti.'</i></li>';			
		endforeach;
	endif;
}	
?>
<style>
.infobox {margin: 3px; border: 1px slid #ccc; background: #eee; padding: 6px; border-radius: 15px; text-align: center;}
.infobox .ibt9 {font-size: 18px; color: #88f; }
.infobox .inf9 {font-size: 14px; color: #00f; }
.infobox a {font-size: 16px; margin: 5px 0px 5px 0px; display: inline-block;}
.infobox .th2 {color: white; text-shadow: black 0.1em 0.1em 0.2em; font-size: 18px; margin-top:5px; }
.infobox li a{font-size: 12px; margin: 0px;}
</style>
	<?php foreach ($infobox as $infb) : ?>
	<?php $short_url = (strlen($infb[1])>25) ? substr($infb[1], 0, 37).'...' : $infb[1]; ?>
	<div class="infobox">
		<div class="ibt9"><?php echo $infb[0];?></div>
		<a target="_blank" href="<?php echo $infb[1];?>"><?php echo $short_url;?></a>
		<div class="inf9"><?php echo $infb[2];?></div>
	</div>
	<?php endforeach; ?>
	
	<div class="infobox">
		<div style="text-align: center;">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick" /><input type="hidden" name="hosted_button_id" value="FWF6TBRWZDUXA" />
				<input type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" />
				<img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" border="0" />
			</form>
		</div>
	</div>
	<hr />
	<div class="infobox">
		<div class="th2">Latest articles, updates, free pics</div>
		<ol style="text-align: left;">
			<?php fetch_my_rss_feed('http://wp-picshield.com/feed/', 10); ?>
		</ol>
	</div>	
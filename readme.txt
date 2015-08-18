=== ByREV WP-PICShield ===
Contributors: byrev
Donate link: http://wp-picshield.com/donate/
Tags: hotlink, leeching, protection, hotlinking, bandwidth, images, photos, pictures, photography
Requires at least: 3.8.1
Tested up to: 3.8.1
Stable tag: 1.9.7

== Description ==

ByREV WP-PICShield - "Images HOTLINK Defence" is probably the world’s best wordpress plugins to protect against hotlinking images by search engines and other sites that basically steal your bandwidth, decrease the traffic on your site, and you can lose a large amount of revenue.

Before Install: Some incompatibility with Varnish, Lighthttpd, and other "cache" services - Images must not be cached !!! CDN users must ensure that the images served by the CDNS server may be manual updated or have expiration period.

ByREV WP-PICShield Features:

*  Caching Support - Save resources & speed-up your website.
*  Pass-Through Request with "HTTP/1.1 200 OK" response; without redirection to new images; results in search engines is not affected!
*  Anti-IFRAME Protection, make sure that your site content is not displayed embed in another website (a.k.a bing search images result)
*  defines a list of other sites (referrer) that are allowed to display images from your site.
*  defines a list of search engines or bots that are allowed to access/crawl the real images
*  Custom image transprency value
*  Custom PNG watermark filename
*  Watermark over image custom position: top, center, bottom (optional, enabled by default)
*  Custom Watermark image/opacity
*  Write source host over images
*  Send Hotlink Protection Signature in Images Header (optional, disabled by default)
*  Redirect direct-link images from google images to: attachment template page or to single/gallery page (optional, enabled by default)
*  Custom URL/Page link for Not Found images
*  Custom response code for Not Found images: 404, 302 or 307 (404 Not Found, by default)
*  Maximum size in megapixels for protected files. Avoid memory errors for big files
*  Protection against unauthorized requests
*  For a quick execution, configuration is applied directly from customized script file.
*  Allow Online Translators (will be served directly)
*  Special image, dynamically generated, served for warning visitors with blank referer; Available for those who need it!
*  Allow share button for socials sites. Facebook, Pinterest, Thumblr, Twitter, Google Plus - will be served directly; without this, share button will not work! (optional, enabled by default)
*  Allow self server - Share images to: Wordpress via RPC and Twitter via OAuth, will not work without this update !
*  Write time over image (bottom left) when the file was cached (optional: disabled by default)
*  Source host over image in QR-BarCode Format. Bottom right position; Offers the opportunity to visit the site with smartphones using "barcode scanner" software (optional: disabled by default)
*  Manual Clear Cache script avoid php limit execution. Cache is self-cleared after each Update Options. 
*  Allow remote ip list 
*  CDN Tools, Info and Help (warning: this is not for dummies, dont screw your up server!)

== Installation ==

*  Download **ByREV WP-PICShield** Plugin and Install !
*  Activate **ByREV WP-PICShield** from wp plugins menu: /wp-admin/plugins.php
*  Use Wordpress menu **Settings -> WP-PICShield (ByREV)** for custom config. 
*  Click to "Enable Hotlink Protection" and Enable or Disable depending on desire (by default is disabled)
*  Click to Update Options !

For more information, please see [plugin home page](http://wp-picshield.com/about/)
and [FAQ PAGE](http://wp-picshield.com/faq/)

**Very important: Read before use and install!**
Varnish, Lighthttpd, and other “cache” services is not 100% compatible with this plugin … probably only if cache is disabled for all images.

CDN images will not be redirected and no watermarked (if they are served correctly) … so, clearly, this plugin is suitable only for standard installation and for CDN with custom htaccess configurable by webmasters. CDN users must ensure that the images served by the CDN’s server may be manual updated or have expiration period.

Beware of those who use the Jetpack. CDN wordpress (Photon) never expire, and the lowest WP-PICShield version that allows Photon to take pictures correctly is 1.8.9.d ! If you are unsure, do not use this plugin. Photon Cache can not be updated, watermark images remain forever (unless you change the images path or filename)

== Frequently Asked Questions ==

Why messages appear at the top of the page after saving options ?

*  Background RED messages is if something went wrong, and there are problems.
*  Gray Background is verbose, to understand what operations were executed.

I see no change, how to check if it works?

*  Search image in seach engines a.k.a. google and click on thumbs
*  Copy image link and paste in browser url bar, refresh 2 times
*  Remove cusom htaccess code from upper images folder
*  Cache riles from htaccess interferes with functioning plugin
*  Images is linked from another site or from CDN
*  image type is not recognized by php

Why not redirect all clicked images (from google, bing, etc) to articles on the blog ?

*  image was not found in any article or attachment
*  associated meta information is incorrect or has been altered
*  a 404 error was generated
*  image type was not added to the configuration
*  image type is not recognized by php
*  not working in all situation (!)

I see low-resolution images after thumb-click in search engines, why ?

*  image type is not recognized by php
*  image size is over plugin settings. 
*  image not found
*  error occurred in htacces or in php script

lightbox, fancybox not working, images not visible in post after clik from Attachment

*  udate WP to latest version
*  Clear all caches
*  interfere with other rules in htaccess
*  udate plugins like lightbox, fancybox to latest version



== Screenshots ==

1. Screenshot **Settings -> WP-PICShield (ByREV)** Config
2. Screenshot with plugin in action : google search engine
3. Screenshot with plugin in action : bing search engine
4. Screenshot with plugin in action : yahoo search engine
5. Screenshot with images watermarked.
6. Screenshot for CDN tools and help tab

== Changelog ==

= 1.9.7 =

*  update for working if **php short open tags** is not enabled

= 1.9.6 =

*  update redirect-image filters.

= 1.9.5 =

*  solve watermark bug in chrome/ie
*  change transparency to opacity in admin

= 1.9.4 =

*  increase maximum_megapixels_size limitation from 6 to 128 ... allowed to watermark larger images, but beware, the server may hang from intensive tasks until images is cached.

= 1.9.3 =

*  try to solve problems with google custom search engine; Google try some evil things there: fake user-agent !? (F***K g***e again). Working Status : Unknown !
*  add transparency/opacity image in range from 0 to 100% (no more 50% limitation)

= 1.9.2 =

*  solve problems with new user-agent from google+ (F***K this)

= 1.9.1 =

*  add support for tineye

= 1.8.9 K2 =

*  add option: Clean CacheFolder after Update; by default, cache wil not be deleted after every plugin option update, only if this option is checked!!!

= 1.8.9K =

*  add redirection for IE 9/10 and Safari

= 1.8.9i =

*  add KNOW_CDN_USER_AGENT photon, smush.it + something they do not know exactly: akamai, cloudfront, netdna, bitgravity, maxcdn, edgecast, limelight (silent force in htaccess; future options)

= 1.8.9h =

*  add alternative redirection for watermark images: 307 Temporary Redirect

= 1.8.9b =

*  Add Rewrite Mode: Pass Through: internal redirection. Redirect 302: External redirect to cached image (try to solve problems with Varnish, Lighttpd and other mode cache);
*  Some internal change;
*  Show version and warnings to update option database with new features.
*  Allow CDN wp.com ...

= 1.8.8b =

*  attempt at solving warning in logs:  with Invalid image dimensions in byrev-wp-picshield.php on line ***

= 1.8.7b =

*  add redirection from Bing Search Engine and other hotlinkers. Work with Chrome and Firefox. Opera work only with google redirects.

= 1.8.6b =

*  solve some issue with redirection from Google Chrome ... via https send fake referer !!!

= 1.8.5b =

*  add allow remote ip list 
*  add CDN Tools, Info and Help (warning: this is not for dummies, dont screw up your server!)
*  Change design from flat only-one page to multiple-pages.

= 1.8.4b =

*  add option: Manual Clear Cache script / This code avoid php limit execution. Cache is self-cleared after each Update Options. 
*  solved "image source transparency" issue (working: 50-100% transpareny)
*  some change in design

= 1.8.1b =

*  Option to change Response Code for Not Found images; 404, 302 or 307

= 1.8b =

*  Allow Write time over image (bottom left) when the file was cached (optional: disabled by default)
*  Allow Source host over image in QR-BarCode Format. Bottom right position; Offers the opportunity to visit the site with smartphones using "barcode scanner" software (optional: disabled by default)

= 1.7b =

*  Allow socials sites. Facebook, Pinterest, Thumblr, Twitter, Google Plus - will be served directly; without this, share button will not work! (optional, enabled by default)
*  Allow self server - Share images to: Wordpress via RPC and Twitter via RPC, will not work without this update !

= 1.6.1b =

*  solved missing line in htaccess

= 1.6b =

*  solved incorect html code for "Special image, dynamically generated, served as a warning to visitors with blank referer"

= 1.5b =

*  solved single page redirect

= 1.4b =

*  solved option issue for X-Frame
*  add: Allow Online Translators (will be served directly)
*  add: Special image, dynamically generated, served for warning visitors with blank referer; Available for those who need it!

= 1.3b =

*  debug errors: Strict Standards: Only variables should be passed by reference in ...

= 1.2b =

*  Was added the possibility to disable watermark but keep the other protection (redirect direct-link from google images and block iframe embeded)
*  debug errors: needle is not a string or an integer (need more testing)

= 1.1 =
1 st public version.

= 1.0 =

beta version.

== Upgrade Notice ==

IMPORTANT: After each update is required to enter in **Settings -> WP-PICShield (ByREV)** Config and confirm the new configuration options. Otherwise absolutely nothing changes !!!

== Note ==

*  IMPORTANT: After each update is required to enter in **Settings -> WP-PICShield (ByREV)** Config and confirm the new configuration options. Otherwise absolutely nothing changes !!!
*  Plugin uses htaccess rewrite rulse, so you must have rewrites enabled (permalinks) in order to use this plugin, otherwise WP-PICShield not working. In fact it is absolutely necessary to use PHP version 5+ and GD library.
*  Using this plugin is at your own responsibility. We do not answer questions concerning your servers performance, security or otherwise.
*  Version 1.* is not fully tested, if any problems pls. leave a message !


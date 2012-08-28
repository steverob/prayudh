<?php
	$aol_icon_url = get_option('of_aol_icon');
	$facebook_icon_url = get_option('of_facebook_icon');
	$twitter_icon_url = get_option('of_twitter_icon');
	$linkedin_icon_url = get_option('of_linkedin_icon');
	$delicious_icon_url = get_option('of_delicious_icon');
	$flickr_icon_url = get_option('of_flickr_icon');
	$tumblr_icon_url = get_option('of_tumblr_icon');
	$vimeo_icon_url = get_option('of_vimeo_icon');
	$youtube_icon_url = get_option('of_youtube_icon');
	$deviantart_icon_url = get_option('of_deviantart_icon');
	$digg_icon_url = get_option('of_digg_icon');
	$lastfm_icon_url = get_option('of_lastfm_icon');
	$myspace_icon_url = get_option('of_myspace_icon');
	$netvibes_icon_url = get_option('of_netvibes_icon');
	$newsvine_icon_url = get_option('of_newsvine_icon');
	$reddit_icon_url = get_option('of_reddit_icon');
	$stumbleupon_icon_url = get_option('of_stumbleupon_icon');
	$sharethis_icon_url = get_option('of_sharethis_icon');
	$technorati_icon_url = get_option('of_technorati_icon');
	$yahoo_icon_url = get_option('of_yahoo_icon');
	
	$yelp_icon_url = get_option('of_yelp_icon');
	$foursquare_icon_url = get_option('of_foursquare_icon');
	$posterous_icon_url = get_option('of_posterous_icon');
	$me_icon_url = get_option('of_me_icon');
	
	// Last icons feed
	$feed_icon_url = get_option('of_feed_icon');
?>


<ul class="social_icons">
	
	<?php if ($facebook_icon_url) { ?>
	<li class="facebook_icon"><a title="Facebook" href="<?php echo $facebook_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/facebook.png" alt="Facebook"></a></li><?php } ?>
	
	<?php if ($twitter_icon_url) { ?>
	<li class="twitter_icon"><a title="Twitter" href="<?php echo $twitter_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.png" alt="Twitter"></a></li><?php } ?>
	
	<?php if ($linkedin_icon_url) { ?>
	<li class="linkedin_icon"><a title="LinkedIn" href="<?php echo $linkedin_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/linkedin.png" alt="LinkedIn"></a></li><?php } ?>
	
	<?php if ($delicious_icon_url) { ?>
	<li class="delicious_icon"><a title="Delicious" href="<?php echo $delicious_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/delicious.png" alt="Delicious"></a></li><?php } ?>
	
	<?php if ($flickr_icon_url) { ?>
	<li class="flickr_icon"><a title="Flickr" href="<?php echo $flickr_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/flickr.png" alt="Flickr"></a></li><?php } ?>
	
	<?php if ($tumblr_icon_url) { ?>
	<li class="tumblr_icon"><a title="Tumblr" href="<?php echo $tumblr_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/tumblr.png" alt="Tumblr"></a></li><?php } ?>
	
	<?php if ($vimeo_icon_url) { ?>
	<li class="vimeo_icon"><a title="Vimeo" href="<?php echo $vimeo_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/vimeo.png" alt="Vimeo"></a></li><?php } ?>
	
	<?php if ($youtube_icon_url) { ?>
	<li class="youtube_icon"><a title="YouTube" href="<?php echo $youtube_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/youtube.png" alt="YouTube"></a></li><?php } ?>
	
	<?php if ($deviantart_icon_url) { ?>
	<li class="deviantart_icon"><a title="deviantART" href="<?php echo $deviantart_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/deviant-art.png" alt="deviantART"></a></li><?php } ?>
	
	<?php if ($lastfm_icon_url) { ?>
	<li class="lastfm_icon"><a title="Lasf.fm" href="<?php echo $lastfm_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/lastfm.png" alt="Last.fm"></a></li><?php } ?>
	
	<?php if ($digg_icon_url) { ?>
	<li class="digg_icon"><a title="Digg" href="<?php echo $digg_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/digg.png" alt="Digg"></a></li><?php } ?>
	
	<?php if ($stumbleupon_icon_url) { ?>
	<li class="stumbleupon_icon"><a title="stumbleupon" href="<?php echo $stumbleupon_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/stumbleupon.png" alt="stumbleupon"></a></li><?php } ?>

	<?php if ($aol_icon_url) { ?>
	<li class="aol_icon"><a title="Aol" href="<?php echo $aol_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/aol.png" alt="Aol"></a></li><?php } ?>

	<?php if ($myspace_icon_url) { ?>
	<li class="myspace_icon"><a title="MySpace" href="<?php echo $myspace_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/myspace.png" alt="MySpace"></a></li><?php } ?>

	<?php if ($netvibes_icon_url) { ?>
	<li class="netvibes_icon"><a title="Netvibes" href="<?php echo $netvibes_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/netvibes.png" alt="Netvibes"></a></li><?php } ?>

	<?php if ($newsvine_icon_url) { ?>
	<li class="newsvine_icon"><a title="Newsvine" href="<?php echo $newsvine_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/newsvine.png" alt="Newsvine"></a></li><?php } ?>

	<?php if ($reddit_icon_url) { ?>
	<li class="reddit_icon"><a title="Reddit" href="<?php echo $reddit_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/reddit.png" alt="Reddit"></a></li><?php } ?>

	<?php if ($sharethis_icon_url) { ?>
	<li class="sharethis_icon"><a title="ShareThis" href="<?php echo $sharethis_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/sharethis.png" alt="ShareThis"></a></li><?php } ?>

	<?php if ($technorati_icon_url) { ?>
	<li class="technorati_icon"><a title="Technorati" href="<?php echo $technorati_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/technorati.png" alt="Technorati"></a></li><?php } ?>

	<?php if ($yahoo_icon_url) { ?>
	<li class="yahoo_icon"><a title="Yahoo" href="<?php echo $yahoo_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/yahoo.png" alt="Yahoo"></a></li><?php } ?>

	<?php if ($yelp_icon_url) { ?>
	<li class="yelp_icon"><a title="Yelp" href="<?php echo $yelp_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/yelp.png" alt="Yelp"></a></li><?php } ?>

	<?php if ($foursquare_icon_url) { ?>
	<li class="foursquare_icon"><a title="Foursquare" href="<?php echo $foursquare_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/foursquare.png" alt="Foursquare"></a></li><?php } ?>

	<?php if ($posterous_icon_url) { ?>
	<li class="posterous_icon"><a title="Posterous" href="<?php echo $posterous_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/posterous.png" alt="Posterous"></a></li><?php } ?>

	<?php if ($me_icon_url) { ?>
	<li class="me_icon"><a title="MobileMe" href="<?php echo $me_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/mobileme.png" alt="MobileMe"></a></li><?php } ?>

	<?php if ($feed_icon_url) { ?>
	<li class="feed_icon"><a title="Feed" href="<?php echo $feed_icon_url ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/rss.png" alt="Feed"></a></li><?php } ?>
	<!--?php } else { ?><li class="feed_icon"><a title="Feed" href="<?php bloginfo('rss_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/rss.png" alt="Feed"></a></li-->
	

	<!--?php bloginfo('rss2_url'); ?-->
	<!--?php bloginfo('rss_url'); ?-->
	<!--?php echo $feed_icon_url ?-->

</ul><!-- .social_post_footer -->

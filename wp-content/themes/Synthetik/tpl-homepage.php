<?php
/**
 * Template Name: Homepage
 *
 */

get_header(); ?>
	
	<?php if( get_option('of_home_slider') == 'true') {
		include(get_template_directory() .'/inc/slider.php');
	} ?>
	
	<?php if( get_option('of_home_msg') == 'true') { ?>
		<div id="home-message">
			<p><?php echo do_shortcode( stripslashes( get_option('of_home_msg_text') ) ); ?></p>
		</div><!-- home-message -->
	<?php } ?>


	<div id="homepage-container">

		<div id="content" role="main" class="homepage_content clearfix">

		<!-- DISPLAY LATEST PORTFOLIO POSTS (deprecated @since spark/synthetik ) -->
		<!--?php if( get_option('of_latest_portfolio_posts_home') == 'true') {
			include(get_template_directory() .'/inc/latest-portfolio-posts-home.php');
			}
		?-->

		<!-- DISPLAY LATEST PORTFOLIO POSTS -->
		<?php if( get_option('of_latest_portfolio_posts_home') == 'true') {
			include(get_template_directory() .'/inc/portfolio-home.php');
			}
		?>
		
		<!-- DISPLAY HOMEPAGE WIDGET AREA -->
		<?php if( get_option('of_homepage_widget_area') == 'true') {
//			echo '<a class="slideToggle" href="#">Click</a>';
			get_sidebar( 'homepage' );

		} ?>

		<!-- DISPLAY LATEST BLOG POSTS -->
		<?php if( get_option('of_latest_blog_posts_home') == 'true') {
			include(get_template_directory() .'/inc/latest-blog-posts-home.php');
			}
		?>
		
		<!--a href="#top" id="top-link">Top of Page</a-->

		</div><!-- #content .homepage_content -->

	</div><!-- #container -->

<!--?php get_sidebar(); ?-->
<?php get_footer(); ?>
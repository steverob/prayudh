<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 */
?>

	<!-- END #MAIN -->
	</div><!-- #main -->

	<!--?php
	wp_reset_query();
//	if(is_home() || is_front_page()) {
	if(is_front_page()) {
		echo '<div class="main-bottom" style="display:none;"></div>';
	} else {
		echo '<div class="main-bottom"></div>';
	} ?-->

	<div class="main-bottom"></div>
	
	<!-- #main-content here -->	


	<div id="footer-container">

		<!-- BEGIN FOOTER -->
			<?php
			/* A sidebar in the footer? Yep. You can can customize
	 	 	 * your footer with four columns of widgets.
	 	 	 */
				get_sidebar( 'footer' );
			?>
		<!-- END FOOTER -->


		<div class="homepage-top"></div>

		<!-- BEGIN FOOTER BOTTOM -->
		<section id="footer-bottom" class="clearfix">

			<section id="footer-bottom-content">

				<!-- BEGIN SITE-INFO -->
				<footer id="site-info">
			
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'secondary' ) ); ?>

					<!-- Add <li></li> class for the home button -->
					<script type="text/javascript">
						$('#site-info .menu-header ul').prepend('<li><a <?php if (is_front_page()) : ?>class="home-button-current"<?php else : ?>class="home-button"<?php endif ?> href="<?php bloginfo('url'); ?>/">Home</a></li>');
						$("#site-info .menu ul li a:first").addClass("<?php if (is_front_page()) : ?>home-button-current<?php else : ?>home-button<?php endif ?>");
					</script>


           			<?php /* Replace default text if option is set */
						if( get_option('of_footer_left') ) {
							echo do_shortcode( stripslashes( get_option('of_footer_left') ) );
						} else {
					?>
					<p class="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ><?php bloginfo( 'name' ); ?></a>. Powered by <a href="http://wordpress.org/">WordPress</a></p>
           			<?php } ?>

				</footer><!-- #site-info -->
				<!-- END SITE-INFO -->


				<!-- BEGIN FOOTER RIGHT -->
				<footer id="footer-right-side">
					<?php if( get_option('of_footer_right') ) {
						echo '<p class="foo-text-right">';
						echo do_shortcode( stripslashes( get_option('of_footer_right') ) );
						echo '</p>';
/*							} else {
							echo 'Follow me on <a href="#">Twitter</a>, <a href="#">Facebook</a>, <a href="#">Envato</a>';*/
						}
					?>

					<?php include(get_template_directory() .'/inc/social-icons.php'); ?>

				</footer><!-- #footer-right-side -->
				<!-- END FOOTER RIGHT -->
		
			</section><!--  #footer-bottom-content -->

		</section><!--  #footer-bottom -->
		<!-- END FOOTER BOTTOM -->
	
		<div class="homepage-bottom foo"></div>

	</div> <!-- #footer-container -->
	

	
	</div><!-- #main-content -->
	<!-- END #MAIN-CONTENT -->



</div><!-- #wrapper -->
<!-- END WRAPPER -->


	<!-- LOAD JAVASCRIPT -->
	<!--script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.6.1.min.js"></script-->
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.nivo.slider.pack.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.quicksand.js" ></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
	<!--script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.totop.js"></script-->
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.compatibility.js"></script>


	<?php
	/*	Nivo Slider - http://nivo.dev7studios.com/
	------------------------------------------------------------------------------- */
	$slider_effect = get_option('of_slider_effect');
	$slider_slices = get_option('of_slider_slices');
	$slider_animSpeed = get_option('of_slider_animSpeed');
	$slider_pauseTime = get_option('of_slider_pauseTime');
	$slider_directionNav = get_option('of_slider_directionNav');
	$slider_controlNav = get_option('of_slider_controlNav');
	?>

	<!-- HOMEPAGE SLIDER -->
	<script type="text/javascript">
	// Slider - see custom.js for all options
	$(window).load(function() {
		$('#slider').nivoSlider({
			effect: '<?php echo $slider_effect ?>', // Specify sets like: ' fold, fade, sliceDown, etc..'
			slices: <?php echo $slider_slices ?>, // For slice animations
			boxCols: 8, // For box animations
			boxRows: 4, // For box animations
			animSpeed: <?php echo $slider_animSpeed ?>, // Slide transition speed
			pauseTime: <?php echo $slider_pauseTime ?>, // How long each slide will show
			startSlide: 0, // Set starting Slide (0 index)
			directionNav: <?php echo $slider_directionNav ?>, // Next & Prev navigation arrows
			controlNav: <?php echo $slider_controlNav ?>, // 1,2,3... navigation
			controlNavThumbs: false, // Use thumbnails for Control Nav
			controlNavThumbsFromRel: false, // Use image rel for thumbs
//			controlNavThumbsSearch: '.jpg', // Replace this with...
//			controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
			keyboardNav: true, // Use left & right arrows
			pauseOnHover: true, // Stop animation while hovering
			manualAdvance: false, // Force manual transitions
			captionOpacity: 0.8, // Universal caption opacity
			prevText: 'Prev', // Prev directionNav text
			nextText: 'Next', // Next directionNav text
			beforeChange: function(){}, // Triggers before a slide transition
			afterChange: function(){}, // Triggers after a slide transition
			slideshowEnd: function(){}, // Triggers after all slides have been shown
			lastSlide: function(){}, // Triggers when last slide is shown
			afterLoad: function(){} // Triggers when slider has loaded
		});
	});
	</script>


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>

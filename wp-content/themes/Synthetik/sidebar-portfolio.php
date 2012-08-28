<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 */
?>

	<div id="primary" class="widget-area sidebar-portfolio" role="complementary">
		
		<ul class="xoxo">

		<?php
		/* When we call the dynamic_sidebar() function, it'll spit out
	 	 * the widgets for that widget area. If it instead returns false,
	 	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 	 * some default sidebar stuff just in case.
	 	 */
		if ( ! dynamic_sidebar( 'primary-widget-area-portfolio' ) ) : ?>
	
			<li class="widget-container">
				<h3 class="widget-title">Portfolio Single Sidebar</h3>
				<p>This sidebar is specific for the portfolio single page. To start using widgets go to <strong>Appearance</strong> > <strong>Widgets</strong> and drag a widget into the sidebar area.</p>
			</li>

			<!--li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'mav' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li-->

			<!--?php wp_list_categories( 'title_li=' ); ?-->

			<!--li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'mav' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li-->

			<?php endif; // end primary widget area ?>

		</ul>

	</div><!-- #primary .widget-area -->

	<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

	<div id="secondary" class="widget-area" role="complementary">
		<ul class="xoxo">
			<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
		</ul>
	</div><!-- #secondary .widget-area -->

	<?php endif; ?>

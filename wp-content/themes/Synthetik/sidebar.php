<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 */
?>

	<div id="primary" class="widget-area" role="complementary">
		<ul class="xoxo">

		<?php
		/* When we call the dynamic_sidebar() function, it'll spit out
	 	 * the widgets for that widget area. If it instead returns false,
	 	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 	 * some default sidebar stuff just in case.
	 	 */
		if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
		
			<li class="widget-container">
				<h3 class="widget-title">Blog Sidebar</h3>
				<p>This sidebar is specific for the blog pages. To start using widgets go to <strong>Appearance</strong> > <strong>Widgets</strong> and drag a widget into the sidebar area.</p>
			</li>

			<li id="search" class="widget-container widget_search">
				<?php get_search_form(); ?>
			</li>

			<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'mav' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
					<!--?php wp_list_categories( 'title_li=' ); ?-->
				</ul>
			</li>

			<li id="categories" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Categories', 'mav' ); ?></h3>
				<ul>
					<!--?php wp_get_archives( 'type=monthly' ); ?-->
					<?php wp_list_categories( 'title_li=' ); ?>
				</ul>
			</li>

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



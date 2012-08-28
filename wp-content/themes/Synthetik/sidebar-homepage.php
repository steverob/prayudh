<?php
/**
 * The Homepage widget areas.
 */
?>

<?php
	/* The homepage widget area is triggered if any of the areas have widgets.
	 * So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-homepage-widget-area'  )
		&& ! is_active_sidebar( 'second-homepage-widget-area' )
		&& ! is_active_sidebar( 'third-homepage-widget-area'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

	<div class="homepage-top"></div>

	<div id="homepage-widget-area" role="complementary">	<!-- style="display:none" -->


		<?php if ( is_active_sidebar( 'first-homepage-widget-area' ) ) : ?>
		<div id="homepage-first" class="widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'first-homepage-widget-area' ); ?>
			</ul>
		</div><!-- #first .widget-area -->
		<?php endif; ?>


		<?php if ( is_active_sidebar( 'second-homepage-widget-area' ) ) : ?>
		<div id="homepage-second" class="widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-homepage-widget-area' ); ?>
			</ul>
		</div><!-- #second .widget-area -->
		<?php endif; ?>


		<?php if ( is_active_sidebar( 'third-homepage-widget-area' ) ) : ?>
		<div id="homepage-third" class="widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'third-homepage-widget-area' ); ?>
			</ul>
		</div><!-- #third .widget-area -->
		<?php endif; ?>

	</div><!-- #homepage-widget-area -->
			
	<div class="homepage-bottom"></div>
<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

	<div id="container" class="one-column">
		<div id="content" role="main">
			
			<section class="page-line-top"></section>
			<!--div id="breadcrumb"><?php the_breadcrumb(); ?> Page Not Found</div-->

			<div id="post-0" class="post error404 not-found">

				<!--h1 class="entry-title"><?php _e( '404 - Not Found', 'mav' ); ?></h1-->
				<h1 class="page-title"><?php _e( '404 - Not Found', 'mav' ); ?></h1>

				<div class="entry-content">

					<p style="margin-bottom:30px"><?php _e( 'Apologies, but the page you requested could not be found.', 'mav' ); ?></p>

					<ul style="list-style:none;margin-left:0">
						<li style="margin-bottom:50px">
							<?php get_search_form(); ?>
						</li>
					</ul>

				</div><!-- .entry-content -->

			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
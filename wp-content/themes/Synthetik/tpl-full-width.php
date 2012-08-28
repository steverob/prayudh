<?php
/**
 * Template Name: Full Width
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 */

get_header(); ?>

		<div id="container" class="one-column">

			<div id="content" role="main">
			<!--div id="breadcrumb"><?php the_breadcrumb(); ?></div-->

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				
			<section class="page-line-top"></section>
			<!--div id="breadcrumb"><?php the_breadcrumb(); ?></div-->

			<?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
			/*$post = $wp_query->post;
  				if (in_category('web')) {
      				get_template_part( 'loop', 'portfolio' );
				} else {
				get_template_part( 'loop', 'single' );
			}*/

			get_template_part( 'loop', 'single' );

			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
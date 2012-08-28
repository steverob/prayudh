<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>
	
		<div id="container">
			<div id="content" role="main">
				
				<section class="page-line-top"></section>

				<h1 class="page-title">
					<?php
						//	echo 'Our Blog';						
						$blog_page_title = get_option('of_blog_page_title');
						if ($blog_page_title) {
							echo $blog_page_title;
						} ?>
				</h1>
				
				<?php
					$blog_page_desc = get_option('of_blog_page_desc');
					if ($blog_page_desc) { ?><p class="title-desc blog_intro"><?php echo $blog_page_desc; ?></p>
				<?php } ?>

				<?php
				/* Run the loop to output the posts.
			 	 * If you want to overload this in a child theme then include a file
			 	 * called loop-index.php and that will be used instead.
			 	 */
			 	get_template_part( 'loop', 'index' );
				?>

		</div><!-- #content -->			
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

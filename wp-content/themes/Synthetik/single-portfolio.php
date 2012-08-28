<?php
/**
 * The Template for displaying the single portfolio entries.
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				
			<section class="page-line-top"></section>
			<!--div id="breadcrumb"><?php the_breadcrumb(); ?></div-->

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
			<?php
			$custom = get_post_custom($post->ID);
			$portfolio_desc = $custom["portfolio_desc"][0];
			$portfolio_page_id = get_option('of_portfolio_page_id');
			?>

				<div id="nav-above" class="navigation">
					<!--div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'mav' ) . '</span>' ); ?></div-->						

					<?php if( get_option('of_portfolio_page_id') ){ ?>
					<div class="nav-previous">
						<a class="back" href="<?php echo home_url( '/' ); ?>?page_id=<?php echo $portfolio_page_id ?>"><span class="meta-nav"></span>Back to Events</a>
					</div>
					<?php } else { ?>
					<a class="back" href="javascript:javascript:history.go(-1)">&larr; Back to Events</a>
					<?php } ?>

				</div><!-- #nav-above -->


				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!--h1 class="entry-title"><?php the_title(); ?></h1-->
					<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php if ($portfolio_desc) { ?><h3 class="portfolio-description" style="font-weight:normal;margin-bottom:21px"><?php echo $portfolio_desc ?></h3><?php } ?>

					<!--div class="entry-meta">
						<?php mav_posted_on(); ?>
						<span class="comments-link comments-img"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span>
						<?php if ( count( get_the_category() ) ) : ?>
							<span class="cat-links">
								<?php printf( __( '<span class="%1$s categories-img">%2$s</span>', 'mav' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
							</span>
						<?php endif; ?>
					</div--><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit this entry', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->

				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'mav' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->
			
				<?php if( get_option('of_related_portfolio_posts') == 'true'){
					include(get_template_directory() .'/inc/related-portfolio-posts.php');
				} ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
				
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar( 'portfolio'); ?>
<?php get_footer(); ?>
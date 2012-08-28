<?php
/*
Template Name: Archives
*/
get_header(); ?>

<div id="container">
	
	<div id="content" role="main">
		
		<section class="page-line-top"></section>
		<!--div id="breadcrumb"><?php the_breadcrumb(); ?></div-->
		
		<?php the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>

		<div class="entry-content">
			<?php the_content(); ?>
			<!--?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?-->
			<!--?php edit_post_link( __( 'Edit this entry', 'mav' ), '<span class="edit-link">', '</span>' ); ?-->
		</div><!-- .entry-content -->

		<div class="archives-content">

			<div class="archives-block-first">

				<div class="archives-content-categories">
					<h3>Archives by Categories</h3>
					<ul>
						<?php wp_list_categories( 'title_li=' ); ?>
					</ul>
				</div><!-- #archives-content-categories -->

				<div class="archives-content-month">
					<h3>Archives by Month</h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</div><!-- #archives-content-month -->

			</div><!-- #archives-block-first -->


			<div class="archives-block-second">

				<div class="archives-content-blog-posts">
					<h3>Latest 30 Blog Posts</h3>
					<ul>
						<?php
						$args = array( 'numberposts' => '30' );
						$recent_posts = wp_get_recent_posts( $args );
						foreach( $recent_posts as $post ){
							echo '<li><a href="' . get_permalink($post["ID"]) . '" title="Look '.$post["post_title"].'" >' .   $post["post_title"].'</a> </li> ';
						}
						?>
					</ul>
				</div><!-- #archives-content-blog-posts -->

			</div><!-- .archives-block-second -->

		</div><!-- .archives-content -->

		<!--?php get_search_form(); ?-->

	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 */
?>

<!--div id="breadcrumb"><?php the_breadcrumb(); ?></div-->

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Older posts', 'mav' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"></span>', 'mav' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'mav' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mav' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In this theme we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>



<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'mav' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mav' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php mav_posted_on(); ?>
				<span class="comments-link comments-img"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span>
				<?php if ( count( get_the_category() ) ) : ?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s categories-img">%2$s</span>', 'mav' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</span>
					<!--span class="meta-sep">|</span-->
				<?php endif; ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'mav' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'mav' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			<?php edit_post_link( __( 'Edit this entry', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
			<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
				<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'mav' ); ?>"><?php _e( 'More Galleries', 'mav' ); ?></a>
				<!--span class="meta-sep">|</span-->
			<?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'mav' ) ) ) : ?>
				<a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'mav' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'mav' ); ?>"><?php _e( 'More Galleries', 'mav' ); ?></a>
				<!--span class="meta-sep">|</span-->
			<?php endif; ?>
				<!--span class="comments-link comments-img"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span-->
				<!--?php edit_post_link( __( 'Edit', 'mav' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?-->
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->



<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'mav' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav"></span>', 'mav' ) ); ?>
				<?php edit_post_link( __( 'Edit this entry', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php mav_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->


<!-- BEGIN BLOG -->
<?php /* How to display all other posts. */ ?>

	<?php else : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<span class="comments-link comments-img"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mav' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php mav_posted_on(); ?>

				<?php
/*					$days = round((date('U') - get_the_time('U')) / (60*60*24));
					if ($days==0) {
						echo "Published today";
					}
					elseif ($days==1) {
						echo "Published yesterday";
					}
					else {
						echo "Published " . $days . " days ago";
					}*/
				
/*					function time_ago( $type = 'post' ) {
						$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
						return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');
					}
					
					echo time_ago();*/
				?>			

				<!--span class="meta-sep">/</span>
				<span class="comments-link comments-img"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span-->
				<?php if ( count( get_the_category() ) ) : ?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s categories-img">%2$s</span>', 'mav' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ' / ' ) ); ?>
					</span>
				<?php endif; ?>

				<!-- TAGS -->
				<?php
				$tags_list = get_the_tag_list( '', '/ ' );
				/*$tags_list = get_the_tag_list( '' );*/
				if ( $tags_list ):
				?>
				<span class="tag-links">
					<!--?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'mav' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?-->
					<?php printf( __( '<span class="%1$s tagged-img">Tags:</span>%2$s', 'mav' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
				</span>
				<!--span class="meta-sep">|</span-->
				<?php endif; ?>

			</div><!-- .entry-meta -->


	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<div class="archive-thumb">
					<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); // Display thumbnails in category page ?></a>
				</div><!-- .archive-thumb -->

				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<!--a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); // Display thumbnails in category page ?></a-->
				<?php the_content( __( 'Continue reading <span class="meta-nav"></span>', 'mav' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit this entry', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">
				<!--?php if ( count( get_the_category() ) ) : ?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'mav' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</span>
					<span class="meta-sep">|</span-->
					<!--?php endif; ?-->
					<!--span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'mav' ), __( '1 Comment', 'mav' ), __( '% Comments', 'mav' ) ); ?></span-->
					<!--?php edit_post_link( __( 'Edit', 'mav' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?-->

				</div><!-- .entry-utility -->

		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

	<?php endwhile; // End the loop. Whew. ?>

	<?php
		if(function_exists('wp_pagenavi')) {
			wp_pagenavi();
			} else {
		?>
		<nav id="nav-below" class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Older posts', 'mav' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"></span>', 'mav' ) ); ?></div>
		</nav><!-- #nav-below -->
	<?php } ?>
	<!-- END BLOG -->

<!--?php /* Display navigation to next/previous pages when applicable */ ?-->
<!--?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Older posts', 'mav' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"></span>', 'mav' ) ); ?></div>
				</div--><!-- #nav-below -->
<!--?php endif; ?-->

<?php

/*
	BLOG POSTS WIDGET

	----------------------------------------------------------------------------------- */


	// Widget class
	class of_blog_posts_widget extends WP_Widget {


/*
	Widget Setup
	----------------------------------------------------------------------------------- */

	function of_Blog_Posts_Widget() {

		// Widget settings
		$widget_ops = array(
			'classname' => 'of_blog_posts_widget',
			'description' => __('Latest blog posts by category', 'of_blog_posts_widget')
		);

		// Widget control settings
		/*$control_ops = array(
			'width' => 240,
			'height' => 350,
			'id_base' => 'of_blog_posts_widget'
		);*/

		// Create the widget
//		$this->WP_Widget( 'of_blog_posts_widget', __('# Blog Posts', 'of_blog_posts_widget'), $widget_ops, $control_ops ); // Only if $control_ops uncommented.
		$this->WP_Widget( 'of_blog_posts_widget', __('# Blog Posts', 'of_blog_posts_widget'), $widget_ops );

	}


/*
	FRONT-END
	Display Widget
	----------------------------------------------------------------------------------- */

	function widget( $args, $instance ) {
		extract( $args );

		// Arguments for the query
		$args = array();

		// Widget title and things not in query arguments
		$title = apply_filters('widget_title', $instance['title'] );
		$display = $instance['display'];

		// Ordering and such
		if ( $instance['showposts'] )
			$args['showposts'] = (int)$instance['showposts'];

		// Category arguments
		if ( $instance['category_name'] )
			$args['category_name'] = $instance['category_name'];

		// Begin display of widget
		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		query_posts( $args );

		if ( $display == 'ul' || $display == 'ol' ) : ?>

			<<?php echo $display; ?>>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_title( '<li><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></li>' ); ?>
			<?php endwhile; endif; ?>
			</<?php echo $display; ?>>

		<?php else: ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); global $post; ?>

				<div <?php post_class(); ?>>

					<?php if ( function_exists( 'get_the_image' ) && $thumbnail )
						get_the_image( array( 'custom_key' => array( 'Thumbnail', 'thumbnail' ), 'default_size' => 'thumbnail' ) ); ?>

					<?php if ( $display == 'the_content' ) : ?>

					<div class="entry-content">
						<?php the_content( __('Continue reading', 'of_blog_posts_widget') . ' ' . the_title( '"', '"', false ) ); ?>
						<?php wp_link_pages( array( 'before' => '<p class="pages">' . __('Pages:', 'of_blog_posts_widget'), 'after' => '</p>' ) ); ?>
					</div>

					<?php else : ?>
					
					
					<?php
					// Retrieves the attachment for the lightbox. The image is automatically retrieved from the Media Library.
					$attachment_id = get_post_thumbnail_id($post->ID); // Defines ID for image
					$image_attributes = wp_get_attachment_image_src( $attachment_id ); // returns an array
					?>
					
					<?php if ($image_attributes) { ?>
					<p class="byline">
						<?php the_time('M d, Y') ?>
						<!--?php printf( __('<span class="text">On</span> %2$s', 'of_blog_posts_widget'), '<span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta('ID') ) . '" title="' . get_the_author() . '">' . get_the_author() . '</a></span>', '<abbr class="published" title="' . sprintf( get_the_time( __('l, F jS, Y, g:i a', 'of_blog_posts_widget') ) ) . '">' . sprintf( get_the_time( __('F j, Y', 'of_blog_posts_widget') ) ) . '</abbr>' ); ?-->
					</p>
					<?php } ?>
					
					<section class="entry-summary of_blog_posts_widget">
						<!-- if get the full image from media library only. The new way is actually pretty elegant and efficient. -->
						<?php if ($image_attributes) { ?>
						<a href="<?php the_permalink(); ?>">
							<!--img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $image_attributes[0] ?>&amp;h=180&amp;w=270&amp;zc=1"-->
							<span class="overlay" style="opacity:0"></span>
							<?php the_post_thumbnail(); ?>
						</a>
						<?php } ?>

						<?php the_title( '<h3 class="custom-widget-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h3>' ); ?>

						<?php the_excerpt(); ?>
					</section>	<!-- .entry-summary -->

					<?php endif; ?>

					<?php if ( 'page' != $post->post_type ) : ?>

					<!--p class="entry-meta">
						<span class="categories"><span class="text"><?php _e('Posted in', 'of_blog_posts_widget'); ?></span> <?php the_category( ', ' ); ?></span> 
						<?php the_tags( '<span class="tags"> <span class="separator">|</span> <span class="text">' . __('Tagged', 'of_blog_posts_widget') . '</span> ', ', ', '</span>' ); ?> 
						<?php if ( comments_open() ) : ?><span class="separator">|</span><?php endif; ?> <?php comments_popup_link( __('Leave a response', 'of_blog_posts_widget'), __('1 Response', 'of_blog_posts_widget'), __('% Responses', 'of_blog_posts_widget'), 'comments-link', false ); ?> 
					</p-->

					<?php endif; ?>
				</div>

			<?php endwhile; endif; ?>

		<?php endif;

/*		if ( $wp_reset_query )
			wp_reset_query();*/

		echo $after_widget;
	}


/*
	Update Widget
	----------------------------------------------------------------------------------- */

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['display'] = $new_instance['display'];
		$instance['showposts'] = strip_tags( $new_instance['showposts'] );
		$instance['category_name'] = $new_instance['category_name'];

		return $instance;
	}


/*
	Widget Settings (Displays the widget settings controls on the widget panel)
	----------------------------------------------------------------------------------- */

	function form( $instance ) {

		// Set up default widget settings
		$defaults = array(
			'showposts' => '1',
			'title' => 'From the Blog',
			'category_name' => 'uncategorized',
			'display' => 'the_excerpt',
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => 'DESC',
			'orderby' => 'date',
			'ignore_sticky_posts' => true,
			'wp_reset_query' => true
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="width:218px">

			<!-- Widget Title -->
			<p style="margin-bottom:3px;"><strong>Widget Title</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>

			<!-- Category Name -->
			<p style="margin-bottom:3px;"><strong>Category Name</strong></p>
			<p>
				<select id="<?php echo $this->get_field_id( 'category_name' ); ?>" name="<?php echo $this->get_field_name( 'category_name' ); ?>" class="widefat" style="width:100%;">
					<option <?php if ( !$instance['category_name'] ) echo ' selected="selected"'; ?> value=""></option>
					<?php $cats = get_categories( array( 'type' => 'post' ) ); ?>
					<?php foreach ( $cats as $cat ) : ?>
						<option <?php if ( $cat->slug == $instance['category_name'] ) echo 'selected="selected"'; ?>><?php echo $cat->slug; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<!-- Showposts -->
			<p style="margin-bottom:3px;"><strong>Number of Posts</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" value="<?php echo $instance['showposts']; ?>" /></p>

		</div>

		<div style="clear:both;">&nbsp;</div>

		<?php
		}
	}
?>

<?php

/*
	CUSTOM CONTENT WIDGET

	----------------------------------------------------------------------------------- */


	// Widget class
	class of_custom_content_widget extends WP_Widget {


/*
	Widget Setup
	----------------------------------------------------------------------------------- */

	function of_Custom_Content_Widget() {
		
		// Widget settings
		$widget_ops = array(
			'classname' => 'of_custom_content_widget',
			'description' => __('The widget allow to display images, videos and HTML content.', 'of_custom_content_widget')
		);
		
		// Widget control settings
		$control_ops = array(
			'width' => 285,
			'height' => 350,
			'id_base' => 'of_custom_content_widget'
		);

		// Create the widget
		$this->WP_Widget( 'of_custom_content_widget', __('# Custom Content', 'of_custom_content_widget'), $widget_ops, $control_ops );

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
		$titlewidget = apply_filters('widget_title_widget', $instance['title-widget'] );
		$display = $instance['display'];
		$thumbnail = $instance['thumbnail'] ? '1' : '0';
		$wp_reset_query = $instance['wp_reset_query'] ? '1' : '0';

		$args['image_path'] = $instance['image_path'];
		$args['vimeo_path'] = $instance['vimeo_path'];
		$args['youtube_path'] = $instance['youtube_path'];

		// Sticky posts
//		$args['caller_get_posts'] = $instance['caller_get_posts'] ? '1' : '0';

		// Ordering and such
		if ( $instance['showposts'] )
		$args['showposts'] = (int)$instance['showposts'];
			
		if ( $instance['link_to'] )
		$args['link_to'] = $instance['link_to'];
		
		if ( $instance['button_txt'] )
		$args['button_txt'] = $instance['button_txt'];
		
		if ( $instance['text_content_txt'] )
		$args['text_content_txt'] = $instance['text_content_txt'];

		query_posts( $args );

		if ( $display == 'ul' || $display == 'ol' ) : ?>

		<<?php echo $display; ?>>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
		<?php the_title( '<li><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></li>' ); ?>
				
		<?php endwhile; endif; ?>
		</<?php echo $display; ?>>

		<?php else: ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); global $post; ?>

		<li class="widget-container of_custom_content_widget">

		<?php if ( function_exists( 'get_the_image' ) && $thumbnail )
			get_the_image( array( 'custom_key' => array( 'Thumbnail', 'thumbnail' ), 'default_size' => 'thumbnail' ) ); ?>

		<?php if ( $display == 'the_content' ) : ?>

			<section class="entry-content">
				<?php the_content( __('Read More', 'of_custom_content_widget') . ' ' . the_title( '"', '"', false ) ); ?>
				<?php wp_link_pages( array( 'before' => '<p class="pages">' . __('Pages:', 'of_custom_content_widget'), 'after' => '</p>' ) ); ?>
			</section>

			<?php else : ?>

			<section class="entry-summary of_custom_content_widget">
				
				<?php if ($titlewidget) { ?>
				<h3 class="widget-title"><?php echo $instance['title-widget']; ?></h3>
				<?php } ?>
				
				<?php
				$image_path = $instance['image_path'];
				if ($image_path) { ?>
				<a href="<?php echo $instance['link_to']; ?>">
					<span class="overlay" style="opacity:0"></span>
					<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $instance['image_path']; ?>&amp;h=190&amp;w=290&amp;zc=1" alt="" />
				</a>
	
				<?php } else { // No image to display ?>
				<?php } ?>

				<?php
				$vimeo_path = $instance['vimeo_path'];
				$youtube_path = $instance['youtube_path'];

				if ($vimeo_path) { // Embed Vimeo ?>
				<iframe class="vimeo-player" src="<?php echo $vimeo_path ?>" width="270" height="180"></iframe>
				<?php } else { // no vimeo video to display ?>
				<?php } ?>

				<?php if ($youtube_path) { // Embed YouTube ?>
				<iframe class="youtube-player" src="<?php echo $youtube_path ?>" width="270" height="180"></iframe>
				<?php } else { // No image to display ?>
				<?php } ?>

				<!-- Post content -->
				<h3 class="custom-widget-title">
					<a href="<?php echo $instance['link_to']; ?>"><?php echo $instance['title']; ?></a>
				</h3>
				<p><?php echo do_shortcode( stripslashes( $instance['text_content_txt'] ) ); ?></p>

			</section><!-- .entry-summary -->

			<?php endif; ?>

		</li><!-- .of_custom_content_widget -->

		<?php endwhile; endif; ?>

		<?php endif;

		if ( $wp_reset_query )
		
		wp_reset_query();

	}


/*
	Update Widget
	----------------------------------------------------------------------------------- */

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title-widget'] = strip_tags( $new_instance['title-widget'] );
		$instance['display'] = $new_instance['display'];
		$instance['image_path'] = $new_instance['image_path'];
		$instance['vimeo_path'] = $new_instance['vimeo_path'];
		$instance['youtube_path'] = $new_instance['youtube_path'];

		$instance['thumbnail'] = ( isset( $new_instance['thumbnail'] ) ? 1 : 0 );
		$instance['wp_reset_query'] = ( isset( $new_instance['wp_reset_query'] ) ? 1 : 0 );
//		$instance['caller_get_posts'] = ( isset( $new_instance['caller_get_posts'] ) ? 1 : 0 );
		
		$instance['showposts'] = '1';
		
		$instance['link_to'] = strip_tags( $new_instance['link_to'] );
		$instance['button_txt'] = strip_tags( $new_instance['button_txt'] );
//		$instance['text_content_txt'] = strip_tags( $new_instance['text_content_txt'] );
		$instance['text_content_txt'] = do_shortcode( stripslashes( $new_instance['text_content_txt'] )); // solves the stripslashes issue in the front-end.

		return $instance;
	}


/*
	Widget Settings (Displays the widget settings controls on the widget panel)
	----------------------------------------------------------------------------------- */

	function form( $instance ) {

		// Set up default widget settings
		$defaults = array(
			'title-widget' => 'Custom Content Widget',
//			'title' => __( '', $this->textdomain ),
			'title' => 'Display Photos and Videos',
			'vimeo_path' => '',
			'youtube_path' => '',
			'text_content_txt' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer..',
			'display' => 'ul',
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => 'DESC',
			'orderby' => 'date',
			'ignore_sticky_posts' => true,
			'wp_reset_query' => true
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="float:left;width:97%;">
			
			<!-- Widget Title -->
			<p style="margin-bottom:3px;"><strong>Widget Title</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'title-widget' ); ?>" name="<?php echo $this->get_field_name( 'title-widget' ); ?>" value="<?php echo $instance['title-widget']; ?>" /></p>
			
			<!-- Image Preview -->
			<p style="margin-bottom:3px;"><strong>Image Preview</strong></p>
			<?php
			$image_path = $instance['image_path'];					
			if ($image_path) { ?>
			<p><img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $instance['image_path']; ?>&amp;h=200&amp;w=290&amp;zc=1" alt="" /></p>
			<?php } else { ?>
			<p><img src="<?php echo get_template_directory_uri(); ?>/admin/widgets/ph_widget.png" alt="" /></p>
			<?php } ?>

			<!-- Title -->
			<p style="margin-bottom:3px;"><strong>Content Title</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>

			<!-- Image path -->
			<p style="margin-bottom:3px;"><strong>Image URL Path</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">Final size (Homepage Widget Area) 290px * 200px</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'image_path' ); ?>" name="<?php echo $this->get_field_name( 'image_path' ); ?>" value="<?php echo $instance['image_path']; ?>" /></p>
		
			<!-- Vimeo path -->
			<p style="margin-bottom:3px;"><strong>Embed Vimeo Video</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">eg: <strong>http://player.vimeo.com/video/</strong>VIDEO_ID</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'vimeo_path' ); ?>" name="<?php echo $this->get_field_name( 'vimeo_path' ); ?>" value="<?php echo $instance['vimeo_path']; ?>" /></p>

			<!-- YouTube path -->
			<p style="margin-bottom:3px;"><strong>Embed YouTube Video</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">eg: <strong>http://www.youtube.com/embed/</strong>VIDEO_ID</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'youtube_path' ); ?>" name="<?php echo $this->get_field_name( 'youtube_path' ); ?>" value="<?php echo $instance['youtube_path']; ?>" />
			</p>
		
			<!-- Text Content -->
			<p style="margin-bottom:3px;"><strong>Text content</strong></p>
			<p><textarea style="width:103%;" id="<?php echo $this->get_field_id( 'text_content_txt' ); ?>" name="<?php echo do_shortcode( stripslashes( $this->get_field_name( 'text_content_txt' ) ) ); ?>" cols="60" rows="5"><?php echo do_shortcode( stripslashes( $instance['text_content_txt'] ) ); ?></textarea></p>

			<!-- Link to -->
			<p style="margin-bottom:3px;"><strong>Link URL</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'link_to' ); ?>" name="<?php echo $this->get_field_name( 'link_to' ); ?>" value="<?php echo $instance['link_to']; ?>" /></p>
		
		</div>
		
		<div style="clear:both;">&nbsp;</div>

		<?php
		}
	}

?>
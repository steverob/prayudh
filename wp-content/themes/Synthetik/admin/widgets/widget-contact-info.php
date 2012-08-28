<?php

/*
	CONTACT INFO WIDGET

	----------------------------------------------------------------------------------- */


	// Widget class
	class of_contact_info_widget extends WP_Widget {


/*
	Widget Setup
	----------------------------------------------------------------------------------- */

	function of_Contact_Info_Widget() {
		
		// Widget settings
		$widget_ops = array(
			'classname' => 'of_contact_info_widget',
			'description' => __('Display phone, address, gmap, etc...', 'of_contact_info_widget')
		);
		
		// Widget control settings
		$control_ops = array(
			'width' => 285,
			'height' => 350,
			'id_base' => 'of_contact_info_widget'
		);

		// Create the widget
		$this->WP_Widget( 'of_contact_info_widget', __('# Contact Info', 'of_contact_info_widget'), $widget_ops, $control_ops );

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

		$args['the_phone_1'] = $instance['the_phone_1'];
		$args['the_phone_2'] = $instance['the_phone_2'];
		$args['the_address_1'] = $instance['the_address_1'];
		$args['the_address_2'] = $instance['the_address_2'];
		$args['the_address_3'] = $instance['the_address_3'];
		$args['image_path'] = $instance['image_path'];
//		$args['vimeo_path'] = $instance['vimeo_path'];
//		$args['youtube_path'] = $instance['youtube_path'];

		// Sticky posts
//		$args['caller_get_posts'] = $instance['caller_get_posts'] ? '1' : '0';

		// Ordering and such
		if ( $instance['showposts'] )
		$args['showposts'] = (int)$instance['showposts'];
			
		if ( $instance['link_to'] )
		$args['link_to'] = $instance['link_to'];
		
		if ( $instance['link_txt'] )
		$args['link_txt'] = $instance['link_txt'];
		
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

		<li class="widget-container of_contact_info_widget">

		<?php if ( function_exists( 'get_the_image' ) && $thumbnail )
			get_the_image( array( 'custom_key' => array( 'Thumbnail', 'thumbnail' ), 'default_size' => 'thumbnail' ) ); ?>

		<?php if ( $display == 'the_content' ) : ?>

			<section class="entry-content">
				<?php the_content( __('Read More', 'of_contact_info_widget') . ' ' . the_title( '"', '"', false ) ); ?>
				<?php wp_link_pages( array( 'before' => '<p class="pages">' . __('Pages:', 'of_contact_info_widget'), 'after' => '</p>' ) ); ?>
			</section>

			<?php else : ?>

			<section class="entry-summary of_contact_info_widget">
				
				<!-- WIDGET TITLE -->
				<?php if ($titlewidget) { ?>
				<h3 class="widget-title"><?php echo $instance['title-widget']; ?></h3>
				<?php } ?>

				
				<!-- IMAGE -->
				<?php
				$image_path = $instance['image_path'];
				if ($image_path) { ?>
				<!--img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $instance['image_path']; ?>&amp;h=180&amp;w=270&amp;zc=1" alt="" /-->
				<img style="margin-bottom:5px;border:none;" src="<?php echo $instance['image_path']; ?>" alt="" />
				<?php } else { // No image to display ?>
				<?php } ?>


				<!-- TITLE -->
				<h3 class="custom-widget-title">
					<a href="<?php echo $instance['link_to']; ?>"><?php echo $instance['title']; ?></a>
				</h3>

				<p class="contact_info_data phone">
				<!-- PHONE -->
				<?php
				$the_phone_1 = $instance['the_phone_1'];
				if ($the_phone_1) {
					echo $instance['the_phone_1'];
					echo '<br/>';
					}
					
				$the_phone_2 = $instance['the_phone_2'];
				if ($the_phone_1) {
					echo $instance['the_phone_2'];
					}
				?>
				</p>
				
				<p class="contact_info_data address">
				<!-- ADDRESS -->
				<?php
				$the_address_1 = $instance['the_address_1'];
				if ($the_address_1) {
					echo $instance['the_address_1'];
					echo '<br/>';
					}
					
				$the_address_2 = $instance['the_address_2'];
				if ($the_address_2) {
					echo $instance['the_address_2'];
					echo '<br/>';
					}
					
				$the_address_3 = $instance['the_address_3'];
				if ($the_address_3) {
					echo $instance['the_address_3'];
					}
				?>
				</p>
				
				<!-- TEXT CONTENT -->
				<p><?php echo do_shortcode( stripslashes( $instance['text_content_txt'] ) ); ?></p>
				
				<!-- LINK -->
				<a class="link_txt" href="<?php echo do_shortcode( stripslashes( $instance['link_to'] ) ); ?>"><?php echo do_shortcode( stripslashes( $instance['link_txt'] ) ); ?></a>

			</section><!-- .entry-summary -->

			<?php endif; ?>

		</li><!-- .of_contact_info_widget -->

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
		$instance['the_phone_1'] = $new_instance['the_phone_1'];
		$instance['the_phone_2'] = $new_instance['the_phone_2'];
		$instance['the_address_1'] = $new_instance['the_address_1'];
		$instance['the_address_2'] = $new_instance['the_address_2'];
		$instance['the_address_3'] = $new_instance['the_address_3'];
		$instance['image_path'] = $new_instance['image_path'];
/*		$instance['vimeo_path'] = $new_instance['vimeo_path'];
		$instance['youtube_path'] = $new_instance['youtube_path'];*/

		$instance['thumbnail'] = ( isset( $new_instance['thumbnail'] ) ? 1 : 0 );
		$instance['wp_reset_query'] = ( isset( $new_instance['wp_reset_query'] ) ? 1 : 0 );
//		$instance['caller_get_posts'] = ( isset( $new_instance['caller_get_posts'] ) ? 1 : 0 );
		
		$instance['showposts'] = '1';
		
		$instance['link_to'] = strip_tags( $new_instance['link_to'] );
		$instance['link_txt'] = strip_tags( $new_instance['link_txt'] );
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
			'title-widget' => 'Contact Info Widget',
//			'title' => __( '', $this->textdomain ),
			'title' => '',
			'vimeo_path' => '',
			'youtube_path' => '',
			'text_content_txt' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since...',
			'display' => 'ul',
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => 'DESC',
			'orderby' => 'date',
			'ignore_sticky_posts' => true,
			'wp_reset_query' => true,
			'link_txt' => 'Google Map',
			'link_to' => 'http://maps.google.com/maps'
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
			<p><img src="<?php echo $instance['image_path']; ?>" style="max-width:290px;" alt="" /></p>
			<?php } else { ?>
			<p><img src="<?php echo get_template_directory_uri(); ?>/admin/widgets/ph_contact_info_widget.png" alt="" /></p>
			<?php } ?>

			<!-- Image path -->
			<p style="margin-bottom:3px;"><strong>Image URL Path</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'image_path' ); ?>" name="<?php echo $this->get_field_name( 'image_path' ); ?>" value="<?php echo $instance['image_path']; ?>" /></p>

			<!-- Title -->
			<p style="margin-bottom:3px;"><strong>Title</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>

			<!-- PHONE 1 -->
			<p style="margin-bottom:3px;"><strong>Phone 1</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'the_phone_1' ); ?>" name="<?php echo $this->get_field_name( 'the_phone_1' ); ?>" value="<?php echo $instance['the_phone_1']; ?>" /></p>
			
			<!-- PHONE 2 -->
			<p style="margin-bottom:3px;"><strong>Phone 2</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'the_phone_2' ); ?>" name="<?php echo $this->get_field_name( 'the_phone_2' ); ?>" value="<?php echo $instance['the_phone_2']; ?>" /></p>
			
			<!-- ADDRESS 1 -->
			<p style="margin-bottom:3px;"><strong>Address 1</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'the_address_1' ); ?>" name="<?php echo $this->get_field_name( 'the_address_1' ); ?>" value="<?php echo $instance['the_address_1']; ?>" /></p>
			
			<!-- ADDRESS 2 -->
			<p style="margin-bottom:3px;"><strong>Address 2</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'the_address_2' ); ?>" name="<?php echo $this->get_field_name( 'the_address_2' ); ?>" value="<?php echo $instance['the_address_2']; ?>" /></p>
			
			<!-- ADDRESS 3 -->
			<p style="margin-bottom:3px;"><strong>Address 3</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'the_address_3' ); ?>" name="<?php echo $this->get_field_name( 'the_address_3' ); ?>" value="<?php echo $instance['the_address_3']; ?>" /></p>
	
			<!-- Vimeo path
			<p style="margin-bottom:3px;"><strong>Embed Vimeo Video</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">eg: <strong>http://player.vimeo.com/video/</strong>VIDEO_ID</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'vimeo_path' ); ?>" name="<?php echo $this->get_field_name( 'vimeo_path' ); ?>" value="" /></p>
 -->
			<!-- YouTube path
			<p style="margin-bottom:3px;"><strong>Embed YouTube Video</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">eg: <strong>http://www.youtube.com/embed/</strong>VIDEO_ID</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'youtube_path' ); ?>" name="<?php echo $this->get_field_name( 'youtube_path' ); ?>" value="" />
			</p>
 -->
			<!-- Text Content -->
			<p style="margin-bottom:3px;"><strong>Text content</strong></p>
			<p><textarea style="width:103%;" id="<?php echo $this->get_field_id( 'text_content_txt' ); ?>" name="<?php echo do_shortcode( stripslashes( $this->get_field_name( 'text_content_txt' ) ) ); ?>" cols="60" rows="5"><?php echo do_shortcode( stripslashes( $instance['text_content_txt'] ) ); ?></textarea></p>

			<!-- Link text -->
			<p style="margin-bottom:3px;"><strong>Link Text</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'link_txt' ); ?>" name="<?php echo $this->get_field_name( 'link_txt' ); ?>" value="<?php echo $instance['link_txt']; ?>" /></p>

			<!-- Link to -->
			<p style="margin-bottom:3px;"><strong>Link URL</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'link_to' ); ?>" name="<?php echo $this->get_field_name( 'link_to' ); ?>" value="<?php echo $instance['link_to']; ?>" /></p>
		
		</div>
		
		<div style="clear:both;">&nbsp;</div>

		<?php
		}
	}

?>
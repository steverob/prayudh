<?php

/*
	LATEST WORK WIDGET

	----------------------------------------------------------------------------------- */


	// Widget class
	class of_latest_work_widget extends WP_Widget {


/*
	Widget Setup
	----------------------------------------------------------------------------------- */

	function of_Latest_Work_Widget() {

		// Widget settings
		$widget_ops = array(
			'classname' => 'widget_latest_work',
			'description' => __('Your latest work, everywhere!', 'of_latest_work_widget')
		);

		// Widget control settings
		/*$control_ops = array(
			'width' => 240,
			'height' => 350,
			'id_base' => 'of_latest_work_widget'
		);*/

		// Create the widget
//		$this->WP_Widget( 'of_latest_work_widget', __('# Latest Work', 'of_latest_work_widget'), $widget_ops, $control_ops ); // Only if $control_ops uncommented.
		$this->WP_Widget( 'of_latest_work_widget', __('# Latest Work', 'of_latest_work_widget'), $widget_ops );

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

		$showposts = $instance['showposts'];
		$category_name = $instance['category_name'];

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

		?>



		<!-- BEGIN PORTFOLIO LIST -->
		<ul>

			<?php // START PORTFOLIO LOOP
			$query = new WP_Query();
			// $query->query('post_type=portfolio&posts_per_page=-1'); // only for latest-portfolio-posts-home.php
			$query->query( array('post_type'=>'portfolio', 'posts_per_page'=>$showposts, 'orderby' => 'date' ) ); // @since Spark 1.0 - Query added for the new portfolio filter in the homepage.
			while ($query->have_posts()) : $query->the_post();
			$terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
			?>

			<?php
			$custom = get_post_custom($post->ID);
			// $screenshot_url = $custom["screenshot_url"][0];
			// $website_url = $custom["website_url"][0];
			$portfolio_desc = $custom["portfolio_desc"][0];
			$lightbox_path = $custom["lightbox_path"][0];
			?>

			<!-- BEGIN PORTFOLIO ITEM -->
			<li class="item" data-id="id-<?php echo($query->current_post + 1); ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>all">

				<?php
				// if featured image is setup
				if ( has_post_thumbnail() ) { ?>

				<!--a id="box" href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a-->

				<?php
				// NOT USED BECAUSE WE OPEN THE LIGHTBOX FROM PORTFOLIO POST.
				/*
				// Retrieves the attachment for the lightbox. The image is automatically retrieved from the Media Library.
				$attachment_id = get_post_thumbnail_id($post->ID); // Defines ID for image
				$width = '100%'; // Set the width
				$image_attributes = wp_get_attachment_image_src( $attachment_id, $width ); // returns an array
				*/
				?>
				
				<?php
				// Use Lightbox only if image or video
				if ($lightbox_path) { // display the magnify ?>
				<div class="portfolio-thumbnail">
					<a href="<?php echo $lightbox_path ?>" data-rel="prettyPhoto" title="<?php the_title_attribute(); ?>">
				<?php } else { // display the arrow ?>
				<div class="portfolio-thumbnail-no-lightbox">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php } // end if lightbox ?>
						<span class="overlay" style="opacity:0"></span>
						<?php the_post_thumbnail(); ?>
					</a>
				</div><!-- .portfolio-thumbnail -->

				<?php } else { ?>

					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php the_title_attribute(); ?>" /></a>

				<?php } // if has_post_thumbnail ?>


				<div class="portfolio-content">
					<h3 class="custom-widget-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<!--?php
							$thetitle = $post->post_title; /* or you can use get_the_title() */
							$getlength = strlen($thetitle);
							$thelength = 100;
							echo substr($thetitle, 0, $thelength);
							if ($getlength > $thelength) echo "...";
							?-->
							<?php the_title(); ?>
						</a>
					</h3>
					<?php if ($portfolio_desc) { ?><p class="portfolio-item-desc"><?php //the_excerpt(); ?><?php echo $portfolio_desc ?></p><?php } ?>
					<!--section class="latest_work_cat">Category: <span><?php echo $category_name ?></span></section-->
				</div><!-- .portfolio-content -->

			</li><!-- .item -->
			<!-- END PORTFOLIO ITEM -->

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			<!-- END PORTFOLIO LOOP -->
		</ul><!-- .portfolio-list -->
		<!-- END PORTFOLIO LIST -->




		<?php
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
			'title' => 'Latest Work',
			'category_name' => $category_name,
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


			<!-- Category Name
			<p style="margin-bottom:3px;"><strong>Category Name</strong></p>
			<p>
				<select id="<?php echo $this->get_field_id( 'category_name' ); ?>" name="<?php echo $this->get_field_name( 'category_name' ); ?>" class="widefat" style="width:100%;">
					<option <?php if ( !$instance['category_name'] ) echo ' selected="selected"'; ?> value=""></option>
					<?php $cats = get_categories( array('taxonomy' => 'portfolio_categories') );?>
					<?php foreach ( $cats as $cat ) : ?>
						<option <?php if ( $cat->slug == $instance['category_name'] ) echo 'selected="selected"'; ?>><?php echo $cat->slug; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
 -->

			<!-- Showposts -->
			<p style="margin-bottom:3px;"><strong>Number of Posts</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" value="<?php echo $instance['showposts']; ?>" /></p>

		</div>

		<div style="clear:both;">&nbsp;</div>

		<?php
		}
	}
?>

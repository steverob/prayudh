<?php

/*
	LATEST TWEETS WIDGET

	----------------------------------------------------------------------------------- */


	// Widget class
	class of_latest_tweet_widget extends WP_Widget {


/*
	Widget Setup
	----------------------------------------------------------------------------------- */
	
	function of_Latest_Tweet_Widget() {

		// Widget settings
		$widget_ops = array(
			'classname' => 'of_latest_tweet_widget',
			'description' => __('Show your tweets', 'of_latest_tweet_widget')
		);

		// Widget control settings
		/*$control_ops = array(
			'width' => 300,
			'height' => 350,
			'id_base' => 'of_latest_tweet_widget'
		);*/

		// Create the widget
//		$this->WP_Widget( 'of_latest_tweet_widget', __('# Latest Tweets','of_latest_tweet_widget'), $widget_ops, $control_ops ); // Only if $control_ops uncommented.
		$this->WP_Widget( 'of_latest_tweet_widget', __('# Latest Tweets','of_latest_tweet_widget'), $widget_ops );

	}



/*
	FRONT-END
	Display Widget
	----------------------------------------------------------------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$postcount = $instance['postcount'];
		$tweet_text = $instance['tweet_text'];

		// Before widget (defined by theme functions file)
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;

		// Display Latest Tweets
	 	?>
		
		<div id="twitter_div" class="clearfix">
			<ul id="twitter_update_list">
				<li>&nbsp;</li>
			</ul>
			<a href="http://twitter.com/<?php echo $username ?>" id="twitter-link"><?php echo $tweet_text ?></a>
		</div>
		<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
		<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username ?>.json?callback=twitterCallback2&amp;count=<?php echo $postcount ?>"></script>
	
		<?php 

		// After widget (defined by theme functions file)
		echo $after_widget;
	
	}


/*
	Update Widget
	----------------------------------------------------------------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
		$instance['tweet_text'] = strip_tags( $new_instance['tweet_text'] );

		return $instance;
	}


/*
	Widget Settings (Displays the widget settings controls on the widget panel)
	----------------------------------------------------------------------------------- */

	function form( $instance ) {

		// Set up default widget settings
		$defaults = array(
			'title' => 'Latest Tweets',
			'username' => 'mattiaviviani',
			'postcount' => '3',
			'tweet_text' => 'follow @mattiaviviani',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="width:218px">

			<!-- Widget Title -->
			<p style="margin-bottom:3px;"><strong>Widget Title</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>

			<!-- Username -->
			<p style="margin-bottom:3px;"><strong>Username</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">e.g. mattiaviviani</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" /></p>

			<!-- Postcount -->
			<p style="margin-bottom:3px;"><strong>Number of Tweets</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">Display max 20</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" /></p>

			<!-- Tweet_text -->
			<p style="margin-bottom:3px;"><strong>Follow Me Button</strong></p>
			<p style="font-size:10px;margin-bottom:5px;color:#999;">eg: Follow Me on Twitter</p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'tweet_text' ); ?>" name="<?php echo $this->get_field_name( 'tweet_text' ); ?>" value="<?php echo $instance['tweet_text']; ?>" /></p>

		</div>

		<div style="clear:both;">&nbsp;</div>

		<?php
		}
	}
?>

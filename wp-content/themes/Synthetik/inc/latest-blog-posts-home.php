	
	<div class="homepage-top"></div>

	<?php // LATEST BLOG POSTS HOMEPAGE ?>

	<?php
	$latest_postperpage = get_option('of_latest_postperpage');
	$latest_posts_cat = get_option('of_latest_posts_cat');
	$latest_blog_posts_title = get_option('of_latest_blog_posts_title');
	$latest_blog_posts_desc = get_option('of_latest_blog_posts_desc');
	?>

	<?php	
	$cat_term_id = get_cat_ID( $latest_posts_cat );
	$args = array(
		'posts_per_page'=> $latest_postperpage, // Number of latest posts that will be shown.
		'ignore_sticky_posts'=>1,
		'category__in' => $cat_term_id
		);
	$categories=get_categories($args);				
	$my_query = new WP_Query($args);
	$wp_query = $my_query;
		if( $my_query->have_posts() ) {
	?>


	<!-- BEGIN LATEST BLOG POSTS HOMEPAGE -->
	<!--div id="latest-blog-posts-home-head">
		<h2 class="latest-blog-posts-title"><?php echo $latest_blog_posts_title; ?></h2>
	</div-->
	
	<!--a class="slideToggle" href="#">Click</a-->


	<div id="latest-blog-posts-home">
		<!--div id="latest-blog-posts-home-head">
			<h2 class="latest-blog-posts-title"><?php echo $latest_blog_posts_title; ?></h2>
			<p class="title-desc"><?php echo $latest_blog_posts_desc; ?></p>
		</div-->

		<ul class="blog-list-home">
			
			<div class="latest-blog-header">
				<h2 class="latest-blog-posts-title"><?php echo $latest_blog_posts_title; ?></h2>
				<p class="title-desc"><?php echo $latest_blog_posts_desc; ?></p>
			</div><!-- .latest-blog-header -->

			<?php
			while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

			<li class="item">

				<!--
				// the_post_thumbnail down here.
				-->
				
			<!-- DISPLAY THUMBNAIL -->
			<?php if( get_option('of_latest_blog_posts_home_thumbnail') == 'true') { ?>
				
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="latest-thumb-home">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<span class="overlay" style="opacity:0"></span>
						<?php the_post_thumbnail(); ?>
					</a>
				</div><!-- .latest-thumb-home -->
				<?php } else { ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php the_title(); ?>" /></a>
				<?php } ?>

			<?php } // END if( get_option('of_latest_blog_posts_home_thumbnail') == 'true') ?>

				<div class="latest-blog-posts">
					<p class="latest-blog-posts-date"><?php the_time('M d, Y') ?></p>
					<h3 class="blog-home-title"><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
						<!--?php
						$thetitle = $post->post_title; /* or you can use get_the_title() */
						$getlength = strlen($thetitle);
						$thelength = 21;
						echo substr($thetitle, 0, $thelength);
						if ($getlength > $thelength) echo "...";
						?-->
						<?php the_title(); ?>
						</a>
					</h3>
					<?php the_excerpt(); ?>
				</div><!-- .latest-blog-posts -->

			</li>

			<?php } // END while( $my_query->have_posts()
			
		echo '</ul></div>'; // END #latest-blog-posts-home

		} // END if( $my_query->have_posts()

	wp_reset_query(); ?>

	<!-- END LATEST BLOG POSTS HOMEPAGE -->

	<div class="homepage-bottom"></div>


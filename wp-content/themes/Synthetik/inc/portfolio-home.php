	
	<div class="homepage-top"></div>

	<?php // PORTFOLIO HOMEPAGE ?>

	<?php
	$latest_portfolio_postperpage = get_option('of_latest_portfolio_postperpage');
	$latest_portfolio_title = get_option('of_latest_portfolio_title');
	$latest_portfolio_desc = get_option('of_latest_portfolio_desc');
	?>


	<!-- BEGIN LATEST PORTFOLIO HOMEPAGE -->
	<div id="latest-portfolio-posts-home">

		<h1 class="latest-portfolio-posts-title"><?php echo $latest_portfolio_title; ?></h1>
		<?php if ($latest_portfolio_desc) { ?><p class="title-desc"><?php echo $latest_portfolio_desc; ?></p><?php } ?>


		
		<!-- BEGIN PORTFOLIO LIST -->
		<!--ul class="portfolio-list" style="float:left;clear:both;height:auto;"-->
		<ul class="portfolio-list">
	
			<?php // START PORTFOLIO LOOP
			$query = new WP_Query();
			// $query->query('post_type=portfolio&posts_per_page=-1'); // only for latest-portfolio-posts-home.php
			$query->query( array('post_type'=>'portfolio', 'posts_per_page'=> $latest_portfolio_postperpage ) ); // @since Spark 1.0 - Query added for the new portfolio filter in the homepage.
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
					<h3 class="portfolio-item-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
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
					
					<?php if ($portfolio_desc) { ?>
					<p class="portfolio-item-desc">
						<!--?php the_excerpt(); ?-->
						<!--?php echo $portfolio_desc ?-->
						<?php
							$getlength = strlen($portfolio_desc);
							$thelength = 50000;
							echo substr($portfolio_desc, 0, $thelength);
							if ($getlength > $thelength) echo "...";
						?>
					</p>
					<?php } ?>

				</div><!-- .portfolio-content -->

			</li><!-- .item -->
			<!-- END PORTFOLIO ITEM -->

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			<!-- END PORTFOLIO LOOP -->
		</ul><!-- .portfolio-list -->
		<!-- END PORTFOLIO LIST -->

	
	</div><!-- #latest-portfolio-posts-home -->
	<!-- END LATEST PORTFOLIO HOMEPAGE -->
	
	<div class="homepage-bottom"></div>



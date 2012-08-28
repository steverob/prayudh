
	<?php // LATEST PORTFOLIO POSTS HOMEPAGE ?>

	<?php
	$latest_portfolio_postperpage = get_option('of_latest_portfolio_postperpage');
	$latest_portfolio_title = get_option('of_latest_portfolio_title');
	$latest_portfolio_desc = get_option('of_latest_portfolio_desc');
	?>



	<!-- BEGIN LATEST PORTFOLIO POSTS HOMEPAGE -->
	<div id="latest-portfolio-posts-home">
		<h1><?php echo $latest_portfolio_title; ?></h1>
		<?php if ($latest_portfolio_desc) { ?><p class="title-desc"><?php echo $latest_portfolio_desc; ?></p><?php } ?>
		
		<!-- BEGIN PORTFOLIO LIST -->
		<ul class="portfolio-list">
			<?php
			// START LOOP
			$query = new WP_Query();
			$query->query( array('post_type'=>'portfolio', 'posts_per_page'=> $latest_portfolio_postperpage ) );
			while ($query->have_posts()) : $query->the_post();
			$terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
			?>

			<?php	
			$custom = get_post_custom($post->ID);
//			$screenshot_url = $custom["screenshot_url"][0];
//			$website_url = $custom["website_url"][0];
			$portfolio_desc = $custom["portfolio_desc"][0];
			?>
			
			<!-- BEGIN PORTFOLIO ITEM -->
			<li class="item">

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

				<!-- BEGIN ITEM CONTENT -->
				<div class="item-content">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<!--?php the_title(); ?-->
						<?php
							$thetitle = $post->post_title; /* or you can use get_the_title() */
							$getlength = strlen($thetitle);
							$thelength = 21;
							echo substr($thetitle, 0, $thelength);
								if ($getlength > $thelength) echo "...";
							?>
						</a>
					</h3>	
					<p class="portfolio-description"><?php //the_excerpt(); ?><?php echo $portfolio_desc ?></p>
				</div><!-- .item-content -->
				<!-- BEGIN ITEM CONTENT -->

			</li><!-- .item -->
			<!-- BEGIN PORTFOLIO ITEM -->

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>

		</ul><!-- .portfolio-list -->
		<!-- BEGIN PORTFOLIO LIST -->

	</div><!-- #latest-portfolio-posts-home -->

	<!-- END LATEST PORTFOLIO POSTS HOMEPAGE  -->




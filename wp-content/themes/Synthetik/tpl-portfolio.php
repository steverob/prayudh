<?php
/**
 * Template Name: Portfolio
 *
 */

get_header();

$portfolio_page_desc = get_option('of_portfolio_page_desc');

?>

<div id="container">

	<div id="content" class="portfolio" role="main">

		<!--div id="breadcrumb"><?php the_breadcrumb(); ?></div-->
		
		<section class="page-line-top"></section>
		<h1 class="page-title"><?php the_title(); ?></h1>
		
		<?php if ($portfolio_page_desc) { ?><p class="title-desc"><?php echo $portfolio_page_desc; ?></p><?php } ?>
		
		<?php the_post(); // Needed to retrieve the page content ?>
		<div class="entry-content entry-content-portfolio">
			<?php the_content(); ?>
		</div><!-- .entry-content -->




		<!-- BEGIN PORTFOLIO LIST -->
		<!--ul class="portfolio-list" style="float:left;clear:both;height:auto;"-->
		<ul class="portfolio-list">
	
			<?php // START PORTFOLIO LOOP
			$query = new WP_Query();
			$query->query('post_type=portfolio&posts_per_page=-1');
			while ($query->have_posts()) : $query->the_post();
			$terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
			?>

			<?php
			$custom = get_post_custom($post->ID);
//			$screenshot_url = $custom["screenshot_url"][0];
//			$website_url = $custom["website_url"][0];
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
		
	</div><!-- #content .portfolio -->
	
	<!--div class="portfolio-bottom"></div-->

</div><!-- #container .portfolio-wrapper -->

<?php get_footer(); ?>

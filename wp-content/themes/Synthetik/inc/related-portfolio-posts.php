	<?php // RELATED PORTFOLIO POSTS - CUSTOM TAXONOMY (by tags) ?>
	
	<?php
		$related_postperpage = get_option('of_related_portfolio_postperpage');
		$orig_post = $post;
		global $post;
		$postnum = 0;
	
		$terms = get_the_terms( $post->ID , 'portfolio_tags', 'string');
	
		if ($terms) {
			foreach($terms as $term) $tag_ids[] = $term->term_id;
			$args = array(
				'portfolio_tags' => $term->slug,
				'post__not_in' => array($post->ID),
				'posts_per_page' => $related_postperpage, // Number of related posts that will be shown.
				'ignore_sticky_posts' => 1
			);

		$my_query = new wp_query( $args );
			if( $my_query->have_posts() ) {

	echo '<div id="related-posts">
			<h3 class="section_title">You may also like</h3>
			<ul class="related-list">';

				while( $my_query->have_posts() ) {
					$my_query->the_post();
					$postnum++;
	?>

				<li class="item">

					<?php if ( has_post_thumbnail() ) { ?>
					<div class="related-thumb">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
							<span class="overlay" style="opacity:0"></span>
							<?php the_post_thumbnail(); ?>
						</a>
					</div><!-- .related-thumb -->
					<?php } else { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php the_title(); ?>" /></a>
					<?php } ?>

					<div class="related-content">
						<h3 class="related-item-title"><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
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
						<!--p class="related-posts-date"><?php the_time('M j, Y') ?></p-->
					</div><!-- .related-content -->

				</li><!-- .post-# .item -->
				
			<?php }
				echo '</ul></div><!-- #related-posts -->';
			}
		}
				
		$post = $orig_post;
		wp_reset_query();
		?>



		
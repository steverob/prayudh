
	<?php $slider_height = get_option('of_slider_height'); ?>

	<!-- BEGIN SLIDER -->
	<div id="slider-wrapper">

		<div id="slider" class="nivoSlider" style="height:<?php echo $slider_height // allows to see the preloader ?>px">

			<?php foreach($slides as $num => $slide) : ?>

			<?php if($slide['src'] != '') {
			echo '<a href="' . $slide['link'] . '">'; ?>
			<!--span class="slider_overlay" style="opacity:100"></span-->
			<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $slide['src'] ?>&amp;h=<?php echo $slider_height ?>&amp;w=980&amp;zc=1&amp;q=100"  alt="<?php the_title(); ?>" title="<?php echo $slide['caption'] ?>"></a>
			
			<?php } else { ?>

			<img src="<?php echo get_template_directory_uri(); ?>/images/ph-slider.jpg" alt="<?php the_title(); ?>">

			<?php } endforeach; ?>

		</div><!-- #slider .nivoSlider -->

	</div><!-- #slider-wrapper -->
	<!-- END SLIDER -->
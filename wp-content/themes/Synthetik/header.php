<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<!-- A Mattia Viviani Wordpress Theme design - http://www.mattiaviviani.com - http://twitter.com/mattiaviviani - http://themeforest.net/user/mav -->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!-- Use the .htaccess and remove these lines to avoid edge case issues.
	 More info: h5bp.com/b/378 -->
<!--meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"-->

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mav' ), max( $paged, $page ) );

?></title>
<meta name="description" content="Wordpress Theme">
<meta name="author" content="Mattia Viviani - http://mattiaviviani.com">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.php" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen" />
<!-- Start iPhone -->
<meta name="viewport" content="width=1020">
<!--link media="only screen and (max-device-width: 1020px)" href="<?php echo get_template_directory_uri(); ?>/css/iphone.css" type="text/css" rel="stylesheet" /-->
<!--link rel="apple-touch-icon" href="<?php echo bloginfo('template_url'); ?>/images/iphone.png" />
<link rel="apple-touch-icon-precomposed" href="<?php echo bloginfo('template_url'); ?>/images/iphone.png" /-->
<!-- End iPhone -->

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!-- Calling plugins.css after wp_head(); because of style conflict -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/plugins.css" />

<!-- Calling jQuery Library -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.6.1.min.js"></script>

<!-- Modernizr enables HTML5 elements & feature detects -->
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-1.7.min.js"></script>

<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" />
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix('.overlay');
	</script>
<![endif]-->

<!--[if IE 8]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie9.css" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

</head>

<body <?php body_class(); ?>>

<!-- BEGIN WRAPPER -->
<div id="wrapper" class="hfeed">

	<!-- BEGIN HEADER -->
	<div id="header-wrapper">

		<section id="header">

			<div id="masthead" class="clearfix">

				<header id="branding" role="banner">

					<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
					<<?php echo $heading_tag; ?> id="site-title">

					<!-- BEGIN LOGO AREA -->
					<span>
						<a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<?php if ( $logo = get_option('of_logo') ) { ?>
								<img class="logo" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
								<?php } else { //bloginfo( 'name' ); ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" />
							<?php } ?>
						</a>
					</span>
					<!-- END LOGO AREA -->

					<!--div id="site-description"><?php bloginfo( 'description' ); ?></div-->

					</<?php echo $heading_tag; ?>>


					<!-- BEGIN MAIN MENU -->
					<nav id="access" role="navigation">
						<?php //  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff ?>
						<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mav' ); ?>"><?php _e( 'Skip to content', 'mav' ); ?></a></div>

						<?php
						/* 
				 	 	 *	Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.
				 	 	 *	The menu assiged to the primary position is the one used.
				 	 	 *	If none is assigned, the menu with the lowest ID is used.
				 	 	 */
						?>
						<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
						
						<!-- Add <li></li> class for the home button -->
						<script type="text/javascript">
							$('.menu-header ul').prepend('<li><a <?php if (is_front_page()) : ?>class="home-button-current"<?php else : ?>class="home-button"<?php endif ?> href="<?php bloginfo('url'); ?>/">Home</a></li>');
							$(".menu ul li a:first").addClass("<?php if (is_front_page()) : ?>home-button-current<?php else : ?>home-button<?php endif ?>");
						</script>
						
						<div class="searchform-header"><?php get_search_form(); ?></div>
						
						
					</nav><!-- #access -->
					<!-- END MAIN MENU -->

				</header><!-- #branding -->

			</div><!-- #masthead -->

		</section><!-- #header -->

	</div><!-- #header-wrapper -->
	<!-- END HEADER -->


	<!-- BEGIN MAIN-CONTENT -->
	<div id="main-content">

		<div class="main-top"></div>
		<div id="main">

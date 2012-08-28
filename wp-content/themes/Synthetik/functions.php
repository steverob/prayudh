<?php

/*
	FUNCTIONS AND DEFINITIONS

	----------------------------------------------------------------------------------- */
 

/*
	Set the content width based on the theme's design and stylesheet.
	----------------------------------------------------------------------------------- */

	if ( ! isset( $content_width ) )
		$content_width = 640;

	// Tell WordPress to run mav_setup() when the 'after_setup_theme' hook is run.
	add_action( 'after_setup_theme', 'mav_setup' );

	if ( ! function_exists( 'mav_setup' ) ):


/*
	Sets up theme defaults and registers support for various WordPress features.
	----------------------------------------------------------------------------------- */

	function mav_setup() {

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 290, 190, true );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'mav', TEMPLATEPATH . '/languages' );

		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Header Navigation', 'mav' ),
			'secondary' => __( 'Footer Navigation', 'mav' )
		) );

		// This theme allows users to set a custom background
		add_custom_background( 'mav_custom_background_callback' );
		
		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See twentyeleven_admin_header_style(), below.
//		add_custom_image_header('header_style', 'admin_header_style');
	
	}
	endif;
?>
<?php

/*
	CUSTOM BACKGROUND CALLBACK (mav_custom_background_callback)
	----------------------------------------------------------------------------------- */
	function mav_custom_background_callback() {

		/* Get the background image. */
		$image = get_background_image();

		/* If there's an image, just call the normal WordPress callback. We won't do anything here. */
		if ( !empty( $image ) ) {
			_custom_background_cb();
			return;
		}

		/* Get the background color. */
		$color = get_background_color();

		/* If no background color, return. */
		if ( empty( $color ) )
			return;

		/* Use 'background' instead of 'background-color'. */
		$style = "background: #{$color};";

	?>
	<style type="text/css">body { <?php echo trim( $style ); ?> }</style>
<?php

}

/*
	Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	----------------------------------------------------------------------------------- */
	
	function mav_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'mav_page_menu_args' );


/*
	Sets the post excerpt length to 40 characters.
	----------------------------------------------------------------------------------- */

	function mav_excerpt_length( $length ) {
		return 20; // 40 default
	}
	add_filter( 'excerpt_length', 'mav_excerpt_length' );


/*
	Returns a "Continue Reading" link for excerpts
	----------------------------------------------------------------------------------- */
	function mav_continue_reading_link() {
		return ' <a class="more-link" href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav"></span>', 'mav' ) . '</a>';
	}


/*
	Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and mav_continue_reading_link().
	----------------------------------------------------------------------------------- */
	function mav_auto_excerpt_more( $more ) {
		return ' &hellip;' . mav_continue_reading_link();
	}
	add_filter( 'excerpt_more', 'mav_auto_excerpt_more' );


/*
	Adds a pretty "Continue Reading" link to custom post excerpts.
	----------------------------------------------------------------------------------- */

	function mav_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= mav_continue_reading_link();
		}
		return $output;
	}
	add_filter( 'get_the_excerpt', 'mav_custom_excerpt_more' );


/*
	Remove inline styles printed when the gallery shortcode is used.
	----------------------------------------------------------------------------------- */

	add_filter( 'use_default_gallery_style', '__return_false' );


/*
	Gravatar
	----------------------------------------------------------------------------------- */
	
	add_filter( 'avatar_defaults', 'newgravatar' );  

	function newgravatar ($avatar_defaults) {
    	$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';
		$avatar_defaults[$myavatar] = "Theme Gravatar";
			return $avatar_defaults;
		}


/*
	Deprecated way to remove inline styles printed when the gallery shortcode is used.

	This function is no longer needed or used. Use the use_default_gallery_style
	filter instead, as seen above.
	----------------------------------------------------------------------------------- */

	function mav_remove_gallery_css( $css ) {
		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}

	// Backwards compatibility with WordPress 3.0.
	if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
		add_filter( 'gallery_style', 'mav_remove_gallery_css' );

	if ( ! function_exists( 'mav_comment' ) ) :


/*
	Template for comments and pingbacks.
	----------------------------------------------------------------------------------- */

	function mav_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'mav' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'mav' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mav' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mav' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->

		<?php
		break;
		case 'pingback'  :
		case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'mav' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'mav' ), ' ' ); ?></p>
		<?php
		break;
		endswitch;
	}
	endif;


/*
	Register widgetized areas
	----------------------------------------------------------------------------------- */
	function mav_widgets_init() {
	
		// Area 1a, located at the top of the sidebar.
		register_sidebar( array(
			'name' => __( 'Sidebar Primary', 'mav' ),
			'id' => 'primary-widget-area',
			'description' => __( 'Located in the primary blog sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 1b single-portfolio, located at the top of the sidebar. It replaces the Sidebar Primary if we are in the singe portfolio page.
		register_sidebar( array(
			'name' => __( 'Sidebar Portfolio Primary', 'mav' ),
			'id' => 'primary-widget-area-portfolio',
			'description' => __( 'Located in the primary portfolio sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
		register_sidebar( array(
			'name' => __( 'Sidebar Secondary', 'mav' ),
			'id' => 'secondary-widget-area',
			'description' => __( 'Located in the secondary sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );


		// Area 3, located on the homepage.
		register_sidebar( array(
			'name' => __( 'Homepage First', 'mav' ),
			'id' => 'first-homepage-widget-area',
			'description' => __( 'Located in the first homepage sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 4, located on the homepage.
		register_sidebar( array(
			'name' => __( 'Homepage Second', 'mav' ),
			'id' => 'second-homepage-widget-area',
			'description' => __( 'Located in the second homepage sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 5, located on the homepage.
		register_sidebar( array(
			'name' => __( 'Homepage Third', 'mav' ),
			'id' => 'third-homepage-widget-area',
			'description' => __( 'Located in the third homepage sidebar widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 6, located in the footer. Empty by default.
		register_sidebar( array(
			'name' => __( 'Footer First', 'mav' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'Located in the first footer widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 7, located in the footer. Empty by default.
		register_sidebar( array(
			'name' => __( 'Footer Second', 'mav' ),
			'id' => 'second-footer-widget-area',
			'description' => __( 'Located in the second footer widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 8, located in the footer. Empty by default.
		register_sidebar( array(
			'name' => __( 'Footer Third', 'mav' ),
			'id' => 'third-footer-widget-area',
			'description' => __( 'Located in the third footer widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Area 9, located in the footer. Empty by default.
		register_sidebar( array(
			'name' => __( 'Footer Fourth', 'mav' ),
			'id' => 'fourth-footer-widget-area',
			'description' => __( 'Located in the fourth footer widget area.', 'mav' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}

	// Register sidebars by running mav_widgets_init() on the widgets_init hook
	add_action( 'widgets_init', 'mav_widgets_init' );




/*
	REGISTER WIDGETS
	----------------------------------------------------------------------------------- */

	function of_register_widgets() {

		// Load each widget file
		require_once( 'admin/widgets/widget-custom-content.php' );
		require_once( 'admin/widgets/widget-latest-tweets.php' );
		require_once( 'admin/widgets/widget-blog-posts.php' );
		require_once( 'admin/widgets/widget-latest-work.php' );
		require_once( 'admin/widgets/widget-contact-info.php' );

		// Register each widget
		register_widget( 'of_Custom_Content_Widget' );
		register_widget( 'of_Latest_Tweet_Widget' );
		register_widget( 'of_Blog_Posts_Widget' );
		register_widget( 'of_Latest_Work_Widget' );
		register_widget( 'of_Contact_Info_Widget' );
	}

	add_action( 'widgets_init', 'of_register_widgets' );


	// Unregister all default WP Widgets
	function unregister_default_wp_widgets() {
		unregister_widget('WP_Widget_Calendar');
/*		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');	*/
	}
	
	add_action('widgets_init', 'unregister_default_wp_widgets', 1);



/*
	Removes the default styles that are packaged with the Recent Comments widget.
	----------------------------------------------------------------------------------- */
	function mav_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'mav_remove_recent_comments_style' );

	if ( ! function_exists( 'mav_posted_on' ) ) :

	// Prints HTML with meta information for the current post—date/time and author.
	function mav_posted_on() {
//		printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'mav' ),
//		printf( __( '<span class="%1$s entry-date-img">%2$s</span> <span class="meta-sep user-img">%3$s</span>', 'mav' ),
		printf( __( '<span class="%1$s"></span> %2$s <span class="meta-sep">by</span> %3$s', 'mav' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'mav' ), get_the_author() ),
				get_the_author()
			)
		);
	}
	endif;


	if ( ! function_exists( 'mav_posted_in' ) ) :

	// Prints HTML with meta information for the current post (category, tags and permalink).
	function mav_posted_in() {
		// Retrieves tag list of current post, separated by commas.
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$posted_in = __( 'This entry was posted in %1$s', 'mav' );
//			$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'mav' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>', 'mav' );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>', 'mav' );
		}
		// Prints the string, replacing the placeholders.
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	}
	endif;



/*
	OPTIONS FRAMEWORK FUNCTIONS
	----------------------------------------------------------------------------------- */

	/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OF_FILEPATH', TEMPLATEPATH);
		define('OF_DIRECTORY', get_template_directory_uri());
	} else {
		define('OF_FILEPATH', STYLESHEETPATH);
		define('OF_DIRECTORY', get_stylesheet_directory_uri());
	}

	/* These files build out the options interface.  Likely won't need to edit these. */

	require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
	require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

	/* These files build out the theme specific options and associated functions. */

	require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
	require_once (OF_FILEPATH . '/admin/theme-functions.php'); 		// Theme actions based on options settings



/*
	CUSTOM LOGO LOGIN
	----------------------------------------------------------------------------------- */

	add_action("login_head", "my_login_head");
	function my_login_head() {
		echo "
		<style>
			body.login #login h1 a {
			background: url('".get_bloginfo('template_url')."/images/custom-logo-login.png') no-repeat scroll center top transparent;
		}
		</style>
			";
	}



/*
	SLIDER MANAGER
	----------------------------------------------------------------------------------- */

	require_once(STYLESHEETPATH . '/admin/slidermanager/loader.php');



/*
	BREADCRUMBS
	----------------------------------------------------------------------------------- */

	function the_breadcrumb() {
		if (!is_home()) {
			echo '<a href="';
//			echo get_option('home');
			echo home_url();
			echo '">';
			bloginfo('name');
			echo "</a> » ";
			if (is_category() || is_single()) {
				the_category(' / ');
				if (is_single()) {
					echo " » ";
					the_title();
				}
			} elseif (is_page()) {
				echo the_title();
			}
		}
	}




/*
	PORTFOLIO
	----------------------------------------------------------------------------------- */

	// Create The Custom Post Type

	add_action('init', 'create_portfolio');

	function create_portfolio() {
    	$labels = array(
			'name' => __( 'Portfolio' , 'mav' ),
			'singular_name' => __( 'Portfolio' , 'mav' ),
			'add_new' => _x( 'Add New' , 'slide' , 'mav' ),
			'add_new_item' => __( 'Add New Portfolio' , 'mav' ),
			'edit_item' => __( 'Edit Portfolio' , 'mav' ),
			'new_item' => __( 'New Portfolio' , 'mav' ),
			'view_item' => __( 'View Portfolio' , 'mav' ),
			'search_items' => __( 'Search Portfolio' , 'mav' ),
			'not_found' =>  __( 'No portfolios found' , 'mav' ),
			'not_found_in_trash' => __( 'No portfolios found in Trash' , 'mav' ),
			'parent_item_colon' => ''
	  	);
	  
		$portfolio_args = array(
			'labels' => $labels,
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'rewrite' => array('slug' => __( 'portfolio' , 'mav' )),
			'show_ui' => true, 
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
//			'supports' => array('title','editor','thumbnail','custom-fields', 'excerpt')
			'supports' => array('title','editor','thumbnail')//,
//			'taxonomies' => array('category', 'post_tag')
		);
	  
		register_post_type(__( 'portfolio' , 'mav' ), $portfolio_args);
	}



/*
	PORTFOLIO - CUSTOM TAXONOMY
	----------------------------------------------------------------------------------- */

	// Build Tags Taxonomies for portfolio page
	function portfolio_categories_build_taxonomies() {
		register_taxonomy(__( "portfolio_categories" , 'mav' ), array(__( "portfolio" , 'mav' )), array("hierarchical" => true, "label" => __( "Portfolio Categories" , 'mav' ), "singular_label" => __( "Portfolio Categories" , 'mav' ), "rewrite" => array('slug' => 'portfolio_categories', 'hierarchical' => true)));
	}
	add_action( 'init', 'portfolio_categories_build_taxonomies', 0 );



	// Build Tags Taxonomies for single-portfolio
	function portfolio_tags_build_taxonomies() {
//		register_taxonomy('portfolio_tags', 'post', array( 'hierarchical' => false,  'label' => 'portfolio_tags', 'query_var' => true, 'rewrite' => true));
		register_taxonomy(__( "portfolio_tags" , 'mav' ), array(__( "portfolio" , 'mav' )), array("hierarchical" => false, "label" => __( "Portfolio Tags" , 'mav'), 'query_var' => true, "singular_label" => __( "Portfolio Tags" , 'mav' ), "rewrite" => true, "show_in_nav_menus" => false));
	}
	add_action( 'init', 'portfolio_tags_build_taxonomies', 0 );



/*
	PORTFOLIO - META BOX
	----------------------------------------------------------------------------------- */

	// Adding the Meta Box
	add_action( 'add_meta_boxes', 'cd_meta_box_add' );
		function cd_meta_box_add()
		{
			add_meta_box( 'my-meta-box-id', 'Portfolio Options', 'cd_meta_box_cb', 'portfolio', 'normal', 'high' );
		}
	
	// Rendering the Meta Box
	function cd_meta_box_cb( $post )
	{
		$values = get_post_custom( $post->ID );
		$portfolio_desc = isset( $values['portfolio_desc'] ) ? esc_attr( $values['portfolio_desc'][0] ) : '';
		$lightbox_path = isset( $values['lightbox_path'] ) ? esc_attr( $values['lightbox_path'][0] ) : '';
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		?>
		<p>
			<label for="portfolio_desc"><strong>Post Description</strong></label><br/>
			<label>Please, enter a short description, the text otherwise will be cropped.</label><br/>
			<input style="width:98%;margin:9px 0 15px 0" type="text" name="portfolio_desc" id="portfolio_desc" value="<?php echo $portfolio_desc; ?>" />
		</p>
		
		<p>
			<label for="lightbox_path"><strong>URL Link for Lightbox</strong> (it can be image or video).</label><br/>
			<!--label>Allowed Video Content: Flash, YouTube, Vimeo, QuickTime.</label><br/-->
			<input style="width:98%;margin:9px 0 15px 0" type="text" name="lightbox_path" id="lightbox_path" value="<?php echo $lightbox_path; ?>" />
			<strong>Sample video formats:</strong><br/>
			<label>Vimeo: http://vimeo.com/5721659</label><br/>
			<label>YouTube: http://www.youtube.com/watch?v=pkqzFUhGPJg</label><br/>
			<label>More at: <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/</a></label>
			<br/>
		</p>

		<?php	
	}
	
	// Saving the Data
	add_action( 'save_post', 'cd_meta_box_save' );
	function cd_meta_box_save( $post_id )
	{
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post' ) ) return;
	
		// now we can actually save the data
		$allowed = array( 
			'a' => array( // on allow a tags
				'href' => array() // and those anchords can only have href attribute
			)
		);
	
		// Probably a good idea to make sure your data is set
		if( isset( $_POST['portfolio_desc'] ) )
			update_post_meta( $post_id, 'portfolio_desc', wp_kses( $_POST['portfolio_desc'], $allowed ) );

		if( isset( $_POST['lightbox_path'] ) )
			update_post_meta( $post_id, 'lightbox_path', wp_kses( $_POST['lightbox_path'], $allowed ) );

	}



/*
	Custom Columns
	----------------------------------------------------------------------------------- */

	add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
	add_action("manage_posts_custom_column",  "portfolio_columns_display");

	function portfolio_edit_columns($portfolio_columns){
		$portfolio_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Item Title",
			"portfolio_categories" => "Category",
			"portfolio_tags" => "Tags",
			"portfolio_description" => "Description",
		);
		return $portfolio_columns;
	}

	function get_portfolio_categories_id($cat_name){
		$term = get_term_by('name', $cat_name, 'portfolio_categories');
		return $term->term_id;
	}

	function get_portfolio_tags_id($tag_name){
		$term = get_term_by('name', $tag_name, 'portfolio_tags');
		return $term->term_id;
	}

	function portfolio_columns_display($portfolio_columns){
		switch ($portfolio_columns)
		{

			case "portfolio_categories":
/*				$terms = get_the_terms( get_the_ID(), 'portfolio-categories' );
				foreach ($terms as $term) {
					echo preg_replace('/\s+/', '-', $term->name). ' ';
					}*/
				echo get_the_term_list($post->ID, __( 'portfolio_categories' , 'mav' ), '', ', ','');
				break;

			case "portfolio_tags":
				echo get_the_term_list($post->ID, __( 'portfolio_tags' , 'mav' ), '', ', ','');
				break;

			case "portfolio_description":
				the_excerpt();
				break;

			}
		}


	
/*
	SHORTCODES
	----------------------------------------------------------------------------------- */
	
	/* THE YEAR */
	function the_year() {
		$the_year = date('Y');
    	return '' . $the_year . '';
	}
	add_shortcode('the_year', 'the_year');
	// Usage: [the_year]



	/* SITE LINK */
	function site_link() {
		$site_link = home_url();
		$site_name = get_bloginfo( 'name' );
    	return '<a href="' . $site_link . '">' . $site_name . '</a>';
	}
	add_shortcode('site_link', 'site_link');
	// Usage: [site_link]



	/* FACEBOOK SHARE BUTTON */
	function fbshare_script() {
		return '<a name="fb_share"></a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"></script></a>';
	}
	add_shortcode( 'fbshare', 'fbshare_script' );
	// Usage: [fbshare]

	
	
	/* FACEBOOK LIKE BUTTON */
	function fb_like( $atts, $content=null ){
	/* Author: Nicholas P. Iler
 	 * URL: http://www.ilertech.com/2011/06/add-facebook-like-button-to-wordpress-3-0-with-a-simple-shortcode/
 	 */
	extract(shortcode_atts(array(
		'send' => 'false',
		'layout' => 'standard',
		'show_faces' => 'true',
		'width' => 'auto', // 400px
		'action' => 'like',
		'font' => '',
		'colorscheme' => 'light',
		'ref' => '',
		'locale' => 'en_US',
		'appId' => '' // Put your AppId here is you have one
    ), $atts));

    $fb_like_code = <<<HTML
        <div id="fb-root"></div><script src="http://connect.facebook.net/$locale/all.js#appId=$appId&amp;xfbml=1"></script>
        <fb:like ref="$ref" href="$content" layout="$layout" colorscheme="$colorscheme" action="$action" send="$send" width="$width" show_faces="$show_faces" font="$font"></fb:like>
HTML;
 
		return $fb_like_code;
	}
	add_shortcode('fb', 'fb_like');

	/*<!-- Facebook Like button -->
	<?php echo do_shortcode("[fb]"); ?>*/
	
	// Usage 1: [fb]
	// Usage 2: [fb send='true']
	// Usage 3: [fb action='recommend']
	// Usage 4: [fb layout='button_count']
	// Usage 5: [fb send='true' layout='button_count']
	// Usage 6: [fb action='recommend' layout='button_count']
	// Usage 7: [fb layout='box_count']




	/* TWITTER SHARE BUTTON */
	function twitter( $atts, $content=null ){
 
	/* Author: Nicholas P. Iler
 	 * URL: http://www.ilertech.com/2011/07/add-twitter-share-button-to-wordpress-3-0-with-a-simple-shortcode/
 	 */
 
	extract(shortcode_atts(array(
		'url' => null,
		'counturl' => null,
		'via' => '',
		'text' => '',
		'related' => '',
		'countbox' => 'none', // none, horizontal, vertical

	), $atts));
 
	// Check for count url and set to $url if not provided
    if($counturl == null) $counturl = $url;
 
    $twitter_code = <<<HTML
    <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	<a href="http://twitter.com/share" class="twitter-share-button"
    data-url="$url"
    data-counturl="$counturl"
    data-via="$via"
    data-text="$text"
    data-related="$related"
    data-count="$countbox"></a>
HTML;
 
    	return $twitter_code;

	}
	add_shortcode('t', 'twitter');

	/*<!-- Twitter Share Shortcode -->
	<?php echo do_shortcode("[t]"); ?>
	
	<!-- Twitter Share Shortcode - Get current link in loop -->
	<?php echo do_shortcode("[t url='get_permalink();']"); ?>*/

	// Usage 1: [t url='get_permalink();']
	// Usage 2: [t countbox="horizontal/vertical"]



	function twitter_share(){ // (Must be called while in the loop)
 
	/* Author: Nicholas P. Iler
 	 * URL: http://www.ilertech.com/2011/07/add-twitter-share-button-to-wordpress-3-0-with-a-simple-shortcode/
 	 */
		// Get the title and url of posts and pages
    	$title  = get_the_title();
    	$url    = get_permalink();

    	// Shorten title if its too long
    	if(strlen($title) < 115){
        	$shortenedTitle = substr($title, 0, 115);
        	$shortenedTitle .= '...';
		}

		echo do_shortcode("[t url='$url' text='$shortenedTitle']"); // Shortcode
	}
	
	// Usage in the loop: <!--?php twitter_share(); ?-->
	// Usage 1: [t]
	// Usage 2: [t related='Mav: Premium WordPress Themes']



	function twitter_follow($atts, $content=null){
	/* Author: Nicholas P. Iler
 	 * URL: http://www.ilertech.com
 	 */
		extract(shortcode_atts(array(
        	'show_count' => false,
        	'button' => 'blue', // blue, grey
        	'text_color' => '',
        	'link_color' => '',
        	'lang' => '', // en, fr, de, it, es, ko, ja | ref: http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
        	'width' => '',
        	'align' => ''
       	), $atts));
 
        $twitter_follow_code = <<<HTML
    	<a href="http://twitter.com/$content" class="twitter-follow-button"
        	data-show-count="$show_count"
        	data-button="$button"
        	data-text-color="$text_color"
        	data-link-color="$link_color"
        	data-lang="$lang"
        	data-width="$width"
        	data-align="$align">Follow @$content</a>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
HTML;
 
		return $twitter_follow_code;
	}
	add_shortcode('tf', 'twitter_follow');

	/*<!-- Twitter Follow Shortcode -->
	<?php echo do_shortcode("[tf]mattiaviviani[/tf]"); ?>*/

	// Usage 1: [tf]mattiaviviani[/tf]
	// Usage 2: [tf show_count=true]mattiaviviani[/tf]
	// Usage 3: [tf show_count=true button='grey']mattiaviviani[/tf]



	/* GOOGLE+ */
	function plus1( $atts, $content=null ){
	/* Author: Nicholas P. Iler
 	 * URL: http://www.ilertech.com/2011/06/add-google-1-to-wordpress-3-0-with-a-simple-shortcode/
 	 */
		extract(shortcode_atts(array(
			'lang' => 'en-US',
        	'parsetags' => 'onload',
        	'count' => 'true',
        	'size' => 'medium',
        	'callback' => '',
 
    	), $atts));
 
    	// Check for count url and set to URL if not provided
    	if($content != null) $url = "href='$content'";
 
    	$plus1_code = <<<HTML
 
    	<g:plusone $url count="$count" size="$size" callback="$callback"></g:plusone>
HTML;
 
    	return $plus1_code;
	}

	// Add meta tag for front page
	function addPlus1Meta(){
		if(is_home()){
			echo "<link rel='canonical' href='" . site_url() ."' />";
		}
 
		echo <<<HTML
 
		<script type="text/javascript">
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
HTML;
	}
 
	add_shortcode('p1', 'plus1');
	add_action('wp_footer', 'addPlus1Meta');
	
	/*<!-- Google Plus1 Shortcode w/ Callback -->
	<?php echo do_shortcode("[p1]http://www.google.com[/p1]"); ?>*/
	
	// Usage 1: [p1 size='small']
	// Usage 2: [p1 size='medium']
	// Usage 3: [p1 size='standard']
	// Usage 4: [p1 size='tall']
	// Usage 5: [p1 count=false]
	// Other options are: callback, lang, load. Ref – http://code.google.com/apis/+1button/




	/* YOUTUBE */
	function youtube_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'video'  => '',
			'width'  => '590',
			'height' => '355'
			), $atts));

		return '<div class="youtube_video"><object type="application/x-shockwave-flash" style="width:'.$width.'px; height:'.$height.'px;" data="http://www.youtube.com/v/'.$video.'&amp;hl=en_US&amp;fs=1&amp;"><param name="movie" value="http://www.youtube.com/v/'.$video.'&amp;hl=en_US&amp;fs=1&amp;" /></object></div>';
	}

	add_shortcode('youtube', 'youtube_shortcode');

	// Usage 1: [youtube video="fxs970FMYIo"/]
	// Usage 2: [youtube video="fxs970FMYIo" width="300" height="200" /]


	/* VIMEO */
    // Define shortcode to embed Vimeo Videos
    function vimeo_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            "id" => '',
            "width" => '684',
            "height" => '385'
        ), $atts));
    	return '<div class="vimeo_video"><iframe src="http://player.vimeo.com/video/'.$id.'?title=0&byline=0&portrait=0&color=ffffff" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe></div>';
	}

	add_shortcode("vimeo", "vimeo_shortcode");

	// Usage 1: [vimeo id="29262251"/]
	// Usage 2: [vimeo id="29262251" width="342" height="192"]




	/* BUTTONS */
	function button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => '',
			'link' => '',
			'size' => '',
      	), $atts ) );

		return '<a href="' . $link . '" class="button ' . $color . ' ' . $size . '">' . do_shortcode($content) . '</a>';
	}
		
	add_shortcode('button', 'button_shortcode');

	// Usage: [button color="blue, green, orange, yellow, red, teal, purple, pink, aqua, silver, white, black" link="http://...", size="small, medium, big"]



	/* ICON BUTTONS 
	function icon_button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => '',
			'link' => '',
			'size' => '',
      	), $atts ) );

		return '<a href="' . $link . '" class="icon_button ' . $color . ' ' . $size . '">' . do_shortcode($content) . '</a>';
	}
		
	add_shortcode('icon_button', 'icon_button_shortcode');*/



	/* INFO BOXES */
	function box_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'type' => '',
      	), $atts ) );

		return '<div class="box ' . $type . '">' . do_shortcode($content) . '</div>';
	}
		
	add_shortcode('box', 'box_shortcode');
	// Usage: [box type="normal, info, tick, note, alert"][/box]
	
	

	
	/* COLUMNS */
	function shortcodes_one_third( $atts, $content = null ) {
		return '<div class="one_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'shortcodes_one_third');


	function shortcodes_one_third_last( $atts, $content = null ) {
		return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'shortcodes_one_third_last');


	function shortcodes_two_third( $atts, $content = null ) {
		return '<div class="two_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'shortcodes_two_third');


	function shortcodes_two_third_last( $atts, $content = null ) {
		return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'shortcodes_two_third_last');


	function shortcodes_one_half( $atts, $content = null ) {
		return '<div class="one_half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'shortcodes_one_half');


	function shortcodes_one_half_last( $atts, $content = null ) {
		return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'shortcodes_one_half_last');


	function shortcodes_one_fourth( $atts, $content = null ) {
		return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'shortcodes_one_fourth');


	function shortcodes_one_fourth_last( $atts, $content = null ) {
		return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'shortcodes_one_fourth_last');


	function shortcodes_three_fourth( $atts, $content = null ) {
		return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'shortcodes_three_fourth');


	function shortcodes_three_fourth_last( $atts, $content = null ) {
		return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'shortcodes_three_fourth_last');


	function shortcodes_one_fifth( $atts, $content = null ) {
		return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fifth', 'shortcodes_one_fifth');


	function shortcodes_one_fifth_last( $atts, $content = null ) {
		return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fifth_last', 'shortcodes_one_fifth_last');


	function shortcodes_two_fifth( $atts, $content = null ) {
		return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_fifth', 'shortcodes_two_fifth');


	function shortcodes_two_fifth_last( $atts, $content = null ) {
		return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_fifth_last', 'shortcodes_two_fifth_last');


	function shortcodes_three_fifth( $atts, $content = null ) {
		return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fifth', 'shortcodes_three_fifth');


	function shortcodes_three_fifth_last( $atts, $content = null ) {
		return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fifth_last', 'shortcodes_three_fifth_last');


	function shortcodes_four_fifth( $atts, $content = null ) {
		return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('four_fifth', 'shortcodes_four_fifth');


	function shortcodes_four_fifth_last( $atts, $content = null ) {
		return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('four_fifth_last', 'shortcodes_four_fifth_last');


	function shortcodes_one_sixth( $atts, $content = null ) {
		return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_sixth', 'shortcodes_one_sixth');


	function shortcodes_one_sixth_last( $atts, $content = null ) {
		return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_sixth_last', 'shortcodes_one_sixth_last');


	function shortcodes_five_sixth( $atts, $content = null ) {
		return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('five_sixth', 'shortcodes_five_sixth');


	function shortcodes_five_sixth_last( $atts, $content = null ) {
		return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('five_sixth_last', 'shortcodes_five_sixth_last');




	/* TOGGLE */
	function toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'title' => 'toggle'
	), $atts ) );

		$result = '<div class="toggler"><h3 class="toggle"><a href="javascript:void(0);">'.esc_attr($title).'</a></h3>
		<div class="toggle_container">
			<div class="block">
				<p>' . do_shortcode($content) . '</p>
			</div>
		</div>
		</div>';
		return $result;
	}

	add_shortcode('toggle', 'toggle_shortcode');



	/* TABS */
	function tabs_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'titles' => 'tabs',
		), $atts ) );

		$tab_titles  = esc_attr($titles);
		$tab_totals = explode(",", $tab_titles);

		$result = '<div id="tabs">';

		$result .= '<ul class="tabs">';
		$s = 1;
		for ( $i = 0; $i <= count($tab_totals)-1; $i++) {
			$result .= '<li><a href="#tab'.$s++.'">'.trim($tab_totals[$i]).'</a></li>';
		}
		$result .= '</ul>';

		$result .= '<div class="tab_container">';
		$result .= do_shortcode($content);
		$result .= '</div><!-- .tab_container -->'; // close .tab_container
		$result .= '</div><!-- #tabs -->'; // close #tabs

		return $result;	
	}

	add_shortcode('tabs', 'tabs_shortcode');

	function tab_shortcode( $atts, $content = null ) {
		$result = '<div class="tab_content">';
		$result .= do_shortcode($content);
		$result .= '</div><!-- .tab_content -->';
		return $result;
	}

	add_shortcode('tab', 'tab_shortcode');




/*
	THEME UPDATE NOTIFIER
	----------------------------------------------------------------------------------- */

	require('update-notifier.php');




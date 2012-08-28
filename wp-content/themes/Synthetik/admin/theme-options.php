<?php

/*
	THEME OPTIONS

	----------------------------------------------------------------------------------- */
	
	add_action('init', 'of_options');

	if (!function_exists('of_options')) {
	function of_options(){
	
	// VARIABLES
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$shortname = "of";

	// Populate OptionsFramework option in array for use in theme
	global $of_options;
	$of_options = get_option('of_options');

	$GLOBALS['template_path'] = OF_DIRECTORY;

	// Access the WordPress Categories via an Array
	$of_categories = array();
	$of_categories_obj = get_categories('hide_empty=0');
	foreach ($of_categories_obj as $of_cat) {
    	$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
	$categories_tmp = array_unshift($of_categories, "Select a category:");

	// Access the WordPress Pages via an Array
	$of_pages = array();
	$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
	foreach ($of_pages_obj as $of_page) {
    	$of_pages[$of_page->ID] = $of_page->post_name; }
	$of_pages_tmp = array_unshift($of_pages, "Select a page:");

	// Image Alignment radio box
	$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

	// Image Links to Options
	$options_image_link_to = array("image" => "The Image","post" => "The Post");

	// Testing
	/*$options_select = array("one","two","three","four","five"); mav */
	$options_select = array("3","6","9","12","15","-1");
	$options_select_2 = array("3","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","-1");
	$blog_options_select = array("3","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","-1");
	$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	$slider_effect_options_select = array(
		"random" => "random",
		"fade" => "fade",
		"fold" => "fold",
		"sliceDown" => "sliceDown",
		"sliceDownLeft" => "sliceDownLeft",
		"sliceUp" => "sliceUp",
		"sliceUpLeft" => "sliceUpLeft",
		"sliceUpDown" => "sliceUpDown",
		"sliceUpDownLeft" => "sliceUpDownLeft",
		"slideInRight" => "slideInRight",
		"slideInLeft" => "slideInLeft",
		"boxRandom" => "boxRandom",
		"boxRain" => "boxRain",
		"boxRainReverse" => "boxRainReverse",
		"boxRainGrow" => "boxRainGrow",
		"boxRainGrowReverse" => "boxRainGrowReverse"
	);

	$slider_slices_options_select = array("15","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15");

	// More Options
	$uploads_arr = wp_upload_dir();
	$all_uploads_path = $uploads_arr['path'];
	$all_uploads = get_option('of_uploads');
	$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15");
	$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
	$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

	$true_false = array("true","false");

	// Stylesheets Reader
	$alt_stylesheet_path = OF_FILEPATH . '/styles/';
	$alt_stylesheets = array();

	if ( is_dir($alt_stylesheet_path) ) {
    	if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        	while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            	if(stristr($alt_stylesheet_file, ".css") !== false) {
                	$alt_stylesheets[] = $alt_stylesheet_file;
            	}
        	}
    	}
	}

	// Set the Options Array
	$options = array();


	// GENERAL SETTINGS
	$options[] = array( "name" => "General Settings",
                    	"type" => "heading"
						);

	// Logo
	$options[] = array( "name" => "Custom Logo",
						"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
						"id" => $shortname."_logo",
							"std" => "",
							"type" => "upload"
						);

	// Layout
	$url =  OF_DIRECTORY . '/admin/images/';
	$options[] = array( "name" => "Main Layout",
						"desc" => "Select main content and sidebar alignment.",
						"id" => $shortname."_layout",
						"std" => "layout-2cr",
						"type" => "images",
						"options" => array(
							'layout-2cr' => $url . '2cr.png',
							'layout-2cl' => $url . '2cl.png')
						);
					
	// Custom Favicon
	$options[] = array( "name" => "Custom Favicon",
						"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
						"id" => $shortname."_custom_favicon",
						"std" => "http://mattiaviviani.com/favicon.ico",
						"type" => "upload"
						);

	// Contact Email
	$options[] = array( "name" => "Contact Email",
						"desc" => "The email address you enter will be used in the Contact Page template.",
						"id" => $shortname."_contact_email",
						"std" => '',
						"type" => "text"
						);

	// Feeds URL
	$options[] = array( "name" => "Feeds URL",
						"desc" => "If you have an alternate feed address you can enter it here to have the theme redirect your feed links.",
						"id" => $shortname."_feed_icon",
						"std" => '', // http://192.168.0.2/wp_themes/spark/wordpress/?feed=rss
						"type" => "text"
						);

	// Tracking Code
	$options[] = array( "name" => "Tracking Code",
						"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
						"id" => $shortname."_google_analytics",
						"std" => "",
						"type" => "textarea"
						);




	// HOMEPAGE OPTIONS
	$options[] = array( "name" => "Homepage",
						"type" => "heading"
						);

	// Home Message
	$options[] = array( "name" => "Enable Homepage Welcome Message",
						"desc" => "Activate to display the home message in the homepage.",
						"id" => $shortname."_home_msg",
						"std" => "false",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Homepage Welcome Message",
						"desc" => "Enter the text you would like to display as a welcome message, it will be displayed below the slider.",
						"id" => $shortname."_home_msg_text",
						"std" => "",
						"type" => "textarea"
						);

					
	// FEATURED - Homepage
	$options[] = array( "name" => "Enable Homepage Widget Area",
						"desc" => "Activate to display the homepage widget area on the Homepage.",
						"id" => $shortname."_homepage_widget_area",
						"std" => "true",
						"type" => "checkbox"
						);


	// Latest Portfolio Posts - Homepage
	$options[] = array( "name" => "Enable Latest Portfolio Posts",
						"desc" => "Activate to display the latest works on the Homepage.",
						"id" => $shortname."_latest_portfolio_posts_home",
						"std" => "false",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Latest Portfolio Posts Title",
						"desc" => "",
						"id" => $shortname."_latest_portfolio_title",
						"std" => "Our Recent Works",
						"type" => "text"
						);

	$options[] = array( "name" => "Description",
						"desc" => "Enter a short description for the portfolio latest entries.",
						"id" => $shortname."_latest_portfolio_desc",
						"std" => "",
						"type" => "textarea"
						);

	$options[] = array( "name" => "Number of Posts",
						"desc" => "Define the number of posts you want to display from the portfolio page (-1 shows all posts).",
						"id" => $shortname."_latest_portfolio_postperpage",
						"std" => "6",
						"type" => "text"
						);


	// Latest Blog Posts - Homepage
	$options[] = array( "name" => "Enable Latest Blog Posts",
						"desc" => "Activate to display the latest posts on the Homepage.",
						"id" => $shortname."_latest_blog_posts_home",
						"std" => "false",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Latest Blog Posts Title",
						"desc" => "",
						"id" => $shortname."_latest_blog_posts_title",
						"std" => "From the Blog",
						"type" => "text"
						);

	$options[] = array( "name" => "Description",
						"desc" => "Enter a short description for the latest blog posts.",
						"id" => $shortname."_latest_blog_posts_desc",
						"std" => "",
						"type" => "textarea"
						);

	$options[] = array( "name" => "Latest Posts Category",
						"desc" => "Select the category you want to display.",
						"id" => $shortname."_latest_posts_cat",
						"std" => "Uncategorized",
						"type" => "select",
						"options" => $of_categories
						);

	$options[] = array( "name" => "Number of Posts",
						"desc" => "Define the number of posts you want to display from the blog page (-1 shows all posts).",
						"id" => $shortname."_latest_postperpage",
						"std" => "2",
						"type" => "text"
						);

	$options[] = array( "name" => "Show Image",
						"desc" => "Activate to display the thumbnail image.",
						"id" => $shortname."_latest_blog_posts_home_thumbnail",
						"std" => "false",
						"type" => "checkbox"
						);




	// SLIDER OPTIONS
	$options[] = array( "name" => "Slider",
						"type" => "heading"
						);

	$options[] = array( "name" => "Enable Homepage Slider",
						"desc" => "Activate to display the homepage slider. The images will be automatically cropped and resize to 980px width. Use the <strong><a href=\"?page=slidermanager\">Slider Manager</a></strong> to add images.",
						"id" => $shortname."_home_slider",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Slider Height",
						"desc" => "Enter the height value of your slider (default 360).",
						"id" => $shortname."_slider_height",
						"std" => "360",
						"type" => "text"
						);

	$options[] = array( "name" => "Effect",
						"desc" => "Select the slider effect.",
						"id" => $shortname."_slider_effect",
						"std" => "",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $slider_effect_options_select
						);

	$options[] = array( "name" => "Slices",
						"desc" => "For slice animations, 15 by default.",
						"id" => $shortname."_slider_slices",
						"std" => "-1",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $slider_slices_options_select
						);

	$options[] = array( "name" => "animSpeed",
						"desc" => "Slide transition speed, 400 by default.",
						"id" => $shortname."_slider_animSpeed",
						"std" => "400",
						"type" => "text"
						);

	$options[] = array( "name" => "pauseTime",
						"desc" => "How long each slide will show, 6000 by default.",
						"id" => $shortname."_slider_pauseTime",
						"std" => "6000",
						"type" => "text"
						);

	$options[] = array( "name" => "directionNav",
						"desc" => "Next & Prev navigation arrows, <i>true</i> by default.",
						"id" => $shortname."_slider_directionNav",
						"std" => "-1",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $true_false
						);

	$options[] = array( "name" => "controlNav",
						"desc" => "1,2,3... navigation, <i>true</i> by default.",
						"id" => $shortname."_slider_controlNav",
						"std" => "-1",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $true_false
						);



	// PORTFOLIO OPTIONS
	$options[] = array( "name" => "Portfolio",
						"type" => "heading"
						);

	// Portfolio Page ID
	$options[] = array( "name" => "Portfolio Page ID",
						"desc" => "The ID you enter will be used to make works properly the \"Back to Portfolio\" link button in the single portfolio page.",
						"id" => $shortname."_portfolio_page_id",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Portfolio Description",
						"desc" => "Enter a description for the portfolio page template.",
						"id" => $shortname."_portfolio_page_desc",
						"std" => "",
						"type" => "textarea"
						);
	
	
	// Related Portfolio Posts
	$options[] = array( "name" => "Enable Related Portfolio Posts",
						"desc" => "Activate to display the Related Posts for the single portfolio page (by post tags).",
						"id" => $shortname."_related_portfolio_posts",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Number of Related Portfolio Posts",
						"desc" => "Select the number of posts you want to display as related content.<br/>Default value 3, -1 shows all posts.",
						"id" => $shortname."_related_portfolio_postperpage",
						"std" => "",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select_2
						);




	// BLOG OPTIONS
	$options[] = array( "name" => "Blog",
						"type" => "heading"
						);

	// Blog Page Title
	$options[] = array( "name" => "Blog Page Title",
						"desc" => "Eg: Our Blog",
						"id" => $shortname."_blog_page_title",
						"std" => 'Blog',
						"type" => "text"
						);

	$options[] = array( "name" => "Blog Description",
						"desc" => "Enter a description for the blog/posts page.",
						"id" => $shortname."_blog_page_desc",
						"std" => "",
						"type" => "textarea"
						);

	// Related Blog Posts
	$options[] = array( "name" => "Enable Related Blog Posts",
						"desc" => "Activate to display the Related Posts for the single blog page (by post tags).",
						"id" => $shortname."_related_posts",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Number of Related Blog Posts",
						"desc" => "Select the number of posts you want to display as related content.<br/>Default value 3, -1 shows all posts.",
						"id" => $shortname."_related_postperpage",
						"std" => "3",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select_2
						);


	// Social Icons - Footer
	$options[] = array( "name" => "Footer",
                    	"type" => "heading"
						);

	// Footer Text (Left)
	$options[] = array( "name" => "Footer Text (Left)",
						"desc" => "Enter the text you would like to display in the footer of your site. (eg: &copy; [the_year] [site_link].)",
						"id" => $shortname."_footer_left",
						"std" => "",
						"type" => "textarea"
						);

	// Footer Text (Right)
	$options[] = array( "name" => "Footer Text (Right)",
						"desc" => "Enter the text you would like to display in the footer of your site.",
						"id" => $shortname."_footer_right",
						"std" => 'Follow me on <a href="http://twitter.com/pit_prayudh">Twitter</a> / <a href="#">Facebook</a>',
						"type" => "textarea"
						);

/*	$options[] = array( "name" => "Enable Email Icon",
						"desc" => "Activate to display the email icon.",
						"id" => $shortname."_footer_email_icon",
						"std" => "true",
						"type" => "checkbox"
						);*/

	$options[] = array( "name" => "Enable Faceboook Share Button",
						"desc" => "Activate to display the Faceboook Share button in the left footer area.",
						"id" => $shortname."_fb_share_button",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Enable Twitter Share Button",
						"desc" => "Activate to display the Twitter Share button in the left footer area.",
						"id" => $shortname."_twitter_share_button",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Enable Google+ Button",
						"desc" => "Activate to display the Google Plus button in the left footer area.",
						"id" => $shortname."_plusone_foo_button",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Facebook",
						"desc" => "Enter your Facebook account URL.",
						"id" => $shortname."_facebook_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Twitter",
						"desc" => "Enter your Twitter account URL.",
						"id" => $shortname."_twitter_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "LinkedIn",
						"desc" => "Enter your LinkedIn account URL.",
						"id" => $shortname."_linkedin_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Delicious",
						"desc" => "Enter your Delicious account URL.",
						"id" => $shortname."_delicious_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Flickr",
						"desc" => "Enter your Flickr account URL.",
						"id" => $shortname."_flickr_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Tumblr",
						"desc" => "Enter your Tumblr account URL.",
						"id" => $shortname."_tumblr_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Vimeo",
						"desc" => "Enter your Vimeo account URL.",
						"id" => $shortname."_vimeo_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "YouTube",
						"desc" => "Enter your YouTube account URL.",
						"id" => $shortname."_youtube_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "deviantART",
						"desc" => "Enter your deviantART account URL.",
						"id" => $shortname."_deviantart_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Last.fm",
						"desc" => "Enter your Last.fm account URL.",
						"id" => $shortname."_lastfm_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Digg",
						"desc" => "Enter your Digg account URL.",
						"id" => $shortname."_digg_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Stumbleupon",
						"desc" => "Enter your Stumbleupon account URL.",
						"id" => $shortname."_stumbleupon_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Aol",
						"desc" => "Enter your Aol account URL.",
						"id" => $shortname."_aol_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "MySpace",
						"desc" => "Enter your MySpace account URL.",
						"id" => $shortname."_myspace_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Netvibes",
						"desc" => "Enter your Netvibes account URL.",
						"id" => $shortname."_netvibes_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Newsvine",
						"desc" => "Enter your Newsvine account URL.",
						"id" => $shortname."_newsvine_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Reddit",
						"desc" => "Enter your Reddit account URL.",
						"id" => $shortname."_reddit_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "ShareThis",
						"desc" => "Enter your ShareThis account URL.",
						"id" => $shortname."_sharethis_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Technorati",
						"desc" => "Enter your Technorati account URL.",
						"id" => $shortname."_technorati_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Yahoo",
						"desc" => "Enter your Yahoo account URL.",
						"id" => $shortname."_yahoo_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Yelp",
						"desc" => "Enter your Yelp account URL.",
						"id" => $shortname."_yelp_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Foursquare",
						"desc" => "Enter your Foursquare account URL.",
						"id" => $shortname."_foursquare_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Posterous",
						"desc" => "Enter your Posterous account URL.",
						"id" => $shortname."_posterous_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "MobileMe",
						"desc" => "Enter your Me account URL.",
						"id" => $shortname."_me_icon",
						"std" => '',
						"type" => "text"
						);


	// Styling Options

	$options[] = array( "name" => "Styling Options",
						"type" => "heading"
						);

	$options[] = array( "name" => "Primary link color (default #3399cc)",
						"desc" => "The primary link color.",
						"id" => $shortname."_primary_link",
						"std" => "#3399cc",
						"type" => "color"
						);

	$options[] = array( "name" => "Secondary link color (default #3399cc)",
						"desc" => "The secondary link color.",
						"id" => $shortname."_secondary_link",
						"std" => "#3399cc",
						"type" => "color"
						);
	
	$options[] = array( "name" => "Selection (default #3399cc)",
						"desc" => "The selection color.",
						"id" => $shortname."_selection_color",
						"std" => "#3399cc",
						"type" => "color"
						);

/*	$options[] = array( "name" => "Body color (default #ffffff)",
						"desc" => "The body background color.",
						"id" => $shortname."_body_color",
						"std" => "#ffffff",
						"type" => "color"
						);

	$options[] = array( "name" => "Header color (default #ffffff)",
						"desc" => "The header background color.",
						"id" => $shortname."_header_color",
						"std" => "#ffffff",
						"type" => "color"
						);

	$options[] = array( "name" => "Footer color (default #fdfdfd)",
						"desc" => "The footer background color.",
						"id" => $shortname."_footer_color",
						"std" => "#fdfdfd",
						"type" => "color"
						);
*/

	$options[] = array( "name" => "Custom CSS",
                    	"desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    	"id" => $shortname."_custom_css",
                    	"std" => "",
                    	"type" => "textarea"
						);

/*	$options[] = array( "name" => "Theme Stylesheet",
						"desc" => "Select your themes alternative color scheme. You may find the css file in the style folder.",
						"id" => $shortname."_alt_stylesheet",
						"std" => "alternate.css",
						"type" => "select",
						"options" => $alt_stylesheets);*/

/*	$options[] = array( "name" => "Example Options",
						"type" => "heading"
						);

	$options[] = array( "name" => "Typograpy",
						"desc" => "This is a typographic specific option.",
						"id" => $shortname."_typograpy",
						"std" => array('size' => '16','unit' => 'em','face' => 'verdana','style' => 'bold italic','color' => '#123456'),
						"type" => "typography"
						);
					
	$options[] = array( "name" => "Border",
						"desc" => "This is a border specific option.",
						"id" => $shortname."_border",
						"std" => array('width' => '2','style' => 'dotted','color' => '#444444'),
						"type" => "border"
						);
					
	$options[] = array( "name" => "Colorpicker",
						"desc" => "No color selected.",
						"id" => $shortname."_example_colorpicker",
						"std" => "",
						"type" => "color"
						);
					
	$options[] = array( "name" => "Colorpicker (default #2098a8)",
						"desc" => "Color selected.",
						"id" => $shortname."_example_colorpicker_2",
						"std" => "#2098a8",
						"type" => "color"
						);
                    
	$options[] = array( "name" => "Upload Basic",
						"desc" => "An image uploader without text input.",
						"id" => $shortname."_uploader",
						"std" => "",
						"type" => "upload_min"
						);
                                    
	$options[] = array( "name" => "Input Text",
						"desc" => "A text input field.",
						"id" => $shortname."_test_text",
						"std" => "Default Value",
						"type" => "text"
						);
                                        
	$options[] = array( "name" => "Input Checkbox (false)",
						"desc" => "Example checkbox with false selected.",
						"id" => $shortname."_example_checkbox_false",
						"std" => "false",
						"type" => "checkbox"
						);
                                        
	$options[] = array( "name" => "Input Checkbox (true)",
						"desc" => "Example checkbox with true selected.",
						"id" => $shortname."_example_checkbox_true",
						"std" => "true",
						"type" => "checkbox"
						);
                                                                               
	$options[] = array( "name" => "Input Select Small",
						"desc" => "Small Select Box.",
						"id" => $shortname."_example_select",
						"std" => "three",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select
						);

	$options[] = array( "name" => "Input Select Wide",
						"desc" => "A wider select box.",
						"id" => $shortname."_example_select_wide",
						"std" => "two",
						"type" => "select2",
						"options" => $options_radio
						);

	$options[] = array( "name" => "Input Radio (one)",
						"desc" => "Radio select with default of 'one'.",
						"id" => $shortname."_example_radio",
						"std" => "one",
						"type" => "radio",
						"options" => $options_radio
						);
					
	$url =  get_bloginfo('stylesheet_directory') . '/admin/images/';
	$options[] = array( "name" => "Image Select",
						"desc" => "Use radio buttons as images.",
						"id" => $shortname."_images",
						"std" => "",
						"type" => "images",
						"options" => array(
							'warning.css' => $url . 'warning.png',
							'accept.css' => $url . 'accept.png',
							'wrench.css' => $url . 'wrench.png'
							)
						);
                                        
	$options[] = array( "name" => "Textarea",
						"desc" => "Textarea description.",
						"id" => $shortname."_example_textarea",
						"std" => "Default Text",
						"type" => "textarea"
						);

	$options[] = array( "name" => "Multicheck",
						"desc" => "Multicheck description.",
						"id" => $shortname."_example_multicheck",
						"std" => "two",
						"type" => "multicheck",
						"options" => $options_radio
						);
                                        
	$options[] = array( "name" => "Select a Category",
						"desc" => "A list of all the categories being used on the site.",
						"id" => $shortname."_example_category",
						"std" => "Select a category:",
						"type" => "select",
						"options" => $of_categories
						);

*/


		update_option('of_template',$options);			  
		update_option('of_themename',$themename);
		update_option('of_shortname',$shortname);

		}
	}
?>

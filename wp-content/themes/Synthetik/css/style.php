<?php 
header("Content-type: text/css");

require_once('../../../../wp-load.php');

$primary_link = get_option('of_primary_link');
$secondary_link = get_option('of_secondary_link');
$selection_color = get_option('of_selection_color');
/*$body_color = get_option('of_body_color');
$header_color = get_option('of_header_color');
$footer_color = get_option('of_footer_color');*/

?>
/* Dynamic CSS
-------------------------------------------------------------------------------*/
/*body {
	background: <?php echo $body_color ?>;
}

#header {
	background: <?php echo $header_color ?>;
}

#footer {
	background: <?php echo $footer_color ?>;
}*/

a:link, a:visited {
	color: <?php echo $primary_link ?>;
}

a:active, a:hover {
	color: <?php echo $secondary_link ?>;
	color: #4a525a;
/*	text-decoration: none;*/
}

.entry-title a:active,
.entry-title a:hover {
	color: <?php echo $primary_link ?>;
}

#footer-widget-area .entry-title a:hover {
	color: <?php echo $secondary_link ?>;
}

.entry-meta a:hover, .entry-utility a:hover {
	color: <?php echo $secondary_link ?>;
}

/*.tag-links a,
.tag-links a:link,
.tag-links a:visited {color: <?php echo $secondary_link ?>;}*/

.tag-links a:active,
.tag-links a:hover {
	color: #fff;
	background: <?php echo $secondary_link ?>;
/*	border: 1px solid <?php echo $secondary_link ?>;*/
}

::-moz-selection { background: <?php echo $selection_color ?>; }

::selection { background: <?php echo $selection_color ?>; }

::-webkit-selection { background: <?php echo $selection_color ?>; }

#site-info a:hover {
	color: <?php echo $primary_link ?>;
}

.commentlist .bypostauthor cite {
	color: <?php echo $secondary_link ?> !important;
}

a#cancel-comment-reply-link:hover {
	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
}

#respond .form-submit input {
	background: <?php echo $primary_link ?>;
	border: 1px solid <?php echo $primary_link ?>;
	color: #fff;
}

#respond .form-submit input:hover {
	color: <?php echo $primary_link ?>;
}

#contactForm input.send-button {
	background: <?php echo $primary_link ?>;
	border: 1px solid <?php echo $primary_link ?>;
	color: #fff;
}

#contactForm input.send-button:hover {
	color: <?php echo $primary_link ?>;
}

/*.navigation a:link.back,
.navigation a:visited.back {
	color: <?php echo $primary_link ?>;
}*/

.navigation a:active.back,
.navigation a:hover.back {
	color: <?php echo $secondary_link ?>;
}

#access ul ul li:hover > a {
	background: <?php echo $primary_link ?>;
}

#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
/*	background: <?php echo $primary_link ?>;*/
	color: <?php echo $primary_link ?>;
}

a#twitter-link:hover {
/*	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
	color: #fff;*/
}

#footer-widget-area .widget_nav_menu li a:hover {
	color: <?php echo $secondary_link ?>;
}

.widget-area a:active,
.widget-area a:hover {
	color: <?php echo $primary_link ?>;
}

ul.portfolio-filter li.active a {
/*	border: 1px solid <?php echo $secondary_link ?>;*/
	background: <?php echo $primary_link ?>;
}

/*a.more-link {
	background: <?php echo $primary_link ?>;
}*/

a:hover.more-link {
	color: <?php echo $primary_link ?>;
}

.tagcloud a:hover {
	color: <?php echo $primary_link ?>;
}

#footer-right-side a:hover {
	color: <?php echo $primary_link ?>;
}

.archives-content-month li a:hover,
.archives-content-categories li a:hover,
.archives-content-blog-posts li a:hover {
	color: <?php echo $primary_link ?>;
}

#content h3.portfolio-item-title a:hover {
	color: <?php echo $primary_link ?>;
}

.widget_blog_posts h2.post-title.entry-title a:hover {
	color: <?php echo $secondary_link ?>;
}

.comments-link a:hover {
	color: #fff;
	background: <?php echo $secondary_link ?>;
	border: 1px solid <?php echo $secondary_link ?>;
}

ul.portfolio-filter a:hover {
	color: #fff !important;
	background: <?php echo $secondary_link ?>;
}

blockquote {
	border-left: 3px solid <?php echo $secondary_link ?>;
	color: <?php echo $secondary_link ?>;
}

#content blockquote p {
	color: <?php echo $secondary_link ?>;
}

ul.tabs li.active a,
ul.tabs li.active a:hover {
	color: <?php echo $primary_link ?>;
}

h3.toggle.active a {
	color: <?php echo $primary_link ?>;
}

/*#content .latest-blog-posts-date {
	background: <?php echo $secondary_link ?>;
}*/

#access a.home-button-current,
#access a.home-button-current:hover {
/*	background-color: <?php echo $primary_link ?>;*/
}

#access a.home-button,
#access a.home-button-current,
#access a.home-button-current:hover,
#access .menu a.home-button,
#access .menu a.home-button-current,
#access .menu a.home-button-current:hover {
/*	background-color: <?php echo $primary_link ?>;*/
}

#access a.home-button,
#access .menu a.home-button {
	background-color: transparent;
}

#primary h1.widget-title,
#primary h2.widget-title,
#primary h3.widget-title,
#primary h4.widget-title,
#primary h5.widget-title,
#primary h6.widget-title {
	color: <?php echo $primary_link ?>;
}

.commentlist .bypostauthor {
/*	background-color: <?php echo $primary_link ?> !important;*/
}

.reply a:hover {
	background: <?php echo $primary_link ?>;
	border: 1px solid <?php echo $primary_link ?>;
}

.comment-author {
	<!-- border-bottom: 2px solid <?php echo $primary_link ?>; -->
}






<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to mav_comment which is
 * located in the functions.php file.
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'mav' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
//			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'mav' ),
			printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'mav' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav"></span> Older Comments', 'mav' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav"></span>', 'mav' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use mav_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define mav_comment() and that will be used instead.
					 * See mav_comment() in functions.php for more.
					 */
//					wp_list_comments( array( 'callback' => 'mav_comment' ) );
					wp_list_comments( 'avatar_size=60' );
				?>

			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav"></span> Older Comments', 'mav' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav"></span>', 'mav' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'mav' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<!--?php comment_form(); ?-->
<?php
add_filter('comment_form_defaults', 'reply_title');

function reply_title($defaults) {
	$defaults['title_reply'] = 'What do you think?';
//	$defaults['title_reply_to'] = 'Reply to %s';
	return $defaults;
}
?>

<!--?php comment_form($defaults) ?-->
<?php comment_form(); ?>

</div><!-- #comments -->

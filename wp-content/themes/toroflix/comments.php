<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroflix
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<!--<section>-->
<section id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
    <div class="Top AAIco-chat">
        <div class="Title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
                /* translators: 1: title. */
                printf( __( '1 Comment', 'toroflix' ) );
			} else {
				/* translators: 1: comment count number */
                printf( __('%s Comments', 'toroflix'), $comment_count );
			}
			?>
        </div>
    </div>
    
		<?php tr_get_the_comments_navigation(array('screen_reader_text' => '')); ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'short_ping' => true,
                    'avatar_size' => 0
				) );
			?>
		</ul><!-- .comment-list -->

		<?php tr_get_the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'toroflix' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().
    
	comment_form(); ?>

</section>
<!--</section>-->
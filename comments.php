<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package kihon
 * @since 1.0.0
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

<div id="comments" class="comments-area">
	<div class="content-container">

		<?php // You can start editing here -- including this comment! ?>

		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					printf( _nx( 'Comments on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'kihon' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'callback'   => 'kihon_list_comments'
					) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'kihon' ); ?></h2>
				<?php
					paginate_comments_links( array(
						'prev_text' => '<i class="fa fa-chevron-left"></i>',
						'next_text' => '<i class="fa fa-chevron-right"></i>'
						) );
				?>
			</nav><!-- #comment-nav-below -->
			<?php endif; // check for comment navigation ?>

		<?php endif; // have_comments() ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'kihon' ); ?></p>
		<?php endif; ?>


		<?php kihon_comment_form(); ?>

	</div><!-- .content-container -->
</div><!-- #comments -->

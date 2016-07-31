<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package kihon
 * @since 1.0.0
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'kihon' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'kihon' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'kihon' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'kihon' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'kihon_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function kihon_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'kihon' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';


	// // Comments link
	// if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
	// 	echo '<span class="comments-link"> ' . _x( 'with', 'with 3 comments', 'kihon' ) . ' ';
	// 	comments_popup_link( __( 'Leave a comment', 'kihon' ), __( '1 Comment', 'kihon' ), __( '% Comments', 'kihon' ) );
	// 	echo '</span>';
	// }
}
endif;

if ( ! function_exists( 'kihon_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function kihon_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'kihon' ) );
		if ( $categories_list && kihon_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'kihon' ) . '</span>', $categories_list );
		}

		if ( is_single() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'kihon' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'kihon' ) . '</span>', $tags_list );
			}
		}
	}

	edit_post_link( __( 'Edit', 'kihon' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title kihond on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'kihon' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'kihon' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'kihon' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'kihon' ), get_the_date( _x( 'Y', 'yearly archives date format', 'kihon' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'kihon' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'kihon' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'kihon' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'kihon' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'kihon' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'kihon' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'kihon' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'kihon' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'kihon' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function kihon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'kihon_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'kihon_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so kihon_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so kihon_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in kihon_categorized_blog.
 */
function kihon_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'kihon_categories' );
}
add_action( 'edit_category', 'kihon_category_transient_flusher' );
add_action( 'save_post',     'kihon_category_transient_flusher' );






if ( ! function_exists( 'kihon_list_comments' ) ) :
/**
 * Prints custom comments comment list.
 *
 * @since 1.0.0
 */
function kihon_list_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'kihon' ); ?>
			<?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', 'kihon' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .comment-body-->
	</li>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'comment-parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<header class="comment-header clear">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 45 ); ?>
				</div>

				<div class="comment-meta vcard">
					<span class="comment-author-name"><?php echo get_comment_author_link(); ?></span>

					<div class="comment-date">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
								printf(
									_x( '%1$s at %2$s', '1: comment post date, 2: comment post time', 'kihon' ),
									get_comment_date(),
									get_comment_time()
								);
								?>
							</time>
						</a>
					</div><!-- .comment-date -->
				</div><!-- .comment-meta -->


				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kihon' ); ?></p>
				<?php endif; ?>
			</header><!-- .comment-header -->


			<div class="comment-content">
				<?php comment_text(); ?>


				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="comment-reply">',
					'after'     => '</div>',
				) ) );
				?>
			</div><!-- .comment-content -->
		</article>
	</li>

	<?php endif;
}
endif;


if ( ! function_exists( 'kihon_comment_form' ) ) :
/**
 * Print custom comment form.
 *
 * @since 1.0.0
 */
function kihon_comment_form() {

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$placeholder_author		= __( 'Name', 'kihon' );
	$placeholder_email		= __( 'Email', 'kihon' );
	$placeholder_url			= __( 'Website', 'kihon' );
	$placeholder_comment	= __( 'Comment', 'kihon' );


	// custom inputs
	$fields = array(
	  'author' =>
	    '<div class="comment-form-author">
	    	<input id="author" name="author" class="comment-form-control" type="text" placeholder="' . $placeholder_author . ( $req ? '*' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />
	    </div>',

	  'email' =>
	    '<div class="comment-form-email">
	    <input id="email" name="email" class="comment-form-control" type="text" placeholder="' . $placeholder_email . ( $req ? '*' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />
	    </div>',

	  'url' =>
	    '<div class="comment-form-url">
	    	<input id="url" name="url" class="comment-form-control" type="text" placeholder="' . $placeholder_url . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />
	    </div>',
	);

	// custom textarea
	$comment_field =
		'<div class="comment-form-comment">
			<textarea id="comment" name="comment" class="comment-form-textarea" placeholder="' . $placeholder_comment .  ( $req ? '*' : '' ) . '"aria-required="true" rows="6"></textarea>
		</div>';


	$comment_form_args = array(
		'fields'							=> apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'				=> $comment_field,
		'comment_notes_after'	=> '',
		'label_submit'				=> __( 'Post Comment', 'kihon' ),
		'title_reply'					=> __( 'Leave a Comment', 'kihon' ),
  	'title_reply_to'			=> __( 'Leave a Reply to %s', 'kihon'),
	);


	// the comment form
	comment_form( $comment_form_args );
}
endif;



if ( ! function_exists( 'kihon_print_footer_info' ) ) :
/**
 * Prints footer information.
 *
 * @since 1.0.0
 */
function kihon_print_footer_info() {

	$footer_info = '';

  /**
   * Filter to modify footer info content.
   *
   * @since 1.0.0
   *
   * @param string $footer_info Footer info content
   */
	$footer_info = apply_filters( 'kihon_footer_info_content', $footer_info );

  echo wp_kses_post( force_balance_tags( $footer_info ) );
}
endif;

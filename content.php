<?php
/**
 * @package kihon
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-thumbnail">
			<?php kihon_the_post_thumbnail(); ?>
		</div><!-- .featured-thumbnail -->
	<?php endif; ?>

	<div class="content-container">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php kihon_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content clear">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kihon' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>
		</div><!-- .entry-content -->

	</div><!-- .content-container -->

	<div class="entry-footer">
		<?php kihon_entry_footer(); ?>
	</div><!-- .entry-footer -->

</article><!-- #post-## -->

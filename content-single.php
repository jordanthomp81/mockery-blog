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
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

			<div class="entry-meta">
				<?php kihon_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content clear">
			<?php the_content(); ?>

			<?php
				wp_link_pages( array(
					'before'   => '<div class="page-links">' . __( 'Pages:', 'kihon' ),
					'after'    => '</div><!-- .page-links -->',
					'pagelink' => '<span class="page-link">%</span>'
				)	);
			?>
		</div><!-- .entry-content -->
	</div><!-- .content-container -->

	<div class="entry-footer">
		<?php kihon_entry_footer(); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-## -->

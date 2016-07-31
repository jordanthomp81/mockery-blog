<?php
/**
 * The template used for displaying page content in page.php
 *
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
		<div class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</div><!-- .entry-header -->

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

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'kihon' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

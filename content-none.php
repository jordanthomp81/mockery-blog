<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package kihon
 * @since 1.0.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Nothing Found', 'kihon' ); ?></h2>
	</header><!-- .page-header -->

	<div class="page-content">
		<div class="content-container">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

					<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'kihon' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kihon' ); ?></p>
					<?php get_search_form(); ?>

				<?php else : ?>

					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kihon' ); ?></p>

					<?php get_search_form(); ?>

				<?php endif; ?>
			</div><!-- .content-container -->
	</div><!-- .page-content -->
</section><!-- .no-results -->

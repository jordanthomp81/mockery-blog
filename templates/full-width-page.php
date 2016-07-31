<?php
/**
 * Template Name: Full width Page
 *
 * A full width page with no sidebars.
 *
 *	@package kihon
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div class="container clear">

			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- .container -->
	</div><!-- #primary -->

<?php get_footer(); ?>

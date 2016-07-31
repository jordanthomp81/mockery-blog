<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package kihon
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div class="container clear">

			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<header class="page-header">
						<h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'kihon' ); ?></h2>
					</header><!-- .page-header -->

					<div class="page-content">
						<div class="content-container">

							<h3 class="error-404-text">404</h3>

							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'kihon' ); ?></p>

							<?php get_search_form(); ?>

						</div><!-- .content-container -->
					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->

			<?php get_sidebar(); ?>

		</div><!-- .container -->
	</div><!-- #primary -->

<?php get_footer(); ?>
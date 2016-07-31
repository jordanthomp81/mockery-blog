<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package kihon
 * @since 1.0.0
 */
?>
<!-- #24CDFB -->

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container clear">
			<div class="footer-info">
				<?php kihon_print_footer_info(); ?>
			</div><!-- .footer-info -->

			<div class="footer-social clear">
				<?php kihon_social_accounts(); ?>
			</div><!-- .footer-social -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

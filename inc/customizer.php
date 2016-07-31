<?php
/**
 * Theme Customizer
 *
 * @package kihon
 * @since 1.0.0
 */

/**
 * Register theme custom customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kihon_customize_register( $wp_customize ) {

	/**
	 * Configure some WP default settings to fit the theme
	 */
	$wp_customize->remove_section( 'background_image' );


	/**
	 * Hook to easily add custom options.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	do_action( 'kihon_register_customizer_settings', $wp_customize );


	// Add customizer description control
	include get_template_directory() . '/inc/class-customizer-controls.php';
}
add_action( 'customize_register', 'kihon_customize_register' );

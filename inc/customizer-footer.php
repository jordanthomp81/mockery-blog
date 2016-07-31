<?php
/**
 * Customizer footer settings
 *
 * @package kihon
 * @since 1.0.0
 */




if ( ! function_exists( 'kihon_customize_register_footer' ) ) :
/**
 * Register footer settings.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kihon_customize_register_footer( $wp_customize ) {
  // Section
  $wp_customize->add_section(
    'kihon_footer_info',
    array(
      'title'       => __( 'Footer Info', 'kihon' ),
      'description' => __( 'Change the footer info (copyright text).', 'kihon' ),
      // 'panel' => ''
    )
  );

  // Custom settings and controls
  $wp_customize->add_setting(
    'kihon_site_footer_info',
    array(
      'default'           => sprintf( __( 'Designed by %s %s %s', 'kihon' ), date('Y'), '<a href="http://gdthemes.com">', 'gbobbd' ),
      'sanitize_callback' => 'kihon_sanitize_text',
    )
  );
  $wp_customize->add_control(
    'kihon_site_footer_info',
    array(
      'label'       => __( 'Site Footer Info.', 'kihon' ),
      'description' => __( 'Usually the copyirght text.', 'kihon' ),
      'section'     => 'kihon_footer_info',
      'type'        => 'textarea',
    )
  );
}
endif;
add_action( 'kihon_register_customizer_settings', 'kihon_customize_register_footer' );



if ( ! function_exists( 'kihon_footer_info_content_setting' ) ) :
/**
 * Prints footer info set by user.
 *
 * @since 1.0.0
 */
function kihon_footer_info_content_setting( $footer_info ) {
  $footer_info = get_theme_mod( 'kihon_site_footer_info', sprintf( __( 'Designed by %s %s %s', 'kihon' ), date('Y'), '<a href="http://gdthemes.com">', 'gbobbd' ) );

  return $footer_info;
}
add_filter( 'kihon_footer_info_content', 'kihon_footer_info_content_setting');
endif;

<?php
/**
 * Customizer header settings
 *
 * @package kihon
 * @since 1.0.0
 */




if ( ! function_exists( 'kihon_customize_register_header' ) ) :
/**
 * Register header settings.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kihon_customize_register_header( $wp_customize ) {
  /**
   * Configure some WP default settings to fit this section.
   */
  $wp_customize->get_section( 'title_tagline' )->title  = 'Site Header';
  // $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  // Move header image control to title_tagline because it belongs together
  $wp_customize->get_control( 'header_image' )->section  = 'title_tagline';
  $wp_customize->get_control( 'header_image' )->priority  = 11;
  // Header Text Color changed to site title color
  $wp_customize->get_control( 'header_textcolor' )->label = 'Site Title Color';
  // Remove site tagline because this theme doesn't support it front end
  // $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->remove_control( 'blogdescription' );
  // $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  // Custom settings and controls
  $wp_customize->add_setting(
    'kihon_site_header_height',
    array(
      'default'           => 80,
      'sanitize_callback' => 'kihon_sanitize_integer',
    )
  );
  $wp_customize->add_control(
    'kihon_site_header_height',
    array(
      'label'   => __( 'Site Header Height (px)', 'kihon' ),
      'section' => 'title_tagline',
      'type'    => 'text',
    )
  );



  $wp_customize->add_setting(
    'kihon_site_header_fixed',
    array(
      'default'           => 'on',
      'sanitize_callback' => 'kihon_sanitize_radio_or_select',
    )
  );
  $wp_customize->add_control(
    'kihon_site_header_fixed',
    array(
      'label'       => __( 'Fixed Header?', 'kihon' ),
      'description' => __( 'Fix header to top when scrolled down.', 'kihon' ),
      'section'     => 'title_tagline',
      'type'        => 'select',
      'choices'     => array(
        'on'  => __( 'On', 'kihon' ),
        'off' => __( 'Off', 'kihon' )
      )
    )
  );
}
endif;
add_action( 'kihon_register_customizer_settings', 'kihon_customize_register_header' );



if ( ! function_exists( 'kihon_set_header_settings_css' ) ) :
/**
 * Returns a key pair value array in which the key is the settings ID.
 *
 * @since 1.0.0
 *
 * @param array $settings_css CSS of customizer settings to print.
 */
function kihon_set_header_settings_css( $settings_css ) {
  $header_height = array(
    'kihon_site_header_height'  => get_theme_mod( 'kihon_site_header_height', 80 ),
    'kihon_site_header_fixed'   => get_theme_mod( 'kihon_site_header_fixed', 'on' )
  );

  $settings_css = array_merge( $settings_css, $header_height );

  return $settings_css;
}
endif;
add_filter( 'kihon_customizer_settings_css', 'kihon_set_header_settings_css' );



if ( ! function_exists( 'kihon_print_header_fixed_js' ) ) :
function kihon_print_header_fixed_js() {
  if ( 'off' === get_theme_mod( 'kihon_site_header_fixed', 'on' ) ) {
    return;
  }

  ?>
  <script id="header_fixed_add_class">
    ( function( $ ) {
      $('body').addClass('fixed-header');
    } )( jQuery );
  </script>
  <?php
}
endif;
add_action( 'wp_footer', 'kihon_print_header_fixed_js', 1 );

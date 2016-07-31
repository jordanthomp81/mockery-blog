<?php
/**
 * Customizer header settings
 *
 * @package kihon
 * @since 1.0.0
 */




if ( ! function_exists( 'kihon_customize_register_colors' ) ) :
/**
 * Register color settings
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kihon_customize_register_colors( $wp_customize ) {
  /**
   * Add on to WP Colors section.
   */

  // Custom settings and controls
  $wp_customize->add_setting(
    'kihon_theme_color',
    array(
      'default'           => '#38a16a',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_theme_color',
    array(
      'label'   => __( 'Theme Color', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );

  $wp_customize->add_setting(
    'kihon_theme_color_hover',
    array(
      'default'           => '#4bc183',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_theme_color_hover',
    array(
      'label'   => __( 'Theme Color When Hovered', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );


  $wp_customize->add_setting(
    'kihon_bgcolor_header',
    array(
      'default'           => '#ffffff',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_bgcolor_header',
    array(
      'label'   => __( 'Header Background', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );


  $wp_customize->add_setting(
    'kihon_bgcolor_footer',
    array(
      'default'           => '#ffffff',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_bgcolor_footer',
    array(
      'label'   => __( 'Footer Background', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );


  $wp_customize->add_setting(
    'kihon_color_menu_links',
    array(
      'default'           => '#aaaaaa',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_color_menu_links',
    array(
      'label'   => __( 'Menu Links', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );

  $wp_customize->add_setting(
    'kihon_color_menu_links_hover',
    array(
      'default'           => '#000000',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_color_menu_links_hover',
    array(
      'label'   => __( 'Menu Links when hovered', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );


  $wp_customize->add_setting(
    'kihon_color_footer_info',
    array(
      'default'           => '#888888',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_color_footer_info',
    array(
      'label'   => __( 'Footer Info Text (Copyright text)', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );


   $wp_customize->add_setting(
    'kihon_bgcolor_social_icon',
    array(
      'default'           => '#f1f1f1',
      'sanitize_callback' => 'kihon_sanitize_color',
    )
  );
  $wp_customize->add_control(
    'kihon_bgcolor_social_icon',
    array(
      'label'   => __( 'Icon Container', 'kihon' ),
      'section' => 'colors',
      'type'    => 'color',
    )
  );
}
endif;
add_action( 'kihon_register_customizer_settings', 'kihon_customize_register_colors' );



if ( ! function_exists( 'kihon_set_colors_settings' ) ) :
/**
 * Returns a key pair value array in which the key is the settings ID.
 *
 * @since 1.0.0
 *
 * @param array $settings_css CSS of customizer settings to print.
 */
function kihon_set_colors_settings( $settings_css ) {
  $colorsheight = array(
    'kihon_theme_color'            => get_theme_mod( 'kihon_theme_color', '#38a16a' ),
    'kihon_theme_color_hover'      => get_theme_mod( 'kihon_theme_color_hover', '#4bc183' ),
    'kihon_bgcolor_header'         => get_theme_mod( 'kihon_bgcolor_header', '#ffffff' ),
    'kihon_bgcolor_footer'         => get_theme_mod( 'kihon_bgcolor_footer', '#ffffff' ),
    'kihon_color_menu_links'       => get_theme_mod( 'kihon_color_menu_links', '#aaaaaa' ),
    'kihon_color_menu_links_hover' => get_theme_mod( 'kihon_color_menu_links_hover', '#000000' ),
    'kihon_color_footer_info'      => get_theme_mod( 'kihon_color_footer_info', '#888888' ),
    'kihon_bgcolor_social_icon'    => get_theme_mod( 'kihon_bgcolor_social_icon', '#f1f1f1' )
  );

  $settings_css = array_merge( $settings_css, $colorsheight );

  return $settings_css;
}
endif;
add_filter( 'kihon_customizer_settings_css', 'kihon_set_colors_settings' );

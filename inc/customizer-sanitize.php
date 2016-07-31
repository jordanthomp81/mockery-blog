<?php
/**
 * Customizer sanitization.
 *
 * @package kihon
 * @since 1.0.0
 */

if ( ! function_exists( 'kihon_sanitize_checkbox' ) ) :
/**
 * Sanitize type: checkbox
 *
 * @since 1.0.0
 * @return mixed $input
 */
function kihon_sanitize_checkbox( $input ) {
  if ( $input == 1 ) {
    return 1;
  } else {
    return '';
  }
}
endif;


if ( ! function_exists( 'kihon_sanitize_integer' ) ) :
/**
 * Sanitize type: dropdown-pages
 *
 * @since 1.0.0
 * @return integer $input
 */
function kihon_sanitize_integer( $input ) {
  if( is_numeric( $input ) ) {
    return intval( $input );
  }
}
endif;


if ( ! function_exists( 'kihon_sanitize_text' ) ) :
/**
 * Sanitize type: text
 *
 * @since 1.0.0
 * @return string $input
 */
function kihon_sanitize_text( $input ) {
  return wp_kses_post( force_balance_tags( $input ) );
}
endif;


if ( ! function_exists( 'kihon_sanitize_color' ) ) :
/**
 * Sanitize type: HEX value
 *
 * @since 1.0.0
 * @return integer $input
 */
function kihon_sanitize_color( $input ) {
  return sanitize_hex_color( $input );
}
endif;


if ( ! function_exists( 'kihon_sanitize_file' ) ) :
/**
 * Sanitize type: file
 *
 * @since 1.0.0
 * @return string $input Sanitized URL of file.
 */
function kihon_sanitize_file( $input ) {
  return 'esc_url_raw';
}
endif;


if ( ! function_exists( 'kihon_sanitize_radio_or_select' ) ) :
/**
 * Sanitize type: radio or select
 *
 * @since 1.0.0
 * @return array $input
 */
function kihon_sanitize_radio_or_select( $input, $setting ) {
  // Get id of the setting
  $setting_id = $setting->id;
  // Define empty array
  $valid = array( 0 );


  // Set valid input of setting of that id
  switch ( $setting_id ) {
    case 'kihon_menu_cta_display' :
    case 'kihon_site_header_fixed' :
      $valid = array(
        'on'  => __( 'On', 'kihon' ),
        'off' => __( 'Off', 'kihon' )
      );
      break;
  }

  if ( array_key_exists( $input, $valid ) ) {
   return $input;
  } else {
   return '';
  }
}
endif;




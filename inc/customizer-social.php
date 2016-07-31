<?php
/**
 * Customizer Social settings.
 *
 * @package kihon
 * @since 1.0.0
 */




if ( ! function_exists( 'kihon_customize_register_social' ) ) :
/**
 * Register post sharing settings.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kihon_customize_register_social( $wp_customize ) {
  // Section
  $wp_customize->add_section(
    'kihon_social',
    array(
      'title' => __( 'Footer Social', 'kihon' ),
      'description' => __( 'You can add which social media you want to the site\'s footer.', 'kihon' ),
      // 'panel' => ''
    )
  );




  // Settings and Controls
  $wp_customize->add_setting(
    'kihon_social_accounts',
    array(
      'default'           => 'facebook, twitter, google-plus',
      'sanitize_callback' => 'kihon_sanitize_text',
    )
  );
  $wp_customize->add_control(
    'kihon_social_accounts',
    array(
      'label'       => __( 'Add Social Accounts.', 'kihon' ),
      'description' => sprintf(
        __( 'Add account icons by entering the class name separated by a comma (,) in the list found %shere%s. Refresh the page to see options.', 'kihon' ),
        '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">',
        '</a>'
      ),
      'section'     => 'kihon_social',
      'type'        => 'textarea',
    )
  );


  $wp_customize->add_setting(
    'kihon_social_link_new_window',
    array(
      'default'           => '1',
      'sanitize_callback' => 'kihon_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'kihon_social_link_new_window',
    array(
      'label'       => __( 'Open links in new window?', 'kihon' ),
      'section'     => 'kihon_social',
      'type'        => 'checkbox',
    )
  );


  /**
   * Adds options dynamically kihond on user input.
   *
   * @see kihon_social_accounts Customizer settings
   */
  $social_accounts = get_theme_mod( 'kihon_social_accounts', 'facebook, twitter, google-plus' );
  $social_accounts = explode( ',',$social_accounts );

  foreach( $social_accounts as $social_account ) {
    $social_account = trim( $social_account );

    $wp_customize->add_setting(
      'kihon_social_' . $social_account,
      array(
        'sanitize_callback' => 'kihon_sanitize_text',
      )
    );
    $wp_customize->add_control(
      'kihon_social_' . $social_account,
      array(
        'label'       => ucfirst( $social_account ),
        'description' => __( 'Enter full URL to social account', 'kihon' ),
        'section'     => 'kihon_social',
        'type'        => 'text',
      )
    );
  }

}
endif;
add_action( 'kihon_register_customizer_settings', 'kihon_customize_register_social' );




if ( ! function_exists( 'kihon_social_accounts' ) ) :
/**
 * Prints social account icons in the site footer.
 *
 * @since 1.0.0
 */
function kihon_social_accounts() {
  $target = '';

  $social_accounts = get_theme_mod( 'kihon_social_accounts', 'facebook, twitter, google-plus' );
  $social_accounts = explode( ',',$social_accounts );
  if ( '1' === get_theme_mod( 'kihon_social_link_new_window', '1' ) ) {
    $target = 'target="_blank"';
  }

  foreach( $social_accounts as $social_account ) {
    $social_account = trim( $social_account );
    $social_url     = get_theme_mod( 'kihon_social_' . $social_account );
    $social_icon    = 'fa fa-' . $social_account;

    ?>
      <a href="<?php echo esc_url( $social_url ); ?>" <?php echo esc_attr( $target ); ?>><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a>
    <?php
  } // endforeach
}
endif;
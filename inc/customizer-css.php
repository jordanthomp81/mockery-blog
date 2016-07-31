<?php
/**
 * Prints CSS of customizer settings.
 *
 * @package kihon
 * @since 1.0.0
 */

if ( ! function_exists( 'kihon_print_customizer_settings_css' ) ) :
/**
 * Print Google Fonts CSS.
 *
 * @since 1.0.0
 */
function kihon_print_customizer_settings_css() {

  // init settings var
  $settings_css = array();

  /**
   * Returns a key pair value array in which the key is the settings ID.
   *
   *      $settings_css['settings_id'];
   *
   * @since 1.0.0
   *
   * @param array $settings_css CSS of customizer settings to print.
   */
  $settings_css = apply_filters( 'kihon_customizer_settings_css', $settings_css );

  ?>
    <?php if ( '#38a16a' !== $settings_css['kihon_theme_color'] || '#4bc183' !== $settings_css['kihon_theme_color_hover'] ) : ?>
      <style id="kihon_settings_theme_color">
        /*--------------------------------------------------------------
          Theme Color
        --------------------------------------------------------------*/

        <?php if ( '#38a16a' !== $settings_css['kihon_theme_color'] ) : ?>
        blockquote:before,
        th,
        button,
        a,
        .page-links a .page-link:hover {
          color: <?php echo esc_html( $settings_css['kihon_theme_color'] ); ?>
        }

        input[type="button"],
        input[type="reset"],
        input[type="submit"],
        .button,
        .menu-item-cta span,
        .header-navigation.js-toggled .header-menu-toggle,
        .sticky .entry-header:after,
        .title-sep,
        .edit-link a,
        .page-header,
        .bypostauthor-indicator,
        .comment-reply-title:after,
        .comment-reply-title:after,
        .page-links .page-link,
        .posts-navigation a,
        .page-numbers.current,
        .widget li:before,
        .tagcloud a:hover,
        .tagcloud a:active {
          background-color: <?php echo esc_html( $settings_css['kihon_theme_color'] ); ?>;
        }
        <?php endif; ?>

        <?php if ( '#4bc183' !== $settings_css['kihon_theme_color_hover'] ) : ?>
        a:hover,
        a:focus,
        a:active {
          color: <?php echo esc_html( $settings_css['kihon_theme_color_hover'] ); ?>;
        }

        button:hover,
        input[type="button"]:hover,
        input[type="reset"]:hover,
        input[type="submit"]:hover,
        .button:hover,
        .button:focus,
        .button:active,
        .footer-social a:hover,
        .footer-social a:focus,
        #cancel-comment-reply-link:hover,
        #cancel-comment-reply-link:active,
        #cancel-comment-reply-link:focus,
        .posts-navigation a:hover {
          background-color: <?php echo esc_html( $settings_css['kihon_theme_color_hover'] ); ?>;
        }
        <?php endif; ?>
      </style>
    <?php endif; // kihon_theme_color || kihon_theme_color_hover  ?>


    <style id="kihon_settings_theme">
      /*--------------------------------------------------------------
        Header
      --------------------------------------------------------------*/
      <?php if ( !empty( $settings_css['kihon_site_header_height'] ) ) : ?>
      @media screen and (min-width: 768px) {
        .site-header {
          height: <?php echo esc_html( $settings_css['kihon_site_header_height'] );?>px;
          line-height: <?php echo esc_html( $settings_css['kihon_site_header_height'] ); ?>px;
        }
      }
      <?php endif; ?>


      /* Fixed Header
      ------------------------------------*/

      <?php if ( 'on' === $settings_css['kihon_site_header_fixed'] ) : ?>
      @media screen and (min-width: 768px) {
        .site-header.js-is-fixed {
          position: fixed;
          top: -80px;
          left: 0;
          opacity: 1;
          width: 100%;
          height: 75px;
          line-height: 50px;
          font-size: 90%;

          transition: .4s top ease-in,
                      .3s opacity ease-in;
        }
        .site-header.js-is-fixed:hover {
          opacity: 1;
        }

        .site-header.js-is-fixed .header-logo-title img {
          max-height: 30px;
        }

        .site-header.js-is-fixed.js-show {
          top: 0px;
        }

        /* if logged in mode */
        .wp-admin-is-logged-in .site-header.js-is-fixed.js-show {
          top: 32px;
        }
        /* if VC frontend editor mode */
        .wp-admin-is-logged-in .site-header.js-is-fixed {
          top: -50px;
        }
        .compose-mode .site-header.js-is-fixed.js-show {
          top: 0;
        }
      }
      <?php endif; ?>


      /*--------------------------------------------------------------
        Colors
      --------------------------------------------------------------*/
      .site-header {
        background-color: <?php echo esc_html( $settings_css['kihon_bgcolor_header'] ); ?>;
      }
      .site-footer {
        background-color: <?php echo esc_html( $settings_css['kihon_bgcolor_footer'] ); ?>;
      }

      .header-menu a {
        color: <?php echo esc_html( $settings_css['kihon_color_menu_links'] ); ?>;
      }

      .current-menu-item a,
      .header-menu a:hover,
      .header-menu a:active {
        color: <?php echo esc_html( $settings_css['kihon_color_menu_links_hover'] ); ?>;
      }



      .footer-info {
        color: <?php echo esc_html( $settings_css['kihon_color_footer_info'] ); ?>;
      }

      .footer-social a {
        background-color: <?php echo esc_html( $settings_css['kihon_bgcolor_social_icon'] ); ?>;
      }
    </style>
  <?php
}
add_action( 'wp_head', 'kihon_print_customizer_settings_css', 99 );
endif;

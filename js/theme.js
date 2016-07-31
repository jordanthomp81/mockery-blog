/**
 * theme.js
 *
 * Handles theme JS functions.
 */

( function( $ ) {

	"use strict";

  // Page load in effect
  $(window).load( function() {
    if ( 0 !== $('.preloader').length ) {
      $('.preloader').fadeOut(1000);
    }
  });
} )( jQuery );



/*--------------------------------------------------------------
  Header Popout animation on scroll
--------------------------------------------------------------*/
( function( $ ) {

  "use strict";

  if ( 0 === $('.fixed-header').length ) {
    return;
  }

  var win              = $(window),
      siteHeader       = $('.site-header'),
      siteHeaderHeight = siteHeader.outerHeight() + 100;

  if ( win.scrollTop() > siteHeaderHeight ) {
    siteHeader.addClass('js-is-fixed');
  }

  // Scale down header
  win.scroll( function() {

    if ( win.scrollTop() > siteHeaderHeight ) {
      if ( !siteHeader.hasClass('js-is-fixed') ) {
        siteHeader.addClass('js-is-fixed');
      }
    } else {
      if ( siteHeader.hasClass('js-is-fixed') ) {
        siteHeader.removeClass('js-is-fixed');
      }
    }

    if ( $(this).scrollTop() > 700 ) {
      if ( !siteHeader.hasClass('js-show') ) {
        siteHeader.addClass('js-show');
      }
    } else {
      if ( siteHeader.hasClass('js-show') ) {
        siteHeader.removeClass('js-show');
      }
    }
  });
} )( jQuery );

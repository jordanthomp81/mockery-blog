/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

/*--------------------------------------------------------------
  Header menu toggle for small screens.
--------------------------------------------------------------*/
(function($) {

  'use strict';

  // Cache
  var $nav        = $('.header-navigation'),
      $menu       = $nav.find('ul:first-child'),
      $toggleMenu = $('.toggle-header-menu');


  $toggleMenu.click( function () {

    $(this).attr( 'aria-expanded', $(this).attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
    $menu.toggleClass('is-active');
    $toggleMenu.toggleClass('is-active');


	  /* Custom functions
	  --------------------------------*/
		// Switch icon on open/close
		if ( $menu.hasClass('is-active') ) {
			$toggleMenu.find('i')
				.removeClass('fa-bars')
				.addClass('fa-close');
		} else {
			$toggleMenu.find('i')
				.removeClass('fa-close')
				.addClass('fa-bars');
		}
  });

})(jQuery);




/*--------------------------------------------------------------
  Header submenu toggle for all screens.
--------------------------------------------------------------*/
(function($) {

  'use strict';

  // Cache
  var $linkWithSubmenu  = $('.page_item_has_children > a, .menu-item-has-children > a'),
      $toggleSubmenu,   // appeneded later
      toggleSubmenuText = '<span class="toggle-header-submenu-text"><i class="fa fa-chevron-down"></i></span>'; // replace this


  if ( 0 === $linkWithSubmenu.length ) {
    return;
  }


  // Create toggle button below menu link
  $linkWithSubmenu.after( '<button class="toggle-header-submenu" aria-expanded="false"><span class="screen-reader-text">Submenu Toggle</span>' + toggleSubmenuText + '</button>' );
  // Cache button
  $toggleSubmenu = $('.toggle-header-submenu');


  $toggleSubmenu.click( function () {

    $(this).attr( 'aria-expanded', $(this).attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
    $(this).next('ul').toggleClass('is-active');
    $(this).parent('li').toggleClass('is-active');
  });


  /* Custom functions
  --------------------------------*/


})(jQuery);



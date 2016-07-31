<?php
/**
 * kihon functions and definitions.
 *
 * @package kihon
 * @since 1.0.0
 */

/**
 * The current version of the theme.
 */
define( 'KIHON_VERSION', wp_get_theme()->get( 'Version' ) );



if ( ! function_exists( 'kihon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since 1.0.0
 */
function kihon_setup() {

	/**
	 * Set the content width kihond on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1100; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme kihond on kihon, use a find and replace
	 * to change 'kihon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kihon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-thumbnail', 700, 0 );
	add_image_size( 'featured-thumbnail-full-width', 1080, 0 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => __( 'Header Menu', 'kihon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'audio', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kihon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


  // Add styling to WYSIWYG editor backend
  add_editor_style( array( 'css/editor-style.css', kihon_get_google_fonts_url() ) );
}
endif; // kihon_setup
add_action( 'after_setup_theme', 'kihon_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function kihon_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'kihon' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'kihon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kihon_styles_scripts() {
	// Libraries
	wp_enqueue_script( 'jquery' );
	// Icons
	wp_enqueue_style( 'kihon-font-awesome', get_template_directory_uri() . '/lib/font-awesome/css/font-awesome.css', array(), '4.3.0' );
	// Fonts
	wp_enqueue_style( 'kihon-fonts', kihon_get_google_fonts_url(), array(), null );
	// Theme
	wp_enqueue_style( 'kihon-style', get_stylesheet_uri(), array(), KIHON_VERSION );
	wp_enqueue_script( 'kihon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), KIHON_VERSION, true );
	wp_enqueue_script( 'kihon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), KIHON_VERSION, true );
  wp_enqueue_script( 'kihon-theme', get_template_directory_uri() . '/js/theme.js', array(), KIHON_VERSION, true );
	// WP Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kihon_styles_scripts' );

// Inject the custom stylesheets into the loop
function mockery_custom_styles() {
  wp_register_style('custom-styles', get_stylesheet_directory_uri() . '/css/custom-styles.css');
  wp_enqueue_style('custom-styles');
}

add_action('wp_enqueue_scripts', 'mockery_custom_styles');

if ( ! function_exists( 'kihon_get_google_fonts_url' ) ) :
/**
 * Get Google Fonts URL.
 *
 * @since 1.0.0
 */
function kihon_get_google_fonts_url() {
  $fonts_url = '';

	$font_families = array();
	$font_families[] = 'Montserrat:400,700';
	$font_families[] = 'Open+Sans:400italic,700italic,400,700';

	/**
	 * Add filter to add more fonts easily.
	 *
	 * @since 1.0.0
	 *
	 * @param array $font_families List of google fonts to get.
	 */
	$font_families = apply_filters( 'kihon_google_fonts_list', $font_families );

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
	);

	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	return $fonts_url;
}
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// kihon
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-sanitize.php';
// Custom settings
require get_template_directory() . '/inc/customizer-header.php';
require get_template_directory() . '/inc/customizer-colors.php';
require get_template_directory() . '/inc/customizer-social.php';
require get_template_directory() . '/inc/customizer-footer.php';
require get_template_directory() . '/inc/customizer-css.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function mockery_init_emails() {
  // This function will set up the custom post type of Reviews
  $labels = array(
    'name'               => _x( 'Emails', 'post type general name' ),
    'singular_name'      => _x( 'Email', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'email' ),
    'add_new_item'       => __( 'Add New Email' ),
    'edit_item'          => __( 'Edit Email' ),
    'new_item'           => __( 'New Email' ),
    'all_items'          => __( 'All Emails' ),
    'view_item'          => __( 'View Emails' ),
    'search_items'       => __( 'Search Emails' ),
    'not_found'          => __( 'No emails found' ),
    'not_found_in_trash' => __( 'No emails found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Emails'
  );

  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our emails collected from the blog forms',
    'menu_icon'     => 'dashicons-email-alt',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true,
  );

  register_post_type( 'emails', $args );
}

add_action('init', 'mockery_init_emails');


function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','SearchFilter');

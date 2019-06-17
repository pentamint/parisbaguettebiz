<?php
/**
 * Pentamint WP Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pentamint_WP_Theme
 */

if ( ! function_exists( 'pentamint_wp_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pentamint_wp_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pentamint WP Theme, use a find and replace
		 * to change 'pentamint-wp-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pentamint-wp-theme', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'pentamint-wp-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pentamint_wp_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'pentamint_wp_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pentamint_wp_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pentamint_wp_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'pentamint_wp_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pentamint_wp_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pentamint-wp-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'pentamint-wp-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/** Custom Sidebars **/
	// Top Header Left Widget
	register_sidebar( array(
		'name'          => 'Top Header Left Widget', 'pentamint-wp-theme',
		'id'            => 'top-header-widget-1',
		'description'   => 'Add widgets here.', 'pentamint-wp-theme',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Mobile Header Left Widget
	register_sidebar( array(
		'name'          => 'Mobile Header Widget', 'pentamint-wp-theme',
		'id'            => 'mobile-header-widget-1',
		'description'   => 'Add widgets here.', 'pentamint-wp-theme',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Top Footer Widget
	register_sidebar( array(
		'name'          => 'Top Footer Widget',
		'id'            => 'top-footer-widget-1',
		'description'   => 'Appears in the top footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer Sidebar 1/4
	register_sidebar( array(
		'name'          => 'Footer Sidebar 1',
		'id'            => 'footer-sidebar-1',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer Sidebar 2/4	
	register_sidebar( array(
		'name'          => 'Footer Sidebar 2',
		'id'            => 'footer-sidebar-2',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer Sidebar 3/4
	register_sidebar( array(
		'name'          => 'Footer Sidebar 3',
		'id'            => 'footer-sidebar-3',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer Sidebar 4/4
	register_sidebar( array(
		'name'          => 'Footer Sidebar 4',
		'id'            => 'footer-sidebar-4',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Colophon Widget
	register_sidebar( array(
		'name'          => 'Colophon Widget',
		'id'            => 'colophon-widget-1',
		'description'   => 'Appears in the colophon area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	/** Custom Sidebars End **/

}
add_action( 'widgets_init', 'pentamint_wp_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pentamint_wp_theme_scripts() {
	wp_enqueue_style( 'pentamint-wp-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'pentamint-wp-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'pentamint-wp-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	/** Custom Scripts **/
	// Bootstrap Support
	wp_enqueue_script( 'jQuery', '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>', array(), null, true );
	wp_enqueue_script( 'popper.js', '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>', array(), null, true );
	wp_enqueue_script( 'bootstrap', '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>', array(), null, true );	
	// Theme Custom
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:400,700', false );
	wp_enqueue_style( 'animate.css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', false );
	wp_enqueue_script( 'ofi-min-js', get_template_directory_uri() . '/js/ofi.min.js', array(), '3.2.4', true );	
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'),  time(), true );
	/** Custom Scripts End **/

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pentamint_wp_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/** Custom Theme Add-ons **/
// Bootstrap Support
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
// Custom Menus
register_nav_menus( array(
	'secondary' => esc_html__( 'Secondary Menu', 'pentamint-wp-theme' ),
) );
register_nav_menus( array(
	'top-footer' => esc_html__( 'Top Footer Menu', 'pentamint-wp-theme' ),
) );
register_nav_menus( array(
	'colophon' => esc_html__( 'Colophon Menu', 'pentamint-wp-theme' ),
) );
/** Custom Theme Add-ons End **/
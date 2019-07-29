<?php
/**
 * Theme enqueue scripts
 *
 * @package PBBiz
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'pbbiz_scripts' );

if ( ! function_exists( 'pbbiz_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function pbbiz_scripts() {
		wp_enqueue_style( 'pbbiz-style', get_stylesheet_uri(), array() , time(), false );

		wp_enqueue_script( 'pbbiz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	
		wp_enqueue_script( 'pbbiz-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
		/** Custom Scripts **/
		// Initiate Default Wordpress jQuery
		wp_enqueue_script('jquery');
	
		// Bootstrap Support
		wp_enqueue_script( 'popper.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), null, true );
		wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), null, true );	
	
		// Theme Custom
		wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap', false );
		wp_enqueue_style( 'nanum-fonts-nanumsquareround', 'https://cdn.rawgit.com/innks/NanumSquareRound/master/nanumsquareround.min.css', false );
		wp_enqueue_style( 'slick-carousel-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false );
		wp_enqueue_style( 'animate.css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', true );
	
		wp_enqueue_script( 'ofi-min-js', get_template_directory_uri() . '/js/ofi.min.js', array(), '3.2.4', true );	
		wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/main.js', array('jquery'),  time(), true );
		wp_enqueue_script( 'slick-carousel-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'),  time(), true );
		wp_register_script( 'slick-carousel-theme', get_stylesheet_directory_uri() . '/js/slick_carousel.js', array('jquery'), time(), true );
		/** Custom Scripts End **/
	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'pbbiz_scripts' ).

<?php
/**
 * PBBiz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PBBiz
 */

if ( ! function_exists( 'pbbiz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pbbiz_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on PBBiz, use a find and replace
		 * to change 'PBBiz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pbbiz', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary Menu', 'PBBiz' ),
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
		add_theme_support( 'custom-background', apply_filters( 'pbbiz_custom_background_args', array(
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
add_action( 'after_setup_theme', 'pbbiz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pbbiz_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pbbiz_content_width', 640 );
}
add_action( 'after_setup_theme', 'pbbiz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pbbiz_widgets_init() {
	// Global sidebar area
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'PBBiz' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'PBBiz' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Top header left tagline area
	register_sidebar( array(
		'name'          => 'Top Header Left Widget', 'PBBiz',
		'id'            => 'top-header-widget-1',
		'description'   => 'Add widgets here.', 'PBBiz',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Mobile header left icon menu
	register_sidebar( array(
		'name'          => 'Mobile Header Widget', 'PBBiz',
		'id'            => 'mobile-header-widget-1',
		'description'   => 'Add widgets here.', 'PBBiz',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Top footer widget area
	register_sidebar( array(
		'name'          => 'Top Footer Widget',
		'id'            => 'top-footer-widget-1',
		'description'   => 'Appears in the top footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer sidebar area 1/4
	register_sidebar( array(
		'name'          => 'Footer Sidebar 1',
		'id'            => 'footer-sidebar-1',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer sidebar area 2/4	
	register_sidebar( array(
		'name'          => 'Footer Sidebar 2',
		'id'            => 'footer-sidebar-2',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer sidebar area 3/4
	register_sidebar( array(
		'name'          => 'Footer Sidebar 3',
		'id'            => 'footer-sidebar-3',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Footer sidebar area 4/4
	register_sidebar( array(
		'name'          => 'Footer Sidebar 4',
		'id'            => 'footer-sidebar-4',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Colophon widget area
	register_sidebar( array(
		'name'          => 'Colophon Widget',
		'id'            => 'colophon-widget-1',
		'description'   => 'Appears in the colophon area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'pbbiz_widgets_init' );

/**
 * Enqueue scripts and styles.
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
	wp_enqueue_style( 'animate.css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', true );
	wp_enqueue_script( 'ofi-min-js', get_template_directory_uri() . '/js/ofi.min.js', array(), '3.2.4', true );	
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'),  time(), true );
	/** Custom Scripts End **/

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pbbiz_scripts' );

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

/**
 * Load Bootstrap compatibility file.
 */
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

/**
 * Customize Menus
 */
// Register Secondary Nav Menu
register_nav_menus( array(
	'secondary' => esc_html__( 'Secondary Menu', 'PBBiz' ),
) );

// Register Footer Nav Menu
register_nav_menus( array(
	'top-footer' => esc_html__( 'Top Footer Menu', 'PBBiz' ),
) );

// Register Colophon Nav Menu
register_nav_menus( array(
	'colophon' => esc_html__( 'Colophon Menu', 'PBBiz' ),
) );

/**
 * Customize Post Types
 */
// Change Default Post Labels
add_action( 'admin_menu', 'pm_change_post_label' );
add_action( 'init', 'pm_change_post_object' );
function pm_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'B2B 블로그';
    $submenu['edit.php'][5][0] = '모든 글'; // All Items
	$submenu['edit.php'][10][0] = '새로 추가'; // Add New
	$submenu['edit.php'][15][0] = '카테고리'; // Categories
    $submenu['edit.php'][16][0] = '태그'; // Tags
}
function pm_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = '글';
    $labels->singular_name = '글';
    $labels->add_new = '글 쓰기';
    $labels->add_new_item = '글 쓰기';
    $labels->edit_item = '글 수정하기';
    $labels->new_item = '새로운 글';
    $labels->view_item = '글 보기';
    $labels->search_items = '글 검색하기';
    $labels->not_found = '찾는 글이 없습니다.';
    $labels->not_found_in_trash = '찾는 글이 휴지통에 없습니다.';
    $labels->all_items = '전체 글';
    $labels->menu_name = 'B2B 블로그';
    $labels->name_admin_bar = 'B2B 블로그';
}
 
/**
 * Custom AJAX Filters - Load More & Paginations
 */
// Enqueue Load More Script
add_action( 'wp_enqueue_scripts', 'pm_script_and_styles');
 
function pm_script_and_styles() {
	// absolutely need it, because we will get $wp_query->query_vars and $wp_query->max_num_pages from it.
	global $wp_query;
 
	// when you use wp_localize_script(), do not enqueue the target script immediately
	wp_register_script( 'pm_ajax_filter_scripts', get_stylesheet_directory_uri() . '/js/ajax_filter.js', array('jquery'), time(), true );
 
	// passing parameters here
	// actually the <script> tag will be created and the object "pm_loadmore_params" will be inside it 
	wp_localize_script( 'pm_ajax_filter_scripts', 'pm_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'pm_ajax_filter_scripts' );
}

// Create Custom Function for AJAX Handler
add_action('wp_ajax_loadmorebutton', 'pm_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'pm_loadmore_ajax_handler');
 
function pm_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true ); // query_posts() takes care of the necessary sanitization 
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post(); ?>
 
		<article class="query_item col-12 col-sm-6 col-md-4">
			<div class="wrapper">
				<?php the_post_thumbnail(); ?>
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
			</div>
		</article>
 
		<?php
		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_pmfilter', 'pm_filter_function'); 
add_action('wp_ajax_nopriv_pmfilter', 'pm_filter_function');
 
function pm_filter_function(){
 
	// example: date-ASC 
	$order = explode( '-', $_POST['pm_order_by'] );
 
	$args = array(
		'posts_per_page' => $_POST['pm_number_of_results'], // when set to -1, it shows all posts
		'orderby' => $order[0], // example: date
		'order'	=> $order[1] // example: ASC
	);
 
	// for taxonomies / categories
	if( isset( $_POST['categoryfilter'] ) )
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $_POST['categoryfilter'],
			)
		);
	
	query_posts( $args );
 
	global $wp_query;
 
	if( have_posts() ) :
 
 		ob_start(); // start buffering because we do not need to print the posts now
 
		while( have_posts() ): the_post(); ?>
 
		<article class="query_item col-12 col-sm-6 col-md-4">
			<div class="wrapper">
				<?php the_post_thumbnail(); ?>
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
			</div>
		</article>
 
		<?php
		endwhile;
 
 		$posts_html = ob_get_contents(); // we pass the posts to variable
   		ob_end_clean(); // clear the buffer
	else:
		$posts_html = '<p>조건에 맞는 검색결과가 없습니다.</p>';
	endif;
 
	// no wp_reset_query() required
 
 	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html
	) );
 
	die();
}
// pm_paginator( $_POST['first_page'] );
// Create Custom Function for AJAX Pagination
function pm_paginator( $first_page_url ){
 
	// the function works only with $wp_query that's why we must use query_posts() instead of WP_Query()
	global $wp_query;
 
	// remove the trailing slash if necessary
	$first_page_url = untrailingslashit( $first_page_url );
 
 
	// it is time to separate our URL from search query
	$first_page_url_exploded = array(); // set it to empty array
	$first_page_url_exploded = explode("/?", $first_page_url);
	// by default a search query is empty
	$search_query = '';
	// if the second array element exists
	if( isset( $first_page_url_exploded[1] ) ) {
		$search_query = "/?" . $first_page_url_exploded[1];
		$first_page_url = $first_page_url_exploded[0];
	}
 
	// get parameters from $wp_query object
	// how much posts to display per page (DO NOT SET CUSTOM VALUE HERE!!!)
	$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
	// current page
	$current_page = (int) $wp_query->query_vars['paged'];
	// the overall amount of pages
	$max_page = $wp_query->max_num_pages;
 
	// we don't have to display pagination or load more button in this case
	if( $max_page <= 1 ) return;
 
	// set the current page to 1 if not exists
	if( empty( $current_page ) || $current_page == 0) $current_page = 1;
 
	// you can play with this parameter - how much links to display in pagination
	$links_in_the_middle = 4;
	$links_in_the_middle_minus_1 = $links_in_the_middle-1;
 
	// the code below is required to display the pagination properly for large amount of pages
	// I mean 1 ... 10, 12, 13 .. 100
	// $first_link_in_the_middle is 10
	// $last_link_in_the_middle is 13
	$first_link_in_the_middle = $current_page - floor( $links_in_the_middle_minus_1/2 );
	$last_link_in_the_middle = $current_page + ceil( $links_in_the_middle_minus_1/2 );
 
	// some calculations with $first_link_in_the_middle and $last_link_in_the_middle
	if( $first_link_in_the_middle <= 0 ) $first_link_in_the_middle = 1;
	if( ( $last_link_in_the_middle - $first_link_in_the_middle ) != $links_in_the_middle_minus_1 ) { $last_link_in_the_middle = $first_link_in_the_middle + $links_in_the_middle_minus_1; }
	if( $last_link_in_the_middle > $max_page ) { $first_link_in_the_middle = $max_page - $links_in_the_middle_minus_1; $last_link_in_the_middle = (int) $max_page; }
	if( $first_link_in_the_middle <= 0 ) $first_link_in_the_middle = 1;
 
	// begin to generate HTML of the pagination
	$pagination = '<nav id="pm_pagination" class="navigation pagination" role="navigation"><div class="nav-links">';
 
	// when to display "..." and the first page before it
	if ($first_link_in_the_middle >= 3 && $links_in_the_middle < $max_page) {
		$pagination.= '<a href="'. $first_page_url . $search_query . '" class="page-numbers">1</a>';
 
		if( $first_link_in_the_middle != 2 )
			$pagination .= '<span class="page-numbers extend">...</span>';
 
	}
 
	// arrow left (previous page)
	if ($current_page != 1)
		$pagination.= '<a href="'. $first_page_url . '/page/' . ($current_page-1) . $search_query . '" class="prev page-numbers">' . '<i class="fas fa-chevron-left"></i>' . '</a>';
 
 
	// loop page links in the middle between "..." and "..."
	for($i = $first_link_in_the_middle; $i <= $last_link_in_the_middle; $i++) {
		if($i == $current_page) {
			$pagination.= '<span class="page-numbers current">'.$i.'</span>';
		} else {
			$pagination .= '<a href="'. $first_page_url . '/page/' . $i . $search_query .'" class="page-numbers">'.$i.'</a>';
		}
	}
 
	// arrow right (next page)
	if ($current_page != $last_link_in_the_middle )
		$pagination.= '<a href="'. $first_page_url . '/page/' . ($current_page+1) . $search_query .'" class="next page-numbers">' . '<i class="fas fa-chevron-right"></i>' . '</a>';
 
 
	// when to display "..." and the last page after it
	if ( $last_link_in_the_middle < $max_page ) {
 
		if( $last_link_in_the_middle != ($max_page-1) )
			$pagination .= '<span class="page-numbers extend">...</span>';
 
		$pagination .= '<a href="'. $first_page_url . '/page/' . $max_page . $search_query .'" class="page-numbers">'. $max_page .'</a>';
	}
 
	// end HTML
	$pagination.= "</div></nav>\n";
 
	// haha, this is our load more posts link
	if( $current_page < $max_page )
		$pagination.= '<div id="pm_loadmore">글 더보기</div>';
 
	// replace first page before printing it
	echo str_replace(array("/page/1?", "/page/1\""), array("?", "\""), $pagination);
}

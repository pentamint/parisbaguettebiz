<?php
/**
 * PBBiz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PBBiz
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$pbbiz_includes = array(
	'/setup.php',                           // Theme setup and custom theme supports.
	'/menus.php',                           // Register custom menus.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	// '/pagination.php',                      // Custom pagination for this theme.
	// '/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	// '/editor.php',                          // Load Editor functions.
	// '/deprecated.php',                      // Load deprecated functions.
);

foreach ( $pbbiz_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

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
// Enqueue Load snMore Script
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

<?php

// Create Custom CPT
function blog_init() {
	$labels = array(
		'name'                => __( 'M&A매물' ),
		'singular_name'       => __( 'M&A매물'),
		'menu_name'           => __( 'M&A매물'),
		'parent_item_colon'   => __( '상위 M&A매물:'),
		'all_items'           => __( 'M&A매물 전체보기'),
		'view_item'           => __( 'M&A매물 보기'),
		'add_new_item'        => __( '신규 M&A매물 등록하기'),
		'add_new'             => __( '신규 등록하기'),
		'edit_item'           => __( 'M&A매물 수정하기'),
		'update_item'         => __( 'M&A매물 적용하기'),
		'search_items'        => __( 'M&A매물 검색하기'),
		'not_found'           => __( '매물이 없습니다.'),
		'not_found_in_trash'  => __( '휴지통에 매물이 없습니다.')
	);
    $args = array(
		'label'               => __( 'deals'),
		'description'         => __( 'WeMnA M&A매물'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
		'public'              => true,
		'hierarchical'        => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'query_var' 		  => true,
		'has_archive'         => 'deals',
		'can_export'          => true,
		'exclude_from_search' => false,
	        'yarpp_support'     => true,
		'taxonomies' 	      => array('post_tag'),
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'query_var' 		  => true,
		'rewrite' 			  => array('slug' => 'deals'),
		'menu_icon' 	      => 'dashicons-admin-post',
        );
    register_post_type( 'deals', $args );
}
add_action( 'init', 'deals_init' );

// Add Custom Taxonomy Industry for CPT Deals
function deals_custom_taxonomy_industry() {
	$labels = array(
		'name' => _x( '업종', 'taxonomy general name' ),
		'singular_name' => _x( '업종', 'taxonomy singular name' ),
		'search_items' =>  __( '업종 검색하기' ),
		'all_items' => __( '업종 전체보기' ),
		'parent_item' => __( '상위 업종' ),
		'parent_item_colon' => __( '상위 업종:' ),
		'edit_item' => __( '업종 수정하기' ), 
		'update_item' => __( '업종 적용하기' ),
		'add_new_item' => __( '신규 업종 등록하기' ),
		'new_item_name' => __( '신규 업종 이름' ),
		'menu_name' => __( '업종' ),
	); 	
	register_taxonomy('industry',array('deals'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'industry' ),
	));
}
add_action( 'init', 'deals_custom_taxonomy_industry', 0 );

// Add Custom Taxonomy Locations for CPT Deals
function deals_custom_taxonomy_location() {
	$labels = array(
		'name' => _x( '지역', 'taxonomy general name' ),
		'singular_name' => _x( '지역', 'taxonomy singular name' ),
		'search_items' =>  __( '지역 검색하기' ),
		'all_items' => __( '지역 전체보기' ),
		'parent_item' => __( '상위 지역' ),
		'parent_item_colon' => __( '상위 지역:' ),
		'edit_item' => __( '지역 수정하기' ), 
		'update_item' => __( '지역 적용하기' ),
		'add_new_item' => __( '신규 지역 등록하기' ),
		'new_item_name' => __( '신규 지역 이름' ),
		'menu_name' => __( '지역' ),
	); 	
	register_taxonomy('location',array('deals'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'location' ),
	));
}
add_action( 'init', 'deals_custom_taxonomy_location', 0 );

?>
<?php
/**
 * boiler Custom Post Types
 *
 * @package boiler
 */
 
function register_cpt_complex() {
	$labels = array(
		'name' 				=> ( 'Complex' ),
		'singular_name' 	=> ( 'Complex' ),
		'add_new' 			=> ( 'Add New Complex' ),
		'add_new_item' 		=> ( 'Add New Complex' ),
		'edit_item' 		=> ( 'Edit Complex' ),
		'new_item' 			=> ( 'New Complex' ),
		'view_item' 		=> ( 'View Complex' ),
		'search_items' 		=> ( 'Search Complex' ),
		'not_found' 		=> ( 'No Complex found' ),
		'not_found_in_trash'=> ( 'No Complex found in Trash' ),
		'parent_item_colon' => ( 'Parent Complex:' ),
		'menu_name' 		=> ( 'Complex' ),
	);
	$args = array(
		'labels' 			=> $labels,
		'hierarchical' 		=> true,
		'description' 		=> 'My Complex',
		'supports' 			=> array( 'title', 'editor', 'thumbnail' , 'excerpt', 'author', 'revisions'),
		'rewrite' 			=> array( 'slug' => 'complex' ),
		'public' 			=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'menu_position' 	=> 4,
		'menu_icon'			=> 'dashicons-chart-bar',
		'hierarchical' 		=> true,
		'show_in_nav_menus' => true,
		'publicly_queryable'=> true,
		'exclude_from_search'=> false,
		'has_archive' 		=> true,
		'query_var' 		=> true,
		'can_export' 		=> true,
		'capability_type' 	=> 'post'
	);
	register_post_type( 'property', $args );	
}
add_action( 'init', 'register_cpt_complex' );

function register_cpt_listings() {
	$labels = array(
		'name' 				=> ( 'Listings' ),
		'singular_name' 	=> ( 'Listing' ),
		'add_new' 			=> ( 'Add New Listing' ),
		'add_new_item' 		=> ( 'Add New Listing' ),
		'edit_item' 		=> ( 'Edit Listing' ),
		'new_item' 			=> ( 'New Listing' ),
		'view_item' 		=> ( 'View Listings' ),
		'search_items' 		=> ( 'Search Listings' ),
		'not_found' 		=> ( 'No Listing found' ),
		'not_found_in_trash'=> ( 'No Listing found in Trash' ),
		'parent_item_colon' => ( 'Parent Listings:' ),
		'menu_name' 		=> ( 'Listings' ),
	);
	$args = array(
		'labels' 			=> $labels,
		'hierarchical' 		=> true,
		'description' 		=> 'My Listings',
		'supports' 			=> array( 'title', 'editor', 'thumbnail' , 'excerpt', 'author', 'revisions'),
		'taxonomies' 		=> array( 'listing-type' ),
		'public' 			=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'menu_position' 	=> 4,
		'menu_icon'			=> 'dashicons-location-alt',
		'hierarchical' 		=> true,
		'show_in_nav_menus' => true,
		'publicly_queryable'=> true,
		'exclude_from_search'=> false,
		'has_archive' 		=> true,
		'query_var' 		=> true,
		'can_export' 		=> true,
		'capability_type' 	=> 'post'
	);
	register_post_type( 'listings', $args );	
}
add_action( 'init', 'register_cpt_listings' );

function register_cpt_amenities() {
	$labels = array(
		'name' 				=> ( 'Amenities' ),
		'singular_name' 	=> ( 'Amenities' ),
		'add_new' 			=> ( 'Add New Amenity' ),
		'add_new_item' 		=> ( 'Add New Amenity' ),
		'edit_item' 		=> ( 'Edit Amenity' ),
		'new_item' 			=> ( 'New Amenity' ),
		'view_item' 		=> ( 'View Amenity' ),
		'search_items' 		=> ( 'Search Amenity' ),
		'not_found' 		=> ( 'No Amenity found' ),
		'not_found_in_trash'=> ( 'No Amenity found in Trash' ),
		'parent_item_colon' => ( 'Parent Amenity:' ),
		'menu_name' 		=> ( 'Amenity' ),
	);
	$args = array(
		'labels' 			=> $labels,
		'hierarchical' 		=> true,
		'description' 		=> 'My Amenity',
		'supports' 			=> array( 'title', 'editor', 'thumbnail' , 'excerpt', 'author', 'revisions'),
		'taxonomies' 		=> array( 'alpha' ),
		'public' 			=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'menu_position' 	=> 4,
		'menu_icon'			=> 'dashicons-star-empty',
		'hierarchical' 		=> true,
		'show_in_nav_menus' => true,
		'publicly_queryable'=> true,
		'exclude_from_search'=> false,
		'has_archive' 		=> true,
		'query_var' 		=> true,
		'can_export' 		=> true,
		'capability_type' 	=> 'post'
	);
	register_post_type( 'amenity', $args );	
}
add_action( 'init', 'register_cpt_amenities' );

function register_cpt_business() {
	$labels = array(
		'name' 				=> ( 'Directory' ),
		'singular_name' 	=> ( 'Directory' ),
		'add_new' 			=> ( 'Add New Directory' ),
		'add_new_item' 		=> ( 'Add New Directory' ),
		'edit_item' 		=> ( 'Edit Directory' ),
		'new_item' 			=> ( 'New Directory' ),
		'view_item' 		=> ( 'View Directory' ),
		'search_items' 		=> ( 'Search Directory' ),
		'not_found' 		=> ( 'No Directory found' ),
		'not_found_in_trash'=> ( 'No Directory found in Trash' ),
		'parent_item_colon' => ( 'Parent Directory:' ),
		'menu_name' 		=> ( 'Directory' ),
	);
	$args = array(
		'labels' 			=> $labels,
		'hierarchical' 		=> true,
		'description' 		=> 'My Directory',
		'supports' 			=> array( 'title', 'editor', 'thumbnail' , 'excerpt', 'author', 'revisions'),
		'taxonomies' 		=> array( 'alpha', 'industry', 'directory-type' ),
		'public' 			=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'menu_position' 	=> 4,
		'menu_icon'			=> 'dashicons-nametag',
		'hierarchical' 		=> true,
		'show_in_nav_menus' => true,
		'publicly_queryable'=> true,
		'exclude_from_search'=> false,
		'has_archive' 		=> true,
		'query_var' 		=> true,
		'can_export' 		=> true,
		'capability_type' 	=> 'post'
	);
	register_post_type( 'business', $args );	
}
add_action( 'init', 'register_cpt_business' );

/*function register_cpt_medical() {
	$labels = array(
		'name' 				=> ( 'Medical-Dental' ),
		'singular_name' 	=> ( 'Medical-Dental' ),
		'add_new' 			=> ( 'Add New Medical-Dental' ),
		'add_new_item' 		=> ( 'Add New Medical-Dental' ),
		'edit_item' 		=> ( 'Edit Medical-Dental' ),
		'new_item' 			=> ( 'New Medical-Dental' ),
		'view_item' 		=> ( 'View Medical-Dental' ),
		'search_items' 		=> ( 'Search Medical-Dental' ),
		'not_found' 		=> ( 'No Medical-Dental found' ),
		'not_found_in_trash'=> ( 'No Medical-Dental found in Trash' ),
		'parent_item_colon' => ( 'Parent Medical-Dental:' ),
		'menu_name' 		=> ( 'Medical-Dental' ),
	);
	$args = array(
		'labels' 			=> $labels,
		'hierarchical' 		=> true,
		'description' 		=> 'Medical or Dental companies',
		'supports' 			=> array( 'title', 'editor', 'thumbnail' , 'excerpt', 'author', 'revisions'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'menu_position' 	=> 4,
		'menu_icon'			=> 'dashicons-heart',
		'hierarchical' 		=> true,
		'show_in_nav_menus' => true,
		'publicly_queryable'=> true,
		'exclude_from_search'=> false,
		'has_archive' 		=> true,
		'query_var' 		=> true,
		'can_export' 		=> true,
		'capability_type' 	=> 'post'
	);
	register_post_type( 'medical-dental', $args );	
}
add_action( 'init', 'register_cpt_medical' );*/

add_action( 'init', 'create_alpha');

add_action( 'init', 'create_industry');

add_action( 'init', 'create_directory_type');

function create_alpha() {
	register_taxonomy(
		'alpha',
		'business',
		array(
			'label' => __( 'Alphabet' ),
			'rewrite' => array( 'slug' => 'alpha' ),
			'hierarchical' => false,
			'query_var'  => true,
			'show_ui'	 => false,
			'show_admin_column' => true
		)
	);
}

function create_industry() {
	register_taxonomy(
		'industry',
		'business',
		array(
			'label' => __( 'Industry' ),
			'rewrite' => array( 'slug' => 'industry' ),
			'hierarchical' => true,
			'query_var'  => true,
			'show_admin_column' => true
		)
	);
}

function create_directory_type() {
	register_taxonomy(
		'directory-type',
		'business',
		array(
			'label' => __( 'Directory Type' ),
			'rewrite' => array( 'slug' => 'directory-type' ),
			'hierarchical' => true,
			'query_var'  => true,
			'show_admin_column' => true
		)
	);
}

function register_cpt_press() {
	$labels = array(
		'name' 				=> ( 'Press Releases' ),
		'singular_name' 	=> ( 'Press Release' ),
		'add_new' 			=> ( 'Add New Press Release' ),
		'add_new_item' 		=> ( 'Add New Press Release' ),
		'edit_item' 		=> ( 'Edit Press Release' ),
		'new_item' 			=> ( 'New Press Release' ),
		'view_item' 		=> ( 'View Press Release' ),
		'search_items' 		=> ( 'Search Press Release' ),
		'not_found' 		=> ( 'No Press Release found' ),
		'not_found_in_trash'=> ( 'No Press Release found in Trash' ),
		'parent_item_colon' => ( 'Parent Press Release:' ),
		'menu_name' 		=> ( 'Press Releases' ),
	);
	$args = array(
		'labels' 			=> $labels,
		'hierarchical' 		=> true,
		'description' 		=> 'Press Releasees',
		'supports' 			=> array( 'title', 'editor', 'thumbnail' , 'excerpt', 'author', 'revisions'),
		'taxonomies' 		=> array( 'press-release', 'post_tag' ),
		'public' 			=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'menu_position' 	=> 4,
		'menu_icon'			=> 'dashicons-megaphone',
		'hierarchical' 		=> true,
		'show_in_nav_menus' => true,
		'publicly_queryable'=> true,
		'exclude_from_search'=> false,
		'has_archive' 		=> true,
		'query_var' 		=> true,
		'can_export' 		=> true,
		'capability_type' 	=> 'post'
	);
	register_post_type( 'press-release', $args );	
}
add_action( 'init', 'register_cpt_press' );

function register_cpt_projects() {
	$labels = array(
		'name' 				=> ( 'New Projects' ),
		'singular_name' 	=> ( 'New Projects' ),
		'add_new' 			=> ( 'Add New Project' ),
		'add_new_item' 		=> ( 'Add New Project' ),
		'edit_item' 		=> ( 'Edit New Project' ),
		'new_item' 			=> ( 'New New Project' ),
		'view_item' 		=> ( 'View New Project' ),
		'search_items' 		=> ( 'Search New Project' ),
		'not_found' 		=> ( 'No New Project found' ),
		'not_found_in_trash'=> ( 'No New Project found in Trash' ),
		'parent_item_colon' => ( 'Parent New Project:' ),
		'menu_name' 		=> ( 'New Projects' ),
	);
	$args = array(
		'labels' 			=> $labels,
		'hierarchical' 		=> true,
		'description' 		=> 'New Projects',
		'supports' 			=> array( 'title', 'editor', 'thumbnail' , 'excerpt', 'author', 'revisions'),
		'taxonomies' 		=> array( 'press-release', 'post_tag' ),
		'public' 			=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'menu_position' 	=> 4,
		'menu_icon'			=> 'dashicons-megaphone',
		'hierarchical' 		=> true,
		'show_in_nav_menus' => true,
		'publicly_queryable'=> true,
		'exclude_from_search'=> false,
		'has_archive' 		=> true,
		'query_var' 		=> true,
		'can_export' 		=> true,
		'capability_type' 	=> 'post'
	);
	register_post_type( 'new-projects', $args );	
}
add_action( 'init', 'register_cpt_projects' );

add_action( 'init', 'create_listing_type');

function create_listing_type() {
	register_taxonomy(
		'listing-type',
		'listings',
		array(
			'label' => __( 'Listing Type' ),
			'rewrite' => array( 'slug' => 'listing-type' ),
			'hierarchical' => true,
			'query_var'  => true,
			'show_admin_column' => true,
		)
	);
}

// Add Press Release post type to tags
function add_custom_types_to_tax( $query ) {
	if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		
		// Get all your post types
		$post_types = array('post', 'press-release', 'new-project');
		
		$query->set( 'post_type', $post_types );
		return $query;
	}
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );

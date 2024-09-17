<?php

function create_locations() {

  $labels = array(
    'name'               => __( 'Locations' ),
    'singular_name'      => __( 'Location' ),
    'add_new'            => __( 'New Location' ),
    'add_new_item'       => __( 'Add Location' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit Location' ),
    'new_item'           => __( 'New Location' ),
    'all_items'          => __( 'All Locations' ),
    'view_item'          => __( 'View Location' ),
    'search_items'       => __( 'Search Locations' ),
    'not_found'          => __( 'No member found' ),
    'not_found_in_trash' => __( 'No member found in the Trash' ),
    'menu_name'          => __( 'Locations' )
  );

  $args = array(
    'labels'							=> $labels,
    'public'							=> true,
    'show_in_menu'				=> true,
    'capability_type'			=> 'post',
    'publicly_queryable'	=> true,
    'exclude_from_search'	=> false,
    'show_ui'							=> true,
    'has_archive'					=> true,
    'hierarchical'				=> true,
    //'rewrite'						=> array( 'slug' => 'styling' ),
    'menu_icon'						=> 'dashicons-location',
    'supports'						=> array( 'title', 'thumbnail', 'revisions', 'excerpt', 'page-attributes'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('locations', $args);
}

add_action( 'init', 'create_locations' );


function create_location_taxonomy() {

  $labels = array(
		'name'              => __( 'Location Categories' ),
    'singular_name'     => __( 'Location Category' ),
    'search_items'      => __( 'Search Location Categories' ),
    'all_items'         => __( 'All Location Categories' ),
    'parent_item'       => __( 'Parent Location Category' ),
    'parent_item_colon' => __( 'Parent Location Category:' ),
    'edit_item'         => __( 'Edit Location Category' ),
    'update_item'       => __( 'Update Location Category' ),
    'add_new_item'      => __( 'Add New Location Category' ),
    'new_item_name'     => __( 'New Location Category' ),
    'menu_name'         => __( 'Location Categories' ),
	);

	register_taxonomy( 'location_categories', array('locations'), array(
		'hierarchical'			=> true,
		'labels'						=> $labels,
    'public'            => false,
    //'rewrite'					=> array('slug' => 'brands'),
		'query_var'					=> true,
		'show_admin_column'	=> true,
    'show_in_rest'			=> false // true enables Gutenberg
	) );

}

add_action( 'init', 'create_location_taxonomy' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER ACF OPTIONS */
/*-----------------------------------------------------------------------------------*/

function create_locations_options() {

  if(function_exists('acf_add_options_page')) {
    acf_add_options_sub_page(array(
      'page_title'      => 'Locations Settings',
      'parent_slug'     => 'edit.php?post_type=locations',
      'capability' => 'manage_options'
    ));
  }

}

add_action('init', 'create_locations_options');

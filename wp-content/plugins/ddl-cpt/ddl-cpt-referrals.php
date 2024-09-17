<?php

/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE */
/*-----------------------------------------------------------------------------------*/

function create_referrals() {

  $labels = array(
    'name'               => __( 'Referrals' ),
    'singular_name'      => __( 'Referrals' ),
    'add_new'            => __( 'New Referral' ),
    'add_new_item'       => __( 'Add Referral' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit Referral' ),
    'new_item'           => __( 'New Referral' ),
    'all_items'          => __( 'All Referrals' ),
    'view_item'          => __( 'View Referral' ),
    'search_items'       => __( 'Search Referrals' ),
    'not_found'          => __( 'No referrals found' ),
    'not_found_in_trash' => __( 'No referrals found in the Trash' ),
    'menu_name'          => __( 'Referrals' )
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
    'hierarchical'				=> false,
    // 'rewrite'						  => array( 'slug' => 'referrals' ),
    'menu_icon'						=> 'dashicons-id-alt',
    'supports'						=> array( 'title', 'thumbnail', 'page-attributes', 'excerpt', 'editor'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('referrals', $args);
}

add_action( 'init', 'create_referrals' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE TAXONOMY (CATEGORIES) */
/*-----------------------------------------------------------------------------------*/

function create_referral_taxonomy() {

  $labels = array(
		'name'              => __( 'Referral Categories' ),
    'singular_name'     => __( 'Referral Category' ),
    'search_items'      => __( 'Search Referral Categories' ),
    'all_items'         => __( 'All Referral Categories' ),
    'parent_item'       => __( 'Parent Referral Category' ),
    'parent_item_colon' => __( 'Parent Referral Category:' ),
    'edit_item'         => __( 'Edit Referral Category' ),
    'update_item'       => __( 'Update Referral Category' ),
    'add_new_item'      => __( 'Add New Referral Category' ),
    'new_item_name'     => __( 'New Referral Category' ),
    'menu_name'         => __( 'Referral Categories' ),
	);

	register_taxonomy( 'referral_categories', array('referrals'), array(
		'hierarchical'			=> true,
		'labels'						=> $labels,
    'public'            => true,
    //'rewrite'					=> array('slug' => 'brands'),
		'query_var'					=> true,
    "show_ui"           => true,
    "show_in_menu"      => true,
    "show_in_nav_menus" => true,
    'show_admin_column' => true,
    'show_in_rest'			=> true // true enables Gutenberg
	) );

}

add_action( 'init', 'create_referral_taxonomy' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER ACF OPTIONS */
/*-----------------------------------------------------------------------------------*/

function create_referrals_options() {

  if(function_exists('acf_add_options_page')) {
    acf_add_options_sub_page(array(
      'page_title'      => 'Referral Settings',
      'parent_slug'     => 'edit.php?post_type=referrals',
      'capability' => 'manage_options'
    ));
  }

}

add_action('init', 'create_referrals_options');
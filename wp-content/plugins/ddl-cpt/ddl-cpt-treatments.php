<?php

/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE */
/*-----------------------------------------------------------------------------------*/

function create_treatments() {

  $labels = array(
    'name'               => __( 'Treatments' ),
    'singular_name'      => __( 'Treatments' ),
    'add_new'            => __( 'New Treatment' ),
    'add_new_item'       => __( 'Add Treatment' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit Treatment' ),
    'new_item'           => __( 'New Treatment' ),
    'all_items'          => __( 'All Treatments' ),
    'view_item'          => __( 'View Treatment' ),
    'search_items'       => __( 'Search Treatments' ),
    'not_found'          => __( 'No treatments found' ),
    'not_found_in_trash' => __( 'No treatments found in the Trash' ),
    'menu_name'          => __( 'Treatments' )
  );

  $args = array(
    'labels'							=> $labels,
    'public'							=> true,
    'show_in_menu'				=> true,
    'capability_type'			=> 'post',
    'publicly_queryable'	=> true,
    'exclude_from_search'	=> false,
    'show_ui'							=> true,
    'has_archive'					=> false,
    'hierarchical'				=> true,
    //'rewrite'						=> array( 'slug' => 'styling' ),
    'menu_icon'						=> 'dashicons-clipboard',
    'supports'						=> array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'revisions'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('treatments', $args);
}

add_action( 'init', 'create_treatments' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE TAXONOMY (CATEGORIES) */
/*-----------------------------------------------------------------------------------*/

function create_treatment_taxonomy() {

  $labels = array(
		'name'              => __( 'Treatment Categories' ),
    'singular_name'     => __( 'Treatment Category' ),
    'search_items'      => __( 'Search Treatment Categories' ),
    'all_items'         => __( 'All Treatment Categories' ),
    'parent_item'       => __( 'Parent Treatment Category' ),
    'parent_item_colon' => __( 'Parent Treatment Category:' ),
    'edit_item'         => __( 'Edit Treatment Category' ),
    'update_item'       => __( 'Update Treatment Category' ),
    'add_new_item'      => __( 'Add New Treatment Category' ),
    'new_item_name'     => __( 'New Treatment Category' ),
    'menu_name'         => __( 'Treatment Categories' ),
	);

	register_taxonomy( 'treatment-categories', array('treatments'), array(
		'hierarchical'			  => true,
		'labels'						  => $labels,
    'public'							=> false,
    'publicly_queryable'	=> false,
    // 'rewrite'					  => array('slug' => 'treatment'),
		'query_var'					  => true,
		'show_admin_column'	  => true,
    'show_in_rest'			  => false // true enables Gutenberg
	) );

}

add_action( 'init', 'create_treatment_taxonomy' );
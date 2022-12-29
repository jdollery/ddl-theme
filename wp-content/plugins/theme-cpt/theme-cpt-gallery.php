<?php

/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE */
/*-----------------------------------------------------------------------------------*/

function create_gallerys() {

  $labels = array(
    'name'               => __( 'Gallery' ),
    'singular_name'      => __( 'Item' ),
    'add_new'            => __( 'New item' ),
    'add_new_item'       => __( 'Add item' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit item' ),
    'new_item'           => __( 'New item' ),
    'all_items'          => __( 'All items' ),
    'view_item'          => __( 'View item' ),
    'search_items'       => __( 'Search items' ),
    'not_found'          => __( 'No items found' ),
    'not_found_in_trash' => __( 'No items found in the Trash' ),
    'menu_name'          => __( 'Gallery' )
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
    'hierarchical'				=> false,
    // 'rewrite'						  => array( 'slug' => 'gallerys' ),
    'menu_icon'						=> 'dashicons-format-gallery',
    'supports'						=> array( 'title', 'editor'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('gallerys', $args);
}

add_action( 'init', 'create_gallerys' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE TAXONOMY (CATEGORIES) */
/*-----------------------------------------------------------------------------------*/

function create_gallery_taxonomy() {

  $labels = array(
		'name'              => __( 'Gallery Categories' ),
    'singular_name'     => __( 'Gallery Category' ),
    'search_items'      => __( 'Search Gallery Categories' ),
    'all_items'         => __( 'All Gallery Categories' ),
    'parent_item'       => __( 'Parent Gallery Category' ),
    'parent_item_colon' => __( 'Parent Gallery Category:' ),
    'edit_item'         => __( 'Edit Gallery Category' ),
    'update_item'       => __( 'Update Gallery Category' ),
    'add_new_item'      => __( 'Add New Gallery Category' ),
    'new_item_name'     => __( 'New Gallery Category' ),
    'menu_name'         => __( 'Gallery Categories' ),
	);

	register_taxonomy( 'gallery_categories', array('gallerys'), array(
		'hierarchical'			=> true,
		'labels'						=> $labels,
    'public'            => true,
    'rewrite'					  => array('slug' => 'gallery'),
		'query_var'					=> true,
    "show_ui"           => true,
    "show_in_menu"      => true,
    "show_in_nav_menus" => true,
    'show_admin_column' => true,
    'show_in_rest'			=> true // true enables Gutenberg
	) );

}

add_action( 'init', 'create_gallery_taxonomy' );
<?php

function create_team() {

  $labels = array(
    'name'               => __( 'Members' ),
    'singular_name'      => __( 'Member' ),
    'add_new'            => __( 'New Member' ),
    'add_new_item'       => __( 'Add Member' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit Member' ),
    'new_item'           => __( 'New Member' ),
    'all_items'          => __( 'All Members' ),
    'view_item'          => __( 'View Member' ),
    'search_items'       => __( 'Search Members' ),
    'not_found'          => __( 'No member found' ),
    'not_found_in_trash' => __( 'No member found in the Trash' ),
    'menu_name'          => __( 'Team' )
  );

  $args = array(
    'labels'							=> $labels,
    'public'							=> false,
    'show_in_menu'				=> true,
    'capability_type'			=> 'post',
    'publicly_queryable'	=> false,
    'exclude_from_search'	=> true,
    'show_ui'							=> true,
    'has_archive'					=> false,
    'hierarchical'				=> true,
    //'rewrite'						=> array( 'slug' => 'styling' ),
    'menu_icon'						=> 'dashicons-groups',
    'supports'						=> array( 'title', 'editor', 'thumbnail'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('team', $args);
}

add_action( 'init', 'create_team' );


function create_team_taxonomy() {

  $labels = array(
		'name'              => __( 'Team Categories' ),
    'singular_name'     => __( 'Team Category' ),
    'search_items'      => __( 'Search Team Categories' ),
    'all_items'         => __( 'All Team Categories' ),
    'parent_item'       => __( 'Parent Team Category' ),
    'parent_item_colon' => __( 'Parent Team Category:' ),
    'edit_item'         => __( 'Edit Team Category' ),
    'update_item'       => __( 'Update Team Category' ),
    'add_new_item'      => __( 'Add New Team Category' ),
    'new_item_name'     => __( 'New Team Category' ),
    'menu_name'         => __( 'Team Categories' ),
	);

	register_taxonomy( 'team_categories', array('team'), array(
		'hierarchical'			=> true,
		'labels'						=> $labels,
    'public'            => true,
    //'rewrite'					=> array('slug' => 'brands'),
		'query_var'					=> true,
		'show_admin_column'	=> true,
    'show_in_rest'			=> false // true enables Gutenberg
	) );

}

add_action( 'init', 'create_team_taxonomy' );
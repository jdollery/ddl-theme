<?php

/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE */
/*-----------------------------------------------------------------------------------*/

function create_team() {

  $labels = array(
    'name'               => __( 'Team' ),
    'singular_name'      => __( 'Team' ),
    'add_new'            => __( 'New Member' ),
    'add_new_item'       => __( 'Add Member' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit Member' ),
    'new_item'           => __( 'New Member' ),
    'all_items'          => __( 'All Members' ),
    'view_item'          => __( 'View Member' ),
    'search_items'       => __( 'Search Members' ),
    'not_found'          => __( 'No team members found' ),
    'not_found_in_trash' => __( 'No team members found in the Trash' ),
    'menu_name'          => __( 'Team' )
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
    //'rewrite'						=> array( 'slug' => 'styling' ),
    'menu_icon'						=> 'dashicons-groups',
    'supports'						=> array( 'title', 'editor', 'thumbnail', 'revisions'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('team', $args);
}

add_action( 'init', 'create_team' );
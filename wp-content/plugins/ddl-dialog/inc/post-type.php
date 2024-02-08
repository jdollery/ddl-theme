<?php

/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE */
/*-----------------------------------------------------------------------------------*/

function create_ddl_dialog_post_type() {

  $labels = array(
    'name'               => __( 'Dialogs' ),
    'singular_name'      => __( 'Dialogs' ),
    'add_new'            => __( 'New Dialog' ),
    'add_new_item'       => __( 'Add Dialog' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit Dialog' ),
    'new_item'           => __( 'New Dialog' ),
    'all_items'          => __( 'All Dialogs' ),
    'view_item'          => __( 'View Dialog' ),
    'search_items'       => __( 'Search Dialogs' ),
    'not_found'          => __( 'No dialogs found' ),
    'not_found_in_trash' => __( 'No dialogs found in the Trash' ),
    'menu_name'          => __( 'DDL Dialogs' )
  );

  $args = array(
    'labels'							=> $labels,
    'public'							=> true,
    'show_in_menu'				=> true,
    'capability_type'			=> 'post',
    'publicly_queryable'	=> false,
    'exclude_from_search'	=> true,
    'show_ui'							=> true,
    'has_archive'					=> false,
    'hierarchical'				=> false,
    // 'rewrite'						  => array( 'slug' => 'treatments' ),
    'menu_icon'						=> 'dashicons-screenoptions',
    'supports'						=> array( 'title', 'editor'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('ddl-dialogs', $args);
}

add_action( 'init', 'create_ddl_dialog_post_type' );
<?php

/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE */
/*-----------------------------------------------------------------------------------*/

function create_carousel() {

  $labels = array(
    'name'               => __( 'Carousel' ),
    'singular_name'      => __( 'Carousel' ),
    'add_new'            => __( 'New Slide' ),
    'add_new_item'       => __( 'Add Slide' ),
    'edit'               => __( 'Edit' ),
    'edit_item'          => __( 'Edit Slide' ),
    'new_item'           => __( 'New Slide' ),
    'all_items'          => __( 'All Slides' ),
    'view_item'          => __( 'View Slide ' ),
    'search_items'       => __( 'Search Slides' ),
    'not_found'          => __( 'No slides found' ),
    'not_found_in_trash' => __( 'No slides found in the Trash' ),
    'menu_name'          => __( 'Carousel' )
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
    'hierarchical'				=> false,
    //'rewrite'						=> array( 'slug' => 'styling' ),
    'menu_icon'						=> 'dashicons-buddicons-activity',
    'supports'						=> array( 'title', 'editor', 'thumbnail'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('carousel', $args);
}

add_action( 'init', 'create_carousel' );
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
    'has_archive'					=> true,
    'hierarchical'				=> true,
    // 'rewrite'						  => array( 'slug' => 'treatments' ),
    'menu_icon'						=> 'dashicons-clipboard',
    'supports'						=> array( 'title', 'thumbnail', 'page-attributes', 'excerpt'),
    'show_in_rest'				=> false // true enables Gutenberg
  );

  register_post_type('treatments', $args);
}

add_action( 'init', 'create_treatments' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER CUSTOM POST TYPE TAXONOMY (CATEGORIES) */
/*-----------------------------------------------------------------------------------*/

// function create_treatment_taxonomy() {

//   $labels = array(
// 		'name'              => __( 'Treatment Categories' ),
//     'singular_name'     => __( 'Treatment Category' ),
//     'search_items'      => __( 'Search Treatment Categories' ),
//     'all_items'         => __( 'All Treatment Categories' ),
//     'parent_item'       => __( 'Parent Treatment Category' ),
//     'parent_item_colon' => __( 'Parent Treatment Category:' ),
//     'edit_item'         => __( 'Edit Treatment Category' ),
//     'update_item'       => __( 'Update Treatment Category' ),
//     'add_new_item'      => __( 'Add New Treatment Category' ),
//     'new_item_name'     => __( 'New Treatment Category' ),
//     'menu_name'         => __( 'Treatment Categories' ),
// 	);

// 	register_taxonomy( 'treatment_categories', array('treatments'), array(
// 		'hierarchical'			=> true,
// 		'labels'						=> $labels,
//     'public'            => true,
//     //'rewrite'					=> array('slug' => 'brands'),
// 		'query_var'					=> true,
//     "show_ui"           => true,
//     "show_in_menu"      => true,
//     "show_in_nav_menus" => true,
//     'show_admin_column' => true,
//     'show_in_rest'			=> true // true enables Gutenberg
// 	) );

// }

// add_action( 'init', 'create_treatment_taxonomy' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER ACF OPTIONS */
/*-----------------------------------------------------------------------------------*/

// function create_treatment_options() {

//   if(function_exists('acf_add_options_page')) {
//     acf_add_options_sub_page(array(
//       'page_title'   =>   'Treatments Page',
//       'parent_slug'  =>   'edit.php?post_type=treatments',
//       'capability'   =>   'manage_options'
//     ));
//   }

// }

// add_action('init', 'create_treatment_options');


/*-----------------------------------------------------------------------------------*/
/* ADD CPT TO YOAST BREADCRUMB */
/*-----------------------------------------------------------------------------------*/

function treatments_breadcrumbs($links) {
  
  if(is_singular('treatments')) {

    global $post;
		$treatments_link = get_the_permalink(8); //get the Treatments page link
		$parent_title = get_the_title( $post->post_parent );
		$parent_link = get_permalink( $post->post_parent );
		$title = get_the_title();

    // The first item in $links ($links[0]) is Home
    $links[1] = array('text' => 'Treatments', 'url' => $treatments_link, 'allow_html' => 1 ); // if cpt is Treatments
    if ( $post->post_parent ) {
      $links[2] = array('text' => $parent_title, 'url' => $parent_link, 'allow_html' => 1 ); // parent page
      $links[3] = array('text' => $title); // current page
    } else {
      $links[2] = array('text' => $title); // current page
    }
  }
  return $links;
}

add_filter('wpseo_breadcrumb_links', 'treatments_breadcrumbs');
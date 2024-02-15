<?php

/*

Plugin Name: DDL Dialog Manager
Version: 1.0.0
Description: Declares a plugin that creates pop-up dialogs.
Author: Dental Design
Author URI: https://dental-design.marketing/
License: GPL2

*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*-----------------------------------------------------------------------------------*/
/* ENQUEUE STYLES & SCRIPTS */
/*-----------------------------------------------------------------------------------*/

function ddl_dialog_enqueue() {

  wp_enqueue_style( 'ddl-dialog-styles', plugins_url('/assets/css/ddl-dialog-styles.css', __FILE__), array(), '', 'all' );
  wp_enqueue_script( 'ddl-dialog-script', plugins_url('/assets/js/ddl-dialog-script.js', __FILE__), array(), '', true ); 

}

add_action( 'wp_enqueue_scripts', 'ddl_dialog_enqueue' );


/*-----------------------------------------------------------------------------------*/
/* INCLUDES */
/*-----------------------------------------------------------------------------------*/

include plugin_dir_path( __FILE__ ) . './inc/admin.php';
include plugin_dir_path( __FILE__ ) . './inc/post-type.php';

function init_dialog() {
    
  $dialogLoop = new WP_Query( array(
    'post_type' => 'ddl-dialogs',
    "numberposts" => 1,
    "posts_per_page" => 1
    // 'order'  => 'ASC', 
    // 'orderby' => 'menu_order',
    // 'post_parent' => get_the_ID(),
    // 'numberposts' => -1,
  ) );

  if ( $dialogLoop -> have_posts() ) {

    while ( $dialogLoop->have_posts() ) : $dialogLoop->the_post();
    
      if( is_page(2) ) { // Enter your page ID

        $postId = get_the_ID();

        $dialogStatus = get_post_status($postId);
        if ($dialogStatus == 'publish' && $is_checked ) {
          include plugin_dir_path( __FILE__ ) . './inc/dialog.php';
        }

      }

    endwhile; wp_reset_query();

  }

}

add_action( 'wp_footer', 'init_dialog', 1 );
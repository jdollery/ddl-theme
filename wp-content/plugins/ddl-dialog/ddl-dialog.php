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

function init_ddl_dialog() {

  $ddl_dialog_loop = new WP_Query( array(
    'post_type' => 'ddl-dialogs',
    "numberposts" => 1,
    "posts_per_page" => 1
  ) );

  if ( $ddl_dialog_loop->have_posts() ) {

    while ( $ddl_dialog_loop->have_posts() ) : $ddl_dialog_loop->the_post();

      $ddl_dialog_post_Id = get_the_ID();
      $ddl_dialog_status = get_post_status($ddl_dialog_post_Id);
      $ddl_dialog_is_checked = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_show', true);
      
      $ddl_dialog_selected_page = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_page', true);

      // $ddl_dialog_query = new WP_Query(
      //   array(
      //     'post_type' => 'any',
      //     'p' => $ddl_dialog_selected_page
      //   )
      // );

      // var_dump($ddl_dialog_query);

      if ( is_page($ddl_dialog_selected_page) ) {

        if ($ddl_dialog_status == 'publish' && $ddl_dialog_is_checked == 1) {
          include plugin_dir_path( __FILE__ ) . './inc/dialog.php';
        }

      }

    endwhile;
    wp_reset_query();

  }

}

add_action( 'wp_footer', 'init_ddl_dialog', 1 );
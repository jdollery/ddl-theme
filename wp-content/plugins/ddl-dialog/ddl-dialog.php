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
      $ddl_dialog_is_visible = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_show', true);
      $ddl_dialog_session = get_post_meta( $ddl_dialog_post_Id, '_ddl_dialog_session', true );
      
      $ddl_dialog_selected_page = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_page', true);

      $ddl_dialog_query = null;
      
      if ( isset($ddl_dialog_selected_page) && ( is_page($ddl_dialog_selected_page) || is_single($ddl_dialog_selected_page) ) ) {
        $ddl_dialog_query = new WP_Query(
          array(
            'post_type' => 'any',
            'p' => $ddl_dialog_selected_page
          )
        );
      }
      
      if ( isset($ddl_dialog_query) ) {
      
        if ($ddl_dialog_status == 'publish' && $ddl_dialog_is_visible == 1) { ?>
          
          <div class="ddl-dialog<?php if ($ddl_dialog_session){ ?> ddl-dialog--session<?php } ?>" role="dialog" aria-modal="false" id="ddlDialog" data-dialog-id="<?php echo $ddl_dialog_post_Id ?>">
  
            <div class="ddl-dialog__backdrop" aria-label="Close" data-dialog-close ></div>
            
            <div class="ddl-dialog__inner">

              <button class="ddl-dialog__close" aria-label="Close" data-dialog-close tabindex="1" >
                <span class="hidden">Close</span>
              </button>
              
              <div class="ddl-dialog__body">

                <?php the_content(); ?>

              </div>

            </div>

          </div>

          <?php
          
        }
      
      }

    endwhile;
    wp_reset_query();

  }

}

add_action( 'wp_footer', 'init_ddl_dialog', 1 );
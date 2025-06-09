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

/* --------------------- PUBLIC --------------------- */

function ddl_dialog_enqueue() {

  wp_enqueue_style( 'ddl-dialog-styles', plugins_url('/assets/css/ddl-dialog-styles.css', __FILE__), array(), '', 'all' );
  wp_enqueue_script( 'ddl-dialog-script', plugins_url('/assets/js/ddl-dialog-script.js', __FILE__), array(), '', true ); 

}

add_action( 'wp_enqueue_scripts', 'ddl_dialog_enqueue' );


/* --------------------- ADMIN --------------------- */

function ddl_dialog_admin_scripts() {

  wp_enqueue_style( 'ddl-dialog-admin-styles', plugin_dir_url( __FILE__ ) . '/assets/css/ddl-dialog-admin-styles.css', array(), '', 'all' );
  wp_enqueue_script( 'ddl-dialog-admin-script', plugin_dir_url( __FILE__ ) . '/assets/js/ddl-dialog-admin-script.js', array( 'jquery' ), '1.0.0', true );

}

add_action( 'admin_enqueue_scripts', 'ddl_dialog_admin_scripts' );


/*-----------------------------------------------------------------------------------*/
/* INCLUDES */
/*-----------------------------------------------------------------------------------*/

include plugin_dir_path( __FILE__ ) . './inc/admin.php';
include plugin_dir_path( __FILE__ ) . './inc/post-type.php';


/*-----------------------------------------------------------------------------------*/
/* INIT DIALOG TO FOOTER FOR SELECTED PAGES/POSTS */
/*-----------------------------------------------------------------------------------*/

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

      $ddl_dialog_img_desktop = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_image_desktop', true);
      $ddl_dialog_img_desktop_alt = get_post_meta($ddl_dialog_img_desktop, '_wp_attachment_image_alt', true);
      
      $ddl_dialog_img_mobile = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_image_mobile', true);
      
      $ddl_dialog_selected_pages = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_pages', true);

      $ddl_dialog_width = get_post_meta( $ddl_dialog_post_Id, '_ddl_dialog_image_size', true ) === 'banner';

      $ddl_dialog_links = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_links', true);

      $ddl_dialog_query = null;
      
      if ( isset($ddl_dialog_selected_pages) && ( is_page($ddl_dialog_selected_pages) || is_single($ddl_dialog_selected_pages) ) ) {
        $ddl_dialog_query = new WP_Query(
          array(
            'post_type' => 'any',
            'p' => $ddl_dialog_selected_pages
          )
        );
      }
      
      if ( isset($ddl_dialog_query) ) {
      
        if ($ddl_dialog_status == 'publish' && $ddl_dialog_is_visible == 1) { ?>
          
          <div class="ddl-dialog<?php if ($ddl_dialog_session){ ?> ddl-dialog--session<?php } ?>" role="dialog" aria-modal="false" id="ddlDialog" data-dialog-id="<?php echo $ddl_dialog_post_Id ?>">
  
            <div class="ddl-dialog__backdrop" aria-label="Close" data-dialog-close ></div>
            
            <div class="ddl-dialog__inner<?php if($ddl_dialog_img_desktop && $ddl_dialog_width) { ?> ddl-dialog__inner--banner<?php } ?>">

              <button class="ddl-dialog__close" aria-label="Close" data-dialog-close tabindex="1" >
                <span class="hidden">Close</span>
              </button>
              
              <div class="ddl-dialog__body<?php if($ddl_dialog_img_desktop) { ?> ddl-dialog__body--img<?php } ?>">

                <?php if ($ddl_dialog_img_desktop) { ?>

                  <?php if ($ddl_dialog_links && count($ddl_dialog_links) === 1) { ?>
                    <a href="<?php echo $ddl_dialog_links[0] ?>">
                  <?php } ?>

                    <?php if ($ddl_dialog_img_mobile) { ?>
                      <picture>
                        <source type="image/jpg" media="(min-width: 700px)" srcset="<?php echo $ddl_dialog_img_desktop ?>">
                        <source type="image/jpg" media="(max-width: 699px)" srcset="<?php echo $ddl_dialog_img_mobile ?>">
                      <?php } ?>
                        <img 
                          src="<?php echo $ddl_dialog_img_desktop ?>"
                          alt="<?php if($ddl_dialog_img_desktop_alt) { echo $ddl_dialog_img_desktop_alt; } else { ?>Pop-up<?php } ?>"
                          width="200"
                          height="200"
                          loading="lazy"
                          decoding="async"
                        >
                    <?php if ($ddl_dialog_img_mobile) { ?>
                      </picture>
                    <?php } ?>

                  <?php if ($ddl_dialog_links && count($ddl_dialog_links) === 1) { ?>
                    </a>
                  <?php } ?>

                <?php } else {
                  
                  the_content(); 
                  
                } ?>

                <?php if ($ddl_dialog_links && count($ddl_dialog_links) > 1) { ?>

                  <div class="ddl-dialog__links">

                    <?php foreach ($ddl_dialog_links as $link) { ?>

                      <a href="<?php echo $link['0'] ?>"><?php echo $link['1'] ?></a>
                  
                    <?php } ?>

                  </div>

                <?php } ?>

              </div>

            </div>

          </div>

        <?php

        }

      }
      
    endwhile; wp_reset_query();

  }

}

add_action( 'wp_footer', 'init_ddl_dialog', 1 );
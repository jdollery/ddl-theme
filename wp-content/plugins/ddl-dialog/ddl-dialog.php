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

  $ddl_dialog_loop = new WP_Query( array(
    'post_type' => 'ddl-dialogs',
  ) );

  if ( $ddl_dialog_loop->have_posts() ) {

    while ( $ddl_dialog_loop->have_posts() ) : $ddl_dialog_loop->the_post();

    $ddl_dialog_post_Id = get_the_ID();
    $ddl_dialog_query = null;
    $ddl_dialog_status = get_post_status($ddl_dialog_post_Id);
    $ddl_dialog_is_visible = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_show', true);
    $ddl_dialog_selected_pages = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_pages', true);
      
    if ( isset($ddl_dialog_selected_pages) && ( is_page($ddl_dialog_selected_pages) || is_single($ddl_dialog_selected_pages) ) ) {
      $ddl_dialog_query = new WP_Query(
        array(
          'post_type' => 'any',
          'p' => $ddl_dialog_selected_pages
        )
      );
    }
    
    if ( isset($ddl_dialog_query) ) {
    
      if ($ddl_dialog_status == 'publish' && $ddl_dialog_is_visible == 1) {

        wp_enqueue_style( 'ddl-dialog-styles', plugins_url('/assets/css/ddl-dialog-styles.css', __FILE__), array(), '', 'all' );
        wp_enqueue_script( 'ddl-dialog-script', plugins_url('/assets/js/ddl-dialog-script.js', __FILE__), array(), '', true ); 

      }

    }

    endwhile; wp_reset_query();

  }

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
              
              <div class="ddl-dialog__body">

                <button class="ddl-dialog__close" aria-label="Close" data-dialog-close tabindex="1" >
                  <span class="hidden">Close</span>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z"></path></svg>
                </button>

                <?php if ($ddl_dialog_img_desktop) { ?>

                  <?php if (is_array($ddl_dialog_links) && count($ddl_dialog_links) === 1 ) { ?>

                    <?php foreach ($ddl_dialog_links as $link) { ?>

                      <a href="<?php echo $link['0'] ?>">
                  
                    <?php } ?>

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

                <?php } else { ?>
                  
                  <div class="ddl-dialog__content">
                    <?php the_content(); ?>
                  </div>
                  
                <?php } ?>

                <?php if ($ddl_dialog_links) { ?>

                  <?php if ($ddl_dialog_img_desktop && count($ddl_dialog_links) > 1 || !$ddl_dialog_img_desktop) { ?>

                    <div class="ddl-dialog__links">

                      <?php foreach ($ddl_dialog_links as $link) { ?>

                        <a href="<?php echo $link['0'] ?>"><?php echo $link['1'] ?></a>
                    
                      <?php } ?>

                    </div>

                  <?php } ?>

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


/*-----------------------------------------------------------------------------------*/
/* INIT DIALOG STYLES TO HEADER FOR SELECTED PAGES/POSTS */
/*-----------------------------------------------------------------------------------*/

function ddl_dialog_styles() { 

  $ddl_dialog_loop = new WP_Query( array(
    'post_type' => 'ddl-dialogs',
  ) );

  if ( $ddl_dialog_loop->have_posts() ) {

    while ( $ddl_dialog_loop->have_posts() ) : $ddl_dialog_loop->the_post();

    $ddl_dialog_post_Id = get_the_ID();
    $ddl_dialog_query = null;
    $ddl_dialog_status = get_post_status($ddl_dialog_post_Id);
    $ddl_dialog_is_visible = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_show', true);
    $ddl_dialog_selected_pages = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_pages', true);
      
    if ( isset($ddl_dialog_selected_pages) && ( is_page($ddl_dialog_selected_pages) || is_single($ddl_dialog_selected_pages) ) ) {
      $ddl_dialog_query = new WP_Query(
        array(
          'post_type' => 'any',
          'p' => $ddl_dialog_selected_pages
        )
      );
    }
    
    if ( isset($ddl_dialog_query) ) {
    
      if ($ddl_dialog_status == 'publish' && $ddl_dialog_is_visible == 1) {
        
        $ddl_dialog_bg = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_bg', true); 
        $ddl_dialog_txt = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_txt', true);
        $ddl_dialog_drop = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_drop', true);

        $ddl_dialog_close = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_close', true);
        $ddl_dialog_close_hover = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_close_hover', true);
        $ddl_dialog_icon = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_icon', true);
        $ddl_dialog_icon_hover = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_icon_hover', true);
        
        $ddl_dialog_odd_bg = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_odd_bg', true);
        $ddl_dialog_odd_bg_hover = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_odd_bg_hover', true);
        $ddl_dialog_odd_txt = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_odd_txt', true);
        $ddl_dialog_odd_txt_hover = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_odd_txt_hover', true);

        $ddl_dialog_even_bg = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_even_bg', true);
        $ddl_dialog_even_bg_hover = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_even_bg_hover', true);
        $ddl_dialog_even_txt = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_even_txt', true);
        $ddl_dialog_even_txt_hover = get_post_meta($ddl_dialog_post_Id, '_ddl_dialog_even_txt_hover', true);

      }

    ?>

    <style>

      .ddl-dialog {

        <?php if( $ddl_dialog_bg ) { ?>--ddl-dialog-bg: <?php echo $ddl_dialog_bg ?>;<?php } ?>
        <?php if( $ddl_dialog_txt ) { ?>--ddl-dialog-txt: <?php echo $txt ?>;<?php } ?>
        <?php if( $ddl_dialog_drop ) { ?>--ddl-dialog-drop: <?php echo $ddl_dialog_drop ?>;<?php } ?>

        <?php if( $ddl_dialog_close ) { ?>--ddl-dialog-close: <?php echo $ddl_dialog_close ?>;<?php } ?>
        <?php if( $ddl_dialog_close_hover ) { ?>--ddl-dialog-close-hover:<?php echo $ddl_dialog_close_hover ?>;<?php } ?>
        <?php if( $ddl_dialog_icon ) { ?>--ddl-dialog-icon:<?php echo $ddl_dialog_icon ?>;<?php } ?>
        <?php if( $ddl_dialog_icon_hover ) { ?>--ddl-dialog-icon-hover:<?php echo $ddl_dialog_icon_hover ?>;<?php } ?>

        <?php if( $ddl_dialog_odd_bg ) { ?>--ddl-dialog-odd-bg:<?php echo $ddl_dialog_odd_bg ?>;<?php } ?>
        <?php if( $ddl_dialog_odd_bg_hover ) { ?>--ddl-dialog-odd-bg-hover:<?php echo $ddl_dialog_odd_bg_hover ?>;<?php } ?>
        <?php if( $ddl_dialog_odd_txt ) { ?>--ddl-dialog-odd-txt:<?php echo $ddl_dialog_odd_txt ?>;<?php } ?>
        <?php if( $ddl_dialog_odd_txt_hover ) { ?>--ddl-dialog-odd-txt-hover:<?php echo $ddl_dialog_odd_txt_hover ?>;<?php } ?>

        <?php if( $ddl_dialog_even_bg ) { ?>--ddl-dialog-even-bg:<?php echo $ddl_dialog_even_bg ?>;<?php } ?>
        <?php if( $ddl_dialog_even_bg_hover ) { ?>--ddl-dialog-even-bg-hover:<?php echo $ddl_dialog_even_bg_hover ?>;<?php } ?>
        <?php if( $ddl_dialog_even_txt ) { ?>--ddl-dialog-even-txt:<?php echo $ddl_dialog_even_txt ?>;<?php } ?>
        <?php if( $ddl_dialog_even_txt_hover ) { ?>--ddl-dialog-even-txt-hover:<?php echo $ddl_dialog_even_txt_hover ?>;<?php } ?>

      }

    </style>

    <?php    

    }

    endwhile; wp_reset_query();

  }

}

add_action( 'wp_head', 'ddl_dialog_styles', 999);
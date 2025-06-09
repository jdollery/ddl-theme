<?php 

/* --------------------- REGISTER OPTIONS --------------------- */

// function add_dialog_options_page() {

//   // $icon = plugin_dir_url( __FILE__ ) . '/assets/img/cookie-icon.svg';

// 	add_menu_page (
// 		'Dialog Options',
// 		'DDL Dialog',
// 		'manage_options',
// 		'dialog-options-page',
// 		'display_dialog_options_page',
//     // $icon
// 	);

// }

// add_action( 'admin_menu', 'add_dialog_options_page' );


/* --------------------- STYLE THE ICON --------------------- */

// function admin_dialog_icon_style() {
//   echo '<style>
//     .toplevel_page_dialog-options-page .wp-menu-image img{
//       max-width: 18px;
//       max-height: 18px;  
//     }
//   </style>';
// }

// add_action('admin_head', 'admin_dialog_icon_style');


/* --------------------- DISPLAY OPTIONS FORM --------------------- */

// function display_dialog_options_page() {

// 	echo '<h1 style="margin: 30px 0 40px;">Dialog Options</h1>';

// 	echo '<form method="post" action="options.php">';

// 	do_settings_sections( 'dialog-options-page' );
// 	settings_fields( 'dialog-options' );

// 	submit_button();

// 	echo '</form>';

// }

/*-----------------------------------------------------------------------------------*/
/* DIALOG POST OPTIONS */
/*-----------------------------------------------------------------------------------*/

/* --------------------- ADD OPTIONS --------------------- */

function add_ddl_dialog_meta_boxes() {

  add_meta_box(
    'ddl_dialog_options',
    __( 'Dialog Options' ),
    'set_ddl_dialog_meta_boxes',
    'ddl-dialogs'
  );

}

add_action( 'add_meta_boxes', 'add_ddl_dialog_meta_boxes' );


/* --------------------- CREATE OPTIONS --------------------- */

function set_ddl_dialog_meta_boxes( $post ) { ?>

  <table class="form-table" role="presentation">

    <tr>
      
      <td>

        <?php 

          wp_nonce_field( 'ddl_dialog_show', 'ddl_dialog_show_nonce' );

          $ddl_dialog_show = get_post_meta( $post->ID, '_ddl_dialog_show', true );
          $ddl_dialog_is_visible = ((int)$ddl_dialog_show == 1) ? 'checked' : '';

        ?>

        <input type="checkbox" id="dialogShow" name="dialogShow" value="1" <?php echo $ddl_dialog_is_visible; ?> />
        <label for="dialogShow">Show dialog?</label>

      </td>

    </tr>
    <tr>

      <td>

        <?php 

          wp_nonce_field( 'ddl_dialog_session', 'ddl_dialog_session_nonce' );

          $ddl_dialog_session = get_post_meta( $post->ID, '_ddl_dialog_session', true );
          $ddl_dialog_is_session = ((int)$ddl_dialog_session == 1) ? 'checked' : '';

        ?>

        <fieldset>
          <legend class="screen-reader-text"><span>Show dialog only once per session?</span></legend>
          <input type="checkbox" id="dialogSession" name="dialogSession" value="1" <?php echo $ddl_dialog_is_session; ?> />
          <label for="dialogSession">Show dialog only once per session?</label>
          <p class="description">Recommended for a better user experience.</p>
        </fieldset>
        
      </td>

    </tr>
    <tr>

      <td>

        <?php

        $front_page_id = get_option('page_on_front');
        $front_page_title = get_the_title($front_page_id);
        
        $ddl_dialog_selected_pages = get_post_meta($post->ID, '_ddl_dialog_pages', true);
        
        // If no pages are selected yet, add an empty array
        if (!is_array($ddl_dialog_selected_pages)) {
          $ddl_dialog_selected_pages = array();
        }
        
        ?>
        
        <fieldset>

          <legend class="screen-reader-text"><span>Enter a &ldquo;Post ID&rdquo; to select a post/page</span></legend>
      
          <div class="dialog__options">

            <p>Enter a &ldquo;Post ID&rdquo; to select a post/page (e.g &ldquo;<?php echo $front_page_id ?>&rdquo; for the &ldquo;<?php echo $front_page_title ?>&rdquo; page):</p>

            <div class="dialog__list" id="dialogList">
    
              <?php foreach ($ddl_dialog_selected_pages as $i => $selected_page) {
              
                  echo '<div class="dialog__row dialog__row--pages"><input type="number" name="dialogPageID[' . $i . ']" value="' . esc_attr($selected_page) . '"/><button type="button" class="dialog__remove button" id="removeDialog">Remove</button></div>';
              
                }

              ?>
    
            </div>
    
            <button type="button" class="dialog__add button-primary" id="addDialog" data-number="<?php echo count($ddl_dialog_selected_pages); ?>">Add Post ID</button>
      
          </div>
        
        </fieldset>

      </td>

    </tr>
    <tr>

      <td>

        <div class="dialog__status dialog__status--<?php if ($ddl_dialog_is_visible) { ?>visible<?php } else { ?>hidden<?php } ?>">

          <h4>Dialog is currently <?php if ($ddl_dialog_is_visible) { ?><strong>visible</strong><?php } else { ?><strong>hidden</strong><?php } ?> on the following page/s:</h4>
          
          <ol>

            <?php foreach ($ddl_dialog_selected_pages as $selected_page) {

              $page_title = get_the_title($selected_page);

            ?>

              <li class="description"><?php echo $page_title; ?></li>

            <?php } ?>

          </ol>

        </div>

      </td>

    </tr>
    <tr>

      <td>

        <div class="dialog__options">

          <p>Image upload (mobile will show below 700px):</p>

          <div class="dialog__img dialog__img--desktop">

            <?php 
            
              $ddl_dialog_img_desktop = get_post_meta($post->ID, '_ddl_dialog_image_desktop', true);
              $ddl_dialog_img_filename = basename($ddl_dialog_img_desktop);
            
            ?>

            <div class="dialog__control">

              <div>
                <input type="hidden" class="dialog__input" id="dialogImgDesktop" name="dialogImgDesktop" value="<?php echo $ddl_dialog_img_desktop; ?>"/>
                <button type="button" class="dialog__upload button-primary" id="dialogImgBtnDesktop">Select a desktop image</button>
              </div>
            
              <div class="dialog__thumb">
                <p class="dialog__file"><?php echo $ddl_dialog_img_filename ?></p>
                <?php if ($ddl_dialog_img_filename) { ?>
                  <button type="button" class="dialog__delete button">Remove</button>
                <?php } ?>
              </div>

            </div>          

          </div>

          <div class="dialog__img dialog__img--mobile">

            <?php 
            
              $ddl_dialog_img_mobile = get_post_meta($post->ID, '_ddl_dialog_image_mobile', true);
              $ddl_dialog_img_filename = basename($ddl_dialog_img_mobile);
            
            ?>

            <div class="dialog__control">

              <div>
                <input type="hidden" class="dialog__input" id="dialogImgMobile" name="dialogImgMobile" value="<?php echo $ddl_dialog_img_mobile; ?>"/>
                <button type="button" class="dialog__upload button-primary" id="dialogImgBtnMobile">Select a mobile image</button>
              </div>

              <div class="dialog__thumb">
                <p class="dialog__file"><?php echo $ddl_dialog_img_filename ?></p>
                <?php if ($ddl_dialog_img_filename) { ?>
                  <button type="button" class="dialog__delete button">Remove</button>
                <?php } ?>
              </div> 

            </div>

          </div>

          <p class="description">Adding images will override the content below.</p>

          <hr>

          <label for="dialogImgSize">Image width:</label>

          <table>
            <tr>
              <td><input type="radio" name="dialogImgSize" value="standard" <?php if ( get_post_meta( $post->ID, '_ddl_dialog_image_size', true ) === '' || get_post_meta( $post->ID, '_ddl_dialog_image_size', true ) === 'standard' ) echo 'checked="checked"'; ?> /> Standard (600px wide)</td>
              <td><input type="radio" name="dialogImgSize" value="banner" <?php checked( get_post_meta( $post->ID, '_ddl_dialog_image_size', true ), 'banner' ); ?> /> Banner (800px wide)</td>
            </tr>
          </table>

          <p class="description">If no image is added the default width of 600px will be set.</p>

        </div>

      </td>

    </tr>

    <tr>

      <td>

        <?php
        
        $ddl_dialog_links = get_post_meta($post->ID, '_ddl_dialog_links', true);
        
        // If no pages are selected yet, add an empty array
        if (!is_array($ddl_dialog_links)) {
          $ddl_dialog_links = array();
        }
        
        ?>
        
        <fieldset>

          <legend class="screen-reader-text"><span>Enter urls to add links</span></legend>
      
          <div class="dialog__options">

            <p>Enter urls to add links:</p>

            <div class="dialog__list" id="dialogLinks">
    
              <?php foreach ($ddl_dialog_links as $i => $link) {
              
                  echo '<div class="dialog__row"><input type="text" name="dialogLink[' . $i . ']" value="' . esc_attr($link) . '"/><button type="button" class="dialog__remove button" id="removeLink">Remove</button></div>';
              
                }

              ?>
    
            </div>
    
            <button type="button" class="dialog__add button-primary" id="addLink" data-number="<?php echo count($ddl_dialog_links); ?>">Add Link</button>
      
          </div>
        
        </fieldset>

      </td>

    </tr>

  </table>

  <?php

}


/* --------------------- SAVE OPTIONS --------------------- */

function save_ddl_dialog_meta_boxes( $post_id ) {

  $ddl_dialog_visible = isset( $_POST['dialogShow'] ) && $_POST['dialogShow'] == 1 ? 1 : 0;
  update_post_meta( $post_id, '_ddl_dialog_show', $ddl_dialog_visible );

  $ddl_dialog_pages = !empty($_POST['dialogPageID']) ? array_map('sanitize_text_field', $_POST['dialogPageID']) : array();
  update_post_meta($post_id, '_ddl_dialog_pages', $ddl_dialog_pages);

  $ddl_dialog_session = isset( $_POST['dialogSession'] ) && $_POST['dialogSession'] == 1 ? 1 : 0;
  update_post_meta( $post_id, '_ddl_dialog_session', $ddl_dialog_session );

  $ddl_dialog_img_desktop = isset( $_POST['dialogImgDesktop'] ) ? sanitize_text_field($_POST['dialogImgDesktop']) : '';
  update_post_meta( $post_id, '_ddl_dialog_image_desktop', $ddl_dialog_img_desktop );
  
  $ddl_dialog_img_mobile = isset( $_POST['dialogImgMobile'] ) ? sanitize_text_field($_POST['dialogImgMobile']) : '';
  update_post_meta( $post_id, '_ddl_dialog_image_mobile', $ddl_dialog_img_mobile );

  $ddl_dialog_image_size = isset( $_POST['dialogImgSize'] ) ? sanitize_text_field($_POST['dialogImgSize']) : '';
  update_post_meta( $post_id, '_ddl_dialog_image_size', $ddl_dialog_image_size );

  $ddl_dialog_links = !empty($_POST['dialogLink']) ? array_map('sanitize_text_field', $_POST['dialogLink']) : array();
  update_post_meta($post_id, '_ddl_dialog_links', $ddl_dialog_links);

}

add_action('save_post', 'save_ddl_dialog_meta_boxes');
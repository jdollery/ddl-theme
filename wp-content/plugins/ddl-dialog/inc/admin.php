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

  <div class="dialog__table" role="presentation">

    <div>
    
      <div>

        <?php 

          wp_nonce_field( 'ddl_dialog_show', 'ddl_dialog_show_nonce' );

          $ddl_dialog_show = get_post_meta( $post->ID, '_ddl_dialog_show', true );
          $ddl_dialog_is_visible = ((int)$ddl_dialog_show == 1) ? 'checked' : '';

        ?>

        <input type="checkbox" id="dialogShow" name="dialogShow" value="1" <?php echo $ddl_dialog_is_visible; ?> />
        <label for="dialogShow">Show dialog?</label>

      </div>

    </div>
    <div>

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
        
    </div>

    <?php

      $front_page_id = get_option('page_on_front');
      $front_page_title = get_the_title($front_page_id);
      
      $ddl_dialog_selected_pages = get_post_meta($post->ID, '_ddl_dialog_pages', true);
      
      // If no pages are selected yet, add an empty array
      if (!is_array($ddl_dialog_selected_pages)) {
        $ddl_dialog_selected_pages = array();
      }
      
    ?>

    <div>

      <div class="dialog__status dialog__status--<?php if ($ddl_dialog_is_visible) { ?>visible<?php } else { ?>hidden<?php } ?>">

        <h3>Dialog is currently <?php if ($ddl_dialog_is_visible) { ?><strong>visible</strong><?php } else { ?><strong>hidden</strong><?php } ?> on the following page/s:</h3>
        
        <ol>

          <?php foreach ($ddl_dialog_selected_pages as $selected_page) {

            $page_title = get_the_title($selected_page);

          ?>

            <li class="description"><?php echo $page_title; ?></li>

          <?php } ?>

        </ol>

      </div>

    </div>
    <div>
      
      <fieldset>

        <legend class="screen-reader-text"><span>Page options</span></legend>
    
        <div class="dialog__options">

          <h3>Page options</h3>
          
          <p>Enter a &ldquo;Post ID&rdquo; to select a post/page (e.g &ldquo;<?php echo $front_page_id ?>&rdquo; for the &ldquo;<?php echo $front_page_title ?>&rdquo; page):</p>

          <div class="dialog__list" id="dialogList">

            <?php foreach ($ddl_dialog_selected_pages as $i => $selected_page) {
            
                echo '<div class="dialog__row dialog__row--pages"><input type="number" name="dialogPageID[' . $i . ']" value="' . esc_attr($selected_page) . '"/><button type="button" class="dialog__remove button">Remove</button></div>';
            
              }

            ?>

          </div>

          <button type="button" class="dialog__add button-primary" id="addDialog" data-number="<?php echo count($ddl_dialog_selected_pages); ?>">Add Post ID</button>
    
        </div>
      
      </fieldset>

    </div>

    <div>

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

          <h3>Link/button options</h3>

          <div class="dialog__list" id="dialogLinks">
  
            <?php foreach ($ddl_dialog_links as $i => $link) {

              $link_url = isset($link['0']) ? $link['0'] : '';
              $link_text = isset($link['1']) ? $link['1'] : '';
                                        
              echo '<div class="dialog__row dialog__row--links">
                      <input type="text" name="dialogLink[' . $i . '][0]" placeholder="URL" value="' . esc_attr($link_url) . '"/>
                      <input type="text" name="dialogLink[' . $i . '][1]" placeholder="Link/Button text" value="' . esc_attr($link_text) . '" />
                      <button type="button" class="dialog__remove button">Remove</button>
                    </div>';

            }

            ?>
  
          </div>
  
          <button type="button" class="dialog__add button-primary" id="addLink" data-number="<?php echo count($ddl_dialog_links); ?>">Add Link</button>

          <p class="description">If there are no images, the button/s will show below the content.<br>If there is an image and multiple links, the buttons will also show below the image.<br>If there is an image, but only one link, the link will wrap around the image.</p>
    
        </div>
      
      </fieldset>

      <div class="dialog__options">

        <h3>Image upload</h3>

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

        <p class="description">Adding images will override the content.<br>Mobile will show below 700px.</p>

        <hr>

        <h3>Image width options</h3>

        <table>
          <tr>
            <td><input type="radio" id="dialogImgStandard" name="dialogImgSize" value="standard" <?php if ( get_post_meta( $post->ID, '_ddl_dialog_image_size', true ) === '' || get_post_meta( $post->ID, '_ddl_dialog_image_size', true ) === 'standard' ) echo 'checked="checked"'; ?> /> <label for="dialogImgStandard">Standard (600px wide)</label></td>
            <td><input type="radio" id="dialogImgBanner" name="dialogImgSize" value="banner" <?php checked( get_post_meta( $post->ID, '_ddl_dialog_image_size', true ), 'banner' ); ?> /> <label for="dialogImgBanner">Banner (800px wide)</label></td>
          </tr>
        </table>

        <p class="description">If no desktop image is added, a default width of 600px will be applied.</p>

      </div>

    </div>

    <div>

      <fieldset>

        <legend class="screen-reader-text"><span>Close and button colours</span></legend>
    
        <div class="dialog__options">

          <h3>Colour options</h3>

          <?php $ddl_dialog_bg = get_post_meta($post->ID, '_ddl_dialog_bg', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogBackground">Dialog background:</label></li>
            <li><input type="text" id="dialogBackground" name="dialogBackground" value="<?php echo $ddl_dialog_bg; ?>" placeholder="#ffffff"/></li>
          </ul>

          <?php $ddl_dialog_txt = get_post_meta($post->ID, '_ddl_dialog_txt', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogText">Dialog text:</label></li>
            <li><input type="text" id="dialogText" name="dialogText" value="<?php echo $ddl_dialog_txt; ?>" placeholder="#303030"/></li>
          </ul>

          <?php $ddl_dialog_drop = get_post_meta($post->ID, '_ddl_dialog_drop', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogDrop">Dialog backdrop:</label></li>
            <li><input type="text" id="dialogDrop" name="dialogDrop" value="<?php echo $ddl_dialog_drop; ?>" placeholder="#303030"/></li>
          </ul>

          <hr>

          <?php $ddl_dialog_close = get_post_meta($post->ID, '_ddl_dialog_close', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogClose">Close background:</label></li>
            <li><input type="text" id="dialogClose" name="dialogClose" value="<?php echo $ddl_dialog_close; ?>" placeholder="#565656"/></li>
          </ul>

          <?php $ddl_dialog_close_hover = get_post_meta($post->ID, '_ddl_dialog_close_hover', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogClose">Close background hover/focus:</label></li>
            <li><input type="text" id="dialogCloseHover" name="dialogCloseHover" value="<?php echo $ddl_dialog_close_hover; ?>" placeholder="#303030"/></li>
          </ul>

          <?php $ddl_dialog_icon = get_post_meta($post->ID, '_ddl_dialog_icon', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogIcon">Close icon:</label></li>
            <li><input type="text" id="dialogIcon" name="dialogIcon" value="<?php echo $ddl_dialog_icon; ?>" placeholder="#ffffff"/></li>
          </ul>

          <?php $ddl_dialog_icon_hover = get_post_meta($post->ID, '_ddl_dialog_icon_hover', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogIconHover">Close icon hover/focus:</label></li>
            <li><input type="text" id="dialogIconHover" name="dialogIconHover" value="<?php echo $ddl_dialog_icon_hover; ?>" placeholder="#ffffff"/></li>
          </ul>

          <hr>

          <?php $ddl_dialog_odd_bg = get_post_meta($post->ID, '_ddl_dialog_odd_bg', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogOddBg">Odd number button background:</label></li>
            <li><input type="text" id="dialogOddBg" name="dialogOddBg" value="<?php echo $ddl_dialog_odd_bg; ?>" placeholder="#565656"/></li>
          </ul>

          <?php $ddl_dialog_odd_bg_hover = get_post_meta($post->ID, '_ddl_dialog_odd_bg_hover', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogOddBgHover">Odd number button background hover/focus:</label></li>
            <li><input type="text" id="dialogOddBgHover" name="dialogOddBgHover" value="<?php echo $ddl_dialog_odd_bg_hover; ?>" placeholder="#444444"/></li>
          </ul>

          <?php $ddl_dialog_odd_txt = get_post_meta($post->ID, '_ddl_dialog_odd_txt', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogOddTxt">Odd number button text:</label></li>
            <li><input type="text" id="dialogOddTxt" name="dialogOddTxt" value="<?php echo $ddl_dialog_odd_txt; ?>" placeholder="#ffffff"/></li>
          </ul>

          <?php $ddl_dialog_odd_txt_hover = get_post_meta($post->ID, '_ddl_dialog_odd_txt_hover', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogOddTxtHover">Odd number button text hover/focus:</label></li>
            <li><input type="text" id="dialogOddTxtHover" name="dialogOddTxtHover" value="<?php echo $ddl_dialog_odd_txt_hover; ?>" placeholder="#ffffff"/></li>
          </ul>

          <?php $ddl_dialog_even_bg = get_post_meta($post->ID, '_ddl_dialog_even_bg', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogEvenBg">Even number button background:</label></li>
            <li><input type="text" id="dialogEvenBg" name="dialogEvenBg" value="<?php echo $ddl_dialog_even_bg; ?>" placeholder="#303030"/></li>
          </ul>

          <?php $ddl_dialog_even_bg_hover = get_post_meta($post->ID, '_ddl_dialog_even_bg_hover', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogEvenBgHover">Even number button background hover/focus:</label></li>
            <li><input type="text" id="dialogEvenBgHover" name="dialogEvenBgHover" value="<?php echo $ddl_dialog_even_bg_hover; ?>" placeholder="#1d1d1d"/></li>
          </ul>

          <?php $ddl_dialog_even_txt = get_post_meta($post->ID, '_ddl_dialog_even_txt', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogEvenTxt">Even number button text:</label></li>
            <li><input type="text" id="dialogEvenTxt" name="dialogEvenTxt" value="<?php echo $ddl_dialog_even_txt; ?>" placeholder="#ffffff"/></li>
          </ul>

          <?php $ddl_dialog_even_txt_hover = get_post_meta($post->ID, '_ddl_dialog_even_txt_hover', true); ?>

          <ul class="dialog__colors">
            <li><label for="dialogEvenTxtHover">Even number button text hover/focus:</label></li>
            <li><input type="text" id="dialogEvenTxtHover" name="dialogEvenTxtHover" value="<?php echo $ddl_dialog_even_txt_hover; ?>" placeholder="#ffffff"/></li>
          </ul>

          <!-- <p class="description">If there is no image, the button/s will show below the content.<br>If there is an image and multiple links, the buttons will also show below the image.<br>If there is an image, but only one link, the link will wrap around the image.</p> -->
        
        </div>
      
      </fieldset>

    </div>

  </div>

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

  $ddl_dialog_links = !empty($_POST['dialogLink']) ? array_map( function($link) {
    return array_map('sanitize_text_field', $link);
  }, $_POST['dialogLink']) : array();
  
  update_post_meta($post_id, '_ddl_dialog_links', $ddl_dialog_links);

  $ddl_dialog_bg = isset( $_POST['dialogBackground'] ) ? sanitize_text_field($_POST['dialogBackground']) : '';
  update_post_meta( $post_id, '_ddl_dialog_bg', $ddl_dialog_bg );

  $ddl_dialog_txt = isset( $_POST['dialogText'] ) ? sanitize_text_field($_POST['dialogText']) : '';
  update_post_meta( $post_id, '_ddl_dialog_txt', $ddl_dialog_txt );

  $ddl_dialog_drop = isset( $_POST['dialogDrop'] ) ? sanitize_text_field($_POST['dialogDrop']) : '';
  update_post_meta( $post_id, '_ddl_dialog_drop', $ddl_dialog_drop );

  $ddl_dialog_close = isset( $_POST['dialogClose'] ) ? sanitize_text_field($_POST['dialogClose']) : '';
  update_post_meta( $post_id, '_ddl_dialog_close', $ddl_dialog_close );

  $ddl_dialog_close_hover = isset( $_POST['dialogCloseHover'] ) ? sanitize_text_field($_POST['dialogCloseHover']) : '';
  update_post_meta( $post_id, '_ddl_dialog_close_hover', $ddl_dialog_close_hover );

  $ddl_dialog_icon = isset( $_POST['dialogIcon'] ) ? sanitize_text_field($_POST['dialogIcon']) : '';
  update_post_meta( $post_id, '_ddl_dialog_icon', $ddl_dialog_icon );

  $ddl_dialog_icon_hover = isset( $_POST['dialogIconHover'] ) ? sanitize_text_field($_POST['dialogIconHover']) : '';
  update_post_meta( $post_id, '_ddl_dialog_icon_hover', $ddl_dialog_icon_hover );

  $ddl_dialog_odd_bg = isset( $_POST['dialogOddBg'] ) ? sanitize_text_field($_POST['dialogOddBg']) : '';
  update_post_meta( $post_id, '_ddl_dialog_odd_bg', $ddl_dialog_odd_bg );

  $ddl_dialog_odd_bg_hover = isset( $_POST['dialogOddBgHover'] ) ? sanitize_text_field($_POST['dialogOddBgHover']) : '';
  update_post_meta( $post_id, '_ddl_dialog_odd_bg_hover', $ddl_dialog_odd_bg_hover );

  $ddl_dialog_odd_txt = isset( $_POST['dialogOddTxt'] ) ? sanitize_text_field($_POST['dialogOddTxt']) : '';
  update_post_meta( $post_id, '_ddl_dialog_odd_txt', $ddl_dialog_odd_txt );

  $ddl_dialog_odd_txt_hover = isset( $_POST['dialogOddTxtHover'] ) ? sanitize_text_field($_POST['dialogOddTxtHover']) : '';
  update_post_meta( $post_id, '_ddl_dialog_odd_txt_hover', $ddl_dialog_odd_txt_hover );

  $ddl_dialog_even_bg = isset( $_POST['dialogEvenBg'] ) ? sanitize_text_field($_POST['dialogEvenBg']) : '';
  update_post_meta( $post_id, '_ddl_dialog_even_bg', $ddl_dialog_even_bg );

  $ddl_dialog_even_bg_hover = isset( $_POST['dialogEvenBgHover'] ) ? sanitize_text_field($_POST['dialogEvenBgHover']) : '';
  update_post_meta( $post_id, '_ddl_dialog_even_bg_hover', $ddl_dialog_even_bg_hover );

  $ddl_dialog_even_txt = isset( $_POST['dialogEvenTxt'] ) ? sanitize_text_field($_POST['dialogEvenTxt']) : '';
  update_post_meta( $post_id, '_ddl_dialog_even_txt', $ddl_dialog_even_txt );

  $ddl_dialog_even_txt_hover = isset( $_POST['dialogEvenTxtHover'] ) ? sanitize_text_field($_POST['dialogEvenTxtHover']) : '';
  update_post_meta( $post_id, '_ddl_dialog_even_txt_hover', $ddl_dialog_even_txt_hover );

}

add_action('save_post', 'save_ddl_dialog_meta_boxes');
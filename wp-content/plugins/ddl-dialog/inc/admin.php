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

        $front_page_id = get_option('page_on_front');
        $front_page_title = get_the_title($front_page_id);
        
        $ddl_dialog_selected_pages = get_post_meta($post->ID, '_ddl_dialog_pages', true);
        
        // If no pages are selected yet, add an empty array
        if (!is_array($ddl_dialog_selected_pages)) {
          $ddl_dialog_selected_pages = array();
        }
        
        ?>

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
        
        <fieldset>

          <legend class="screen-reader-text"><span>Enter a &ldquo;Post ID&rdquo; to select a post/page</span></legend>
      
          <div class="dialog__options">

            <p>Enter a &ldquo;Post ID&rdquo; to select a post/page (e.g &ldquo;<?php echo $front_page_id ?>&rdquo; for the &ldquo;<?php echo $front_page_title ?>&rdquo; page):</p>

            <div class="dialog__list" id="dialogList">
    
              <?php foreach ($ddl_dialog_selected_pages as $i => $selected_page) {
              
                  echo '<div class="dialog__row"><input type="number" name="dialogPageID[' . $i . ']" value="' . esc_attr($selected_page) . '"/><button type="button" class="dialog__remove button" id="removeDialog">Remove</button></div>';
              
                }

              ?>
    
            </div>
    
            <button type="button" class="dialog__add button-primary" id="addDialog" data-number="<?php echo count($ddl_dialog_selected_pages); ?>">Add</button>
      
          </div>
        
        </fieldset>

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
    
  </table>

  <?php

}


/* --------------------- SAVE OPTIONS --------------------- */

function save_ddl_dialog_meta_boxes( $post_id ) {

  $ddl_dialog_visible = isset( $_POST['dialogShow'] ) && $_POST['dialogShow'] == 1 ? 1 : 0;
  update_post_meta( $post_id, '_ddl_dialog_show', $ddl_dialog_visible );

  if (isset($_POST['dialogPageID'])) {
    $ddl_dialog_pages = array_map('sanitize_text_field', $_POST['dialogPageID']);
    update_post_meta($post_id, '_ddl_dialog_pages', $ddl_dialog_pages);
  }

  $ddl_dialog_session = isset( $_POST['dialogSession'] ) && $_POST['dialogSession'] == 1 ? 1 : 0;
  update_post_meta( $post_id, '_ddl_dialog_session', $ddl_dialog_session );

}

add_action('save_post', 'save_ddl_dialog_meta_boxes');
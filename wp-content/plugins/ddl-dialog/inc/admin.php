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

          <input type="checkbox" id="ddlDialogShow" name="ddlDialogShow" value="1" <?php echo $ddl_dialog_is_visible; ?> />
          <label for="ddlDialogShow">Show dialog?</label>

        </td>

      </tr>
      <tr>

        <td>

          <?php

          $front_page_id = get_option('page_on_front');
          $front_page_title = get_the_title($front_page_id);

          ?>

          <label for="ddlDialogPage" style="display: block;margin-bottom: 8px;">Enter a &ldquo;Post ID&rdquo; to select a post/page (e.g &ldquo;<?php echo $front_page_id ?>&rdquo; for the &ldquo;<?php echo $front_page_title ?>&rdquo; page):</label>

          <?php           

          $ddl_dialog_selected_page = get_post_meta($post->ID, '_ddl_dialog_page', true); 
          
          $ddl_dialog_page_title = get_the_title($ddl_dialog_selected_page);

          ?>
          
          <fieldset>
            <legend class="screen-reader-text"><span>Enter a &ldquo;Post ID&rdquo; to select a post/page</span></legend>
            <input type="number" name="ddlDialogPageID" id="ddlDialogPageID" value="<?php echo $ddl_dialog_selected_page; ?>"/>
            <p class="description">Dialog is currently <?php if ( $ddl_dialog_is_visible ) { ?><strong style="color: #198754">visible</strong><?php } else { ?><strong style="color: #d63638">hidden</strong><?php } ?> on the &ldquo;<?php echo $ddl_dialog_page_title ?>&rdquo; <?php if ( get_post_type($ddl_dialog_selected_page) == 'post' ) { ?>post<?php } else { ?>page<?php } ?>.</p>
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
            <input type="checkbox" id="ddlDialogSession" name="ddlDialogSession" value="1" <?php echo $ddl_dialog_is_session; ?> />
            <label for="ddlDialogSession">Show dialog only once per session?</label>
            <p class="description">Recommended for a better user experience.</p>
          </fieldset>
          
        </td>

      </tr>
    </table>

    <?php
}


/* --------------------- SAVE OPTIONS --------------------- */

function save_ddl_dialog_meta_boxes( $post_id ) {

  $ddlDialogVisible = isset( $_POST['ddlDialogShow'] ) && $_POST['ddlDialogShow'] == 1 ? 1 : 0;
  update_post_meta( $post_id, '_ddl_dialog_show', $ddlDialogVisible );

  if (isset($_POST['ddlDialogPageID'])) {
    update_post_meta($post_id, '_ddl_dialog_page', sanitize_text_field($_POST['ddlDialogPageID']));
  }

  $ddlDialogSession = isset( $_POST['ddlDialogSession'] ) && $_POST['ddlDialogSession'] == 1 ? 1 : 0;
  update_post_meta( $post_id, '_ddl_dialog_session', $ddlDialogSession );

}

add_action('save_post', 'save_ddl_dialog_meta_boxes');
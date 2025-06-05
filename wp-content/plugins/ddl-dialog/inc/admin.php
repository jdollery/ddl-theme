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


function set_ddl_dialog_meta_boxes( $post ) {

    wp_nonce_field( 'ddl_dialog_show', 'ddl_dialog_show_nonce' );

    $ddl_dialog_value = get_post_meta( $post->ID, '_ddl_dialog_show', true );
    $ddl_dialog_is_checked = ((int)$ddl_dialog_value == 1) ? 'checked' : '';

    ?>

    <table class="form-table" role="presentation">
      <tr>
        
        <td>
          <input type="checkbox" id="ddlDialogShow" name="ddlDialogShow" value="1" <?php echo $ddl_dialog_is_checked; ?>/>
          <label for="ddlDialogShow">Show dialog?</label>
        </td>

      </tr>
      <tr>

        <td>
          <label for="ddlDialogPage" style="display: block;margin-bottom: 8px;">Select a page:</label>

          <?php
          
            $ddl_dialog_selected_page = get_post_meta($post->ID, '_ddl_dialog_page', true);
            wp_dropdown_pages(array(
              'name' => 'ddlDialogPage',
              'echo' => 1,
              'show_option_none' => '-- Select a page --',
              'option_none_value' => '',
              'selected' => $ddl_dialog_selected_page
            ));

          ?>

        </td>

      </tr>
    </table>

    <?php
}


/* --------------------- SAVE OPTIONS --------------------- */

function save_ddl_dialog_meta_boxes( $post_id ) {

  $visible = isset( $_POST['ddlDialogShow'] ) && $_POST['ddlDialogShow'] == 1;
  $visible = $visible ? 1 : 0;
  update_post_meta( $post_id,  '_ddl_dialog_show', $visible );

  if (isset($_POST['ddlDialogPage'])) {
      update_post_meta($post_id, '_ddl_dialog_page', $_POST['ddlDialogPage']);
  }

}

add_action( 'save_post',  'save_ddl_dialog_meta_boxes' );
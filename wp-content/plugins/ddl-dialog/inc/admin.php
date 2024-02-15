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

function clients_custom_metaboxes() {

  //Visibility
  add_meta_box(
      'clients_visible',
      __( 'Show on clients page' ),
      'infotravel_clients_visible_metabox',
      'ddl-dialogs'
  );
}

add_action( 'add_meta_boxes', 'clients_custom_metaboxes' );

function infotravel_clients_visible_metabox( $post ) {
  wp_nonce_field( 'clients_show', 'clients_show_nonce' );
  $value = get_post_meta( $post->ID, '_clients_show', true );
  $is_checked = ((int)$value == 1) ? 'checked' : '';
  ?>
  <input type="checkbox" id="chkClientShow" name="chkClientShow" value="1" <?php echo $is_checked; ?>/>
  <label for="chkClientShow">Show this client on Clients page</label>
  <?php
}


function infotravel_save_clients_meta( $post_id ) {

  $visible = isset( $_POST['chkClientShow'] ) && $_POST['chkClientShow'] == 1;
  $visible = (int)$visible;
  update_post_meta( $post_id,  '_clients_show', $visible );

}

add_action( 'save_post',  'infotravel_save_clients_meta' );
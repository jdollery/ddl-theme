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
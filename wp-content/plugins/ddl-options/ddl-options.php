<?php
/*
Plugin Name: DDL Options
Version: 1.0.0
Description: Global site variables and schema options.
Author: Dental Design
Author URI: https://dental-design.marketing/
License: GPL2
*/


/*-----------------------------------------------------------------------------------*/
/* ADD OPTIONS TO ADMIN */
/*-----------------------------------------------------------------------------------*/

/* --------------------- REGISTER OPTIONS --------------------- */

function add_site_options_page() {

  $icon = plugin_dir_url( __FILE__ ) . '/assets/img/options-icon.svg';

	add_menu_page (
		'Site Options',
		'Site Options',
		'manage_options',
		'site-options-page',
		'display_site_options_page',
    $icon
	);

}

add_action( 'admin_menu', 'add_site_options_page' );


/* --------------------- STYLE THE ICON --------------------- */

function admin_site_icon_style() {
  echo '<style>
    #toplevel_page_site-options-page .wp-menu-image img {
      max-width: 22px;
      max-height: 22px; 
      padding: 6px 0 0 !important; 
    }
  </style>';
}

add_action('admin_head', 'admin_site_icon_style');


/* --------------------- DISPLAY OPTIONS FORM --------------------- */

function display_site_options_page() {

	echo '<h1 style="margin: 30px 0 40px;">Global variables and schema options</h1>';

	echo '<form method="post" action="options.php">';

	do_settings_sections( 'site-options-page' );
	settings_fields( 'site-options' );

	submit_button();

	echo '</form>';

}


/*-----------------------------------------------------------------------------------*/
/* SITE INFORMATION SETTINGS SECTION */
/*-----------------------------------------------------------------------------------*/

function admin_init_site_info_section() {

	add_settings_section (
		'site-info-section',
		'Site Information',
		'site_info_section_message',
		'site-options-page'
	);

  
  /* --------------------- SECTION MESSAGE --------------------- */

  function site_info_section_message() {
    echo "Use these options to add practice information used on the site and in the schema.";
  }


  /* --------------------- ADD FIELDS --------------------- */

  add_settings_field (
    'site-description',
    'Site description:',
    'render_site_description',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-booking-link',
    'Booking link:',
    'render_site_booking_link',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-phone-number',
    'Telephone number:',
    'render_site_phone_number',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-whatsapp-number',
    'WhatsApp number:',
    'render_site_whatsapp_number',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-email-address',
    'Email address:',
    'render_site_email_address',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-street-address',
    'Street address:',
    'render_site_street_address',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-address-locality',
    'Address locality (i.e. city):',
    'render_site_address_locality',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-address-region',
    'Address region (i.e. county):',
    'render_site_address_region',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-postal-code',
    'Postcode:',
    'render_site_postal_code',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-address-country',
    'Country:',
    'render_site_address_country',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-directions',
    'Directions:',
    'render_site_directions',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-times',
    'Opening times:',
    'render_site_times',
    'site-options-page',
    'site-info-section'
  );

  add_settings_field (
    'site-social',
    'Social channels:',
    'render_site_social',
    'site-options-page',
    'site-info-section'
  );


  /* --------------------- REGISTER FIELDS --------------------- */

  register_setting ('site-options','site-description');
  register_setting ('site-options','site-booking-link');
  register_setting ('site-options','site-phone-number');
  register_setting ('site-options','site-whatsapp-number');
  register_setting ('site-options','site-email-address');
  register_setting ('site-options','site-street-address');
  register_setting ('site-options','site-address-locality');
  register_setting ('site-options','site-address-region');
  register_setting ('site-options','site-postal-code');
  register_setting ('site-options','site-address-country');
  register_setting ('site-options','site-directions');
  register_setting ('site-options','site-times');
  register_setting ('site-options','site-social');

}

add_action( 'admin_init', 'admin_init_site_info_section' );


/* --------------------- RENDER FIELDS --------------------- */

function render_site_description() {

	$input = get_option( 'site-description' );
  echo '<textarea style="width:600px;" name="site-description" id="site-description" class="large-text" rows="10" cols="50" required>' . $input . '</textarea>
    <p class="description" id="site-description-description">Required for schema</p>';
}

function render_site_booking_link() {

	$input = get_option( 'site-booking-link' );
	echo '<input style="width:600px;" type="text" id="site-booking-link" name="site-booking-link" value="' . $input . '" />';
}

function render_site_phone_number() {

	$input = get_option( 'site-phone-number' );
	echo '<input style="width:600px;" type="text" id="site-phone-number" name="site-phone-number" value="' . $input . '" required />
    <p class="description" id="site-phone-number-description">Required for schema</p>';
}

function render_site_whatsapp_number() {

	$input = get_option( 'site-whatsapp-number' );
	echo '<input style="width:600px;" type="text" id="site-whatsapp-number" name="site-whatsapp-number" value="' . $input . '" />';

}

function render_site_email_address() {

	$input = get_option( 'site-email-address' );
	echo '<input style="width:600px;" type="email" id="site-email-address" name="site-email-address" value="' . $input . '" required />
    <p class="description" id="site-email-address-description">Required for schema</p>';
}

function render_site_street_address() {

	$input = get_option( 'site-street-address' );
	echo '<input style="width:600px;" type="text" id="site-street-address" name="site-street-address" value="' . $input . '" required />
    <p class="description" id="site-street-address-description">Required for schema</p>';
}

function render_site_address_locality() {

	$input = get_option( 'site-address-locality' );
	echo '<input style="width:600px;" type="text" id="site-address-locality" name="site-address-locality" value="' . $input . '" required />
    <p class="description" id="site-address-locality-description">Required for schema</p>';
}

function render_site_address_region() {

	$input = get_option( 'site-address-region' );
	echo '<input style="width:600px;" type="text" id="site-address-region" name="site-address-region" value="' . $input . '" required />
    <p class="description" id="site-address-region-description">Required for schema</p>';
}

function render_site_postal_code() {

	$input = get_option( 'site-postal-code' );
	echo '<input style="width:600px;" type="text" id="site-postal-code" name="site-postal-code" value="' . $input . '" required />
    <p class="description" id="site-postal-code-description">Required for schema</p>';
}

function render_site_address_country() {

	$input = get_option( 'site-address-country' );
	echo '<input style="width:600px;" type="text" id="site-address-country" name="site-address-country" value="' . $input . '" required />
    <p class="description" id="site-address-country-description">Required for schema</p>';
}

function render_site_directions() {

	$input = get_option( 'site-directions' );
	echo '<input style="width:600px;" type="text" id="site-directions" name="site-directions" value="' . $input . '" />
    <p class="description" id="site-directions-description">Use Google map &ldquo;Share a link&rdquo;</p>';

}

function render_site_times() {

  $repeater = get_option('site-times'); ?>

  <div class="opening">
    <div class="opening__list" id="openingList">

  <?php

  if (isset($repeater) && is_array($repeater)) {

    foreach ($repeater as $i => $value) {

      $value_day = isset($value['0']) ? $value['0'] : '';
      $value_open = isset($value['1']) ? $value['1'] : '';
      $value_close = isset($value['2']) ? $value['2'] : '';

      echo '<div class="opening__row"><input type="text" id="site-times-day" name="site-times['. $i .'][0]" placeholder="Day" value="' . esc_attr($value_day) . '" />
          <input type="text" id="site-times-open" name="site-times['. $i .'][1]" placeholder="Opening time" value="' . esc_attr($value_open) . '" />
          <input type="text" id="site-times-close" name="site-times['. $i .'][2]" placeholder="Closing time" value="' . esc_attr($value_close) . '" />
          <button type="button" class="opening__remove button" id="removeTime">Remove</button></div>';

    }

  }

  ?>

    </div>
    <button type="button" class="opening__add button-primary" id="addTime" data-number="<?php if ($repeater) { echo count($repeater); } else { echo '0'; } ?>">Add time</button>
  
  </div>

  <?php

}

  function render_site_social() {

  $socials = get_option('site-social'); ?>

  <div class="social">
    <div class="social__list" id="channelList">

  <?php

  if (isset($socials) && is_array($socials)) {

    foreach ($socials as $i => $value) {

      $value_url = isset($value['0']) ? $value['0'] : '';

      echo '<div class="social__row"><input type="text" id="site-social-url" name="site-social['. $i .'][0]" placeholder="https://..." value="' . esc_attr($value_url) . '" />
          <button type="button" class="social__remove button" id="removeChannel">Remove</button></div>';

    }

  }

  ?>

    </div>
  <button type="button" class="social__add button-primary" id="addChannel" data-number="<?php if ($socials) { echo count($socials); } else { echo '0'; } ?>">Add URL</button></div>

  <?php

}


/*-----------------------------------------------------------------------------------*/
/* AGGREGATE RATING SETTINGS SECTION */
/*-----------------------------------------------------------------------------------*/

function admin_init_site_aggregate_section() {

	add_settings_section (
		'site-aggregate-section',
		'Aggregate Rating',
		'site_aggregate_section_message',
		'site-options-page'
	);

  
  /* --------------------- SECTION MESSAGE --------------------- */

  function site_aggregate_section_message() {
    echo "Use these options to add the aggregate rating used in the schema.";
  }


  /* --------------------- ADD FIELDS --------------------- */

  add_settings_field (
    'site-aggregate-value',
    'Rating Value:',
    'render_site_aggregate_value',
    'site-options-page',
    'site-aggregate-section'
  );

  add_settings_field (
    'site-aggregate-count',
    'Review Count:',
    'render_site_aggregate_count',
    'site-options-page',
    'site-aggregate-section'
  );


  /* --------------------- REGISTER FIELDS --------------------- */

  register_setting ('site-options','site-aggregate-value');
  register_setting ('site-options','site-aggregate-count');

}

add_action( 'admin_init', 'admin_init_site_aggregate_section' );


/* --------------------- RENDER FIELDS --------------------- */

function render_site_aggregate_value() {

  $input = get_option( 'site-aggregate-value' );
	echo '<input style="width:600px;" type="number" id="site-aggregate-value" name="site-aggregate-value" value="' . $input . '" />';

}

function render_site_aggregate_count() {

  $input = get_option( 'site-aggregate-count' );
	echo '<input style="width:600px;" type="number" id="site-aggregate-count" name="site-aggregate-count" value="' . $input . '" />';

}


/*-----------------------------------------------------------------------------------*/
/* ENQUEUE OPTIONS SCRIPT & STYLES TO ADMIN */
/*-----------------------------------------------------------------------------------*/

function site_options_admin_scripts() {
  wp_enqueue_style( 'options-styles', plugin_dir_url( __FILE__ ) . '/assets/css/options-styles.css', array(), '', 'all' );
  wp_enqueue_script( 'options-script', plugin_dir_url( __FILE__ ) . '/assets/js/options-script.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'site_options_admin_scripts' );
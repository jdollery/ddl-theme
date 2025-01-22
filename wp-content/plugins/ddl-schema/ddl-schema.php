<?php
/*
Plugin Name: DDL Schema
Version: 1.0.0
Description: Schema options and disclosure (accordion) intergration.
Author: Dental Design
Author URI: https://dental-design.marketing/
License: GPL2
*/


/*-----------------------------------------------------------------------------------*/
/* ADD OPTIONS TO ADMIN */
/*-----------------------------------------------------------------------------------*/

/* --------------------- REGISTER OPTIONS --------------------- */

function add_schema_options_page() {

  $icon = plugin_dir_url( __FILE__ ) . '/assets/img/options-icon.svg';

	add_menu_page (
		'Schema Options',
		'Schema Options',
		'manage_options',
		'schema-options-page',
		'display_schema_options_page',
    $icon
	);

}

add_action( 'admin_menu', 'add_schema_options_page' );


/* --------------------- STYLE THE ICON --------------------- */

function admin_schema_icon_style() {
  echo '<style>
    #toplevel_page_schema-options-page .wp-menu-image img {
      max-width: 22px;
      max-height: 22px; 
      padding: 6px 0 0 !important; 
    }
  </style>';
}

add_action('admin_head', 'admin_schema_icon_style');


/* --------------------- DISPLAY OPTIONS FORM --------------------- */

function display_schema_options_page() {

	echo '<h1 style="margin: 30px 0 40px;">Site Schema Options</h1>';

	echo '<form method="post" action="options.php">';

	do_settings_sections( 'schema-options-page' );
	settings_fields( 'schema-options' );

	submit_button();

	echo '</form>';

}


/*-----------------------------------------------------------------------------------*/
/* INFORMATION SETTINGS SECTION */
/*-----------------------------------------------------------------------------------*/

function admin_init_schema_info_section() {

	add_settings_section (
		'schema-info-section',
		'Practice Information',
		'schema_info_section_message',
		'schema-options-page'
	);

  
  /* --------------------- SECTION MESSAGE --------------------- */

  function schema_info_section_message() {
    echo "Use these options to add practice information.";
  }


  /* --------------------- ADD FIELDS --------------------- */

  add_settings_field (
    'schema-description',
    'Site description:',
    'render_schema_description',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-phone-number',
    'Telephone number:',
    'render_schema_phone_number',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-email-address',
    'Email address:',
    'render_schema_email_address',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-street-address',
    'Street address:',
    'render_schema_street_address',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-address-locality',
    'Address locality (i.e. city):',
    'render_schema_address_locality',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-address-region',
    'Address region (i.e. county):',
    'render_schema_address_region',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-postal-code',
    'Postcode:',
    'render_schema_postal_code',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-address-country',
    'Country:',
    'render_schema_address_country',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-times',
    'Opening times:',
    'render_schema_times',
    'schema-options-page',
    'schema-info-section'
  );

  add_settings_field (
    'schema-social',
    'Social channels:',
    'render_schema_social',
    'schema-options-page',
    'schema-info-section'
  );


  /* --------------------- REGISTER FIELDS --------------------- */

  register_setting ('schema-options','schema-description');
  register_setting ('schema-options','schema-phone-number');
  register_setting ('schema-options','schema-email-address');
  register_setting ('schema-options','schema-street-address');
  register_setting ('schema-options','schema-address-locality');
  register_setting ('schema-options','schema-address-region');
  register_setting ('schema-options','schema-postal-code');
  register_setting ('schema-options','schema-address-country');
  register_setting ('schema-options','schema-times');
  register_setting ('schema-options','schema-social');

}

add_action( 'admin_init', 'admin_init_schema_info_section' );


/* --------------------- RENDER FIELDS --------------------- */

function render_schema_description() {

	$input = get_option( 'schema-description' );
  echo '<textarea style="width:600px;" name="schema-description" id="schema-description" class="large-text" rows="10" cols="50">' . $input . '</textarea>';
}

function render_schema_phone_number() {

	$input = get_option( 'schema-phone-number' );
	echo '<input style="width:600px;" type="text" id="schema-phone-number" name="schema-phone-number" value="' . $input . '" />';
}

function render_schema_email_address() {

	$input = get_option( 'schema-email-address' );
	echo '<input style="width:600px;" type="email" id="schema-email-address" name="schema-email-address" value="' . $input . '" />';
}

function render_schema_street_address() {

	$input = get_option( 'schema-street-address' );
	echo '<input style="width:600px;" type="text" id="schema-street-address" name="schema-street-address" value="' . $input . '" />';
}

function render_schema_address_locality() {

	$input = get_option( 'schema-address-locality' );
	echo '<input style="width:600px;" type="text" id="schema-address-locality" name="schema-address-locality" value="' . $input . '" />';
}

function render_schema_address_region() {

	$input = get_option( 'schema-address-region' );
	echo '<input style="width:600px;" type="text" id="schema-address-region" name="schema-address-region" value="' . $input . '" />';
}

function render_schema_postal_code() {

	$input = get_option( 'schema-postal-code' );
	echo '<input style="width:600px;" type="text" id="schema-postal-code" name="schema-postal-code" value="' . $input . '" />';
}

function render_schema_address_country() {

	$input = get_option( 'schema-address-country' );
	echo '<input style="width:600px;" type="text" id="schema-address-country" name="schema-address-country" value="' . $input . '" />';
}

function render_schema_times() {

  $repeater = get_option('schema-times'); ?>

  <div class="opening">
    <div class="opening__list" id="openingList">

    <?php

    if (isset($repeater) && is_array($repeater)) {

      foreach ($repeater as $i => $value) {

        $value_day = isset($value['0']) ? $value['0'] : '';
        $value_open = isset($value['1']) ? $value['1'] : '';
        $value_close = isset($value['2']) ? $value['2'] : '';

        echo '<div class="opening__row"><input type="text" id="schema-times-day" name="schema-times['. $i .'][0]" placeholder="Day" value="' . esc_attr($value_day) . '" />
            <input type="text" id="schema-times-open" name="schema-times['. $i .'][1]" placeholder="Opening time" value="' . esc_attr($value_open) . '" />
            <input type="text" id="schema-times-close" name="schema-times['. $i .'][2]" placeholder="Closing time" value="' . esc_attr($value_close) . '" />
            <button type="button" class="opening__remove button" id="removeTime">Remove</button></div>';

      }

    }

    ?>

    </div>
    <button type="button" class="opening__add button-primary" id="addTime" data-number="<?php if ($repeater) { echo count($repeater); } else { echo '0'; } ?>">Add time</button>
  
  </div>

  <?php

}

function render_schema_social() {

  $socials = get_option('schema-social'); ?>

  <div class="social">
    <div class="social__list" id="channelList">

    <?php

    if (isset($socials) && is_array($socials)) {

      foreach ($socials as $i => $value) {

        $value_url = isset($value['0']) ? $value['0'] : '';

        echo '<div class="social__row"><input type="text" id="schema-social-url" name="schema-social['. $i .'][0]" placeholder="https://..." value="' . esc_attr($value_url) . '" />
            <button type="button" class="social__remove button" id="removeChannel">Remove</button></div>';

      }

    }

    ?>

    </div>
    <button type="button" class="social__add button-primary" id="addChannel" data-number="<?php if ($socials) { echo count($socials); } else { echo '0'; } ?>">Add URL</button>
  
  </div>

  <?php

}


/*-----------------------------------------------------------------------------------*/
/* AGGREGATE RATING SETTINGS SECTION */
/*-----------------------------------------------------------------------------------*/

function admin_init_schema_aggregate_section() {

	add_settings_section (
		'schema-aggregate-section',
		'Aggregate Rating',
		'schema_aggregate_section_message',
		'schema-options-page'
	);

  
  /* --------------------- SECTION MESSAGE --------------------- */

  function schema_aggregate_section_message() {
    echo "Use these options to add the aggregate rating.";
  }


  /* --------------------- ADD FIELDS --------------------- */

  add_settings_field (
    'schema-aggregate-value',
    'Rating Value:',
    'render_schema_aggregate_value',
    'schema-options-page',
    'schema-aggregate-section'
  );

  add_settings_field (
    'schema-aggregate-count',
    'Review Count:',
    'render_schema_aggregate_count',
    'schema-options-page',
    'schema-aggregate-section'
  );


  /* --------------------- REGISTER FIELDS --------------------- */

  register_setting ('schema-options','schema-aggregate-value');
  register_setting ('schema-options','schema-aggregate-count');

}

add_action( 'admin_init', 'admin_init_schema_aggregate_section' );


/* --------------------- RENDER FIELDS --------------------- */

function render_schema_aggregate_value() {

  $input = get_option( 'schema-aggregate-value' );
	echo '<input style="width:600px;" type="text" id="schema-aggregate-value" name="schema-aggregate-value" value="' . $input . '" />';

}

function render_schema_aggregate_count() {

  $input = get_option( 'schema-aggregate-count' );
	echo '<input style="width:600px;" type="text" id="schema-aggregate-count" name="schema-aggregate-count" value="' . $input . '" />';

}


/*-----------------------------------------------------------------------------------*/
/* ENQUEUE OPTIONS SCRIPT & STYLES TO ADMIN */
/*-----------------------------------------------------------------------------------*/

function schema_options_admin_scripts() {
  wp_enqueue_style( 'schema-options-styles', plugin_dir_url( __FILE__ ) . '/assets/css/schema-options-styles.css', array(), '', 'all' );
  wp_enqueue_script( 'schema-options-script', plugin_dir_url( __FILE__ ) . '/assets/js/schema-options-script.js', array(), '1.0.0', true );
}

add_action( 'admin_enqueue_scripts', 'schema_options_admin_scripts' );


/*-----------------------------------------------------------------------------------*/
/* ADD SCHEMA AS LAST ITEM IN FOOTER */
/*-----------------------------------------------------------------------------------*/

function add_schema_options() { 

  $schema_url = get_site_url();
  $schema_name = get_bloginfo('name');
  $schema_description = get_option('schema-description');
  $phone_number = get_option('schema-phone-number');
  $email_address = get_option('schema-email-address');
  $street_address = get_option('schema-street-address');
  $address_locality = get_option('schema-address-locality');
  $address_region = get_option('schema-address-region');
  $postal_code = get_option('schema-postal-code');
  $address_country = get_option('schema-address-country');
  $opening_times = get_option('schema-times');
  $social_links = get_option('schema-social');
  $aggregate_value = get_option('schema-aggregate-value');
  $aggregate_count = get_option('schema-aggregate-count');

  ?>

  <script type="application/ld+json" class="dd-schema">
  {
    "@context": "http://schema.org",
    "@type": "Dentist",
    "@id":"LocalBusiness",
    "name": "<?= $schema_name; ?>",
    <?php if (!empty($schema_description)) : ?>
    "description": "<?= $schema_description; ?>",
    <?php endif; ?>
    "legalName": "<?= $schema_name; ?>",
    "url": "<?= $schema_url; ?>",
    <?php if (!empty($phone_number)) : ?>
    "telephone": "<?= $phone_number; ?>",
    <?php endif; ?>
    <?php if (!empty($street_address || $address_locality || $address_region || $postal_code || $address_country)) : ?>
    "address": {
    "@type": "PostalAddress",
    <?php if (!empty($street_address)) : ?>
    "streetAddress": "<?= $street_address; ?>",
    <?php endif; ?>
    <?php if (!empty($address_locality)) : ?>
    "addressLocality": "<?= $address_locality; ?>",
    <?php endif; ?>
    <?php if (!empty($address_region)) : ?>
    "addressRegion": "<?= $address_region; ?>",
    <?php endif; ?>
    <?php if (!empty($postal_code)) : ?>
    "postalCode": "<?= $postal_code; ?>",
    <?php endif; ?>
    <?php if (!empty($address_country)) : ?>
    "addressCountry": "<?= $address_country; ?>"
    <?php endif; ?>
    },
    <?php endif; ?>
    <?php if (!empty($phone_number || $email_address)) : ?>
    "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer support",
    <?php if (!empty($email_address)) : ?>
    "email": "<?= $email_address; ?>",
    <?php endif; ?>
    <?php if (!empty($phone_number)) : ?>
    "telephone": "<?= $phone_number; ?>"
    <?php endif; ?>
    },
    <?php endif; ?>
    <?php if (!empty($social_links)) : ?>
    "sameAs": [
    <?php foreach ($social_links as $index => $links) : ?>
    "<?= $links['0'] ?>"<?php if ($index < count($social_links) - 1) { echo ','; } ?>
    <?php endforeach; ?>
    ],
    <?php endif; ?>
    <?php if (!empty($opening_times)) : ?>
    "openingHoursSpecification": [
      <?php foreach ($opening_times as $index => $time) : ?>
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "<?= $time['0']; ?>",
      "opens": "<?= $time['1']; ?>",
      "closes": "<?= $time['2']; ?>"
    }<?php if ($index < count($opening_times) - 1) { echo ','; } ?>
    <?php endforeach; ?>
    ],
    <?php endif; ?>
    <?php if (!empty($aggregate_value || $aggregate_count)) : ?>
      "aggregateRating": {
        "@type": "AggregateRating",
        <?php if (!empty($aggregate_value)) : ?>"ratingValue": "<?= $aggregate_value; ?>",<?php endif; ?>
        <?php if (!empty($aggregate_count)) : ?>"reviewCount": "<?= $aggregate_count; ?>"<?php endif; ?>
      },
    <?php endif; ?>
    "inLanguage":"en-GB"
  }
  </script>

<?php

}

add_action( 'wp_head', 'add_schema_options', 999);
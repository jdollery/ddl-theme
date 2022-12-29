<?php
/*
Plugin Name: Comparison Slider
Description: Compare the differences between two images. Add this shortcode and replace the XX with the image id: [comparison before="XX" after="XX"]
Author: Dental Design
Author URI: https://dental-design.marketing/
License: GPLv2
Version: 1.0.0
*/

/*-----------------------------------------------------------------------------------*/
/* ENQUEUE STYLES & SCRIPTS */
/*-----------------------------------------------------------------------------------*/

function comparison_scripts() {

  wp_enqueue_style( 'comparison-styles', plugins_url('/assets/css/comparison-styles.css', __FILE__), array(), '', 'all' );
  wp_enqueue_script( 'comparison-script', plugins_url('/assets/js/comparison-script.js', __FILE__), array(), '', true ); 

}

add_action( 'wp_enqueue_scripts', 'comparison_scripts' );


/*-----------------------------------------------------------------------------------*/
/* SHORTCODE */
/*-----------------------------------------------------------------------------------*/

function comparison_shortcode($atts, $content = null) {

  extract( shortcode_atts (array(
		'before' => '',
		'after' => '',
	), $atts));
  return '
  <div class="comparison" id="comparisonSlider">
    <img src="' . wp_get_attachment_url($before) . '" alt="Before" />
    <img src="' . wp_get_attachment_url($after) . '" alt="After" />
  </div>
  ';
}

add_shortcode('comparison', 'comparison_shortcode');

// <div class="comparison" id="comparison">
//   <div id="comparison">
//     <img src="' . wp_get_attachment_url($before) . '" alt="Before" />
//     <img src="' . wp_get_attachment_url($after) . '" alt="After" />
//   </div>
//   <div class="comparison__caption">
//     <span class="comparison__caption--before">Before</span>
//     <span class="comparison__caption--after">After</span>
//   </div>
// </div>
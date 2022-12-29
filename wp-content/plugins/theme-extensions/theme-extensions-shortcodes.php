<?php

/* --------------------- BUTTON --------------------- */

function button_shortcode($atts, $content = null) {

  extract( shortcode_atts (array(
    'colour' => '',
		'link' => '',
    'target' => ''
	), $atts));

  if($target == 'blank'){
    return '<a class="button button--' . $colour . ' button--body" href="' . $link . '" target="_blank">' . do_shortcode($content) . '</a>';
  } else {
    return '<a class="button button--' . $colour . ' button--body" href="' . $link . '">' . do_shortcode($content) . '</a>';
  }

}

add_shortcode('button', 'button_shortcode');


/* --------------------- FEATURE LIST --------------------- */

// function feature_list_shortcode($atts, $content = null ){

//   $content = wpautop(trim($content));

// 	$output = '<div class="feature-list">' . $content . '</div>';
	
//   return $output;

// }

// add_shortcode('feature-list','feature_list_shortcode');


/* --------------------- INCLUDE A TEMPLATE FILE --------------------- */

function include_file($atts) {

  $a = shortcode_atts( array(
    'slug' => 'NULL',
  ), $atts );

  if($a['slug'] != 'NULL'){
    ob_start();
    get_template_part($a['slug']);
    return ob_get_clean();
  }

}

add_shortcode('include', 'include_file');

// [include slug="inc/form"]
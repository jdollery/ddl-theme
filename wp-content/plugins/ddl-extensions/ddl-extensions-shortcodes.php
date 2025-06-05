<?php

/* --------------------- BUTTON --------------------- */

function button_shortcode($atts, $content = null) {

  extract( shortcode_atts (array(
    'colour' => '',
		'link' => '',
    'style' => '',
    'target' => ''
	), $atts));

  if($target == 'blank' && $style && $colour){
    return '<a class="btn btn--' . $colour . ' btn--' . $style . '" href="' . $link . '" target="_blank" rel="noopener noreferrer">' . do_shortcode($content) . '</a>';
  } elseif ($target == 'blank' && $style){
    return '<a class="btn btn--' . $style . '" href="' . $link . '" target="_blank" rel="noopener noreferrer">' . do_shortcode($content) . '</a>';
  } elseif ($target == 'blank' && $colour){
    return '<a class="btn btn--' . $colour . '" href="' . $link . '" target="_blank" rel="noopener noreferrer">' . do_shortcode($content) . '</a>';
  } elseif ($target == 'blank'){
    return '<a class="btn" href="' . $link . '" target="_blank" rel="noopener noreferrer">' . do_shortcode($content) . '</a>';
  } elseif ($style && $colour){
    return '<a class="btn btn--' . $colour . ' btn--' . $style . '" href="' . $link . '">' . do_shortcode($content) . '</a>';
  } elseif ($style){
    return '<a class="btn btn--' . $style . '" href="' . $link . '">' . do_shortcode($content) . '</a>';
  } elseif ($colour){
    return '<a class="btn btn--' . $colour . '" href="' . $link . '">' . do_shortcode($content) . '</a>';
  } else {
    return '<a class="btn" href="' . $link . '">' . do_shortcode($content) . '</a>';
  }

}

add_shortcode('button', 'button_shortcode');


/* --------------------- TEAM BUTTON --------------------- */

function button_team_shortcode($atts, $content = null) {

  extract( shortcode_atts (array(
    'colour' => '',
		'link' => '',
    'style' => '',
	), $atts));

  if($style){
    return '<a class="btn btn--' . $colour . ' btn--' . $style . '" id="memberTrigger" href="' . $link . '" >' . do_shortcode($content) . '</a>';
  } else {
    return '<a class="btn btn--' . $colour . ' id="memberTrigger" " href="' . $link . '">' . do_shortcode($content) . '</a>';
  }

}

add_shortcode('button-team', 'button_team_shortcode');


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


/* --------------------- GET PRICE FROM A FEE POST AND ACF TABLE ROW --------------------- */

function get_acf_repeater_row_func( $atts ) {

  $atts = shortcode_atts(
    array(
      'post_id' => get_the_ID(), // Default to current post ID
      'row_number' => 0, // Default row number
    ),
    $atts,
    'get_fee'
  );

  $repeater_field = get_field( 'fees_table', $atts['post_id'] );

  if ( $repeater_field ) {
    $row = $repeater_field[ $atts['row_number'] ];

    return $row['fees_price'];
  }

  return '';
}

add_shortcode( 'get_fee', 'get_acf_repeater_row_func' );

// [get_fee post_id="123" row_number="1"]
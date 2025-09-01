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

// [include slug="includes/form"]


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


/* --------------------- AUTOCOMPLETE SEARCH (NEEDS COMPLETEING) --------------------- */

function auto_search_func( $atts ) {

  $atts = shortcode_atts( array(
    'source' => 'page,post,product',
  ), $atts, 'auto_search' );

  static $auto_search_first_call = 1;
  $source = $atts["source"];
  $sForam = '<div class="search_bar">
      <form class="auto_search" id="auto_search'.$auto_search_first_call.'" action="/" method="get" autocomplete="off">
          <input type="text" name="s" placeholder="Search ..." id="keyword" class="input_search" onkeyup="searchFetch(this)"><button id="mybtn">🔍</button>
      </form><div class="search_result" id="datafetch" style="display: none;">
          <ul>
              <li>Please wait..</li>
          </ul>
      </div></div>';

  $java = '<script>
  function searchFetch(e) {
  var datafetch = e.parentElement.nextSibling;
  if (e.value.trim().length > 0) { datafetch.style.display = "block"; } else { datafetch.style.display = "none"; }
  const searchForm = e.parentElement;    
  e.nextElementSibling.value = "Please wait...";
  var formdata'.$auto_search_first_call.' = new FormData(searchForm);
  formdata'.$auto_search_first_call.'.append("source", "'.$source.'"); 
  formdata'.$auto_search_first_call.'.append("action", "auto_search");
  AjaxAsearch(formdata'.$auto_search_first_call.', e); 
  }
  async function AjaxAsearch(formdata, e) {
    const url = "'.admin_url("admin-ajax.php").'?action=auto_search";
    const response = await fetch(url, {
        method: "POST",
        body: formdata,
    });
    const data = await response.text();
    if (data) {
      e.parentElement.nextSibling.innerHTML = data;
    } else {
      e.parentElement.nextSibling.innerHTML = `<ul><a href="#"><li>Sorry, nothing found</li></a></ul>`;
    }
  }
  document.addEventListener("click", function(e) { 
    if (document.activeElement.classList.contains("input_search") == false) { 
      [...document.querySelectorAll("div.search_result")].forEach(el => el.style.display = "none"); 
    } else {
      if (e.target.value.trim().length > 0) { 
        e.target.parentElement.nextSibling.style.display = "block";
      }
    }
  });
  </script>';

  if ($auto_search_first_call == 1) {
    $auto_search_first_call++;
    return "{$sForam}{$java}";
  } elseif ($auto_search_first_call > 1) {
    $auto_search_first_call++;
    return "{$sForam}";
  }

}

add_shortcode( 'auto_search', 'auto_search_func' );

function auto_search() {
  $the_query = new WP_Query(array(
    'posts_per_page' => 10,
    's' => esc_attr($_POST['s']),
    'post_type' => explode(",", esc_attr($_POST['source']))
  ));
  if ($the_query->have_posts()) {
    $output = '<ul>';
    while ($the_query->have_posts()) : $the_query->the_post();
      $output .= '<li><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></li>';
    endwhile;
    $output .= '</ul>';
    echo $output;
    wp_reset_postdata();
  }
  die();
}

add_action('wp_ajax_auto_search', 'auto_search');
add_action('wp_ajax_nopriv_auto_search', 'auto_search');
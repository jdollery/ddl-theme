<?php

if ( ! function_exists( 'ddl_setup' ) ) :

	/*-----------------------------------------------------------------------------------*/
	/* BASIC THEAME SETUP */
	/*-----------------------------------------------------------------------------------*/

	function ddl_setup() {

		/* --------------------- Make theme available for translation --------------------- */

		load_theme_textdomain( 'ddl', get_template_directory() . '/languages' );

		/* --------------------- Add default posts and comments RSS feed links to head --------------------- */

		add_theme_support( 'automatic-feed-links' );

		/* --------------------- Let WordPress manage the document title --------------------- */

		add_theme_support( 'title-tag' );

		/* --------------------- Enable support for Post Thumbnails on posts and pages --------------------- */

		add_theme_support( 'post-thumbnails' );

		/* --------------------- Switch default core markup for search form, comment form, and comments to output valid HTML5 --------------------- */

		// add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		add_theme_support( 'html5', array( 'gallery', 'caption' ) );

		/* --------------------- Add theme support for selective refresh for widgets --------------------- */

		add_theme_support( 'customize-selective-refresh-widgets' );

	}

endif;

add_action( 'after_setup_theme', 'ddl_setup' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER MENUS */
/*-----------------------------------------------------------------------------------*/

function register_menus() {

	register_nav_menus( array(
    'header-menu' => __( 'Header Menu'),
		'footer-menu' => __( 'Footer Menu')
	) );

}

add_action( 'init', 'register_menus' );


/*-----------------------------------------------------------------------------------*/
/* REGISTER WIDGETS */
/*-----------------------------------------------------------------------------------*/

function ddl_widgets_init() {
  
  register_sidebar( array(
		'name'          => esc_html__( 'News Sidebar', 'ddl' ),
		'id'            => 'news-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
  ) );

  register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget One', 'ddl' ),
		'id'            => 'footer-widget-one',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
  ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Two', 'ddl' ),
		'id'            => 'footer-widget-two',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
  ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Three', 'ddl' ),
		'id'            => 'footer-widget-three',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
  ) );


}

add_action( 'widgets_init', 'ddl_widgets_init' );


/*-----------------------------------------------------------------------------------*/
/* ENQUEUE SCRIPTS & STYLES */
/*-----------------------------------------------------------------------------------*/

function ddl_scripts() {
  // wp_enqueue_style( 'ddl-font', 'https://use.typekit.net/irb6piy.css', array(), '', false );
  wp_enqueue_style( 'ddl-style', get_stylesheet_uri(), array(), '1.0.0', 'all' );
	wp_enqueue_script( 'ddl-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '3.6.0', false );
	wp_enqueue_script( 'ddl-script', get_template_directory_uri() . '/script.js', array(), '1.0.0', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
  // }

  // if ( (is_page('home')) ) {
  //   wp_enqueue_script( 'ddl-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array(), '1.0.0', true );
  // } 

	// if ( (is_page(array(14, 12))) ) { //Contact and Referral Pages
  //   wp_enqueue_script( 'ddl-validate', get_template_directory_uri() . '/assets/js/validate.js', array(), '1.0.0', true );
  // } 

}

add_action( 'wp_enqueue_scripts', 'ddl_scripts' );


/*-----------------------------------------------------------------------------------*/
/* CHECK PLUGIN DEPENDENCIES */
/*-----------------------------------------------------------------------------------*/

function theme_dependencies() {

  if ( is_plugin_inactive( 'ddl-extensions/ddl-extensions.php' ) ) {
    echo '<div class="error"><p>' . __( 'Warning: The theme needs the Extensions Plugin to function.', 'ddl' ) . '</p></div>';
  }

  if ( is_plugin_inactive( 'ddl-cpt/ddl-cpt.php' ) ) {
    echo '<div class="error"><p>' . __( 'Warning: The theme needs the Custom Post Types Plugin to function.', 'ddl' ) . '</p></div>';
  }

}

add_action( 'admin_notices', 'theme_dependencies' );


/*-----------------------------------------------------------------------------------*/
/* EXTRA OVERRIDE FUNCTIONS */
/*-----------------------------------------------------------------------------------*/

/* --------------------- Allow SVG images to be used --------------------- */

function allow_svg($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'allow_svg');


/* --------------------- Change ellipsis at end of excerpt --------------------- */

function excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'excerpt_more');


/* --------------------- Change character length of excerpt and add ellipsis --------------------- */

// echo strip_tags( get_excerpt(165) ); //use this to print excerpt with x characters 

function get_excerpt($limit, $source = null){

  $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
  $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $limit);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
  $excerpt = $excerpt.'...';
  return $excerpt;
}


/* --------------------- Remove menu options form wp-admin --------------------- */

function remove_menus() {
	// remove_menu_page( 'index.php' );                  //Dashboard
	// remove_menu_page( 'jetpack' );                    //Jetpack
	// remove_menu_page( 'edit.php' );                   //Posts
	// remove_menu_page( 'upload.php' );                 //Media
	// remove_menu_page( 'edit.php?post_type=page' );    //Pages
	// remove_menu_page( 'edit-comments.php' );          //Comments
	// remove_menu_page( 'themes.php' );                 //Appearance
	// remove_menu_page( 'plugins.php' );                //Plugins
	// remove_menu_page( 'users.php' );                  //Users
	// remove_menu_page( 'tools.php' );                  //Tools
	// remove_menu_page( 'options-general.php' );        //Settings
}

add_action( 'admin_menu', 'remove_menus' );


/* --------------------- Unregister widgets --------------------- */

function unregister_default_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    // unregister_widget('WP_Widget_Search');
    // unregister_widget('WP_Widget_Text');
    // unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Widget_Media_Gallery');
		unregister_widget('WP_Widget_Media_Video');
		// unregister_widget('WP_Widget_Media_Image');
		unregister_widget('WP_Widget_Media_Audio');
		// unregister_widget('WP_Nav_Menu_Widget');
		// unregister_widget('WP_Widget_Custom_HTML');
}
add_action('widgets_init', 'unregister_default_widgets', 11);


/* --------------------- Unregister all tags --------------------- */

// function unregister_tags() {
//   unregister_taxonomy_for_object_type( 'post_tag', 'post' );
// }
// add_action( 'init', 'unregister_tags' );


/* --------------------- Disabling WordPress wpautop and wptexturize filters --------------------- */

remove_filter ('the_exceprt', 'wpautop');
remove_filter('term_description','wpautop');
remove_filter ('acf_the_content', 'wpautop');


/* --------------------- Removes extra p from shortcode --------------------- */

add_filter( 'the_content', 'shortcode_unautop', 100 );

function shortcode_empty_paragraph_fix( $content ) {

	// define your shortcodes to filter, '' filters all shortcodes
	$shortcodes = array( 'feature-green', 'feature-blue' ); //define shortcodes used in ddl-extensions/ddl-extensions.php

	foreach ( $shortcodes as $shortcode ) {

			$array = array (
					'<p>[' . $shortcode => '[' .$shortcode,
					'<p>[/' . $shortcode => '[/' .$shortcode,
					$shortcode . ']</p>' => $shortcode . ']',
					$shortcode . ']<br />' => $shortcode . ']'
			);

			$content = strtr( $content, $array );
	}

	return $content;
}

add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );


/* --------------------- Stop img, script and iframe being wrapped in p tag  --------------------- */

function remove_some_ptags( $content ) {
	$content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	$content = preg_replace('/<p>\s*(<script.*>*.<\/script>)\s*<\/p>/iU', '\1', $content);
	$content = preg_replace('/<p>\s*(<iframe.*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
	$content = preg_replace('/<p>\s*(<video.*>*.<\/video>)\s*<\/p>/iU', '\1', $content);
	return $content;
}

add_filter( 'the_content', 'remove_some_ptags' );


/* --------------------- Remove Category:, Tag:, Author: from the_archive_title  --------------------- */

add_filter( 'get_the_archive_title', function ($title) {

	if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>' ;
		}

	return $title;

});


/* --------------------- Remove Emoji Scripts from head  --------------------- */

remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/* --------------------- Dequeue CSS for Gutenberg & Contact form 7  --------------------- */

function deregister_styles() {
  wp_dequeue_style( 'wp-block-library' );
  wp_deregister_style( 'wp-block-library' );
	wp_deregister_style( 'contact-form-7' );
}

add_action( 'wp_print_styles', 'deregister_styles', 100 );


// function custom_dequeue() {
//   wp_dequeue_style('awsm-jobs-style');
//   wp_deregister_style('awsm-jobs-style');
// }

// add_action( 'wp_enqueue_scripts', 'custom_dequeue', 9999 );
// add_action( 'wp_head', 'custom_dequeue', 9999 );


/* --------------------- Remove image size attributes from img --------------------- */

function remove_image_size_attributes( $html ) {
	return preg_replace( '/(width|height)="\d*"/', '', $html );
}

// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );


/* --------------------- Add target _blank to edit button --------------------- */

add_filter( 'edit_post_link', function( $link, $post_id, $text )
{
    // Add the target attribute 
    if( false === strpos( $link, 'target=' ) )
        $link = str_replace( '<a ', '<a target="_blank" ', $link );

    return $link;
}, 10, 3 );


/* --------------------- Hide the content editor on multiple pages --------------------- */

function hide_editor() {
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;
  $home = get_the_title($post_id);
  // $contact = get_the_title($post_id);
	$team = get_the_title($post_id);
	// $treatments = get_the_title($post_id);
  if($home == 'Home' || $team == 'Meet the team'){ 
    remove_post_type_support('page', 'editor');
  }
}

add_action( 'admin_init', 'hide_editor' );


/*-----------------------------------------------------------------------------------*/
/* ADD CUSTOM PAGINATION TO ANY POST TYPE */
/*-----------------------------------------------------------------------------------*/

// echo pagination(); // use this inside the loop

function pagination( \WP_Query $wp_query = null, $echo = true ) {

	if ( null === $wp_query ) {
		global $wp_query;
  }
  
	$pages = paginate_links( [
			'root'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => __( 'Previous' ),
			'next_text'    => __( 'Next' ),
			'add_args'     => false,
			'add_fragment' => ''
		]
	);

	if ( is_array( $pages ) ) {
		$pagination = '<nav class="pagination" role="navigation"><ul class="pagination__list">';
		foreach ( $pages as $page ) {
			$pagination .= '<li class="pagination__list__item '.(strpos($page, 'current') !== false ? 'active' : '').'"> ' . str_replace( 'page-numbers', 'page-link', $page ) . '</li>';
		}
		$pagination .= '</ul></nav>';
		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}

	return null;
}
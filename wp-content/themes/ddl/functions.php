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
    'primary-menu' => __( 'Primary Menu'),
    // 'secondary-menu' => __( 'Secondary Menu'),
		// 'footer-top-menu' => __( 'Footer Top Menu'),
		// 'footer-menu' => __( 'Footer Menu')
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
		'name'          => esc_html__( 'Footer Top Widget One', 'ddl' ),
		'id'            => 'footer-top-widget-one',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__widget__title">',
		'after_title'   => '</div>',
  ) );

  register_sidebar( array(
		'name'          => esc_html__( 'Footer Top Widget Two', 'ddl' ),
		'id'            => 'footer-top-widget-two',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__widget__title">',
		'after_title'   => '</div>',
  ) );

  register_sidebar( array(
		'name'          => esc_html__( 'Footer Top Widget Three', 'ddl' ),
		'id'            => 'footer-top-widget-three',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__widget__title">',
		'after_title'   => '</div>',
  ) );

  register_sidebar( array(
		'name'          => esc_html__( 'Footer Top Widget Four', 'ddl' ),
		'id'            => 'footer-top-widget-four',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__widget__title">',
		'after_title'   => '</div>',
  ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom', 'ddl' ),
		'id'            => 'footer-bottom-widget',
		'description'   => esc_html__( 'Add widgets here.', 'ddl' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

}

add_action( 'widgets_init', 'ddl_widgets_init' );


/*-----------------------------------------------------------------------------------*/
/* ENQUEUE SCRIPTS & STYLES */
/*-----------------------------------------------------------------------------------*/

function ddl_scripts() {
  wp_enqueue_style( 'ddl-style', get_stylesheet_uri(), array(), '1.0.0', 'all' );
	wp_enqueue_script( 'ddl-script', get_template_directory_uri() . '/script.js', array(), '1.0.0', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
  // }

  // if ( (is_page('home')) ) {
  //   wp_enqueue_script( 'ddl-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array(), '1.0.0', true );
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

// echo strip_tags( get_excerpt(165) );


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


/* --------------------- Unregister all widgets --------------------- */

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


/* --------------------- Disabling WordPress wpautop and wptexturize filters (removes p from shortcode) --------------------- */

add_filter( 'the_content', 'shortcode_unautop', 100 );

remove_filter ('the_exceprt', 'wpautop');
remove_filter('term_description','wpautop');


/* --------------------- Stop img being wrapped in p tag  --------------------- */

function filter_ptags_on_images($content) {
  return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


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


/*-----------------------------------------------------------------------------------*/
/* ADD CUSTOM META BOXES ON POST AND PAGE FOR BANNER DESCRIPTION */
/*-----------------------------------------------------------------------------------*/

function add_title_description_add() {

  $post_types = array ( 'post', 'page' );

  foreach( $post_types as $post_type ) {
    add_meta_box(
      'title_description_meta_box', // $id
      'Title Description', // $title 
      'title_description_callback', // $callback
      $post_type,
      'normal', // $context
      'high' // $priority
    );
  }

}

add_action( 'add_meta_boxes', 'add_title_description_add' );


function title_description_callback ( $post ) { ?>
  
  <div class="title_description_box">
    <p class="meta-options title_description_field">
      <label style="display:block; margin-bottom:10px;" for="title_description">Title Description</label>
      <textarea style="display:block; width:100%; min-height:80px;" id="title_description" name="title_description"><?php echo esc_attr( get_post_meta( get_the_ID(), 'title_description', true ) ); ?></textarea>
    </p>
  </div>

<?php } 


function title_description_save ( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  if ( $parent_id = wp_is_post_revision( $post_id ) ) {
    $post_id = $parent_id;
  }
  $fields = [
    'title_description',
  ];
  foreach ( $fields as $field ) {
    if ( array_key_exists( $field, $_POST ) ) {
        update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
    }
  }
}

add_action( 'save_post', 'title_description_save' );


/*-----------------------------------------------------------------------------------*/
/* ADD TINYMCE WYSIWYG TO ARCHIVE DESCRIPTION IN THE TITLE COMPONENT */
/*-----------------------------------------------------------------------------------*/

remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );
add_filter( 'edit_category_form_fields', 'cat_description' );
 
function cat_description($tag) { ?>
  <table class="form-table">
    <tr class="form-field">
      <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
      <td>
        <?php
        $settings = array(
          'wpautop' => true,
          'media_buttons' => true,
          'quicktags' => true,
          'textarea_rows' => '15',
          'textarea_name' => 'description'
        );
        $content = html_entity_decode( $tag->description );
        wp_editor( wp_kses_post( $content, ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
        ?>
      </td>
    </tr>
  </table>
<?php }
add_action('admin_head', 'remove_default_category_description');

function remove_default_category_description() {
  global $current_screen;
  if ( $current_screen->id == 'edit-category' ){ ?>
    <script type="text/javascript">
      jQuery(function($) {
        jQuery('textarea#description').closest('tr.form-field').remove();
      });
    </script>
  <?php }
}


/*-----------------------------------------------------------------------------------*/
/* SITE OPTIMISING FUNCTIONS */
/*-----------------------------------------------------------------------------------*/

/* --------------------- Compress HTML - https://www.basiclue.com/2016/04/minify-html-javascript-css-without-plugin.html --------------------- */

// class WP_HTML_Compression
// {
// 	// Settings
// 	protected $compress_css = true;
// 	protected $compress_js = true;
// 	protected $info_comment = true;
// 	protected $remove_comments = true;

// 	// Variables
// 	protected $html;
// 	public function __construct($html)
// 	{
// 		if (!empty($html))
// 		{
// 			$this->parseHTML($html);
// 		}
// 	}
// 	public function __toString()
// 	{
// 		return $this->html;
// 	}
// 	protected function bottomComment($raw, $compressed)
// 	{
// 		$raw = strlen($raw);
// 		$compressed = strlen($compressed);
		
// 		$savings = ($raw-$compressed) / $raw * 100;
		
// 		$savings = round($savings, 2);
	
// 	}
// 	protected function minifyHTML($html)
// 	{
// 		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
// 		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
// 		$overriding = false;
// 		$raw_tag = false;
// 		// Variable reused for output
// 		$html = '';
// 		foreach ($matches as $token)
// 		{
// 			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			
// 			$content = $token[0];
			
// 			if (is_null($tag))
// 			{
// 				if ( !empty($token['script']) )
// 				{
// 					$strip = $this->compress_js;
// 				}
// 				else if ( !empty($token['style']) )
// 				{
// 					$strip = $this->compress_css;
// 				}
// 				else if ($content == '<!--wp-html-compression no compression-->')
// 				{
// 					$overriding = !$overriding;
					
// 					// Don't print the comment
// 					continue;
// 				}
// 				else if ($this->remove_comments)
// 				{
// 					if (!$overriding && $raw_tag != 'textarea')
// 					{
// 						// Remove any HTML comments, except MSIE conditional comments
// 						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
// 					}
// 				}
// 			}
// 			else
// 			{
// 				if ($tag == 'pre' || $tag == 'textarea')
// 				{
// 					$raw_tag = $tag;
// 				}
// 				else if ($tag == '/pre' || $tag == '/textarea')
// 				{
// 					$raw_tag = false;
// 				}
// 				else
// 				{
// 					if ($raw_tag || $overriding)
// 					{
// 						$strip = false;
// 					}
// 					else
// 					{
// 						$strip = true;
						
// 						// Remove any empty attributes, except:
// 						// action, alt, content, src
// 						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						
// 						// Remove any space before the end of self-closing XHTML tags
// 						// JavaScript excluded
// 						$content = str_replace(' />', '/>', $content);
// 					}
// 				}
// 			}
			
// 			if ($strip)
// 			{
// 				$content = $this->removeWhiteSpace($content);
// 			}
			
// 			$html .= $content;
// 		}
		
// 		return $html;
// 	}
		
// 	public function parseHTML($html)
// 	{
// 		$this->html = $this->minifyHTML($html);
		
// 		if ($this->info_comment)
// 		{
// 			$this->html .= "\n" . $this->bottomComment($html, $this->html);
// 		}
// 	}
	
// 	protected function removeWhiteSpace($str)
// 	{
// 		$str = str_replace("\t", ' ', $str);
// 		$str = str_replace("\n",  '', $str);
// 		$str = str_replace("\r",  '', $str);
		
// 		while (stristr($str, '  '))
// 		{
// 			$str = str_replace('  ', ' ', $str);
// 		}
		
// 		return $str;
// 	}
// }

// function wp_html_compression_finish($html)
// {
// 	return new WP_HTML_Compression($html);
// }

// function wp_html_compression_start()
// {
// 	ob_start('wp_html_compression_finish');
// }
// add_action('get_header', 'wp_html_compression_start');
// ?>
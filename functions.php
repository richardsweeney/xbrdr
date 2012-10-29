<?php

add_theme_support('menus');
add_theme_support('post-thumbnails');
// add_image_size('post-excerpt', 300, 300, TRUE);
// add_image_size('portfolio-image', 450, 225, TRUE);

/** Custom header function */
$defaults = array(
	'width'                  => false,
	'height'         				 => false,
	'default-image'					 => get_bloginfo('template_directory') . '/images/logotype.png',
	'random-default' 				 => false,
	'flex-height'            => false,
	'flex-width'             => false,
	'header-text'            => false,
	'uploads'                => true
);
add_theme_support('custom-header', $defaults);


/** Register navigation menus */
function rps_register_menus() {
  register_nav_menus(
  	array(
  		'main_menu' => __('Huvudmeny', 'xbrdr'),
  		'about_us_menu' => __('Om Oss meny', 'xbrdr')
  	)
  );
}
add_action('init', 'rps_register_menus');

/** Register widget areas */
function rps_register_widget_areas() {
  register_sidebar(
  	array(
			'name' => __('Footer', 'xbrdr'),
			'id' => 'rps-footer-widget',
	    'before_widget' => '',
	    'after_widget' => '',
	    'before_title' => '<div class="title">',
	    'after_title' => '</div>'
		)
	);  register_sidebar(
  	array(
			'name' => __('Press Sida Widget', 'xbrdr'),
			'id' => 'rps-press-widget',
	    'before_widget' => '',
	    'after_widget' => '',
	    'before_title' => '<div class="title">',
	    'after_title' => '</div>'
		)
	);
}
add_action('init', 'rps_register_widget_areas');


/** Set useful site constants */
function rps_set_constants() {
	define('ROOT', get_bloginfo('template_directory'));
	define('IMG', get_bloginfo('template_directory') . '/images');
	define('JS', get_bloginfo('template_directory') . '/js');
	define('CSS', get_bloginfo('template_directory') . '/css');
	define('URL', get_bloginfo('url'));
	define('AKISMET_KEY', '9fd1d87831df');
}
add_action('init', 'rps_set_constants');

/** I18n */
function rps_set_language() {
	load_theme_textdomain('xbrdr', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'rps_set_language');


/** Remove dashboard widgets */
function rps_remove_dashboard_widgets() {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'rps_remove_dashboard_widgets' );


/** Enqueue CSS + JS */
function rps_enqueue_js_and_css() {

	// CSS
	wp_register_style('main-css', CSS . '/main.css');
	wp_register_style('bootstrap', CSS . '/bootstrap.css');
	wp_register_style('bootstrap-responsive', CSS . '/bootstrap-responsive.css');
	wp_register_style('styles', CSS . '/styles.css');
	if (is_front_page()) {
	  wp_enqueue_style('main-css');
	} else {
	  wp_enqueue_style('bootstrap');
	  wp_enqueue_style('bootstrap-responsive');
	  wp_enqueue_style('styles');
	}

  // JS
	wp_enqueue_script('jquery');
	if (is_front_page()) {
		wp_enqueue_script('parallax', JS . '/custom.js');
	} else {
		wp_enqueue_script('bootstrap', JS . '/bootstrap.min.js');
		wp_enqueue_script('global-main', JS . '/global/main.js');
		wp_enqueue_script('global-event', JS . '/global/event.js');
		wp_enqueue_script('home', JS . '/home.js');
		wp_enqueue_script('scrollTop', JS . '/jquery.scrollTo.js');
		wp_enqueue_script('nav', JS . '/jquery.nav.js');
	}
}
add_action('wp_enqueue_scripts', 'rps_enqueue_js_and_css');


/** Remove WP version from header */
 remove_action('wp_head', 'wp_generator');
 function blank_version() {
    return '';
 }
 add_filter('the_generator','blank_version');


/** Include the custom post type class */
include_once('includes/custom-post-type-class.php');

/**
 * Create custom post type objects
 */
$cptArray = array(
	'cptName' => 'product',
	'singularName' => __('produkt', 'xbrdr'),
	'pluralName' => __('produkter', 'xbrdr'),
	'slug' => 'produkter'
);
$products = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$products, 'createPostType'));

$cptArray = null;
$cptArray = array(
	'cptName' => 'test',
	'singularName' => __('test', 'xbrdr'),
	'pluralName' => __('tester', 'xbrdr'),
	'slug' => 'tester'
);
$tests = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$tests, 'createPostType'));

$cptArray = null;
$cptArray = array(
	'cptName' => 'commitee_member',
	'singularName' => __('styrelsemedlem', 'xbrdr'),
	'pluralName' => __('styrelsemedlemmar', 'xbrdr'),
	'slug' => 'styrelse'
);
$commitee = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$commitee, 'createPostType'));


$cptArray = null;
$cptArray = array(
	'cptName' => 'owner',
	'singularName' => __('Ägare', 'xbrdr'),
	'pluralName' => _x('Ägare', 'plural of \'agare\'', 'xbrdr'),
	'slug' => 'agare'
);
$owner = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$owner, 'createPostType'));


$cptArray = null;
$cptArray = array(
	'cptName' => 'press_release',
	'singularName' => __('Press Release', 'xbrdr'),
	'pluralName' => __('Press Releases', 'xbrdr'),
	'slug' => 'press-release'
);
$press = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$press, 'createPostType'));



/** Change the text of 'Enter title here' for Commitee members */
function rps_change_default_title($title) {
  $screen = get_current_screen();
  switch ($screen->post_type) {
  	case 'test':
  		$title = __('Ange testens namn', 'xbrdr');
  		break;
  	case 'commitee_member':
    	$title = __('Namn', 'xbrdr');
    	break;
    case 'owner':
    	$title = __('Ange företagets namn', 'xbrdr');
    	break;
  }
  return $title;
}
add_filter('enter_title_here', 'rps_change_default_title');


/**
 * Register meta boxes
 */
function rps_add_meta_boxes() {
	add_meta_box(
		'produkt-meta',
		__('Produkt Meta', 'xbrdr'),
		'rps_print_produkt_meta',
		'produkt',
		'normal',
		'high'
	);
	add_meta_box(
		'test-meta',
		__('Test Meta', 'xbrdr'),
		'rps_print_test_meta',
		'test',
		'normal',
		'high'
	);
	add_meta_box(
		'styrelse-meta',
		__('Styrelse Meta', 'xbrdr'),
		'rps_print_styrelse_meta',
		'commitee_member',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'rps_add_meta_boxes');


/**
 * Add extra meta to custom post types
 */
function rps_print_produkt_meta() {
	global $post;
	$subheader = get_post_meta($post->ID, '_produkt-subheader', true);
	$excerpt = get_post_meta($post->ID, '_produkt-excerpt', true);
 	?>
 	<input type="text" class="produkt-subheader" name="produkt-subheader" placeholder="<?php esc_attr_e('Ange en underrubrik', 'xbrdr'); ?>" value="<?php echo esc_attr($subheader); ?>" />
 	<label for="produkt-excerpt"><?php _e('Lägg till ett utdrag till produkten som visas ut på alla produkt sidor', 'xbrdr'); ?></label>
 		<textarea class="produkt-excerpt" name="produkt-excerpt"><?php echo $excerpt; ?></textarea>
	<?php
}


function rps_print_test_meta() {
	global $post;
	$excerpt = get_post_meta($post->ID, '_test-excerpt', true);
 	?>
 	<label for="test-excerpt"><?php _e('Lägg till ett utdrag till testen som visas ut på alla testcenter sidan', 'xbrdr'); ?></label>
 		<textarea class="test-excerpt" name="test-excerpt"><?php echo $excerpt; ?></textarea>
	<?php
}


function rps_print_styrelse_meta() {
	global $post;
	$dob = get_post_meta($post->ID, '_commitee-dob', true);
	$role = get_post_meta($post->ID, '_commitee-role', true);
 	?>
 	<label for="commitee-dob"><?php _e('Födelseår', 'xbrdr'); ?>:</label>
 		<input type="number" class="commitee-dob" name="commitee-dob" value="<?php echo esc_attr($dob); ?>">
 	<label for="commitee-role"><?php _e('Roll', 'xbrdr'); ?>:</label>
 		<input type="text" class="commitee-role" name="commitee-role" value="<?php echo esc_attr($role); ?>">
	<?php
}


/** Save post meta */
function rps_save_custom_meta() {
	global $post;

	// Stops WP from clearing post meta when autosaving
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
	  return $post->ID;
	}
	if (isset($_POST['produkt-subheader'])) {
		$clean = sanitize_text_field($_POST['produkt-subheader']);
		update_post_meta($post->ID, '_produkt-subheader', $clean);
	}
	if (isset($_POST['produkt-excerpt'])) {
		$clean = esc_textarea($_POST['produkt-excerpt']);
		update_post_meta($post->ID, '_produkt-excerpt', $clean);
	}
	if (isset($_POST['test-excerpt'])) {
		$clean = sanitize_text_field($_POST['test-excerpt']);
		update_post_meta($post->ID, '_test-excerpt', $clean);
	}
	if (isset($_POST['commitee-dob'])) {
		$clean = sanitize_text_field($_POST['commitee-dob']);
		update_post_meta($post->ID, '_commitee-dob', $clean);
	}
	if (isset($_POST['commitee-role'])) {
		$clean = sanitize_text_field($_POST['commitee-role']);
		update_post_meta($post->ID, '_commitee-role', $clean);
	}

}
add_action('save_post', 'rps_save_custom_meta');


/** Footer Widget - show a language switcher in the header */
// class Logo_Widget extends WP_Widget {

// 	public function __construct() {
// 		parent::__construct(
// 	 		'logo_widget',
// 			__('Logo Widget', 'ljhotels'),
// 			array('description' => __('Displays a small logo', 'ljhotels'))
// 		);
// 	}

//  	public function form($instance) {
//  		_e('This widget will automatically a small L J Hotels logo. No configuration is required.', 'ljhotels');
// 	}

// 	public function update($new_instance, $old_instance) {
// 	}

// 	public function widget($args, $instance) {
/*
// 	?>
// 		<img src="<?php echo IMG; ?>/ljh-logo-small.png" class="small-logo">
// 	<?php
// 	}
*/
// }


// /** Register the widgets */
// add_action('widgets_init', 'rps_register_widgets');
// function rps_register_widgets() {
// 	register_widget('Logo_Widget');
// }



/* Nicer excerpt */
if (!function_exists('rps_nicer_excerpt')) {
	function rps_nicer_excerpt($args = array()) {
		global $post;
		$defaults = array(
			'echo' => true,
			'words' => 28,
			'ellipsis' => '&hellip;',
			'link' => true,
			'linkClass' => 'read-more-link',
			'linkText' => __('Läs hela inlägg', 'xbrdr'),
			'linkContainer' => 'p',
			'allowedTags' => '<p><a><i><em><b><strong><ul><ol><li><span><blockquote>'
		);
		$args = wp_parse_args( $args, $defaults );
    $text = trim( strip_tags( $post->post_content, $args['allowedTags'] ) );
		$text = preg_replace( '/(?:(?:\r\n|\r|\n)\s*){2}/s', ' ', $text );
    $text = explode( ' ', $text );
    $numWords = count( $text );
    if( $numWords > $args['words'] ) {
		  array_splice( $text, $args['words'] );
		  $text = implode( ' ', $text );
		  if( $args['ellipsis'] != false ) {
			  $text .= $args['ellipsis'];
			}
		} else {
		  $text = implode( ' ', $text );
		}
		$text = force_balance_tags( $text );
	  if( $numWords > $args['words'] && $args['link'] == true ) {
	  	$text .= '<' . $args['linkContainer'] . ' class="' . $args['linkClass'] . '"><a href="' . get_permalink( $post->ID ) .  '" title="' . get_the_title( $post->ID ) . '">' . $args['linkText'] . '</a></' . $args['linkContainer'] . '>';
		}
		if( $args['echo'] ) {
	 		echo apply_filters('the_content', $text);
	 	} else {
	 		return apply_filters('the_content', $text);
	 	}
	}
}


/** Change crop point for cropped images */
function rps_image_resize_dimensions($payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop) {

	// Change this to a conditional that decides whether you
	// want to override the defaults for this image or not.
	if( false )
		return $payload;

	if ( $crop ) {
		// crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
		$aspect_ratio = $orig_w / $orig_h;
		$new_w = min($dest_w, $orig_w);
		$new_h = min($dest_h, $orig_h);

		if ( !$new_w ) {
			$new_w = intval($new_h * $aspect_ratio);
		}

		if ( !$new_h ) {
			$new_h = intval($new_w / $aspect_ratio);
		}

		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = 0; // [[ formerly ]] ==> floor( ($orig_w - $crop_w) / 2 );
		$s_y = 0; // [[ formerly ]] ==> floor( ($orig_h - $crop_h) / 2 );
	} else {
		// don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
		$crop_w = $orig_w;
		$crop_h = $orig_h;

		$s_x = 0;
		$s_y = 0;

		list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );
	}

	// if the resulting image would be the same size or larger we don't want to resize it
	if ( $new_w >= $orig_w && $new_h >= $orig_h )
		return false;

	// the return array matches the parameters to imagecopyresampled()
	// int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );

}
add_filter('image_resize_dimensions', 'rps_image_resize_dimensions', 10, 6);



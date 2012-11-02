<?php

add_theme_support('menus');
add_theme_support('post-thumbnails');
add_image_size('test-thumbnail', 360, 176, TRUE);


/** Custom header function */
$defaults = array(
	'width'           => false,
	'height'         	=> false,
	'default-image'		=> get_bloginfo('template_directory') . '/images/logotype.png',
	'random-default'	=> false,
	'flex-height'     => false,
	'flex-width'      => false,
	'header-text'     => false,
	'uploads'         => true
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
	);
	register_sidebar(
  	array(
			'name' => __('Press Sida Widget', 'xbrdr'),
			'id' => 'rps-press-widget',
	    'before_widget' => '',
	    'after_widget' => '',
	    'before_title' => '<strong>',
	    'after_title' => '</strong>'
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

	$jsglobals = array(
		'templateDirectory'  => ROOT,
		'url'								 => URL,
	);

	// CSS
	wp_register_style('parallax-css', CSS . '/parallax.css');
	wp_register_style('bootstrap', CSS . '/bootstrap.css');
	wp_register_style('bootstrap-responsive', CSS . '/bootstrap-responsive.css');
	wp_register_style('styles', CSS . '/styles.css');
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('bootstrap-responsive');
	wp_enqueue_style('styles');
	if (is_front_page()) {
	  wp_enqueue_style('parallax-css');
	}

  // JS
	wp_enqueue_script('jquery');
	if (is_front_page()) {
		wp_enqueue_script('parallax-js', JS . '/parallax.js');
		wp_localize_script('parallax-js', 'jsGlobals', $jsglobals);
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


function rps_load_custom_wp_admin_style() {
	$jsglobals = array(
		'templateDirectory'  => ROOT,
		'url'								 => URL,
	);
	wp_enqueue_script('rps-admin-js', JS . '/admin.js');
  wp_register_style('rps-admin-css', CSS . '/admin.css', false, '1.0.0' );
  wp_enqueue_style('rps-admin-css');
	wp_localize_script('rps-admin-js', 'jsGlobals', $jsglobals);
}
add_action('admin_enqueue_scripts', 'rps_load_custom_wp_admin_style');


/** Remove WP version from header */
remove_action('wp_head', 'wp_generator');
function blank_version() {
  return '';
	}
	add_filter('the_generator','blank_version');


/** Tidy up the main navigation code */
function rps_print_main_navigation() {
	$defaults = array(
		'menu'            => 'Primära Länkar',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'nav',
		'menu_id'					=> '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'     => new rps_nav_walker(),
	);
	return wp_nav_menu($defaults);
}

/** Custom navigation function to add active classes to stuff */
class rps_nav_walker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth, $args) {
		global $wp_query, $post;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		if ($post->post_type == 'product' && $item->post_name == 'produkter') {
			$classes[] = 'child-page';
		}
		else if ($item->post_name == 'om-oss' && !empty($post->ancestors)) {
			$p = get_post($post->ancestors[0]);
			if($p->post_name == 'om-oss') {
				$classes[] = 'child-page';
			}
		}
		// This page just gets an id as post_name...
		else if ($post->post_type == 'test' && strtolower($item->post_title) == 'testcenter'){
			$classes[] = 'child-page';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/** Tidy up secondary main navigation code */
function rps_get_secondary_navigation() {
	$defaults = array(
		'menu'            => 'Sekundära Länkar',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'nav nav-tabs rps-tabs',
		'menu_id'					=> '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'echo'						=> false,
		'walker'     => new rps_nav_two_walker(),
	);
	return wp_nav_menu($defaults);
}

/** Custom navigation function to add active classes to stuff */
class rps_nav_two_walker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth, $args) {
		global $wp_query, $post;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		d($item);

		if ($post->post_type == 'post' && strtolower($item->title) == 'press') {
			$classes[] = 'child-page';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/** Print secondary main navigation */
function rps_print_secondary_navigation() {
	global $post;
	$markup = '<nav>
      <div id="nav-sidebar" class="row-fluid">
        <div class="span12">
          <div class="row-fluid introtabs border">
            <div class="tabs-naviation-container">';
  $markup .= rps_get_secondary_navigation();
  $markup .= '</div>
          </div>
        </div>
      </div>
    </nav>';
 	if ($post->post_parent != '') {
    $parent_post = get_post($post->post_parent);
    if ($parent_post->post_title == 'Om Oss') {
    	echo $markup;
    }
  } elseif ($post->post_type == 'post') {
  	echo $markup;
  }
}


/** Parallax navigation for landing page */
function rps_print_parallax_navigation() {
?>
  <ul id="chapter-nav" class="meun">
    <li data-depth="0"><a href="#chapter1" title="XP1 - pallen som har allt"><span>Pallen utan kompromisser</span></a></li>
    <li data-depth="701"><a href="#chapter2" title="Unika egenskaper"><span>Unika egenskaper</span></a></li>
    <li data-depth="1000"><a href="#chapter3" title="En l&ouml;nsam investering"><span>En l&ouml;nsam investering</span></a></li>
    <li data-depth="1400"><a href="#chapter4" title="Pallen och m&auml;nniskan"><span>Pallen och m&auml;nniskan</span></a></li>
    <li data-depth="1800"><a href="#chapter5" title="En h&aring;llbar framtid"><span>En h&aring;llbar framtid</span></a></li>
    <li data-depth="2200"><a href="#chapter6" title="Prata med oss"><span>Prata med oss</span></a></li>
  </ul>
  <div id="news-bar">
      <span>SENASTE NYTT:</span>
      <?php
      	$args = array('post_type' => 'post', 'posts_per_page' => 1);
      	$latest = new WP_Query($args);
      	while ($latest->have_posts()): $latest->the_post();
      ?>
      	<a href="<?php esc_attr(the_permalink()); ?>" ><?php echo the_title(); ?>.</a>
      <?php endwhile; wp_reset_query(); ?>
  </div>
<?php
}


/** Breadcrumb navigation */
function rps_print_breadcrumbs() {
	global $post;
 	if ($post->post_parent != '') {
    $parent_post = get_post($post->post_parent);
    $parentTitle = $parent_post->post_title;
    $parentPermalink = get_permalink($parent_post->ID);
		?>
		<p class="breadcrumb-navigation">
			<a href="<?php echo URL; ?>">xbrdr.com</a>
			<img src="<?php echo IMG; ?>/breadcrumbs.jpg" />
			<a href="<?php echo $parentPermalink; ?>/detta-ar-crossborder/"><?php echo $parentTitle; ?></a>
			<img src="<?php echo IMG; ?>/breadcrumbs.jpg" />
			<a class="active" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</p>
		<?php
	}
}


/** Include the custom post type class */
include_once('includes/Custom-post-type-class.php');

/** Create custom post type objects */
$cptArray = null;
$cptArray = array(
	'cptName' => 'front_push',
	'singularName' => __('front push', 'xbrdr'),
	'pluralName' => __('front pushes', 'xbrdr'),
	'slug' => 'front-push',
	'supports' => array('title'),
);
$push = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$push, 'createPostType'));

/** Create custom post type objects */
$cptArray = null;
$cptArray = array(
	'cptName' => 'product',
	'singularName' => __('produkt', 'xbrdr'),
	'pluralName' => __('produkter', 'xbrdr'),
	'slug' => 'produkter',
);
$products = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$products, 'createPostType'));

$cptArray = null;
$cptArray = array(
	'cptName' => 'test',
	'singularName' => __('test', 'xbrdr'),
	'pluralName' => __('tester', 'xbrdr'),
	'slug' => 'tester',
);
$tests = new RPS_CreateCustomPostType($cptArray);
add_action('init', array(&$tests, 'createPostType'));

$cptArray = null;
$cptArray = array(
	'cptName' => 'commitee_member',
	'singularName' => __('styrelsemedlem', 'xbrdr'),
	'pluralName' => __('styrelsemedlemmar', 'xbrdr'),
	'slug' => 'styrelse',
	'menuName' => 'styrelsen',
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
	'cptName' => 'contact',
	'singularName' => __('Kontakt', 'xbrdr'),
	'pluralName' => __('Kontakter', 'xbrdr'),
	'slug' => 'kontakt-person',
	'supports' => array('title'),
);
$contacts = new RPS_CreateCustomPostTypeWithTaxonomy($cptArray);
add_action('init', array(&$contacts, 'createPostType'));


/** Change the text of 'Enter title here' for Commitee members */
function rps_change_default_title($title) {
  $screen = get_current_screen();
  switch ($screen->post_type) {
  	case 'test':
  		$title = __('Ange testens namn', 'xbrdr');
  		break;
  	case 'commitee_member':
  	case 'contact':
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
	global $post;
	add_meta_box(
		'produkt-meta',
		__('Produkt Meta', 'xbrdr'),
		'rps_print_produkt_meta',
		'product',
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
	add_meta_box(
		'contact-meta',
		__('Kontakt Meta', 'xbrdr'),
		'rps_print_contact_meta',
		'contact',
		'normal',
		'high'
	);
	if ($post->post_name === 'kontakt') {
		add_meta_box(
			'contact-meta',
			__('Kontakt Meta', 'xbrdr'),
			'rps_print_contact_page_meta',
			'page',
			'normal',
			'high'
		);
	}
}
add_action('add_meta_boxes', 'rps_add_meta_boxes');


/** Add extra meta to custom post types */
function rps_print_produkt_meta() {
	global $post;
	$subheader = get_post_meta($post->ID, '_produkt-subheader', true);
	$excerpt = get_post_meta($post->ID, '_produkt-excerpt', true);
 	?>
 	<label for="produkt-subheader"><?php _e('Ange en underrubrik', 'xbrdr'); ?></label>
 	<input type="text" class="rps produkt-subheader" name="produkt-subheader" value="<?php echo esc_attr($subheader); ?>" />
 	<label for="produkt-excerpt"><?php _e('Lägg till ett utdrag till produkten som visas ut på alla produkt sidor', 'xbrdr'); ?></label>
 		<textarea class="rps produkt-excerpt" name="produkt-excerpt"><?php echo $excerpt; ?></textarea>
	<?php
}


function rps_print_test_meta() {
	global $post;
	$excerpt = get_post_meta($post->ID, '_test-excerpt', true);
 	?>
 	<label for="test-excerpt"><?php _e('Lägg till ett utdrag till testen som visas ut på alla testcenter sidan', 'xbrdr'); ?></label>
 		<textarea class="rps test-excerpt" name="test-excerpt"><?php echo $excerpt; ?></textarea>
	<?php
}


function rps_print_styrelse_meta() {
	global $post;
	$dob = get_post_meta($post->ID, '_commitee-dob', true);
	$role = get_post_meta($post->ID, '_commitee-role', true);
 	?>
 	<label for="commitee-dob"><?php _e('Födelseår', 'xbrdr'); ?>:</label>
 		<input type="number" class="rps commitee-dob" name="commitee-dob" value="<?php echo esc_attr($dob); ?>">
 	<label for="commitee-role"><?php _e('Roll', 'xbrdr'); ?>:</label>
 		<input type="text" class="rps commitee-role" name="commitee-role" value="<?php echo esc_attr($role); ?>">
	<?php
}


function rps_print_contact_meta() {
	global $post;
	$tel = get_post_meta($post->ID, '_contact-tel', true);
	$email = get_post_meta($post->ID, '_contact-email', true);
	$role = get_post_meta($post->ID, '_contact-role', true);
	?>
	<label for="contact-tel"><?php _e('Kontakt Telefon', 'xbrdr'); ?></label>
		<input type="tel" class="rps contact-tel" name="contact-tel" value="<?php echo esc_attr($tel); ?>" />
	<label for="contact-email"><?php _e('Kontakt Epost', 'xbrdr'); ?></label>
		<input type="email" class="rps contact-email" name="contact-email" value="<?php echo esc_attr($email); ?>" />
	<label for="contact-role"><?php _e('Kontakt Roll', 'xbrdr'); ?></label>
		<input type="email" class="rps contact-role" name="contact-role" value="<?php echo esc_attr($role); ?>" />
	<?php
}


function rps_print_contact_page_meta() {
	global $post;
	$tel = get_post_meta($post->ID, '_contact-tel', true);
	$email = get_post_meta($post->ID, '_contact-email', true);
	?>
	<label for="contact-tel"><?php _e('Kontakt Telefon', 'xbrdr'); ?></label>
		<input type="tel" class="rps contact-tel" name="contact-tel" value="<?php echo esc_attr($tel); ?>" />
	<label for="contact-email"><?php _e('Kontakt Epost', 'xbrdr'); ?></label>
		<input type="email" class="rps contact-email" name="contact-email" value="<?php echo esc_attr($email); ?>" />
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
	if (isset($_POST['contact-tel'])) {
		$clean = sanitize_text_field($_POST['contact-tel']);
		update_post_meta($post->ID, '_contact-tel', $clean);
	}
	if (isset($_POST['contact-email'])) {
		$clean = sanitize_email($_POST['contact-email']);
		update_post_meta($post->ID, '_contact-email', $clean);
	}
	if (isset($_POST['contact-role'])) {
		$clean = sanitize_text_field($_POST['contact-role']);
		update_post_meta($post->ID, '_contact-role', $clean);
	}

}
add_action('save_post', 'rps_save_custom_meta');


/** Get product information for respective products */
function rps_get_product_information() {
	global $post;
  $properties = get_field('properties');
  $specs = get_field('specification');
  $i = 0;
  if ($properties):
    ?>
    <div class="row-fluid egenskaper">
      <div class="span12">
        <div class="row-fluid spaceme">
        <?php foreach ($properties as $property): ?>
          <?php if (($i % 3) == 0): ?>
          </div><div class="row-fluid spaceme">
          <?php endif; ?>
          <div class="span4 well property">
            <span class="well-icon">
              <img src="<?php echo $property['icon']; ?>" alt="<?php echo esc_attr($property['title']); ?>">
            </span>
            <h3 id="goto-<?php echo($i + 1); ?>">
              <?php echo $property['titel']; ?>
            </h3>
            <?php echo $property['text']; ?>
          </div>
      <?php $i++; endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
  </section>
  <?php if ($specs): ?>
  <section id="spec">
    <div class="tab-pane row-fluid spaceme">
      <div class="row-fluid span12">
        <?php echo $specs; ?>
      </div>
    </div>
  </section>
  <?php
  endif;
}


/** Get contact information + sorty by role */
function rps_get_contact_people() {
	global $post;
  $args = array(
    'post_type' => 'contact',
    'posts_per_page' => -1,
  );
  $contactsByRole = array();
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $role = get_post_meta($post->ID, '_contact-role', true);
      // $sameRole = ($prevRole == $role) ? true : false;
      $contactsByRole[$role][] = array(
        'ID' 		=> $post->ID,
        'name' 	=> get_the_title(),
        'tel' 	=> get_post_meta($post->ID, '_contact-tel', true),
        'email' => get_post_meta($post->ID, '_contact-email', true),
        'role' 	=> get_post_meta($post->ID, '_contact-role', true),
      );
    }
  }
  foreach ($contactsByRole as $contactRoles): ?>
    <div class="span2">
      <?php if (count($contactRoles) == 1): ?>
        <?php foreach ($contactRoles as $person): ?>
        <p>
          <strong><?php echo $person['role']; ?></strong><br>
          <?php echo $person['name']; ?><br>
          <a href="mailto:<?php echo esc_attr($person['email']); ?>"><?php echo $person['email']; ?></a><br>
          <?php echo $person['tel']; ?><br>
        <p>
        <?php endforeach; ?>
      <?php else: ?>
        <p><strong><?php echo $contactRoles[0]['role']; ?></strong><br>
        <?php foreach ($contactRoles as $person): ?>
          <?php echo $person['name']; ?><br>
          <?php if (!empty($person['email'])): ?>
          	<a href="mailto:<?php echo esc_attr($person['email']); ?>"><?php echo $person['email']; ?></a><br>
          <?php endif; ?>
          <?php if (!empty($person['tel'])): ?>
          	<?php echo $person['tel']; ?><br>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  <?php endforeach;
}



function get_repeater_field_images() {
	global $post;
	$fields = get_field('bilder');
	?>
	<div class="row-fluid left-margin-imgs spaceme image-repeater-container">
		<?php foreach ($fields as $field): ?>
		<div class="span6">
			<h3><a href="<?php echo esc_attr($field['sida']); ?>"><?php echo $field['titel']; ?></a></h3>
			<div class="image-border-container">
				<a href="<?php echo esc_attr($field['sida']); ?>">
					<img src="<?php echo esc_attr($field['bild']); ?>" alt="<?php echo esc_attr($field['titel']); ?>" />
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
<?php
}

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



/* My nicer excerpt function */
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


/** Add an ingress shortcode + add TimyMCE button */
function rps_ingress( $atts, $content = null ) {
	return "<p class='ingress'>$content</p>";
}
add_shortcode('ingress', 'rps_ingress');

function rps_add_button_to_tiny_mce() {
  if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ) {
    add_filter('mce_external_plugins', 'rps_add_plugin');
    add_filter('mce_buttons', 'rps_register_button');
  }
}
function rps_register_button($buttons) {
   $buttons[] = 'ingress';
   return $buttons;
}
function rps_add_plugin($plugin_array) {
   $plugin_array['ingress'] = JS . '/tinymce_plugin/editor_plugin_src.js';
   return $plugin_array;
}
add_action('init', 'rps_add_button_to_tiny_mce');


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



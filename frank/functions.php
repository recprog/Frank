<?php

// Remove rel attribute from the category list - thanks Joseph (http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/)! 
function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category tag"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

function fs_register_menus() {
  register_nav_menus(array('primary' => __( 'Primary Navigation' )));
}

if ( !is_admin() ) {
function my_init_method() {
wp_deregister_script( 'l10n' );
}
add_action('init', 'my_init_method'); 
}

add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
add_post_type_support( 'page', 'post-formats' );

/**
 * @package WordPress
 * @subpackage Frank
 */


if ( function_exists('register_sidebar') )/*KILL*/
	register_sidebar(array(
	'name' => 'Top Bar',
	'before_widget' => '<div id="top_bar" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sub Header',
	'id' => 'widget-subheader',
	'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Navigation',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Index Right Aside',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));
	
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Post Left Aside',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Post Right Aside',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Post Footer',
	'id' => 'widget-postfooter',
	'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Footer',
	'id' => 'widget-footer',
	'before_widget' => '<div id="%1$s" class="widget %2$s six columns">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>',
	));

function excerpt_read_more($post) { return '<a href="'. get_permalink($post->ID) . '">' . 'Read On&hellip;' . '</a>'; }

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 * via http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
 */
function widget_first_last_classes($params) {

	
	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');



// ======================
// = HOME PAGE SECTIONS =
// ======================

function franklin_st_home()
{
    include 'admin/admin-options-home.php';
}

function franklin_st_general()
{
    include 'admin/admin-options-general.php';
}

// add our menus
function franklin_street_admin_menu()
{
    add_menu_page( 'Franklin Street', 'Franklin Street', 'manage_options', 'franklin-street', 'franklin_st_general' );

	add_submenu_page( 'franklin-street', 'Franklin Street', 'General', 'manage_options', 'franklin-street', 'franklin_st_general');
    add_submenu_page( 'franklin-street', 'Franklin Street', 'Home Page Sections', 'manage_options', 'franklin-street-home', 'franklin_st_home');
}

add_action( 'admin_menu', 'franklin_street_admin_menu' );

function franklin_street_admin_assets()
{
    if( is_admin() )
    {
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_style( 'franklin-street-admin', get_bloginfo( 'template_directory' ) . '/admin/css/franklin-street-options.css', NULL, NULL, NULL );
        wp_enqueue_script( 'franklin-street-admin', get_bloginfo( 'template_directory' ) . '/admin/js/franklin-street-utils.js', 'jquery', NULL, true );
    }
}    
 
add_action( 'init', 'franklin_street_admin_assets' );

function franklin_street_footer() {	
	$franklin_street_general = get_option( '_franklin_street_general' );
    if($franklin_street_general) echo stripslashes($franklin_street_general['footer']);
}

function franklin_street_header() {
	
	$franklin_street_general = get_option( '_franklin_street_general' );
    if($franklin_street_general) echo stripslashes($franklin_street_general['header']);
}

function franklin_devmode() {
	$franklin_street_general = get_option( '_franklin_street_general' );
	if($franklin_street_general) return $franklin_street_general['devmode'];
}

add_action('wp_footer', 'franklin_street_footer');
add_action('wp_head', 'franklin_street_header');
?>
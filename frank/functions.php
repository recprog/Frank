<?php

if ( ! isset( $content_width ) ) $content_width = 980;

define('HEADER_TEXTCOLOR', 'ffffff');
define('HEADER_IMAGE', '%s/images/default_header.jpg'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH', 980); // use width and height appropriate for your theme
define('HEADER_IMAGE_HEIGHT', 200);

add_filter('wp_list_categories', 'frank_remove_category_list_rel');
add_filter('the_category', 'frank_remove_category_list_rel');
add_filter('dynamic_sidebar_params','frank_widget_first_last_classes');
add_filter( 'script_loader_src', 'frank_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'frank_remove_script_version', 15, 1 );

register_nav_menus(array('primary' => __( 'Primary Navigation' )));

if ( !is_admin() ) add_action('init', 'frank_init'); 
add_action( 'init', 'frank_admin_assets' );
add_action( 'admin_menu', 'frank_admin_menu' );
add_action('wp_footer', 'frank_footer');
add_action('wp_head', 'frank_header');

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'automatic-feed-links' );
	
  add_theme_support( 'post-thumbnails' ); 
  add_image_size( 'post-image', 535, 9999 ); //550 pixels wide (and unlimited height)
  add_image_size( 'featured-image', 980, 200, true);
  add_image_size( 'excerpt-image', 724, 160, true);
  add_image_size( 'large-thumbnail', 600, 300, true);
  add_image_size( 'medium-thumbnail', 400, 200, true);
  add_image_size( 'small-thumbnail', 300, 150, true);
  add_image_size( 'tiny-thumbnail', 100, 100, true);

	/*
	//I have yet to have a good reason to support post formats. Disabling for now...

	  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	  add_post_type_support( 'page', 'post-formats' );
	*/
  
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	'name' => 'Top Bar',
	'before_widget' => '<div id="top_bar" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name' => 'Sub Header',
	'id' => 'widget-subheader',
	'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name' => 'Navigation',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name' => 'Index Right Aside',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Post Left Aside',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Post Right Aside',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name' => 'Post Footer',
	'id' => 'widget-postfooter',
	'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name' => 'Footer',
	'id' => 'widget-footer',
	'before_widget' => '<div id="%1$s" class="widget %2$s six columns">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));
	
}	

function frank_init() {
	wp_deregister_script( 'l10n' );
}

function frank_remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}

// Remove rel attribute from the category list - thanks Joseph (http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/)! 
function frank_remove_category_list_rel($output) {
  $output = str_replace(' rel="category tag"', '', $output);
  return $output;
}

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 * via http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
 */
function frank_widget_first_last_classes($params) {

	
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

function frank_meta_keywords() {

	$keywords = array();
	$tags = get_the_tags();
	if($tags) {
		foreach($tags as $tag) { 
			array_push($keywords, $tag->name);
		}
	}

	$categories = get_the_category();
	if($categories) {
		foreach($categories as $category) { 
			array_push($keywords, $category->name);
		}
	}
	
	$author = get_the_author($post->ID);
	print(get_the_author());
	$meta = '<meta name="keywords" content="';
	$meta .= implode(',', $keywords);
	$meta .= '" />';
	echo $meta;

}

// ======================
// = HOME PAGE SECTIONS =
// ======================


function frank_theme_options() {
	include 'admin/frank-theme-options.php';
}

// add our menus
function frank_admin_menu() {
	add_theme_page( 'Frank', 'Frank Theme Options', 'manage_options', 'frank', 'frank_theme_options' );
}



function frank_admin_assets() {
	if( is_admin() ) {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_style( 'frank-admin', get_template_directory_uri() . '/admin/css/frank-options.css', NULL, NULL, NULL );
		wp_enqueue_script( 'frank-admin', get_template_directory_uri() . '/admin/js/frank-utils.js', 'jquery', NULL, true );
	}
}    
 


function frank_footer() {	
	$frank_general = get_option( '_frank_options' );
    if($frank_general) echo stripslashes($frank_general['footer']);
}

function frank_header() {
	$frank_general = get_option( '_frank_options' );
    if($frank_general) echo stripslashes($frank_general['header']);
}
if (!function_exists('frank_devmode')) {
	function frank_devmode() {
		$frank_general = get_option( '_frank_options' );
		if($frank_general) return $frank_general['devmode'];
	}
}

function frank_tweet_post_button() {
	$frank_general = get_option( '_frank_options' );
    if($frank_general&&$frank_general['tweet_post_button']) return true;
}

function frank_tweet_post_attribution() {
	$frank_general = get_option( '_frank_options' );
    if($frank_general) return $frank_general['tweet_post_attribution'];
}

if (!function_exists('frank_comment')) {
	function frank_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>

		<li id="li-comment-<?php comment_ID() ?>" class="comment">
			<div class="row">
				<div class="comment-content">
					<?php if ($comment->comment_approved == '0') : echo "<span class='comment-moderation'>Your comment is awaiting moderation.</span>"; endif; ?>
					<?php comment_text() ?>	
					<div class="comment-reply">
				    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				  </div>
				</div>
				<div class="comment-info">
					<ul class='metadata vertical'>
						<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>"><?php comment_date('F d, Y g:i A'); ?></time></li>
						<li class='author' id="vcard-<?php comment_ID() ?>">By <a class="url fn" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></li>
						<li><?php edit_comment_link('edit'); ?></li>
					</ul>
				</div>
			</div>
	<?php
	}
}
if (!function_exists('frank_enqueue_styles')) {
	function frank_enqueue_styles() {
		global $wp_styles;
	
		wp_register_style('frank_stylesheet', get_stylesheet_directory_uri().'/style.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_ie', get_stylesheet_directory_uri().'/ie.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_ie7', get_stylesheet_directory_uri().'/ie7.css', null, '0.1', 'all' );
	
		$wp_styles->add_data('frank_stylesheet_ie', 'conditional', 'IE');
		$wp_styles->add_data('frank_stylesheet_ie7', 'conditional', 'IE 7');
	
		wp_enqueue_style('frank_stylesheet');
		wp_enqueue_style('frank_stylesheet_ie');
		wp_enqueue_style('frank_stylesheet_ie7');
	}
}

if (!function_exists('frank_enqueue_styles_dev')) {
	function frank_enqueue_styles_dev() {
		global $wp_styles;

		wp_register_style('frank_stylesheet_reset', get_bloginfo('template_directory').'/stylesheets/css/reset.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_grid', get_bloginfo('template_directory').'/stylesheets/css/grid.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_global', get_bloginfo('template_directory').'/stylesheets/css/global.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_forms', get_bloginfo('template_directory').'/stylesheets/css/forms.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_widgets', get_bloginfo('template_directory').'/stylesheets/css/widgets.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_sprites', get_bloginfo('template_directory').'/stylesheets/css/sprites.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_transitions', get_bloginfo('template_directory').'/stylesheets/css/transitions.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_header', get_bloginfo('template_directory').'/stylesheets/css/header.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_index', get_bloginfo('template_directory').'/stylesheets/css/index.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_single', get_bloginfo('template_directory').'/stylesheets/css/single.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_archive', get_bloginfo('template_directory').'/stylesheets/css/archive.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_fourohfour', get_bloginfo('template_directory').'/stylesheets/css/fourohfour.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_sidebar', get_bloginfo('template_directory').'/stylesheets/css/sidebar.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_comments', get_bloginfo('template_directory').'/stylesheets/css/comments.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_footer', get_bloginfo('template_directory').'/stylesheets/css/footer.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_colorbox', get_bloginfo('template_directory').'/stylesheets/css/colorbox.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_hacks', get_bloginfo('template_directory').'/stylesheets/css/hacks.css', null, '0.1', 'all' );

		wp_register_style('frank_stylesheet_mobile', get_bloginfo('template_directory').'/stylesheets/css/mobile.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_print', get_bloginfo('template_directory').'/stylesheets/css/print.css', null, '0.1', 'print' );
	
		wp_register_style('frank_stylesheet_ie', get_stylesheet_directory_uri().'/stylesheets/css/ie.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_ie7', get_stylesheet_directory_uri().'/stylesheets/css/ie7.css', null, '0.1', 'all' );
	
		$wp_styles->add_data('frank_srd_stylesheet_ie', 'conditional', 'IE');
		$wp_styles->add_data('frank_srd_stylesheet_ie7', 'conditional', 'IE 7');
	
		wp_enqueue_style('frank_stylesheet_reset');
		wp_enqueue_style('frank_stylesheet_grid');
		wp_enqueue_style('frank_stylesheet_global');
		wp_enqueue_style('frank_stylesheet_forms');
		wp_enqueue_style('frank_stylesheet_widgets');
		wp_enqueue_style('frank_stylesheet_sprites');
		wp_enqueue_style('frank_stylesheet_transitions');
		wp_enqueue_style('frank_stylesheet_header');
		wp_enqueue_style('frank_stylesheet_index');
		wp_enqueue_style('frank_stylesheet_single');
		wp_enqueue_style('frank_stylesheet_archive');
		wp_enqueue_style('frank_stylesheet_fourohfour');
		wp_enqueue_style('frank_stylesheet_sidebar');
		wp_enqueue_style('frank_stylesheet_comments');
		wp_enqueue_style('frank_stylesheet_footer');
		wp_enqueue_style('frank_stylesheet_colorbox');
		wp_enqueue_style('frank_stylesheet_hacks');
	
		wp_enqueue_style('frank_stylesheet_mobile');
		wp_enqueue_style('frank_stylesheet_print');
	
		wp_enqueue_style('frank_srd_stylesheet_ie');
		wp_enqueue_style('frank_srd_stylesheet_ie7');
	}
}

?>
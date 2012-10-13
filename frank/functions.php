<?php
// INCLUDE FILE TO CREATE NEW ADMIN OPTIONS
require_once('admin/frank-theme-options.php');

add_action('after_setup_theme', 'frank_theme_setup');
function frank_theme_setup(){
    load_theme_textdomain('frank-theme', get_template_directory() . '/languages');
}

if ( ! isset( $content_width ) ) $content_width = 980;

define('HEADER_TEXTCOLOR', '3D302F');
define('HEADER_IMAGE', '%s/images/default_header.jpg'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH', 980); // use width and height appropriate for your theme
define('HEADER_IMAGE_HEIGHT', 225);

add_filter('wp_list_categories', 'frank_remove_category_list_rel');
add_filter('the_category', 'frank_remove_category_list_rel');
add_filter('dynamic_sidebar_params','frank_widget_first_last_classes');
add_filter( 'script_loader_src', 'frank_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'frank_remove_script_version', 15, 1 );

register_nav_menus(array('primary' => __( 'Primary Navigation', 'frank-theme' )));

add_action( 'init', 'frank_admin_assets' );
add_action( 'admin_menu', 'frank_admin_menu' );
add_action('wp_footer', 'frank_footer');
add_action('wp_head', 'frank_header');

$custom_header_support = array(
		// The default header text color.
		'default-text-color' => '3D302F',
		// Support flexible heights.
		'flex-height' => true,
		// Callback for styling the header.
		'wp-head-callback' => 'frank_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'frank_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'frank_admin_header_image',
	);
	
	add_theme_support( 'custom-header', $custom_header_support );

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'automatic-feed-links' );
	
  add_theme_support( 'post-thumbnails' ); 
  add_image_size( 'post-image', 535, 9999 ); //550 pixels wide (and unlimited height)
  add_image_size( 'featured-image', 980, 200, true);
  add_image_size( 'excerpt-image', 724, 160, true);
  add_image_size( 'default-thumbnail', 535, 200, true);
  add_image_size( 'two-up-thumbnail', 468, 200, true);
  add_image_size( 'three-up-thumbnail', 297, 150, true);
  add_image_size( 'four-up-thumbnail', 212, 100, true);

  add_theme_support('custom-background', array('default-color' => '#fffefe'));

	/*
	//I have yet to have a good reason to support post formats. Disabling for now...

	  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	  add_post_type_support( 'page', 'post-formats' );
	*/
  
}

if ( function_exists('register_sidebar') ) {
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

function frank_remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}


if ( ! function_exists( 'frank_header_style' ) ) :

function frank_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;
		
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-title-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; 

if ( ! function_exists( 'frank_admin_header_style' ) ) :
function frank_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}

	#desc, h1 {
		line-height: 1.25;
	}
	#headimg h1 {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
		font-size: 24px;
		margin-bottom: 5px;
		margin-top:15px;
		font-weight: normal
	}
	#headimg h1 a {
		color: #3D302F;
		text-decoration: none
	}
	#desc {
		margin-top: 0;
		font-size: 13px;
		margin-bottom: 15px
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 980px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif;


if ( ! function_exists( 'frank_admin_header_image' ) ) :
function frank_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; 

if ( ! function_exists( 'frank_admin_header_image' ) ) :
function frank_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; 


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




// ======================
// = HOME PAGE SECTIONS =
// ======================


if (!function_exists('frank_theme_options')) {
	function frank_theme_options() {
		frank_build_settings_page();
	}
}

// add our menus
function frank_admin_menu() {
	add_theme_page( 'Frank', 'Frank Theme Options', 'manage_options', 'frank-settings', 'frank_theme_options' );
}



function frank_admin_assets() {
	if( is_admin() ) {
		wp_enqueue_script('jquery-ui-sortable' );
		wp_enqueue_style('frank-admin', get_template_directory_uri() . '/admin/css/frank-options.css', NULL, NULL, NULL);
		wp_enqueue_script('frank-admin', get_template_directory_uri() . '/admin/js/frank-utils.js', 'jquery', NULL, true);
	}
} 

function frank_footer() {	
	$frank_general = get_option( '_frank_options' );
    if($frank_general&&isset($frank_general['footer'])) echo stripslashes($frank_general['footer']);
}

function frank_header() {
	$frank_general = get_option( '_frank_options' );
    if($frank_general&&isset($frank_general['header'])) echo stripslashes($frank_general['header']);
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
		//TODO: Replace with custom editor style
		add_editor_style('stylesheets/css/global.css');
		wp_register_style('frank_stylesheet', get_stylesheet_directory_uri().'/style.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_ie', get_stylesheet_directory_uri().'/ie.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_ie7', get_stylesheet_directory_uri().'/ie7.css', null, '0.1', 'all' );
	
		$wp_styles->add_data('frank_stylesheet_ie', 'conditional', 'IE');
		$wp_styles->add_data('frank_stylesheet_ie7', 'conditional', 'IE 7');
	

	wp_enqueue_style('frank_srd_stylesheet');
	wp_enqueue_style('frank_srd_stylesheet_ie');
	wp_enqueue_style('frank_srd_stylesheet_ie7');
	}
}

?>
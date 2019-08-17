<?php


add_action( 'after_setup_theme', 'frank_theme_setup' );

function frank_theme_setup() {
	
	// Enable localization
	load_theme_textdomain( 'frank', get_template_directory() . '/languages' );

	// Required only for theme check, not used in theme
	global $content_width;
	if ( ! isset( $content_width ) ) 
		$content_width = 650;

	// Support for custom post formats
	add_theme_support( 'post-formats', array( 'link', 'quote', 'status', 'aside', 'image', 'gallery', 'video', 'audio' ) );

	// Add RSS links, etc.
	add_theme_support( 'automatic-feed-links' );

	// Enable post thumbnails
	add_theme_support( 'post-thumbnails' );

	add_editor_style();

	// Add an image size for featured images
	add_image_size( 'featured-header', 800, 400, true );

	add_theme_support( 
		'custom-header', 
		array(
			'default-image' => frank_get_default_header_image(),
			'width' => 120,
			'height' => 120,
			'header-text' => false,
			'uploads' => true
		)
	);

	add_theme_support( 
		'custom-background',
		array(
			'default-color' => '#eeeeee',
			'wp-head-callback' => 'frank_custom_background'
		) 
	);

	// Register menus
	register_nav_menu( 'main_menu', __( 'Main menu', 'frank' ) );
	register_nav_menu( 'footer_menu', __( 'Footer menu', 'frank' ) );
	register_nav_menu( 'social_menu', __( 'Social menu', 'frank' ) );
	register_nav_menu( 'blog_menu', __( 'Blog categories', 'frank' ) );

	// Register the sidebar
	register_sidebar( array(
		'id' => 'footer-area',
		'name' => __( 'Footer Widget Area', 'frank' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

}


function frank_custom_background() {

	$image = get_theme_mod( 'background_image', false );

	if ( empty( $image ) )
		return;

	$repeat = get_theme_mod( 'background_repeat' );
	$position = get_theme_mod( 'background_position_x' );
	$attachment = get_theme_mod( 'background_attachment' );

	printf( 
		'<style type="text/css">
			.wrap-header { 
				background-image:url("%s"); 
				background-repeat:%s;
				background-position:%s;
				background-attachment:%s;
			}
		</style>',
		$image,
		$repeat,
		$position,
		$attachment
	);

}


function frank_get_default_header_image() {
	
	// Get the default Gravatar image
	$style = get_option( 'avatar_default', 'mystery' );
	
	if ( 'mystery' == $style )
		$style = 'mm';

	// Maybe SSL?
	$protocol = ( is_ssl() ) ? 'https://secure.' : 'http://';
	
	// Compose the Gravatar URL
	$url = sprintf( 
			'%1$sgravatar.com/avatar/%2$s/', 
			$protocol, 
			md5( get_option( 'admin_email' ) ) 
		);

	// Add Gravatar size
	$url = add_query_arg( array( 's' => 120, 'd' => urlencode( $style ) ), $url );

	return esc_url_raw( $url );

}


add_action( 'wp_enqueue_scripts', 'frank_base_css' );

function frank_base_css() {
	wp_enqueue_style( 'frank-css', get_template_directory_uri() . '/style.css', array(), '149' );

	if ( is_singular() && comments_open() ) 
		wp_enqueue_script( 'comment-reply' );
}

add_action( 'init' , 'frank_init_theme' );

function frank_init_theme() {
    // Theme elements, post meta data, pagination
    include get_template_directory() . '/inc/theme-parts.php';

    // Nice to have
    include get_template_directory() . '/inc/theme-features.php';

    // Theme options
    include get_template_directory() . '/inc/theme-customizer.php';
}

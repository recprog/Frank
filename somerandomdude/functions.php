<?php
#add_action('wp_enqueue_scripts', 'frank_enqueue_scripts');
#add_action('wp_enqueue_scripts', 'frank_enqueue_scripts');

require_once('admin/srd-theme-options.php');
if (!is_admin()) {  
	add_action('init', 'frank_enqueue_scripts');
	add_action('init', 'frank_enqueue_styles');  
}  

function frank_init() {
	wp_deregister_script( 'l10n' );
}

function frank_devmode() {
	$frank_general = get_option( '_frank_options' );
	if($frank_general) return $frank_general['devmode'];
}

function frank_meta_keywords() {
	global $post;
	
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
	
	print(get_the_author());
	$meta = '<meta name="keywords" content="';
	$meta .= implode(',', $keywords);
	$meta .= '" />';
	echo $meta;

}

function frank_theme_options() {
	frank_build_settings_page();
}

function frank_enqueue_scripts() {
	
	global $wp_scripts;
	
	wp_register_script('somerandomdude', (get_stylesheet_directory_uri().'/javascripts/somerandomdude.js'), false, '1.0', true);
	wp_enqueue_script('somerandomdude');
	
	$frank_general = get_option( '_frank_options' );
}

// Remove unneeded widgets that have undesirable query overhead

add_action( 'widgets_init', 'remove_unneeded_widgets' );
function remove_unneeded_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}

function frank_enqueue_styles() {
	
	global $wp_styles;
	
	wp_register_style('frank_srd_stylesheet', get_stylesheet_directory_uri().'/style.css', null, '0.1', 'all' );
	
	wp_register_style('frank_srd_stylesheet_ie', get_stylesheet_directory_uri().'/ie.css', null, '0.1', 'all' );
	wp_register_style('frank_srd_stylesheet_ie7', get_stylesheet_directory_uri().'/ie7.css', null, '0.1', 'all' );
	
	$wp_styles->add_data('frank_srd_stylesheet_ie', 'conditional', 'IE');
	$wp_styles->add_data('frank_srd_stylesheet_ie7', 'conditional', 'IE 7');
	
	wp_enqueue_style('frank_srd_stylesheet');
	wp_enqueue_style('frank_srd_stylesheet_ie');
	wp_enqueue_style('frank_srd_stylesheet_ie7');
	
}
?>
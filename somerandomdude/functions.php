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
	
	wp_register_script('somerandomdude', (get_stylesheet_directory_uri().'/js/somerandomdude.js'), false, '1.0', true);
	wp_enqueue_script('somerandomdude');
	
	$frank_general = get_option( '_frank_options' );
	if($frank_general['inject_js']) {
		add_action('wp_print_scripts', 'frank_remove_all_scripts', 100);
		add_action('wp_footer', 'frank_print_scripts');
	}
	
}

function frank_remove_all_scripts() {
    global $wp_scripts;
    global $frank_scripts;
    $scripts = $wp_scripts->queue;
    $frank_scripts = array();

    for($i=0; $i<count($scripts); $i++) {
			array_push($frank_scripts, $wp_scripts->registered[$scripts[$i]]->src);
		}
    
    $wp_scripts->queue = array();
}

function frank_print_scripts() {
	global $frank_scripts;

	global $wp_scripts;
	$scripts = $frank_scripts;
	echo '<script>';
	for($i=0; $i<count($scripts); $i++) {
		$url = parse_url($scripts[$i]);

		if($url['host']=='') {
			$url=site_url().$url['path'];
		} else {
			$url = $scripts[$i];
		}
		$js = wp_remote_get($url, array('timeout'=>300));
		$js_body = wp_remote_retrieve_body($js);
		echo $js_body;
	}
	echo '</script>';
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

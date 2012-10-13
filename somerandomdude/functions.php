<?php
if(!frank_devmode()) add_action('wp_enqueue_scripts', 'frank_enqueue_scripts');
else add_action('wp_enqueue_scripts', 'frank_enqueue_scripts_dev');

function frank_devmode() {
	$frank_general = get_option( '_frank_options' );
	if($frank_general) return $frank_general['devmode'];
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
	
	/*
	$css = wp_remote_get(get_stylesheet_directory_uri().'/style.css');
	echo '<style type="text/css">';
	echo $css['body'];
	echo '</style>';
	*/
}


function frank_enqueue_styles_dev() {
	
		global $wp_styles;
		/*
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
		*/
		wp_register_style('frank_stylesheet_hacks', get_bloginfo('template_directory').'/style.css', null, '0.1', 'all' );
		
		wp_register_style('frank_srd_stylesheet_global', get_stylesheet_directory_uri().'/stylesheets/css/global.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_forms', get_stylesheet_directory_uri().'/stylesheets/css/forms.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_widgets', get_stylesheet_directory_uri().'/stylesheets/css/widgets.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_sprites', get_stylesheet_directory_uri().'/stylesheets/css/sprites.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_transitions', get_stylesheet_directory_uri().'/stylesheets/css/transitions.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_header', get_stylesheet_directory_uri().'/stylesheets/css/header.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_index', get_stylesheet_directory_uri().'/stylesheets/css/index.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_single', get_stylesheet_directory_uri().'/stylesheets/css/single.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_page', get_stylesheet_directory_uri().'/stylesheets/css/page.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_archive', get_stylesheet_directory_uri().'/stylesheets/css/archive.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_fourohfour', get_stylesheet_directory_uri().'/stylesheets/css/fourohfour.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_sidebar', get_stylesheet_directory_uri().'/stylesheets/css/sidebar.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_comments', get_stylesheet_directory_uri().'/stylesheets/css/comments.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_footer', get_stylesheet_directory_uri().'/stylesheets/css/footer.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_pages', get_stylesheet_directory_uri().'/stylesheets/css/pages.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_colorbox', get_stylesheet_directory_uri().'/stylesheets/css/colorbox.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_hacks', get_stylesheet_directory_uri().'/stylesheets/css/hacks.css', null, '0.1', 'all' );

		wp_register_style('frank_stylesheet_mobile', get_bloginfo('template_directory').'/stylesheets/css/mobile.css', null, '0.1', 'all' );
		wp_register_style('frank_stylesheet_print', get_bloginfo('template_directory').'/stylesheets/css/print.css', null, '0.1', 'print' );
		
		wp_register_style('frank_srd_stylesheet_ie', get_stylesheet_directory_uri().'/stylesheets/css/ie.css', null, '0.1', 'all' );
		wp_register_style('frank_srd_stylesheet_ie7', get_stylesheet_directory_uri().'/stylesheets/css/ie7.css', null, '0.1', 'all' );
		
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
		
		wp_enqueue_style('frank_srd_stylesheet_global');
		wp_enqueue_style('frank_srd_stylesheet_forms');
		wp_enqueue_style('frank_srd_stylesheet_widgets');
		wp_enqueue_style('frank_srd_stylesheet_sprites');
		wp_enqueue_style('frank_srd_stylesheet_transitions');
		wp_enqueue_style('frank_srd_stylesheet_header');
		wp_enqueue_style('frank_srd_stylesheet_index');
		wp_enqueue_style('frank_srd_stylesheet_single');
		wp_enqueue_style('frank_srd_stylesheet_page');
		wp_enqueue_style('frank_srd_stylesheet_archive');
		wp_enqueue_style('frank_srd_stylesheet_fourohfour');
		wp_enqueue_style('frank_srd_stylesheet_sidebar');
		wp_enqueue_style('frank_srd_stylesheet_comments');
		wp_enqueue_style('frank_srd_stylesheet_footer');
		wp_enqueue_style('frank_srd_stylesheet_pages');
		wp_enqueue_style('frank_srd_stylesheet_colorbox');
		wp_enqueue_style('frank_srd_stylesheet_hacks');

		wp_enqueue_style('frank_stylesheet_mobile');
		wp_enqueue_style('frank_stylesheet_print');
		
		wp_enqueue_style('frank_srd_stylesheet_ie');
		wp_enqueue_style('frank_srd_stylesheet_ie7');
}

function frank_enqueue_scripts() {
	
	global $wp_scripts;
	/*
	wp_register_script('somerandomdude', (get_stylesheet_directory_uri().'/js/somerandomdude.js'), false, '1.0');
	wp_enqueue_script('somerandomdude');
	*/
	
	add_action('wp_footer', 'frank_print_scripts');
}

function frank_print_scripts() {
	$js = wp_remote_get(get_stylesheet_directory_uri().'/js/somerandomdude.js');
	echo '<script>';
	echo $js['body'];
	echo '</script>';
}

function frank_enqueue_scripts_dev() {
	
	global $wp_scripts;
	
	wp_register_script('frank-slideshow', get_stylesheet_directory_uri().'/js/frank.slideshow.js', false, '1.0', true);
	wp_register_script('frank-simplebox', get_stylesheet_directory_uri().'/js/simplebox.js', false, '1.0', true);
	wp_register_script('frank-main', get_stylesheet_directory_uri().'/js/main.js', false, '1.0', true);
	wp_enqueue_script('frank-slideshow');
	wp_enqueue_script('frank-simplebox');
	wp_enqueue_script('frank-main');
	
}


?>
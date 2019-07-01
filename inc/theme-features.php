<?php

// Allow static front page to use custom page template
// and use index template if blog is on front
add_filter( 'frontpage_template', 'frank_front_page_template_custom' );

function frank_front_page_template_custom( $template ) {
	
	// Use custom template if a static page with template is selected
	if ( get_page_template_slug() )
		return get_page_template();

	// Use regular index page instead of front-page.php when blog is on front
	if ( is_front_page() && is_home() )
		return get_index_template();

	return $template;

}


add_filter( 'wp_title', 'frank_head_title', 10, 2 );

function frank_head_title( $title, $sep ) {

	if ( is_feed() )
		return $title;

	if ( is_front_page() )
		return sprintf( '%s %s %s', get_bloginfo( 'name' ), $sep, get_bloginfo( 'description' ) );

	$title = sprintf( '%s %s', $title, get_bloginfo( 'name' ) );

	if ( get_query_var('paged') > 1 )
		$title .= sprintf( ' (%s)', sprintf( __( 'Page %d', 'frank' ), get_query_var('paged') ) );

	return $title;

}


add_action( 'wp_head', 'frank_favicon' );

function frank_favicon() {
	$header_image = get_header_image();

	if ( $header_image )
		printf(
			'<link rel="icon" type="image/png" href="%s" />',
			esc_url( $header_image )
		);
}


add_action( 'wp_head', 'make_search_notfound_noindex' );

function make_search_notfound_noindex() {
	if ( is_search() || is_404() )
		echo '<meta name="robots" content="noindex" />';
}


add_filter( 'previous_posts_link_attributes', 'base_pagination_rel_prev' );

function base_pagination_rel_prev() {
	return 'rel="prev"';
}


add_filter( 'next_posts_link_attributes', 'base_pagination_rel_next' );

function base_pagination_rel_next() {
	return 'rel="next"';
}


add_action( 'login_enqueue_scripts', 'frank_custom_login_logo' );

function frank_custom_login_logo() {
	$header_image = get_header_image();

	if ( ! empty( $header_image ) )
		echo '<style type="text/css">
				.login h1 a { 
					background:url("'. esc_url( $header_image ) .'") no-repeat center center;
					background-size:auto 100%; 
					height:80px;
					margin-bottom:1em;
					border-radius:50%;
				}
			</style>';
}



<?php


add_action( 'post_pagination_links', 'frank_pagination_links' );

function frank_pagination_links( $position = 'footer' ) {
	global $wp_query, $paged;

	if ( ! $wp_query->max_num_pages || is_404() )
		return;

	$nav = array();

	if ( is_search() )
		$labels = array( 'next' => __( 'Next &rarr;', 'frank' ), 'previous' => __( '&larr; Previous', 'frank' ) );
	else
		$labels = array( 'next' => __( 'Older &rarr;', 'frank' ), 'previous' => __( '&larr; Newer', 'frank' ) );

	if ( $older_link = get_previous_posts_link( $labels['previous'] ) )
		$nav[] = $older_link;

	if ( $newer_link = get_next_posts_link( $labels['next'] ) )
		$nav[] = $newer_link;

	if ( ! empty( $nav ) )
		printf( 
			'<nav class="pagination post-pagination pagination-%s">
				<span class="status">%s</span>
				<span class="links">%s</span>
			</nav>',
			sanitize_title( $position ),
			sprintf( __( 'Page %d of %d', 'frank' ), $paged, $wp_query->max_num_pages ),
			implode( '', $nav )
		);

}


/**
 * Add hfeed class to body tag on index/archive pages
 */
add_filter( 'body_class', 'frank_body_class' );

function frank_body_class( $classes ) {
	if ( is_archive() || is_home() || is_front_page() ) {
		$classes[] = 'hfeed';
		$classes[] = 'index-page';
	}

	if ( is_page_template( 'templates/front-incl-posts.php' ) ) {
		$classes[] = 'index-page';
	}

	if ( get_header_image() )
		$classes[] = 'has-header-image';

	if ( get_theme_mod( 'frank-layout-type' ) == 'centered' )
		$classes[] = 'layout-center';

	return $classes;
}


/**
 * Add a CSS class to post wraps if post has a featured image
 */
add_filter( 'post_class', 'frank_has_featured_image_class' );

function frank_has_featured_image_class( $classes ) {
	if ( has_post_thumbnail() )
		$classes[] = 'has-featured-image';

	return $classes;
}


/**
 * Add breadcrumbs
 */
add_action( 'content_before', 'frank_breadcrumb' );

function frank_breadcrumb() {

	$path = array();
	$classes = array();
	
	$page_ancestors = null;
	$object = get_queried_object();

	// Use WordPress SEO breadcrumbs only if enabled
	if ( class_exists( 'WPSEO_Options' ) ) {
		$yoast_options = WPSEO_Options::get_all();

		if ( isset( $yoast_options['breadcrumbs-enable'] ) && $yoast_options['breadcrumbs-enable'] ) {
			yoast_breadcrumb( '<div class="breadcrumb yoast-breadcrumb">', '</div>' );
			return;
		}
	}

	if ( is_404() || is_search() )
		return; 

	// Get blog index page, if any
	$page_for_posts = get_option( 'page_for_posts' );

	// Get page ancestors, if any
	if ( is_page() )
		$page_ancestors = get_ancestors( get_queried_object_id(), 'page' );

	// Add home link
	$path[] = sprintf( 
			'<a href="%s">%s</a>', 
			home_url('/'), 
			__( 'Home', 'frank' ) 
		);

	// Add page ancestors
	if ( is_page() && ! empty( $page_ancestors ) )
		foreach ( array_reverse( $page_ancestors ) as $ancestor )
			$path[] = sprintf( 
					'<a href="%s">%s</a>', 
					get_permalink( $ancestor ), 
					esc_html( get_the_title( $ancestor ) ) 
				);

	// Add blog index page if on single post or archive
	if ( ( is_single() || is_archive() || get_query_var( 'paged' ) ) && $page_for_posts )
		$path[] = sprintf( 
				'<a href="%s">%s</a>', 
				get_permalink( $page_for_posts ), 
				get_the_title( $page_for_posts ) 
			);

	// Add category links, if on single post
	if ( is_single() && $category_frank = get_the_category_frank( ',' ) )
		$path[] = $category_frank;

	// Add category links on category archive pages
	if ( is_category() && get_query_var( 'paged' ) )
		$path[] = sprintf( 
				'<a href="%s">%s</a>', 
				get_category_link( get_queried_object_id() ), 
				single_cat_title( '', false ) 
			);

	if ( is_attachment() && $object->post_parent )
		$path[] = sprintf( 
				'<a href="%s">%s</a>', 
				get_permalink( $object->post_parent ), 
				esc_html( get_the_title( $object->post_parent ) ) 
			);

	$classes[] = sprintf( 'breadcrumb-count-%d', count( $path ) );
 
	// Print breadcrumb if not on front page
	if ( ! is_front_page() )
		printf( 
			'<div class="breadcrumb %s" itemprop="breadcrumb">%s &rarr;</div>', 
			implode( ' ', $classes ),
			implode( ' &rarr; ', $path ) 
		);

}


function frank_content_parts( $content ) {

	// Split content by the more tag, remove empty parts
	$parts = array_filter( preg_split( '/<!--more(.*?)?-->/', trim( $content ) ) );

	// Remove blank space before and after each content element
	array_walk( $parts, 'trim' );

	// Force balanced tags
	array_walk( $parts, 'force_balance_tags' );

	return $parts;

}


add_action( 'header_after', 'frank_index_header' );

function frank_index_header() {
	$extra = array();
	$heading = null;

	if ( is_author() )
		$author = get_user_by( 'login', get_query_var('author_name') );

	if ( is_tax() || is_category() || is_tag() )
		$heading = single_term_title( '', false );
	elseif ( is_day() )
		$heading = get_the_date();
	elseif ( is_month() )
		$heading = get_the_date( _x( 'F Y', 'monthly archives date format', 'frank' ) );
	elseif ( is_year() )
		$heading = get_the_date( _x( 'Y', 'yearly archives date format', 'frank' ) );
	elseif ( is_author() && $author )
		$heading = sprintf( __( 'Author: %s', 'frank' ), $author->display_name );
	elseif ( is_archive() )
		$heading = __( 'Archives', 'frank' );

	if ( is_home() || is_page() || is_front_page() ) {

		// This is regular blog index
		if ( ! get_queried_object_id() )
			return;

		$header_post = get_queried_object();
		$header_content_parts = frank_content_parts( trim( $header_post->post_content ) );

		if ( is_page_template( 'templates/front-incl-posts.php' ) || is_front_page() ) {

			if ( ! empty( $header_content_parts[0] ) )
				$extra[] = sprintf(
					'<div class="index-description">%s</div>',
					apply_filters( 'the_content', $header_content_parts[0] )
				);

		} elseif ( is_home() && ! empty( $header_post->post_content ) ) {

			$extra[] = sprintf(
					'<div class="index-description">%s</div>',
					apply_filters( 'the_content', $header_post->post_content )
				);

		}

	}

	if ( category_description() )
		$extra[] = sprintf(
				'<div class="index-description">%s</div>',
				category_description()
			);

	if ( is_author() && $author )
		$extra[] = sprintf(
				'<div class="index-description">%s</div>',
				wptexturize( $author->user_description )
			);

	if ( ! empty( $heading ) )
		$heading = sprintf( '<h1 class="index-heading">%s</h1>', esc_html( $heading ) );

	if ( ! empty( $heading ) || ! empty( $extra ) )
		printf(
			'<div class="index-header">
				%s
				%s
			</div>',
			$heading,
			implode( '', $extra )
		);
}


/**
 * Append the Read more link to the excerpt on archive/index pages
 */
add_filter( 'get_the_excerpt', 'frank_excerpt_add_readmore' );

function frank_excerpt_add_readmore( $content ) {

	if ( empty( $content ) ) {
		return $content;
	} else {
		return sprintf( 
				'%s <a href="%s" class="read-more excerpt-read-more">%s</a>', 
				$content, 
				get_permalink(), 
				str_replace( ' ', '&nbsp;', __( 'Read more &rarr;', 'frank' ) )
			);
	}

}



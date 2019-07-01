<?php
/*
	Template Name: Front page with latest posts
*/

get_header();

$latest_posts = new WP_Query( array( 'posts_per_page' => 3 ) );

if ( $latest_posts->have_posts() ) {
	while ( $latest_posts->have_posts() ) {
		$latest_posts->the_post();

		get_template_part( 'part-loop-index' );
	}
}

if ( $post_page_id = get_option( 'page_for_posts' ) )
	printf( 
		'<p class="blog-link"><a href="%s">%s &rarr;</a></p>', 
		get_permalink( $post_page_id ), 
		esc_html( get_the_title( $post_page_id ) ) 
	);
else
	printf( 
		'<p class="blog-link"><a href="%s">%s &rarr;</a></p>', 
		home_url('/'), 
		esc_html( get_bloginfo( 'name', 'display' ) )
	);

get_footer();

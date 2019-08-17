<?php

get_header();

if ( ( is_archive() || is_home() ) && is_paged() )
	do_action( 'post_pagination_links', 'header' );

if ( have_posts() ) : 
	while ( have_posts() ) : 
		the_post();
		get_template_part( 'part-loop-index' );
	endwhile;
endif;

do_action( 'post_pagination_links', 'footer' );

get_footer();

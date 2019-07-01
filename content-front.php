<?php

$post = get_post();
$content_parts = frank_content_parts( $post->post_content );

// Show everything after the teaser
if ( ! empty( $content_parts[1] ) )
	echo apply_filters( 'the_content', $content_parts[1] );


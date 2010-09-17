<?php
/*
Template Name: Franklin Street Categories Section

http://codex.wordpress.org/Function_Reference/wp_insert_post
http://codex.wordpress.org/Function_Reference/update_post_meta
http://codex.wordpress.org/Function_Reference/post_meta_Function_Examples
http://hungred.com/how-to/wordpress-templatepage-meta-key-updatepostmeta/
http://www.emanueleferonato.com/2010/04/01/loading-wordpress-posts-with-ajax-and-jquery/

*/
?>


	<ul>
		<?php $args = array(
		    'show_option_all'    => NULL,
		    'orderby'            => 'name',
		    'order'              => 'ASC',
		    'show_last_update'   => 0,
		    'style'              => 'list',
		    'show_count'         => 0,
		    'hide_empty'         => 1,
		    'use_desc_for_title' => 1,
		    'child_of'           => 0,
		    'feed'               => NULL,
		    'feed_type'          => NULL,
		    'feed_image'         => NULL,
		    'exclude'            => NULL,
		    'exclude_tree'       => NULL,
		    'include'            => NULL,
		    'hierarchical'       => true,
		    'title_li'           => __( 'Categories' ),
		    'number'             => NULL,
		    'echo'               => 1,
		    'depth'              => 0,
		    'current_category'   => 0,
		    'pad_counts'         => 0,
		    'taxonomy'           => 'category',
		    'walker'             => 'Walker_Category' ); ?>
		
			<?php wp_list_categories( $args ); ?> 
	</ul>
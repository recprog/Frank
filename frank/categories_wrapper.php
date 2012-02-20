<?php
/*
Template Name: Frank Categories Section

http://codex.wordpress.org/Function_Reference/wp_insert_post
http://codex.wordpress.org/Function_Reference/update_post_meta
http://codex.wordpress.org/Function_Reference/post_meta_Function_Examples
http://hungred.com/how-to/wordpress-templatepage-meta-key-updatepostmeta/
http://www.emanueleferonato.com/2010/04/01/loading-wordpress-posts-with-ajax-and-jquery/

*/
?>
<div id="categories_pullout">
<div id="categories_container" class='clear'>
<div class='span-8'>
	<h2>Categories</h2>
	<ul id="category_list">
		<?php $args = array(
		    'show_option_all'    => NULL,
		    'orderby'            => 'term_group',
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
		    'hierarchical'       => false,
		    'title_li'           => NULL,
		    'number'             => NULL,
		    'echo'               => 1,
		    'depth'              => 0,
		    'current_category'   => 0,
		    'pad_counts'         => 0,
		    'taxonomy'           => 'category',
		    'walker'             => 'Walker' ); ?>
		
			<?php wp_list_categories( $args ); ?> 
	</ul>
</div>
<div id="tag_cloud" class='span-6 last'>	
	<h2>Tags</h2>
	<div class='tags'>
	<?php $args = array(
	    'smallest'  => 10, 
	    'largest'   => 28,
	    'unit'      => 'px', 
	    'number'    => 45,  
	    'format'    => 'flat',
	    'separator' => ' ',
	    'orderby'   => 'name', 
	    'order'     => 'ASC',
	    'exclude'   => NULL, 
	    'include'   => NULL, 
	    'link'      => 'view', 
	    'taxonomy'  => 'post_tag', 
	    'echo'      => true ); ?>
	
	<?php wp_tag_cloud( $args ); ?>
	</div>
</div>
</div>
</div>
<?php
/*
	Template Name: Franklin Street Loop
*/
?>


<?php 
	
	
	if(is_home()&&!is_paged()) {
		$sticky = get_option( 'sticky_posts' );
		$args = array(
			'posts_per_page' => 1,
			'post__in'  => $sticky,
			'orderby' => 'date', 
			'order' => 'DESC',
			'ignore_sticky_posts' => 1
		);
	
		//Query
		$queryObject = new WP_Query( $args );
	
		//Output
		if ( $sticky[0] ) { include 'one_up_lg.php'; }
		
		// Reset
		wp_reset_postdata();
	}

?>


<div class='clear content halfandhalf'>
	<div class='nav content-header'>
		<span class='label'>Latest Posts</span>
		<span class='caption'><?php print($caption) ?></span>
	</div>
	<div class='contents span-9'>	
	<?php 		
	if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(is_sticky($post->ID)) continue; ?>
		<article class='clear'>
			<header>
				<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			</header>
			<div class='post-info span-2'>	
				<ul class='metadata vertical'>
					<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('F j, Y'); ?></time></li>
					<li class="author">By <?php the_author_link(); ?></li>
					<li class="categories"><?php the_category(', '); ?></li>
					<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
				</ul>
			</div>
			<section class='span-7 last'>
				<?php the_content('Read On&hellip;'); ?>
			</section>
		</article>
	<?php endwhile; ?>
	<?php endif; ?>
	</div>
	<div class='widgets span-3 last'>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Index Right Aside") ) : ?>
			<p><?php bloginfo('description'); ?></p>
		<?php endif; ?>
	</div>
</div>
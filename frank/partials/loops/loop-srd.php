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
	}

	$queryObject = new WP_Query( $args );
	?>
	<?php if($sticky[0]) : ?>
		<div class='row post-group oneup large'>
			<?php 
			get_template_part('partials/posts/post', 'oneuplarge'); 
			wp_reset_postdata();
			?>
		</div>
	<?php endif; ?>

<div class='row post-group halfandhalf'>
	<div class='nine columns post-group-contents'>	
	<?php 		
	if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(is_sticky($post->ID)) continue; ?>
		<?php get_template_part('partials/posts/post'); ?>
	<?php endwhile; ?>
	<?php endif; ?>
	</div>
	<?php get_template_part('partials/sidebars/sidebar', 'index'); ?>
</div>
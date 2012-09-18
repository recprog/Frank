<?php
/*
	Template Name: Two Up
*/
?>
<div class='post-group twoup row'>
	<div class='nav post-group-header'>
		<span class='label'><?php print($title); ?></span>
		<span class='caption'><?php print($caption) ?></span> <span class='more'><?php next_posts_link('View more&hellip;'); ?></span>
	</div>
	<div class='contents row'>	
	<?php while ( $queryObject->have_posts() ) : $queryObject->the_post(); ?>
		<?php get_template_part('partials/posts/post', 'medium'); ?>
	<?php endwhile; ?>
	</div>
</div>